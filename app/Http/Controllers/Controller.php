<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Response represents an HTTP response in JSON format.
     *
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     * @param int   $options
     * @param bool  $json
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(
        $data = null,
        $status = 200,
        $headers = [],
        $options = 0,
        $json = false
    ): JsonResponse {
        $data['status'] = Str::lower(Response::$statusTexts[$status]);
        // $data['code'] = $status;
        return new JsonResponse($data, $status, $headers, $options, $json);
    }
}
