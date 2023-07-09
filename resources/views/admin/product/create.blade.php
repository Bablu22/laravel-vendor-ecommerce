@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Products</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create Product</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Product Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Product name" name="name"
                                            value="{{old('name')}}" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group col-md-4">
                                    <label>Brand</label>
                                    <select class="js-example-basic-single form-control main-category" name="brand_id">
                                        <option selected>SELECT</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    <select class="js-example-basic-single form-control main-category"
                                        name="category_id">
                                        <option selected>SELECT</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Sub Category</label>
                                    <select class="js-example-basic-single sub-category form-control"
                                        name="subcategory_id">

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Child Category</label>
                                    <select class="js-example-basic-single child-category form-control"
                                        name="childcategory_id">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" class="form-control"
                                    rows="4">{{old('short_description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Long Description</label>
                                <textarea class="summernote"
                                    name="long_description">{{ old('long_description')}}</textarea>

                            </div>

                            <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" name="video_url" value="{{old('video_url')}}" class="form-control">
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>SKU</label>
                                    <input type="text" name="sku" value="{{old('sku')}}" class="form-control"
                                        placeholder="SKU">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Stock Quantity</label>
                                    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control"
                                        placeholder="Stock Quantity">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" value="{{old('price')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="number" name="offer_price" value="{{old('offer_price')}}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer Start Date</label>
                                        <input type="date" name="offer_start_date" value="{{old('offer_start_date')}}"
                                            class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer End Date</label>
                                        <input type="date" name="offer_end_date" value="{{old('offer_end_date')}}"
                                            class="form-control datepicker">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Product Type</label>
                                    <select class="form-control js-example-basic-single" name="product_type">
                                        <option value="new_arrival">New Arrival</option>
                                        <option value="featured_product">Featured</option>
                                        <option value="top_product">Top Product</option>
                                        <option value="best_product">Best Product</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select class="form-control js-example-basic-single" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" name="seo_title" value="{{old('seo_title')}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>SEO Description</label>
                                <textarea name="seo_description" class="form-control"
                                    rows="4">{{old('seo_description')}}</textarea>
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


@push('scripts')

<script>
    $(document).ready(function () {
        $('body').on('change','.main-category',function(){
            let id = $(this).val();
            $.ajax({
                url: "{{ route('admin.get-subcategories')}}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response){

                        let html_option = '<option value="">SELECT</option>';
                        response.forEach(element => {
                            html_option += '<option value="'+element.id+'">'+element.name+'</option>';
                        });
                        $('.sub-category').html(html_option);

                }
            });

        })
    })
</script>

<script>
    $(document).ready(function () {
        $('body').on('change','.sub-category',function(){
            let id = $(this).val();
            $.ajax({
                url: "{{ route('admin.get-childcategories')}}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response){

                        let html_option = '<option value="">SELECT</option>';
                        response.forEach(element => {
                            html_option += '<option value="'+element.id+'">'+element.name+'</option>';
                        });
                        $('.child-category').html(html_option);

                }
            });

        })
    })
</script>

@endpush
