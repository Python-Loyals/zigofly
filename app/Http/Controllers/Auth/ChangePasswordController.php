<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->all()['old_password'], $user->password)){
            return back()->withErrors(['old_password' => 'You have entered wrong password']);
        }

        $user->password = Hash::make($request->all()['password']);
        $user->save();
        return $user;
        return back()->with('success', __('global.change_password_success'));
    }
}
