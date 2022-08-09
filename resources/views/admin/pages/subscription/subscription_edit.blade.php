@extends('admin.layout.admin')

@section('title','Edit Subscription')

@section('subscription','active')


@section('style')

@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Subscriptions</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Subscriptions</li>
                            </ol>
                        </div><!--end col-->

                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->



        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('subscription.update',$subscription->id)}}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$subscription->email}}{{old('email')}}">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch switch-secondary">
                                <input type="checkbox" class="custom-control-input" id="customSwitchSecondary" name="status" @if($subscription->status == true) checked  @endif>
                                <label class="custom-control-label" for="customSwitchSecondary">Status</label>
                            </div>
                        </div>
                        <a href="{{route('subscription.index')}}" class="btn btn-danger btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm">Update Subscription</button>

                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->



    </div>
@endsection



@section('scripts')



    <script>

        $(function(){
            'use strict'


        });

    </script>

@endsection
