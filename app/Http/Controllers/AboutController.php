<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

class AboutController extends Controller
{

    /**
     * Show about page.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('about.show', [
            'about' => Setting::findOrFail(Setting::ABOUT)->value
        ]);
    }
}
