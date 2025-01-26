<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <?php if(auth()->guard()->check()): ?>
            <img src="<?php echo e(Auth::user()->profile_photo_url); ?>" alt="<?php echo e(Auth::user()->name); ?>" height="30"
                class="me-1 rounded-circle"> <?php echo e(Auth::user()->first_name); ?>

        <?php endif; ?>

        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="list-group list-group-flush mb-3">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                    <mt-icon icon="dashboard" class="me-2"></mt-icon> <?php echo app('translator')->get('Admin Panel'); ?>
                </a>
            <?php endif; ?>

            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item['route']); ?>"
                    class="list-group-item list-group-item-action py-3 px-3 d-flex align-items-center
                <?php if($item['active']): ?> text-primary <?php endif; ?>"
                    <?php if($item['is_blank']): ?> target="_blank" <?php endif; ?>>
                    <mt-icon icon="<?php echo e($item['icon']); ?>" class="me-2"></mt-icon> <?php echo e($item['name']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mb-3">
            <?php echo $__env->make('layouts.social-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="text-center px-3">
            <?php echo $__env->make('layouts.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="row justify-content-center">
            
            
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>