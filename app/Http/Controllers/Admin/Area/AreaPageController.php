<?php

namespace App\Http\Controllers\Admin\Area;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AreaPageController extends Controller
{
    /**
     * Show Category Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.areas.show');
    }
}
