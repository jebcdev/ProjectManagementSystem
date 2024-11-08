<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo e(__('Dashboard')); ?>

            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                href="<?php echo e(route('dashboard')); ?>">
                <?php echo e(__('Dashboard')); ?>

            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-2">
        
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100 mb-4">

                    

                    <div>

                        <?php if ($__env->exists('modules._dashboard.partials.admin-menu')) echo $__env->make('modules._dashboard.partials.admin-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div></div></div>
                
                <br>
                
                <div class="mx-auto sm:px-4 lg:px-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-evenly">

                        
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3">
                            <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                <?php echo e(__('Projects Stats')); ?></h2>

                            <div class="mt-4 text-gray-800 dark:text-gray-200 w-full">
                                <span
                                    class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <?php echo e(__('Total Projects')); ?>:
                                    <span
                                        class="font-semibold text-gray-900 dark:text-gray-100"><?php echo e($projects?->count()); ?></span></span>
                            </div>

                            <div class="flex justify-between gap-10">
                                
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        <?php echo e(__('By Statuses')); ?></h3>
                                    <ul class="space-y-4 mt-4">
                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: <?php echo e($status?->color); ?>; hover:bg: <?php echo e($status?->color); ?>;">
                                                    <?php echo e($status?->name); ?></h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    <?php echo e($status?->projects?->count()); ?>

                                                    <?php echo e(Str::plural(__('Project'), $status?->projects?->count())); ?>


                                                </p>
                                            </a>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                

                                
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        <?php echo e(__('By Priorities')); ?></h3>
                                    <ul class="space-y-4 mt-4">
                                        <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: <?php echo e($priority?->color); ?>; hover:bg: <?php echo e($priority?->color); ?>;">
                                                    <?php echo e($priority?->name); ?></h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    <?php echo e($priority?->projects?->count()); ?>

                                                    <?php echo e(Str::plural(__('Project'), $priority?->projects?->count())); ?>


                                                </p>
                                            </a>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        

                        
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3">
                            <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                <?php echo e(__('Tasks Stats')); ?></h2>

                               <div class="mt-4 text-gray-800 dark:text-gray-200">
                                <span
                                    class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <?php echo e(__('Total Tasks')); ?>:
                                    <span
                                        class="font-semibold text-gray-900 dark:text-gray-100"><?php echo e($tasks?->count()); ?></span></span>
                            </div>
                            <div class="flex justify-between gap-10">
                                
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        <?php echo e(__('By Statuses')); ?></h3>
                                    <ul class="space-y-4 mt-4">
                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: <?php echo e($status?->color); ?>; hover:bg: <?php echo e($status?->color); ?>;">
                                                    <?php echo e($status?->name); ?></h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    <?php echo e($status?->tasks?->count()); ?>

                                                    <?php echo e(Str::plural(__('Project'), $status?->tasks?->count())); ?>


                                                </p>
                                            </a>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                

                                
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        <?php echo e(__('By Priorities')); ?></h3>
                                    <ul class="space-y-4 mt-4">
                                        <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: <?php echo e($priority?->color); ?>; hover:bg: <?php echo e($priority?->color); ?>;">
                                                    <?php echo e($priority?->name); ?></h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    <?php echo e($priority?->tasks?->count()); ?>

                                                    <?php echo e(Str::plural(__('Project'), $priority?->tasks?->count())); ?>


                                                </p>
                                            </a>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        

                    </div>


                    
                </div>
            </div></div></div>
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
<?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views/modules/_dashboard/index.blade.php ENDPATH**/ ?>