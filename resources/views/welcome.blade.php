<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SPK ARAS - Sistem Penilaian Atlet</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-800 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-gray-900 dark:text-white">SPK ARAS</h1>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Sistem Penilaian Atlet</p>
                            </div>
                        </div>
                        @if (Route::has('login'))
                            <div class="flex gap-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                        Login
                                    </a>
                                    {{-- @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                            Register
                                        </a>
                                    @endif --}}
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </nav>

            <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <!-- Left Content -->
                        <div class="space-y-6">
                            <div class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full text-sm font-medium">
                                Metode ARAS
                            </div>
                            
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                                Sistem Pendukung Keputusan
                                <span class="block text-green-600 dark:text-green-500 mt-1">SSB Mitra Surabaya</span>
                            </h1>
                            
                            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                                Pemilihan pemain terbaik berdasarkan kriteria yang objektif dan terukur menggunakan metode Additive Ratio Assessment
                            </p>
    
                            <!-- Features List -->
                            <div class="grid grid-cols-2 gap-4 pt-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Penilaian Akurat</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Multi Kriteria</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Transparan</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Real-time</span>
                                </div>
                            </div>
    
                            <!-- CTA Button -->
                            <div class="pt-4">
                                <a href="#" class="inline-block px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors shadow-sm">
                                    Mulai Penilaian
                                </a>
                            </div>
    
                            <!-- Stats -->
                            <div class="flex gap-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">50+</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Pemain</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">8</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Kriteria</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">100%</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Akurat</div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Right Image -->
                        <div class="hidden md:block">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-tr from-green-600 to-green-400 rounded-2xl transform rotate-3"></div>
                                <img 
                                    src="https://img.okezone.com/content/2020/12/08/51/2324137/pengertian-permainan-sepak-bola-dan-peraturan-singkat-yang-meliputinya-UwJZOHG4JF.jpg" 
                                    alt="SSB Mitra Surabaya"
                                    class="relative rounded-2xl shadow-xl object-cover w-full h-[400px]"
                                />
                            </div>
                        </div>
                    </div>
                </div>    
            </section>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>SPK ARAS - Sistem Pendukung Keputusan Penilaian Atlet &copy; {{ date('Y') }}</p>
                    <p class="mt-1">Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}</p>
                </div>
            </footer>
        </div>
    </body>
</html>

