<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Tambah Aset Baru') }}
            </h2>
            <a href="{{ route('assets.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('assets.store') }}" id="assetForm">
                @csrf
                <input type="hidden" name="batch_mode" id="batchMode" value="0">

                <!-- Info Auto-generated -->
                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between">
                    <p class="text-sm text-blue-700">
                        <strong>Asset Tag</strong> & <strong>Barcode</strong> otomatis di-generate. Format: <code class="bg-blue-100 px-1 rounded text-xs">KATEGORI-000001</code>
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Batch Add:</span>
                        <button type="button" id="toggleBatch" class="px-3 py-1 text-xs font-medium rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
                            OFF
                        </button>
                    </div>
                </div>

                <!-- Single Asset Form -->
                <div id="singleForm" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <!-- Category -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Manufacturer -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Manufacturer</label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer') }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Dell">
                        </div>

                        <!-- Model Name -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Model Name</label>
                            <input type="text" name="model_name" value="{{ old('model_name') }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Latitude 5520">
                        </div>

                        <!-- Model Number -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Model Number</label>
                            <input type="text" name="model_number" value="{{ old('model_number') }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 5520-i7">
                        </div>

                        <!-- Serial Number -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Serial Number</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number') }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="S/N">
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Lokasi</label>
                            <select name="location_id" id="location_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Area -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Area</label>
                            <select name="area_id" id="area_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" disabled>
                                <option value="">Pilih Lokasi dulu</option>
                            </select>
                        </div>

                        <!-- Employee -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Karyawan</label>
                            <select name="employee_id" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
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
                                    <option value="{{ $leader->id }}" {{ old('leader_id') == $leader->id ? 'selected' : '' }}>{{ $leader->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Notes -->
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Catatan</label>
                            <input type="text" name="notes" value="{{ old('notes') }}" class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Catatan tambahan...">
                        </div>
                    </div>

                    <!-- Hidden default values -->
                    <input type="hidden" name="status" value="in_use">

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('assets.index') }}" class="px-4 py-1.5 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-1.5 text-sm bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-md shadow-blue-500/25">
                            Simpan Aset
                        </button>
                    </div>
                </div>

                <!-- Batch Add Form -->
                <div id="batchForm" class="hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-gray-800">Batch Add Aset</h3>
                            <button type="button" id="addRow" class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">
                                + Tambah Baris
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm" id="batchTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">#</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Kategori</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Manufacturer</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Model Name</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Model Number</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Serial Number</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Lokasi</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Area</th>
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Karyawan</th>
                                        @if(Auth::user()->isSuperAdmin())
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Leader</th>
                                        @endif
                                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500">Catatan</th>
                                        <th class="px-2 py-2 text-center text-xs font-medium text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="batchBody">
                                    <!-- Rows will be added here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total: <span id="rowCount">0</span> aset</span>
                            <div class="flex gap-2">
                                <a href="{{ route('assets.index') }}" class="px-4 py-1.5 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                    Batal
                                </a>
                                <button type="submit" class="px-4 py-1.5 text-sm bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-md shadow-blue-500/25">
                                    Simpan Semua Aset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBatch = document.getElementById('toggleBatch');
            const singleForm = document.getElementById('singleForm');
            const batchForm = document.getElementById('batchForm');
            const batchMode = document.getElementById('batchMode');
            const batchBody = document.getElementById('batchBody');
            const addRowBtn = document.getElementById('addRow');
            const rowCountSpan = document.getElementById('rowCount');
            let rowIndex = 0;

            // Categories, Locations, Employees, Leaders data for batch
            const categories = @json($categories);
            const locations = @json($locations);
            const employees = @json($employees);
            const leaders = @json($leaders ?? []);
            const isSuperAdmin = {{ Auth::user()->isSuperAdmin() ? 'true' : 'false' }};

            // Toggle batch mode
            toggleBatch.addEventListener('click', function() {
                if (batchMode.value === '0') {
                    batchMode.value = '1';
                    toggleBatch.textContent = 'ON';
                    toggleBatch.classList.remove('bg-gray-200', 'text-gray-700');
                    toggleBatch.classList.add('bg-green-500', 'text-white');
                    singleForm.classList.add('hidden');
                    batchForm.classList.remove('hidden');
                    if (rowIndex === 0) addRow();
                } else {
                    batchMode.value = '0';
                    toggleBatch.textContent = 'OFF';
                    toggleBatch.classList.remove('bg-green-500', 'text-white');
                    toggleBatch.classList.add('bg-gray-200', 'text-gray-700');
                    singleForm.classList.remove('hidden');
                    batchForm.classList.add('hidden');
                }
            });

            // Add row function
            function addRow() {
                const tr = document.createElement('tr');
                tr.className = 'border-b border-gray-100 hover:bg-gray-50';
                tr.dataset.index = rowIndex;

                let leaderCell = '';
                if (isSuperAdmin) {
                    leaderCell = `
                        <td class="px-1 py-1">
                            <select name="assets[${rowIndex}][leader_id]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                                <option value="">-</option>
                                ${leaders.map(l => `<option value="${l.id}">${l.name}</option>`).join('')}
                            </select>
                        </td>
                    `;
                }

                tr.innerHTML = `
                    <td class="px-2 py-1 text-gray-500 text-xs">${rowIndex + 1}</td>
                    <td class="px-1 py-1">
                        <select name="assets[${rowIndex}][category_id]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                            <option value="">-</option>
                            ${categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('')}
                        </select>
                    </td>
                    <td class="px-1 py-1">
                        <input type="text" name="assets[${rowIndex}][manufacturer]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Manufacturer">
                    </td>
                    <td class="px-1 py-1">
                        <input type="text" name="assets[${rowIndex}][model_name]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Model Name">
                    </td>
                    <td class="px-1 py-1">
                        <input type="text" name="assets[${rowIndex}][model_number]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Model #">
                    </td>
                    <td class="px-1 py-1">
                        <input type="text" name="assets[${rowIndex}][serial_number]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="S/N">
                    </td>
                    <td class="px-1 py-1">
                        <select name="assets[${rowIndex}][location_id]" class="location-select w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" data-index="${rowIndex}">
                            <option value="">-</option>
                            ${locations.map(l => `<option value="${l.id}">${l.name}</option>`).join('')}
                        </select>
                    </td>
                    <td class="px-1 py-1">
                        <select name="assets[${rowIndex}][area_id]" class="area-select w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" data-index="${rowIndex}" disabled>
                            <option value="">-</option>
                        </select>
                    </td>
                    <td class="px-1 py-1">
                        <select name="assets[${rowIndex}][employee_id]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500">
                            <option value="">-</option>
                            ${employees.map(e => `<option value="${e.id}">${e.name}</option>`).join('')}
                        </select>
                    </td>
                    ${leaderCell}
                    <td class="px-1 py-1">
                        <input type="text" name="assets[${rowIndex}][notes]" class="w-full px-2 py-1 text-xs border border-gray-200 rounded focus:ring-1 focus:ring-blue-500" placeholder="Catatan">
                    </td>
                    <td class="px-1 py-1 text-center">
                        <button type="button" class="remove-row text-red-500 hover:text-red-700 text-xs" data-index="${rowIndex}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </td>
                `;

                batchBody.appendChild(tr);
                rowIndex++;
                updateRowCount();

                // Add event listeners for the new row
                const locationSelect = tr.querySelector('.location-select');
                const areaSelect = tr.querySelector('.area-select');

                locationSelect.addEventListener('change', function() {
                    loadAreas(this.value, areaSelect);
                });
            }

            // Load areas for location
            function loadAreas(locationId, areaSelect) {
                areaSelect.innerHTML = '<option value="">Loading...</option>';
                areaSelect.disabled = true;

                if (locationId) {
                    fetch(`/api/locations/${locationId}/areas`)
                        .then(response => response.json())
                        .then(areas => {
                            areaSelect.innerHTML = '<option value="">-</option>';
                            areas.forEach(area => {
                                const option = document.createElement('option');
                                option.value = area.id;
                                option.textContent = area.name;
                                areaSelect.appendChild(option);
                            });
                            areaSelect.disabled = false;
                        })
                        .catch(() => {
                            areaSelect.innerHTML = '<option value="">Error</option>';
                        });
                } else {
                    areaSelect.innerHTML = '<option value="">-</option>';
                }
            }

            // Remove row
            batchBody.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    const row = e.target.closest('tr');
                    row.remove();
                    updateRowCount();
                    renumberRows();
                }
            });

            // Update row count
            function updateRowCount() {
                rowCountSpan.textContent = batchBody.querySelectorAll('tr').length;
            }

            // Renumber rows
            function renumberRows() {
                const rows = batchBody.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
            }

            // Add row button
            addRowBtn.addEventListener('click', addRow);

            // Single form location-area dynamic
            const locationSelect = document.getElementById('location_id');
            const areaSelect = document.getElementById('area_id');

            locationSelect.addEventListener('change', function() {
                loadAreas(this.value, areaSelect);
            });
        });
    </script>
</x-app-layout>
