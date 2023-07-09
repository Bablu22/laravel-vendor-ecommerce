@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.subcategory.index') }}">Sub Category</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create Slider</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.subcategory.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Category</label>
                                <select class="js-example-basic-single form-control" name="category_id">
                                    <option selected>SELECT</option>
                                    @foreach($categories as $category)

                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
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