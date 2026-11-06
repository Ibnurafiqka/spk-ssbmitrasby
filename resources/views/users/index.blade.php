<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Manajemen User</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>@endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Tambah User</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700 text-left">
                                <th class="py-2">No</th>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Role</th>
                                <th class="py-2">Terdaftar</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $users->firstItem() + $index }}</td>
                                <td class="py-2">{{ $user->name }}</td>
                                <td class="py-2">{{ $user->email }}</td>
                                <td class="py-2">{{ str_replace('_', ' ', ucfirst($user->role)) }}</td>
                                <td class="py-2">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="py-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600">Edit</a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada data user.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
