<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Tambah Orang Tua/Wali</h2></x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="{{ route('orang-tua.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-1">Akun User Orang Tua</label>
                        <select name="user_id" class="w-full rounded border-gray-300" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block mb-1">No Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full rounded border-gray-300">
                    </div>
                    <div>
                        <label class="block mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full rounded border-gray-300">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
                        <a href="{{ route('orang-tua.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

