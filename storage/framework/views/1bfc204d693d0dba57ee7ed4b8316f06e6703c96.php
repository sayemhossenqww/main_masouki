
<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('page_name', 'Orders'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Order №</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Delivery Charge</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->order_number); ?></td>
                                <td><?php echo e($order->customer); ?></td>
                                <td>
                                    <a class="link-primary" href="mailto:<?php echo e($order->email); ?>"><?php echo e($order->email); ?></a>
                                </td>
                                <td>
                                    <a class="link-primary" href="tel:<?php echo e($order->phone); ?>"><?php echo e($order->phone); ?></a>
                                </td>
                                <td><?php echo e($order->type); ?></td>
                                <td><?php echo e($order->display_delivery_fee); ?></td>
                                <td><?php echo e($order->display_subtotal); ?></td>
                                <td><?php echo e($order->display_total); ?></td>
                                <td><?php echo e($order->display_date); ?></td>
                                <td><?php echo $order->order_status->full_status; ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
                                        class="link-primary">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($orders->links()); ?>

                <?php if($orders->isEmpty()): ?>
                    <p class="text-center">No Data</p>
                <?php endif; ?>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>