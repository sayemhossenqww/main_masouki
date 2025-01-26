@extends('admin.layouts.app')
@section('title', 'Order №' . $order->order_number)
@section('page_name')

    <span class="fw-bold me-3">Order №{{ $order->order_number }}</span>
    <span class="small me-3 muted">{{ $order->display_date_created }} at {{ $order->display_time_created }}</span>
    <span class="badge rounded-pill bg-secondary me-3">{{ $order->type }}</span>
    {!! $order->order_status->full_status !!} {!! $order->order_source->icon_view !!} {{ $order->order_source->name }}
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
    <form id="delete-order-form" action="{{ route('admin.orders.delete', $order->id) }}" method="POST"
        class="d-none">
        @csrf
        @method('DELETE')
    </form>

@endsection

@section('content')

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
                            @foreach ($statuses as $status)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.orders.status.update', [$order->id, $status->id]) }}">{!! $status->icon !!}
                                        {{ $status->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <div class="card-body" id="order-details">

            <div class="mb-3">
                <h4 class="fw-bold"> Customer information:</h4>
                <p>Name: {{ $order->customer }}</p>
                <p>Email: <a class="link-primary" href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
                <p>Phone: <a class="link-primary" href="tel:{{ $order->phone }}">{{ $order->phone }}</a></p>
                @if ($order->comment)
                    <hr>
                    <p>Comment: {{ $order->comment }}</p>
                @endif
            </div>
            <hr>
            <div class="mb-3">
                <h4 class="fw-bold"> Payment:</h4>
                <p>{{ $order->payment_method->name }}</p>
                <p>Subtotal: {{ $order->display_subtotal }}</p>
                @if ($order->coupon)
                    <p>Coupon: {{ $order->coupon->code }}</p>
                    <p>{{ $order->coupon->des }}</p>
                @endif
                @if ($order->discount > 0)
                    <p>Discount: {{ $order->display_discount }}</p>
                @endif
                @if ($order->is_delivery)
                    <p>Delivery Charge: {{ $order->display_delivery_fee }}</p>
                @endif
                <p class="fw-bold">Total: {{ $order->display_total }}</p>
            </div>
            <hr>
            @if ($order->is_delivery)
                <div class="mb-3">
                    <h4 class="fw-bold"> Delivery Address:</h4>
                    <p>Area: {{ $order->area->name }}</p>
                    <p>Address: {{ $order->address }}</p>
                    <p>Delivery Time: {{ $order->area->view_time }}</p>
                </div>
            @endif

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
                            @foreach ($order->order_detail as $item)
                                <tr>
                                    <td>
                                        <a href="{{ $item->item->url }}" class="text-black text-decoration-none">
                                            <img src="{{ $item->item->image_url_sm }}" alt="img"
                                                class=" object-fit-cover rounded-circle" widtd="50" height="50">
                                            {{ $item->item->name }}
                                        </a>
                                    </td>
                                    <td>{{ $item->item->category->name }}</td>
                                    <td>{{ $item->comments }}</td>
                                    <td>x{{ $item->qty }}</td>
                                    <td>{{ $item->display_subtotal }}</td>
                                    <td>{{ $item->display_total }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-end">
                                    Subtotal
                                </td>

                                <td>{{ $order->display_order_details_total }}</td>
                            </tr>

                            @if ($order->discount > 0)
                                <tr>
                                    <td colspan="5" class="text-end">
                                        Discount
                                    </td>

                                    <td>{{ $order->display_discount }}</td>
                                </tr>
                            @endif
                            @if ($order->is_delivery)
                                <tr>
                                    <td colspan="5" class="text-end">
                                        Delivery Charge
                                    </td>

                                    <td>{{ $order->display_delivery_fee }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="5" class="text-end">
                                    Total
                                </td>

                                <td>{{ $order->display_total }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
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
@endpush
