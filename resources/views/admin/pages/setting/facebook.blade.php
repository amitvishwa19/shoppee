<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">                      
                <h4 class="card-title">Manage Facebook</h4>                      
            </div><!--end col-->
            <div class="col-auto"> 
            <a href="{{route('facebook.connect')}}" class="btn btn-info waves-effect waves-light btn-sm ">Connect </a>               
            </div><!--end col-->
        </div>  <!--end row-->                                  
    </div>
    <div class="card-body"> 


        <form action="{{route('facebook.page.id.add')}}" enctype="multipart/form-data" method="post" class="formsubmit">
            @csrf
            <div class="row">
                <!-- <div class="form-group col-md-6">
                    <label class=""><b>App ID</b></label>
                    <div class="">
                        <input class="form-control" type="password"  name="app_id">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class=""><b>App Secret</b></label>
                    <div class="">
                        <input class="form-control" type="password"  name="app_secret">
                    </div>
                </div> -->

                <div class="form-group col-md-12">
                    <label class=""><b>Auth Token</b></label>
                    <div class="">
                        <input class="form-control" type="text"  name="app_token" disabled value="{{auth()->user()->facebook_token ?? ''}}">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class=""><b>App ID</b></label>
                    <div class="">
                        <input class="form-control" type="text"  name="app_token" disabled value="{{auth()->user()->facebook_app_id ?? ''}}">
                    </div>
                </div>

                @if(auth()->user()->facebook_token)
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="exampleInputPassword1"><b>Page ID</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Facebook page id" id="page_id" name="page_id" value="{{auth()->user()->facebook_page_id ?? ''}}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Add Page <span class="submitspinner"></button>
                                </span>
                                
                            </div>                                                    
                        </div>
                    </div>
                @endif

                      
            </div>
           
                    
        </form>
        
        
        <facebook class="mt-2"></facebook>
    </div>
</div>

@section('scripts')

        <script>

            $(function(){
                'use strict'
                    
                $('body').on('submit','.formsubmit', function(e){
                    e.preventDefault();
                  
                    $.ajax({
                        url:$(this).attr('action'),
                        data:new FormData(this),
                        type:'POST',
                        contentType:false,
                        cache:false,
                        processData:false,
                        headers:{'X-CSRF-TOKEN':'{{csrf_token()}}'},
                        beforeSend:function(){
                            $('.submitspinner').html('<i class="fa fa-spinner fa-spin"></1>')
                        },
                        success:function(data){
                            $('.submitspinner').html('')
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
                        },
                    });
                })
            });

        </script>

    @endsection




