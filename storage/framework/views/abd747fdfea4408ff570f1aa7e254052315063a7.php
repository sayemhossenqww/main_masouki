
<?php $__env->startSection('title', 'Admin Login'); ?>


<?php $__env->startSection('content'); ?>
    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12">
        <div class=" text-center mb-3">
            <img src="<?php echo e(asset('images/webp/logo.png')); ?>" alt="Caliburger">
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Admin</h5>
                <h6 class="card-subtitle mb-2 text-muted">Login</h6>
                <admin-login-component></admin-login-component>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>