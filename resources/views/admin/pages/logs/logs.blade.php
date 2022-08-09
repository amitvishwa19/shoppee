@extends('admin.layout.admin')

@section('title','Dashboard')

@section('subscription','active')


@section('style')
    {{-- Datatable --}}
    <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <h4 class="page-title">Error Logs</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item active">Error Logs</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i>
                            </a>

                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        {{-- Log Table --}}
        <div class="row">
            @if(!$logs)
                <div class="alert alert-info" role="alert"><b>No Logs found</b></div>
            @else
            {{-- <div class="col-md-3 ">
                <ul class="list-group mg-t-10">

                    @if($files)
                        <li class="list-group-item"><b>Log Files</b></li>
                    @endif

                    @foreach($files as $file)
                    <li class=" @if ($current_file == $file) active @endif">
                        <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}" class="">
                        {{$file}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div> --}}


            <div class="col-md-12
             card p-4">
                @if($logs)
                    <div class="lbl-heading" style="margin-bottom: 10px;">
                        @if($current_file)
                            <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-download mg-r-5"></span> Download file
                            </a>
                            -
                            <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-sync mg-r-5"></span> Clean file
                            </a>
                            -
                            <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-trash mg-r-5"></span> Delete file
                            </a>
                            @if(count($files) > 1)
                            -
                            <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                <span class="fa fa-trash mg-r-5"></span> Delete all files
                            </a>
                            @endif
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr class="headings">
                                <th >Level</th>
                                <th >Context</th>
                                <th >Date</th>
                                <th class="hidden-xs">Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $key => $log)
                                <tr data-display="stack{{{$key}}}" class="even pointer" >

                                    <td class="nowrap text-{{{$log['level_class']}}}" >
                                        <span class="" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                    </td>
                                    <td class="text"><small>{{$log['context']}}</small></td>
                                    <td class="date"><small>{{{$log['date']}}}</small></td>


                                    <td class="text hidden-xs" width="50%">

                                        <small>{{$log['text']}}</small>
                                        @if ($log['stack'])
                                            <small>
                                                <a class="" data-toggle="collapse" href="#collapseExample"  aria-controls="collapseExample">
                                                    Log Trace
                                                </a>
                                            </small>
                                            <div class="collapse mg-t-5" id="collapseExample">
                                                <small> {{$log['stack']}}</small>
                                            </div>
                                        @endif

                                        @if (isset($log['in_file']))
                                            <br/>{{{$log['in_file']}}}
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    No Logs Found
                @endif
            </div>
            @endif
        </div> <!-- end row -->

        @if($logs)




        @endif

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}

    {{-- <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/pages/jquery.datatable.init.js')}}"></script> --}}
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'


        });

    </script>

@endsection
