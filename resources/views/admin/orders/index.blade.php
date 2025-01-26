@extends('admin.layouts.app')
@section('title', 'Orders')
@section('page_name', 'Orders')

@section('content')

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

                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer }}</td>
                                <td>
                                    <a class="link-primary" href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                                </td>
                                <td>
                                    <a class="link-primary" href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                                </td>
                                <td>{{ $order->type }}</td>
                                <td>{{ $order->display_delivery_fee }}</td>
                                <td>{{ $order->display_subtotal }}</td>
                                <td>{{ $order->display_total }}</td>
                                <td>{{ $order->display_date }}</td>
                                <td>{!! $order->order_status->full_status !!}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="link-primary">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
                @if ($orders->isEmpty())
                    <p class="text-center">No Data</p>
                @endif
            </div>

        </div>

    </div>

@endsection
