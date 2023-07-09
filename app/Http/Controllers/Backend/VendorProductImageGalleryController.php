<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Models\ProductImageGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorProductImageGalleryDataTable;

class VendorProductImageGalleryController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        /** Check product vendor */
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
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
                'product_id' => 'required|exists:products,id',
                'images.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            ]
        );

        $imagePath = $this->uploadMultipleImage($request, 'images', 'uploads/product-gallery');

        foreach ($imagePath as $image) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->product_id = $request->product_id;
            $productImageGallery->image = $image;
            $productImageGallery->save();
        }

        toastr()->success('Product image gallery created successfully');
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
        $productImage = ProductImageGallery::findOrFail($id);

        /** Check product vendor */
        if ($productImage->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        $this->deleteImage($productImage->image);
        $productImage->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}