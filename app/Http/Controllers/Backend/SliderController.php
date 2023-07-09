<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SliderDataTable;

class SliderController extends Controller
{

    use ImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        // return view('admin.slider.index');
        return $dataTable->render('admin.slider.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'type' => ['string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'starting_price' => ['string', 'max:255'],
            'btn_url' => ['url'],
            'serial' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);


        $slider = new Slider();

        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Slider created successfully.');
        return redirect()->route('admin.slider.index');

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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'type' => ['string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'starting_price' => ['string', 'max:255'],
            'btn_url' => ['url'],
            'serial' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $slider = Slider::findOrFail($id);
        $imagepath = $this->updateImage($request, 'banner', 'uploads', $slider->banner);

        $slider->banner = empty($imagepath) ? $slider->banner : $imagepath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Slider updated successfully.');
        return redirect()->route('admin.slider.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Slider deleted successfully.'
        ]);
    }
}