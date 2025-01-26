<?php

namespace App\Http\Controllers;

use App\Models\Item;

class SitemapController extends Controller
{

    /**
     * Show sitemap.
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show()
    {
        $items = Item::all();
        return response()->view('sitemap.show', compact('items'))->header('Content-Type', 'text/xml');
    }
}
