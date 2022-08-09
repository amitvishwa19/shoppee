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
                            <li class="breadcrumb-item active">{{$task->title}}</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="task-box">
                        <div class="task-priority-icon"><i class="fas fa-circle text-success"></i></div>
                        <p class="text-muted float-right">
                            <span class="text-muted mr-3">{{date('d-m-Y', strtotime($task->start_date))}}</span>

                            <span><i class="far fa-fw fa-clock"></i> {{\Carbon\Carbon::parse($task->due_date)->diffForHumans()}}</span>
                        </p>
                        <h5 class="mt-0">{{$task->title}}</h5>
                        <p class="text-muted mb-1">
                            {{$task->description}}
                        </p>
                        <p class="text-muted text-right mb-1">{{$task->progress}}% Complete</p>
                        <div class="progress mb-4" style="height: 4px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$task->progress}}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="img-group">
                                <span class="badge badge-success">{{$task->priority}}</span>
                                <span class="badge badge-success">{{$task->status}}</span>
                            </div>
                            <ul class="list-inline mb-0 align-self-center">
                                <li class="list-item d-inline-block">
                                    <a class="ml-2" href="{{route('task.edit',$task->id)}}">
                                        <i class="mdi mdi-pencil-outline text-muted font-18"></i>
                                    </a>
                                </li>
                                <li class="list-item d-inline-block">
                                    <a class="delete" href="javascript:void(0);">
                                        <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--end card-header-->

                @if($task->milestones->count() > 0)
                {{-- <div class="card-body">
                    <label for="pro-start-date"><b>Task Milestones</b></label>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled faq-qa">
                                @foreach($task->milestones as $items)
                                    <li class="mb-5 ">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="">{{$loop->iteration}}. {{$items->title}}</h6>
                                            <div><span class="badge badge-success">{{$items->status == true ? 'Completed' : 'Pending'}}</span></div>
                                        </div>
                                        <p class="font-14 text-muted ml-3">
                                            {{$items->description}}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> <!--end row-->
                </div><!--end card-body--> --}}
                <div class="card-body">
                    <div class="slimscroll activity-scroll">
                        <div class="activity">
                            @foreach($task->milestones as $items)

                                <div class="activity-info">
                                    <div class="icon-info-activity">
                                        <i class="las la-check-circle bg-soft-primary"></i>
                                    </div>
                                    <div class="activity-info-text">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="m-0 w-75">{{$items->title}}</h6>
                                            <span class="text-muted d-block">{{$items->created_at->diffForHumans()}}</span>
                                        </div>
                                        <p class="text-muted mt-3">{{$items->description}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--end activity-->
                    </div><!--end activity-scroll-->
                </div>
                @endif

            </div><!--end card-->
        </div><!--end col-->
    </div>

@endsection


@section('modal')



@endsection


@section('scripts')
<script>

    $(function(){
        'use strict'

        //Action Delete function
        $(document).on('click','.delete',function(){
            var id =  $(this).attr('id');
            swalWithBootstrapButtons({
                title: "Delete Selected Task?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                $.ajax({
                    url: "task/"+id,
                    type:"post",
                    data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                    success: function(result){
                        location.reload();
                        toast({
                            type: "success",
                            title: "Task Deleted Successfully"
                        });
                    }
                });
                }
            });
        });

    });

</script>

@endsection
