
<?php $__env->startSection('title', 'Settings'); ?>
    <?php $__env->startPush('style'); ?>
        <style>
            .container {
                height: 0% !important;
            }

        </style>

    <?php $__env->stopPush(); ?>
<?php $__env->startSection('page_name', 'Settings'); ?>
<?php $__env->startSection('content'); ?>
<settings-component></settings-component>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/special-bites.com/resources/views/admin/settings/show.blade.php ENDPATH**/ ?>