
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page_name', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.dashboard.partials.cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?php echo $__env->make('admin.dashboard.partials.orders-chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-md-6 mb-3">
            <?php echo $__env->make('admin.dashboard.partials.sales-chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
   

    <?php echo $__env->make('admin.dashboard.partials.latest-orders-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.dashboard.partials.popular-items-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.dashboard.partials.orders-report-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/dashboard/show.blade.php ENDPATH**/ ?>