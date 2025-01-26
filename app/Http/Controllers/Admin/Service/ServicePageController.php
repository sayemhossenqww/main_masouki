<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    /**
     * Show Item Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.services.show', [
            'usdRate' => Setting::getUsdRate()
        ]);
    }
}
