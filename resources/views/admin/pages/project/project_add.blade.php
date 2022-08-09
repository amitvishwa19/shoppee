@extends('admin.layout.admin')

@section('title','Project')

@section('project','active')

@section('style')
    <link href="{{asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Create Project</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('project.index')}}">Projects</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="#requirements" data-toggle="modal" class="btn btn-info waves-effect waves-light btn-sm" >
                            Add Requirement
                        </a>
                        <a href="#payments" data-toggle="modal" class="btn btn-info waves-effect waves-light btn-sm" >
                            Add Payment
                        </a>
                    </div>
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->


    <div class="row " >
        <div class="col-12">
            <div class="col-lg-12">
                <form action="{{route('project.store')}}" method="POST" autocomplete="off" class="mb-5">
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="pro-end-date"><b>Client</b></label>
                                <select class="form-control" name="client">
                                    <option value="">-Select Client-</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}" {{ (old("price_type") == "fix" ? "selected":"") }}>{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="col-md-3">
                                <label for="projectName"><b>Project Name</b></label>
                                <input type="text" class="form-control" name="name"  placeholder="Project name" value="{{old("name")}}">
                            </div>
                            
                            <div class="col-md-3">
                                <label for="pro-start-date"><b>Start Date</b></label>
                                <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" placeholder="dd-mm-yyyy">
                            </div>
                            <div class="col-md-3">
                                <label for="pro-start-date"><b>Deadline</b></label>
                                <input type="date" class="form-control" name="end_date" value="{{old('end_date')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                        
                            <div class="col-md-6">
                                <label for="pro-message"><b>Description</b></label>
                                <textarea class="form-control" rows="6" name="description"  placeholder="Project Description">{{old("description")}}</textarea>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <label for="pro-message"><b>Notes</b></label>
                                <textarea class="form-control" rows="6" id="pro-message"  placeholder="Additional Notes"></textarea>
                            </div><!--end form-group-->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-2">
                                <label for="pro-rate"><b>Project Budget (INR)</b></label>
                                <input type="number" class="form-control" name="rate" placeholder="Enter budget" value="{{old("rate")}}">
                            </div><!--end col-->

                            <div class="col-md-2">
                                <label for="pro-end-date"><b>Price Type</b></label>
                                <select class="form-control" name="price_type">
                                    <option value="fix" {{ (old("price_type") == "fix" ? "selected":"") }}>Fix</option>
                                    <option value="hourly" {{ (old("price_type") == "hourly" ? "selected":"") }}>Hourly</option>
                                    <option value="daily" {{ (old("price_type") == "daily" ? "selected":"") }}>Daily</option>
                                </select>
                            </div><!--end col-->
                            <div class="col-md-2">
                                <label for="pro-end-date"><b>Priority</b></label>
                                <select class="form-control" name="priority">
                                    <option value="high" {{ (old("priority") == "high" ? "selected":"") }}>High</option>
                                    <option value="medium" {{ (old("priority") == "medium" ? "selected":"") }}>Medium</option>
                                    <option value="low" {{ (old("priority") == "low" ? "selected":"") }}>Low</option>
                                </select>
                            </div><!--end col-->
                            <div class="col-md-2">
                                <label for="pro-end-date"><b>Payment</b></label>
                                <select class="form-control" name="payment">
                                    <option value="pending" {{ (old("payment") == "pending" ? "selected":"") }}>Pending</option>
                                    <option value="advance" {{ (old("payment") == "advance" ? "selected":"") }}>Advance</option>
                                    <option value="completed" {{ (old("payment") == "completed" ? "selected":"") }}>Completed</option>
                                </select>
                            </div><!--end col-->
                            

                            <div class="col-md-2">
                                <label for="pro-end-date"><b>Status</b></label>
                                <select class="form-control" name="status">
                                    <option value="planning" {{ (old("status") == "planning" ? "selected":"") }}>Planning</option>
                                    <option value="started" {{ (old("status") == "started" ? "selected":"") }}>Started</option>
                                    <option value="wip" {{ (old("status") == "wip" ? "selected":"") }}>WIP</option>
                                    <option value="completed" {{ (old("status") == "completed" ? "selected":"") }}>Completed</option>
                                </select>
                            </div><!--end col-->

                            <div class="col-md-2">
                                <label for="pro-rate"><b>Completed(%)</b></label>
                                <input type="number" class="form-control" name="completion_status" placeholder="0" value="{{old("completion_status")}}0">
                            </div><!--end col-->


                        </div><!--end row-->
                    </div><!--end form-group-->

                    {{-- Add Requirement Modal --}}
                    <div class="modal fade" id="requirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Project Requirements</b></h6>
                                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-times"></i></span>
                                    </button>
                                </div><!--end modal-header-->
                                <div class="modal-body">

                                    <div class="form-group">
                                     
                                        <div class="form-group">
                                            <table class="table table-bordered mb-0 table-centered">
                                                <thead>
                                                    <tr>
                                                        <th style="width:70%"><label for=""><b>Requirements</b></label></th>
                                                        <th style="width:20%"><label for=""><b>Status</b></label></th>
                                                        <th style="width:2%"><a href="javascript:void(0)" class="addrow"> <i class="fas fa-plus"></i> </a></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="reqmnt">
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" name="r_requirement[]" value="{{old('requirement')}}">
                                                            <input type='hidden'  name='p_id[]' value=''>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="r_status[]">
                                                                <option value="0" {{ (old("task_item_status") == 0? "selected":"") }}>Pending</option>
                                                                <option value="1" {{ (old("task_item_status") == 1 ? "selected":"") }}>Completed</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)" class=" deleterow"><i class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    

                                </div><!--end modal-body-->

                            </div><!--end modal-content-->
                        </div>
                    </div><!--end modal-->
                    {{-- Add Requirement Modal --}}

                    {{-- Add Payment Model--}}
                    <div class="modal fade" id="payments" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Project Payments</b></h6>
                                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-times"></i></span>
                                    </button>
                                </div><!--end modal-header-->
                                <div class="modal-body">

                                    <div class="form-group">
                                        
                                        <div class="form-group">
                                            <table class="table table-bordered mb-0 table-centered">
                                                <thead>
                                                    <tr>
                                                        <th style="width:49%"><label for=""><b>Date</b></label></th>
                                                        <th style="width:49%"><label for=""><b>Amount</b></label></th>
                                                        <th style="width:2%"><a href="javascript:void(0)" class="addpayment"> <i class="fas fa-plus"></i> </a></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pymnt">
                                                    <tr>
                                                        <td>
                                                            <input type="date" class="form-control" name="p_date[]" value="{{old('p_date')}}">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="p_amount[]" value="{{old('p_amount')}}">
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)" class=" deletepayment"><i class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    

                                </div><!--end modal-body-->

                            </div><!--end modal-content-->
                        </div>
                    </div><!--end modal-->
                    {{-- Add Payment Modal --}}
                    

                    

                    <button class="btn btn-info waves-effect waves-light btn-sm">Add Project</button>
                    <a href="{{route('project.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                </form>  <!--end form-->
            </div><!--end col-->
        </div><!--end col-->
    </div><!--end row-->


    


