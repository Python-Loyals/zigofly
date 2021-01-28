<?php

namespace App\Http\Controllers\Customer;

use App\Age;
use App\County;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateAvatarRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $ages = Age::all()->pluck('age', 'id');
        $counties = County::all()->pluck('name', 'id');
        return view('customer.profile.index', compact('ages', 'counties'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
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
        if ($request->hasFile('avatar')) {
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
                ->toMediaCollection('customer_profile');
        }

        return redirect()->back()
            ->with(['success' => 'Your image was updated successfully']);
    }

}
