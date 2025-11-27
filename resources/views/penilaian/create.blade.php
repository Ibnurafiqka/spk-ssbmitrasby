<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('penilaian.index') }}" class="me-4 text-gray-600 hover:text-gray-800 dark:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Input Penilaian Atlet') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($kriterias->isEmpty())
            <!-- Alert Kriteria Kosong -->
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-red-800">Kriteria Belum Tersedia</h3>
                        <p class="text-red-700 text-sm">Silakan tambahkan kriteria penilaian terlebih dahulu sebelum melakukan penilaian atlet.</p>
                        <a href="{{ route('kriteria.create') }}" class="inline-block mt-2 text-sm text-red-800 underline hover:text-red-900">
                            Tambah Kriteria →
                        </a>
                    </div>
                </div>
            </div>
            @else

            <!-- Info Atlet -->
            @if($selectedAtlet)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl">
                            {{ strtoupper(substr($selectedAtlet->nama, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedAtlet->nama }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $selectedAtlet->cabang_olahraga }} • {{ $selectedAtlet->jenis_kelamin_lengkap }} • {{ $selectedAtlet->umur }} tahun
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Form Penilaian -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('penilaian.store') }}" method="POST" id="formPenilaian">
                        @csrf

                        <!-- Pilih Atlet (jika belum dipilih) -->
                        @if(!$selectedAtlet)
                        <div class="mb-6">
                            <label for="atlet_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pilih Atlet <span class="text-red-500">*</span>
                            </label>
                            <select name="atlet_id" id="atlet_id" onchange="window.location.href='{{ route('penilaian.create') }}?atlet_id=' + this.value"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                <option value="">-- Pilih Atlet --</option>
                                @foreach($atlets as $atlet)
                                <option value="{{ $atlet->id }}" {{ old('atlet_id') == $atlet->id ? 'selected' : '' }}>
                                    {{ $atlet->nama }} - {{ $atlet->cabang_olahraga }}
                                </option>
                                @endforeach
                            </select>
                            @error('atlet_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <input type="hidden" name="atlet_id" value="{{ $selectedAtlet->id }}">
                        @endif

                        <!-- Daftar Kriteria -->
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Penilaian Kriteria
                            </h4>
                            
                            <div class="space-y-4">
                                @foreach($kriterias as $index => $kriteria)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full text-sm font-mono font-semibold">
                                                    {{ $kriteria->kode_kriteria }}
                                                </span>
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kriteria->jenis == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                                    {{ ucfirst($kriteria->jenis) }}
                                                </span>
                                            </div>
                                            <h5 class="font-semibold text-gray-900 dark:text-white mb-1">
                                                {{ $kriteria->nama_kriteria }}
                                            </h5>
                                            @if($kriteria->keterangan)
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $kriteria->keterangan }}
                                            </p>
                                            @endif
                                        </div>
                                        <div class="text-right ml-4">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Bobot</p>
                                            <p class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $kriteria->bobot }}%</p>
                                        </div>
                                    </div>

                                    <input type="hidden" name="penilaian[{{ $index }}][kriteria_id]" value="{{ $kriteria->id }}">
                                    
                                    <div class="relative">
                                        <input type="number" 
                                            name="penilaian[{{ $index }}][nilai]" 
                                            id="nilai_{{ $kriteria->id }}"
                                            value="{{ old('penilaian.'.$index.'.nilai', $existingPenilaian[$kriteria->id] ?? '') }}" 
                                            step="0.01" 
                                            min="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                            placeholder="Masukkan nilai" 
                                            required>
                                    </div>
                                    @error('penilaian.'.$index.'.nilai')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded-lg dark:bg-blue-900 dark:text-blue-200">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 me-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold mb-1">Catatan Penilaian:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li><strong>Benefit:</strong> Semakin tinggi nilai semakin baik</li>
                                        <li><strong>Cost:</strong> Semakin rendah nilai semakin baik</li>
                                        <li>Pastikan semua kriteria sudah dinilai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-3">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Penilaian
                            </button>
                            <a href="{{ route('penilaian.index') }}" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @endif
        </div>
    </div>
</x-app-layout>