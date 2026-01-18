<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> Dashboard <?php $__env->endSlot(); ?>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-4">
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['total_assets']); ?></p>
                    <p class="text-xs text-gray-500">Total Aset</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['available_assets']); ?></p>
                    <p class="text-xs text-gray-500">Tersedia</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['in_use_assets']); ?></p>
                    <p class="text-xs text-gray-500">Dipakai</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['maintenance_assets']); ?></p>
                    <p class="text-xs text-gray-500">Maintenance</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['retired_assets']); ?></p>
                    <p class="text-xs text-gray-500">Retired</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($stats['lost_assets']); ?></p>
                    <p class="text-xs text-gray-500">Hilang</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-2 mb-4">
        <a href="<?php echo e(route('assets.create')); ?>" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Aset
        </a>
        <a href="<?php echo e(route('assets.index')); ?>" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
            Lihat Semua
        </a>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
        <!-- Aset per Kategori -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-sm font-semibold text-gray-800 mb-3">Aset per Kategori</h3>
            <?php if($assetsByCategory->count() > 0): ?>
                <div class="space-y-2">
                    <?php $__currentLoopData = $assetsByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 truncate"><?php echo e($category->name); ?></span>
                            <span class="font-medium text-gray-900"><?php echo e($category->assets_count); ?></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-blue-500 h-1.5 rounded-full" style="width: <?php echo e($stats['total_assets'] > 0 ? ($category->assets_count / $stats['total_assets']) * 100 : 0); ?>%"></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-sm text-gray-500 text-center py-4">Belum ada data</p>
            <?php endif; ?>
        </div>

        <!-- Aset per Lokasi -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-sm font-semibold text-gray-800 mb-3">Aset per Lokasi</h3>
            <?php if($assetsByLocation->count() > 0): ?>
                <div class="space-y-2">
                    <?php $__currentLoopData = $assetsByLocation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 truncate"><?php echo e($location->name); ?></span>
                            <span class="font-medium text-gray-900"><?php echo e($location->assets_count); ?></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full" style="width: <?php echo e($stats['total_assets'] > 0 ? ($location->assets_count / $stats['total_assets']) * 100 : 0); ?>%"></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-sm text-gray-500 text-center py-4">Belum ada data</p>
            <?php endif; ?>
        </div>

        <!-- Status Penggunaan -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-sm font-semibold text-gray-800 mb-3">Status Penggunaan</h3>
            <div class="flex items-center justify-center">
                <div class="relative w-24 h-24">
                    <svg class="w-24 h-24 transform -rotate-90">
                        <circle cx="48" cy="48" r="40" stroke="#e5e7eb" stroke-width="8" fill="none"/>
                        <?php
                            $usedPercent = $stats['total_assets'] > 0 ? ($stats['used_assets'] / $stats['total_assets']) * 100 : 0;
                            $circumference = 2 * 3.14159 * 40;
                            $offset = $circumference - ($usedPercent / 100) * $circumference;
                        ?>
                        <circle cx="48" cy="48" r="40" stroke="#3b82f6" stroke-width="8" fill="none" stroke-dasharray="<?php echo e($circumference); ?>" stroke-dashoffset="<?php echo e($offset); ?>" stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800"><?php echo e(round($usedPercent)); ?>%</span>
                    </div>
                </div>
            </div>
            <div class="mt-3 grid grid-cols-2 gap-2 text-center">
                <div>
                    <p class="text-lg font-bold text-blue-600"><?php echo e($stats['used_assets']); ?></p>
                    <p class="text-xs text-gray-500">Digunakan</p>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-400"><?php echo e($stats['unused_assets']); ?></p>
                    <p class="text-xs text-gray-500">Tidak</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Assets & Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Aset Terbaru -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">Aset Terbaru</h3>
                <a href="<?php echo e(route('assets.index')); ?>" class="text-xs text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <?php if($recentAssets->count() > 0): ?>
                <div class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $recentAssets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('assets.show', $asset)); ?>" class="flex items-center px-4 py-2.5 hover:bg-gray-50 transition-colors">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate"><?php echo e($asset->asset_tag); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($asset->category?->name ?? '-'); ?></p>
                            </div>
                            <span class="px-2 py-0.5 text-xs font-medium rounded-full <?php echo e($asset->status_badge); ?>"><?php echo e($asset->status_label); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="p-6 text-center text-gray-500 text-sm">
                    <p>Belum ada aset</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if(Auth::user()->isSuperAdmin() && count($recentActivities) > 0): ?>
        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">Aktivitas Terbaru</h3>
                <a href="<?php echo e(route('activity-logs.index')); ?>" class="text-xs text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center px-4 py-2.5">
                        <div class="w-7 h-7 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-medium mr-3">
                            <?php echo e(strtoupper(substr($activity->user?->name ?? 'S', 0, 1))); ?>

                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">
                                <span class="font-medium"><?php echo e($activity->user?->name ?? 'System'); ?></span>
                                <span class="px-1.5 py-0.5 text-xs font-medium rounded mx-1
                                    <?php if($activity->action == 'created'): ?> bg-green-100 text-green-700
                                    <?php elseif($activity->action == 'updated'): ?> bg-yellow-100 text-yellow-700
                                    <?php elseif($activity->action == 'deleted'): ?> bg-red-100 text-red-700
                                    <?php else: ?> bg-gray-100 text-gray-700 <?php endif; ?>">
                                    <?php echo e($activity->action_label); ?>

                                </span>
                            </p>
                            <p class="text-xs text-gray-500"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Master Data Summary -->
    <div class="grid grid-cols-4 gap-3 mt-4">
        <div class="bg-white rounded-lg border border-gray-200 p-3 text-center">
            <p class="text-2xl font-bold text-purple-600"><?php echo e($stats['total_categories']); ?></p>
            <p class="text-xs text-gray-500">Kategori</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3 text-center">
            <p class="text-2xl font-bold text-green-600"><?php echo e($stats['total_locations']); ?></p>
            <p class="text-xs text-gray-500">Lokasi</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3 text-center">
            <p class="text-2xl font-bold text-blue-600"><?php echo e($stats['total_areas']); ?></p>
            <p class="text-xs text-gray-500">Area</p>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-3 text-center">
            <p class="text-2xl font-bold text-orange-600"><?php echo e($stats['total_employees']); ?></p>
            <p class="text-xs text-gray-500">Karyawan</p>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\Assets\assets-management\resources\views/dashboard.blade.php ENDPATH**/ ?>