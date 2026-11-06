<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Kriteria;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $hasilPerangkingan = session('hasil_perangkingan');
        $kriterias = Kriteria::all();

        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perangkingan. Silakan lakukan perhitungan terlebih dahulu!');
        }

        return view('laporan.index', compact('hasilPerangkingan', 'kriterias'));
    }

    public function print()
    {
        $hasilPerangkingan = session('hasil_perangkingan');
        $kriterias = Kriteria::all();
        $matrixKeputusan = session('matrix_keputusan');

        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perangkingan!');
        }

        return view('laporan.print', compact('hasilPerangkingan', 'kriterias', 'matrixKeputusan'));
    }

    public function exportPdf()
    {
        $hasilPerangkingan = session('hasil_perangkingan');
        $kriterias = Kriteria::all();
        $matrixKeputusan = session('matrix_keputusan');
        $matrixNormalisasi = session('matrix_normalisasi');
        $matrixTerbobot = session('matrix_terbobot');
        $s0 = session('s0');

        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perangkingan!');
        }

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'hasilPerangkingan',
            'kriterias',
            'matrixKeputusan',
            'matrixNormalisasi',
            'matrixTerbobot',
            's0'
        ));

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ]);

        return $pdf->download('laporan-perangkingan-' . date('Y-m-d-His') . '.pdf');
    }

    public function previewPdf()
    {
        $hasilPerangkingan = session('hasil_perangkingan');
        $kriterias = Kriteria::all();
        $matrixKeputusan = session('matrix_keputusan');
        $matrixNormalisasi = session('matrix_normalisasi');
        $matrixTerbobot = session('matrix_terbobot');
        $s0 = session('s0');

        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perangkingan!');
        }

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'hasilPerangkingan',
            'kriterias',
            'matrixKeputusan',
            'matrixNormalisasi',
            'matrixTerbobot',
            's0'
        ));

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-perangkingan.pdf');
    }

    public function orangTua()
    {
        $orangTua = auth()->user()->orangTua()->with('atlets')->first();
        $atlets = $orangTua?->atlets ?? collect();

        return view('laporan.orang-tua', compact('atlets'));
    }

    public function individu($atletId)
    {
        $atlet = Atlet::with(['orangTua.user', 'penilaians.kriteria'])->findOrFail($atletId);
        $this->authorizeAksesAtlet($atlet);

        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $nilaiMap = $atlet->penilaians->keyBy('kriteria_id');
        $rekomendasi = $this->hitungRekomendasiDariAtlet($atlet);

        $pdf = Pdf::loadView('laporan.individu', compact(
            'atlet',
            'kriterias',
            'nilaiMap',
            'rekomendasi'
        ));

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ]);

        $namaFile = 'Rapor_Atlet_' . str_replace(' ', '_', $atlet->nama) . '_' . date('Y-m-d-His') . '.pdf';

        if (request('action') === 'download') {
            return $pdf->download($namaFile);
        }

        return $pdf->stream($namaFile);
    }

    private function authorizeAksesAtlet(Atlet $atlet): void
    {
        $user = auth()->user();
        if (!$user->isOrangTua()) {
            return;
        }

        $orangTua = $user->orangTua;
        if (!$orangTua || $atlet->orang_tua_id !== $orangTua->id) {
            abort(403, 'Anda tidak memiliki akses ke data atlet ini.');
        }
    }

    private function hitungRekomendasiDariAtlet(Atlet $atlet): array
    {
        $skor = [
            'penyerang' => 0.0,
            'tengah' => 0.0,
            'bertahan' => 0.0,
        ];

        foreach ($atlet->penilaians as $penilaian) {
            $kriteria = $penilaian->kriteria;
            $nilai = (float) $penilaian->nilai;

            foreach (array_keys($skor) as $posisi) {
                $bobot = $kriteria->getBobotByPosisi($posisi) / 100;
                $kontribusi = $kriteria->jenis === 'cost'
                    ? ($nilai > 0 ? ($bobot / $nilai) : 0)
                    : ($nilai * $bobot);
                $skor[$posisi] += $kontribusi;
            }
        }

        arsort($skor);
        $posisiTerbaik = array_key_first($skor);

        return [
            'posisi' => $posisiTerbaik,
            'skor' => $skor[$posisiTerbaik] ?? 0,
            'detail' => $skor,
        ];
    }
}
