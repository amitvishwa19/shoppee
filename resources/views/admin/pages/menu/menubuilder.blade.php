@extends('admin.layout.admin')

@section('title','Menu Builder')

@section('menubuilder','active')


@section('style')
    {{-- Datatable --}}
    {{-- <link href="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> --}}
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
                            <h4 class="page-title">Menu Builder ( {{$menu->name}} )</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Devlomatix</a></li>
                                <li class="breadcrumb-item"><a href="{{route('menu.index')}}">Menus</a></li>
                                <li class="breadcrumb-item active">Menu Builder</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="{{route('menu.item.create',['menu' => $menu->id,'id'=>$menu->id])}}" class="btn btn-info waves-effect waves-light btn-sm">Add Menu Item</a>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="alert alert-primary" role="alert" style="margin:0">
            <b>How To Use:</b>
            <p>
               You can output a menu anywhere on your site by calling
               <b>menu('name')</b>
            </p>
         </div>

        <div>
            {{menu($menu->name,'admin.partials.menus.admin_menu_builder')}}
        </div>

    </div>
@endsection



@section('scripts')

    {{-- Datatable JS --}}
    {{-- <script src="{{asset('public/admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script> --}}
    {{-- Datatable JS --}}



    <script>

        $(function(){
            'use strict'


        });

    </script>

@endsection
