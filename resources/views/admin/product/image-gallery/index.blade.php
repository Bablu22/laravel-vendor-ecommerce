@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Products</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Products</a></div>
            <div class="breadcrumb-item">Products Image Gallery</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Product Image Gallery </h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">

                        <div class="card-header">
                            <h4>Product: {{$product->name}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.product-image-gallery.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Images <code>(Multilpe image suported)</code></label>
                                <input type="file" name="images[]" class="form-control" multiple>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>All Images</h4>

                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


@endpush
