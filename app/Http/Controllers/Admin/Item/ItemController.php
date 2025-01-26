<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequests\ItemStoreRequest;
use App\Http\Requests\ItemRequests\ItemUpdateRequest;
use App\Http\Resources\ItemResources\ItemResourceCollection;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    const RANDOM_STRING_LENGTH = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(['data' => new ItemResourceCollection(
            Item::with('category', 'ingredients', 'item_selection_option.select_option')->orderBy('name', 'ASC')->get()
        )]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequests\ItemStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemStoreRequest $request): JsonResponse
    {
        $item = Item::create([
            'name' => $request->name,
            'slug' => $this->generateSlug(),
            'des' => $request->des,
            'price' => $request->price,
            'cost' => $request->cost,
            'discount' => $request->discount,
            'category_id' => $request->category,
            'modifiers' => $request->modifiers,
            'removable_ingredients' => $request->removable_ingredients,
            'active' => true,
        ]);
        
        if ($request->image) {
            $item->updateImage($request->image);
        }
        $this->forgetCategoryCache();
        Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);
        return $this->jsonResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequests\ItemUpdateRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ItemUpdateRequest $request, Item $item): JsonResponse
    {
        $item->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'des' => $request->des,
            'price' => $request->price,
            'cost' => $request->cost,
            'discount' => $request->discount,
            'modifiers' => $request->modifiers,
            'removable_ingredients' => $request->removable_ingredients,
            'category_id' => $request->category,
        ]);

        if ($request->image) {
            $item->updateImage($request->image);
        }
        $this->forgetCategoryCache();
        Cache::forget($item->cache_key);
        Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);

        return $this->jsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Item $item): JsonResponse
    {
        Cache::forget($item->cache_key);
        Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);
        $item->deleteImage();
        $item->delete();
        $this->forgetCategoryCache();
        return $this->jsonResponse();
    }


    /**
     * Replicate the specified resource in storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function replicate(Item $item): JsonResponse
    {
        $newItem = $item->replicate();
        if ($item->image_path) {
            $fileExtension = File::extension(Storage::path($item->image_path));
            $newName = Str::random(40) . '.' . $fileExtension;
            $newPathWithName = "item-image/{$newName}";
            File::copy(Storage::path($item->image_path), Storage::path($newPathWithName));
            $newItem->image_path = $newPathWithName;
        }
        $newItem->name = $item->name . ' ' . (Item::latest()->first()->id + 1);
        $newItem->slug = $this->generateSlug();
        $newItem->save();
        $this->forgetCategoryCache();
        Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);
        return $this->jsonResponse();
    }

    private function forgetCategoryCache()
    {
        Cache::forget(Category::CACHE_KEY);
        Cache::forget(Category::CACHE_KEY_2_V2);
        Cache::forget(Category::CACHE_KEY_V2);
    }

    public static function generateSlug()
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', microtime(false));
        $slug = base_convert($cleanNumber, 10, 36) . "" . Str::lower(Str::random(3)) . "" . rand(1, 999);
        return $slug;
    }
}
