<div class="card w-100 shadow-sm mb-3">
    <div class="card-header">
        Latest orders
    </div>
    <div class="card-body">
        <div class=" table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Order №</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $latest_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->order_number); ?></td>
                            <td><?php echo e($order->customer); ?></td>
                            <td><a class="link-primary" href="mailto:<?php echo e($order->email); ?>"><?php echo e($order->email); ?></a></td>
                            <td><a class="link-primary" href="tel:<?php echo e($order->phone); ?>"><?php echo e($order->phone); ?></a></td>
                            <td><?php echo e($order->display_date); ?></td>
                            <td><?php echo e($order->display_total); ?></td>
                            <td><a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="link-primary">View Details</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/admin/dashboard/partials/latest-orders-table.blade.php ENDPATH**/ ?>