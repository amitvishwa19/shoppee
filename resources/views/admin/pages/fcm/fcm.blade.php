@extends('admin.layout.admin')

@section('title','Product')

@section('product','active')


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
                            <h4 class="page-title">Push Notification(FCMc)</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">FCM</li>
                                
                            </ol>
                         
                        </div><!--end col-->
                        
                       
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row card pt-2 pb-2">
            <div class="col-lg-12 col-sm-12">
            <div class="col-sm-6">

                <form method="post" action="{{route('fcm.send')}}" enctype="multipart/form-data" class="mg-t-30">
                    @csrf

                   

                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Title (Title of the Message)</b></label>
                        <input type="text" class="form-control" name="title" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Body</b></label>
                        <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                    </div>

                   

                    <button class="btn btn-info waves-effect waves-light btn-sm">Send Notification</button>

                </form>
                </div>
            </div>
        </div><!--end row-->

    </div>
@endsection



@section('scripts')


    <script>

        $(function(){
           

        });

    </script>

@endsection
