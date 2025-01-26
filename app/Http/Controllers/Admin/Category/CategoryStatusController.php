<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class CategoryStatusController extends Controller
{

    /**
     * Update the specified resource status in storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Category $category): JsonResponse
    {
        $category->update([
            'active' => !$category->active
        ]);
        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
        return $this->jsonResponse();
    }
}
