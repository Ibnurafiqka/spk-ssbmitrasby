<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Tambah User</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block mb-1">Nama</label><input type="text" name="name" value="{{ old('name') }}" class="w-full rounded border-gray-300" required></div>
                        <div><label class="block mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full rounded border-gray-300" required></div>
                    </div>
                    <div>
                        <label class="block mb-1">Role</label>
                        <select name="role" class="w-full rounded border-gray-300" required>
                            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                            <option value="pelatih" @selected(old('role') == 'pelatih')>Pelatih</option>
                            <option value="orang_tua" @selected(old('role') == 'orang_tua')>Orang Tua</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block mb-1">No Telepon (khusus orang tua)</label><input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full rounded border-gray-300"></div>
                        <div><label class="block mb-1">Alamat (khusus orang tua)</label><input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full rounded border-gray-300"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block mb-1">Password</label><input type="password" name="password" class="w-full rounded border-gray-300" required></div>
                        <div><label class="block mb-1">Konfirmasi Password</label><input type="password" name="password_confirmation" class="w-full rounded border-gray-300" required></div>
                    </div>
                    <div class="flex gap-3"><button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button><a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
