<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Show order page.
     * 
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('order.show', [
            "closed_message" => Setting::CLOSED_MESSAGE
        ]);
    }
}
