
<?php $__env->startSection('title', 'Profile - ' . $user->name); ?>
<?php $__env->startSection('page_name', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.profile.partials.update-password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/profile/show.blade.php ENDPATH**/ ?>