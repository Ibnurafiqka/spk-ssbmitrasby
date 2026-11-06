<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->paginate(10);
        $namaStandar = Kriteria::NAMA_STANDAR;
        $namaTerpakai = Kriteria::pluck('nama_kriteria')->map(fn ($n) => strtolower(trim($n)))->all();
        $missingKriteria = collect($namaStandar)->reject(fn ($nama) => in_array($nama, $namaTerpakai, true))->values();

        return view('kriteria.index', compact('kriterias', 'missingKriteria'));
    }

    public function create()
    {
        $namaStandar = Kriteria::NAMA_STANDAR;
        $kriterias = Kriteria::all()->keyBy(fn ($item) => strtolower(trim($item->nama_kriteria)));

        $bobotByPosisi = [
            'penyerang' => [],
            'tengah' => [],
            'bertahan' => [],
        ];

        foreach ($namaStandar as $nama) {
            $kriteria = $kriterias->get($nama);
            $bobotByPosisi['penyerang'][$nama] = $kriteria?->bobot_penyerang ?? 0;
            $bobotByPosisi['tengah'][$nama] = $kriteria?->bobot_tengah ?? 0;
            $bobotByPosisi['bertahan'][$nama] = $kriteria?->bobot_bertahan ?? 0;
        }

        return view('kriteria.create', compact('namaStandar', 'bobotByPosisi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'posisi' => 'required|in:penyerang,tengah,bertahan',
            'bobot' => 'required|array|size:9',
            'bobot.*' => 'required|numeric|min:0|max:100',
        ]);

        $totalBobot = collect($validated['bobot'])->sum(fn ($v) => (float) $v);
        if (!$this->isHundred((float) $totalBobot)) {
            throw ValidationException::withMessages([
                'bobot' => "Total bobot untuk posisi {$validated['posisi']} harus 100%. Saat ini {$totalBobot}%.",
            ]);
        }

        $kodeMap = [
            'dribbling' => 'C1',
            'passing' => 'C2',
            'shooting' => 'C3',
            'heading' => 'C4',
            'positioning' => 'C5',
            'stamina' => 'C6',
            'agility' => 'C7',
            'komunikasi' => 'C8',
            'sprint' => 'C9',
        ];

        foreach (Kriteria::NAMA_STANDAR as $nama) {
            $kriteria = Kriteria::firstOrNew(['nama_kriteria' => $nama]);

            if (!$kriteria->exists) {
                $kriteria->kode_kriteria = $kodeMap[$nama];
                $kriteria->jenis = 'benefit';
                $kriteria->keterangan = ucfirst($nama);
                $kriteria->bobot_penyerang = 0;
                $kriteria->bobot_tengah = 0;
                $kriteria->bobot_bertahan = 0;
            }

            $kolomBobot = 'bobot_' . $validated['posisi'];
            $kriteria->{$kolomBobot} = (float) $validated['bobot'][$nama];
            $kriteria->save();
        }

        return redirect()->route('kriteria.index')
            ->with('success', 'Bobot kriteria untuk posisi ' . $validated['posisi'] . ' berhasil disimpan.');
    }

    public function show(Kriteria $kriterium)
    {
        return view('kriteria.show', compact('kriterium'));
    }

    public function edit(Kriteria $kriterium)
    {
        $namaStandar = Kriteria::NAMA_STANDAR;
        return view('kriteria.edit', compact('kriterium', 'namaStandar'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|string|max:10|unique:kriterias,kode_kriteria,' . $kriterium->id,
            'nama_kriteria' => 'required|string|in:' . implode(',', Kriteria::NAMA_STANDAR) . '|unique:kriterias,nama_kriteria,' . $kriterium->id,
            'bobot_penyerang' => 'required|numeric|min:0|max:100',
            'bobot_tengah' => 'required|numeric|min:0|max:100',
            'bobot_bertahan' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost',
            'keterangan' => 'nullable|string',
        ]);

        $this->validateKomposisiKriteria($validated, $kriterium->id);

        $kriterium->update($validated);

        return redirect()->route('kriteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui!');
    }

    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Data kriteria berhasil dihapus!');
    }

    private function validateKomposisiKriteria(array $data, ?int $excludeId): void
    {
        $query = Kriteria::query();
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existing = $query->get();
        $countAfter = $existing->count() + 1;

        $totalPenyerang = (float) $existing->sum('bobot_penyerang') + (float) $data['bobot_penyerang'];
        $totalTengah = (float) $existing->sum('bobot_tengah') + (float) $data['bobot_tengah'];
        $totalBertahan = (float) $existing->sum('bobot_bertahan') + (float) $data['bobot_bertahan'];

        if ($totalPenyerang > 100 || $totalTengah > 100 || $totalBertahan > 100) {
            throw ValidationException::withMessages([
                'bobot_penyerang' => "Total bobot posisi tidak boleh lebih dari 100%. Saat ini: penyerang {$totalPenyerang}%, tengah {$totalTengah}%, bertahan {$totalBertahan}%.",
            ]);
        }

        if ($countAfter === count(Kriteria::NAMA_STANDAR)) {
            $namaSet = $existing->pluck('nama_kriteria')->map(fn ($n) => strtolower(trim($n)))->push(strtolower(trim($data['nama_kriteria'])))->unique()->sort()->values()->all();
            $standarSet = collect(Kriteria::NAMA_STANDAR)->map(fn ($n) => strtolower(trim($n)))->sort()->values()->all();

            if ($namaSet !== $standarSet) {
                throw ValidationException::withMessages([
                    'nama_kriteria' => 'Saat jumlah kriteria sudah 9, daftar nama harus tepat: dribbling, passing, shooting, heading, positioning, stamina, agility, komunikasi, sprint.',
                ]);
            }

            if (!$this->isHundred($totalPenyerang) || !$this->isHundred($totalTengah) || !$this->isHundred($totalBertahan)) {
                throw ValidationException::withMessages([
                    'bobot_penyerang' => "Saat kriteria lengkap 9, total bobot tiap posisi harus tepat 100%. Saat ini: penyerang {$totalPenyerang}%, tengah {$totalTengah}%, bertahan {$totalBertahan}%.",
                ]);
            }
        }
    }

    private function isHundred(float $value): bool
    {
        return abs($value - 100.0) < 0.0001;
    }
}
