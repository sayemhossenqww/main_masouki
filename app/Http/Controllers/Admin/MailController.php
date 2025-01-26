<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ComposeMessageMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'message' => ['required'],
        ]);

        try {
            Mail::to(config('app.email'))->send(new ComposeMessageMail($request));
            Mail::to($request->email)->send(new ComposeMessageMail($request));
            $this->jsonResponse();
        } catch (Exception $ex) {
            $this->jsonResponse(null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
