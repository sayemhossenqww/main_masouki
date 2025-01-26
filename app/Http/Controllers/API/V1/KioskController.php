<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\KioskResources\KioskCategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KioskController extends Controller
{
       /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\JsonResponse     
     */
    public function index(Request $request): JsonResponse
    {
        return $this->jsonResponse(["data" => new KioskCategoryResourceCollection(
            Cache::rememberForever(Category::CACHE_KEY, function () {
                return Category::with(['items' =>  function ($query) {
                    $query->active()->with('category')->orderBy('name', 'ASC');
                }])->has('items', '>', 0)->active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get();
            })
        )]);
    }

}
