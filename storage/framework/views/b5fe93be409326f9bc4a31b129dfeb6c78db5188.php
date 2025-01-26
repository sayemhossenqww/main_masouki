
<?php $__env->startSection('title', 'Menu Items'); ?>
<?php $__env->startSection('page_name', 'Menu Items'); ?>

<?php $__env->startSection('content'); ?>
    <item-component usd-rate-value="<?php echo e($usdRate); ?>"></item-component>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/items/show.blade.php ENDPATH**/ ?>