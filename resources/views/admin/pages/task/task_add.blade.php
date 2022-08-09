@extends('admin.layout.admin')

@section('title','Task')

@section('task','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Tasks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('task.index')}}">Tasks</a></li>
                            <li class="breadcrumb-item active">Add Task</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper  p-2">

        <form role="form" method="post" action="{{route('task.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label><b>Task Title</b></label>
                <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label><b>Task Description</b></label>
                <textarea name="description" id="" class="form-control" cols="30" rows="3">{{old('description')}}</textarea>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <label for="pro-end-date"><b>Priority</b></label>
                    <select class="form-control" name="priority">
                        <option value="low" {{ (old("priority") == "low" ? "selected":"") }}>Low</option>
                        <option value="high" {{ (old("priority") == "high" ? "selected":"") }}>High</option>
                        <option value="medium" {{ (old("priority") == "medium" ? "selected":"") }}>Medium</option>  
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="pro-start-date"><b>Start Date</b></label>
                    <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}">
                </div>

                <div class="col-md-2">
                    <label for="pro-start-date"><b>Due Date</b></label>
                    <input type="date" class="form-control" name="due_date" value="{{old('due_date')}}">
                </div>

              

                <div class="col-lg-2">
                    <label for="pro-end-date"><b>Status</b></label>
                    <select class="form-control" name="status">
                        <option value="planning" {{ (old("status") == "planning" ? "selected":"") }}>Planning</option>
                        <option value="wip" {{ (old("status") == "wip" ? "selected":"") }}>WIP</option>
                        <option value="completed" {{ (old("status") == "completed" ? "selected":"") }}>Completed</option>
                    </select>
                </div>


            </div>

            <div class="form-group mt-5">
                <label><h4><b>Task Milestones</b></h4></label>

                <div class="form-group">
                    <table class="table table-bordered mb-0 table-centered">
                        <thead>
                            <tr>
                                <th style="width:40%"><label for=""><b>Title</b></label></th>
                                <th style="width:40%"><label for=""><b>Description</b></label></th>
                                <th style="width:8%"><label for=""><b>Status</b></label></th>
                                <th style="width:2%"><a href="javascript:void(0)" class="addrow"> <i class="fas fa-plus"></i>  </a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="t_title[]" value="{{old('task_title')}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="t_description[]" value="{{old('task_description')}}">
                                </td>
                                <td>
                                    <select class="form-control" name="t_status[]">
                                        <option value="0" {{ (old("task_item_status") == 0? "selected":"") }}>Pending</option>
                                        <option value="1" {{ (old("task_item_status") == 1 ? "selected":"") }}>Completed</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="deleterow"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="form-group mt-4">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Task</button>
                <a href="{{route('task.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')
@endsection


@section('scripts')

    <script>
        $('thead').on('click','.addrow',function(){
            //console.log('Add Item Clicked');
            var tr = "<tr>"+
                        "<td><input type='text' class='form-control' name='t_title[]' value=''></td>"+
                        "<td><input type='text' class='form-control' name='t_description[]' value=''></td>"+
                        "<td>"+
                            "<select class='form-control' name='t_status[]'>"+
                                "<option value='0'>Pending</option>"+
                                "<option value='1' >Completed</option>"+
                            "</select>"+
                        "</td>"+
                        "<td><a href='javascript:void(0)' class='btn btn-danger waves-effect waves-light btn-sm deleterow'>Delete</a></td>"+
                    "</tr>"

            $('tbody').append(tr);
        });

        $('tbody').on('click','.deleterow',function(){
            $(this).parent().parent().remove();
            //console.log('deleterow clicked');
        });
    </script>

@endsection
