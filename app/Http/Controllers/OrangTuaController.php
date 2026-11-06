<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index()
    {
        $orangTuas = OrangTua::with(['user', 'atlets'])->latest()->paginate(10);

        return view('orang_tua_index', compact('orangTuas'));
    }

    public function create()
    {
        $users = User::where('role', 'orang_tua')
            ->whereDoesntHave('orangTua')
            ->orderBy('name')
            ->get();

        return view('orang_tua_create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:orang_tuas,user_id',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        OrangTua::create($validated);

        return redirect()->route('orang-tua.index')->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    public function edit(OrangTua $orang_tua)
    {
        $users = User::where('role', 'orang_tua')
            ->where(function ($query) use ($orang_tua) {
                $query->whereDoesntHave('orangTua')
                    ->orWhere('id', $orang_tua->user_id);
            })
            ->orderBy('name')
            ->get();

        return view('orang_tua_edit', [
            'orangTua' => $orang_tua,
            'users' => $users,
        ]);
    }

    public function update(Request $request, OrangTua $orang_tua)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:orang_tuas,user_id,' . $orang_tua->id,
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $orang_tua->update($validated);

        return redirect()->route('orang-tua.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function destroy(OrangTua $orang_tua)
    {
        $orang_tua->delete();

        return redirect()->route('orang-tua.index')->with('success', 'Data orang tua berhasil dihapus.');
    }
}
