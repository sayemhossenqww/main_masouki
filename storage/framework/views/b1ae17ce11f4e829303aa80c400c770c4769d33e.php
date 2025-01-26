
<?php $__env->startSection('title', $category->name . ' | ' . config('app.meta_title')); ?>
<?php $__env->startSection('og_image', $category->image_url); ?>
<?php $__env->startSection('og_url', $category->url); ?>
<?php $__env->startSection('og_type', $category->name); ?>

<?php $__env->startSection('content'); ?>
    <h3 class="category-name"><?php echo e($category->name); ?></h3>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="menu-item <?php if(is_null($item->image_path)): ?> _without-image <?php endif; ?>">
                <a href="<?php echo e($item->url); ?>">
                    <img data-src="<?php echo e($item->image_url_v2); ?>" alt="<?php echo e($item->name); ?>" class="lazy img-fluid mb-2" />
                </a>
            <h3 class="mb-2"><?php echo e($item->name); ?></h3>
            <p>
                <?php echo $item->des; ?>

            </p>
            <div class="menu-item-price">
                <div class="price">
                    <b><?php echo e(usd_money_format_v2($item->base_price_usd)); ?></b>
                    <span>$</span>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_v2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/special-bites.com/resources/views/home/v2/category.blade.php ENDPATH**/ ?>