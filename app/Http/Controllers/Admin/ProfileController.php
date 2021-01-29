<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateAvatarRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
//        return \Auth::user()->profile;
        return view('admin.profile.index');
    }

    /**
     * @param UpdateAdminRequest $request
     * @return Response
     * */
    public function update(UpdateAdminRequest $request)
    {
        $user = \Auth::user();
        $request->merge([
            'phone' => preg_replace('/^(0|254)/', '+254', $request->get('phone'))
        ]);
        $user->update($request->all());
        return redirect()->back()->with('success', __('global.update_info_success'));
    }

    /**
     * @param AdminUpdateAvatarRequest $request
     * @return Response
     * */
    public function updateAvatar(AdminUpdateAvatarRequest $request)
    {
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $admin = \Auth::user();

            if (count($admin->profile) > 0) {
                foreach ($admin->profile as $media) {
                    $media->delete();
                }
            }

            $admin->addMediaFromRequest('avatar')
                ->usingFileName($file->hashName())
                ->preservingOriginal()
                ->toMediaCollection('admin_profile');
        }

        return redirect()->back()
            ->with(['success' => 'Your image was updated successfully']);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->all()['old_password'], $user->password)){
            return back()->withErrors(['old_password' => 'You have entered wrong password']);
        }

        $user->password = Hash::make($request->all()['password']);
        $user->save();

        return back()->with('success', __('global.change_password_success'));
    }
}
