<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" dir="<?php echo e(config('app.dir')); ?>" translate="<?php echo e(config('app.translate')); ?>">

<head>

    <?php if(app()->environment('production')): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('app.gtag')); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', "<?php echo e(config('app.gtag')); ?>");
        </script>
        <meta name="google-site-verification" content="<?php echo e(config('app.google_site_verification')); ?>" />
    <?php endif; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#46210d">
    <meta name="msapplication-TileColor" content="#441b05">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php echo $__env->make('seotools.metatags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('seotools.opengraph', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('seotools.twitter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('seotools.json-ld', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="preload" href="<?php echo e(mix('css/app.css')); ?>" as="style" />
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
    <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php echo $__env->yieldPushContent('style'); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<?php
    $isHomeRoute = Route::currentRouteName() == 'home';
?>

<body class="padding-top-55">

    <div id="app">
        <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.sidebar-items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->renderWhen($isHomeRoute, 'layouts.info-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php echo $__env->yieldContent('header'); ?>
        <?php echo $__env->renderWhen($isHomeRoute, 'layouts.global-alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php echo $__env->renderWhen($isHomeRoute, 'layouts.carousel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <div class="<?php if($isHomeRoute): ?> container-fluid  <?php else: ?> container <?php endif; ?> py-2">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <back-to-top-component></back-to-top-component>
    </div>
    
</body>

</html>
<script defer src="<?php echo e(mix('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>
<?php /**PATH /home/caliisbw/special-bites.com/resources/views/layouts/app.blade.php ENDPATH**/ ?>