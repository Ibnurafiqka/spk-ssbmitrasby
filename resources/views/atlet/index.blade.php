<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Data Atlet</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('atlet.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Tambah Atlet</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700 text-left">
                                <th class="py-2">No</th>
                                <th class="py-2">Nama</th>
                                <th class="py-2">JK</th>
                                <th class="py-2">Umur</th>
                                <th class="py-2">Posisi</th>
                                <th class="py-2">Orang Tua/Wali</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($atlets as $index => $atlet)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $atlets->firstItem() + $index }}</td>
                                <td class="py-2">{{ $atlet->nama }}</td>
                                <td class="py-2">{{ $atlet->jenis_kelamin }}</td>
                                <td class="py-2">{{ $atlet->umur }} tahun</td>
                                <td class="py-2">{{ $atlet->posisi_label }}</td>
                                <td class="py-2">{{ $atlet->orangTua?->user?->name ?? '-' }}</td>
                                <td class="py-2">
                                    <a href="{{ route('atlet.show', $atlet->id) }}" class="text-blue-600">Detail</a>
                                    <a href="{{ route('atlet.edit', $atlet->id) }}" class="text-yellow-600 ml-2">Edit</a>
                                    <form action="{{ route('atlet.destroy', $atlet->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data atlet ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="py-6 text-center text-gray-500">Belum ada data atlet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $atlets->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
