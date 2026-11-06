<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Data Orang Tua/Wali</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('orang-tua.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Tambah Orang Tua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700 text-left">
                                <th class="py-2">No</th>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">No Telepon</th>
                                <th class="py-2">Jumlah Anak</th>
                                <th class="py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orangTuas as $index => $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $orangTuas->firstItem() + $index }}</td>
                                <td class="py-2">{{ $item->user?->name ?? '-' }}</td>
                                <td class="py-2">{{ $item->user?->email ?? '-' }}</td>
                                <td class="py-2">{{ $item->no_telepon ?? '-' }}</td>
                                <td class="py-2">{{ $item->atlets->count() }}</td>
                                <td class="py-2 text-center">
                                    <a href="{{ route('orang-tua.edit', $item->id) }}" class="text-yellow-600">Edit</a>
                                    <form action="{{ route('orang-tua.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada data orang tua.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $orangTuas->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

