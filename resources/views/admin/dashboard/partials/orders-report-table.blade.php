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
                    @foreach ($total_orders_per_month as $order)
                        <tr>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ brl_money_format($order->delivery_fee_sum) }}</td>
                            <td>{{ brl_money_format($order->subtotal_sum) }}</td>
                            <td>{{ brl_money_format($order->total_sum) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
