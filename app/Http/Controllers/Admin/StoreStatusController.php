<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\Strings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreStatusController extends Controller
{

    /**
     *  Show store status "open/closed".
     *
     *  @return \Illuminate\Http\JsonResponse
     */
    public function show(): JsonResponse
    {
        $store_status = Setting::findOrFail(Setting::STORE_STATUS);
        return $this->jsonResponse(['is_open' => $store_status->value === Strings::OPEN ? true : false]);
    }

    /**
     *  Update store status "open/closed".
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'status' => 'required',
        ]);
        $store_status = Setting::findOrFail(Setting::STORE_STATUS);
        $store_status->update([
            'value' => $request->status ? Strings::OPEN : Strings::CLOSED
        ]);
        return $this->jsonResponse();
    }
}
