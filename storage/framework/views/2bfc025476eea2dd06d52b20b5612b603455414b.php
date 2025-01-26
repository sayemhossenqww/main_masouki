


<?php $__env->startSection('content'); ?>
    <div class="my-4">
        <form action="<?php echo e(route('home')); ?>" method="GET" class="search-form">
            <div class="search-input">
                <input type="search" autocomplete="off" name="query" placeholder="Search" value="<?php echo e(Request::get('query')); ?>">
            </div>
            <button type="submit" class="search-button ripple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="24" height="24" style="transform: scaleX(-1);">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form>
    </div>
    <?php if($isSearching): ?>
        <div>
            <h2 class="title-search mb-3">SEARCH RESULT:</h2>
            <?php if($searchResults->isEmpty()): ?>
                <p class="m-0">No result</p>
            <?php else: ?>
                <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $searchResult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="menu-item <?php if(is_null($searchResult->image_path)): ?> _without-image <?php endif; ?>">
                        <?php if(!is_null($searchResult->image_path)): ?>
                            <img data-src="<?php echo e($searchResult->image_url_v2); ?>" alt="<?php echo e($searchResult->name); ?>"
                                class="lazy img-fluid mb-2" />
                        <?php endif; ?>
                        <h3 class="mb-2"><?php echo e($searchResult->name); ?></h3>
                        <?php if($searchResult->des): ?>
                            <p>
                                <?php echo $searchResult->des; ?>

                            </p>
                        <?php endif; ?>
                        <div class="menu-item-price">
                            <div class="price">
                                <b><?php echo e(usd_money_format_v2($searchResult->base_price_usd)); ?></b>
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <hr>
    <?php endif; ?>

    <div class="d-flex flex-column">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3">
                <div class="position-relative w-100 overflow-hidden" style="aspect-ratio: 3/1;">
                    <a href="<?php echo e($category->url); ?>" class="category-link bruvs-link"
                        style="background-image: url(<?php echo e($category->image_url_original); ?>);">
                        <h2><?php echo e($category->name); ?></h2>
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_v2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/home/v2/show.blade.php ENDPATH**/ ?>