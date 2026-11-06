<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Nilai Anak & Rapor PDF</h2></x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="border-b dark:border-gray-700"><th class="py-2 text-left">Nama Atlet</th><th class="py-2 text-left">Posisi</th><th class="py-2 text-left">Umur</th><th class="py-2 text-center">Aksi</th></tr></thead>
                        <tbody>
                            @forelse($atlets as $atlet)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $atlet->nama }}</td>
                                <td class="py-2">{{ $atlet->posisi_label }}</td>
                                <td class="py-2">{{ $atlet->umur }} tahun</td>
                                <td class="py-2 text-center">
                                    <a href="{{ route('laporan.individu', ['atlet' => $atlet->id]) }}" class="text-blue-600">Preview PDF</a>
                                    <a href="{{ route('laporan.individu', ['atlet' => $atlet->id, 'action' => 'download']) }}" class="text-green-600 ml-3">Download</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="py-6 text-center text-gray-500">Belum ada data atlet yang terhubung ke akun Anda.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
