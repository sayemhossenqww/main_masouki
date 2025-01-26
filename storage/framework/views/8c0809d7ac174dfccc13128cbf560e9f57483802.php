
<?php $__env->startSection('title', $category->name . ' | ' . config('app.meta_title')); ?>
<?php $__env->startSection('og_image', $category->image_url); ?>
<?php $__env->startSection('og_url', $category->url); ?>
<?php $__env->startSection('og_type', $category->name); ?>
<?php $__env->startPush('head'); ?>
    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous"
        defer></script>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet"
        crossorigin="anonymous">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="py-3 border-bottom">
        <div class="swiffy-slider slider-item-show6 slider-item-reveal slider-item-ratio slider-item-ratio-1x1">
            <ul class="slider-container" style="overflow-y: hidden !important;height: 200px;">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($cat->url); ?>"
                            class="text-decoration-none <?php if($cat->id == $category->id): ?> text-primary fw-bold <?php else: ?> text-black <?php endif; ?>">
                            <img src="<?php echo e($cat->menu_image_url); ?>" alt="<?php echo e($cat->name); ?>" class="w-100">
                            <div class="text-break text-center py-2 item-name-content text-uppercase">
                                <?php echo e($cat->name); ?>

                            </div>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>
        </div>
    </div>


    <?php if(!$items->isEmpty()): ?>
        <div class="row py-3">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-12 d-flex align-items-stretch mb-0 mb-md-3 p-0 px-md-3 mb-md-3">
                    <div class="card card-item rounded-0 w-100 bg-body border">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="item-image-wrapper">
                                    <picture>
                                        <source type="image/jpg" srcset="<?php echo e($item->image_url); ?>" />
                                        <img alt="<?php echo e($item->name); ?>" src="<?php echo e($item->image_url); ?>" aria-hidden="true"
                                            class="item-image" />
                                    </picture>
                                </div>
                            </div>
                            <div class="flex-grow-1 card-body py-0">
                                <span class="text-black fw-bold text-break fs-7">
                                    <?php echo e($item->name); ?>

                                </span>
                                <div class="text-muted d-none d-md-block fs-7 mb-3"><?php echo e($item->preview_des); ?></div>
                                <div class="text-black align-items-center mb-2 fs-7">
                                    <?php echo e($item->view_price_usd); ?>

                                    <?php if($item->has_discount): ?>
                                        <s class="ms-1">
                                            <?php echo e($item->view_original_price_usd); ?>

                                        </s>
                                        <DiscountBadge styleName="ms-1"></DiscountBadge>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo e($item->url); ?>" class="stretched-link"></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        const slideArray = [];
        for (let i = 0; i < document.querySelectorAll('.slider div').length; i++) {
            slideArray.push(document.querySelectorAll('.slider div')[i].dataset.background);
        }

        let currentSlideIndex = -1;

        function advanceSliderItem() {
            currentSlideIndex++;

            if (currentSlideIndex >= slideArray.length) {
                currentSlideIndex = 0;
            }
            const sliderElement = document.querySelector('.slider');

            if (sliderElement) {
                sliderElement.style.cssText = 'background: url("' + slideArray[currentSlideIndex] +
                    '") no-repeat center center; background-size: cover;';
            }


            const elems = document.getElementsByClassName('caption');
            for (let i = 0; i < elems.length; i++) {
                elems[i].style.cssText = 'opacity: 0;';
            }

            const currentCaption = document.querySelector('.caption-' + (currentSlideIndex));
            if (currentCaption) {
                currentCaption.style.cssText = 'opacity: 1;';
            }
        }

        let intervalID = setInterval(advanceSliderItem, 3000);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/home/category.blade.php ENDPATH**/ ?>