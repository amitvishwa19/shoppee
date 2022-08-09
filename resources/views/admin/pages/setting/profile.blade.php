


    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">                      
                    <h4 class="card-title">Profile</h4>                      
                </div><!--end col-->                                                       
            </div>  <!--end row-->                                  
        </div><!--end card-header-->
        <div class="card-body"> 
            <div class="row mb-5">
                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                    <div class="dastone-profile-main">
                        <div class="dastone-profile-main-pic">
                            <img src="{{auth()->user()->avatar_url ?? asset('public/admin/assets/images/users/user-4.jpg')}}" alt="" height="110" class="rounded-circle">
                            <span class="dastone-profile_main-pic-change">
                                <i class="fas fa-camera"></i>
                            </span>
                        </div>
                        <div class="dastone-profile_user-detail">
                            <h5 class="dastone-user-name">{{auth()->user()->firstName}},{{auth()->user()->lastName}}</h5>                                                        
                            <p class="mb-0 dastone-user-name-post">UI/UX Designer, India</p>                                                        
                        </div>
                    </div>                                                
                </div><!--end col-->
                
                <div class="col-lg-4 ml-auto align-self-center">
                    <ul class="list-unstyled personal-detail mb-0">
                        <li class=""><i class="las la-phone mr-2 text-secondary font-22 align-middle"></i> <b> phone </b>: {{auth()->user()->contact}}</li>
                        <li class="mt-2"><i class="las la-envelope text-secondary font-22 align-middle mr-2"></i> <b> Email </b> : {{auth()->user()->email}}</li>
                        <li class="mt-2"><i class="las la-globe text-secondary font-22 align-middle mr-2"></i> <b> Website </b> : 
                            <a href="https://mannatthemes.com/" class="font-14 text-primary">https://mannatthemes.com/</a> 
                        </li>                                                   
                    </ul>
                    
                </div><!--end col-->
                <div class="col-lg-4 align-self-center">
                    <div class="row">
                        <div class="col-auto text-right border-right">
                            <button type="button" class="btn btn-soft-primary btn-icon-circle-sm mb-2">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <p class="mb-0 font-weight-semibold">Facebook</p>
                            <h4 class="m-0 font-weight-bold">25k <span class="text-muted font-12 font-weight-normal">Followers</span></h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <button type="button" class="btn btn-soft-info btn-icon-circle-sm mb-2">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <p class="mb-0 font-weight-semibold">Twitter</p>
                            <h4 class="m-0 font-weight-bold">58k <span class="text-muted font-12 font-weight-normal">Followers</span></h4>
                        </div><!--end col-->
                    </div><!--end row-->                                               
                </div><!--end col-->
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('profile.store')}}" enctype="multipart/form-data" method="post" class="formsubmit">
                        @csrf
                        
                        <div class="form-group">
                            <label class=""><b>First Name</b></label>
                            <div class="">
                                <input class="form-control" id="firstname" type="text" value="{{auth()->user()->firstName ?? ''}}" name="firstname">
                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <small class="badge badge-secondary">{{ $errors->first('firstname') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=""><b>Last Name</b></label>
                            <div class="">
                                <input class="form-control" id="lastname" type="text" value="{{auth()->user()->lastName ?? ''}}" name="lastname">
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <small class="badge badge-secondary">{{ $errors->first('lastname') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=""><b>Username</b></label>
                            <div class="">
                                <input type="text" class="form-control"  value="{{auth()->user()->username ?? ''}}" name="username">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <small class="badge badge-secondary">{{ $errors->first('username') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=""><b>Email Address</b></label>
                            <div class="">
                                <div class="input-group ">
                                    <input type="text" class="form-control" value="{{auth()->user()->email ?? ''}}" name="email" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info waves-effect waves-light btn-sm ">Save Profile <span class="submitspinner"></span></button>        
                    </form>
                    
                </div>
            </div>                                                       
        </div>                                            
    </div>

    @section('scripts')

        <script>

            $(function(){
                'use strict'
                    
                $('body').on('submit','.formsubmit', function(e){
                    e.preventDefault();

                    var firstname = $('#firstname').val();
                    var lastname = $('#firstname').val();
                   
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
