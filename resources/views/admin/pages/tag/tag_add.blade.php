@extends('admin.layout.admin')

@section('title','Tag')

@section('tag','active')

@section('style')
@endsection


@section('content')

    <div class="wrapper card p-2">
        <h5>
            Add New Tag
        </h5>

        <form role="form" method="post" action="{{route('tag.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tag name</label>
                <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                <div class="error">{{$errors->first('name')}}</div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary btn-sm">Add Tag</button>
                <a href="{{route('tag.index')}}" class="btn btn-info btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')



@endsection


@section('scripts')


@endsection
