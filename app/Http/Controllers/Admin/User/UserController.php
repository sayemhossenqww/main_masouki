<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Show the list of all users.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $sorts = ['asc', 'desc'];
        $sort = $request->get('order', 'desc');
        $size = $request->get('size', 20);

        if (!in_array($sort, $sorts)) {
            $sort = 'desc';
        }

        $users = User::orderBy('created_at', $sort)->paginate($size);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the user create form.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store new user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')],
            'password' => ['required', 'confirmed', 'string', 'max:30', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back()->with('success', 'The user has been created!');
    }

    /**
     * Delete user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return Redirect::back()->with('success', 'The user has been deleted!');
    }
}
