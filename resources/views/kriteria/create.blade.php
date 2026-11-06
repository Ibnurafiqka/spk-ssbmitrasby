<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Input Bobot Kriteria per Posisi</h2></x-slot>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('kriteria.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-1">Posisi</label>
                        <select name="posisi" id="posisi" class="w-full rounded border-gray-300" required>
                            <option value="penyerang" @selected(old('posisi', 'penyerang') === 'penyerang')>Penyerang</option>
                            <option value="tengah" @selected(old('posisi') === 'tengah')>Tengah</option>
                            <option value="bertahan" @selected(old('posisi') === 'bertahan')>Bertahan</option>
                        </select>
                        @error('posisi')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-2 text-left">Kriteria</th>
                                    <th class="py-2 text-left">Bobot (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($namaStandar as $nama)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-2">{{ ucfirst($nama) }}</td>
                                    <td class="py-2">
                                        <input type="number"
                                            step="0.01"
                                            min="0"
                                            max="100"
                                            name="bobot[{{ $nama }}]"
                                            data-kriteria="{{ $nama }}"
                                            value="{{ old('bobot.'.$nama, $bobotByPosisi['penyerang'][$nama] ?? 0) }}"
                                            class="w-full rounded border-gray-300"
                                            required>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('bobot')<p class="text-sm text-red-600">{{ $message }}</p>@enderror

                    <div class="p-3 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
                        Isi bobot 9 kriteria untuk posisi terpilih. Total bobot wajib tepat 100%.
                    </div>
                    <div class="flex gap-3"><button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button><a href="{{ route('kriteria.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a></div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const bobotByPosisi = @json($bobotByPosisi);
        const posisiSelect = document.getElementById('posisi');
        const inputs = document.querySelectorAll('input[data-kriteria]');
        const initialOldPosisi = @json(old('posisi'));
        const hasOldValue = {!! old('bobot') ? 'true' : 'false' !!};

        posisiSelect.addEventListener('change', function () {
            if (hasOldValue && initialOldPosisi) return;
            const posisi = this.value;
            inputs.forEach((input) => {
                const nama = input.getAttribute('data-kriteria');
                const value = bobotByPosisi[posisi]?.[nama] ?? 0;
                input.value = value;
            });
        });
    </script>
</x-app-layout>
