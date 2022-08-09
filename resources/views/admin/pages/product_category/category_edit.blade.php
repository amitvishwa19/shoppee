@extends('admin.layout.admin')

@section('title','Category')

@section('category','active')

@section('style')
    <link href="{{asset('public/admin/plugins/nestable/jquery.nestable.min.css')}}" rel="stylesheet" />
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Categories</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row pb-5">
        <div class="col-sm-4">

            <form method="post" action="{{route('product_category.update',$category->id)}}" enctype="multipart/form-data" class="mg-t-30">
                @csrf
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="exampleFormControlSelect1"><b>Parent Category</b></label>
                    <select class="form-control" name="parent">
                        <option value="">Select parent category</option>
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}"
                                @if($category->parent)
                                    @if($cat->id == $category->parent->id)
                                        selected="selected"
                                    @endif
                                @endif
                                >{{$cat->name}}

                                @foreach($cat->child as $c1)
                                    <option value="{{$c1->id}}"
                                        @if($category->parent)
                                            @if($c1->id == $category->parent->id)
                                                selected="selected"
                                            @endif
                                        @endif
                                        >{{$cat->name}} > {{$c1->name}}

                                        @foreach($c1->child as $c2)
                                            <option value="{{$c2->id}}"
                                                @if($category->parent)
                                                    @if($c2->id == $category->parent->id)
                                                        selected="selected"
                                                    @endif
                                                @endif
                                            >{{$cat->name}} > {{$c1->name}} > {{$c2->name}}
                                            </option>
                                        @endforeach
                                    </option>
                                @endforeach
                            </option>
                        @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted"><i>By Selecting this WebBlock Name will become category under select parent</i></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Category</b></label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}{{$category->name}}" required>
                    <small id="emailHelp" class="form-text text-muted"><i>The name is how it appears on your site</i>.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Add Class</b></label>
                    <input type="text" class="form-control" name="class" value="{{ old('class') }}{{$category->class}}">
                    <small id="emailHelp" class="form-text text-muted"><i>Additional Class</i>.</small>
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1"><b>Feature Image</b></label><br>
                    @if($category->feature_image)
                    <img src="{{$category->feature_image}}" alt="" class="img-thumbnail mb-1" width="100">
                    @endif
                    <br>
                    <input type="file" class="" name="feature_image" value="{{ old('feature_image') }}">
                    
                </div>

                <div class="checkbox form-group">
                    <input id="checkbox0" type="checkbox" name="favourite" {{$category->favourite == true ? "checked" : ""}}>
                    <label for="checkbox0">
                        <b>Favourite</b>
                    </label>
                </div>

                <div class="checkbox form-group">
                    <input id="checkbox1" type="checkbox" name="status" {{$category->status == true ? "checked" : ""}}>
                    <label for="checkbox1">
                        <b>Active</b>
                    </label>
                </div>

                <button class="btn btn-info waves-effect waves-light btn-sm">Update Category</button>
                <a href="{{route('product_category.index')}}" class="btn btn-secondary waves-effect waves-light btn-sm">Cancel</a>
            </form>
        </div>

        <div style="height: 20px;"></div>

        
    </div>
@endsection


@section('modal')



@endsection


@section('scripts')
    {{-- <script src="{{asset('public/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}

    <script src="{{asset('public/admin/plugins/nestable/jquery.nestable.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/pages/jquery.nastable.init.js')}}"></script>




  <script>
    $(function(){
      'use strict'
        //   $('.dd').nestable({
        //         onDragStart: function(l,e){
        //             //l is the main container
        //             //e is the element that was moved
        //             console.log(l)
        //             console.log(e)
        //         }
        //     });


        //Action Delete function
        $(document).on('click','.delete',function(){
            var id =  $(this).attr('id');
            swalWithBootstrapButtons({
                title: "Delete Selected Category?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                $.ajax({
                    url: "category/"+id,
                    type:"post",
                    data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                    success: function(result){
                        location.reload();
                        toast({
                            type: "success",
                            title: "Category Deleted Successfully"
                        });
                    }
                });
                }
            });
        });

        $(document).on('click','.delete',function(){
            console.log('delete');
        });

    });
  </script>

@endsection
