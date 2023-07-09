@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Slider</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Home Slider</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Simple Table</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.slider.create')}}" class="btn btn-icon icon-left btn-primary"><i
                                    class="fa fa-plus"></i>
                                Create New</a>
                        </div>
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