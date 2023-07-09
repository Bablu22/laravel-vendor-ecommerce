<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUpload
{

    public function uploadImage(Request $request, $image, $path)
    {
        if ($request->hasFile($image)) {

            $image = $request->file($image);
            $extension = $image->getClientOriginalExtension();
            $imageName = uniqid() . '_' . time() . '.' . $extension;
            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function uploadMultipleImage(Request $request, $image, $path)
    {
        if ($request->hasFile($image)) {

            $images = $request->file($image);
            $image_array = [];
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $imageName = uniqid() . '_' . time() . '.' . $extension;
                $image->move(public_path($path), $imageName);
                $image_array[] = $path . '/' . $imageName;
            }

            return $image_array;
        }
    }


    public function updateImage(Request $request, $image, $path, $old_path = null)
    {
        if ($request->hasFile($image)) {
            if (File::exists(public_path($old_path))) {
                File::delete(public_path($old_path));
            }
            $image = $request->file($image);
            $extension = $image->getClientOriginalExtension();
            $imageName = uniqid() . '_' . time() . '.' . $extension;
            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function deleteImage($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

}