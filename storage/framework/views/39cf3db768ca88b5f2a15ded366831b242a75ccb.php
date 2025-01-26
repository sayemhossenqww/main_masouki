<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <a class="navbar-toggler d-block" href="#" id="menu-toggle">
        <mt-icon icon="menu"></mt-icon>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <mt-icon icon="menu"></mt-icon>
    </button>


    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if(auth()->guard()->check()): ?>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <store-status-component></store-status-component>
                        </a>

                    </li>

                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                    <li class="nav-item dropdown">
                        <notification-component></notification-component>
                    </li>
                    <li class="nav-item" id="full-screen-btn">
                        <a class="nav-link" href="#"><mt-icon icon="fullscreen"></mt-icon></a>
                    </li>
                    <li class="nav-item d-none" id="default-screen-btn">
                        <a class="nav-link" href="#"><mt-icon icon="fullscreen_exit"></mt-icon></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo e(Auth::user()->profile_photo_url); ?>" alt="<?php echo e(Auth::user()->name); ?>" height="30"
                                class="me-1 rounded-circle"> <?php echo e(Auth::user()->first_name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('home')); ?>">
                                    <mt-icon icon="storefront" styleName="me-2"></mt-icon> <?php echo app('translator')->get('Caliburger'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
                                    <mt-icon icon="manage_accounts" styleName="me-2"></mt-icon> <?php echo app('translator')->get('Profile'); ?>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>"
                                    onclick="event.preventDefault();
                                                                                                                                                                                                                                            document.getElementById('logout-form').submit();">
                                    <mt-icon icon="logout" styleName="me-2"></mt-icon> <?php echo app('translator')->get('Logout'); ?>
                                </a>
                                <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST"
                                    class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php $__env->startPush('script'); ?>
    <script>
        var elemFull = document.querySelector('#full-screen-btn');
        var elemDefault = document.querySelector('#default-screen-btn');

        elemFull.addEventListener('click', function() {
            toggleFullScreen();
        });
        elemDefault.addEventListener('click', function() {
            toggleFullScreen();
        });

        function toggleFullScreen() {
            if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                if (document.documentElement.requestFullScreen) {
                    document.documentElement.requestFullScreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullScreen) {
                    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
                elemFull.classList.add('d-none');
                elemDefault.classList.remove('d-none');
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
                elemFull.classList.remove('d-none');
                elemDefault.classList.add('d-none');
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/admin/layouts/navbar.blade.php ENDPATH**/ ?>