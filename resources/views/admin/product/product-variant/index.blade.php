@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Products Variant</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Products</a></div>
            <div class="breadcrumb-item">Product Variant</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Product Variant</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Simple Table</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.product-variant.create',['product' => $product->id])}}"
                                class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i>
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

<script>
    $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.product-variant.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
</script>
@endpush
