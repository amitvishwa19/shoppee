<div class="col-lg-10">
    <div class="">                                    
        <div class="tab-content" id="files-tabContent">
            
            <div class="tab-pane fade show active" id="files-projects">
                
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