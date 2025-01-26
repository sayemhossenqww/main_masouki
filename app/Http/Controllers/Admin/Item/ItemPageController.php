<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\View\View;

class ItemPageController extends Controller
{
    /**
     * Show Item Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.items.show', [
            'usdRate' => Setting::getUsdRate()
        ]);
    }
}
