<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductVariant;
use App\Models\ProductImageGallery;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'quantity' => 'required|integer',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'video_url' => 'nullable|url',
            'sku' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date',
            'product_type' => 'nullable|string',
            'status' => 'required|boolean',
            'is_approved' => 'nullable|integer',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_url = $request->video_url;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->is_approved = 1;

        $thaumbnial_path = $this->uploadImage($request, 'thumbnail', 'uploads/product');
        $product->thumbnail = $thaumbnial_path;
        $product->save();
        toastr()->success('Product Created Successfully');
        return redirect()->route('admin.product.index');

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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();
        $childcategories = ChildCategory::where('subcategory_id', $product->subcategory_id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subcategories', 'childcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'thumbnail' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'quantity' => 'required|integer',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'video_url' => 'nullable|url',
            'sku' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date',
            'product_type' => 'nullable|string',
            'status' => 'required|boolean',
            'is_approved' => 'nullable|integer',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);


        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_url = $request->video_url;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;


        $thaumbnial_path = $this->updateImage($request, 'thumbnail', 'uploads/product', $product->thumbnail);
        $product->thumbnail = empty($thaumbnial_path) ? $product->thumbnail : $thaumbnial_path;
        $product->save();
        toastr()->success('Product Updated Successfully');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->thumbnail);
        $product->delete();

        $galleryImages = ProductImageGallery::where('product_id', $id)->get();

        foreach ($galleryImages as $galleryImage) {
            $this->deleteImage($galleryImage->image);
            $galleryImage->delete();
        }

        $variants = ProductVariant::where('product_id', $id)->get();

        foreach ($variants as $variant) {
            $variant->variantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);


    }

    public function changeStatus(Request $request, )
    {

        $category = Product::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product Status Updated Successfully'
        ]);
    }
}