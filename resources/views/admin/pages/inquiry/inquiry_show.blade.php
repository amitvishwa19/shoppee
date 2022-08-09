@extends('admin.layout.admin')

@section('title','Inquiry')

@section('inquiry','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Inquirys</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('inquiry.index')}}">Inquiries</a></li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">

        <div class="card">
            <div class="card-body">
                <div class="media mb-3">
                    <div class="media-body align-self-center text-truncate">
                        <h4 class="m-0 font-weight-semibold text-dark font-15">{{$inquiry->subject}}</h4>
                        <p class="text-muted  mb-0 font-13"><span class="text-dark">By : </span>{{$inquiry->name}}</p>
                        <p class="text-muted  mb-0 font-13"><span class="text-dark"></span>{{$inquiry->email}}({{$inquiry->phone}})</p>
                    </div><!--end media-body-->
                </div>
                <hr class="hr-dashed">
                <div>
                    <p class="text-muted mt-2 mb-1">{{$inquiry->message}}</p>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-semibold">
                           <span class="badge badge-soft-pink font-weight-semibold ml-2"><i class="far fa-fw fa-clock"></i>{{$inquiry->created_at->diffForHumans()}}</span>
                        </h6>
                    </div>

                </div><!--end task-box-->

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{route('inquiry.update',$inquiry->id)}}" method="POST">
                @csrf
                {{method_field('PUT')}}

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="email" value="{{$inquiry->email}}" >
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Response</b></label>
                        <textarea class="form-control" placeholder="" name="response" rows="10"></textarea>
                    </div>






                    <a href="{{route('inquiry.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-info waves-effect waves-light btn-sm">Send Response</button>

            </form>

        </div>
    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
