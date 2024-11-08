<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">
                    ID
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Name')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Color')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Description')); ?>

                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    <?php echo e(__('Actions')); ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row"
                        class="px-4 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                        <?php echo e($status->id); ?>

                    </td>
                    <td class="px-4 py-4 text-center">
                        <?php echo e($status->name); ?>

                    </td>
                    <td class="px-4 py-4 text-center">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                            style="background-color: <?php echo e($status->color); ?>;">
                            <?php echo e($status->color); ?>

                        </span>
                    </td>

                    <td class="px-4 py-4 text-center">
                        <?php echo e($status->description); ?>

                    </td>
                    <td class="px-4 py-4 text-center">
                        <form class="flex justify-center gap-2" action="<?php echo e(route('admin.statuses.destroy', $status)); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                href="<?php echo e(route('admin.statuses.edit', $status)); ?>">
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
</div>
<?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views\modules\admin\statuses\table.blade.php ENDPATH**/ ?>