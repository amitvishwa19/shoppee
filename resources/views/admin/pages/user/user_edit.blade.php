@extends('admin.layout.admin')

@section('title','Edit  User')

@section('dashboard','active')


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
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!--end col-->

                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper card p-2">
        <h5>
            Edit User
        </h5>
        <form role="form" method="post" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}

            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="firstName"  value="{{$user->firstName}}{{old('firstName')}}">
                <div class="error">{{$errors->first('firstName')}}</div>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastName" value="{{$user->lastName}}{{old('lastName')}}">
                <div class="error">{{$errors->first('lastName')}}</div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}{{old('email')}}" disabled>
                <div class="error">{{$errors->first('email')}}</div>
            </div>

            <div class="form-group">
                <label><b>Roles</b></label>
                <div class="row pl-2 pr-2">
                    @foreach($roles as $role)
                        <div class="col-3">
                            <input type="checkbox" value="{{$role->id}}" name="roles[]"
                            @foreach($user->roles as $rl)
                                @if($rl->id == $role->id)
                                    checked
                                @endif
                            @endforeach
                            >
                            <label for="roles" class="mg-l-5">{{$role->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="radio radio-success">
                <input type="radio" @if($user->status == 1)  checked  @endif value="1" name="status" id="yes">
                <label for="yes">Active</label>
                <input type="radio" @if($user->status == 0)  checked  @endif  value="0" name="status" id="no">
                <label for="no">InActive</label>
            </div>


            <div class="checkbox check-success  mt-2">
                <input type="checkbox" checked="checked" value="1" id="checkbox2">
                <label for="checkbox2">Notify User</label>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Update User</button>
                <a href="{{route('user.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>
    </div>
@endsection



@section('scripts')
@endsection
