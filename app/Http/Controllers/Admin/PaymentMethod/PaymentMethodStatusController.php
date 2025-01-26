<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class PaymentMethodStatusController extends Controller
{

    /**
     * Update the specified resource status in storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->update([
            'active' => !$paymentMethod->active
        ]);
        Cache::forget(PaymentMethod::CACHE_KEY);
        return $this->jsonResponse();
    }
}
