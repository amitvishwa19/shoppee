@extends('admin.layout.admin')

@section('title','Edit Permissions')

@section('posts','active')


@section('style')

@endsection



@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Permissions</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('permission.index')}}">Permissions</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!--end col-->

                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->


    <div class="wrapper card p-2">
        <h5>
            Add New Permission
        </h5>
        <form role="form" method="post" action="{{route('permission.update',$permission->id)}}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <label>Permission name</label>
                <input type="text" class="form-control" name="name"  value="{{$permission->name}}{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label>Permission Description</label>
                <textarea class="form-control" name="description" id="" cols="30" rows="5">{{$permission->description}}{{old('description')}}</textarea>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Update Permission</button>
                <a href="{{route('permission.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>

    </div>
@endsection



@section('scripts')

@endsection
