<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 mt-4 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role === 'orang_tua')
                <li>
                    <a href="{{ route('laporan.orang-tua') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('laporan.orang-tua') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <span class="ms-3">Nilai Anak</span>
                    </a>
                </li>
            @else
                <li class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700 px-2 text-xs font-semibold text-gray-500 uppercase">Data Master</li>
                <li><a href="{{ route('atlet.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('atlet.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Data Atlet</span></a></li>
                <li><a href="{{ route('orang-tua.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('orang-tua.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Data Orang Tua</span></a></li>
                <li><a href="{{ route('kriteria.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('kriteria.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Data Kriteria</span></a></li>

                <li class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700 px-2 text-xs font-semibold text-gray-500 uppercase">Proses</li>
                <li><a href="{{ route('penilaian.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('penilaian.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Penilaian Atlet</span></a></li>
                <li><a href="{{ route('perangkingan.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('perangkingan.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Perangkingan</span></a></li>
                <li><a href="{{ route('laporan.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('laporan.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Laporan</span></a></li>

                @if(Auth::user()->role === 'admin')
                    <li class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700 px-2 text-xs font-semibold text-gray-500 uppercase">Admin</li>
                    <li><a href="{{ route('users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Kelola User</span></a></li>
                    <li><a href="{{ route('riwayat.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('riwayat.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"><span class="ms-3">Riwayat Aktivitas</span></a></li>
                @endif
            @endif
        </ul>
    </div>
</aside>

