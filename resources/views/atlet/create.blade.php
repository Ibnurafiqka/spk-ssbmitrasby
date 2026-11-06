<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Tambah Data Atlet</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('atlet.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-1">Nama Atlet</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full rounded border-gray-300" required>
                        @error('nama')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full rounded border-gray-300" required>
                                <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1">Umur</label>
                            <input type="number" min="5" max="30" name="umur" value="{{ old('umur') }}" class="w-full rounded border-gray-300" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">Posisi</label>
                            <select name="posisi" class="w-full rounded border-gray-300" required>
                                <option value="">-- Pilih Posisi --</option>
                                <option value="penyerang" @selected(old('posisi') == 'penyerang')>Penyerang</option>
                                <option value="tengah" @selected(old('posisi') == 'tengah')>Tengah</option>
                                <option value="bertahan" @selected(old('posisi') == 'bertahan')>Bertahan</option>
                            </select>
                            @error('posisi')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block mb-1">Orang Tua/Wali</label>
                            <select name="orang_tua_id" class="w-full rounded border-gray-300">
                                <option value="">-- Tidak Dipilih --</option>
                                @foreach($orangTuas as $orangTua)
                                <option value="{{ $orangTua->id }}" @selected(old('orang_tua_id') == $orangTua->id)>
                                    {{ $orangTua->user?->name }}{{ $orangTua->no_telepon ? ' - ' . $orangTua->no_telepon : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('orang_tua_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1">Cabang Olahraga</label>
                        <input type="text" name="cabang_olahraga" value="{{ old('cabang_olahraga', 'Sepak Bola') }}" class="w-full rounded border-gray-300" required>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
                        <a href="{{ route('atlet.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
