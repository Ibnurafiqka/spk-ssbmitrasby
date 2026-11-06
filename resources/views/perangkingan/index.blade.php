<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6 mb-0">
            {{ __('Perangkingan Atlet - Metode ARAS') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="md:col-span-1">
                            <label for="kelompokUmurSelect" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Umur</label>
                            <select id="kelompokUmurSelect" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="8-11" {{ ($kelompokUmur ?? request('kelompok_umur', 'all')) === '8-11' ? 'selected' : '' }}>Umur 8-11</option>
                                <option value="12-15" {{ ($kelompokUmur ?? request('kelompok_umur', 'all')) === '12-15' ? 'selected' : '' }}>Umur 12-15</option>
                                <option value="16-18" {{ ($kelompokUmur ?? request('kelompok_umur', 'all')) === '16-18' ? 'selected' : '' }}>Umur 16-18</option>
                                <option value="all" {{ ($kelompokUmur ?? request('kelompok_umur', 'all')) === 'all' ? 'selected' : '' }}>Semua Umur</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ request()->fullUrlWithQuery(['posisi' => ($filterPosisi ?? 'all') == 'penyerang' ? 'all' : 'penyerang']) }}" class="block p-4 rounded-lg border transition-all {{ ($filterPosisi ?? 'all') == 'penyerang' ? 'border-red-500 bg-red-100 dark:border-red-500 dark:bg-red-800/40 ring-2 ring-red-400' : 'border-red-200 bg-red-50 dark:border-red-800 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-800/30' }}">
                            <p class="text-sm text-red-700 dark:text-red-300">Posisi Penyerang</p>
                            <p class="text-2xl font-bold text-red-800 dark:text-red-200">{{ $jumlahPerPosisi['penyerang'] ?? 0 }}</p>
                            <p class="text-xs text-red-600 dark:text-red-300">Atlet dengan penilaian lengkap</p>
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['posisi' => ($filterPosisi ?? 'all') == 'tengah' ? 'all' : 'tengah']) }}" class="block p-4 rounded-lg border transition-all {{ ($filterPosisi ?? 'all') == 'tengah' ? 'border-blue-500 bg-blue-100 dark:border-blue-500 dark:bg-blue-800/40 ring-2 ring-blue-400' : 'border-blue-200 bg-blue-50 dark:border-blue-800 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-800/30' }}">
                            <p class="text-sm text-blue-700 dark:text-blue-300">Posisi Tengah</p>
                            <p class="text-2xl font-bold text-blue-800 dark:text-blue-200">{{ $jumlahPerPosisi['tengah'] ?? 0 }}</p>
                            <p class="text-xs text-blue-600 dark:text-blue-300">Atlet dengan penilaian lengkap</p>
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['posisi' => ($filterPosisi ?? 'all') == 'bertahan' ? 'all' : 'bertahan']) }}" class="block p-4 rounded-lg border transition-all {{ ($filterPosisi ?? 'all') == 'bertahan' ? 'border-emerald-500 bg-emerald-100 dark:border-emerald-500 dark:bg-emerald-800/40 ring-2 ring-emerald-400' : 'border-emerald-200 bg-emerald-50 dark:border-emerald-800 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-800/30' }}">
                            <p class="text-sm text-emerald-700 dark:text-emerald-300">Posisi Bertahan</p>
                            <p class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">{{ $jumlahPerPosisi['bertahan'] ?? 0 }}</p>
                            <p class="text-xs text-emerald-600 dark:text-emerald-300">Atlet dengan penilaian lengkap</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atlet dengan Penilaian Lengkap {{ ($filterPosisi ?? request('posisi', 'all')) !== 'all' ? '- Posisi ' . ucfirst($filterPosisi) : '' }}</h3>
                        @if(($kelompokUmur ?? request('kelompok_umur', 'all')) !== 'all' || ($filterPosisi ?? request('posisi', 'all')) !== 'all')
                        <a href="{{ route('perangkingan.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Reset Filter</a>
                        @endif
                    </div>

                    @if(count($atletLengkap) > 0)
                    <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600 dark:text-gray-300">Centang atlet yang ingin dibandingkan (minimal 2 atlet).</p>
                            <div class="flex items-center gap-4">
                                <button type="button" id="selectAllBtn" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Pilih Semua</button>
                                <button type="button" id="deselectAllBtn" class="text-sm text-gray-600 hover:text-gray-800 font-medium">Batal Semua</button>
                            </div>
                        </div>
                        <div id="selectedInfo" class="mt-3 hidden">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold text-sm" id="selectedCount">0</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">atlet terpilih</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3 w-12"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nama Atlet</th>
                                    <th class="px-6 py-3 text-center">Umur</th>
                                    <th class="px-6 py-3 text-center">Posisi</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atletLengkap as $index => $atlet)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-4"><input type="checkbox" name="selected_atlets[]" value="{{ $atlet->id }}" class="atlet-checkbox w-4 h-4"></td>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $atlet->nama }}</td>
                                    <td class="px-6 py-4 text-center">{{ $atlet->umur }} th</td>
                                    <td class="px-6 py-4 text-center">{{ $atlet->posisi_label }}</td>
                                    <td class="px-6 py-4 text-center"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Lengkap</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <p class="text-sm text-gray-700 dark:text-gray-300"><span id="totalAtletCount">{{ count($atletLengkap) }}</span> atlet siap dihitung metode ARAS.</p>
                        <div class="flex gap-3">
                            <form id="selectedAtletsForm" action="{{ route('perangkingan.hitung.selected') }}" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="kelompok_umur" value="{{ $kelompokUmur ?? request('kelompok_umur', 'all') }}">
                                <input type="hidden" name="posisi" value="{{ $filterPosisi ?? request('posisi', 'all') }}">
                                <input type="hidden" name="selected_atlets" id="selectedAtletsInput">
                                <button type="submit" id="calculateSelectedBtn" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg">Hitung Atlet Terpilih</button>
                            </form>

                            <form action="{{ route('perangkingan.hitung') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kelompok_umur" value="{{ $kelompokUmur ?? request('kelompok_umur', 'all') }}">
                                <input type="hidden" name="posisi" value="{{ $filterPosisi ?? request('posisi', 'all') }}">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg">Proses Semua Atlet</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-10 text-gray-500">Belum ada atlet dengan penilaian lengkap pada filter umur ini.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectUmur = document.getElementById('kelompokUmurSelect');
            selectUmur?.addEventListener('change', function() {
                const selectedValue = this.value;
                const currentUrl = new URL(window.location.href);
                if (selectedValue === 'all') {
                    currentUrl.searchParams.delete('kelompok_umur');
                } else {
                    currentUrl.searchParams.set('kelompok_umur', selectedValue);
                }
                window.location.href = currentUrl.toString();
            });

            const selectAllCheckbox = document.getElementById('selectAll');
            const atletCheckboxes = document.querySelectorAll('.atlet-checkbox');
            const selectedInfo = document.getElementById('selectedInfo');
            const selectedCount = document.getElementById('selectedCount');
            const selectedAtletsForm = document.getElementById('selectedAtletsForm');
            const selectedAtletsInput = document.getElementById('selectedAtletsInput');
            const calculateSelectedBtn = document.getElementById('calculateSelectedBtn');
            const selectAllBtn = document.getElementById('selectAllBtn');
            const deselectAllBtn = document.getElementById('deselectAllBtn');

            function updateSelectedInfo() {
                const selectedCheckboxes = document.querySelectorAll('.atlet-checkbox:checked');
                const count = selectedCheckboxes.length;
                if (!selectedCount) return;
                selectedCount.textContent = count;

                if (count > 0) {
                    selectedInfo?.classList.remove('hidden');
                    selectedAtletsForm?.classList.remove('hidden');
                    const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
                    if (selectedAtletsInput) selectedAtletsInput.value = JSON.stringify(selectedIds);
                    if (calculateSelectedBtn) {
                        calculateSelectedBtn.disabled = count < 2;
                        calculateSelectedBtn.classList.toggle('opacity-50', count < 2);
                        calculateSelectedBtn.classList.toggle('cursor-not-allowed', count < 2);
                        calculateSelectedBtn.textContent = `Hitung ${count} Atlet Terpilih`;
                    }
                } else {
                    selectedInfo?.classList.add('hidden');
                    selectedAtletsForm?.classList.add('hidden');
                }

                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = count === atletCheckboxes.length && atletCheckboxes.length > 0;
                    selectAllCheckbox.indeterminate = count > 0 && count < atletCheckboxes.length;
                }
            }

            selectAllCheckbox?.addEventListener('change', function() {
                const isChecked = this.checked;
                atletCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
                updateSelectedInfo();
            });

            atletCheckboxes.forEach(checkbox => checkbox.addEventListener('change', updateSelectedInfo));

            selectAllBtn?.addEventListener('click', function() {
                atletCheckboxes.forEach(checkbox => checkbox.checked = true);
                updateSelectedInfo();
            });

            deselectAllBtn?.addEventListener('click', function() {
                atletCheckboxes.forEach(checkbox => checkbox.checked = false);
                updateSelectedInfo();
            });

            selectedAtletsForm?.addEventListener('submit', function(e) {
                const selectedCheckboxes = document.querySelectorAll('.atlet-checkbox:checked');
                if (selectedCheckboxes.length < 2) {
                    e.preventDefault();
                    alert('Pilih minimal 2 atlet untuk melakukan perhitungan.');
                }
            });

            updateSelectedInfo();
        });
    </script>
</x-app-layout>
