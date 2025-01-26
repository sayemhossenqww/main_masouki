<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequests\ServiceStoreRequest;
use App\Http\Requests\ServiceRequests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResources\ServiceResourceCollection;
use App\Models\Category;
use App\Models\SelectOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    const RANDOM_STRING_LENGTH = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(['data' => new ServiceResourceCollection(
            SelectOption::all()
        )]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequests\ServiceStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServiceStoreRequest $request): JsonResponse
    {
        $service = SelectOption::create([
            'name' => $request->name,
            'desription' => $request->desription,
            'price' => $request->price,
            'cost' => $request->cost,
            'category_name' => $request->category_name,
        ]);
        return $this->jsonResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemRequests\ServiceUpdateRequest  $request
     * @param  \App\Models\SelectOption  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ServiceUpdateRequest $request, SelectOption $service): JsonResponse
    {
        $service->update([
            'name' => $request->name,
            'desription' => $request->desription,
            'price' => $request->price,
            'cost' => $request->cost,
            'category_name' => $request->category_name,
        ]);
        return $this->jsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SelectOption  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SelectOption $service): JsonResponse
    {
        $service->delete();
        return $this->jsonResponse();
    }

    public function getCategories(): JSonResponse
    {
        $categories = SelectOption::select('id', 'category_name')->groupBy('category_name')->get();
        // dd($categories);
        return $this->jsonResponse(['data' => $categories]);
    }

    // /**
    //  * Replicate the specified resource in storage.
    //  *
    //  * @param  \App\Models\Item  $item
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function replicate(Item $item): JsonResponse
    // {
    //     $newItem = $item->replicate();
    //     if ($item->image_path) {
    //         $fileExtension = File::extension(Storage::path($item->image_path));
    //         $newName = Str::random(40) . '.' . $fileExtension;
    //         $newPathWithName = "item-image/{$newName}";
    //         File::copy(Storage::path($item->image_path), Storage::path($newPathWithName));
    //         $newItem->image_path = $newPathWithName;
    //     }
    //     $newItem->name = $item->name . ' ' . (Item::latest()->first()->id + 1);
    //     $newItem->slug = $this->generateSlug();
    //     $newItem->save();
    //     $this->forgetCategoryCache();
    //     Cache::forget(Item::SIMILAR_ITEMS_CACHE_KEY);
    //     return $this->jsonResponse();
    // }

    // private function forgetCategoryCache()
    // {
    //     Cache::forget(Category::CACHE_KEY);
    //     Cache::forget(Category::CACHE_KEY_2_V2);
    //     Cache::forget(Category::CACHE_KEY_V2);
    // }

    // public static function generateSlug()
    // {
    //     $cleanNumber = preg_replace('/[^0-9]/', '', microtime(false));
    //     $slug = base_convert($cleanNumber, 10, 36) . "" . Str::lower(Str::random(3)) . "" . rand(1, 999);
    //     return $slug;
    // }
}
