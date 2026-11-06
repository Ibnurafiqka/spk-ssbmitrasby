<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Edit Penilaian Atlet</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="p-3 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800 mb-4">
                    Atlet: <strong>{{ $atlet->nama }}</strong> (Posisi: <strong>{{ $atlet->posisi_label }}</strong>)
                </div>

                <form action="{{ route('penilaian.update', $atlet->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @foreach($kriterias as $index => $kriteria)
                    <div class="border rounded p-3 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <p class="font-semibold">{{ $kriteria->kode_kriteria }} - {{ $kriteria->nama_kriteria }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst($kriteria->jenis) }}</p>
                            </div>
                            <div class="text-xs text-gray-600">Bobot {{ $atlet->posisi_label }}: <strong>{{ number_format($kriteria->getBobotByPosisi($atlet->posisi), 2) }}%</strong></div>
                        </div>
                        <input type="hidden" name="penilaian[{{ $index }}][kriteria_id]" value="{{ $kriteria->id }}">
                        <input type="number" step="0.01" min="0" name="penilaian[{{ $index }}][nilai]" value="{{ old('penilaian.'.$index.'.nilai', $penilaians[$kriteria->id] ?? '') }}" class="w-full rounded border-gray-300" required>
                    </div>
                    @endforeach

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update Penilaian</button>
                        <a href="{{ route('penilaian.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
