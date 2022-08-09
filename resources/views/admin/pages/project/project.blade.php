@extends('admin.layout.admin')

@section('title','Project Dashboard')

@section('project','active')


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
                            <h4 class="page-title">Projects</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Projects</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#project_display" data-toggle="modal" class="btn btn-info waves-effect waves-light btn-sm" >
                                All Projects
                            </a>
                            <a href="{{route('project.create')}}" class="btn btn-info waves-effect waves-light btn-sm" >
                                Add Project
                            </a>
                        </div>
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        {{-- project metrix info --}}
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Projects</p>
                                <h3 class="m-0">{{$projectCount}}</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i></span>{{$projectCompleted}} Project Complete</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers align-self-center text-muted icon-md"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Total Hours</p>
                                <h3 class="m-0">801:30</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="text-muted">01:33</span> /
                                    <span class="text-muted">9:30</span>  Duration</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-self-center text-muted icon-md"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Income</p>
                                <h3 class="m-0">{{$totalbudget}}</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="text-dark">{{$totalbudget}}</span> Total Income</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-self-center text-muted icon-md"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div>
        {{-- project metrix info --}}

        {{-- All project table --}}
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width:15%">Project Name</th>
                                        <th style="width:20%">Requirements</th>
                                        <th style="width:10%">Start Date</th>
                                        <th style="width:10%">End Date</th>
                                        <th style="width:10%">Budget</th>
                                        <th style="width:10%">Payment Received</th>
                                        <th style="width:10%">Priority</th>
                                        <th style="width:10%">Status</th>
                                        <th style="width:5%">Actions</th>
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
        {{-- All project table --}}

        {{-- Projects display grid page --}}
        <div class="modal fade" id="project_display" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Project Grid</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">

                        <div class="row">

                        @foreach($projects as $project)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media mb-3">
                                            <img src="assets/images/widgets/project2.jpg" alt="" class="thumb-md rounded-circle">
                                            <div class="media-body align-self-center text-truncate ml-3">
                                                <h4 class="m-0 font-weight-semibold text-dark font-15">{{$project->name}}</h4>
                                                <p class="text-muted  mb-0 font-13"><span class="text-dark">Client : </span>{{$project->client->name}}</p>
                                            </div><!--end media-body-->
                                        </div>
                                        <hr class="hr-dashed">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h6 class="font-weight-semibold m-0">Start : <span class="text-muted font-weight-normal"> {{$project->start_date}}</span></h6>
                                            <h6 class="font-weight-semibold m-0">Deadline : <span class="text-muted font-weight-normal"> {{$project->end_date}}</span></h6>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <h5 class="font-16 m-0 font-weight-bold">₹ {{$project->rate}}</h5>
                                                    <p class="mb-0 font-weight-semibold">Total Budget</p>
                                                </div>
                                            </div><!--end col--> 
                                            <div class="col-auto align-self-center">
                                                <h5 class="font-14 m-0 font-weight-bold">$22,100 <span class="font-12 text-muted font-weight-normal">Used Budget</span></h5>
                                            </div><!--end col-->
                                        </div><!--end row-->

                                        <div>
                                            <p class="text-muted mt-2 mb-1">{{substr($project->description,0,200)}}
                                            </p>
                                            <!-- <div class="d-flex justify-content-between">
                                                <h6 class="font-weight-semibold">All Hours : <span class="text-muted font-weight-normal"> 530 / 281:30</span></h6>
                                                <h6 class="font-weight-semibold">Today : <span class="text-muted font-weight-normal"> 2:45</span><span class="badge badge-soft-pink font-weight-semibold ml-2"><i class="far fa-fw fa-clock"></i> 35 days left</span></h6>
                                            </div> -->
                                            <p class="text-muted text-right mb-1 mt-4">{{$project->completion_status}}% Complete</p>
                                            <div class="progress mb-4 " style="height: 4px;">
                                                <div class="progress-bar bg-purple" role="progressbar" style="width: {{$project->completion_status}}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <!-- <div class="img-group">
                                                    <a class="user-avatar user-avatar-group" href="#">
                                                        <img src="assets/images/users/user-6.jpg" alt="user" class="rounded-circle thumb-xxs">
                                                    </a>
                                                    <a class="user-avatar user-avatar-group" href="#">
                                                        <img src="assets/images/users/user-2.jpg" alt="user" class="rounded-circle thumb-xxs">
                                                    </a>
                                                    <a class="user-avatar user-avatar-group" href="#">
                                                        <img src="assets/images/users/user-3.jpg" alt="user" class="rounded-circle thumb-xxs">
                                                    </a>
                                                    <a class="user-avatar user-avatar-group" href="#">
                                                        <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle thumb-xxs">
                                                    </a>
                                                    <a href="#" class="avatar-box thumb-xxs align-self-center">
                                                        <span class="avatar-title bg-soft-info rounded-circle font-13 font-weight-normal">+6</span>
                                                    </a>
                                                </div> -->
                                                <!-- <ul class="list-inline mb-0 align-self-center">
                                                    <li class="list-item d-inline-block mr-2">
                                                        <a class="" href="#">
                                                            <i class="mdi mdi-format-list-bulleted text-success font-15"></i>
                                                            <span class="text-muted font-weight-bold">15/100</span>
                                                        </a>
                                                    </li>
                                                    <li class="list-item d-inline-block">
                                                        <a class="" href="#">
                                                            <i class="mdi mdi-comment-outline text-primary font-15"></i>
                                                            <span class="text-muted font-weight-bold">3</span>
                                                        </a>
                                                    </li>
                                                    <li class="list-item d-inline-block">
                                                        <a class="ml-2" href="#">
                                                            <i class="mdi mdi-pencil-outline text-muted font-18"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-item d-inline-block">
                                                        <a class="" href="#">
                                                            <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                        </a>
                                                    </li>
                                                </ul> -->
                                            </div>
                                        </div><!--end task-box-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div><!--end col-->
                        @endforeach

                        </div>

                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->
        {{-- Projects display grid page --}}

        {{-- Add Project Modal --}}
        <div class="modal fade" id="new_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Add Project</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form>
                                            <div class="form-group">
                                                <label for="projectName">Project Name :</label>
                                                <input type="text" class="form-control" id="projectName" aria-describedby="emailHelp" placeholder="Enter project name">
                                            </div><!--end form-group-->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3 col-6 mb-2 mb-lg-0">
                                                        <label for="pro-start-date">Project Start Date</label>
                                                        <input type="text" class="form-control" id="pro-start-date" placeholder="Enter start date">
                                                    </div><!--end col-->
                                                    <div class="col-lg-3 col-6 mb-2 mb-lg-0">
                                                        <label for="pro-end-date">Project End Date</label>
                                                        <input type="text" class="form-control" id="pro-end-date" placeholder="Enter end date">
                                                    </div><!--end col-->
                                                    <div class="col-lg-3 col-6">
                                                        <label for="pro-rate">Rate</label>
                                                        <input type="text" class="form-control" id="pro-rate" placeholder="Enter rate">
                                                    </div><!--end col-->
                                                    <div class="col-lg-3 col-6">
                                                        <label for="pro-end-date">Price Type</label>
                                                        <select class="form-control">
                                                            <option>Hourly</option>
                                                            <option>Daily</option>
                                                            <option>Fix</option>
                                                        </select>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end form-group-->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-2 mb-lg-0">
                                                        <label for="pro-end-date">Required</label>
                                                        <select class="form-control">
                                                            <option>--Select--</option>
                                                            <option>UI/UX Design</option>
                                                            <option>Payment System </option>
                                                            <option>Android 10</option>
                                                        </select>
                                                    </div><!--end col-->
                                                    <div class="col-lg-3 col-6">
                                                        <label for="pro-end-date">Invoice Time</label>
                                                        <select class="form-control">
                                                            <option>30 Day</option>
                                                            <option>3 Month</option>
                                                            <option>1 Year</option>
                                                        </select>
                                                    </div><!--end col-->
                                                    <div class="col-lg-3 col-6">
                                                        <label for="pro-end-date">Priority</label>
                                                        <select class="form-control">
                                                            <option>-- select --</option>
                                                            <option>High</option>
                                                            <option>Medium</option>
                                                            <option>Low</option>
                                                        </select>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end form-group-->
                                            <div class="form-group">
                                                <label for="pro-message">Message</label>
                                                <textarea class="form-control" rows="5" id="pro-message" placeholder="writing here.."></textarea>
                                            </div><!--end form-group-->

                                            <button type="submit" class="btn btn-soft-primary btn-sm">Create project</button>
                                            <button type="button" class="btn btn-soft-danger btn-sm">Cancel</button>
                                        </form>  <!--end form-->
                                    </div><!--end col-->

                                </div><!--end row-->
                            </div><!--end col-->
                        </div>

                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->
        {{-- Add Project Modal --}}

    </div>
@endsection



@section('scripts')

    <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    
    {{-- <script src="{{asset('public/admin/plugins/apex-charts/apexcharts.min.js')}}"></script> --}}

    <script>

        $(function(){
            'use strict'

            //Datatable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('project.index') !!}',
                columns:[
                    { data: 'name', name: 'name'},
                    { data: 'requirement', name: 'requirement'},
                    { data: 'start_date', name: 'start_date'},
                    { data: 'end_date', name: 'end_date'},
                    { data: 'rate', name: 'rate'},
                    { data: 'payment_received', name: 'payment_received'},
                    { data: 'priority', name: 'priority'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action' },
                ]
            });


            //Action Delete function
            $(document).on('click','.delete',function(){
                var id =  $(this).attr('id');
                swalWithBootstrapButtons({
                    title: "Delete Selected Project?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                    $.ajax({
                        url: "project/"+id,
                        type:"post",
                        data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                        success: function(result){
                            location.reload();
                            toast({
                                type: "success",
                                title: "Project Deleted Successfully"
                            });
                        }
                    });
                    }
                });
            });

        });



    </script>

@endsection
