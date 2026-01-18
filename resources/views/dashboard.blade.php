<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
            <span class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-xl p-6 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                            @if(Auth::user()->role)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if(Auth::user()->isSuperAdmin()) bg-yellow-400 text-yellow-900
                                    @elseif(Auth::user()->isLeader()) bg-purple-400 text-purple-900
                                    @elseif(Auth::user()->isAdmin()) bg-green-400 text-green-900
                                    @else bg-blue-200 text-blue-900 @endif">
                                    {{ Auth::user()->role->name }}
                                </span>
                            @endif
                        </div>
                        <p class="text-blue-100 text-sm">Kelola semua aset perusahaan Anda dari satu tempat.</p>
                    </div>
                    <div class="hidden md:block text-right">
                        <p class="text-3xl font-bold">Rp {{ number_format($stats['total_value'], 0, ',', '.') }}</p>
                        <p class="text-blue-200 text-sm">Total Nilai Aset</p>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['total_assets'] }}</p>
                    <p class="text-xs text-gray-500">Total Aset</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['available_assets'] }}</p>
                    <p class="text-xs text-gray-500">Tersedia</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['in_use_assets'] }}</p>
                    <p class="text-xs text-gray-500">Sedang Dipakai</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['maintenance_assets'] }}</p>
                    <p class="text-xs text-gray-500">Maintenance</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['retired_assets'] }}</p>
                    <p class="text-xs text-gray-500">Retired</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['lost_assets'] }}</p>
                    <p class="text-xs text-gray-500">Hilang</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('assets.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Tambah Aset
                    </a>
                    <a href="{{ route('assets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Lihat Semua Aset
                    </a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Kategori
                    </a>
                    <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Karyawan
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Aset per Kategori -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aset per Kategori</h3>
                    @if($assetsByCategory->count() > 0)
                        <div class="space-y-3">
                            @foreach($assetsByCategory as $category)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-3"></div>
                                        <span class="text-sm text-gray-700">{{ $category->name }}</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $category->assets_count }}</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['total_assets'] > 0 ? ($category->assets_count / $stats['total_assets']) * 100 : 0 }}%"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data kategori</p>
                    @endif
                </div>

                <!-- Aset per Lokasi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aset per Lokasi</h3>
                    @if($assetsByLocation->count() > 0)
                        <div class="space-y-3">
                            @foreach($assetsByLocation as $location)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                                        <span class="text-sm text-gray-700">{{ $location->name }}</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $location->assets_count }}</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_assets'] > 0 ? ($location->assets_count / $stats['total_assets']) * 100 : 0 }}%"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data lokasi</p>
                    @endif
                </div>

                <!-- Status Penggunaan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Penggunaan</h3>
                    <div class="flex items-center justify-center">
                        <div class="relative w-32 h-32">
                            <svg class="w-32 h-32 transform -rotate-90">
                                <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="12" fill="none"/>
                                @php
                                    $usedPercent = $stats['total_assets'] > 0 ? ($stats['used_assets'] / $stats['total_assets']) * 100 : 0;
                                    $circumference = 2 * 3.14159 * 56;
                                    $offset = $circumference - ($usedPercent / 100) * $circumference;
                                @endphp
                                <circle cx="64" cy="64" r="56" stroke="#3b82f6" stroke-width="12" fill="none" stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}" stroke-linecap="round"/>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-bold text-gray-800">{{ round($usedPercent) }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-xl font-bold text-blue-600">{{ $stats['used_assets'] }}</p>
                            <p class="text-xs text-gray-500">Digunakan</p>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-gray-400">{{ $stats['unused_assets'] }}</p>
                            <p class="text-xs text-gray-500">Tidak Digunakan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Aset Terbaru -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Aset Terbaru</h3>
                        <a href="{{ route('assets.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                    </div>
                    @if($recentAssets->count() > 0)
                        <div class="divide-y divide-gray-100">
                            @foreach($recentAssets as $asset)
                                <a href="{{ route('assets.show', $asset) }}" class="flex items-center p-4 hover:bg-gray-50 transition-colors">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $asset->asset_tag }}</p>
                                        <p class="text-xs text-gray-500">{{ $asset->category?->name ?? '-' }} • {{ $asset->location?->name ?? '-' }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $asset->status_badge }}">{{ $asset->status_label }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <p>Belum ada aset</p>
                            <a href="{{ route('assets.create') }}" class="text-blue-600 hover:text-blue-800 text-sm mt-2 inline-block">Tambah Aset Pertama</a>
                        </div>
                    @endif
                </div>

                <!-- Garansi Akan Berakhir -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Garansi Akan Berakhir (30 Hari)</h3>
                    </div>
                    @if($expiringWarranty->count() > 0)
                        <div class="divide-y divide-gray-100">
                            @foreach($expiringWarranty as $asset)
                                <a href="{{ route('assets.show', $asset) }}" class="flex items-center p-4 hover:bg-gray-50 transition-colors">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $asset->asset_tag }}</p>
                                        <p class="text-xs text-gray-500">{{ $asset->category?->name ?? '-' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-orange-600">{{ $asset->warranty_expiry->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $asset->warranty_expiry->diffForHumans() }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <p>Tidak ada aset dengan garansi yang akan berakhir</p>
                        </div>
                    @endif
                </div>
            </div>

            @if(Auth::user()->isSuperAdmin() && count($recentActivities) > 0)
            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                    <a href="{{ route('activity-logs.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($recentActivities as $activity)
                        <div class="flex items-center p-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-xs mr-3">
                                {{ strtoupper(substr($activity->user?->name ?? 'S', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">{{ $activity->user?->name ?? 'System' }}</span>
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full mx-1
                                        @if($activity->action == 'created') bg-green-100 text-green-800
                                        @elseif($activity->action == 'updated') bg-yellow-100 text-yellow-800
                                        @elseif($activity->action == 'deleted') bg-red-100 text-red-800
                                        @elseif($activity->action == 'transferred') bg-purple-100 text-purple-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $activity->action_label }}
                                    </span>
                                    {{ $activity->model_name }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Master Data Summary -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['total_categories'] }}</p>
                    <p class="text-sm text-gray-500">Kategori</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_locations'] }}</p>
                    <p class="text-sm text-gray-500">Lokasi</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_areas'] }}</p>
                    <p class="text-sm text-gray-500">Area</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center">
                    <p class="text-3xl font-bold text-orange-600">{{ $stats['total_employees'] }}</p>
                    <p class="text-sm text-gray-500">Karyawan</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
