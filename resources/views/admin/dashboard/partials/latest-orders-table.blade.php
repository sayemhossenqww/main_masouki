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
                    @foreach ($latest_orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer }}</td>
                            <td><a class="link-primary" href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                            <td><a class="link-primary" href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                            <td>{{ $order->display_date }}</td>
                            <td>{{ $order->display_total }}</td>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}" class="link-primary">View Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
