@extends('admin.layout.admin')

@section('title','Post')

@section('post','active')


@section('style')
    <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/admin/plugins/quill/quill.core.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Posts</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Posts</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <!-- <a href="#post_display" class="btn btn-info waves-effect waves-light btn-sm" data-toggle="modal" >Posts Grid</a> -->
                            <a href="{{route('post.create')}}" class="btn btn-info waves-effect waves-light btn-sm" >Add New Post</a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        
                                        <th style="width:60%">Post</th>
                                        <th style="width:15%">Categories</th>
                                        <th style="width:15%">Tags</th>
                                        <th style="width:10%">Actions</th>

                                    </tr>
                                </thead>


                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->


        {{-- Post display grid page --}}
        <div class="modal fade" id="post_display" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Posts Display</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">

                        <div class="row">

                            @foreach($posts as $post)

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="blog-card">
                                            @if($post->feature_image)
                                            <img src="{{$post->feature_image}}" alt="" class="img-fluid rounded">
                                            @endif


                                            @foreach($post->categories as $category)
                                            <span class="badge badge-purple px-3 py-2 bg-soft-primary font-weight-semibold mt-3">{{$category->name}}</span>
                                            @endforeach

                                            <h4 class="my-3">
                                                {{$post->title}}
                                                <br>
                                                
                                            </h4>
                                            <small>{{$post->description}}</small>
                                            <p class="text-muted">
                                                {{!!substr($post->body,0,200 )!!}}
                                            </p>
                                            <hr class="hr-dashed">
                                            <div class="d-flex justify-content-between">
                                                <div class="meta-box">
                                                    <div class="media">
                                                        <img src="{{asset('public/admin/assets/images/users/user-5.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">
                                                        <div class="media-body align-self-center text-truncate">
                                                            <h6 class="m-0 text-dark">Donald Gardner</h6>
                                                            <ul class="p-0 list-inline mb-0">
                                                                <li class="list-inline-item">26 mars 2020</li>
                                                                <li class="list-inline-item">by <a href="#">admin</a></li>
                                                            </ul>
                                                        </div><!--end media-body-->
                                                    </div>
                                                </div><!--end meta-box-->
                                                <div class="align-self-center">
                                                    <a href="#" class="text-dark">Read more <i class="fas fa-long-arrow-alt-right"></i></a>
                                                </div>
                                            </div>
                                        </div><!--end blog-card-->

                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!--end col-->

                            @endforeach


                            <!-- <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="blog-card">
                                            <img src="{{asset('public/admin/assets/images/small/img-2.jpg')}}" alt="" class="img-fluid rounded">
                                            <span class="badge badge-purple px-3 py-2 bg-soft-primary font-weight-semibold mt-3">Fruit</span>
                                            <h4 class="my-3">
                                                <a href="#" class="">The standard chunk of Lorem Ipsum used since</a>
                                            </h4>
                                            <p class="text-muted">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Cum sociis natoque penatibus et magnis.</p>
                                            <hr class="hr-dashed">
                                            <div class="d-flex justify-content-between">
                                                <div class="meta-box">
                                                    <div class="media">
                                                        <img src="{{asset('public/admin/assets/images/users/user-4.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">
                                                        <div class="media-body align-self-center text-truncate">
                                                            <h6 class="m-0 mb-1 text-dark">Susan Brady</h6>
                                                            <ul class="p-0 list-inline mb-0">
                                                                <li class="list-inline-item">01 Feb 2020</li>
                                                                <li class="list-inline-item">by <a href="#">admin</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="align-self-center">
                                                    <a href="#" class="text-dark">Read more <i class="fas fa-long-arrow-alt-right"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>  -->


                        </div>



                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->


        {{-- Add Post Modal --}}
        <div class="modal fade" id="add_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Add Post</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card">

                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><b>Post Title</b></label>
                                                <input type="text" class="form-control" aria-describedby="emailHelp" name="title">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1"><b>Post Description</b></label>
                                                <input type="text" class="form-control" name="description">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1"><b>Post Content</b></label>
                                                <div id="content" class="ht-200"></div>
                                                <input type="text" name="body" style="display: none" id="bodyinput" value="{{ old('body') }}">
                                            </div>






                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div>

                            <div class="col-lg-3">

                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="card-title">Status & Visiblity</h4>
                                            </div><!--end col-->
                                        </div>  <!--end row-->
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                            <label for="inlineRadio1"> Published </label>
                                        </div>
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                            <label for="inlineRadio2"> Draft </label>
                                        </div>
                                    </div><!--end card-body-->
                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Category</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body bootstrap-select-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="mb-3">Select category for post</label>
                                                <select class="select2 mb-3 select2-multiple select2-hidden-accessible" style="width: 100%" name="categories[]" multiple="">
                                                        <option value="CA">California</option>
                                                        <option value="NV">Nevada</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="WA">Washington</option>\
                                                </select>
                                            </div> <!-- end col -->
                                        </div><!-- end row -->
                                    </div><!-- end card-body -->
                                </div> <!-- end card -->


                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Tags</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select type="text" class="" value="" data-role="tagsinput" multiple="" style="width: 100%" name="tags[]"></select>
                                            </div> <!-- end col -->
                                        </div><!-- end row -->
                                    </div><!-- end card-body -->
                                </div> <!-- end card -->

                                <div class="card">

                                    <div class="card-header">
                                        <h4 class="card-title">Feature Image</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <img class="card-img-top img-fluid bg-light-alt" src="{{asset('public/admin/assets/images/small/img-2.jpg')}}" alt="Card image cap">
                                        <div class="mt-4">
                                            <input type="file">
                                        </div>
                                    </div><!--end card -body-->
                                </div>




                            </div>

                        </div>

                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->

       

        <!-- <form action="{{route('facebook.publish',['id'=>6])}}" method="post">
        @csrf
            <button>Post</button>
        </form> -->

    </div>
