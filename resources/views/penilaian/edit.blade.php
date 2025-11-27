<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('penilaian.index') }}" class="me-4 text-gray-600 hover:text-gray-800 dark:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Penilaian Atlet') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Atlet -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl">
                                {{ strtoupper(substr($atlet->nama, 0, 2)) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $atlet->nama }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $atlet->cabang_olahraga }} • {{ $atlet->jenis_kelamin_lengkap }} • {{ $atlet->umur }} tahun
                                </p>
                            </div>
                        </div>
                        <form action="{{ route('penilaian.destroy', $atlet->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus semua penilaian atlet ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4 inline me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Semua
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Form Edit Penilaian -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('penilaian.update', $atlet->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Daftar Kriteria -->
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Edit Penilaian Kriteria
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
                                            value="{{ old('penilaian.'.$index.'.nilai', $penilaians[$kriteria->id] ?? '') }}" 
                                            step="0.01" 
                                            min="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
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
                        <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 rounded-lg dark:bg-yellow-900 dark:text-yellow-200">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 me-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold mb-1">Perhatian:</p>
                                    <p>Perubahan nilai akan mengganti semua penilaian sebelumnya untuk atlet ini.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-3">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Penilaian
                            </button>
                            <a href="{{ route('penilaian.index') }}" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>