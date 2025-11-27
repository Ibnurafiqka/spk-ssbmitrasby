<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Penilaian Atlet') }}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Success -->
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Tabel Data Atlet untuk Penilaian -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Daftar Atlet untuk Penilaian
                        </h3>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $atlets->count() }} Atlet
                        </div>
                        <a href="{{ route('atlet.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Atlet
                        </a>
                    </div>

                    @if($atlets->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Atlet</th>
                                    {{-- <th scope="col" class="px-6 py-3">Cabang Olahraga</th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">Umur</th>
                                    <th scope="col" class="px-6 py-3 text-center">Status Penilaian</th>
                                    <th scope="col" class="px-6 py-3 text-center">Progress</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atlets as $index => $atlet)
                                @php
                                    $penilaianCount = \App\Models\Penilaian::where('atlet_id', $atlet->id)->count();
                                    $kriteriaCount = \App\Models\Kriteria::count();
                                    $isComplete = $penilaianCount == $kriteriaCount && $kriteriaCount > 0;
                                    $percentage = $kriteriaCount > 0 ? ($penilaianCount / $kriteriaCount) * 100 : 0;
                                @endphp
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($atlet->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">{{ $atlet->nama }}</div>
                                                {{-- <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $atlet->id }}</div> --}}
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-blue-200 rounded text-xs font-medium">
                                            {{ $atlet->cabang_olahraga }}
                                        </span>
                                    </td> --}}
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-xs font-semibold">
                                            {{ $atlet->umur }} Tahun
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($isComplete)
                                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs font-semibold">
                                            <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Lengkap
                                        </span>
                                        @elseif($penilaianCount > 0)
                                        <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-xs font-semibold">
                                            <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Belum Lengkap
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full text-xs font-semibold">
                                            <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Belum Dinilai
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1">
                                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                                                    <div class="h-2 rounded-full {{ $isComplete ? 'bg-green-600' : ($penilaianCount > 0 ? 'bg-yellow-500' : 'bg-red-500') }}" 
                                                         style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium w-12 text-right">
                                                {{ $penilaianCount }}/{{ $kriteriaCount }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            @if($isComplete)
                                            {{-- <a href="{{ route('penilaian.show', $atlet->id) }}"  --}} <a href="#"
                                               class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition"
                                               title="Lihat Penilaian">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('penilaian.edit', $atlet->id) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-lg transition"
                                               title="Edit Penilaian">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            @else
                                            <a href="{{ route('penilaian.create', ['atlet_id' => $atlet->id]) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition"
                                               title="Input Penilaian">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Information -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @php
                            $totalAtlets = $atlets->count();
                            $completeCount = 0;
                            $incompleteCount = 0;
                            $notStartedCount = 0;
                            
                            foreach($atlets as $atlet) {
                                $penilaianCount = \App\Models\Penilaian::where('atlet_id', $atlet->id)->count();
                                $kriteriaCount = \App\Models\Kriteria::count();
                                $isComplete = $penilaianCount == $kriteriaCount && $kriteriaCount > 0;
                                
                                if($isComplete) {
                                    $completeCount++;
                                } elseif($penilaianCount > 0) {
                                    $incompleteCount++;
                                } else {
                                    $notStartedCount++;
                                }
                            }
                        @endphp
                        
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $completeCount }}</p>
                                    <p class="text-sm text-green-800 dark:text-green-200">Penilaian Lengkap</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-yellow-100 dark:bg-yellow-800 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $incompleteCount }}</p>
                                    <p class="text-sm text-yellow-800 dark:text-yellow-200">Belum Lengkap</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-red-100 dark:bg-red-800 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $notStartedCount }}</p>
                                    <p class="text-sm text-red-800 dark:text-red-200">Belum Dinilai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada data atlet</p>
                        <a href="{{ route('atlet.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Atlet Pertama
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>