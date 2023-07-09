@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.brand.index')}}">Brands</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Brands</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Edit Brands Informations</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.brand.update',$brand->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Preview</label><br>
                                <img src="{{ asset($brand->logo) }}" width="200" alt="" srcset="">
                            </div>
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="inputState">Is Featured</label>
                                <select id="inputState" class="form-control" name="is_featured">
                                    <option value="1" selected>SELECT</option>
                                    <option {{$brand->is_featured ==1 ? "selected":""}} value="1">Yes</option>
                                    <option {{$brand->is_featured ==0 ? "selected":""}} value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option {{$brand->status ==1 ? "selected":""}} value="1">Active</option>
                                    <option {{$brand->status ==0 ? "selected":""}} value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
@endsection
