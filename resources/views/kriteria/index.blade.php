<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Kriteria Penilaian') }}
            </h2>
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

            <!-- Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gx  ray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3" colspan="6">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                Total: <span class="font-semibold">{{ $kriterias->total() }}</span> kriteria
                                            </div>
                                            <a href="{{ route('kriteria.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out">
                                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Kriteria
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Kode</th>
                                    <th scope="col" class="px-6 py-3">Nama Kriteria</th>
                                    <th scope="col" class="px-6 py-3">Bobot (%)</th>
                                    <th scope="col" class="px-6 py-3">Jenis</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kriterias as $index => $kriteria)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $kriterias->firstItem() + $index }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full font-mono font-semibold">
                                            {{ $kriteria->kode_kriteria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $kriteria->nama_kriteria }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-green-600 dark:text-green-400">{{ $kriteria->bobot }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kriteria->jenis == 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ ucfirst($kriteria->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('kriteria.show', $kriteria->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400" title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            <p class="text-lg font-semibold mb-2">Belum ada data kriteria</p>
                                            <p class="mb-4">Silakan tambahkan kriteria penilaian terlebih dahulu</p>
                                            <a href="{{ route('kriteria.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                                                Tambah Kriteria
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                
                                <!-- Total Bobot Row -->
                                @if($kriterias->count() > 0)
                                <tr class="bg-gray-50 dark:bg-gray-700 border-t-2 border-gray-300 dark:border-gray-600">
                                    <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-900 dark:text-white">
                                        Total Bobot:
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-lg {{ $kriterias->sum('bobot') == 100 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                {{ $kriterias->sum('bobot') }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kriterias->sum('bobot') == 100 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ $kriterias->sum('bobot') == 100 ? '✓ Sesuai' : '⚠️ Tidak Sesuai' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Additional Info Box -->
                    @if($kriterias->count() > 0)
                    <div class="mt-4 p-4 rounded-lg {{ $kriterias->sum('bobot') == 100 ? 'bg-green-50 border border-green-200 dark:bg-green-900/20 dark:border-green-800' : 'bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($kriterias->sum('bobot') == 100)
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-green-800 dark:text-green-200 font-medium">
                                    Total bobot kriteria sudah sesuai (100%)
                                </span>
                                @else
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-red-800 dark:text-red-200 font-medium">
                                    Total bobot kriteria belum sesuai: {{ $kriterias->sum('bobot') }}% (harus 100%)
                                </span>
                                @endif
                            </div>
                            @if($kriterias->sum('bobot') != 100)
                            <span class="text-sm text-red-700 dark:text-red-300">
                                Selisih: {{ abs(100 - $kriterias->sum('bobot')) }}%
                            </span>
                            @endif
                        </div>
                        @if($kriterias->sum('bobot') != 100)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                            Silakan sesuaikan bobot kriteria agar totalnya tepat 100% untuk proses perhitungan yang akurat.
                        </p>
                        @endif
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($kriterias->hasPages())
                    <div class="mt-4">
                        {{ $kriterias->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>