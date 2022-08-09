@extends('admin.layout.admin')

@section('title','Contact')

@section('contact','active')


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
                            <h4 class="page-title">Contacts</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Contacts</li>
                            </ol>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            @foreach($contacts as $contact)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="media">
                                    <div class="avatar-box thumb-lg align-self-center me-2">
                                        <span class="avatar-title bg-soft-pink rounded-circle">{{substr($contact->name, 0, 2)}}</span>
                                    </div>
                                    <div class="media-body ml-3 align-self-center">
                                        <h5 class="mt-0 mb-1">{{$contact->name}}</h5>
                                        <p class="mb-0 text-muted">{{$contact->email}}</p>
                                    </div>
                                </div><!--end media-->
                            </div><!--end col-->
                            <div class="col-auto align-self-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="mr-1 contact-icon"><i class="fas fa-phone"></i></a>
                                        <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                    </li>
                                </ul>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            @endforeach

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
