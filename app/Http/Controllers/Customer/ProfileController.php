<?php

namespace App\Http\Controllers\Customer;

use App\Age;
use App\County;
use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @return Response
     * */
    public function updateAvatar(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $path = 'account/uploads/';
            $filename = time(). '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path($path . $filename));
            if ($request->user()->avatar !=='avatar.png'){
                $old_avatar = $path . $request->user()->avatar;
                if (File::exists(public_path($old_avatar))){
                    File::delete(public_path($old_avatar));
                }
            }
            $request->user()->avatar = $filename;
            $request->user()->save();
        }

        return redirect()->back()->with(['success' => 'Your image was updated successfully']);
    }

}
