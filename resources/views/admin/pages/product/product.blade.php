@extends('admin.layout.admin')

@section('title','Product')

@section('product','active')


@section('style')
    {{-- Datatable --}}
    <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <h4 class="page-title">Products</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Products</li>
                                
                            </ol>
                            <select name="cats" id="">
                                <option value="hot"><a href="">Hot</a></option>
                                <option value="fruit"><a href="">Fruit</a></option>
                            </select>
                            <a href="{{route('product.index',request()->get('cats'))}}">Filter</a>
                        </div><!--end col-->
                        
                        <div class="col-auto align-self-center">
                            <!-- <a href="#post_display" class="btn btn-info waves-effect waves-light btn-sm" data-toggle="modal" >Posts Grid</a> -->
                            <a href="{{route('product.create')}}" class="btn btn-info waves-effect waves-light btn-sm" >Add Product</a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                    <th style="width:5%">Feature Image</th>
                                        <th style="">Title</th>
                                        <th style="">Description</th>
                                        <th style="width:15%">Categories</th>
                                        <th style="">Price</th>
                                        <th style="">Discount</th>
                                        <th style="">Quantity</th>
                                        <th style="">Status</th>
                                        <th style="width:10%">Actions</th>

                                    </tr>
                                </thead>


                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('public/admin/assets/pages/jquery.datatable.init.js')}}"></script> --}}
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            //Datatable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                ajax: '{!! route('product.index') !!}',
                columns:[
                    { data: 'image', name: 'image'},
                    { data: 'title', name: 'title'},
                    { data: 'description', name: 'description'},
                    { data: 'categories', name: 'categories'},
                    { data: 'price', name: 'price'},
                    { data: 'discount', name: 'discount'},
                    { data: 'quantity', name: 'quantity'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action' },
                ]
            });


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
