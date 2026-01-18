<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Aset') }}: {{ $asset->asset_tag }}
            </h2>
            <a href="{{ route('assets.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <form method="POST" action="{{ route('assets.update', $asset) }}">
                    @csrf
                    @method('PUT')

                    <!-- Info Asset Tag & Barcode (readonly) -->
                    <div class="mb-4 grid grid-cols-2 md:grid-cols-4 gap-3 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-0.5">Asset Tag</label>
                            <p class="text-sm font-semibold text-gray-900">{{ $asset->asset_tag }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-0.5">Barcode</label>
                            <p class="text-sm font-semibold text-gray-900">{{ $asset->barcode }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-0.5">Dibuat</label>
                            <p class="text-sm text-gray-700">{{ $asset->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-0.5">Terakhir Update</label>
                            <p class="text-sm text-gray-700">{{ $asset->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <!-- Category -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" id="status" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="available" {{ old('status', $asset->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="in_use" {{ old('status', $asset->status) == 'in_use' ? 'selected' : '' }}>Digunakan</option>
                                <option value="maintenance" {{ old('status', $asset->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="retired" {{ old('status', $asset->status) == 'retired' ? 'selected' : '' }}>Retired</option>
                                <option value="lost" {{ old('status', $asset->status) == 'lost' ? 'selected' : '' }}>Hilang</option>
                            </select>
                        </div>

                        <!-- Manufacturer -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Manufacturer</label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer', $asset->manufacturer) }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Model Name -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Model Name</label>
                            <input type="text" name="model_name" value="{{ old('model_name', $asset->model_name) }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Model Number -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Model Number</label>
                            <input type="text" name="model_number" value="{{ old('model_number', $asset->model_number) }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Serial Number -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Serial Number</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Lokasi</label>
                            <select name="location_id" id="location_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $asset->location_id) == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Area -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Area</label>
                            <select name="area_id" id="area_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" data-selected="{{ old('area_id', $asset->area_id) }}">
                                <option value="">Pilih Lokasi dulu</option>
                            </select>
                        </div>

                        <!-- Employee -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Karyawan</label>
                            <select name="employee_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id', $asset->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Leader -->
                        @if(Auth::user()->isSuperAdmin())
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Leader</label>
                            <select name="leader_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}" {{ old('leader_id', $asset->leader_id) == $leader->id ? 'selected' : '' }}>{{ $leader->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Notes -->
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Catatan</label>
                            <input type="text" name="notes" value="{{ old('notes', $asset->notes) }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('assets.index') }}" class="px-4 py-1.5 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-1.5 text-sm bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-md shadow-blue-500/25">
                            Update Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('location_id');
            const areaSelect = document.getElementById('area_id');
            const selectedAreaId = areaSelect.dataset.selected;

            function loadAreas(locationId, selectAreaId = null) {
                areaSelect.innerHTML = '<option value="">Memuat...</option>';
                areaSelect.disabled = true;

                if (locationId) {
                    fetch(`/api/locations/${locationId}/areas`)
                        .then(response => response.json())
                        .then(areas => {
                            areaSelect.innerHTML = '<option value="">Pilih Area</option>';
                            areas.forEach(area => {
                                const option = document.createElement('option');
                                option.value = area.id;
                                option.textContent = area.name;
                                if (selectAreaId && area.id == selectAreaId) {
                                    option.selected = true;
                                }
                                areaSelect.appendChild(option);
                            });
                            areaSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            areaSelect.innerHTML = '<option value="">Gagal memuat area</option>';
                        });
                } else {
                    areaSelect.innerHTML = '<option value="">Pilih Lokasi dulu</option>';
                }
            }

            if (locationSelect.value) {
                loadAreas(locationSelect.value, selectedAreaId);
            }

            locationSelect.addEventListener('change', function() {
                loadAreas(this.value);
            });
        });
    </script>
</x-app-layout>
