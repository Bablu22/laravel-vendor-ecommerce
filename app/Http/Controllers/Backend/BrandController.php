<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

    use ImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|unique:brands,name',
            'is_featured' => 'required',
            'status' => 'required',
        ]);

        $imagePath = $this->uploadImage($request, 'logo', 'uploads/brands');

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->logo = $imagePath;
        $brand->save();

        toastr()->success('Brand created successfully.');

        return redirect()->route('admin.brand.index');

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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,' . $id,
            'is_featured' => 'required',
            'status' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = Brand::findOrFail($id);
        $imagePath = $this->updateImage($request, 'logo', 'uploads/brands');
        $brand->logo = empty($imagePath) ? $brand->logo : $imagePath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr()->success('Brand updated successfully.');
        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->logo);
        $brand->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Brand deleted successfully.'
        ]);

    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Status changed successfully.'
        ]);
    }

}