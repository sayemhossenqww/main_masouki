
<?php $__env->startSection('title', $item->name . ' | ' . config('app.meta_title')); ?>
<?php $__env->startSection('description', $item->meta_description); ?>
<?php $__env->startSection('keywords', $item->meta_keywords); ?>
<?php $__env->startSection('og_image', $item->image_url); ?>
<?php $__env->startSection('og_url', $item->url); ?>
<?php $__env->startSection('og_type', $item->category->name); ?>
<?php $__env->startPush('head'); ?>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=62580719eb843b00192d12e2&product=sop'
        async='async'></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row py-2 mb-3">
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="modal-item-image-wrapper">
                <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->name); ?>"
                    class="w-100 h-100 object-fit-cover rounded-main" />
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-3 px-lg-5">
            <h1 class="text-dark fw-bolder mb-3 font-cinzel text-break">
                <?php echo e($item->name); ?>

            </h1>
            <div class="mb-3">
                <?php echo $item->des; ?>

            </div>
            <div class="mb-3">
                <property-badge-component :item="<?php echo e($item); ?>"></property-badge-component>
            </div>
            <hr>
            <div class="mb-3">
                <?php if($item->active): ?>
                    <item-cart-component :item="<?php echo e($item); ?>" />
                <?php else: ?>
                    <div class="text-center h3 fw-bold">Item not available at this time</div>
                <?php endif; ?>
            </div>
            <hr>
            <div class="mb-3">
                <h6 class="text-center fw-bolder mb-3">TELL YOUR FRIENDS ABOUT THIS OFFER</h6>
                <div class="sharethis-inline-share-buttons"></div>
            </div>

        </div>

    </div>
  
    <?php if(!$similarItems->isEmpty()): ?>
    <div class="row">
        <div class="text-black fw-bold h4 px-3">Similar Items</div>
        <?php $__currentLoopData = $similarItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similarItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-sm-12 d-flex align-items-stretch mb-0 mb-md-3 p-0 px-md-3">
                <div class="card card-item rounded-0 w-100 bg-body border">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="item-image-wrapper">
                                <picture>
                                    <source type="image/jpg" srcset="<?php echo e($similarItems->image_url); ?>" />
                                    <img alt="<?php echo e($similarItems->name); ?>" src="<?php echo e($similarItems->image_url); ?>"
                                        aria-hidden="true" class="item-image rounded-0" />
                                </picture>
                            </div>
                        </div>
                        <div class="flex-grow-1 card-body py-0">
                            <span class="text-black fw-bold text-break fs-7">
                                <?php echo e($similarItems->name); ?>

                                <?php if($similarItems->is_vegan): ?>
                                    <Icon icon="leaf" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_vegetarian): ?>
                                    <Icon icon="leaf_right" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_gluten_free): ?>
                                    <Icon icon="gluten_free" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_spicy): ?>
                                    <Icon icon="chili" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_low_carb): ?>
                                    <Icon icon="leaves" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_sugar_free): ?>
                                    <Icon icon="sugar_free" styleName="me-1"></Icon>
                                <?php endif; ?>
                                <?php if($similarItems->is_lactose_free): ?>
                                    <Icon icon="lactose_free" styleName="me-1"></Icon>
                                <?php endif; ?>
                            </span>

                            <div class="text-muted d-none d-md-block fs-7 mb-3"><?php echo e($similarItems->preview_des); ?></div>
                            <div class="text-black align-items-center mb-2 fs-7">
                                <?php echo e($similarItems->view_price_usd); ?>

                                <?php if($similarItems->has_discount): ?>
                                    <s class="ms-1">
                                        <?php echo e($similarItems->view_original_price_usd); ?>

                                    </s>
                                    <DiscountBadge styleName="ms-1"></DiscountBadge>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo e($similarItems->url); ?>" class="stretched-link"></a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/special-bites.com/resources/views/home/item.blade.php ENDPATH**/ ?>