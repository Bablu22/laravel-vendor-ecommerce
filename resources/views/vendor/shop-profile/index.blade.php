@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Shop Profile</h3>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <h4>basic information</h4>
                            <form method="POST" action="{{ route('vendor.shop-profile.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="col-xl-3 col-sm-6 col-md-6">

                                            <div class="wsus__dash_pro_img">
                                                <img src="{{ $profile->banner }}" alt="img" class="img-fluid w-100">
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-10">
                                            <div class="col-xl-6 col-md-6 mt-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-user-tie"></i>
                                                    <input type="text" name="name" value="{{ $profile->name }}"
                                                        class="form-control" placeholder="Name">
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 mt-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fal fa-envelope-open"></i>
                                                    <input type="email" name="email" value="{{ $profile->email }}"
                                                        class="form-control" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fas fa-phone"></i>
                                            <input type="text" name="phone_no" value="{{ $profile->phone_no }}"
                                                class="form-control" placeholder="Phone Number">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <input type="text" name="address" value="{{ $profile->address }}"
                                                class="form-control" placeholder="Address">
                                        </div>
                                    </div>




                                    <div class="col-xl-12">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-facebook"></i>
                                            <input type="text" name="fb_link" value="{{ $profile->fb_link }}"
                                                class="form-control" placeholder="Facebook Link">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-twitter"></i>
                                            <input type="text" name="twitter_link" value="{{ $profile->twitter_link }}"
                                                class="form-control" placeholder="Twitter Link">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-instagram"></i>
                                            <input type="text" name="insta_link" value="{{ $profile->insta_link }}"
                                                class="form-control" placeholder="Instagram Link">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group mb-3">
                                            <label>Shop Description</label>
                                            <textarea class="summernote"
                                                name="description">{{ $profile->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button class="common_btn mb-4 mt-2" type="submit">Upload</button>
                                    </div>

                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
