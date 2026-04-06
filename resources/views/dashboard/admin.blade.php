<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6 mb-0">
          {{ __('Dashboard Admin - Sistem Seleksi Pemain Sepak Bola') }}
      </h2>
  </x-slot>

  <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
          <!-- Welcome Section -->
          <div class="mb-8">
              <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                  <div class="flex items-center justify-between">
                      <div>
                          <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang di Sistem Seleksi Pemain</h1>
                          <p class="text-blue-100 opacity-90 max-w-3xl">
                              Sistem pendukung keputusan untuk menyeleksi dan meranking pemain sepak bola berbasis metode ARAS
                          </p>
                      </div>
                      <div class="hidden md:block">
                          <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                              </svg>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Quick Stats -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
              @php
                  $totalAtlet = \App\Models\Atlet::count();
                  $totalKriteria = \App\Models\Kriteria::count();
                  $totalPenilaian = \App\Models\Penilaian::count();
                  $totalUsers = \App\Models\User::count();
                  $atletLengkap = \App\Models\Atlet::whereHas('penilaians', function($q) {
                      $q->whereIn('kriteria_id', \App\Models\Kriteria::pluck('id'));
                  }, '=', \App\Models\Kriteria::count())->count();
                  
                  // Data untuk chart - Pendaftaran Atlet per Bulan
                  $atletPerBulan = \App\Models\Atlet::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
                      ->whereYear('created_at', date('Y'))
                      ->groupBy('bulan')
                      ->orderBy('bulan')
                      ->get()
                      ->pluck('total', 'bulan')
                      ->toArray();
                  
                  // Data untuk chart - Penilaian per Bulan
                  $penilaianPerBulan = \App\Models\Penilaian::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
                      ->whereYear('created_at', date('Y'))
                      ->groupBy('bulan')
                      ->orderBy('bulan')
                      ->get()
                      ->pluck('total', 'bulan')
                      ->toArray();
                  
                  // Data untuk pie chart - Status Penilaian Atlet
                  $atletBelumDinilai = $totalAtlet - $atletLengkap;
                  $atletSebagian = \App\Models\Atlet::whereHas('penilaians')
                      ->whereDoesntHave('penilaians', function($q) {
                          $q->whereIn('kriteria_id', \App\Models\Kriteria::pluck('id'));
                      }, '=', \App\Models\Kriteria::count())
                      ->count();
              @endphp

              <!-- Total Users -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-gray-500">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalUsers }}</p>
                      </div>
                      <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                          </svg>
                      </div>
                  </div>
                  <div class="mt-2">
                      <span class="text-xs text-gray-500 dark:text-gray-400">Pengguna terdaftar</span>
                  </div>
              </div>

              <!-- Total Atlet -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-gray-500">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Atlet</p>
                          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalAtlet }}</p>
                      </div>
                      <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                          <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                          </svg>
                      </div>
                  </div>
                  <div class="mt-2">
                      <span class="text-xs text-gray-500 dark:text-gray-400">Atlet terdaftar</span>
                  </div>
              </div>

              <!-- Kriteria Penilaian -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-gray-500">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kriteria Penilaian</p>
                          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalKriteria }}</p>
                      </div>
                      <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                          <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                          </svg>
                      </div>
                  </div>
                  <div class="mt-2">
                      <span class="text-xs text-gray-500 dark:text-gray-400">Parameter penilaian</span>
                  </div>
              </div>

              <!-- Atlet Lengkap -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border-gray-500">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Atlet Siap Dievaluasi</p>
                          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $atletLengkap }}</p>
                      </div>
                      <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                          <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                          </svg>
                      </div>
                  </div>
                  <div class="mt-2">
                      <span class="text-xs text-gray-500 dark:text-gray-400">Penilaian lengkap</span>
                  </div>
              </div>
          </div>

          <!-- Charts Section -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
              
              <!-- Atlet Registration Chart -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                  <div class="flex justify-between items-center mb-6">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                          Pendaftaran Atlet
                      </h3>
                      <span class="text-sm text-gray-500 dark:text-gray-400">
                          Tahun {{ date('Y') }}
                      </span>
                  </div>
                  <div id="atlet-chart"></div>
              </div>

              <!-- Status Penilaian Chart -->
              <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                  <div class="flex justify-between items-center mb-6">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                          Status Penilaian Atlet
                      </h3>
                      <span class="text-sm text-gray-500 dark:text-gray-400">
                          Total: {{ $totalAtlet }} atlet
                      </span>
                  </div>
                  <div id="status-chart"></div>
              </div>
          </div>

          <!-- Main Content Grid -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
              
              <!-- Left Column - Metode ARAS -->
              <div class="lg:col-span-2 space-y-8">
                  
                  <!-- Metode ARAS Card -->
                  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                      <div class="bg-gradient-to-r from-blue-600 to-purple-700 p-6 text-white">
                          <div class="flex items-center gap-4">
                              <div class="p-3 bg-white/20 rounded-lg">
                                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                  </svg>
                              </div>
                              <div class="flex-1">
                                  <h3 class="text-2xl font-bold mb-2">Metode ARAS (Additive Ratio Assessment)</h3>
                                  <p class="text-green-100 opacity-90">
                                      Sistem pendukung keputusan berbasis perbandingan rasio untuk menentukan ranking pemain sepak bola terbaik
                                  </p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="p-6">
                          <div class="prose dark:prose-invert max-w-none">
                              <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📊 Tentang Metode ARAS</h4>
                              <p class="text-gray-600 dark:text-gray-300 mb-4">
                                  ARAS adalah metode Multiple Attribute Decision Making (MADM) yang menggunakan konsep 
                                  <strong>rasio aditif</strong> untuk menentukan alternatif terbaik. Dalam konteks seleksi pemain sepak bola, 
                                  metode ini membantu mengevaluasi pemain berdasarkan berbagai kriteria teknikal, fisik, dan mental.
                              </p>

                              <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🔢 Langkah-langkah Perhitungan</h4>
                              <div class="space-y-4">
                                  <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                      <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">1</div>
                                      <div>
                                          <h5 class="font-semibold text-gray-900 dark:text-white">Matrix Keputusan</h5>
                                          <p class="text-sm text-gray-600 dark:text-gray-300">Membuat matrix nilai pemain untuk setiap kriteria penilaian</p>
                                      </div>
                                  </div>
                                  <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                      <div class="flex-shrink-0 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">2</div>
                                      <div>
                                          <h5 class="font-semibold text-gray-900 dark:text-white">Normalisasi Matrix</h5>
                                          <p class="text-sm text-gray-600 dark:text-gray-300">Menormalisasi nilai untuk membandingkan kriteria yang berbeda skala</p>
                                      </div>
                                  </div>
                                  <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                      <div class="flex-shrink-0 w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold">3</div>
                                      <div>
                                          <h5 class="font-semibold text-gray-900 dark:text-white">Matrix Terbobot</h5>
                                          <p class="text-sm text-gray-600 dark:text-gray-300">Mengalikan nilai normalisasi dengan bobot setiap kriteria</p>
                                      </div>
                                  </div>
                                  <div class="flex gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                      <div class="flex-shrink-0 w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold">4</div>
                                      <div>
                                          <h5 class="font-semibold text-gray-900 dark:text-white">Perhitungan Ranking</h5>
                                          <p class="text-sm text-gray-600 dark:text-gray-300">Menghitung nilai utility degree untuk menentukan peringkat pemain</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Quick Actions -->
                  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🚀 Akses Cepat</h3>
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <a href="{{ route('penilaian.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                              <div class="flex items-center gap-3">
                                  <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                                      <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                      </svg>
                                  </div>
                                  <div>
                                      <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">Input Penilaian</h4>
                                      <p class="text-sm text-gray-600 dark:text-gray-400">Masukkan data penilaian pemain</p>
                                  </div>
                              </div>
                          </a>
                          <a href="{{ route('perangkingan.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                              <div class="flex items-center gap-3">
                                  <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                                      <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                      </svg>
                                  </div>
                                  <div>
                                      <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400">Proses Perangkingan</h4>
                                      <p class="text-sm text-gray-600 dark:text-gray-400">Hitung ranking pemain dengan ARAS</p>
                                  </div>
                              </div>
                          </a>
                          <a href="{{ route('atlet.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                              <div class="flex items-center gap-3">
                                  <div class="p-2 bg-purple-100 dark:bg-purple-800 rounded-lg">
                                      <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                      </svg>
                                  </div>
                                  <div>
                                      <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400">Kelola Atlet</h4>
                                      <p class="text-sm text-gray-600 dark:text-gray-400">Tambah/edit data pemain</p>
                                  </div>
                              </div>
                          </a>
                          <a href="{{ route('kriteria.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition group">
                              <div class="flex items-center gap-3">
                                  <div class="p-2 bg-yellow-100 dark:bg-yellow-800 rounded-lg">
                                      <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                      </svg>
                                  </div>
                                  <div>
                                      <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-yellow-600 dark:group-hover:text-yellow-400">Kelola Kriteria</h4>
                                      <p class="text-sm text-gray-600 dark:text-gray-400">Atur parameter penilaian</p>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>
              </div>

              <!-- Right Column - Recent Activity & System Info -->
              <div class="space-y-8">
                  
                  <!-- Recent Activity -->
                  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🕐 Aktivitas Terbaru</h3>
                      <div class="space-y-4">
                          @php
                              $recentPenilaians = \App\Models\Penilaian::with(['atlet', 'kriteria'])
                                  ->latest()
                                  ->take(5)
                                  ->get();
                          @endphp

                          @forelse($recentPenilaians as $penilaian)
                          <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                              <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                  {{ strtoupper(substr($penilaian->atlet->nama, 0, 2)) }}
                              </div>
                              <div class="flex-1">
                                  <p class="text-sm font-medium text-gray-900 dark:text-white">
                                      {{ $penilaian->atlet->nama }}
                                  </p>
                                  <p class="text-xs text-gray-500 dark:text-gray-400">
                                      {{ $penilaian->kriteria->nama_kriteria }} • {{ number_format($penilaian->nilai, 1) }}
                                  </p>
                              </div>
                              <div class="text-xs text-gray-400">
                                  {{ $penilaian->updated_at->diffForHumans() }}
                              </div>
                          </div>
                          @empty
                          <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                              <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                              </svg>
                              <p>Belum ada aktivitas</p>
                          </div>
                          @endforelse
                      </div>
                  </div>

                  <!-- System Status -->
                  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🔧 Status Sistem</h3>
                      <div class="space-y-3">
                          <div class="flex items-center justify-between">
                              <span class="text-sm text-gray-600 dark:text-gray-400">Database</span>
                              <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs font-medium">
                                  <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                  Connected
                              </span>
                          </div>
                          <div class="flex items-center justify-between">
                              <span class="text-sm text-gray-600 dark:text-gray-400">Metode ARAS</span>
                              <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs font-medium">
                                  <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                  Ready
                              </span>
                          </div>
                          <div class="flex items-center justify-between">
                              <span class="text-sm text-gray-600 dark:text-gray-400">Data Kriteria</span>
                              <span class="inline-flex items-center px-2 py-1 {{ $totalKriteria > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }} rounded-full text-xs font-medium">
                                  <span class="w-2 h-2 {{ $totalKriteria > 0 ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full mr-1"></span>
                                  {{ $totalKriteria > 0 ? 'Configured' : 'Setup Required' }}
                              </span>
                          </div>
                          <div class="flex items-center justify-between">
                              <span class="text-sm text-gray-600 dark:text-gray-400">Data Atlet</span>
                              <span class="inline-flex items-center px-2 py-1 {{ $totalAtlet > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }} rounded-full text-xs font-medium">
                                  <span class="w-2 h-2 {{ $totalAtlet > 0 ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full mr-1"></span>
                                  {{ $totalAtlet > 0 ? 'Available' : 'No Data' }}
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Tambahkan CDN ApexCharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Data dari PHP
          const atletData = @json($atletPerBulan);
          const penilaianData = @json($penilaianPerBulan);
          
          // Chart Pendaftaran Atlet
          const atletChartOptions = {
              chart: {
                  height: 320,
                  type: "line",
                  fontFamily: "Inter, sans-serif",
                  toolbar: {
                      show: false,
                  },
              },
              series: [
                  {
                      name: "Pendaftaran Atlet",
                      data: Array.from({length: 12}, (_, i) => atletData[i+1] || 0),
                      color: "#1C64F2",
                  },
                  {
                      name: "Penilaian",
                      data: Array.from({length: 12}, (_, i) => penilaianData[i+1] || 0),
                      color: "#16BDCA",
                  }
              ],
              stroke: {
                  width: [3, 3],
                  curve: "smooth"
              },
              xaxis: {
                  categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                  axisBorder: {
                      show: false,
                  },
                  axisTicks: {
                      show: false,
                  },
              },
              grid: {
                  show: true,
                  borderColor: "#E5E7EB",
                  strokeDashArray: 4,
                  padding: {
                      top: 0,
                      right: 0,
                      bottom: 0,
                      left: 0
                  },
              },
              legend: {
                  position: "top",
              },
              yaxis: {
                  min: 0,
              }
          };

          if (document.getElementById("atlet-chart") && typeof ApexCharts !== 'undefined') {
              const chart = new ApexCharts(document.getElementById("atlet-chart"), atletChartOptions);
              chart.render();
          }

          // Chart Status Penilaian
          const statusChartOptions = {
              series: [{{ $atletLengkap }}, {{ $atletSebagian }}, {{ $atletBelumDinilai }}],
              colors: ["#1C64F2", "#16BDCA", "#9061F9"],
              chart: {
                  height: 320,
                  type: "donut",
                  fontFamily: "Inter, sans-serif",
              },
              stroke: {
                  colors: ["white"],
                  width: 2,
              },
              plotOptions: {
                  pie: {
                      donut: {
                          size: '65%',
                          labels: {
                              show: true,
                              total: {
                                  show: true,
                                  label: 'Total Atlet',
                                  color: '#6B7280',
                                  formatter: function (w) {
                                      return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                  }
                              }
                          }
                      }
                  }
              },
              labels: ["Lengkap", "Sebagian", "Belum Dinilai"],
              dataLabels: {
                  enabled: true,
                  style: {
                      fontFamily: "Inter, sans-serif",
                  },
              },
              legend: {
                  position: "bottom",
                  fontFamily: "Inter, sans-serif",
              },
              yaxis: {
                  labels: {
                      formatter: function (value) {
                          return value
                      },
                  },
              },
          };

          if (document.getElementById("status-chart") && typeof ApexCharts !== 'undefined') {
              const chart = new ApexCharts(document.getElementById("status-chart"), statusChartOptions);
              chart.render();
          }
      });
  </script>
</x-app-layout>