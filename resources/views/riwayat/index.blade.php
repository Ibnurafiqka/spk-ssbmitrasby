<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Aktivitas Sistem') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Log aktivitas pengguna
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Success -->
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $totalAktivitas = $penilaians->count();
                    $totalAtlet = \App\Models\Atlet::count();
                    $totalKriteria = \App\Models\Kriteria::count();
                    $aktivitasHariIni = $penilaians->where('updated_at', '>=', \Carbon\Carbon::today())->count();
                @endphp

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Aktivitas</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalAktivitas }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Aktivitas Hari Ini</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $aktivitasHariIni }}</p>
                        </div>
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Atlet</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalAtlet }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Kriteria</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalKriteria }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Filter Riwayat
                    </h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <select id="filterAtlet" class="text-sm border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Semua Atlet</option>
                            @foreach(\App\Models\Atlet::all() as $atlet)
                                <option value="{{ $atlet->id }}">{{ $atlet->nama }}</option>
                            @endforeach
                        </select>
                        <select id="filterKriteria" class="text-sm border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Semua Kriteria</option>
                            @foreach(\App\Models\Kriteria::all() as $kriteria)
                                <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                            @endforeach
                        </select>
                        <button id="resetFilter" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm rounded-lg transition">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat Penilaian -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Riwayat Penilaian Terbaru
                        </h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $penilaians->total() }} entri ditemukan
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Atlet</th>
                                    <th scope="col" class="px-6 py-3">Kriteria</th>
                                    <th scope="col" class="px-6 py-3 text-center">Nilai</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jenis</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penilaians as $penilaian)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                                {{ strtoupper(substr($penilaian->atlet->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold">{{ $penilaian->atlet->nama }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $penilaian->atlet->cabang_olahraga }} • {{ $penilaian->atlet->umur }} th
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs font-mono font-semibold">
                                                {{ $penilaian->kriteria->kode_kriteria }}
                                            </span>
                                            <span class="text-xs text-gray-500">|</span>
                                            <span class="text-sm">{{ $penilaian->kriteria->nama_kriteria }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm font-semibold">
                                            {{ number_format($penilaian->nilai, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $penilaian->kriteria->jenis == 'benefit' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                                            {{ ucfirst($penilaian->kriteria->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs text-gray-500 dark:text-gray-400">
                                        <div class="font-semibold">{{ $penilaian->updated_at->format('d M Y') }}</div>
                                        <div>{{ $penilaian->updated_at->format('H:i') }}</div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $penilaian->updated_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-lg font-medium mb-2">Belum ada data penilaian</p>
                                        <p class="text-sm">Mulai dengan menilai atlet dari menu Penilaian</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($penilaians->hasPages())
                    <div class="mt-4">
                        {{ $penilaians->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-1">Informasi Riwayat</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-400">
                            Halaman ini menampilkan semua aktivitas penilaian yang dilakukan oleh pengguna sistem. 
                            Setiap perubahan nilai atlet akan tercatat secara otomatis untuk keperluan audit dan monitoring.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterAtlet = document.getElementById('filterAtlet');
            const filterKriteria = document.getElementById('filterKriteria');
            const resetFilter = document.getElementById('resetFilter');

            // Simpan state filter di URL
            function updateFilters() {
                const params = new URLSearchParams();
                
                if (filterAtlet.value) {
                    params.set('atlet_id', filterAtlet.value);
                }
                
                if (filterKriteria.value) {
                    params.set('kriteria_id', filterKriteria.value);
                }

                const queryString = params.toString();
                const newUrl = queryString ? `${window.location.pathname}?${queryString}` : window.location.pathname;
                
                window.location.href = newUrl;
            }

            filterAtlet.addEventListener('change', updateFilters);
            filterKriteria.addEventListener('change', updateFilters);

            resetFilter.addEventListener('click', function() {
                window.location.href = window.location.pathname;
            });

            // Set nilai filter dari URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('atlet_id')) {
                filterAtlet.value = urlParams.get('atlet_id');
            }
            if (urlParams.get('kriteria_id')) {
                filterKriteria.value = urlParams.get('kriteria_id');
            }
        });
    </script>
</x-app-layout>