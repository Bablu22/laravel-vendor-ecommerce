@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a>
            </div>
            <div class="breadcrumb-item">Update</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Update Vendor Profile</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Preview</label><br>
                                <img src="{{ asset($profile->banner) }}" width="200" alt="" srcset="">
                            </div>
                            <div class="form-group">
                                <label>Banner</label>
                                <input type="file" name="banner" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $profile->name}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $profile->email }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" value="{{ $profile->phone_no }}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input name="address" class="form-control" value="{{$profile->address }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="summernote" name="description">{{ $profile->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link</label>
                                <input type="text" name="fb_link" value="{{ $profile->fb_link }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="text" name="twitter_link" value="{{ $profile->twitter_link }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Instagram Link</label>
                                <input type="text" name="insta_link" value="{{ $profile->insta_link }}"
                                    class="form-control">
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
