<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6 mb-0">
            {{ __('Dashboard Pelatih') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card - Simple -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold mb-2">Selamat Datang, Pelatih!</h1>
                            <p class="text-green-100 opacity-90">
                                Gunakan sistem ini untuk menilai dan meranking pemain SSB Mitra Surabaya
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $totalAtlet = \App\Models\Atlet::count();
                    $totalKriteria = \App\Models\Kriteria::count();
                    $atletLengkap = \App\Models\Atlet::whereHas('penilaians', function($q) {
                        $q->whereIn('kriteria_id', \App\Models\Kriteria::pluck('id'));
                    }, '=', \App\Models\Kriteria::count())->count();
                    $atletBelumDinilai = $totalAtlet - $atletLengkap;
                @endphp

                <!-- Total Pemain -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg mr-4">
                            <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAtlet }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Pemain</p>
                        </div>
                    </div>
                </div>

                <!-- Pemain Sudah Dinilai -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg mr-4">
                            <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $atletLengkap }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Sudah Dinilai</p>
                        </div>
                    </div>
                </div>

                <!-- Pemain Belum Dinilai -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg mr-4">
                            <svg class="w-7 h-7 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $atletBelumDinilai }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Belum Dinilai</p>
                        </div>
                    </div>
                </div>

                <!-- Kriteria Penilaian -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg mr-4">
                            <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalKriteria }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kriteria Penilaian</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Progress Bar -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Progress Penilaian Pemain
                </h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pemain yang sudah dinilai lengkap
                            </span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $totalAtlet > 0 ? round(($atletLengkap/$totalAtlet)*100, 1) : 0 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" 
                                 style="width: {{ $totalAtlet > 0 ? ($atletLengkap/$totalAtlet)*100 : 0 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        @if($atletBelumDinilai > 0)
                            <p>⚠️ Masih ada <span class="font-semibold">{{ $atletBelumDinilai }}</span> pemain yang belum dinilai.</p>
                        @else
                            <p>✅ Semua pemain sudah dinilai dengan lengkap.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Simple Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Input Penilaian -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Input Penilaian</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Beri nilai pada pemain</p>
                        </div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Berikan penilaian untuk setiap pemain berdasarkan kriteria yang sudah ditentukan.
                    </p>
                    <a href="{{ route('penilaian.index') }}" class="inline-flex items-center justify-center w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                        Mulai Input Penilaian
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- Lihat Ranking -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Lihat Ranking</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Hasil peringkat pemain</p>
                        </div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Lihat hasil perangkingan pemain berdasarkan penilaian yang sudah diberikan.
                    </p>
                    <a href="{{ route('perangkingan.index') }}" class="inline-flex items-center justify-center w-full py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                        Lihat Hasil Ranking
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Simple Info & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Panduan Singkat -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📝 Panduan Singkat</h3>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                            <p class="text-gray-700 dark:text-gray-300">Klik <strong>"Mulai Input Penilaian"</strong> untuk menilai pemain</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                            <p class="text-gray-700 dark:text-gray-300">Beri nilai untuk setiap pemain sesuai kriteria</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-purple-500 text-white rounded-full flex items-center justify-center text-sm font-bold">3</div>
                            <p class="text-gray-700 dark:text-gray-300">Setelah selesai, klik <strong>"Lihat Hasil Ranking"</strong></p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center text-sm font-bold">4</div>
                            <p class="text-gray-700 dark:text-gray-300">Sistem akan otomatis menghitung ranking terbaik</p>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🕐 Penilaian Terbaru</h3>
                    <div class="space-y-3">
                        @php
                            $recentPenilaians = \App\Models\Penilaian::with(['atlet', 'kriteria'])
                                ->latest()
                                ->take(4)
                                ->get();
                        @endphp

                        @forelse($recentPenilaians as $penilaian)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($penilaian->atlet->nama, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $penilaian->atlet->nama }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $penilaian->kriteria->nama_kriteria }} • Nilai: {{ number_format($penilaian->nilai, 1) }}
                                </p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $penilaian->updated_at->format('d/m') }}
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p>Belum ada penilaian</p>
                            <p class="text-sm">Mulai dengan menginput penilaian pemain</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Simple System Info -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">ℹ️ Informasi Sistem</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="font-medium text-gray-900 dark:text-white">Sistem Aktif</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Sistem penilaian siap digunakan</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="font-medium text-gray-900 dark:text-white">Metode ARAS</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Perhitungan ranking otomatis</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span class="font-medium text-gray-900 dark:text-white">Data Aman</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Penilaian tersimpan dengan aman</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>