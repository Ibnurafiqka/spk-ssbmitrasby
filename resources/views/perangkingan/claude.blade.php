<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perangkingan Atlet - Metode ARAS') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert -->
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

            @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Filter Kelompok Umur -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter Kelompok Umur
                    </h3>
                    
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Pilih kelompok umur untuk membandingkan atlet yang setara. Perangkingan akan dilakukan pada atlet dalam kelompok yang sama.
                    </p>

                    <form id="filterForm" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Kelompok Umur 8-11 -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="kelompok_umur" value="8-11" class="peer sr-only" 
                                {{ request('kelompok_umur') == '8-11' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 hover:border-gray-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-3xl">🏃‍♂️</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $jumlahPerKelompok['8-11'] ?? 0 }} Atlet
                                    </span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">Kelompok Junior</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Umur 8-11 tahun</p>
                            </div>
                        </label>

                        <!-- Kelompok Umur 12-15 -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="kelompok_umur" value="12-15" class="peer sr-only"
                                {{ request('kelompok_umur') == '12-15' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg transition-all peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 hover:border-gray-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-3xl">🏃</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ $jumlahPerKelompok['12-15'] ?? 0 }} Atlet
                                    </span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">Kelompok Remaja</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Umur 12-15 tahun</p>
                            </div>
                        </label>

                        <!-- Kelompok Umur 16-18 -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="kelompok_umur" value="16-18" class="peer sr-only"
                                {{ request('kelompok_umur') == '16-18' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg transition-all peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/20 hover:border-gray-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-3xl">🏃‍♀️</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        {{ $jumlahPerKelompok['16-18'] ?? 0 }} Atlet
                                    </span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">Kelompok Senior</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Umur 16-18 tahun</p>
                            </div>
                        </label>

                        <!-- Semua Kelompok -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="kelompok_umur" value="all" class="peer sr-only"
                                {{ !request('kelompok_umur') || request('kelompok_umur') == 'all' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 hover:border-gray-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-3xl">🏆</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                        {{ array_sum($jumlahPerKelompok) }} Atlet
                                    </span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">Semua Kelompok</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Semua umur</p>
                            </div>
                        </label>
                    </form>
                </div>
            </div>

            <!-- Card Data Atlet Lengkap -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Atlet dengan Penilaian Lengkap
                            @if(request('kelompok_umur') && request('kelompok_umur') != 'all')
                                <span class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    (Kelompok Umur {{ request('kelompok_umur') }} tahun)
                                </span>
                            @endif
                        </h3>

                        @if(request('kelompok_umur') && request('kelompok_umur') != 'all')
                        <a href="{{ route('perangkingan.index') }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset Filter
                        </a>
                        @endif
                    </div>
                    
                    @if(count($atletLengkap) > 0)
                    
                    <!-- Info Checkbox Selection -->
                    <div class="mb-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white mb-1">Mode Seleksi Atlet</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Pilih atlet yang ingin Anda bandingkan dengan mencentang checkbox di sebelah kiri nama atlet. 
                                    Anda dapat memilih beberapa atlet sekaligus untuk diproses perhitungan perangkingannya.
                                </p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Atlet terpilih: </span>
                                    <span id="selectedCount" class="px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded text-sm font-semibold">
                                        0
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="formPerhitungan" action="{{ route('perangkingan.hitung') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kelompok_umur" value="{{ request('kelompok_umur', 'all') }}">
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center gap-2">
                                                <input type="checkbox" id="selectAll" 
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="selectAll" class="cursor-pointer">Pilih Semua</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">No</th>
                                        <th scope="col" class="px-6 py-3">Nama Atlet</th>
                                        <th scope="col" class="px-6 py-3 text-center">Umur</th>
                                        <th scope="col" class="px-6 py-3">Cabang Olahraga</th>
                                        <th scope="col" class="px-6 py-3 text-center">Jumlah Kriteria</th>
                                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atletLengkap as $index => $atlet)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors athlete-row">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" name="atlet_ids[]" value="{{ $atlet->id }}" 
                                                class="athlete-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </td>
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                                    {{ strtoupper(substr($atlet->nama, 0, 2)) }}
                                                </div>
                                                {{ $atlet->nama }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs font-semibold">
                                                {{ $atlet->umur }} th
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $atlet->cabang_olahraga }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                                {{ $kriterias->count() }} Kriteria
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                                ✓ Lengkap
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Button Proses -->
                        <div class="mt-6 flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">Siap untuk diproses!</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <span id="processingInfo">
                                            Pilih minimal 2 atlet untuk memulai perhitungan
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <button type="submit" id="btnProses" disabled
                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:shadow-none">
                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Proses Perhitungan ARAS
                            </button>
                        </div>
                    </form>

                    @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            @if(request('kelompok_umur') && request('kelompok_umur') != 'all')
                                Tidak Ada Atlet di Kelompok Umur {{ request('kelompok_umur') }} Tahun
                            @else
                                Belum Ada Data yang Siap
                            @endif
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                            @if(request('kelompok_umur') && request('kelompok_umur') != 'all')
                                Tidak ada atlet dengan penilaian lengkap di kelompok umur ini. Coba pilih kelompok umur yang lain.
                            @else
                                Pastikan semua atlet sudah memiliki penilaian lengkap untuk semua kriteria sebelum melakukan perhitungan perangkingan.
                            @endif
                        </p>
                        <div class="flex gap-3 justify-center">
                            @if(request('kelompok_umur') && request('kelompok_umur') != 'all')
                            <a href="{{ route('perangkingan.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Lihat Semua Kelompok
                            </a>
                            @endif
                            <a href="{{ route('atlet.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">
                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Kelola Data Atlet
                            </a>
                            <a href="{{ route('penilaian.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Input Penilaian
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Info Kriteria -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Kriteria Penilaian yang Digunakan</h3>
                    
                    @if($kriterias->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($kriterias as $kriteria)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs font-mono font-semibold">
                                            {{ $kriteria->kode_kriteria }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $kriteria->jenis == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ ucfirst($kriteria->jenis) }}
                                        </span>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-1">{{ $kriteria->nama_kriteria }}</h4>
                                </div>
                                <div class="text-right ml-3">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Bobot</p>
                                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $kriteria->bobot }}%</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada kriteria penilaian</p>
                        <a href="{{ route('kriteria.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            Tambah Kriteria
                        </a>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript untuk Filter dan Checkbox -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter Kelompok Umur
            const filterForm = document.getElementById('filterForm');
            const radioButtons = filterForm.querySelectorAll('input[type="radio"]');
            
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedValue = this.value;
                    const currentUrl = new URL(window.location.href);
                    
                    if (selectedValue === 'all') {
                        currentUrl.searchParams.delete('kelompok_umur');
                    } else {
                        currentUrl.searchParams.set('kelompok_umur', selectedValue);
                    }
                    
                    window.location.href = currentUrl.toString();
                });
            });

            // Checkbox Selection
            const selectAllCheckbox = document.getElementById('selectAll');
            const athleteCheckboxes = document.querySelectorAll('.athlete-checkbox');
            const selectedCountSpan = document.getElementById('selectedCount');
            const btnProses = document.getElementById('btnProses');
            const processingInfo = document.getElementById('processingInfo');

            // Function to update selected count and button state
            function updateSelectedCount() {
                const checkedCount = document.querySelectorAll('.athlete-checkbox:checked').length;
                selectedCountSpan.text