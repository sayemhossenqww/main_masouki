<div class="row">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm w-100 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title"><?php echo e($total); ?>

                        </h4>
                        <p class="card-text">Sales</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?php echo e(asset('images/webp/credit-card.webp')); ?>" alt="credit-card" height="64">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm w-100 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title"><?php echo e($total_orders); ?></h4>
                        <p class="card-text">Total Orders</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?php echo e(asset('images/webp/paper-bag.webp')); ?>" alt="paper-bag" height="64">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card shadow-sm w-100 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title"><?php echo e($total_customers); ?></h4>
                        <p class="card-text">Total Customers</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?php echo e(asset('images/webp/team.webp')); ?>" alt="team" height="64">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/caliisbw/public_html/resources/views/admin/dashboard/partials/cards.blade.php ENDPATH**/ ?>