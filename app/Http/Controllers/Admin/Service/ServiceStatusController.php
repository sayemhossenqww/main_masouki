<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ServiceStatusController extends Controller
{
    /**
     * Update the specified resource status in storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Item $item): JsonResponse
    {
        $item->update([
            'active' => !$item->active
        ]);
        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
        Cache::forget($item->cache_key);
        Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);
        return $this->jsonResponse();
    }
}
