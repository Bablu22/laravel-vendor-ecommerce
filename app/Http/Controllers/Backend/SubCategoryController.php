<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\SubCategoryDataTable;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'not_in:empty'],
            'name' => ['required', 'string', 'max:255', 'unique:sub_categories,name'],
            'status' => ['required']
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->status = $request->status;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->save();

        toastr()->success('Sub Category created successfully.');
        return redirect()->route('admin.subcategory.index');
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
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.sub-category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required', 'not_in:empty'],
            'name' => ['required', 'string', 'max:255', 'unique:sub_categories,name,' . $id],
            'status' => ['required']
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->status = $request->status;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->save();

        toastr()->success('Sub Category updated successfully.');
        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        // check if sub category has any childcategory
        $childCategory = ChildCategory::where('subcategory_id', $subCategory->id)->count();
        if ($childCategory > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'You can not delete this sub category. Because it has child category.'
            ]);
        }
        $subCategory->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sub Category deleted successfully.'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = $request->status == 'true' ? 1 : 0;
        $subCategory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Sub Category status updated successfully.'
        ]);
    }
}