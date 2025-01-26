<div class="py-5 bg-white">
    <div class="text-center h4 fw-bold">Give us a follow</div>
    <div class="d-flex justify-content-center">
        <a href="https://facebook.com/<?php echo e(config('app.facebook_username')); ?>" class="px-2">
            <img src="<?php echo e(asset('images/circle_facebook.png')); ?>" width="45" height="45" alt="facebook">
        </a>
        <a href="https://www.instagram.com/<?php echo e(config('app.instagram_username')); ?>" class="px-2">
            <img src="<?php echo e(asset('images/circle_instagram.png')); ?>" width="45" height="45" alt="instagram">
        </a>
        <a href="https://tiktok.com/<?php echo e(config('app.tiktok_username')); ?>" class="px-2">
            <img src="<?php echo e(asset('images/circle_tiktok.png')); ?>" width="45" height="45" alt="tiktok">
        </a>

    </div>
    
</div>
<footer class="bg-body text-center text-lg-start border-top shadow-sm"
    style="background-image: url(/images/webp/hero_footer.webp);
    background-position-y: 0px;">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row mb-3">
            <!--Grid column-->
            <div class="col-md-12 mb-3 text-center">
                <div class="mb-2">
                    <img src="<?php echo e(asset('images/webp/logo.webp')); ?>" alt="The Bruvs">
                </div>
                <div class="h3 text-white">In cooking, as in all the arts, simplicity is the sign of perfection.</div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-12 mb-3">

                <ul class="list-inline mb-0 text-center">
                    <li class="list-inline-item">
                        <a class="link-primary" href="<?php echo e(route('home')); ?>">Our Menu</a>
                    </li>
                    <span class="px-2 fw-bold">·</span>
                    <li class="list-inline-item">
                        <a class="link-primary" href="<?php echo e(route('contact')); ?>">Contact</a>
                    </li>
                    <span class="px-2 fw-bold">·</span>
                    <li class="list-inline-item">
                        <a class="link-primary" href="<?php echo e(route('about')); ?>">About Us</a>
                    </li>
                    <span class="px-2 fw-bold">·</span>
                    <li class="list-inline-item">
                        <a class="link-primary" href="<?php echo e(route('privacy.show')); ?>">Privacy Policy</a>
                    </li>
                    <span class="px-2 fw-bold">·</span>
                    <li class="list-inline-item">
                        <a class="link-primary" href="<?php echo e(route('terms.show')); ?>">Terms and conditions</a>
                    </li>

                </ul>
            </div>

        </div>
        <!--Grid row-->
        <div class=" text-center text-uppercase text-muted mb-3">
            
        </div>

        <div class="mb-3 text-center">
            <img src="<?php echo e(asset('images/webp/qr-code.webp')); ?>" class="rounded-main" height="200" alt="The Bruvs">
        </div>
        <div class="mb-3">
            <?php echo $__env->make('layouts.social-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="mb-3 text-center">
            <a href="https://play.google.com/store/apps/details?id=com.wmk.android" target="_blank"
                class="text-decoration-none">
                <img src="<?php echo e(asset('images/webp/google-play.webp')); ?>" class="mt-2 mt-md-0 mx-3"
                    style="height: auto;width: 180px;margin: 0 auto;">
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.wmk.android"
                class="text-decoration-none mx-md-1">
                <img src="<?php echo e(asset('images/webp/app-store.webp')); ?>" class="mt-2 mt-md-0 mx-3"
                    style="height: auto;width: 180px;margin: 0 auto;cursor:pointer">
            </a>
        </div>

    </div>
    <!-- Grid container -->
    <div class="text-center text-white  p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        <?php echo $__env->make('layouts.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</footer>
<!-- Footer -->
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/layouts/footer.blade.php ENDPATH**/ ?>