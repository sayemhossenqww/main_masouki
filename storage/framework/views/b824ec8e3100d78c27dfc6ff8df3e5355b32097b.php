
<?php $__env->startSection('title', 'Submit your order'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(!$is_store_open): ?>
        <div class="alert alert-warning shadow-sm alert-dismissible mt-3 fade show rounded-main" role="alert">
            <mt-icon icon="info" styleName="me-1"></mt-icon> <?php echo e($closed_message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <submit-order-component></submit-order-component>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/order/show.blade.php ENDPATH**/ ?>