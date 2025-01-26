
<?php $__env->startSection('title', '404 Page Not Found'); ?>

<?php $__env->startSection('content'); ?>
    <h1>404</h1>
    <h3>Oops! Page Not Found</h3>
    <p>The page you requested was not found</p>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/errors/404.blade.php ENDPATH**/ ?>