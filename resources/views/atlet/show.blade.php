<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">Detail Atlet</h2></x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $atlet->nama }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <p><strong>Jenis Kelamin:</strong> {{ $atlet->jenis_kelamin_lengkap }}</p>
                    <p><strong>Umur:</strong> {{ $atlet->umur }} tahun</p>
                    <p><strong>Posisi:</strong> {{ $atlet->posisi_label }}</p>
                    <p><strong>Cabang:</strong> {{ $atlet->cabang_olahraga }}</p>
                    <p><strong>Orang Tua/Wali:</strong> {{ $atlet->orangTua?->user?->name ?? '-' }}</p>
                    <p><strong>No Telepon Orang Tua:</strong> {{ $atlet->orangTua?->no_telepon ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h4 class="font-semibold mb-3">Nilai Penilaian</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="border-b dark:border-gray-700"><th class="py-2 text-left">Kriteria</th><th class="py-2 text-left">Nilai</th></tr></thead>
                        <tbody>
                            @forelse($atlet->penilaians as $penilaian)
                            <tr class="border-b dark:border-gray-700"><td class="py-2">{{ $penilaian->kriteria?->nama_kriteria }}</td><td class="py-2">{{ number_format($penilaian->nilai, 2) }}</td></tr>
                            @empty
                            <tr><td colspan="2" class="py-4 text-gray-500">Belum ada penilaian.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
