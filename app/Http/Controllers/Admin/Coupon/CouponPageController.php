<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CouponPageController extends Controller
{
    /**
     * Show Category Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.coupons.show');
    }
}
