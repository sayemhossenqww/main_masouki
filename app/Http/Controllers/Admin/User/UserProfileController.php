<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserProfileInformationUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    /**
     * Show the user settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request): View
    {
        return view('admin.profile.show', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }


    /**
     * Update user profile info .
     *
     * @param  \App\Http\Requests\UserProfileInformationUpdateRequest  $request
     * @return \Illuminate\View\RedirectResponse
     */
    public function update(UserProfileInformationUpdateRequest $request): RedirectResponse
    {
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return Redirect::back()->with('success', 'Profile info updated');
    }
}
