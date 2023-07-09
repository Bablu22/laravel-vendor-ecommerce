<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255', 'not_in:empty,'],
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'status' => ['required']
        ]);

        $category = new Category();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name);
        $category->save();

        toastr()->success('Category created successfully.');
        return redirect()->route('admin.category.index');
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
        return view('admin.category.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255', 'not_in:empty,'],
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $id],
            'status' => ['required']
        ]);

        $category = Category::findOrFail($id);
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name);
        $category->save();

        toastr()->success('Category updated successfully.');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // check subcategory
        if ($category->subcategories()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category has subcategories. Please delete them first.'
            ]);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully.'
        ]);
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function changeStatus(Request $request, )
    {

        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category status updated successfully.'
        ]);
    }

}