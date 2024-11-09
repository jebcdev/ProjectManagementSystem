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
                <?php echo e(__('Projects Details')); ?> : <?php echo e($project->name); ?>

            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                href="<?php echo e(route('projects.index')); ?>">
                <?php echo e(__('Projects List')); ?>

            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-2">
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    
                    <?php if ($__env->exists('helpers.sessionMessage')) echo $__env->make('helpers.sessionMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    

                    
                    <?php if ($__env->exists('helpers.errorMessage')) echo $__env->make('helpers.errorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    

                    

                    <div>

                        
                        <div class="bg-gray-700 rounded-lg p-2">
                            <h1 class="font-extrabold text-xl text-center"><?php echo e($project?->name); ?></h1>
                            <div class="mt-2">
                                <?php if($project?->image_path): ?>
                                    <img class="w-20 rounded-full mx-auto object-cover	"
                                        src="<?php echo e(Storage::url($project->image_path)); ?>" alt="<?php echo e($project?->name); ?>">
                                <?php else: ?>
                                    <span class="border rounded-full p-1 inline-block w-32 h-32 text-center text-3xl">
                                        😢
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                        
                        <div class="flex justify-between gap-4">

                            
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Creator')); ?>:</h2>
                                    <?php echo e($project?->creator?->name); ?>

                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Updated By')); ?>:</h2>
                                    <?php echo e($project?->updater ? $project?->updater?->name : __('No Updater')); ?>

                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Status')); ?>:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: <?php echo e($project?->status?->color); ?>;">
                                        <?php echo e($project?->status?->name); ?>

                                    </span>
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Priority')); ?>:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: <?php echo e($project?->priority?->color); ?>;">
                                        <?php echo e($project?->priority?->name); ?>

                                    </span>
                                </span>

                            </div>
                            

                            
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Start Date')); ?>:</h2>
                                    <?php echo e($project?->start_date?->format('Y-m-d')); ?>

                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Due Date')); ?>:</h2>
                                    <?php echo e($project?->due_date ? $project?->due_date->format('Y-m-d') : __('No Due Date')); ?>

                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Created At')); ?>:</h2>
                                    <?php echo e($project?->created_at ? $project?->created_at->format('Y-m-d') : __('No Due Date')); ?>

                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline"><?php echo e(__('Updated At')); ?>:</h2>
                                    <?php echo e($project?->created_at != $project?->updated_at ? $project?->updated_at->format('Y-m-d') : __('Not Updated')); ?>

                                </span>
                            </div>
                            
                            <div>

                                
                                

                            </div>
                        </div>

                        

                    </div>

                    
                    <br><br>
                    <div class="m-5">
                        <?php echo e($project?->description); ?>

                    </div>
                    

                    
                    <br>
                    <form class="flex justify-end gap-3" action="<?php echo e(route('projects.destroy', $project)); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            href="<?php echo e(route('projects.edit', $project)); ?>">
                            <?php echo e(__('Edit')); ?>

                        </a>
                        <button
                            class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit" onclick="return confirm('<?php echo e(__('Are You Sure?')); ?>')">
                            <?php echo e(__('Delete')); ?>

                        </button>

                        <a 
                        class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        href="<?php echo e(route('projects.add-task',$project)); ?>">
                    <?php echo e(__('Add Task')); ?>

                    </a>
                    </form>
                    

                    <?php if($project->tasks->count()): ?>
                        <div class="mt-4">
                            <?php if ($__env->exists('modules.tasks.table', ['tasks' => $project->tasks])) echo $__env->make('modules.tasks.table', ['tasks' => $project->tasks], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>

                    
                </div>
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
<?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views/modules/projects/show.blade.php ENDPATH**/ ?>