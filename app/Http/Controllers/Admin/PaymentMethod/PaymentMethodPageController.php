<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PaymentMethodPageController extends Controller
{

    /**
     * Show PaymentMethod Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.payment_methods.show');
    }
}
