<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Edit Kriteria</h2></x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('kriteria.update', $kriterium->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block mb-1">Kode</label><input type="text" name="kode_kriteria" value="{{ old('kode_kriteria', $kriterium->kode_kriteria) }}" class="w-full rounded border-gray-300" required></div>
                        <div>
                            <label class="block mb-1">Nama Kriteria (9 standar)</label>
                            <select name="nama_kriteria" class="w-full rounded border-gray-300" required>
                                @foreach($namaStandar as $nama)
                                <option value="{{ $nama }}" @selected(old('nama_kriteria', $kriterium->nama_kriteria) === $nama)>{{ ucfirst($nama) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div><label class="block mb-1">Bobot Penyerang (%)</label><input type="number" step="0.01" min="0" max="100" name="bobot_penyerang" value="{{ old('bobot_penyerang', $kriterium->bobot_penyerang) }}" class="w-full rounded border-gray-300" required></div>
                        <div><label class="block mb-1">Bobot Tengah (%)</label><input type="number" step="0.01" min="0" max="100" name="bobot_tengah" value="{{ old('bobot_tengah', $kriterium->bobot_tengah) }}" class="w-full rounded border-gray-300" required></div>
                        <div><label class="block mb-1">Bobot Bertahan (%)</label><input type="number" step="0.01" min="0" max="100" name="bobot_bertahan" value="{{ old('bobot_bertahan', $kriterium->bobot_bertahan) }}" class="w-full rounded border-gray-300" required></div>
                    </div>
                    <div>
                        <label class="block mb-1">Jenis</label>
                        <select name="jenis" class="w-full rounded border-gray-300" required>
                            <option value="benefit" @selected(old('jenis', $kriterium->jenis) == 'benefit')>Benefit</option>
                            <option value="cost" @selected(old('jenis', $kriterium->jenis) == 'cost')>Cost</option>
                        </select>
                    </div>
                    <div><label class="block mb-1">Keterangan</label><textarea name="keterangan" rows="3" class="w-full rounded border-gray-300">{{ old('keterangan', $kriterium->keterangan) }}</textarea></div>
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
                        Komposisi akhir harus tetap 9 kriteria standar dan total bobot tiap posisi tepat 100%.
                    </div>
                    <div class="flex gap-3"><button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button><a href="{{ route('kriteria.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
