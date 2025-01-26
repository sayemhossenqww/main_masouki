<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerPageController extends Controller
{
    /**
     * Show Item Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.banners.show');
    }
}
