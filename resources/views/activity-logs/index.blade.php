<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">{{ __('Log Aktivitas') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <form method="GET" action="{{ route('activity-logs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <select name="user_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="action" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Aksi</option>
                            <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Menambahkan</option>
                            <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Mengubah</option>
                            <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Menghapus</option>
                            <option value="transferred" {{ request('action') == 'transferred' ? 'selected' : '' }}>Memindahkan</option>
                        </select>
                    </div>
                    <div>
                        <select name="model_type" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Tipe</option>
                            <option value="Asset" {{ request('model_type') == 'Asset' ? 'selected' : '' }}>Aset</option>
                            <option value="Employee" {{ request('model_type') == 'Employee' ? 'selected' : '' }}>Karyawan</option>
                            <option value="Category" {{ request('model_type') == 'Category' ? 'selected' : '' }}>Kategori</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">Filter</button>
                        <a href="{{ route('activity-logs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Logs -->
            <div class="space-y-4">
                @forelse($logs as $log)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-4 flex items-start gap-4">
                            <!-- Avatar -->
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                                {{ strtoupper(substr($log->user?->name ?? 'S', 0, 1)) }}
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-semibold text-gray-900">{{ $log->user?->name ?? 'System' }}</span>
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full 
                                        @if($log->action == 'created') bg-green-100 text-green-800
                                        @elseif($log->action == 'updated') bg-yellow-100 text-yellow-800
                                        @elseif($log->action == 'deleted') bg-red-100 text-red-800
                                        @elseif($log->action == 'transferred') bg-purple-100 text-purple-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $log->action_label }}
                                    </span>
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $log->model_name }}
                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 mt-1">{{ $log->description ?? '-' }}</p>

                                <!-- Detail Perubahan untuk Update -->
                                @if($log->action == 'updated' && count($log->changes) > 0)
                                    <div class="mt-3 bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Detail Perubahan:</p>
                                        <div class="space-y-2">
                                            @foreach($log->changes as $change)
                                                <div class="flex items-start text-sm">
                                                    <span class="font-medium text-gray-700 w-32 flex-shrink-0">{{ $change['field'] }}</span>
                                                    <span class="text-gray-400 mx-2">:</span>
                                                    <div class="flex items-center gap-2 flex-wrap">
                                                        <span class="px-2 py-0.5 bg-red-50 text-red-700 rounded text-xs line-through">{{ Str::limit($change['old'], 50) }}</span>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                        </svg>
                                                        <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs">{{ Str::limit($change['new'], 50) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Meta Info -->
                                <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $log->created_at->format('d M Y, H:i:s') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        </svg>
                                        {{ $log->ip_address }}
                                    </span>
                                    @if($log->user?->role)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $log->user->role->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p>Belum ada log aktivitas.</p>
                    </div>
                @endforelse
            </div>

            @if($logs->hasPages())
                <div class="mt-6">{{ $logs->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
