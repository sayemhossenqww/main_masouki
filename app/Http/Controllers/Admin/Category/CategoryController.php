<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\CategoryStoreRequest;
use App\Http\Requests\CategoryRequests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResources\CategoryDataResourceCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(['data' => new CategoryDataResourceCollection(
            Category::orderBy('sort_order', 'ASC')->get()
        )]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequests\CategoryStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order,
            'active' => true,
        ]);

        if ($request->image) {
            $category->updateImage($request->image);
        }
        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
        return $this->jsonResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequests\CategoryUpdateRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $category->update([
            'name' => $request->name,
            // 'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order,
        ]);
        if ($request->image) {
            $category->updateImage($request->image);
        }

        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
        return $this->jsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->deleteImage();
        $category->delete();
        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
        return $this->jsonResponse();
    }
}
