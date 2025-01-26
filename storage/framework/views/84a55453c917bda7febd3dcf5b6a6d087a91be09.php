<div class="card shadow-sm w-100 mb-3">
    <div class="card-header">
     <mt-icon icon="local_fire_department" styleName="me-1"></mt-icon> Popular Items
    </div>
    <div class="card-body">
        <div class=" table-responsive border">
            <table class="table table-striped table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Total Ordered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $popular_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img src="<?php echo e($item->item->image_url); ?>" class="rounded-circle me-1" alt="image" width="50"
                                    height="50">
                                <a href="<?php echo e($item->item->url); ?>" class="link-primary"><?php echo e($item->item->name); ?></a>
                            </td>
                            <td><?php echo e($item->qty); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH /home/caliisbw/public_html/resources/views/admin/dashboard/partials/popular-items-table.blade.php ENDPATH**/ ?>