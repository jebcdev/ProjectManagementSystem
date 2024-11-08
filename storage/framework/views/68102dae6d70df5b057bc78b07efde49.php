
<div class="overflow-x-auto">
    <table class="min-w-full table-auto" id="table">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="px-4 py-2 text-left"><?php echo e(__('Name')); ?></th>
                <th class="px-4 py-2 text-left"><?php echo e(__('Email')); ?></th>
                <th class="px-4 py-2 text-left"><?php echo e(__('Is Admin')); ?></th>
                <th class="px-4 py-2 text-center"><?php echo e(__('Actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b dark:border-gray-600">
                    <td class="px-4 py-2"><?php echo e($user->name); ?></td>
                    <td class="px-4 py-2"><?php echo e($user->email); ?></td>
                    <td class="px-4 py-2"><?php echo e($user->isAdmin ? __('Yes') : __('No')); ?></td>
                    <td class="px-4 py-4 text-center">
                        <form class="flex justify-center gap-2" action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                href="<?php echo e(route('admin.users.edit', $user)); ?>">
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
    
    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views\modules\admin\users\table.blade.php ENDPATH**/ ?>