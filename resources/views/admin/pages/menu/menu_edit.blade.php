@extends('admin.layout.admin')

@section('title','Menu')

@section('menu','active')

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
                            <h4 class="page-title">Menus</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('menu.index')}}">Menus</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="col-md-4">
            <form action="{{route('menu.update', $menu->id)}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Menu Name</label>
                        <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="{{$menu->name}}{{old('name')}}">
                        <small id="emailHelp" class="form-text text-muted">Name of the menu</small>
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update Menu</button>

                </div><!--end modal-body-->

            </form>
        </div>


    </div>
@endsection


@section('scripts')


@endsection
