<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('atlet.index') }}" class="me-4 text-gray-600 hover:text-gray-800 dark:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Data Atlet') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('atlet.update', $atlet->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $atlet->nama) }}" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('nama') border-red-500 @enderror" 
                                placeholder="Masukkan nama lengkap atlet" required>
                            @error('nama')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4">
                                <div class="flex items-center">
                                    <input id="laki-laki" type="radio" name="jenis_kelamin" value="L" 
                                        {{ old('jenis_kelamin', $atlet->jenis_kelamin) == 'L' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                                    <label for="laki-laki" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laki-laki</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="perempuan" type="radio" name="jenis_kelamin" value="P" 
                                        {{ old('jenis_kelamin', $atlet->jenis_kelamin) == 'P' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="perempuan" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
                                </div>
                            </div>
                            @error('jenis_kelamin')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Umur -->
                        <div class="mb-4">
                            <label for="umur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Umur <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="umur" id="umur" 
                                    value="{{ old('umur', $atlet->umur > 0 ? $atlet->umur : '') }}" 
                                    min="5" max="30"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('umur') border-red-500 @enderror" 
                                    placeholder="Masukkan umur atlet" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 text-sm">tahun</span>
                                </div>
                            </div>
                            @error('umur')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                            @if($atlet->umur == 0 || $atlet->umur == null)
                            <p class="mt-1 text-xs text-yellow-600 dark:text-yellow-400">
                                ⚠️ Umur belum diisi. Silakan isi umur atlet (5-30 tahun)
                            </p>
                            @else
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Rentang umur: 5-30 tahun
                            </p>
                            @endif
                        </div>

                        <!-- Cabang Olahraga -->
                        <div class="mb-4">
                            <label for="cabang_olahraga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Cabang Olahraga <span class="text-red-500">*</span>
                            </label>
                            <select name="cabang_olahraga" id="cabang_olahraga"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('cabang_olahraga') border-red-500 @enderror" required>
                                <option value="">-- Pilih Cabang Olahraga --</option>
                                <option value="Sepak Bola" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Sepak Bola' ? 'selected' : '' }}>Sepak Bola</option>
                                <option value="Basket" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Basket' ? 'selected' : '' }}>Basket</option>
                                <option value="Voli" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Voli' ? 'selected' : '' }}>Voli</option>
                                <option value="Bulutangkis" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Bulutangkis' ? 'selected' : '' }}>Bulutangkis</option>
                                <option value="Renang" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Renang' ? 'selected' : '' }}>Renang</option>
                                <option value="Atletik" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Atletik' ? 'selected' : '' }}>Atletik</option>
                                <option value="Pencak Silat" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Pencak Silat' ? 'selected' : '' }}>Pencak Silat</option>
                                <option value="Karate" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Karate' ? 'selected' : '' }}>Karate</option>
                                <option value="Taekwondo" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Taekwondo' ? 'selected' : '' }}>Taekwondo</option>
                                <option value="Lainnya" {{ old('cabang_olahraga', $atlet->cabang_olahraga) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('cabang_olahraga')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No Telepon -->
                        <div class="mb-4">
                            <label for="no_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                No. Telepon
                            </label>
                            <input type="text" name="no_telepon" id="no_telepon" 
                                value="{{ old('no_telepon', $atlet->no_telepon) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('no_telepon') border-red-500 @enderror"
                                placeholder="Contoh: 08123456789">
                            @error('no_telepon')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-6">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Alamat
                            </label>
                            <textarea name="alamat" id="alamat" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('alamat') border-red-500 @enderror"
                                placeholder="Masukkan alamat lengkap">{{ old('alamat', $atlet->alamat) }}</textarea>
                            @error('alamat')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-3">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update
                            </button>
                            <a href="{{ route('atlet.index') }}" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>