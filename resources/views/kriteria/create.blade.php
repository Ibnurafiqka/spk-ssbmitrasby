<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('kriteria.index') }}" class="me-4 text-gray-600 hover:text-gray-800 dark:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Data Kriteria') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf

                        <!-- Kode Kriteria -->
                        <div class="mb-4">
                            <label for="kode_kriteria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kode Kriteria <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_kriteria" id="kode_kriteria" value="{{ old('kode_kriteria') }}" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('kode_kriteria') border-red-500 @enderror" 
                                placeholder="Contoh: C1, C2, K01" required>
                            @error('kode_kriteria')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Gunakan kode unik seperti C1, C2, dst.</p>
                        </div>

                        <!-- Nama Kriteria -->
                        <div class="mb-4">
                            <label for="nama_kriteria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nama Kriteria <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_kriteria" id="nama_kriteria" value="{{ old('nama_kriteria') }}" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('nama_kriteria') border-red-500 @enderror" 
                                placeholder="Contoh: Kecepatan, Ketahanan Fisik, Teknik" required>
                            @error('nama_kriteria')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bobot -->
                        <div class="mb-4">
                            <label for="bobot" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Bobot (%) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="bobot" id="bobot" value="{{ old('bobot') }}" 
                                    min="0" max="100" step="0.01"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('bobot') border-red-500 @enderror" 
                                    placeholder="25" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400">%</span>
                                </div>
                            </div>
                            @error('bobot')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Total semua bobot harus 100%</p>
                        </div>

                        <!-- Jenis Kriteria -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jenis Kriteria <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-3">
                                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                                    <div class="flex items-center h-5">
                                        <input id="benefit" type="radio" name="jenis" value="benefit" {{ old('jenis') == 'benefit' ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                                    </div>
                                    <div class="ms-3 text-sm">
                                        <label for="benefit" class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                                            Benefit (Keuntungan)
                                        </label>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Semakin besar nilainya semakin baik. Contoh: Kecepatan, Prestasi, Nilai Teknik</p>
                                    </div>
                                </div>
                                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                                    <div class="flex items-center h-5">
                                        <input id="cost" type="radio" name="jenis" value="cost" {{ old('jenis') == 'cost' ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                    <div class="ms-3 text-sm">
                                        <label for="cost" class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                                            Cost (Biaya)
                                        </label>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Semakin kecil nilainya semakin baik. Contoh: Waktu Tempuh, Jumlah Pelanggaran, Biaya</p>
                                    </div>
                                </div>
                            </div>
                            @error('jenis')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('keterangan') border-red-500 @enderror"
                                placeholder="Deskripsi kriteria (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-3">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>