@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Products</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Product</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Edit Product Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.product.update',$product->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Preview</label><br>
                                <img src="{{ asset($product->thumbnail) }}" width="200" alt="" srcset="">
                            </div>
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
                                            value="{{$product->name}}" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group col-md-4">
                                    <label>Brand</label>
                                    <select class="js-example-basic-single form-control main-category" name="brand_id">
                                        <option selected>SELECT</option>
                                        @foreach($brands as $brand)
                                        <option {{$brand->id == $product->brand_id ? "selected":"" }} value="{{
                                            $brand->id }}">{{ $brand->name }}</option>
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
                                        <option {{$category->id == $product->category_id ? "selected":"" }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Sub Category</label>
                                    <select class="js-example-basic-single sub-category form-control"
                                        name="subcategory_id">

                                        @foreach ($subcategories as $subcategory) )
                                        <option {{$subcategory->id == $product->subcategory_id ? "selected":"" }}
                                            value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Child Category</label>
                                    <select class="js-example-basic-single child-category form-control"
                                        name="childcategory_id">

                                        @foreach ($childcategories as $childcategory) )
                                        <option {{$childcategory->id == $product->childcategory_id ? "selected":"" }}
                                            value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" class="form-control"
                                    rows="4">{{$product->short_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Long Description</label>
                                <textarea class="summernote"
                                    name="long_description">{{ $product->long_description}}</textarea>

                            </div>

                            <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" name="video_url" value="{{$product->video_url}}"
                                    class="form-control">
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>SKU</label>
                                    <input type="text" name="sku" value="{{$product->sku}}" class="form-control"
                                        placeholder="SKU">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Stock Quantity</label>
                                    <input type="text" name="quantity" value="{{$product->quantity}}"
                                        class="form-control" placeholder="Stock Quantity">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" value="{{$product->price}}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="number" name="offer_price" value="{{$product->offer_price}}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer Start Date</label>
                                        <input type="date" name="offer_start_date"
                                            value="{{$product->offer_start_date}}" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer End Date</label>
                                        <input type="date" name="offer_end_date" value="{{$product->offer_end_date}}"
                                            class="form-control datepicker">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Product Type</label>
                                    <select class="form-control js-example-basic-single" name="product_type">
                                        <option value="new_arrival" {{ $product->product_type == 'new_arrival' ?
                                            'selected' : '' }}>New Arrival</option>
                                        <option value="featured_product" {{ $product->product_type == 'featured_product'
                                            ? 'selected' : '' }}>Featured</option>
                                        <option value="top_product" {{ $product->product_type == 'top_product' ?
                                            'selected' : '' }}>Top Product</option>
                                        <option value="best_product" {{ $product->product_type == 'best_product' ?
                                            'selected' : '' }}>Best Product</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select class="form-control js-example-basic-single" name="status">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" name="seo_title" value="{{$product->seo_title}}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>SEO Description</label>
                                <textarea name="seo_description" class="form-control"
                                    rows="4">{{$product->seo_description}}</textarea>
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