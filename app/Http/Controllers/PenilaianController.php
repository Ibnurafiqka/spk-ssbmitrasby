<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Atlet;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaians = Penilaian::with(['atlet', 'kriteria'])->latest()->paginate(10);
        $atlets = Atlet::all();
        
        return view('penilaian.index', compact('penilaians', 'atlets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $atlet_id = $request->query('atlet_id');
        $atlets = Atlet::all();
        $kriterias = Kriteria::all();
        
        // Jika ada atlet_id, ambil atlet yang dipilih
        $selectedAtlet = $atlet_id ? Atlet::find($atlet_id) : null;
        
        // Cek penilaian yang sudah ada untuk atlet ini
        $existingPenilaian = [];
        if ($selectedAtlet) {
            $existingPenilaian = Penilaian::where('atlet_id', $selectedAtlet->id)
                ->pluck('nilai', 'kriteria_id')
                ->toArray();
        }
        
        return view('penilaian.create', compact('atlets', 'kriterias', 'selectedAtlet', 'existingPenilaian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'atlet_id' => 'required|exists:atlets,id',
            'penilaian' => 'required|array',
            'penilaian.*.kriteria_id' => 'required|exists:kriterias,id',
            'penilaian.*.nilai' => 'required|numeric|min:0',
        ]);

        // Hapus penilaian lama jika ada
        Penilaian::where('atlet_id', $validated['atlet_id'])->delete();

        // Simpan penilaian baru
        foreach ($validated['penilaian'] as $item) {
            Penilaian::create([
                'atlet_id' => $validated['atlet_id'],
                'kriteria_id' => $item['kriteria_id'],
                'nilai' => $item['nilai'],
            ]);
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian atlet berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($atlet_id)
    {
        $atlet = Atlet::findOrFail($atlet_id);
        $penilaians = Penilaian::where('atlet_id', $atlet_id)
            ->with('kriteria')
            ->get();
        
        return view('penilaian.show', compact('atlet', 'penilaians'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($atlet_id)
    {
        $atlet = Atlet::findOrFail($atlet_id);
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::where('atlet_id', $atlet_id)
            ->pluck('nilai', 'kriteria_id')
            ->toArray();
        
        return view('penilaian.edit', compact('atlet', 'kriterias', 'penilaians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $atlet_id)
    {
        $validated = $request->validate([
            'penilaian' => 'required|array',
            'penilaian.*.kriteria_id' => 'required|exists:kriterias,id',
            'penilaian.*.nilai' => 'required|numeric|min:0',
        ]);

        // Hapus penilaian lama
        Penilaian::where('atlet_id', $atlet_id)->delete();

        // Simpan penilaian baru
        foreach ($validated['penilaian'] as $item) {
            Penilaian::create([
                'atlet_id' => $atlet_id,
                'kriteria_id' => $item['kriteria_id'],
                'nilai' => $item['nilai'],
            ]);
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian atlet berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($atlet_id)
    {
        Penilaian::where('atlet_id', $atlet_id)->delete();

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian atlet berhasil dihapus!');
    }
}