<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">
            Dashboard Orang Tua
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Ringkasan Anak</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Total anak terdaftar: <strong>{{ $atlets->count() }}</strong>
                </p>
                <a href="{{ route('laporan.orang-tua') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Lihat Nilai dan Download Rapor
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

