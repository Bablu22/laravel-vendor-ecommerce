@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.brand.index')}}">Brands</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create Brands</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Brands Informations</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="inputState">Is Featured</label>
                                <select id="inputState" class="form-control" name="is_featured">
                                    <option value="1" selected>SELECT</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
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
