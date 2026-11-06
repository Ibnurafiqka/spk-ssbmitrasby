<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Input Penilaian Atlet</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($kriterias->isEmpty())
                <div class="p-4 bg-red-100 text-red-700 rounded">Belum ada data kriteria.</div>
            @else
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('penilaian.store') }}" method="POST" class="space-y-4">
                    @csrf

                    @if(!$selectedAtlet)
                    <div>
                        <label class="block mb-1">Pilih Atlet</label>
                        <select name="atlet_id" onchange="if(this.value){window.location='{{ route('penilaian.create') }}?atlet_id='+this.value}" class="w-full rounded border-gray-300" required>
                            <option value="">-- Pilih Atlet --</option>
                            @foreach($atlets as $atlet)
                            <option value="{{ $atlet->id }}">{{ $atlet->nama }} - {{ $atlet->posisi_label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="atlet_id" value="{{ $selectedAtlet->id }}">
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
                        Menilai atlet: <strong>{{ $selectedAtlet->nama }}</strong> (Posisi: <strong>{{ $selectedAtlet->posisi_label }}</strong>)
                    </div>
                    @endif

                    @foreach($kriterias as $index => $kriteria)
                    <div class="border rounded p-3 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <p class="font-semibold">{{ $kriteria->kode_kriteria }} - {{ $kriteria->nama_kriteria }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst($kriteria->jenis) }}</p>
                            </div>
                            <div class="text-xs text-right text-gray-600">
                                @if($selectedAtlet)
                                <p>Bobot posisi {{ $selectedAtlet->posisi_label }}: <strong>{{ number_format($kriteria->getBobotByPosisi($selectedAtlet->posisi), 2) }}%</strong></p>
                                @else
                                <p>P: {{ number_format($kriteria->bobot_penyerang, 2) }}% | T: {{ number_format($kriteria->bobot_tengah, 2) }}% | B: {{ number_format($kriteria->bobot_bertahan, 2) }}%</p>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="penilaian[{{ $index }}][kriteria_id]" value="{{ $kriteria->id }}">
                        <input type="number" step="0.01" min="0" name="penilaian[{{ $index }}][nilai]" value="{{ old('penilaian.'.$index.'.nilai', $existingPenilaian[$kriteria->id] ?? '') }}" class="w-full rounded border-gray-300" required>
                    </div>
                    @endforeach

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan Penilaian</button>
                        <a href="{{ route('penilaian.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
