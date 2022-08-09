@extends('admin.layout.admin')

@section('title','Note')

@section('note','active')


@section('style')
    {{-- Datatable --}}
    {{--<link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />--}}
    {{-- Datatable --}}
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Notes</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Notes</li>
                            </ol>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/admin/assets/pages/jquery.datatable.init.js')}}"></script> --}}
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            //Datatable
            // $('#datatable').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: '{!! route('post.index') !!}',
            //     columns:[
            //         { data: 'postdetails', name: 'postdetails'},
            //         { data: 'category', name: 'category'},
            //         { data: 'status', name: 'status'},
            //         { data: 'created_at', name: 'created_at' },
            //         { data: 'action', name: 'action' },
            //     ]
            // });


            //Action Delete function
            // $(document).on('click','.delete',function(){
            //     var id =  $(this).attr('id');
            //     swalWithBootstrapButtons({
            //         title: "Delete Selected Post?",
            //         text: "You won't be able to revert this!",
            //         type: "warning",
            //         showCancelButton: true,
            //         confirmButtonText: "Delete",
            //         cancelButtonText: "Cancel",
            //         reverseButtons: true
            //     }).then(result => {
            //         if (result.value) {
            //         $.ajax({
            //             url: "post/"+id,
            //             type:"post",
            //             data: {_method: 'delete', _token: "{{ csrf_token() }}"},
            //             success: function(result){
            //                 location.reload();
            //                 toast({
            //                     type: "success",
            //                     title: "Post Deleted Successfully"
            //                 });
            //             }
            //         });
            //         }
            //     });
            // });

        });

    </script>

@endsection
