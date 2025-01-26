
<?php $__env->startSection('title', 'About Us | ' . config('app.name')); ?>

<?php $__env->startSection('header'); ?>
    <section class="header-section text-center"
        style="background-image: url('/images/webp/about.webp');background-position: center;">
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-3 py-3">
        <?php echo $about; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/about/show.blade.php ENDPATH**/ ?>