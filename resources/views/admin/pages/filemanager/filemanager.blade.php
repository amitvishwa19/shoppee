@extends('admin.layout.admin')

@section('title','Filemanager')

@section('filemanager','active')


@section('style')
    {{-- Datatable --}}
    <link href="{{asset('public/admin/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- Datatable --}}
@endsection



@section('content')
    <div class="content-area">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Filemanagers</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Filemanagers</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#new_folder" data-toggle="modal" class="btn btn-info waves-effect waves-light btn-sm" >
                                New Folder
                            </a>
                            <a href="#upload_file" data-toggle="modal" class="btn btn-info waves-effect waves-light btn-sm" >
                                Upload File
                            </a>
                        </div>
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


       
        <div class="app-setting">
            <div class="row setting-wrapper">


                <div class="col-md-2 setting-options">
                    <div class="card">
                        <div class="card-header ">

                        <div class="row align-items-center">
                            <div class="col">                      
                                <h4 class="card-title">File Manager</h4>                      
                            </div><!--end col-->
                            <div class="col-auto"> 
                                <div class="dropdown">
                                    <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <!-- <i class="las la-menu align-self-center text-muted icon-xs"></i>  -->
                                        <i class="mdi mdi-dots-horizontal text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Create Folder</a>
                                        <a class="dropdown-item" href="#">Upload File</a>
                                    </div>
                                </div>       
                            </div><!--end col-->
                        </div>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <ul class="mt-2">
                                <li class="{{(request()->type == 'all' ) ? 'active' : 'null'}}">
                                    <a href="{{route('filemanager.index',['type'=>'all','id'=>0])}}">
                                        <i data-feather="home" class="align-self-center menu-icon"></i>
                                        <span>All Files</span>
                                    </a>
                                </li>                               
                                <li class="{{(request()->type =='folder') ? 'active' : 'null'}}">
                                    <a href="{{route('filemanager.index',['type'=>'folder','id'=>0])}}">
                                        <i data-feather="folder" class="align-self-center menu-icon"></i>
                                        <span>Folders</span>
                                    </a>
                                </li>
                                <li class="{{(request()->type =='important') ? 'active' : 'null'}}">
                                    <a href="{{route('filemanager.index',['type'=>'important'])}}">
                                        <i data-feather="star" class="align-self-center menu-icon"></i>
                                        <span>Important</span>
                                    </a>
                                </li>
                                <li class="{{(request()->type =='deleted') ? 'active' : 'null'}}">
                                    <a href="{{route('filemanager.index',['type'=>'deleted'])}}">
                                        <i data-feather="trash" class="align-self-center menu-icon"></i>
                                        <span>Deleted Files</span>
                                    </a>
                                </li>
                                

                            </ul>

                            <hr>

                            <ul class="mt-2">
                                                            
                                <li class="{{(request()->type =='profile') ? 'active' : 'null'}}">
                                    <a href="{{route('setting.index',['type'=>'profile'])}}">
                                        <i data-feather="image" class="align-self-center menu-icon"></i>
                                        <span>Images</span>
                                    </a>
                                </li>
                                <li class="{{(request()->type =='profile') ? 'active' : 'null'}}">
                                    <a href="{{route('setting.index',['type'=>'profile'])}}">
                                        <i data-feather="video" class="align-self-center menu-icon"></i>
                                        <span>Video</span>
                                    </a>
                                </li>
                                <li class="{{(request()->type =='profile') ? 'active' : 'null'}}">
                                    <a href="{{route('setting.index',['type'=>'profile'])}}">
                                        <i data-feather="speaker" class="align-self-center menu-icon"></i>
                                        <span>Audio</span>
                                    </a>
                                </li>
                                <li class="{{(request()->type =='profile') ? 'active' : 'null'}}">
                                    <a href="{{route('setting.index',['type'=>'profile'])}}">
                                        <i data-feather="archive" class="align-self-center menu-icon"></i>
                                        <span>Zip Files</span>
                                    </a>
                                </li>

                            </ul>

                        </div><!--end card-body-->
                    </div>
                </div>

                
                <div class="col-lg-10">
                    <div class="">                                    
                        <div class="tab-content" id="files-tabContent">
                            
                            <div class="tab-pane fade show active" id="files-projects">
                                
                                @if($files->count() == 0 && $folders->count() == 0)
                                    <h5>No File or Folder found</h5>
                                @endif
                            
                                @if($files->count() > 0)
                                <div class="file-box-content">
                                    @foreach($files as $file)
                                        <div class="file-box">
                                            <a href="#" class="download-icon-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="dripicons-download file-download-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Create Folder</a>
                                                <a class="dropdown-item" href="#">Upload File</a>
                                            </div>
                                            <div class="text-center">
                                                <i class="fa fa-file-code "></i>
                                                <h6 class="text-truncate">Admin_Panel</h6>
                                                <small class="text-muted">06 March 2019 / 5MB</small>
                                            </div>                                                        
                                        </div>
                                    @endforeach
                                </div> 
                                <hr>
                                @endif
                                



                                @if($folders->count() > 0)
                                <div class="file-box-content">
                                            
                                        @foreach($folders as $folder)
                                            
                                                <div class="file-box">
                                                    <div class="top mb-3">
                                                        <div class="dropdown d-inline-block float-right">
                                                            <a class="dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                <i class="las la-ellipsis-v font-18 text-muted"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drop2" style="">
                                                                <a class="dropdown-item" href="#">Edit</a>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                        <i class="mdi mdi-star d-block mt-n2 font-18 text-warning"></i>
                                                    </div>
                                                    <a href="{{route('filemanager.index',['type'=>'folder','id'=>$folder->id])}}">
                                                        <div class="text-center">
                                                            <i class="fa fa-folder"></i>
                                                            <h6 class="text-truncate">{{$folder->name}}</h6>
                                                            <small class="text-muted">{{$folder->created_at->format('d M Y')}}</small>
                                                        </div>  
                                                    </a>                                                      
                                                </div>
                                            
                                        @endforeach
                                                                                                                        
                                </div>
                                @endif


                            </div><!--end tab-pane-->

                        
                        </div>  <!--end tab-content-->                                                                              
                    </div><!--end card-body-->
                </div><!--end col-->
                
            </div>
        </div>
     

        {{-- Add Project Modal --}}
        <div class="modal fade" id="new_folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Add New Folder</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form  action="{{route('filemanager.store',['type'=>request()->type,'id'=>request()->id])}}" enctype="multipart/form-data" method="post" class="new_folder">
                                            @csrf
                                            <div class="form-group">
                                                <label for="projectName">Folder Name :</label>
                                                <input type="text" class="form-control" id="projectName" aria-describedby="emailHelp" name="folder">
                                            </div><!--end form-group-->
                                           

                                            <button type="submit" class="btn btn-info waves-effect waves-light btn-sm">Create Folder</button>
                                            <button type="button" class="btn btn-secondary waves-effect waves-light btn-sm">Cancel</button>
                                        </form>  <!--end form-->
                                    </div><!--end col-->

                                </div><!--end row-->
                            </div><!--end col-->
                        </div>

                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->
        {{-- Add Project Modal --}}

        {{-- Add Project Modal --}}
        <div class="modal fade" id="upload_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel"><b>Upload</b></h6>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                        </button>
                    </div><!--end modal-header-->
                    <div class="modal-body">
                        <form action="">
                            <input type="file" id="input-file-now" class="dropify" />
                            <button type="submit" class="btn btn-info waves-effect waves-light btn-sm mt-3">Upload</button>
                        </form>                                                   
                    </div><!--end modal-body-->

                </div><!--end modal-content-->
            </div>
        </div><!--end modal-->
        {{-- Add Project Modal --}}


    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script> --}}
    <script src="{{asset('public/admin/plugins/dropify/js/dropify.min.js')}}"></script>
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'

            $('.dropify').dropify();

            //Datatable
            // $('#datatable').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: '{!! route('post.index') !!}',
            //     columns:[
            //         { data: 'postdetails', name: 'postdetails'},
            //         { data: 'category', name: 'category'},
            //         { data: 'status', name: 'status'},
            //         { data: 'created_at', name: 'created_at' },
            //         { data: 'action', name: 'action' },
            //     ]
            // });


            //Action Delete function
            // $(document).on('click','.delete',function(){
            //     var id =  $(this).attr('id');
            //     swalWithBootstrapButtons({
            //         title: "Delete Selected Post?",
            //         text: "You won't be able to revert this!",
            //         type: "warning",
            //         showCancelButton: true,
            //         confirmButtonText: "Delete",
            //         cancelButtonText: "Cancel",
            //         reverseButtons: true
            //     }).then(result => {
            //         if (result.value) {
            //         $.ajax({
            //             url: "post/"+id,
            //             type:"post",
            //             data: {_method: 'delete', _token: "{{ csrf_token() }}"},
            //             success: function(result){
            //                 location.reload();
            //                 toast({
            //                     type: "success",
            //                     title: "Post Deleted Successfully"
            //                 });
            //             }
            //         });
            //         }
            //     });
            // });

        });

    </script>

@endsection
