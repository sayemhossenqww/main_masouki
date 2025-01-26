<div class="card w-100 shadow-sm mb-3">
    <div class="card-header">
       Orders Report
    </div>
    <div class="card-body">
        <div class=" table-responsive" style="max-height:600px;">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Orders</th>
                        <th>Delivery Charge</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $total_orders_per_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->date); ?></td>
                            <td><?php echo e($order->total); ?></td>
                            <td><?php echo e(brl_money_format($order->delivery_fee_sum)); ?></td>
                            <td><?php echo e(brl_money_format($order->subtotal_sum)); ?></td>
                            <td><?php echo e(brl_money_format($order->total_sum)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/admin/dashboard/partials/orders-report-table.blade.php ENDPATH**/ ?>