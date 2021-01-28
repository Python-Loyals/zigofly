<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateAvatarRequest;

class ProfileController extends Controller
{
    public function index()
    {
//        return \Auth::user()->profile;
        return view('admin.profile.index');
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
}
