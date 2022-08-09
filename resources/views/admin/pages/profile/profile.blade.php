@extends('admin.layout.admin')

@section('title','Profile')

@section('profile','active')


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
                            <h4 class="page-title">Profiles</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Profiles</li>
                            </ol>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                <div class="dastone-profile-main">

                    @if(!Auth::user()->avatar_url)
                        <div class="avatar-box thumb-sm align-self-center me-2">
                            <span class="avatar-title bg-soft-pink rounded-circle">{{substr(Auth::user()->firstName, 0, 1) . substr(Auth::user()->lastName, 0, 1)}}</span>
                        </div>
                    @else
                        <img src="{{setting('app_icon')}}" alt="profile-user" class="rounded-circle thumb-md" />
                    @endif
                    <img src="{{setting('app_icon')}}" alt="profile-user" class="rounded-circle thumb-md" />

                    <div class="dastone-profile-main-pic">
                        <img src="{{setting('app_icon')}}" alt="" height="110" class="rounded-circle">
                        <span class="dastone-profile_main-pic-change">
                            <i class="fas fa-camera"></i>
                        </span>
                    </div>
                    <div class="dastone-profile_user-detail">
                        <h5 class="dastone-user-name">Rosa Dodson</h5>                                                        
                        <p class="mb-0 dastone-user-name-post">UI/UX Designer, India</p>                                                        
                    </div>
                </div>                                                
            </div><!--end col-->
            
            <div class="col-lg-4 ml-auto align-self-center">
                <ul class="list-unstyled personal-detail mb-0">
                    <li class=""><i class="las la-phone mr-2 text-secondary font-22 align-middle"></i> <b> phone </b> : +91 23456 78910</li>
                    <li class="mt-2"><i class="las la-envelope text-secondary font-22 align-middle mr-2"></i> <b> Email </b> : mannat.theme@gmail.com</li>
                    <li class="mt-2"><i class="las la-globe text-secondary font-22 align-middle mr-2"></i> <b> Website </b> : 
                        <a href="https://mannatthemes.com/" class="font-14 text-primary">https://mannatthemes.com/</a> 
                    </li>                                                   
                </ul>
                
            </div><!--end col-->
            <div class="col-lg-4 align-self-center">
                <div class="row">
                    <div class="col-auto text-right border-right">
                        <button type="button" class="btn btn-soft-primary btn-icon-circle-sm mb-2">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <p class="mb-0 font-weight-semibold">Facebook</p>
                        <h4 class="m-0 font-weight-bold">25k <span class="text-muted font-12 font-weight-normal">Followers</span></h4>
                    </div><!--end col-->
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-info btn-icon-circle-sm mb-2">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <p class="mb-0 font-weight-semibold">Twitter</p>
                        <h4 class="m-0 font-weight-bold">58k <span class="text-muted font-12 font-weight-normal">Followers</span></h4>
                    </div><!--end col-->
                </div><!--end row-->                                               
            </div><!--end col-->
        </div>

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
