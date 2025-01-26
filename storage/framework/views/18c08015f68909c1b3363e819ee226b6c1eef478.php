<div class="card shadow-sm w-100 mb-3">
    <div class="card-header">
        Orders
    </div>
    <div class="card-body">
        <canvas id="orders-chart"></canvas>
    </div>

</div>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        var orders_chart_element = document.getElementById("orders-chart").getContext("2d");
        orders_chart = new Chart(orders_chart_element, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Orders",
                    borderColor: "#4285F4",
                    data: []
                }]
            },
            options: {
                layout: {
                    padding: 10
                },
                legend: {
                    position: "bottom"
                },
                title: {
                    display: !0,
                    text: "Orders"
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: !0,
                            labelString: "Orders"
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: !0,
                            labelString: "Data"
                        }
                    }]
                }
            }
        });

        <?php $__currentLoopData = $total_orders_per_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                orders_chart.data.labels.push("<?php echo e($order->date); ?>"), orders_chart.data.datasets.forEach(a=> {
                a.data.push("<?php echo e($order->total); ?>");      
            });  
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        orders_chart.update();
        
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/admin/dashboard/partials/orders-chart.blade.php ENDPATH**/ ?>