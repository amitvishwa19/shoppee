@extends('admin.layout.admin')

@section('title','Add Permissions')

@section('posts','active')


@section('style')

@endsection



@section('content')
    <div class="wrapper card p-2">
        <h5>
            Add New Permission
        </h5>
        <form role="form" method="post" action="{{route('permission.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Permission name</label>
                <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label>Permission Description</label>
                <textarea class="form-control" name="description" id="" cols="30" rows="5">{{old('description')}}</textarea>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary btn-sm">Add Permission</button>
                <a href="{{route('permission.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>

    </div>
@endsection



@section('scripts')

@endsection
