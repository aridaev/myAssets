<x-app-layout>
    <x-slot name="header">Daftar Aset</x-slot>

    <!-- Filters & Actions -->
    <div class="bg-white rounded-lg border border-gray-200 p-3 mb-4">
        <form method="GET" action="{{ route('assets.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-48">
            <select name="category_id" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 w-36">
                <option value="">Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <select name="status" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 w-32">
                <option value="">Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="in_use" {{ request('status') == 'in_use' ? 'selected' : '' }}>Digunakan</option>
                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="retired" {{ request('status') == 'retired' ? 'selected' : '' }}>Retired</option>
                <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Hilang</option>
            </select>
            <button type="submit" class="px-3 py-1.5 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Filter</button>
            <a href="{{ route('assets.index') }}" class="px-3 py-1.5 text-sm text-gray-500 hover:text-gray-700">Reset</a>
            <div class="flex-1"></div>
            <a href="{{ route('assets.create') }}" class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah</a>
        </form>
    </div>

    <!-- Assets Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Asset Tag</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Model</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Karyawan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($assets as $asset)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <div class="font-medium text-gray-900">{{ $asset->asset_tag }}</div>
                                <div class="text-xs text-gray-500">{{ $asset->barcode }}</div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="text-gray-900">{{ $asset->model_name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $asset->manufacturer ?? '' }}</div>
                            </td>
                            <td class="px-4 py-2 text-gray-600">{{ $asset->category?->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <div class="text-gray-900">{{ $asset->location?->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $asset->area?->name ?? '' }}</div>
                            </td>
                            <td class="px-4 py-2 text-gray-600">{{ $asset->employee?->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $asset->status_badge }}">{{ $asset->status_label }}</span>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('assets.show', $asset) }}" class="p-1 text-gray-500 hover:text-blue-600" title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('assets.edit', $asset) }}" class="p-1 text-gray-500 hover:text-yellow-600" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-gray-500 hover:text-red-600" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <p>Belum ada aset.</p>
                                <a href="{{ route('assets.create') }}" class="text-blue-600 hover:text-blue-800 text-sm">Tambah aset pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($assets->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $assets->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
