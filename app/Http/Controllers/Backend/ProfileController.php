<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,' . Auth::id()],
            'image' => ['nullable', 'max:2048', 'mimes:jpg,jpeg,png,webp']
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
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated successfully.');
        return redirect()->back();
    }

}