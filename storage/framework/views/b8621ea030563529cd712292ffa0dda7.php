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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-2xl text-gray-800 leading-tight"><?php echo e(__('Log Aktivitas')); ?></h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <form method="GET" action="<?php echo e(route('activity-logs.index')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <select name="user_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua User</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e(request('user_id') == $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <select name="action" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Aksi</option>
                            <option value="created" <?php echo e(request('action') == 'created' ? 'selected' : ''); ?>>Menambahkan</option>
                            <option value="updated" <?php echo e(request('action') == 'updated' ? 'selected' : ''); ?>>Mengubah</option>
                            <option value="deleted" <?php echo e(request('action') == 'deleted' ? 'selected' : ''); ?>>Menghapus</option>
                            <option value="transferred" <?php echo e(request('action') == 'transferred' ? 'selected' : ''); ?>>Memindahkan</option>
                        </select>
                    </div>
                    <div>
                        <select name="model_type" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Tipe</option>
                            <option value="Asset" <?php echo e(request('model_type') == 'Asset' ? 'selected' : ''); ?>>Aset</option>
                            <option value="Employee" <?php echo e(request('model_type') == 'Employee' ? 'selected' : ''); ?>>Karyawan</option>
                            <option value="Category" <?php echo e(request('model_type') == 'Category' ? 'selected' : ''); ?>>Kategori</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">Filter</button>
                        <a href="<?php echo e(route('activity-logs.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Logs -->
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-4 flex items-start gap-4">
                            <!-- Avatar -->
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                                <?php echo e(strtoupper(substr($log->user?->name ?? 'S', 0, 1))); ?>

                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-semibold text-gray-900"><?php echo e($log->user?->name ?? 'System'); ?></span>
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full 
                                        <?php if($log->action == 'created'): ?> bg-green-100 text-green-800
                                        <?php elseif($log->action == 'updated'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($log->action == 'deleted'): ?> bg-red-100 text-red-800
                                        <?php elseif($log->action == 'transferred'): ?> bg-purple-100 text-purple-800
                                        <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                        <?php echo e($log->action_label); ?>

                                    </span>
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        <?php echo e($log->model_name); ?>

                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 mt-1"><?php echo e($log->description ?? '-'); ?></p>

                                <!-- Detail Perubahan untuk Update -->
                                <?php if($log->action == 'updated' && count($log->changes) > 0): ?>
                                    <div class="mt-3 bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Detail Perubahan:</p>
                                        <div class="space-y-2">
                                            <?php $__currentLoopData = $log->changes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="flex items-start text-sm">
                                                    <span class="font-medium text-gray-700 w-32 flex-shrink-0"><?php echo e($change['field']); ?></span>
                                                    <span class="text-gray-400 mx-2">:</span>
                                                    <div class="flex items-center gap-2 flex-wrap">
                                                        <span class="px-2 py-0.5 bg-red-50 text-red-700 rounded text-xs line-through"><?php echo e(Str::limit($change['old'], 50)); ?></span>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                        </svg>
                                                        <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs"><?php echo e(Str::limit($change['new'], 50)); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Meta Info -->
                                <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <?php echo e($log->created_at->format('d M Y, H:i:s')); ?>

                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        </svg>
                                        <?php echo e($log->ip_address); ?>

                                    </span>
                                    <?php if($log->user?->role): ?>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <?php echo e($log->user->role->name); ?>

                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p>Belum ada log aktivitas.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($logs->hasPages()): ?>
                <div class="mt-6"><?php echo e($logs->links()); ?></div>
            <?php endif; ?>
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
<?php /**PATH D:\Assets\assets-management\resources\views/activity-logs/index.blade.php ENDPATH**/ ?>