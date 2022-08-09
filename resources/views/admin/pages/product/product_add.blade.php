@extends('admin.layout.admin')

@section('title','Product')

@section('task','active')

@section('style')
    <link href="{{asset('public/admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
@endsection


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Product</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="wrapper pb-2">

        <form role="form" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">

                    <div class="form-group">
                        <label><b>Product Title</b></label>
                        <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="error">
                                <small>{{ $errors->first('title') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><b>Product Description</b></label>
                        <textarea name="description" id="" class="form-control" cols="30" rows="2">{{old('description')}}</textarea>
                        @if ($errors->has('description'))
                            <span class="error">
                                <small>{{ $errors->first('description') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><b>Nutrient value & Benifits</b></label>
                        <textarea name="description" id="" class="form-control" cols="30" rows="2"></textarea>
                        @if ($errors->has('description'))
                            <span class="error">
                                <small>{{ $errors->first('description') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><b>Storage Tips</b></label>
                        <textarea name="description" id="" class="form-control" cols="30" rows="2"></textarea>
                        @if ($errors->has('description'))
                            <span class="error">
                                <small>{{ $errors->first('description') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><b>About</b></label>
                        <textarea name="description" id="" class="form-control" cols="30" rows="2"></textarea>
                        @if ($errors->has('description'))
                            <span class="error">
                                <small>{{ $errors->first('description') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label><b>Price(₹)</b></label>
                                <input type="number" class="form-control" name="price" min=0  value="{{old('price')}}">
                                @if ($errors->has('price'))
                                    <span class="error">
                                        <small>{{ $errors->first('price') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label><b>Discount(%)</b></label>
                                <input type="number" class="form-control" name="discount" min=0 max=100  value="{{old('discount')}}">
                                @if ($errors->has('discount'))
                                    <span class="error">
                                        <small>{{ $errors->first('discount') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label><b>Unit</b></label>
                                <!-- <input type="text" class="form-control" name="title"  value="{{old('title')}}"> -->
                                <input type="text" class="form-control" name="sku"  value="{{old('sku')}}">
                                @if ($errors->has('sku'))
                                    <span class="error">
                                        <small>{{ $errors->first('sku') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label><b>Quantity</b></label>
                                <input type="number" class="form-control" name="quantity" min=0   value="{{old('quantity')}}">
                                @if ($errors->has('quantity'))
                                    <span class="error">
                                        <small>{{ $errors->first('quantity') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label><b>Rating</b></label>
                                <input type="number" class="form-control" name="rating" min=0 max=5  value="{{old('rating')}}">
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label><b>Feature Image</b></label>
                        <div class="card-img-top img-fluid bg-light-alt avatar-preview"></div>
                        <div class="list-inline-item remove-image" style="display:none"><b>Remove image</b></div>
                        <div class="">
                            <input type="file" id="imageUpload" name="feature_image" value="Upload Image">
                            
                        </div>
                        @if ($errors->has('feature_image'))
                                <span class="error">
                                    <small>{{ $errors->first('feature_image') }}</small>
                                </span>
                            @endif
                    </div>

                    <div class="checkbox check-success  mt-2">
                        <input type="checkbox" name="featured" value="1" id="checkbox1">
                        <label for="checkbox1"><b>Featured</b></label>
                    </div>

                    <div class="checkbox check-success  mt-2">
                        <input type="checkbox" name="status" value="1" id="checkbox2">
                        <label for="checkbox2"><b>Active</b></label>
                    </div>

                </div>
             

                <div class="col-md-4">

                    <div class="form-group">    
                        <label class=""><b>Select category</b></label>
                        <select class="select2 select2-multiple select2-hidden-accessible" style="width: 100%" name="categories[]" multiple="">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>   
                    </div>

                    <div class="form-group">    
                        <label class=""><b>Related Products</b></label>
                        <select class="select2 select2-multiple select2-hidden-accessible" style="width: 100%" name="categories[]" multiple="">
                            @foreach($products as $prod)
                                <option value="{{$prod->id}}">{{$prod->title}}</option>
                            @endforeach
                        </select>   
                    </div>


                </div>
            </div>
            
            
           

            <div class="form-group mt-4">
                <button class="btn btn-info waves-effect waves-light btn-sm">Add Product</button>
                <a href="{{route('product.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>

        </form>


    </div>

@endsection


@section('modal')
@endsection


@section('scripts')
    <script src="{{asset('public/admin/plugins/select2/select2.min.js')}}"></script>

    <script>
        $(function(){
            'use strict'

            $('.select2').select2();

            $("#imageUpload").change(function() {
                console.log('Image Upload')
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                            $('.avatar-preview').css('background-image', 'url('+e.target.result +')');
                            $('.avatar-preview').css('height', '100px');
                            $('.avatar-preview').css('width', '120px');
                            $('.avatar-preview').css('display', 'block');
                            $('.avatar-preview').css('background-size', 'contain');
                            $('.avatar-preview').css('background-repeat', 'no-repeat');
                            $('.avatar-preview').css('background-position', 'center');
                            $('.avatar-preview').css('object-fit', 'fill !important');
                            $('.avatar-preview').hide();
                            $('.avatar-preview').fadeIn(650);
                        }
                    reader.readAsDataURL(this.files[0]);
                    $('.remove-image').css('display', 'block');
                    $('.remove-image').css('cursor', 'pointer');

                }
            });

            $('.remove-image').on('click',function(){
                $('.avatar-preview').css('background-image', 'none');
                $('.avatar-preview').css('display', 'none');
                $('.remove-image').css('display', 'none');
                $("#imageUpload").val('');
            });


        });
    </script>

@endsection
