<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \App\Models\Setting::get('app_name', config('app.name', 'Assets Management')) }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-12 flex-col justify-between relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#grid)" />
                    </svg>
                </div>

                <!-- Floating Elements -->
                <div class="absolute top-20 right-20 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute bottom-32 left-16 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">{{ \App\Models\Setting::get('app_name', 'Assets Management') }}</span>
                    </div>
                </div>

                <div class="relative z-10 space-y-6">
                    <h1 class="text-4xl font-bold text-white leading-tight">
                        Kelola Aset Anda<br/>
                        <span class="text-blue-200">dengan Mudah & Efisien</span>
                    </h1>
                    <p class="text-blue-100 text-lg max-w-md">
                        Platform manajemen aset modern untuk melacak, mengelola, dan mengoptimalkan semua aset perusahaan Anda dalam satu tempat.
                    </p>

                    <div class="flex items-center space-x-8 pt-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm">Tracking Real-time</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm">Aman & Terpercaya</span>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 text-blue-200 text-sm">
                    &copy; {{ date('Y') }} {{ \App\Models\Setting::get('app_name', 'Assets Management') }}. All rights reserved.
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-gray-50">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center space-x-3 mb-8">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">{{ \App\Models\Setting::get('app_name', 'Assets Management') }}</span>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        {{ $slot }}
                    </div>

                    <p class="text-center text-gray-500 text-sm mt-6 lg:hidden">
                        &copy; {{ date('Y') }} {{ \App\Models\Setting::get('app_name', 'Assets Management') }}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
