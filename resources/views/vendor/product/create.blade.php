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
                            <form action="{{route('vendor.product.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group wsus__input">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="thumbnail">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group wsus__input">
                                            <label for="inputState">Category</label>
                                            <select id="inputState" class="form-control main-category"
                                                name="category_id">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group wsus__input">
                                            <label for="inputState">Sub Category</label>
                                            <select id="inputState" class="form-control sub-category"
                                                name="subcategory_id">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group wsus__input">
                                            <label for="inputState">Child Category</label>
                                            <select id="inputState" class="form-control child-category"
                                                name="childcategory_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group wsus__input">
                                    <label for="inputState">Brand</label>
                                    <select id="inputState" class="form-control" name="brand_id">
                                        <option value="">Select</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{old('price')}}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{old('offer_price')}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{old('offer_start_date')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group wsus__input">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{old('offer_end_date')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Stock Quantity</label>
                                    <input type="number" min="0" class="form-control" name="quantity"
                                        value="{{old('quantity')}}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Video Link</label>
                                    <input type="text" class="form-control" name="video_url"
                                        value="{{old('video_url')}}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Short Description</label>
                                    <textarea name="short_description"
                                        class="form-control">{{old('short_description')}}</textarea>
                                </div>


                                <div class="form-group wsus__input">
                                    <label>Long Description</label>
                                    <textarea name="long_description"
                                        class="form-control summernote">{{old('long_description')}}</textarea>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{old('seo_title')}}">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Seo Description</label>
                                    <textarea name="seo_description" class="form-control"></textarea>
                                </div>

                                <div class="form-group wsus__input">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submmit" class="btn btn-primary">Create</button>
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
