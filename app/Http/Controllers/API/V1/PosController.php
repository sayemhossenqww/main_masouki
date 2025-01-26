<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\POS\CategoryItemResources\CategoryItemResourceCollection;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class PosController extends ApiController
{
    /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\JsonResponse     
     */
    public function index(Request $request): JsonResponse
    {
        if (!Hash::check("ehab", $request->access_token)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        // return $this->jsonResponse(["data" => new CategoryItemResourceCollection(
        //     Cache::rememberForever(Category::CACHE_KEY, function () {
        //         return Category::with(['items' =>  function ($query) {
        //             $query->active()->with('category')->orderBy('name', 'ASC');
        //         }])->has('items', '>', 0)->active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get();
        //     })
        // )]);
        $item = Category::with('items.item_selection_option.select_option')->has('items', '>', 0)->active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get();
        return $this->jsonResponse(["data" => new CategoryItemResourceCollection(
            $item
        )]);
    }


    public function exchangeRate()
    {
        return $this->jsonResponse(["data" => Setting::getUsdRate()]);
    }
}
