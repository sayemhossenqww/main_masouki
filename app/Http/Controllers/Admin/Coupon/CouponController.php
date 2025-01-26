<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequests\CouponStoreRequest;
use App\Http\Requests\CouponRequests\CouponUpdateRequest;
use App\Http\Resources\CouponResources\CouponResourceCollection;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CouponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(['data' => new CouponResourceCollection(
            Coupon::latest()->get()
        )]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CouponRequests\CouponStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CouponStoreRequest $request): JsonResponse
    {
        Coupon::create([
            'code' => $request->code,
            'percentage' => $request->percentage,
            'des' => $request->des,
            'active' => true,
        ]);
        return $this->jsonResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CouponRequests\CouponUpdateRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CouponUpdateRequest $request, Coupon $coupon): JsonResponse
    {
        $coupon->update([
            'code' => $request->code,
            'percentage' => $request->percentage,
            'des' => $request->des,
        ]);
        return $this->jsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Coupon $coupon): JsonResponse
    {
        $coupon->delete();
        return $this->jsonResponse();
    }
}
