<nav class="navbar navbar-expand navbar-light bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link text-dark">
                    <?php if($is_store_open): ?>
                        <img src="<?php echo e(asset('images/open-20x20.png')); ?>" alt="Open"> Open
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/closed-20x20.png')); ?>" alt="closed"> Closed
                    <?php endif; ?>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            

            <li class="nav-item">
                <a class="nav-link text-facebook" href="https://facebook.com/<?php echo e(config('app.facebook_username')); ?>"
                    target="_blank">
                    <img src="<?php echo e(asset('images/webp/social-icons/facebook.webp')); ?>" width="20" height="20"
                        alt="facebook">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-facebook"
                    href="https://www.facebook.com/messages/t/<?php echo e(config('app.messenger_id')); ?>" target="_blank">
                    <img src="<?php echo e(asset('images/webp/social-icons/messenger.webp')); ?>" width="20" height="20"
                        alt="facebook messenger">
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-black" href="https://www.instagram.com/<?php echo e(config('app.instagram_username')); ?>"
                    target="_blank">
                    <img src="<?php echo e(asset('images/webp/social-icons/instagram.webp')); ?>" width="20" height="20"
                        alt="instagram">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="https://www.tiktok.com/<?php echo e(config('app.tiktok_username')); ?>"
                    target="_blank">
                    <img src="<?php echo e(asset('images/webp/social-icons/tiktok.webp')); ?>" width="20" height="20"
                        alt="tiktok">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-whatsapp" href="https://wa.me/<?php echo e(config('app.whatsapp')); ?>" target="_blank">
                    <img src="<?php echo e(asset('images/webp/social-icons/whatsapp.webp')); ?>" width="20" height="20"
                        alt="whatsapp">
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/layouts/info-navbar.blade.php ENDPATH**/ ?>