@endsection


@section('modal')



@endsection


@section('scripts')
    <script>    
        $('thead').on('click','.addrow',function(){
            //console.log('Add Item Clicked');
            var tr = "<tr>"+
                        "<td><input type='text' class='form-control form-control-sm' name='r_requirement[]' value=''><input type='hidden'  name='p_id[]' value=''></td>"+
                        "<td>"+
                            "<select class='form-control' name='r_status[]'>"+
                                "<option value='0'>Pending</option>"+
                                "<option value='1' >Completed</option>"+
                            "</select>"+
                        "</td>"+
                        "<td><a href='javascript:void(0)' class='deleterow'><i class='fas fa-trash-alt'></i></a></td>"+
                    "</tr>"

            $('#reqmnt').append(tr);
        });

        $('tbody').on('click','.deleterow',function(){
            $(this).parent().parent().remove();
            //console.log('deleterow clicked');
        });

        $('thead').on('click','.addpayment',function(){
            //console.log('Add Item Clicked');
            var tr = "<tr>"+
                        "<td><input type='date' class='form-control form-control-sm' name='p_date[]' value=''><input type='hidden'  name='pm_id[]' value=''></td></td>"+
                        "<td><input type='number' class='form-control form-control-sm' name='p_amount[]' value=''></td>"+
                        "<td><a href='javascript:void(0)' class='deleterow'><i class='fas fa-trash-alt'></i></a></td>"+
                    "</tr>"

            $('#pymnt').append(tr);
        });

        $('tbody').on('click','.deletepayment',function(){
            $(this).parent().parent().remove();
            //console.log('deleterow clicked');
        });

    </script>


@endsection
