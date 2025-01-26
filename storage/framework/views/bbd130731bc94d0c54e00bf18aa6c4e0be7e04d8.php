<!DOCTYPE html>
<html lang="en" dir="ltr" translate="yes">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="theme-color" content="#ffffff">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <link rel="preload" href="<?php echo e(mix('css/app.css')); ?>" as="style" />
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <style> html,body{height: 100%}</style>
    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body>
    <div class="container-fluid h-100" id="app">
        <div class="row h-100 justify-content-center align-items-center">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

</body>

</html>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>
<?php /**PATH /home/caliisbw/public_html/resources/views/admin/auth/master.blade.php ENDPATH**/ ?>