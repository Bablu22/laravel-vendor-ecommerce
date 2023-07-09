@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.slider.index')}}">Slider</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create Slider</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Create Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Banner</label>
                                <input type="file" name="banner" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <input type="text" name="type" value="{{old('type')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Starting Price</label>
                                <input type="text" value="{{old('starting_price')}}" name="starting_price"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Button Url</label>
                                <input type="text" name="btn_url" value="{{old('btn_url')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Serial</label>
                                <input type="text" name="serial" value="{{old('serial')}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
@endsection