@extends('admin.layout.admin')

@section('title','Client')

@section('client','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">{{$client->name}}</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('client.index')}}">Clients</a></li>

                        </ol>
                    </div><!--end col-->

                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="card">
        <div class="card-body">
            <div class="media mb-3">
                <div class="avatar-box thumb-lg align-self-center me-2">
                    <span class="avatar-title bg-soft-pink rounded-circle">{{substr($client->name, 0, 1)}}</span>
                </div>
                <div class="media-body align-self-center text-truncate ml-3">
                    <h4 class="m-0 font-weight-semibold text-dark font-15"><b>{{$client->name}}</b></h4>
                    <p class="text-muted  mb-0 font-13">
                        <span class="text-dark">Project(s) :
                            @foreach($client->projects as $project)
                                <span class="badge badge-soft-info"><a href="{{route('project.show',$project->id)}}">{{$project->name}}</a></span>
                            @endforeach
                        </span>
                    </p>
                </div><!--end media-body-->
            </div>
            <hr class="hr-dashed">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="font-weight-semibold m-0">Onboard : <span class="text-muted font-weight-normal">{{$client->created_at->diffForHumans()}}</span></h6>
                {{-- <h6 class="font-weight-semibold m-0">Deadline : <span class="text-muted font-weight-normal"> 28 Fab 2021</span></h6> --}}
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <h5 class="font-16 m-0 font-weight-bold">$56,800</h5>
                        <p class="mb-0 font-weight-semibold">Total Budget</p>
                    </div>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <h5 class="font-14 m-0 font-weight-bold">$22,100 <span class="font-12 text-muted font-weight-normal">Used Budget</span></h5>
                </div><!--end col-->
            </div><!--end row-->

            <div>
                <p class="text-muted mt-2 mb-1">There are many variations of passages of Lorem Ipsum available,
                    but the majority have suffered alteration in some form.
                </p>


            </div><!--end task-box-->
        </div><!--end card-body-->
    </div><!--end card-->

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
