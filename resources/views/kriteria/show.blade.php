<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Detail Kriteria</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-3">{{ $kriterium->nama_kriteria }} ({{ $kriterium->kode_kriteria }})</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <p><strong>Jenis:</strong> {{ ucfirst($kriterium->jenis) }}</p>
                    <p><strong>Keterangan:</strong> {{ $kriterium->keterangan ?: '-' }}</p>
                    <p><strong>Bobot Penyerang:</strong> {{ number_format($kriterium->bobot_penyerang, 2) }}%</p>
                    <p><strong>Bobot Tengah:</strong> {{ number_format($kriterium->bobot_tengah, 2) }}%</p>
                    <p><strong>Bobot Bertahan:</strong> {{ number_format($kriterium->bobot_bertahan, 2) }}%</p>
                    <p><strong>Dipakai pada penilaian:</strong> {{ $kriterium->penilaians->count() }} data</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
