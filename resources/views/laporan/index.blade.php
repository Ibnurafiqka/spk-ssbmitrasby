<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Laporan Perangkingan') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('perangkingan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Perangkingan
                </a>
                <a href="{{ route('laporan.pdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition" target="_blank">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg dark:bg-blue-900/20">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-500 me-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="font-semibold text-blue-800 dark:text-blue-200 mb-1">Laporan Hasil Perangkingan</h3>
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            Laporan ini menampilkan hasil perangkingan atlet beserta evaluasi detail untuk setiap atlet. 
                            Anda dapat mengunduh laporan dalam format PDF untuk dokumentasi atau presentasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistik Ringkas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Atlet</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ count($hasilPerangkingan) }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Kriteria</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $kriterias->count() }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Juara 1</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white truncate">
                                {{ $hasilPerangkingan[0]['atlet']->nama ?? '-' }}
                            </p>
                        </div>
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Peringkat -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Hasil Perangkingan Lengkap
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Rank</th>
                                    <th class="px-6 py-3 text-left">Nama Atlet</th>
                                    <th class="px-6 py-3">Cabang</th>
                                    <th class="px-6 py-3">Nilai Si</th>
                                    <th class="px-6 py-3">Nilai Ki</th>
                                    <th class="px-6 py-3">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilPerangkingan as $hasil)
                                <tr class="border-b dark:border-gray-700 {{ $hasil['ranking'] <= 3 ? 'bg-yellow-50 dark:bg-yellow-900/20' : 'bg-white dark:bg-gray-800' }} hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $hasil['ranking'] == 1 ? 'bg-yellow-400 text-yellow-900' : ($hasil['ranking'] == 2 ? 'bg-gray-300 text-gray-900' : ($hasil['ranking'] == 3 ? 'bg-orange-400 text-orange-900' : 'bg-gray-200 text-gray-700')) }} font-bold text-lg">
                                            {{ $hasil['ranking'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $hasil['atlet']->nama }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $hasil['atlet']->jenis_kelamin_lengkap }}, {{ $hasil['atlet']->umur }} tahun
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">
                                        {{ $hasil['atlet']->cabang_olahraga }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-blue-600 dark:text-blue-400 font-semibold">
                                        {{ number_format($hasil['Si'], 4) }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-purple-600 dark:text-purple-400 font-bold">
                                        {{ number_format($hasil['Ki'], 4) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full" style="width: {{ $hasil['Ki'] * 100 }}%"></div>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                                {{ number_format($hasil['Ki'] * 100, 1) }}%
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Informasi Laporan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Metode Perhitungan:</strong></p>
                        <p class="text-gray-900 dark:text-white">ARAS (Additive Ratio Assessment)</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Tanggal Perhitungan:</strong></p>
                        <p class="text-gray-900 dark:text-white">{{ date('d F Y, H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Format Laporan:</strong></p>
                        <p class="text-gray-900 dark:text-white">PDF dengan evaluasi detail per atlet</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Dibuat oleh:</strong></p>
                        <p class="text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg p-6 text-white text-center">
                <h3 class="text-xl font-bold mb-2">Siap Mengunduh Laporan?</h3>
                <p class="mb-4 text-blue-100">
                    Laporan PDF akan mencakup hasil perangkingan lengkap dan evaluasi detail untuk setiap atlet
                </p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('laporan.pdf') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-gray-100 transition" target="_blank">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Laporan PDF
                    </a>
                    <a href="{{ route('laporan.print') }}" class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm border-2 border-white text-white font-semibold rounded-lg hover:bg-white/20 transition" target="_blank">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Preview
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>