<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderStatusController extends Controller
{
    public function update(Order $order, OrderStatus $status)
    {
        $order->order_status()->associate($status);
        $order->save();
        $statusName = $order->order_status->name;
        return Redirect::back()->with('success', "Order marked as {$statusName}.");
    }
}
