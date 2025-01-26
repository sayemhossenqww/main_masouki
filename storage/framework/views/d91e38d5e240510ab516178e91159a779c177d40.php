<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('style'); ?>
    <style>
        body,
        html {
            height: 90%;
        }

        h1 {
            font-size: 150px;
            font-weight: 300
        }

        .text-shadow {
            text-shadow: 1px 2px 5px rgba(0, 0, 0, 1);
        }

    </style>

</head>

<body>
    <div class="container h-100">
        <div class="row h-100 text-center align-items-center">
            <div class="col-12">

            </div>
            <div class="col-12">
        
                <?php echo $__env->yieldContent('content'); ?>
                <div class="mt-3">
                    <img src="<?php echo e(asset('images/webp/logo.png')); ?>" class="img-fluid mb-3" alt="Caliburger">
                    <?php echo $__env->make('layouts.social-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="<?php echo e(mix('js/app.js')); ?>"></script>
<?php /**PATH /home/caliisbw/public_html/resources/views/errors/master.blade.php ENDPATH**/ ?>