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
                        <h4 class="page-title">Roles</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->


    <div class="wrapper card p-2">
        <h5>
            Edit Role
        </h5>
        <form role="form" method="post" action="{{route('role.update',$role->id)}}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}

            <div class="form-group">
                <label>Role Name</label>
                <input type="text" class="form-control" name="name"  value="{{$role->name}}{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label>Role Description</label>
                <textarea class="form-control" name="description" cols="30" rows="5">{{$role->description}}{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="row pl-2 pr-2">
                    @foreach($permissions as $permission)
                        <div class="col-4">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                            @foreach($role->permissions as $perm)
                                @if($perm->id == $permission->id)
                                    checked
                                @endif
                            @endforeach
                            >
                            <label for="checkbox" class="mg-l-5">{{$permission->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>



            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Update Role</button>
                <a href="{{route('role.index')}}" class="btn btn-info btn-sm">Cancel</a>
            </div>

        </form>
    </div>
@endsection



@section('scripts')
@endsection
