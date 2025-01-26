<?php if(!$banners->isEmpty()): ?>
    <div id="carouselIconVisionFade" class="carousel slide carousel-fade shadow-sm" data-bs-ride="carousel">
        <div class="carousel-inner rounded-0">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
                    <?php if($banner->link): ?>
                        <a href="<?php echo e($banner->link); ?>">
                            <img src="<?php echo e($banner->image_url); ?>" class="d-block rounded-0" alt="banner">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo e($banner->image_url); ?>" class="d-block rounded-0" alt="banner">
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIconVisionFade"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIconVisionFade"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/layouts/carousel.blade.php ENDPATH**/ ?>