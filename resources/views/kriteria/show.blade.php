<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('kriteria.index') }}" class="me-4 text-gray-600 hover:text-gray-800 dark:text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Detail Kriteria') }}
                </h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('kriteria.edit', $kriterium->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('kriteria.destroy', $kriterium->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card Header Info -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-start gap-6">
                        <!-- Icon -->
                        <div class="shrink-0">
                            <div class="w-20 h-20 rounded-lg bg-gradient-to-br {{ $kriterium->jenis == 'benefit' ? 'from-green-500 to-emerald-600' : 'from-orange-500 to-red-600' }} flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                {{ $kriterium->kode_kriteria }}
                            </div>
                        </div>

                        <!-- Info Utama -->
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $kriterium->nama_kriteria }}
                                    </h3>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $kriterium->jenis == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ ucfirst($kriterium->jenis) }}
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            Dibuat: {{ $kriterium->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Progress Bar Bobot -->
                            <div class="mt-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Bobot Kriteria</span>
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $kriterium->bobot }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-4 rounded-full transition-all duration-500 flex items-center justify-end pr-2" style="width: {{ $kriterium->bobot }}%">
                                        @if($kriterium->bobot > 15)
                                        <span class="text-xs text-white font-semibold">{{ $kriterium->bobot }}%</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Detail Lengkap -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2">
                        Informasi Detail
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Kode Kriteria -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Kode Kriteria</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white font-mono">
                                        {{ $kriterium->kode_kriteria }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Bobot Decimal -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Bobot (Desimal)</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">
                                        {{ number_format($kriterium->bobot / 100, 3) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Kriteria Detail -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg md:col-span-2">
                            <div class="flex items-start gap-3">
                                <div class="p-2 {{ $kriterium->jenis == 'benefit' ? 'bg-green-100 dark:bg-green-900' : 'bg-orange-100 dark:bg-orange-900' }} rounded-lg">
                                    <svg class="w-6 h-6 {{ $kriterium->jenis == 'benefit' ? 'text-green-600 dark:text-green-400' : 'text-orange-600 dark:text-orange-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($kriterium->jenis == 'benefit')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                                        @endif
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jenis Kriteria</p>
                                    <p class="font-bold text-gray-900 dark:text-white mb-2">
                                        {{ ucfirst($kriterium->jenis) }} 
                                        <span class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                            ({{ $kriterium->jenis == 'benefit' ? 'Keuntungan' : 'Biaya' }})
                                        </span>
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        @if($kriterium->jenis == 'benefit')
                                        <strong>Benefit:</strong> Semakin besar nilai kriteria ini, semakin baik penilaian atlet. Kriteria ini menguntungkan jika nilainya tinggi.
                                        @else
                                        <strong>Cost:</strong> Semakin kecil nilai kriteria ini, semakin baik penilaian atlet. Kriteria ini menguntungkan jika nilainya rendah.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Keterangan -->
            @if($kriterium->keterangan)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Keterangan
                    </h4>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $kriterium->keterangan }}
                    </p>
                </div>
            </div>
            @endif

            <!-- Card Statistik Penggunaan -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2">
                        Statistik Penggunaan
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Jumlah Penilaian -->
                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg">
                            <svg class="w-8 h-8 mx-auto mb-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $kriterium->penilaians->count() }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah Penilaian</p>
                        </div>

                        <!-- Terakhir Digunakan -->
                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg">
                            <svg class="w-8 h-8 mx-auto mb-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-lg font-bold text-purple-600 dark:text-purple-400">
                                {{ $kriterium->penilaians->count() > 0 ? $kriterium->penilaians->max('updated_at')->diffForHumans() : '-' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Terakhir Digunakan</p>
                        </div>

                        <!-- Status -->
                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg">
                            <svg class="w-8 h-8 mx-auto mb-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">Aktif</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Status Kriteria</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>