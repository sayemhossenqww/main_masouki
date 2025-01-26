<?php

namespace App\Http\Controllers\API\V1;

use App\Events\OrderPlacedEvent;
use App\Mail\AdminOrderPlacedMail;
use App\Mail\CustomerOrderPlacedMail;
use App\Models\Area;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderSource;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class OrderController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $cart = (object) $request->cart;

        $this->validateOrder($request);


        $order = new Order();
        $order->order_number = $this->randomNumber();
        $order->customer = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->is_delivery = $request->delivery;

        $subtotal = $cart->total;
        $deliveryFee = 0;
        $discount = 0;

        if ($request->delivery) {
            $area = Area::active()->find($request->area);
            if ($area) {
                $deliveryFee = $area->fee;
                $order->area()->associate($area);
                $order->address = $request->address;
            }
        }

        $order->payment_method()->associate(
            PaymentMethod::where('id', $request->payment_method)->exists()
                ? $request->payment_method
                : PaymentMethod::first()
        );



        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)->active()->first();
            if ($coupon) {
                $order->coupon()->associate($coupon);
                if ($coupon->percentage > 0) {
                    $discount = (($coupon->percentage / 100) * $subtotal);
                }
            }
        }
        $order->comment = $request->comment;
        $source = OrderSource::find($request->get('source', OrderSource::WEBSITE));
        $order->order_source()->associate($source);
        $order->order_status()->associate(OrderStatus::PENDING);
        $order->delivery_fee = $deliveryFee;
        $order->subtotal = $subtotal;
        $order->discount = $discount;
        $order->total = $subtotal + $deliveryFee - $discount;
        $order->save();


        foreach ($cart->items as $cartItem) {
            $cartItem = (object)$cartItem;
            $item = Item::where('slug', $cartItem->slug)->first(); // check item if valid
            if ($item) {
                $order_detail = new OrderDetail();
                $order_detail->qty = $cartItem->quantity > 1 ? $cartItem->quantity : 1; //prevent 0 and vegetive numbers
                $order_detail->subtotal = $item->base_price;
                $order_detail->comment = Str::limit($cartItem->comment, 155); //should be validated in frontend also!
                $order_detail->item()->associate($item);
                $order_detail->order()->associate($order);
                $order_detail->save();
            }
        }


        if (App::environment('production')) {
            try {
                $this->sendMail($order, $request->email);
                $this->notifyUsers($order);
                event(new OrderPlacedEvent("New order submitted №{$order->order_number}", route('admin.orders.show', $order->id)));
            } catch (Exception $e) {
            }
        }

        return $this->jsonResponse();
    }

    /**
     * Validate the customer order request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateOrder(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'max:255'],
            'delivery' => ['required', 'boolean'],
            'payment_method' => ['required', 'integer'],
            'comment' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->delivery) {
            $request->validate([
                'area' => ['required', 'integer'],
                'address' => ['required', 'string', 'max:255'],
            ]);
        }
    }

    /**
     * Send mail to admin and customer.
     *
     * @param  \App\Models\Order $order
     * @param  string $email
     * @return void
     */
    private function sendMail(Order $order, string $email)
    {
        $adminEmail = config('app.admin_email');
        Mail::to($adminEmail)->send(new AdminOrderPlacedMail($order));
        if ($email) {
            Mail::to($email)->send(new CustomerOrderPlacedMail($order));
        }
    }

    /**
     * Notify admins.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function notifyUsers(Order $order)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new OrderPlacedNotification($order));
        }
    }

    /**
     * Generate a random integer.
     *
     * @return int
     */
    private function randomNumber(): int
    {
        return rand(999999, 9999999);
    }
}
