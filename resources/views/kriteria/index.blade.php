<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Data Kriteria Penilaian</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>@endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                @if(Auth::user()->role === 'admin')
                <div class="flex justify-end mb-4">
                    <a href="{{ route('kriteria.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Tambah Kriteria</a>
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700 text-left">
                                <th class="py-2">No</th>
                                <th class="py-2">Kode</th>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Penyerang</th>
                                <th class="py-2">Tengah</th>
                                <th class="py-2">Bertahan</th>
                                <th class="py-2">Jenis</th>
                                @if(Auth::user()->role === 'admin')<th class="py-2">Aksi</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kriterias as $index => $kriteria)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $kriterias->firstItem() + $index }}</td>
                                <td class="py-2">{{ $kriteria->kode_kriteria }}</td>
                                <td class="py-2">{{ $kriteria->nama_kriteria }}</td>
                                <td class="py-2">{{ number_format($kriteria->bobot_penyerang, 2) }}%</td>
                                <td class="py-2">{{ number_format($kriteria->bobot_tengah, 2) }}%</td>
                                <td class="py-2">{{ number_format($kriteria->bobot_bertahan, 2) }}%</td>
                                <td class="py-2">{{ ucfirst($kriteria->jenis) }}</td>
                                @if(Auth::user()->role === 'admin')
                                <td class="py-2">
                                    <a href="{{ route('kriteria.show', $kriteria->id) }}" class="text-blue-600">Detail</a>
                                    <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="text-yellow-600 ml-2">Edit</a>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kriteria ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr><td colspan="8" class="py-6 text-center text-gray-500">Belum ada data kriteria.</td></tr>
                            @endforelse
                            @if($kriterias->count() > 0)
                            <tr class="font-semibold bg-gray-50 dark:bg-gray-700">
                                <td colspan="3" class="py-2">Total Bobot</td>
                                <td class="py-2">{{ number_format($kriterias->sum('bobot_penyerang'), 2) }}%</td>
                                <td class="py-2">{{ number_format($kriterias->sum('bobot_tengah'), 2) }}%</td>
                                <td class="py-2">{{ number_format($kriterias->sum('bobot_bertahan'), 2) }}%</td>
                                <td colspan="2" class="py-2 text-xs text-gray-600">Masing-masing posisi idealnya total 100%.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(isset($missingKriteria) && $missingKriteria->isNotEmpty())
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-800">
                    Kriteria yang belum diinput:
                    {{ $missingKriteria->map(fn($n) => ucfirst($n))->implode(', ') }}.
                </div>
                @endif

                <div class="mt-4">{{ $kriterias->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
