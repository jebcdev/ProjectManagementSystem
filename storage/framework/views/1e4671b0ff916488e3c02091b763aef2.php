<?php if(session('sessionMessage')): ?>
<div class="flex justify-center my-4">
    <div
        class="bg-gray-800 border border-white text-white text-center rounded-lg px-4 py-2 shadow-lg">
        <?php echo e(session('sessionMessage')); ?>

    </div>
</div>
<?php endif; ?><?php /**PATH D:\laragon\www\ProjectManagementSystem\resources\views\helpers\sessionMessage.blade.php ENDPATH**/ ?>