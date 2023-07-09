<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class AdminVendorProfileController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', auth()->user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'max:100'],
                'email' => ['required', 'email', 'max:50'],
                'phone_no' => ['required', 'max:15'],
                'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
                'address' => ['required', 'max:255'],
                'description' => ['required', 'max:255'],
                'fb_link' => ['nullable', 'url', 'max:255'],
                'twitter_link' => ['nullable', 'url', 'max:255'],
                'insta_link' => ['nullable', 'url', 'max:255'],

            ]
        );

        $vendor = Vendor::where('user_id', auth()->user()->id)->first();

        $bannder_path = $this->updateImage($request, 'banner', 'uploads/vendor', $vendor->banner);
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone_no = $request->phone_no;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->twitter_link = $request->twitter_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->banner = empty($bannder_path) ? $vendor->banner : $bannder_path;
        $vendor->save();

        toastr()->success('Profile updated successfully.');
        return redirect()->route('admin.vendor-profile.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}