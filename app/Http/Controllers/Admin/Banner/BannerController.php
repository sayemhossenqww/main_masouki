<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResourceCollection;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(['data' => new BannerResourceCollection(
            Banner::orderBy('sort_order', 'ASC')->latest()->get()
        )]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['nullable', 'max:2024'],
            'link' => ['nullable', 'string', 'max:190'],
            'sort_order' => ['required', 'numeric', 'min:1'],
        ]);

        Banner::create([
            'image_path' => $request->image->store('banner-image'),
            'link' => $request->link,
            'sort_order' => $request->sort_order,
            'active' => true,
        ]);

        Cache::forget(Banner::CACHE_KEY);
        return $this->jsonResponse();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Banner $banner): JsonResponse
    {
        $request->validate([
            'image' => ['nullable', 'max:2024'],
            'link' => ['nullable', 'string', 'max:190'],
            'sort_order' => ['required', 'numeric', 'min:1'],
        ]);

        $banner->update([
            'link' => $request->link,
            'sort_order' => $request->sort_order,
        ]);

        if ($request->image) {
            $banner->updateImage($request->image);
        }


        Cache::forget(Banner::CACHE_KEY);

        return $this->jsonResponse(['data' => $banner]);
    }

    /**
     * Update the specified resource status in storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Banner $banner): JsonResponse
    {
        $banner->update([
            'active' => !$banner->active
        ]);
        Cache::forget(Banner::CACHE_KEY);
        return $this->jsonResponse();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Banner $banner): JsonResponse
    {
        $banner->delete();
        Cache::forget(Banner::CACHE_KEY);
        return $this->jsonResponse();
    }
}
