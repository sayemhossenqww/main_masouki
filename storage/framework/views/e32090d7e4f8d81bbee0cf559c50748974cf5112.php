
<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('page_name', 'Customers'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Total orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($customer->customer); ?></td>
                                <td>
                                    <a href="mailto:<?php echo e($customer->email); ?>"
                                        class="link-primary"><?php echo e($customer->email); ?></a>
                                </td>
                                <td>
                                    <a href="tel:<?php echo e($customer->phone); ?>"
                                        class="link-primary"><?php echo e($customer->phone); ?></a>
                                </td>
                                <td><?php echo e($customer->order_count); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if($customers->isEmpty()): ?>
                    <p class="text-center">No Data</p>
                <?php endif; ?>

                <?php echo e($customers->links()); ?>


            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>