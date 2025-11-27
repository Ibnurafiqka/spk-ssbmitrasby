<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Print laporan
     */
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

    /**
     * Export laporan ke PDF
     */
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

        // Load view dan convert ke PDF
        $pdf = Pdf::loadView('laporan.pdf', compact(
            'hasilPerangkingan',
            'kriterias',
            'matrixKeputusan',
            'matrixNormalisasi',
            'matrixTerbobot',
            's0'
        ));

        // Set paper size dan orientasi
        $pdf->setPaper('a4', 'portrait');
        
        // Set options untuk DomPDF
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif'
        ]);

        // Download PDF dengan nama file
        return $pdf->download('laporan-perangkingan-' . date('Y-m-d-His') . '.pdf');
    }

    /**
     * Stream/Preview PDF di browser
     */
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

        // Stream PDF (tampil di browser)
        return $pdf->stream('laporan-perangkingan.pdf');
    }

    /**
     * Export laporan individu atlet ke PDF
     */
    public function individu($atletId)
    {
        // Ambil data atlet
        $atlet = Atlet::findOrFail($atletId);
        
        // Ambil data dari session
        $hasilPerangkingan = session('hasil_perangkingan');
        $kriterias = Kriteria::all();
        $matrixKeputusan = session('matrix_keputusan');
        $matrixNormalisasi = session('matrix_normalisasi');
        $matrixTerbobot = session('matrix_terbobot');
        $s0 = session('s0');
        
        // Validasi data tersedia
        if (!$hasilPerangkingan) {
            return redirect()->route('perangkingan.index')
                ->with('error', 'Belum ada hasil perangkingan. Silakan lakukan perhitungan terlebih dahulu!');
        }
        
        // Cari data hasil atlet yang dipilih
        $hasilAtlet = collect($hasilPerangkingan)->firstWhere('atlet.id', $atletId);
        
        if (!$hasilAtlet) {
            return redirect()->route('laporan.index')
                ->with('error', 'Data atlet tidak ditemukan dalam hasil perangkingan.');
        }
        
        // Ambil nilai atlet per kriteria dari matrix keputusan
        $nilaiAtlet = collect($matrixKeputusan)->firstWhere(function($item) use ($atletId) {
            return $item['atlet'] && $item['atlet']->id == $atletId;
        });
        
        if (!$nilaiAtlet) {
            return redirect()->route('laporan.index')
                ->with('error', 'Data nilai atlet tidak ditemukan.');
        }
        
        // Load view dan convert ke PDF
        $pdf = Pdf::loadView('laporan.individu', compact(
            'atlet',
            'hasilAtlet',
            'nilaiAtlet',
            'kriterias',
            'matrixKeputusan',
            'matrixNormalisasi',
            'matrixTerbobot',
            's0',
            'hasilPerangkingan'
        ));
        
        // Set paper size dan orientasi
        $pdf->setPaper('a4', 'portrait');
        
        // Set options untuk DomPDF
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif'
        ]);
        
        // Generate nama file
        $namaFile = 'Laporan_Individu_' . str_replace(' ', '_', $atlet->nama) . '_' . date('Y-m-d-His') . '.pdf';
        
        // Download PDF
        return $pdf->download($namaFile);
    }
}