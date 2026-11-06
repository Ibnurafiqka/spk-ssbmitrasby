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
        
        if ($kriterias->isEmpty()) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Belum ada kriteria penilaian! Silakan tambahkan kriteria terlebih dahulu.');
        }

        if (!$this->isKonfigurasiKriteriaValid($kriterias)) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Konfigurasi kriteria belum valid. Harus 9 kriteria standar dan total bobot tiap posisi (penyerang, tengah, bertahan) harus 100%.');
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
        
        // Ambil atlet yang sudah memiliki penilaian lengkap (semua posisi untuk count kards)
        $atletLengkapAll = (clone $query)->whereHas('penilaians', function($q) use ($kriterias) {
            $q->whereIn('kriteria_id', $kriterias->pluck('id'));
        }, '=', $kriterias->count())->get();

        $jumlahPerPosisi = [
            'penyerang' => $atletLengkapAll->where('posisi', 'penyerang')->count(),
            'tengah' => $atletLengkapAll->where('posisi', 'tengah')->count(),
            'bertahan' => $atletLengkapAll->where('posisi', 'bertahan')->count(),
        ];

        // Filter tambahan berdasarkan posisi
        $filterPosisi = $request->input('posisi', 'all');
        if ($filterPosisi != 'all') {
            $query->where('posisi', $filterPosisi);
        }

        // Ambil atlet sesuai filter akhir
        $atletLengkap = $query->whereHas('penilaians', function($q) use ($kriterias) {
            $q->whereIn('kriteria_id', $kriterias->pluck('id'));
        }, '=', $kriterias->count())->get();

        return view('perangkingan.index', compact('atletLengkap', 'kriterias', 'jumlahPerPosisi', 'kelompokUmur', 'filterPosisi'));
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

        if (!$this->isKonfigurasiKriteriaValid($kriterias)) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Konfigurasi kriteria belum valid. Pastikan 9 kriteria standar dan total bobot tiap posisi tepat 100%.');
        }

        // Get filter kelompok umur dan posisi
        $kelompokUmur = $request->input('kelompok_umur', 'all');
        $filterPosisi = $request->input('posisi', 'all');
        
        // Query atlet berdasarkan kelompok umur
        $query = Atlet::query();
        
        if ($kelompokUmur != 'all') {
            $range = explode('-', $kelompokUmur);
            if (count($range) == 2) {
                $query->whereBetween('umur', [(int)$range[0], (int)$range[1]]);
            }
        }
        
        // Filter tambahan berdasarkan posisi
        if ($filterPosisi != 'all') {
            $query->where('posisi', $filterPosisi);
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
            if ($filterPosisi != 'all') {
                $message .= ' untuk posisi ' . $filterPosisi;
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

        if (!$this->isKonfigurasiKriteriaValid($kriterias)) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Konfigurasi kriteria belum valid. Pastikan 9 kriteria standar dan total bobot tiap posisi tepat 100%.');
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
                $bobotDesimal = $this->resolveBobotDesimal($kriteria, $row['atlet']);
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

        $rankingChart = [
            'labels' => [],
            'series' => [],
        ];

        $profilAtletChart = [];

        foreach ($hasilPerangkingan as $hasil) {
            $rankingChart['labels'][] = $hasil['atlet']->nama;
            $rankingChart['series'][] = round($hasil['Ki'] * 100, 2);
        }

        foreach ($hasilPerangkingan as $hasil) {
            $atlet = $hasil['atlet'];
            $atletRow = collect($matrixKeputusan)->first(function ($row) use ($atlet) {
                return isset($row['atlet']) && $row['atlet'] && $row['atlet']->id === $atlet->id;
            });

            $profilSeries = [];
            $kontribusiSeries = [];

            foreach ($kriterias as $kriteria) {
                $kolom = 'C' . $kriteria->id;
                $nilaiAktual = (float) ($atletRow[$kolom] ?? 0);
                $nilaiOptimalKriteria = (float) ($matrixKeputusan[0][$kolom] ?? 0);
                $nilaiPersentase = $nilaiOptimalKriteria > 0
                    ? min(100, round(($nilaiAktual / $nilaiOptimalKriteria) * 100, 2))
                    : 0;

                $kontribusiNilai = collect($matrixTerbobot)->first(function ($row) use ($atlet) {
                    return isset($row['atlet']) && $row['atlet'] && $row['atlet']->id === $atlet->id;
                });

                $profilSeries[] = $nilaiPersentase;
                $kontribusiSeries[] = round(((float) ($kontribusiNilai[$kolom] ?? 0)) * 100, 4);
            }

            $profilAtletChart[] = [
                'id' => $atlet->id,
                'nama' => $atlet->nama,
                'ranking' => $hasil['ranking'],
                'ki' => round($hasil['Ki'] * 100, 2),
                'si' => round($hasil['Si'], 4),
                'labels' => $kriterias->pluck('nama_kriteria')->map(fn ($nama) => ucfirst($nama))->values()->all(),
                'profil' => $profilSeries,
                'kontribusi' => $kontribusiSeries,
            ];
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
            'selectedAtletsCount',
            'rankingChart',
            'profilAtletChart'
        ));
    }

    private function resolveBobotDesimal(Kriteria $kriteria, ?Atlet $atlet): float
    {
        if ($atlet) {
            return $kriteria->getBobotByPosisi($atlet->posisi) / 100;
        }

        return $kriteria->getBobotByPosisi(null) / 100;
    }

    private function isKonfigurasiKriteriaValid($kriterias): bool
    {
        if ($kriterias->count() !== count(Kriteria::NAMA_STANDAR)) {
            return false;
        }

        $namaSet = $kriterias->pluck('nama_kriteria')->map(fn ($n) => strtolower(trim($n)))->sort()->values()->all();
        $standarSet = collect(Kriteria::NAMA_STANDAR)->map(fn ($n) => strtolower(trim($n)))->sort()->values()->all();
        if ($namaSet !== $standarSet) {
            return false;
        }

        $totalPenyerang = (float) $kriterias->sum('bobot_penyerang');
        $totalTengah = (float) $kriterias->sum('bobot_tengah');
        $totalBertahan = (float) $kriterias->sum('bobot_bertahan');

        return $this->isHundred($totalPenyerang)
            && $this->isHundred($totalTengah)
            && $this->isHundred($totalBertahan);
    }

    private function isHundred(float $value): bool
    {
        return abs($value - 100.0) < 0.0001;
    }
}
