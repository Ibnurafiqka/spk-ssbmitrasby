<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = Penilaian::with(['atlet', 'kriteria'])
            ->latest();

        // Filter by atlet
        if ($request->has('atlet_id') && $request->atlet_id) {
            $query->where('atlet_id', $request->atlet_id);
        }

        // Filter by kriteria
        if ($request->has('kriteria_id') && $request->kriteria_id) {
            $query->where('kriteria_id', $request->kriteria_id);
        }

        $penilaians = $query->paginate(20);

        return view('riwayat.index', compact('penilaians'));
    }
}