<?php

namespace App\Http\Controllers\API\V1;

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
        $isOpen = $store_status->value == Strings::OPEN;
        $text = $isOpen ? '' : Setting::CLOSED_MESSAGE;
        return $this->jsonResponse([
            'is_open' =>  $isOpen,
            'text' => $text
        ]);
    }
}