@endsection



@section('scripts')
    <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    {{-- Tiny mc editor --}}
    <script src="https://cdn.tiny.cloud/1/oiidq8jebp02vu4vrjy0ewufnmx0dz2b8x5oxniofbhylzc5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('public/admin/plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/pages/jquery.form-editor.init.js')}}"></script>
    <script src="{{asset('public/admin/plugins/quill/quill.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

    <script>



        $(function(){
            'use strict'

            var editor = new Quill('#content', {
            modules: {
                toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic','underline', 'strike'],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['link', 'blockquote', 'code-block', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                ['clean'],
                [{ 'color': [] }, { 'background': [] }],

                ]
            },
            placeholder: '',
            theme: 'snow'
            });
            editor.on('text-change', function() {
            $('#bodyinput').val(editor.root.innerHTML);
            //var text = editor.getText();
            });


            $('.select2').select2();

            //Datatable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: '{!! route('post.index') !!}',
                columns:[
                    { data: 'postmeta', name: 'postmeta'},
                    { data: 'category', name: 'category'},
                    { data: 'tag', name: 'tag'},
                    { data: 'action', name: 'action' },
                ]
            });


            $(document).on('click','.delete',function(){
                var id =  $(this).attr('id');
                swalWithBootstrapButtons({
                    title: "Delete Selected Post?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                    $.ajax({
                        url: "post/"+id,
                        type:"post",
                        data: {_method: 'delete', _token: "{{ csrf_token() }}"},
                        success: function(result){
                            location.reload();
                            toast({
                                type: "success",
                                title: "Post Deleted Successfully"
                            });
                        }
                    });
                    }
                });
            });

            tinymce.init({
                selector: 'textarea#content'
            });

            $('body').on('click','.fbpublish',function(){
                var id = $(this).data('pid');
                var type = $(this).data('type');

                //console.log(id);
                //console.log(type);

                $.ajax({
                    url: "{{ route('facebook.publish')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{id:id, type:type},
                    beforeSend:function(){
                        $('.submitspinner'+id).html('<i class="fa fa-spinner fa-spin"></1>');
                    },
                    success:function(data){
                        $('.submitspinner'+id).html('')
                        console.log(data);
                        if(data.status == 200){
                            toast({
                                type: "success",
                                title: data.msg
                            });
                        }
                        if(data.status == 400){
                            toast({
                                type: "error",
                                title: data.msg
                            });
                        }

                    }
                });
            });

        });

    </script>

@endsection
