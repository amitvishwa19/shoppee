@extends('admin.layout.admin')

@section('title','Role')

@section('role','active')

@section('style')
@endsection


@section('content')

    <div class="wrapper card p-2">
        <h5>
            Add New Role
        </h5>

        <form role="form" method="post" action="{{route('role.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Role name</label>
                <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label>Role Description</label>
                <textarea name="description" class="form-control" cols="30" rows="5">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="row p-1">
                    @foreach($permissions as $permission)
                        <div class="col-4">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label for="checkbox" class="mg-l-5">{{$permission->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary btn-sm">Add Role</button>
                <a href="{{route('role.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('javascript')


@endsection
