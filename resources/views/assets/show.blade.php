<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Aset') }}: {{ $asset->asset_tag }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('assets.edit', $asset) }}" class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-xl hover:bg-yellow-600 transition-all">
                    Edit
                </a>
                <a href="{{ route('assets.index') }}" class="text-gray-600 hover:text-gray-900">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Asset Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Informasi Aset
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Asset Tag ID</p>
                                <p class="font-semibold text-gray-900">{{ $asset->asset_tag }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Barcode</p>
                                <p class="font-semibold text-gray-900">{{ $asset->barcode ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $asset->status_badge }}">
                                    {{ $asset->status_label }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-semibold text-gray-900">{{ $asset->category?->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Model Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                            Informasi Model
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Manufacturer</p>
                                <p class="font-semibold text-gray-900">{{ $asset->manufacturer ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Model Number</p>
                                <p class="font-semibold text-gray-900">{{ $asset->model_number ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Model Name</p>
                                <p class="font-semibold text-gray-900">{{ $asset->model_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Serial Number</p>
                                <p class="font-semibold text-gray-900">{{ $asset->serial_number ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500">Model Description</p>
                                <p class="text-gray-900">{{ $asset->model_description ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Location Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Lokasi & Pengguna
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-semibold text-gray-900">{{ $asset->location?->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Area</p>
                                <p class="font-semibold text-gray-900">{{ $asset->area?->name ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500">Karyawan</p>
                                <p class="font-semibold text-gray-900">
                                    @if($asset->employee)
                                        {{ $asset->employee->employee_id }} - {{ $asset->employee->name }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($asset->notes)
                    <!-- Notes Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan</h3>
                        <p class="text-gray-700">{{ $asset->notes }}</p>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- QR Code Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">QR Code</h3>
                        <img src="{{ $asset->qr_code_url }}" alt="QR Code" class="mx-auto mb-4">
                        <p class="text-xs text-gray-500 mb-2">Scan untuk akses cepat</p>
                    </div>

                    <!-- Permalink Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Permalink</h3>
                        <p class="text-xs text-gray-500 mb-2">Link publik (tanpa login)</p>
                        <div class="flex items-center gap-2">
                            <input type="text" value="{{ $asset->permalink }}" readonly class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg" id="permalink">
                            <button onclick="copyPermalink()" class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" title="Copy">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ $asset->permalink }}" target="_blank" class="mt-3 inline-block text-sm text-blue-600 hover:text-blue-800">
                            Buka di tab baru &rarr;
                        </a>
                    </div>

                    <!-- Image Card -->
                    @if($asset->image)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Gambar</h3>
                        <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="w-full rounded-lg">
                    </div>
                    @endif

                    <!-- Meta Info -->
                    <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-500">
                        <p>Dibuat oleh: {{ $asset->creator?->name ?? 'System' }}</p>
                        <p>Dibuat: {{ $asset->created_at->format('d M Y H:i') }}</p>
                        @if($asset->updater)
                            <p>Diupdate oleh: {{ $asset->updater->name }}</p>
                            <p>Diupdate: {{ $asset->updated_at->format('d M Y H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyPermalink() {
            const input = document.getElementById('permalink');
            input.select();
            document.execCommand('copy');
            alert('Permalink berhasil disalin!');
        }
    </script>
</x-app-layout>
