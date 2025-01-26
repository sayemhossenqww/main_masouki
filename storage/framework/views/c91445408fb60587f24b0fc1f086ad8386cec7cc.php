<!DOCTYPE html>
<html lang="en">
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
    <link rel="preload" href="<?php echo e(mix('css/app.v2.css')); ?>" as="style" />
    <link rel="stylesheet" href="<?php echo e(mix('css/app.v2.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php echo $__env->yieldPushContent('style'); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body>
    <div id="app">
        <div class="layout">
            <main class="main">
                <div class="content">
                    <?php if(Route::currentRouteName() == 'category.items.show'): ?>
                        <div class="fixed-top wrapper mt-3">
                            <a href="<?php echo e(route('home')); ?>" class="back-button bruvs-link">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#c9c9c9"
                                    aria-hidden="true" width="24" height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                        stroke-width="1.5" d="M9.57 5.93L3.5 12l6.07 6.07M20.5 12H3.67" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="content-header wrapper">
                        <div class="content-header-bg"
                            style="background-image:url(/images/27c90fc3-2c59-454f-a5fb-19e487a19abf.jpg);">
                        </div>
                    </div>
                    <div class="content-body wrapper">
                        <h1 class="title">Cali Burger</h1>
                        <div class="info">
                            <a href="https://goo.gl/maps/RLqnQEz7pMTWdDvX6" class="d-flex align-items-center gap-2"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true" height="16" width="16">
                                    <path stroke-width="1.5" d="M12 13.43a3.12 3.12 0 100-6.24 3.12 3.12 0 000 6.24z" />
                                    <path stroke-width="1.5"
                                        d="M3.62 8.49c1.97-8.66 14.8-8.65 16.76.01 1.15 5.08-2.01 9.38-4.78 12.04a5.193 5.193 0 01-7.21 0c-2.76-2.66-5.92-6.97-4.77-12.05z" />
                                </svg>
                                <!-- Baalback, attaibeh main road -->
                                Eden Htel, Jdeide, Mont-Liban
                            </a>
                            <a href="tel:+96181216711" class="d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true" height="16" width="16">
                                    <path stroke-miterlimit="10" stroke-width="1.5"
                                        d="M21.97 18.33c0 .36-.08.73-.25 1.09-.17.36-.39.7-.68 1.02-.49.54-1.03.93-1.64 1.18-.6.25-1.25.38-1.95.38-1.02 0-2.11-.24-3.26-.73s-2.3-1.15-3.44-1.98a28.75 28.75 0 01-3.28-2.8 28.414 28.414 0 01-2.79-3.27c-.82-1.14-1.48-2.28-1.96-3.41C2.24 8.67 2 7.58 2 6.54c0-.68.12-1.33.36-1.93.24-.61.62-1.17 1.15-1.67C4.15 2.31 4.85 2 5.59 2c.28 0 .56.06.81.18.26.12.49.3.67.56l2.32 3.27c.18.25.31.48.4.7.09.21.14.42.14.61 0 .24-.07.48-.21.71-.13.23-.32.47-.56.71l-.76.79c-.11.11-.16.24-.16.4 0 .08.01.15.03.23.03.08.06.14.08.2.18.33.49.76.93 1.28.45.52.93 1.05 1.45 1.58.54.53 1.06 1.02 1.59 1.47.52.44.95.74 1.29.92.05.02.11.05.18.08.08.03.16.04.25.04.17 0 .3-.06.41-.17l.76-.75c.25-.25.49-.44.72-.56.23-.14.46-.21.71-.21.19 0 .39.04.61.13.22.09.45.22.7.39l3.31 2.35c.26.18.44.39.55.64.1.25.16.5.16.78z" />
                                </svg>
                                <!-- +961 70 615 556 -->
                                Beirut: +961 81 216 711
                            </a>
                            <a href="tel:+96171924414" class="d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true" height="16" width="16">
                                    <path stroke-miterlimit="10" stroke-width="1.5"
                                        d="M21.97 18.33c0 .36-.08.73-.25 1.09-.17.36-.39.7-.68 1.02-.49.54-1.03.93-1.64 1.18-.6.25-1.25.38-1.95.38-1.02 0-2.11-.24-3.26-.73s-2.3-1.15-3.44-1.98a28.75 28.75 0 01-3.28-2.8 28.414 28.414 0 01-2.79-3.27c-.82-1.14-1.48-2.28-1.96-3.41C2.24 8.67 2 7.58 2 6.54c0-.68.12-1.33.36-1.93.24-.61.62-1.17 1.15-1.67C4.15 2.31 4.85 2 5.59 2c.28 0 .56.06.81.18.26.12.49.3.67.56l2.32 3.27c.18.25.31.48.4.7.09.21.14.42.14.61 0 .24-.07.48-.21.71-.13.23-.32.47-.56.71l-.76.79c-.11.11-.16.24-.16.4 0 .08.01.15.03.23.03.08.06.14.08.2.18.33.49.76.93 1.28.45.52.93 1.05 1.45 1.58.54.53 1.06 1.02 1.59 1.47.52.44.95.74 1.29.92.05.02.11.05.18.08.08.03.16.04.25.04.17 0 .3-.06.41-.17l.76-.75c.25-.25.49-.44.72-.56.23-.14.46-.21.71-.21.19 0 .39.04.61.13.22.09.45.22.7.39l3.31 2.35c.26.18.44.39.55.64.1.25.16.5.16.78z" />
                                </svg>
                                <!-- +961 70 615 556 -->
                                Broumana: +961 71 924 414
                            </a>
                            <a href="tel:+96176676795" class="d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true" height="16" width="16">
                                    <path stroke-miterlimit="10" stroke-width="1.5"
                                        d="M21.97 18.33c0 .36-.08.73-.25 1.09-.17.36-.39.7-.68 1.02-.49.54-1.03.93-1.64 1.18-.6.25-1.25.38-1.95.38-1.02 0-2.11-.24-3.26-.73s-2.3-1.15-3.44-1.98a28.75 28.75 0 01-3.28-2.8 28.414 28.414 0 01-2.79-3.27c-.82-1.14-1.48-2.28-1.96-3.41C2.24 8.67 2 7.58 2 6.54c0-.68.12-1.33.36-1.93.24-.61.62-1.17 1.15-1.67C4.15 2.31 4.85 2 5.59 2c.28 0 .56.06.81.18.26.12.49.3.67.56l2.32 3.27c.18.25.31.48.4.7.09.21.14.42.14.61 0 .24-.07.48-.21.71-.13.23-.32.47-.56.71l-.76.79c-.11.11-.16.24-.16.4 0 .08.01.15.03.23.03.08.06.14.08.2.18.33.49.76.93 1.28.45.52.93 1.05 1.45 1.58.54.53 1.06 1.02 1.59 1.47.52.44.95.74 1.29.92.05.02.11.05.18.08.08.03.16.04.25.04.17 0 .3-.06.41-.17l.76-.75c.25-.25.49-.44.72-.56.23-.14.46-.21.71-.21.19 0 .39.04.61.13.22.09.45.22.7.39l3.31 2.35c.26.18.44.39.55.64.1.25.16.5.16.78z" />
                                </svg>
                                <!-- +961 70 615 556 -->
                                Jounieh: +961 76 676 795
                            </a>
                        </div>
                        <?php echo $__env->yieldContent('content'); ?>
                        <div class="content-footer">
                            The Cali Burger © 2024 Copyright
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
</body>

</html>
<script defer src="<?php echo e(mix('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/layouts/app_v2.blade.php ENDPATH**/ ?>