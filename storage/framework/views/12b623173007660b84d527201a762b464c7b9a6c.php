
<?php $__env->startSection('title', 'Order №' . $order->order_number); ?>
<?php $__env->startSection('page_name'); ?>

    <span class="fw-bold me-3">Order №<?php echo e($order->order_number); ?></span>
    <span class="small me-3 muted"><?php echo e($order->display_date_created); ?> at <?php echo e($order->display_time_created); ?></span>
    <span class="badge rounded-pill bg-secondary me-3"><?php echo e($order->type); ?></span>
    <?php echo $order->order_status->full_status; ?> <?php echo $order->order_source->icon_view; ?> <?php echo e($order->order_source->name); ?>

    <div class="dropdown float-end">
        <a class="btn btn-link text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">
            <mt-icon icon="more_vert" styleName="me-2"></mt-icon>
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li>
                <a class="dropdown-item" href="#" onclick="PrintElem()">
                    <mt-icon icon="print" styleName="me-1"></mt-icon> Print
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item text-danger" href="#" onclick="deleteOrder()">
                    <mt-icon icon="delete" styleName="me-1"></mt-icon> Delete
                </a>
            </li>
        </ul>
    </div>
    <form id="delete-order-form" action="<?php echo e(route('admin.orders.delete', $order->id)); ?>" method="POST"
        class="d-none">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card shadow-sm">
        <div class=" card-header">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="dropdown float-end">
                        <button class="btn btn-light border-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change Order Status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('admin.orders.status.update', [$order->id, $status->id])); ?>"><?php echo $status->icon; ?>

                                        <?php echo e($status->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <div class="card-body" id="order-details">

            <div class="mb-3">
                <h4 class="fw-bold"> Customer information:</h4>
                <p>Name: <?php echo e($order->customer); ?></p>
                <p>Email: <a class="link-primary" href="mailto:<?php echo e($order->email); ?>"><?php echo e($order->email); ?></a></p>
                <p>Phone: <a class="link-primary" href="tel:<?php echo e($order->phone); ?>"><?php echo e($order->phone); ?></a></p>
                <?php if($order->comment): ?>
                    <hr>
                    <p>Comment: <?php echo e($order->comment); ?></p>
                <?php endif; ?>
            </div>
            <hr>
            <div class="mb-3">
                <h4 class="fw-bold"> Payment:</h4>
                <p><?php echo e($order->payment_method->name); ?></p>
                <p>Subtotal: <?php echo e($order->display_subtotal); ?></p>
                <?php if($order->coupon): ?>
                    <p>Coupon: <?php echo e($order->coupon->code); ?></p>
                    <p><?php echo e($order->coupon->des); ?></p>
                <?php endif; ?>
                <?php if($order->discount > 0): ?>
                    <p>Discount: <?php echo e($order->display_discount); ?></p>
                <?php endif; ?>
                <?php if($order->is_delivery): ?>
                    <p>Delivery Charge: <?php echo e($order->display_delivery_fee); ?></p>
                <?php endif; ?>
                <p class="fw-bold">Total: <?php echo e($order->display_total); ?></p>
            </div>
            <hr>
            <?php if($order->is_delivery): ?>
                <div class="mb-3">
                    <h4 class="fw-bold"> Delivery Address:</h4>
                    <p>Area: <?php echo e($order->area->name); ?></p>
                    <p>Address: <?php echo e($order->address); ?></p>
                    <p>Delivery Time: <?php echo e($order->area->view_time); ?></p>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <h4 class="fw-bold">Order Details:</h4>
                <div class="table-responsive">
                    <table class=" table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Comment</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e($item->item->url); ?>" class="text-black text-decoration-none">
                                            <img src="<?php echo e($item->item->image_url_sm); ?>" alt="img"
                                                class=" object-fit-cover rounded-circle" widtd="50" height="50">
                                            <?php echo e($item->item->name); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($item->item->category->name); ?></td>
                                    <td><?php echo e($item->comments); ?></td>
                                    <td>x<?php echo e($item->qty); ?></td>
                                    <td><?php echo e($item->display_subtotal); ?></td>
                                    <td><?php echo e($item->display_total); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="5" class="text-end">
                                    Subtotal
                                </td>

                                <td><?php echo e($order->display_order_details_total); ?></td>
                            </tr>

                            <?php if($order->discount > 0): ?>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        Discount
                                    </td>

                                    <td><?php echo e($order->display_discount); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($order->is_delivery): ?>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        Delivery Charge
                                    </td>

                                    <td><?php echo e($order->display_delivery_fee); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="5" class="text-end">
                                    Total
                                </td>

                                <td><?php echo e($order->display_total); ?></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function PrintElem() {
            var mywindow = window.open();

            mywindow.document.write('<html><head><title>SpecialBites</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title + '</h1>');
            mywindow.document.write(document.getElementById('order-details').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }

        function deleteOrder() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to reverse this action!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                focusCancel: true,
                showClass: {
                    popup: "",
                    icon: "",
                },
                hideClass: {
                    popup: "",
                },
            }).then((result) => {
                if (result.value) {
                    document.getElementById("delete-order-form").submit();
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/special-bites.com/resources/views/admin/orders/show.blade.php ENDPATH**/ ?>