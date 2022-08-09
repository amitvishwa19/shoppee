@extends('admin.layout.admin')

@section('title','User')

@section('user','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Users</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('user.create')}}" class="btn btn-info waves-effect waves-light btn-sm"  >Add User</a>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">



        <form action="{{route('user.store')}}" method="POST" autocomplete="off">
            @csrf


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">First Name*</label>
                            <input type="text" class="form-control" name="firstname" aria-describedby="emailHelp" >
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Last Name*</label>
                            <input type="text" class="form-control" name="lastname" aria-describedby="emailHelp" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Email*</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" aria-describedby="emailHelp" autocomplete="off">

                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label><b>Roles</b></label>
                    <div class="row pl-2 pr-2">
                        @foreach($roles as $role)
                            <div class="col-3">
                                <input type="checkbox" value="{{$role->id}}" name="roles[]">
                                <label for="roles" class="mg-l-5">{{$role->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="radio radio-success">
                    <input type="radio"  name="status" value="1" id="yes">
                    <label for="yes">Active</label>
                    <input type="radio"  name="status" value="0" id="no">
                    <label for="no">InActive</label>
                </div>


                <div class="checkbox check-success  mt-2">
                    <input type="checkbox"  value="1" id="checkbox2">
                    <label for="checkbox2">Notify User</label>
                </div>


                <div class="form-group mt-3">
                    <button class="btn btn-info waves-effect waves-light btn-sm">Add User</button>
                    <a href="{{route('user.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                </div>



        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('javascript')


@endsection
