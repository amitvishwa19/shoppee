
@extends('client.layout.layout')

@section('title','Blog')


@section('style')
@endsection


@section('content')

   <!--Contact Section-->
   <section class="contact-section">
      <div class="auto-container">


          <div class="form-box">
              <div class="sec-title">
                  <h2>Write Us a Message<span class="dot">.</span></h2>
              </div>
              <div class="default-form">
                  <form method="post" action="{{route('app.inquire')}}" id="contact-form">
                        @csrf
                        <div class="row clearfix">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <div class="field-inner">
                                    <input type="text" name="name" value="" placeholder="Your Name" required="">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <div class="field-inner">
                                    <input type="email" name="email" value="" placeholder="Email Address"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <div class="field-inner">
                                    <input type="text" name="phone" value="" placeholder="Phone Number" required="">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <div class="field-inner">
                                    <input type="text" name="subject" value="" placeholder="Subject" required="">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="field-inner">
                                    <textarea name="message" placeholder="Write Message" required=""></textarea>
                                </div>
                            </div>

                            @captcha
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <button class="theme-btn btn-style-one">
                                    <i class="btn-curve"></i>
                                    <span class="btn-title">Send message</span>
                                </button>
                            </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
   </section>

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
