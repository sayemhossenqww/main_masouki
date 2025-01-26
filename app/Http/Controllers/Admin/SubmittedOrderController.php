<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubmittedOrderController extends Controller
{
    public function index(Request $request)
    {
        $this->deleteAllNotifications();
        $orders = Order::with('order_status', 'order_source')->orderBy('created_at', 'DESC')->paginate($request->get('size', 20));
        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }
    public function show($id)
    {
        $order = Order::with('area', 'payment_method', 'order_detail.item.category')->findOrFail($id);
        $statuses = OrderStatus::all();
        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => $statuses,
        ]);
    }


    private function deleteAllNotifications()
    {
        //delete users notifications 
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->notifications as $notification) {
                $notification->delete();
            }
        }
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return Redirect::route('admin.orders')->with('success', 'Order has been deleted.');
    }
}
