<div class="card shadow-sm w-100 mb-3">
    <div class="card-header">
       Sales
    </div>
    <div class="card-body">
        <canvas id="sales-chart"></canvas>
    </div>

</div>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        var sales_chart_element = document.getElementById("sales-chart").getContext("2d");
        sales_chart = new Chart(sales_chart_element, {
            type: "bar",
            data: {
                labels: [],
                datasets: [{
                    label: "Sales",
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
                    text: "Sales"
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: !0,
                            labelString: "Total"
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
        <?php $__currentLoopData = $total_per_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        sales_chart.data.labels.push("<?php echo e($order_count->date); ?>"), sales_chart.data.datasets.forEach(a=> {
                a.data.push("<?php echo e($order_count->total); ?>");      
            });  
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        sales_chart.update();

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/caliisbw/special-bites.com/resources/views/admin/dashboard/partials/sales-chart.blade.php ENDPATH**/ ?>