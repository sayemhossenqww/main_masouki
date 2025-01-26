<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\MobileCategoryItemResources\MobileCategoryItemResourceCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class MobileController extends ApiController
{
    /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\JsonResponse     
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(["data" => new MobileCategoryItemResourceCollection(
            Category::with(['items' =>  function ($query) {
                $query->active()->with('category')->orderBy('name', 'ASC');
            }])->has('items', '>', 0)->active()->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->get()
        )]);
    }
}
