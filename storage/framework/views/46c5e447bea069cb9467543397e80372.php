<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">
                    ID
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Image')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Creator')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Project Name')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Status')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Priority')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Start D')); ?>,
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Due D')); ?>.
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Actions')); ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row"
                        class="px-4 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                        <?php echo e($project?->id); ?>

                    </td>

                    

                    <td class="px-4 py-4 text-center">
                        <?php if($project?->image_path): ?>
                            <img class="w-10 h-10 rounded-full"
                                 src="<?php echo e(Storage::url($project->image_path)); ?>"
                                 alt="<?php echo e($project->name); ?>">
                        <?php else: ?>
                            <span class="border rounded-full p-1 inline-block w-8 h-8 text-center">
                                😢
                            </span>
                        <?php endif; ?>
                    </td>
                    

                    

                    <td class="px-4 py-4 text-center">
                        <?php echo e($project?->creator?->name); ?>

                    </td>
                    <td class="px-4 py-4 text-center">
                        <a class="p-1 border-white border-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 text-wrap"
                            href="<?php echo e(route('projects.show', $project)); ?>" style="word-wrap: break-word; max-width: 150px; display: inline-block; overflow: hidden; text-overflow: ellipsis;">
                            <span class="text-wrap">
                                <?php echo e($project?->name); ?>

                            </span>
                        </a>
                    </td>
                    
                    <td class="px-4 py-4 text-center">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                            style="background-color: <?php echo e($project?->status?->color); ?>;">
                            <?php echo e($project?->status?->name); ?>

                        </span>
                    </td>
                    
                    <td class="px-4 py-4 text-center">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                            style="background-color: <?php echo e($project?->priority?->color); ?>;">
                            <?php echo e($project?->priority?->name); ?>

                        </span>
                    </td>

                    
                    <td class="px-4 py-4 text-center">
                        <?php echo e($project?->start_date?->format('Y-m-d')); ?>

                    </td>
                    <td class="px-4 py-4 text-center">
                        <?php echo e($project?->due_date ? $project?->due_date?->format('Y-m-d') : __('No D. Date')); ?>

                    </td>

                    <td class="px-4 py-4 text-center">
                        <form class="flex justify-center gap-2" action="<?php echo e(route('projects.destroy', $project)); ?>"
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
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="m-2 p-2 border-white">
        <?php echo e($projects->links()); ?>

    </div>
</div>
<?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views\modules\projects\table.blade.php ENDPATH**/ ?>