<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendorProfileController extends Controller
{
    public function index()
    {
        return view('vendor.dashboard.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
            'image' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048']

        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image = $request->file('image');
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = '/uploads/' . $imageName;
            $user->image = $path;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile updated successfully.');
        return back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr()->success('Password updated successfully.');
        return back();
    }

}