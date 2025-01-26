<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserPasswordUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserPasswordController extends Controller
{

    /**
     * Update user's password.
     *
     * @param  \App\Http\Requests\UserRequests\UserPasswordUpdateRequest  $request
     * @return \Illuminate\Http\JsonResponse 
     */
    public function update(UserPasswordUpdateRequest $request): JsonResponse
    {
        $user = $request->user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return $this->jsonResponse(['message' => 'Password Updated Successfully']);
        }
        throw ValidationException::withMessages([
            'current_password' => ['Senha inválida'],
        ]);
    }
}
