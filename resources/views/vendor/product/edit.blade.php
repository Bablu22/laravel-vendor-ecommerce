@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <a href="{{route('vendor.product.index')}}" class="btn btn-warning mb-4"><i
                        class="fas fa-long-arrow-left"></i> Back</a>
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Products</h3>

                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <form action="{{ route('vendor.product.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group wsus__input">
                                    <label>Preview</label><br>
                                    <img src="{{ asset($product->thumbnail) }}" width="200" alt="" srcset="">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group wsus__input">
                                            <label>Thumbnail</label>
                                            <input type="file" name="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group wsus__input">
                                            <label>Name</label>
                                            <input type="text" placeholder="Product name" name="name"
                                                value="{{ $product->name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 wsus__input">
                                        <label>Brand</label>
                                        <select class=" form-control main-category" name="brand_id">
                                            <option selected>SELECT</option>
                                            @foreach($brands as $brand)
                                            <option {{ $brand->id == $product->brand_id ? "selected" : "" }} value="{{
                                                $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 wsus__input">
                                        <label>Category</label>
                                        <select class=" form-control main-category" name="category_id">
                                            <option selected>SELECT</option>
                                            @foreach($categories as $category)
                                            <option {{ $category->id == $product->category_id ? "selected" : "" }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 wsus__input">
                                        <label>Sub Category</label>
                                        <select class=" sub-category form-control" name="subcategory_id">
                                            @foreach ($subcategories as $subcategory)
                                            <option {{ $subcategory->id == $product->subcategory_id ? "selected" : "" }}
                                                value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 wsus__input">
                                        <label>Child Category</label>
                                        <select class="child-category form-control" name="childcategory_id">
                                            @foreach ($childcategories as $childcategory)
                                            <option {{ $childcategory->id == $product->childcategory_id ? "selected" :
                                                "" }} value="{{ $childcategory->id }}">{{ $childcategory->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control"
                                        rows="4">{{ $product->short_description }}</textarea>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Long Description</label>
                                    <textarea class="summernote"
                                        name="long_description">{{ $product->long_description }}</textarea>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Video URL</label>
                                    <input type="text" name="video_url" value="{{ $product->video_url }}"
                                        class="form-control">
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 wsus__input">
                                        <label>SKU</label>
                                        <input type="text" name="sku" value="{{ $product->sku }}" class="form-control"
                                            placeholder="SKU">
                                    </div>
                                    <div class="form-group col-md-6 wsus__input">
                                        <label>Stock Quantity</label>
                                        <input type="text" name="quantity" value="{{ $product->quantity }}"
                                            class="form-control" placeholder="Stock Quantity">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Price</label>
                                            <input type="number" name="price" value="{{ $product->price }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Offer Price</label>
                                            <input type="number" name="offer_price" value="{{ $product->offer_price }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Offer Start Date</label>
                                            <input type="date" name="offer_start_date"
                                                value="{{ $product->offer_start_date }}"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Offer End Date</label>
                                            <input type="date" name="offer_end_date"
                                                value="{{ $product->offer_end_date }}" class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 wsus__input">
                                        <label>Status</label>
                                        <select class="form-control " name="status">
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ $product->seo_title }}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" class="form-control"
                                        rows="4">{{ $product->seo_description }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
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
                url: "{{ route('vendor.get-subcategories')}}",
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
                url: "{{ route('vendor.get-childcategories')}}",
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
