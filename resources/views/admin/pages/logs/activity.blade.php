@extends('admin.layout.admin')

@section('title','Activity Log')

@section('activity_log','active')


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
                            <h4 class="page-title">Activity Logs</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Activity Logs</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i>
                            </a>

                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class=" mb-2">
            {{-- <a href="javascript:void(0)" class="wp-title mr-2" id="select_all">Select All</a>
            <a href="javascript:void(0)" class="wp-title mr-2" id="deselect_all">Deselect All</a> --}}
            <a href="javascript:void(0)" class="wp-title mr-2" id="delete_all">Delete All</a>
         </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="bulk_delete"></th>
                                        <th>Log Name</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Actions</th>
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

    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('activity.index') !!}',
                columns:[
                    { data: 'checkbox', name: 'checkbox',orderable:false, searchable: false},
                    { data: 'log_name', name: 'log_name'},
                    { data: 'description', name: 'description'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable:false, searchable: false },
                ]
            });

        });


        //Action Delete function
        $(document).on('click','.delete',function(){
            var id =  $(this).attr('id');
            swalWithBootstrapButtons({
                title: "Delete Selected Activity?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                $.ajax({
                    url: "activity/"+id,
                    type:"post",
                    data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                    success: function(result){
                        location.reload();
                        toast({
                            type: "success",
                            title: "Activity Deleted Successfully"
                        });
                    }
                });
                }
            });
        });

        $(document).on('click', '#select_all', function(){
            var checkboxes = document.getElementsByName('id');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true
                }
            }
        });

        $(document).on('click', '#bulk_delete', function(){
            var checkboxes = document.getElementsByName('id');

            if($("#bulk_delete").is(':checked')){
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = true
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false
                    }
                }
            }

        });

        $(document).on('click', '#deselect_all', function(){
            var checkboxes = document.getElementsByName('id');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false
                }
            }
        });

        $(document).on('click', '#delete_all', function(){
            var id = [];
            $('.checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0){
                swalWithBootstrapButtons({
                title: "Delete Selected Activity Log?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "activity/"+id,
                            type:"post",
                            data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                            success: function(result){

                                console.log(result);
                                location.reload();
                                toast({
                                    type: "success",
                                    title: "Activity Log Deleted Successfully"
                                });
                            }
                        });
                    }
                });
            }else{
                toast({
                    type: "warning",
                    title: "Please select atleast one item to delete !"
                });
            }

        });


    </script>

@endsection
