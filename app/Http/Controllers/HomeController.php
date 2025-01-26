<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Item;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * Show home page.
     * 
     * @return \Illuminate\View\View
     */
    public function show(Request $request): View
    {
        // $banners = Cache::remember(Banner::CACHE_KEY, Banner::CACHE_TTL, function () {
        //     return Banner::active()->orderBy('sort_order', 'ASC')->latest()->get();
        // });

        $categories = Cache::rememberForever(Category::CACHE_KEY_V2, function () {
            return Category::has('items', '>', 0)->active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get();
        });

        $isSearching = $request->has('query') && !is_null($request->get('query'));
        $searchResults = new Collection([]);
        if ($isSearching) {
            $searchResults = Item::where('name', 'LIKE', "%{$request->get('query')}%")->get();
        }


        return view('home.v2.show', [
            // 'global_alert' => Setting::where('id', Setting::GLOBAL_ALERT)->first()->value,
            // 'banners' => $banners,
            'categories' => $categories,
            'searchResults' => $searchResults,
            'isSearching' => $isSearching,
        ]);
    }

    /**
     * Show item page.
     *
     * @param string $slug
     * 
     * @return \Illuminate\View\View
     */
    public function showItem(string $slug)
    {
        $item = Item::with('category', 'item_selection_option.select_option')->whereSlug($slug)->firstOrFail();

        $similarItems = Item::active()->where('id', '!=', $item->id)->where('category_id', $item->category_id)->with('category')->take(6)->get();

        return view('home.item', [
            'item' => $item,
            'similarItems' => $similarItems,
        ]);
    }


    /**
     * Show item page.
     *
     * @param string $slug
     * 
     * @return \Illuminate\View\View
     */
    public function showCategoryItems(string $slug): View
    {
        $category = Category::where('slug', $slug)->with('items')->firstOrFail();

        // $category = Cache::rememberForever(Category::CACHE_KEY_2_V2 . "-{$slug}", function () use ($slug) {
        //     return Category::where('slug', $slug)->with('items')->firstOrFail();
        // });

        return view('home.v2.category', [
            'category' => $category,
            'items' => $category->items,
            // 'categories' => Category::active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get(),
        ]);
    }
}
