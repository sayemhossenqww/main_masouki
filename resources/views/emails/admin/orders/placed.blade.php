@component('mail::message')
<style>
th,
td {
padding: 5px;
}

th {
text-align: left;
}


</style>
Order #{{ $order->order_number }} <br>
<strong> Contact Details </strong> <br>
Name: {{ $order->customer }} <br>
Email: {{ $order->email }} <br>
Phone Number: {{ $order->phone }} <br>
Comment: {{ $order->comment }} <br>


@if ($order->is_delivery)
Payment Method: {{ $order->payment_method->name }} <br>

<strong> Delivery Address: </strong> <br>

<ul>
<li> <b> Area: </b> {{ $order->area->name }} </li>
<li> <b> Address: </b> {{ $order->address }} </li>
<li> <b> Delivery Time: </b> {{ $order->area->time }} mins </li>
</ul>
@else
Type: Pickup <br>
@endif

<strong> Order Details: </strong>

<table>
<thead>
<tr>
<th> Item </th>
<th> Category </th>
<th> Quantity </th>
<th> Subtotal </th>
</tr>
</thead>
<tbody>
@foreach ($order->order_detail as $value)
<tr>
<td> {{ $value->item->name }}</td>
<td> {{ $value->item->category->name }}</td>
<td> {{ $value->qty }}</td>
<td> {{ brl_money_format($value->subtotal) }}
</td>
</tr>
@endforeach
</tbody>
</table>
<ul>
@if ($order->coupon)
<li><b>Coupon</b>: {{ $order->coupon->code }}</li>
<li><b>Description</b>: {{ $order->coupon->des }}</li>
@endif
<li><b>Subtotal</b>: {{ $order->display_subtotal }}</li>
@if ($order->is_delivery)
<li><b>Delivery Charge</b>: {{ $order->display_delivery_fee  }}</li>
@endif
@if ($order->discount > 0)
<li><b>Discount</b>:  {{ $order->display_discount }}</li>
@endif
<li><b>Total</b>: {{ $order->display_total }}</li>
</ul>

@endcomponent