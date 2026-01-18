<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(\App\Models\Setting::get('app_name', 'Assets Management')); ?> - Kelola Aset Perusahaan Anda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900"><?php echo e(\App\Models\Setting::get('app_name', 'Assets Management')); ?></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Fitur</a>
                    <a href="#benefits" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Keuntungan</a>
                    <a href="#contact" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Kontak</a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/25">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/25">
                            Masuk
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-gray-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-full">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-blue-700 text-sm font-medium">Platform Manajemen Aset #1</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Kelola Aset
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                            Perusahaan
                        </span>
                        dengan Mudah
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed">
                        Platform manajemen aset modern yang membantu Anda melacak, mengelola, dan mengoptimalkan semua aset perusahaan dalam satu tempat yang terintegrasi.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-xl shadow-blue-500/30 transform hover:-translate-y-1">
                            Mulai Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Lihat Demo
                        </a>
                    </div>

                    <div class="flex items-center gap-8 pt-4">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">B</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">C</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">+99</div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dipercaya oleh <span class="font-semibold text-gray-900">500+</span> perusahaan</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl blur-3xl opacity-20 transform rotate-6"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-semibold text-gray-800">Dashboard Overview</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Live</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-800">1,234</p>
                                <p class="text-sm text-gray-500">Total Aset</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-800">1,180</p>
                                <p class="text-sm text-gray-500">Aset Aktif</p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4">
                                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-800">42</p>
                                <p class="text-sm text-gray-500">Maintenance</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                                <p class="text-sm text-gray-500">Kategori</p>
                            </div>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full w-4/5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">95.6% aset dalam kondisi baik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Fitur Unggulan</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4">Semua yang Anda Butuhkan</h2>
                <p class="text-xl text-gray-600 mt-4 max-w-2xl mx-auto">
                    Fitur lengkap untuk mengelola aset perusahaan Anda dengan efisien dan terorganisir
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Inventaris Lengkap</h3>
                    <p class="text-gray-600">Catat dan kelola semua aset dengan detail lengkap termasuk spesifikasi, lokasi, dan status.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan Real-time</h3>
                    <p class="text-gray-600">Dapatkan insight dan laporan lengkap tentang kondisi aset secara real-time.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-purple-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Multi-User Access</h3>
                    <p class="text-gray-600">Kelola akses pengguna dengan berbagai level role: Super Admin, Admin, dan User.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-yellow-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Notifikasi Otomatis</h3>
                    <p class="text-gray-600">Terima notifikasi untuk jadwal maintenance, garansi habis, dan event penting lainnya.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-red-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">QR Code Tracking</h3>
                    <p class="text-gray-600">Generate QR code untuk setiap aset dan scan untuk akses informasi cepat.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-indigo-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Data Anda aman dengan enkripsi dan sistem backup otomatis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-gradient-to-br from-blue-600 to-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-200 font-semibold text-sm uppercase tracking-wider">Keuntungan</span>
                <h2 class="text-4xl font-bold text-white mt-4">Mengapa Memilih Kami?</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl font-bold text-white">50%</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Hemat Waktu</h3>
                    <p class="text-blue-100">Kurangi waktu pencarian dan pengelolaan aset hingga 50%</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl font-bold text-white">99%</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Akurasi Data</h3>
                    <p class="text-blue-100">Tingkat akurasi data aset mencapai 99% dengan sistem terintegrasi</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl font-bold text-white">24/7</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Akses Kapanpun</h3>
                    <p class="text-blue-100">Akses data aset Anda kapanpun dan dimanapun</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Siap Mengelola Aset dengan Lebih Baik?
            </h2>
            <p class="text-xl text-gray-600 mb-8">
                Mulai gunakan Assets Management sekarang dan rasakan kemudahan dalam mengelola aset perusahaan Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-xl shadow-blue-500/30">
                    Masuk Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold"><?php echo e(\App\Models\Setting::get('app_name', 'Assets Management')); ?></span>
                    </div>
                    <p class="text-gray-400 max-w-md">
                        Platform manajemen aset modern untuk membantu perusahaan mengelola dan mengoptimalkan semua aset mereka.
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#benefits" class="hover:text-white transition-colors">Keuntungan</a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-white transition-colors">Masuk</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>info@assets.local</li>
                        <li>+62 123 456 789</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(\App\Models\Setting::get('app_name', 'Assets Management')); ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH D:\Assets\assets-management\resources\views/landing.blade.php ENDPATH**/ ?>