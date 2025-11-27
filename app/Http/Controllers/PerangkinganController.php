<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PerangkinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriterias = Kriteria::all();
        
        // Cek apakah ada kriteria
        if ($kriterias->isEmpty()) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Belum ada kriteria penilaian! Silakan tambahkan kriteria terlebih dahulu.');
        }

        // Get filter kelompok umur dari request
        $kelompokUmur = $request->input('kelompok_umur', 'all');
        
        // Query base untuk atlet
        $query = Atlet::query();
        
        // Filter berdasarkan kelompok umur
        if ($kelompokUmur != 'all') {
            $range = explode('-', $kelompokUmur);
            if (count($range) == 2) {
                $query->whereBetween('umur', [(int)$range[0], (int)$range[1]]);
            }
        }
        
        // Ambil atlet yang sudah memiliki penilaian lengkap
        $atletLengkap = $query->whereHas('penilaians', function($q) use ($kriterias) {
            $q->whereIn('kriteria_id', $kriterias->pluck('id'));
        }, '=', $kriterias->count())->get();

        // Hitung jumlah atlet per kelompok umur
        $jumlahPerKelompok = [
            '8-11' => Atlet::whereBetween('umur', [8, 11])
                ->whereHas('penilaians', function($q) use ($kriterias) {
                    $q->whereIn('kriteria_id', $kriterias->pluck('id'));
                }, '=', $kriterias->count())
                ->count(),
            '12-15' => Atlet::whereBetween('umur', [12, 15])
                ->whereHas('penilaians', function($q) use ($kriterias) {
                    $q->whereIn('kriteria_id', $kriterias->pluck('id'));
                }, '=', $kriterias->count())
                ->count(),
            '16-18' => Atlet::whereBetween('umur', [16, 18])
                ->whereHas('penilaians', function($q) use ($kriterias) {
                    $q->whereIn('kriteria_id', $kriterias->pluck('id'));
                }, '=', $kriterias->count())
                ->count(),
        ];

        return view('perangkingan.index', compact('atletLengkap', 'kriterias', 'jumlahPerKelompok'));
    }

    /**
     * Proses perhitungan ARAS untuk SEMUA atlet (Versi 2 - Sesuai Excel)
     */
    public function hitung(Request $request)
    {
        $kriterias = Kriteria::all();
        
        if ($kriterias->isEmpty()) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Belum ada kriteria penilaian!');
        }

        // Get filter kelompok umur
        $kelompokUmur = $request->input('kelompok_umur', 'all');
        
        // Query atlet berdasarkan kelompok umur
        $query = Atlet::query();
        
        if ($kelompokUmur != 'all') {
            $range = explode('-', $kelompokUmur);
            if (count($range) == 2) {
                $query->whereBetween('umur', [(int)$range[0], (int)$range[1]]);
            }
        }
        
        // Ambil atlet dengan penilaian lengkap
        $atletes = $query->whereHas('penilaians', function($q) use ($kriterias) {
            $q->whereIn('kriteria_id', $kriterias->pluck('id'));
        }, '=', $kriterias->count())->get();

        if ($atletes->isEmpty()) {
            $message = 'Tidak ada atlet dengan penilaian lengkap';
            if ($kelompokUmur != 'all') {
                $message .= ' di kelompok umur ' . $kelompokUmur . ' tahun';
            }
            return redirect()->route('perangkingan.index')
                ->with('error', $message . '!');
        }

        return $this->prosesPerhitunganARAS($atletes, $kriterias, $kelompokUmur);
    }

    /**
     * Proses perhitungan ARAS untuk ATLET TERPILIH
     */
    public function hitungSelected(Request $request)
    {
        $kriterias = Kriteria::all();
        
        if ($kriterias->isEmpty()) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Belum ada kriteria penilaian!');
        }

        // Validasi input
        $request->validate([
            'selected_atlets' => 'required|string'
        ]);

        // Decode selected atlets
        $selectedAtletIds = json_decode($request->selected_atlets, true);
        
        if (!is_array($selectedAtletIds) || count($selectedAtletIds) < 2) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Pilih minimal 2 atlet untuk melakukan perhitungan!');
        }

        // Get filter kelompok umur
        $kelompokUmur = $request->input('kelompok_umur', 'all');
        
        // Query atlet berdasarkan ID yang dipilih
        $query = Atlet::whereIn('id', $selectedAtletIds);
        
        // Filter tambahan berdasarkan kelompok umur jika dipilih
        if ($kelompokUmur != 'all') {
            $range = explode('-', $kelompokUmur);
            if (count($range) == 2) {
                $query->whereBetween('umur', [(int)$range[0], (int)$range[1]]);
            }
        }
        
        // Ambil atlet dengan penilaian lengkap dari yang dipilih
        $atletes = $query->whereHas('penilaians', function($q) use ($kriterias) {
            $q->whereIn('kriteria_id', $kriterias->pluck('id'));
        }, '=', $kriterias->count())->get();

        if ($atletes->isEmpty()) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Atlet yang dipilih tidak memiliki penilaian lengkap!');
        }

        if ($atletes->count() < 2) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Minimal 2 atlet dengan penilaian lengkap diperlukan untuk perhitungan!');
        }

        return $this->prosesPerhitunganARAS($atletes, $kriterias, $kelompokUmur, true);
    }

    /**
     * Method untuk memproses perhitungan ARAS (reusable)
     */
    private function prosesPerhitunganARAS($atletes, $kriterias, $kelompokUmur, $isSelected = false)
    {
        // LANGKAH 1: Membuat Matrix Keputusan
        $matrixKeputusan = [];
        
        // Hitung nilai optimal (A0) untuk setiap kriteria
        $nilaiOptimal = ['atlet' => null];
        foreach ($kriterias as $kriteria) {
            $nilaiPenilaian = Penilaian::whereIn('atlet_id', $atletes->pluck('id'))
                ->where('kriteria_id', $kriteria->id)
                ->pluck('nilai')
                ->toArray();
            
            // Untuk kriteria benefit, ambil nilai maksimal
            // Untuk kriteria cost, ambil nilai minimal
            if ($kriteria->jenis == 'benefit') {
                $nilaiOptimal['C' . $kriteria->id] = !empty($nilaiPenilaian) ? max($nilaiPenilaian) : 100;
            } else {
                $nilaiOptimal['C' . $kriteria->id] = !empty($nilaiPenilaian) ? min($nilaiPenilaian) : 1;
            }
        }
        $matrixKeputusan[] = $nilaiOptimal; // A0

        // Matrix untuk setiap atlet
        foreach ($atletes as $atlet) {
            $row = ['atlet' => $atlet];
            foreach ($kriterias as $kriteria) {
                $penilaian = Penilaian::where('atlet_id', $atlet->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->first();
                $row['C' . $kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
            $matrixKeputusan[] = $row;
        }

        // LANGKAH 2: Normalisasi Matrix (VERSI 2 - Sesuai Excel)
        // Hitung jumlah total untuk setiap kriteria (TERMASUK A0)
        $sumPerKriteria = [];
        foreach ($kriterias as $kriteria) {
            $sum = 0;
            foreach ($matrixKeputusan as $row) {
                $sum += $row['C' . $kriteria->id];
            }
            $sumPerKriteria['C' . $kriteria->id] = $sum;
        }
        
        // Normalisasi: x̄ij = xij / Σxij (termasuk A0 dalam penjumlahan)
        $matrixNormalisasi = [];
        foreach ($matrixKeputusan as $index => $row) {
            $matrixNormalisasi[$index] = ['atlet' => $row['atlet']];
            
            foreach ($kriterias as $kriteria) {
                $kolom = 'C' . $kriteria->id;
                $sum = $sumPerKriteria[$kolom];
                
                // Pembagian langsung: nilai / total
                $matrixNormalisasi[$index][$kolom] = $sum > 0 ? $row[$kolom] / $sum : 0;
            }
        }

        // LANGKAH 3: Matrix Terbobot (mengalikan dengan bobot dalam desimal)
        $matrixTerbobot = [];
        foreach ($matrixNormalisasi as $index => $row) {
            $matrixTerbobot[$index] = ['atlet' => $row['atlet']];
            foreach ($kriterias as $kriteria) {
                $kolom = 'C' . $kriteria->id;
                // Bobot dalam desimal: bobot/100
                $bobotDesimal = $kriteria->bobot / 100;
                $matrixTerbobot[$index][$kolom] = $row[$kolom] * $bobotDesimal;
            }
        }

        // LANGKAH 4: Hitung nilai optimality function (Si)
        // Si = Σ(nilai terbobot) untuk setiap baris
        $Si = [];
        foreach ($matrixTerbobot as $index => $row) {
            $total = 0;
            foreach ($kriterias as $kriteria) {
                $total += $row['C' . $kriteria->id];
            }
            $Si[$index] = $total;
        }

        // S0 adalah Si untuk alternatif optimal (index 0)
        $S0 = $Si[0];

        // LANGKAH 5: Hitung utility degree (Ki = Si / S0)
        $hasilPerangkingan = [];
        foreach ($atletes as $index => $atlet) {
            $i = $index + 1; // karena index 0 adalah A0
            $Ki = $S0 > 0 ? $Si[$i] / $S0 : 0;
            
            $hasilPerangkingan[] = [
                'atlet' => $atlet,
                'Si' => $Si[$i],
                'Ki' => $Ki
            ];
        }

        // Sorting berdasarkan Ki (descending)
        usort($hasilPerangkingan, function($a, $b) {
            return $b['Ki'] <=> $a['Ki'];
        });

        // Tambahkan ranking
        foreach ($hasilPerangkingan as $index => &$hasil) {
            $hasil['ranking'] = $index + 1;
        }

        // Simpan ke session untuk ditampilkan di laporan
        session([
            'hasil_perangkingan' => $hasilPerangkingan,
            'matrix_keputusan' => $matrixKeputusan,
            'matrix_normalisasi' => $matrixNormalisasi,
            'matrix_terbobot' => $matrixTerbobot,
            'sum_per_kriteria' => $sumPerKriteria,
            'si_values' => $Si,
            's0' => $S0,
            'kelompok_umur' => $kelompokUmur,
            'is_selected_atlets' => $isSelected,
            'selected_atlets_count' => $atletes->count()
        ]);

        $message = 'Perhitungan ARAS berhasil dilakukan untuk ' . count($hasilPerangkingan) . ' atlet';
        if ($isSelected) {
            $message = 'Perhitungan ARAS berhasil dilakukan untuk ' . count($hasilPerangkingan) . ' atlet terpilih';
        }
        if ($kelompokUmur != 'all') {
            $message .= ' (Kelompok umur ' . $kelompokUmur . ' tahun)';
        }

        return redirect()->route('perangkingan.hasil')
            ->with('success', $message . '!');
    }

    /**
     * Tampilkan hasil perangkingan
     */
    public function hasil()
    {
        $hasilPerangkingan = session('hasil_perangkingan');
        $matrixKeputusan = session('matrix_keputusan');
        $matrixNormalisasi = session('matrix_normalisasi');
        $matrixTerbobot = session('matrix_terbobot');
        $sumPerKriteria = session('sum_per_kriteria');
        $siValues = session('si_values');
        $s0 = session('s0');
        $kelompokUmur = session('kelompok_umur', 'all');
        $isSelectedAtlets = session('is_selected_atlets', false);
        $selectedAtletsCount = session('selected_atlets_count', 0);
        $kriterias = Kriteria::all();

        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perhitungan! Silakan lakukan perhitungan terlebih dahulu.');
        }

        return view('perangkingan.hasil', compact(
            'hasilPerangkingan',
            'matrixKeputusan',
            'matrixNormalisasi',
            'matrixTerbobot',
            'sumPerKriteria',
            'siValues',
            's0',
            'kriterias',
            'kelompokUmur',
            'isSelectedAtlets',
            'selectedAtletsCount'
        ));
    }
}