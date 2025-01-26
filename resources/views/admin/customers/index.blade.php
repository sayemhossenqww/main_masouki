@extends('admin.layouts.app')
@section('title', 'Customers')
@section('page_name', 'Customers')

@section('content')

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
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer }}</td>
                                <td>
                                    <a href="mailto:{{ $customer->email }}"
                                        class="link-primary">{{ $customer->email }}</a>
                                </td>
                                <td>
                                    <a href="tel:{{ $customer->phone }}"
                                        class="link-primary">{{ $customer->phone }}</a>
                                </td>
                                <td>{{ $customer->order_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($customers->isEmpty())
                    <p class="text-center">No Data</p>
                @endif

                {{ $customers->links() }}

            </div>

        </div>

    </div>

@endsection
