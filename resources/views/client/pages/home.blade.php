
@extends('client.layout.layout')

@section('title','Home')


@section('style')
   
@endsection


@section('content')

   @include('client.partials.banner')

   @include('client.partials.about')

   @include('client.partials.service')

   @include('client.partials.trusted')

   @include('client.partials.parallex')

   @include('client.partials.news')

   @include('client.partials.action')

	    
@endsection


@section('modal')

	

@endsection


@section('javascript')
   
	
  	<script>
  		$(function(){
         'use strict'

         

         

      });
  	</script>

@endsection