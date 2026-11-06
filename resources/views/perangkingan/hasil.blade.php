<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6 mb-0">
                {{ __('Hasil Perangkingan - Metode ARAS') }}
            </h2>
            <a href="{{ route('perangkingan.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Alert Success -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Info Card -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg mb-6 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-white/20 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-1">Perhitungan Selesai!</h3>
                            <p class="text-green-100">
                                Hasil perangkingan {{ count($hasilPerangkingan) }} atlet
                                @if($kelompokUmur && $kelompokUmur != 'all')
                                    <span class="font-semibold">(Kelompok Umur {{ $kelompokUmur }} tahun)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('laporan.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Lihat Laporan
                        </a>
                        <a href="{{ route('laporan.pdf') }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-100 text-green-600 font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistik Visual -->

            {{-- Baris 1: Statistik Ranking Visual & Snapshot Pemenang --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">

                {{-- Kolom 1: Statistik Ranking Visual --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                Statistik Ranking Visual
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Grafik ini menampilkan kekuatan skor akhir setiap atlet berdasarkan nilai Ki.
                            </p>
                        </div>
                        <div class="px-3 py-2 bg-green-50 dark:bg-green-900/20 rounded-lg text-right shrink-0">
                            <p class="text-xs uppercase tracking-wide text-green-700 dark:text-green-300">Top Score</p>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">
                                {{ number_format($hasilPerangkingan[0]['Ki'] * 100, 2) }}%
                            </p>
                        </div>
                    </div>
                    <div id="ranking-chart" class="min-h-[320px]"></div>
                </div>

                {{-- Kolom 2: Snapshot Pemenang --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                        Snapshot Pemenang
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Ringkasan atlet dengan performa terbaik dari hasil perangkingan saat ini.
                    </p>

                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg mb-6 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-white/80">Peringkat #1</p>
                                <h4 class="text-2xl font-bold mt-1">{{ $hasilPerangkingan[0]['atlet']->nama }}</h4>
                                <p class="text-sm text-white/80 mt-1">
                                    {{ ucfirst($hasilPerangkingan[0]['atlet']->posisi) }} •
                                    {{ $hasilPerangkingan[0]['atlet']->umur }} tahun
                                </p>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center text-2xl font-black">
                                1
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-6">
                            <div class="rounded-xl bg-white/10 p-3">
                                <p class="text-xs uppercase tracking-wide text-white/70">Nilai Ki</p>
                                <p class="text-xl font-bold mt-1">
                                    {{ number_format($hasilPerangkingan[0]['Ki'] * 100, 2) }}%</p>
                            </div>
                            <div class="rounded-xl bg-white/10 p-3">
                                <p class="text-xs uppercase tracking-wide text-white/70">Nilai Si</p>
                                <p class="text-xl font-bold mt-1">{{ number_format($hasilPerangkingan[0]['Si'], 4) }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 h-2 rounded-full bg-white/15 overflow-hidden">
                            <div class="h-full rounded-full bg-white"
                                style="width: {{ min(100, $hasilPerangkingan[0]['Ki'] * 100) }}%"></div>
                        </div>
                        <p class="text-xs text-white/80 mt-2">
                            Tingkat utilitas mendekati solusi optimal metode ARAS.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Baris 2: Profil Statistik Atlet (Radar) & Kontribusi Kriteria --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">

                {{-- Kolom 1: Radar Chart Profil Atlet --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                Profil Statistik Atlet
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Pilih atlet untuk melihat grafik gaya permainan dan kontribusi per kriteria.
                            </p>
                        </div>
                        <div class="w-full lg:w-72 shrink-0">
                            <label for="athlete-profile-select"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Pilih Atlet
                            </label>
                            <select id="athlete-profile-select"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500">
                                @foreach($profilAtletChart as $profil)
                                    <option value="{{ $profil['id'] }}" {{ $profil['ranking'] === 1 ? 'selected' : '' }}>
                                        #{{ $profil['ranking'] }} - {{ $profil['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="athlete-radar-chart" class="min-h-[360px]"></div>
                </div>

                {{-- Kolom 2: Info Atlet & Kontribusi Kriteria --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 flex flex-col gap-4">

                    {{-- Info Ringkas Atlet --}}
                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Atlet Aktif</p>
                        <h4 id="athlete-profile-name" class="text-xl font-bold text-gray-900 dark:text-white mt-2"></h4>
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700 p-3 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Ranking</p>
                                <p id="athlete-profile-ranking"
                                    class="text-lg font-bold text-gray-900 dark:text-white mt-1"></p>
                            </div>
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700 p-3 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Ki</p>
                                <p id="athlete-profile-ki"
                                    class="text-lg font-bold text-green-600 dark:text-green-400 mt-1"></p>
                            </div>
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700 p-3 text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Si</p>
                                <p id="athlete-profile-si" class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Kontribusi Kriteria ke Skor --}}
                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex-1">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                            Kontribusi Kriteria ke Skor
                        </h4>
                        <div id="athlete-contribution-chart" class="min-h-[260px]"></div>
                    </div>

                </div>

            </div>

            <!-- Hasil Perangkingan Akhir -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            🏆 Hasil Perangkingan Akhir
                        </h3>
                        @if($kelompokUmur && $kelompokUmur != 'all')
                            <span
                                class="px-4 py-2 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-lg text-sm font-semibold">
                                Kelompok Umur: {{ $kelompokUmur }} tahun
                            </span>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-center">Ranking</th>
                                    <th scope="col" class="px-6 py-4">Nama Atlet</th>
                                    <th scope="col" class="px-6 py-4 text-center">Umur</th>
                                    <th scope="col" class="px-6 py-4">Cabang Olahraga</th>
                                    <th scope="col" class="px-6 py-4 text-center">Nilai Si</th>
                                    <th scope="col" class="px-6 py-4 text-center">Nilai Ki</th>
                                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilPerangkingan as $hasil)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                                                                            {{ $hasil['ranking'] == 1 ? 'bg-yellow-50 dark:bg-yellow-900/20' : '' }}
                                                                            {{ $hasil['ranking'] == 2 ? 'bg-gray-50 dark:bg-gray-900/20' : '' }}
                                                                            {{ $hasil['ranking'] == 3 ? 'bg-orange-50 dark:bg-orange-900/20' : '' }}">
                                        <td class="px-6 py-4 text-center">
                                            @if($hasil['ranking'] == 1)
                                                <div
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 text-white font-bold text-lg shadow-lg">
                                                    1
                                                </div>
                                            @elseif($hasil['ranking'] == 2)
                                                <div
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 text-white font-bold text-lg shadow-lg">
                                                    2
                                                </div>
                                            @elseif($hasil['ranking'] == 3)
                                                <div
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 text-white font-bold text-lg shadow-lg">
                                                    3
                                                </div>
                                            @else
                                                <span
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold">
                                                    {{ $hasil['ranking'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-sm font-bold">
                                                    {{ strtoupper(substr($hasil['atlet']->nama, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 dark:text-white">
                                                        {{ $hasil['atlet']->nama }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs font-semibold">
                                                {{ $hasil['atlet']->umur }} th
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                                            {{ $hasil['atlet']->cabang_olahraga }}
                                        </td>
                                        <td class="px-6 py-4 text-center font-mono text-gray-900 dark:text-white">
                                            {{ number_format($hasil['Si'], 4) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-3 py-1 font-mono font-bold text-sm rounded-full
                                                                                    {{ $hasil['Ki'] >= 0.9 ? 'bg-green-100 text-green-800' : ($hasil['Ki'] >= 0.7 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ number_format($hasil['Ki'], 4) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Tombol Download -->
                                                <a href="{{ route('laporan.individu', ['atlet' => $hasil['atlet']->id, 'action' => 'download']) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition"
                                                    title="Download PDF Individual">
                                                    <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    PDF
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Kesimpulan -->
                    <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>Kesimpulan:</strong>
                            Berdasarkan hasil perhitungan metode ARAS
                            @if($kelompokUmur && $kelompokUmur != 'all')
                                untuk kelompok umur {{ $kelompokUmur }} tahun
                            @endif
                            , atlet dengan peringkat tertinggi adalah
                            <strong
                                class="text-green-700 dark:text-green-400">{{ $hasilPerangkingan[0]['atlet']->nama }}</strong>
                            dengan nilai Ki = <strong>{{ number_format($hasilPerangkingan[0]['Ki'], 4) }}</strong>.
                            <br>Sehingga <strong>{{ $hasilPerangkingan[0]['atlet']->nama }}</strong> sangat cocok
                            mengisi posisi
                            <strong>{{ $hasilPerangkingan[0]['atlet']->posisi }}</strong>.</br>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Detail Perhitungan (Collapsible) -->
            <div class="space-y-4">

                <!-- Matrix Keputusan -->
                <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <summary
                        class="px-6 py-4 cursor-pointer font-semibold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                        📊 1. Matrix Keputusan
                    </summary>
                    <div class="px-6 pb-6">
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-xs border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Alternatif
                                        </th>
                                        @foreach($kriterias as $kriteria)
                                            <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-gray-900 dark:text-white">
                                    @foreach($matrixKeputusan as $index => $row)
                                        <tr
                                            class="{{ $index == 0 ? 'bg-yellow-50 dark:bg-yellow-900/20 font-semibold' : '' }}">
                                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $index == 0 ? 'A0 (Optimal)' : 'A' . $index . ' - ' . $row['atlet']->nama }}
                                            </td>
                                            @foreach($kriterias as $kriteria)
                                                <td class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-center">
                                                    {{ number_format($row['C' . $kriteria->id], 2) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>

                <!-- Matrix Normalisasi -->
                <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <summary
                        class="px-6 py-4 cursor-pointer font-semibold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                        📐 2. Matrix Normalisasi
                    </summary>
                    <div class="px-6 pb-6">
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-xs border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Alternatif
                                        </th>
                                        @foreach($kriterias as $kriteria)
                                            <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-gray-900 dark:text-white">
                                    @foreach($matrixNormalisasi as $index => $row)
                                        <tr
                                            class="{{ $index == 0 ? 'bg-yellow-50 dark:bg-yellow-900/20 font-semibold' : '' }}">
                                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $index == 0 ? 'A0 (Optimal)' : 'A' . $index . ' - ' . $row['atlet']->nama }}
                                            </td>
                                            @foreach($kriterias as $kriteria)
                                                <td class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-center">
                                                    {{ number_format($row['C' . $kriteria->id], 4) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>

                <!-- Matrix Terbobot -->
                <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <summary
                        class="px-6 py-4 cursor-pointer font-semibold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                        ⚖️ 3. Matrix Terbobot
                    </summary>
                    <div class="px-6 pb-6">
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-xs border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">Alternatif
                                        </th>
                                        @foreach($kriterias as $kriteria)
                                            <th class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $kriteria->kode_kriteria }}<br>
                                                <span class="text-xs text-gray-500">({{ $kriteria->bobot }}%)</span>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-gray-900 dark:text-white">
                                    @foreach($matrixTerbobot as $index => $row)
                                        <tr
                                            class="{{ $index == 0 ? 'bg-yellow-50 dark:bg-yellow-900/20 font-semibold' : '' }}">
                                            <td class="border border-gray-300 dark:border-gray-600 px-3 py-2">
                                                {{ $index == 0 ? 'A0 (Optimal)' : 'A' . $index . ' - ' . $row['atlet']->nama }}
                                            </td>
                                            @foreach($kriterias as $kriteria)
                                                <td class="border border-gray-300 dark:border-gray-600 px-3 py-2 text-center">
                                                    {{ number_format($row['C' . $kriteria->id], 4) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>

                <!-- Nilai Optimality Function -->
                <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <summary
                        class="px-6 py-4 cursor-pointer font-semibold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                        🎯 4. Nilai Optimality Function (Si) dan Utility Degree (Ki)
                    </summary>
                    <div class="px-6 pb-6">
                        <div class="mt-4 space-y-4">
                            <!-- Nilai S0 -->
                            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 rounded">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                    Nilai Optimality Function Optimal (S0)
                                </p>
                                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                    {{ number_format($s0, 4) }}
                                </p>
                            </div>

                            <!-- Tabel Si dan Ki -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
                                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3">Ranking
                                            </th>
                                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3">Atlet</th>
                                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3">Nilai Si
                                            </th>
                                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3">Nilai Ki
                                                (Si/S0)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilPerangkingan as $hasil)
                                            <tr
                                                class="text-gray-900 dark:text-white {{ $hasil['ranking'] <= 3 ? 'bg-green-50 dark:bg-green-900/20' : '' }}">
                                                <td
                                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold">
                                                    {{ $hasil['ranking'] }}
                                                </td>
                                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-3">
                                                    {{ $hasil['atlet']->nama }}
                                                </td>
                                                <td
                                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-mono">
                                                    {{ number_format($hasil['Si'], 4) }}
                                                </td>
                                                <td
                                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-mono font-bold">
                                                    {{ number_format($hasil['Ki'], 4) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Rumus Penjelasan -->
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 rounded">
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    <strong>Rumus:</strong> Ki = Si / S0<br>
                                    <strong>Keterangan:</strong><br>
                                    • Ki = Utility Degree (Nilai akhir untuk perangkingan)<br>
                                    • Si = Jumlah dari nilai terbobot untuk setiap alternatif<br>
                                    • S0 = Nilai optimal ({{ number_format($s0, 4) }})<br>
                                    • Semakin besar nilai Ki, semakin baik alternatif tersebut
                                </p>
                            </div>
                        </div>
                    </div>
                </details>

            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex items-center justify-between p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Perhitungan Selesai!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Anda dapat melihat laporan lengkap atau melakukan perhitungan ulang dengan data yang berbeda.
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('perangkingan.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Hitung Ulang
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof ApexCharts === 'undefined') {
                    return;
                }

                const rankingChartData = @json($rankingChart);
                const athleteProfiles = @json($profilAtletChart);
                const profileSelect = document.getElementById('athlete-profile-select');
                const profileName = document.getElementById('athlete-profile-name');
                const profileRanking = document.getElementById('athlete-profile-ranking');
                const profileKi = document.getElementById('athlete-profile-ki');
                const profileSi = document.getElementById('athlete-profile-si');

                const rankingChartEl = document.getElementById('ranking-chart');
                const radarChartEl = document.getElementById('athlete-radar-chart');
                const contributionChartEl = document.getElementById('athlete-contribution-chart');

                let radarChart;
                let contributionChart;

                if (rankingChartEl) {
                    const rankingChart = new ApexCharts(rankingChartEl, {
                        chart: {
                            type: 'bar',
                            height: 320,
                            toolbar: { show: false },
                            fontFamily: 'Figtree, sans-serif',
                        },
                        series: [{
                            name: 'Nilai Ki (%)',
                            data: rankingChartData.series,
                        }],
                        colors: ['#16a34a'],
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 6,
                                distributed: true,
                                barHeight: '70%',
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (value) {
                                return value.toFixed(2) + '%';
                            }
                        },
                        xaxis: {
                            categories: rankingChartData.labels,
                            max: 100,
                            labels: {
                                formatter: function (value) {
                                    return value + '%';
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                maxWidth: 220,
                            }
                        },
                        grid: {
                            borderColor: '#e5e7eb',
                            strokeDashArray: 4,
                        },
                        legend: { show: false },
                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return value.toFixed(2) + '%';
                                }
                            }
                        }
                    });

                    rankingChart.render();
                }

                function buildRadarChart(profile) {
                    if (!radarChartEl) {
                        return;
                    }

                    if (radarChart) {
                        radarChart.destroy();
                    }

                    radarChart = new ApexCharts(radarChartEl, {
                        chart: {
                            type: 'radar',
                            height: 360,
                            toolbar: { show: false },
                            fontFamily: 'Figtree, sans-serif',
                        },
                        series: [{
                            name: 'Profil Performa (%)',
                            data: profile.profil,
                        }],
                        labels: profile.labels,
                        colors: ['#0f766e'],
                        stroke: {
                            width: 2,
                        },
                        fill: {
                            opacity: 0.25,
                        },
                        markers: {
                            size: 4,
                            colors: ['#0f766e'],
                            strokeColors: '#fff',
                            strokeWidth: 2,
                        },
                        yaxis: {
                            min: 0,
                            max: 100,
                            tickAmount: 5,
                            labels: {
                                formatter: function (value) {
                                    return value + '%';
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return value.toFixed(2) + '%';
                                }
                            }
                        }
                    });

                    radarChart.render();
                }

                function buildContributionChart(profile) {
                    if (!contributionChartEl) {
                        return;
                    }

                    if (contributionChart) {
                        contributionChart.destroy();
                    }

                    contributionChart = new ApexCharts(contributionChartEl, {
                        chart: {
                            type: 'bar',
                            height: 260,
                            toolbar: { show: false },
                            fontFamily: 'Figtree, sans-serif',
                        },
                        series: [{
                            name: 'Kontribusi',
                            data: profile.kontribusi,
                        }],
                        colors: ['#2563eb'],
                        plotOptions: {
                            bar: {
                                borderRadius: 4,
                                columnWidth: '55%',
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        xaxis: {
                            categories: profile.labels,
                            labels: {
                                rotate: -45,
                            }
                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    return value.toFixed(2);
                                }
                            }
                        },
                        grid: {
                            borderColor: '#e5e7eb',
                            strokeDashArray: 4,
                        },
                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return value.toFixed(4);
                                }
                            }
                        },
                        legend: { show: false },
                    });

                    contributionChart.render();
                }

                function updateProfile(profileId) {
                    const selectedProfile = athleteProfiles.find(function (item) {
                        return String(item.id) === String(profileId);
                    }) || athleteProfiles[0];

                    if (!selectedProfile) {
                        return;
                    }

                    profileName.textContent = selectedProfile.nama;
                    profileRanking.textContent = '#' + selectedProfile.ranking;
                    profileKi.textContent = selectedProfile.ki.toFixed(2) + '%';
                    profileSi.textContent = selectedProfile.si.toFixed(4);

                    buildRadarChart(selectedProfile);
                    buildContributionChart(selectedProfile);
                }

                if (profileSelect && athleteProfiles.length > 0) {
                    updateProfile(profileSelect.value);

                    profileSelect.addEventListener('change', function (event) {
                        updateProfile(event.target.value);
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>