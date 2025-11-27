<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use Illuminate\Http\Request;

class AtletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atlets = Atlet::latest()->paginate(10);
        return view('atlet.index', compact('atlets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('atlet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'umur' => 'required|integer|min:5|max:30',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'cabang_olahraga' => 'required|string|max:100',
        ]);

        Atlet::create($validated);

        return redirect()->route('atlet.index')
            ->with('success', 'Data atlet berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atlet $atlet)
    {
        return view('atlet.show', compact('atlet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atlet $atlet)
    {
        return view('atlet.edit', compact('atlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atlet $atlet)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'umur' => 'required|integer|min:5|max:30',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'cabang_olahraga' => 'required|string|max:100',
            
        ]);

        $atlet->update($validated);

        return redirect()->route('atlet.index')
            ->with('success', 'Data atlet berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atlet $atlet)
    {
        $atlet->delete();

        return redirect()->route('atlet.index')
            ->with('success', 'Data atlet berhasil dihapus!');
    }
}