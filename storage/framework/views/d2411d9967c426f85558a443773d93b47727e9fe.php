
<?php $__env->startSection('title', '403 Access denied!'); ?>
<?php $__env->startSection('content'); ?>
    <h1>403</h1>
    <h3>Access denied!</h3>
    <p>
        You do not have permission to access this feature.
    </p>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/special-bites.com/resources/views/errors/403.blade.php ENDPATH**/ ?>