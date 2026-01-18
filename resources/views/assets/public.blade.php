<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $asset->asset_tag }} - Assets Management</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-800">Assets Management</span>
                </a>
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $asset->status_badge }}">
                    {{ $asset->status_label }}
                </span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Asset Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-blue-200 text-sm mb-1">Asset Tag ID</p>
                        <h1 class="text-3xl font-bold">{{ $asset->asset_tag }}</h1>
                        @if($asset->barcode && $asset->barcode !== $asset->asset_tag)
                            <p class="text-blue-200 mt-1">Barcode: {{ $asset->barcode }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <img src="{{ $asset->qr_code_url }}" alt="QR Code" class="w-24 h-24 bg-white rounded-lg p-1">
                    </div>
                </div>
            </div>

            <!-- Asset Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Model Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Model</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-medium text-gray-900">{{ $asset->category?->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Manufacturer</p>
                                <p class="font-medium text-gray-900">{{ $asset->manufacturer ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Model Number</p>
                                <p class="font-medium text-gray-900">{{ $asset->model_number ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Model Name</p>
                                <p class="font-medium text-gray-900">{{ $asset->model_name ?? '-' }}</p>
                            </div>
                        </div>

                        @if($asset->model_description)
                            <div>
                                <p class="text-sm text-gray-500">Deskripsi</p>
                                <p class="text-gray-700">{{ $asset->model_description }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Location Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Lokasi & Pengguna</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-medium text-gray-900">{{ $asset->location?->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Area</p>
                                <p class="font-medium text-gray-900">{{ $asset->area?->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Karyawan</p>
                            <p class="font-medium text-gray-900">
                                @if($asset->employee)
                                    {{ $asset->employee->name }}
                                    <span class="text-gray-500 text-sm">({{ $asset->employee->employee_id }})</span>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 mb-1">Status</p>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $asset->status_badge }}">
                                {{ $asset->status_label }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 mb-1">Tanggal Pembelian</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $asset->purchase_date?->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 mb-1">Garansi Berakhir</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $asset->warranty_expiry?->format('d M Y') ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 mb-1">Serial Number</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $asset->serial_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Halaman ini dapat diakses tanpa login.</p>
            <p class="mt-1">&copy; {{ date('Y') }} Assets Management</p>
        </div>
    </main>
</body>
</html>
