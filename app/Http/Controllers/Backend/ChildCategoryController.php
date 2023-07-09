<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ChildCategoryDataTable;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category_id' => ['required', 'integer'],
                'subcategory_id' => ['required', 'integer'],
                'name' => ['required', 'string', 'max:255', 'unique:child_categories'],
                'status' => ['required', 'integer'],
            ]
        );

        $childCategory = new ChildCategory();
        $childCategory->category_id = $request->category_id;
        $childCategory->subcategory_id = $request->subcategory_id;
        $childCategory->name = $request->name;
        $childCategory->status = $request->status;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->save();

        toastr()->success('Child Category created successfully.');
        return redirect()->route('admin.childcategory.index');
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
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $childCategory = ChildCategory::findOrFail($id);
        return view('admin.child-category.edit', compact('childCategory', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'category_id' => ['required', 'integer'],
                'subcategory_id' => ['required', 'integer'],
                'name' => ['required', 'string', 'max:255', 'unique:child_categories,name,' . $id],
                'status' => ['required', 'integer'],
            ]
        );

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->category_id = $request->category_id;
        $childCategory->subcategory_id = $request->subcategory_id;
        $childCategory->name = $request->name;
        $childCategory->status = $request->status;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->save();

        toastr()->success('Child Category updated successfully.');
        return redirect()->route('admin.childcategory.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response()->json(['status' => 'success', 'message' => 'Child Category deleted successfully.']);
    }

    public function getSubcategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();

        return response()->json($subCategories);
    }

    public function getChildcategories(Request $request)
    {
        $childCategories = ChildCategory::where('subcategory_id', $request->id)->where('status', 1)->get();

        return response()->json($childCategories);
    }

    public function changeStatus(Request $request, )
    {

        $category = ChildCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category status updated successfully.'
        ]);
    }


}