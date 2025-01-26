<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{

    /**
     * Show dashboard Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        $total = Order::where('order_status_id', OrderStatus::DELIVERED)->sum('total');

        $total_orders = Order::count();

        $total_customers =  Order::get()->groupBy('customer')->count();

        $latest_orders = Order::orderBy('created_at', 'DESC')->take(10)->get();

        $popular_items = OrderDetail::with('item')->select('item_id')
            ->selectRaw('SUM(qty) as qty')
            ->groupBy('item_id')
            ->orderBy('qty', 'DESC')
            ->havingRaw('qty > ?', [2])
            ->take(10)
            ->get();


        $total_per_month = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%M %Y") as date'),
            DB::raw('SUM(total) as total'),
            DB::raw('max(created_at) as createdAt')
        )->where('order_status_id', OrderStatus::DELIVERED)
            ->groupBy('date')
            ->orderBy(DB::raw("createdAt"), 'ASC')->take(6)->get()->each(function($order) {
                $order->setAppends(['display_total']); 
             });

        $total_orders_per_month = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%M %Y") as date'),
            DB::raw('count(*) as total'),
            DB::raw('SUM(total) as total_sum'),
            DB::raw('SUM(subtotal) as subtotal_sum'),
            DB::raw('SUM(delivery_fee) as delivery_fee_sum'),
            DB::raw('max(created_at) as createdAt')
        )->groupBy('date')
            ->orderBy(DB::raw("createdAt"), 'ASC')->take(6)->get()->each(function($order) {
                $order->setAppends([]); 
             });
        return view('admin.dashboard.show', [
            'total' => brl_money_format($total),
            'total_orders' => $total_orders,
            'total_customers' => $total_customers,
            'total_orders_per_month' => $total_orders_per_month,
            'total_per_month' => $total_per_month,
            'popular_items' => $popular_items,
            'latest_orders' => $latest_orders,

            'facebook_followers' => "147",
            'instagram_followers' => "7,976",
            'tiktok_followers' => "23",
            'app_store_downloads' => "0",
            'play_store_downloads' => "+100",
            'notification_count' => "2101",

        ]);
    }
}
