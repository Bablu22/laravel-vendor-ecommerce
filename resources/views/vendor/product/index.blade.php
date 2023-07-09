@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i>Products</h3>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{route('vendor.product.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Create Product</a>
                    </div>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            {{ $dataTable->table() }}
                        </div>
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
        $('body').on('click','.change-status',function(){
            let id = $(this).data('id');
            let isChacked=$(this).is(':checked');

            $.ajax({
                url: "{{route('vendor.product.change-status')}}",
                type: "PUT",
                data: {
                    id: id,
                    status:isChacked
                },
                success: function(response){
                    if(response.status == 'success'){
                        Swal.fire(
                            'Status Changed!',
                            response.message,
                            'success'
                        );
                        window.location.reload();
                    }else if(response.status == 'error'){
                        Swal.fire(
                            'Status Changed!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(error){
                    Swal.fire(
                        'Status Changed!',
                        'There are some problems',
                        'error'
                    );
                }
            })
        })
    })
</script>

@endpush
