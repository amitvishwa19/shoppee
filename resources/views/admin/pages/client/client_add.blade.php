@extends('admin.layout.admin')

@section('title','Client')

@section('client','active')

@section('style')
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Clients</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('client.index')}}">Clients</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!--end col-->

                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper  p-2">


        <form role="form" method="post" action="{{route('client.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group  col-md-6">
                    <label><b>Client name</b></label>
                    <input type="text" class="form-control" name="name"  value="{{old('name')}}">
                    <div class="error">{{$errors->first('name')}}</div>
                </div>
                <div class="form-group col-md-6">
                    <label><b>Client Email</b></label>
                    <input type="email" class="form-control" name="email"  value="{{old('email')}}">
                </div>
                <div class="form-group  col-md-6">
                    <label><b>Primary Contact</b></label>
                    <input type="text" class="form-control" name="primary_contact"  value="{{old('primary_contact')}}">
                </div>
                <div class="form-group  col-md-6">
                    <label><b>Secondary Contact</b></label>
                    <input type="text" class="form-control" name="secondary_contact"  value="{{old('secondary_contact')}}">
                </div>
            </div>


            <div class="form-group">
                <label><b>Notes</b></label>
                <textarea class="form-control" name="description" id="" cols="30" rows="2" >{{old('description')}}</textarea>
            </div>

            <!-- <div class="form-group">
                <label><b>Client Type</b></label>
                <div class="checkbox checkbox-info">
                    <input id="checkbox4" type="checkbox" name="type" value="premium">
                    <label for="checkbox4">
                        Premium
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label><b>Client Status</b></label>
                <div class="radio radio-info">
                    <input type="radio" name="status" id="radio4" value="1" checked>
                    <label for="radio4">
                        Active
                    </label>
                </div>
                <div class="radio radio-info">
                    <input type="radio" name="status" id="radio5" value="0">
                    <label for="radio5">
                        InActive
                    </label>
                </div>
            </div> -->

            <div class="form-group mt-3">
                <label><h5><b>Additional Inputs</b></h5></label><span class="ml-4"></span>

                <div class="form-group">
                    <table class="table table-bordered mb-0 table-centered">
                        <thead>
                            <tr>
                                <th style="width:49%"><label for=""><b>Key</b></label></th>
                                <th style="width:49%"><label for=""><b>Value</b></label></th>
                                <th style="width:3%"><a href="javascript:void(0)" class="addrow"> <i class="fas fa-plus"></i>  </a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="key[]" value="{{old('kay')}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="value[]" value="{{old('value')}}">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="deleterow"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="form-group mt-3">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Client</button>
                <a href="{{route('client.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')
@endsection


@section('scripts')

    <script>
        $('thead').on('click','.addrow',function(){
            //console.log('Add Item Clicked');
            var tr = "<tr>"+
                        "<td><input type='text' class='form-control form-control-sm' name='key[]' value=''></td>"+
                        "<td><input type='text' class='form-control form-control-sm' name='value[]' value=''></td>"+
                        "<td><a href='javascript:void(0)' class='deleterow'><i class='fas fa-trash-alt'></i></a></td>"+
                    "</tr>"

            $('tbody').append(tr);
        });

        $('tbody').on('click','.deleterow',function(){
            $(this).parent().parent().remove();
            //console.log('deleterow clicked');
        });
    </script>

@endsection
