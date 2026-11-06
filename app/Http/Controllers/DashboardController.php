<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin');
    }

    public function pelatih()
    {
        return view('dashboard.pelatih');
    }

    public function orangTua(Request $request)
    {
        $orangTua = $request->user()->orangTua()->with('atlets.penilaians.kriteria')->first();

        return view('dashboard.orang-tua', [
            'orangTua' => $orangTua,
            'atlets' => $orangTua?->atlets ?? collect(),
        ]);
    }
}

