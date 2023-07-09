<?php

namespace App\Http\Controllers\Backend;

use App\Models\Vendor;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', auth()->user()->id)->first();
        return view('vendor.shop-profile.index', compact('profile'));
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
        $request->validate([
            'banner' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'phone_no' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable', 'url', 'max:255'],
            'twitter_link' => ['nullable', 'url', 'max:255'],
            'insta_link' => ['nullable', 'url', 'max:255'],
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        $bannerPath = $this->updateImage($request, 'banner', 'uploads/vendor', $vendor->banner);
        $vendor->banner = empty(!$bannerPath) ? $bannerPath : $vendor->banner;
        $vendor->name = $request->name;
        $vendor->phone_no = $request->phone_no;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->twitter_link = $request->twitter_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->back();
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