@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage Categories</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Child Category</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Child Categories</h2>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header ">
                        <h4>Table</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.childcategory.create')}}"
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
        $('body').on('click','.change-status',function(){
            let id = $(this).data('id');
            let isChacked=$(this).is(':checked');

            $.ajax({
                url: "{{ route('admin.childcategory.change-status')}}",
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