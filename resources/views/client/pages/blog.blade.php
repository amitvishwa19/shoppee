
@extends('client.layout.layout')

@section('title','Blog')


@section('style')
@endsection


@section('content')



	<div class="sidebar-page-container">
		<div class="auto-container">
			 <div class="row clearfix">

				   <!--Content Side-->
				   <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-details">

                        <!--News Block-->
                        <div class="post-details">
                            <div class="inner-box">
                                <div class="image-box">
                                    <a href="blog-single.html"><img src="{{$post->feature_image}}" alt=""></a>
                                </div>
                                <div class="lower-box">
                                    <div class="post-meta">
                                        <ul class="clearfix">
                                            <li><span class="far fa-clock"></span> {{\Carbon\Carbon::parse($post->created_at)->isoFormat('D MMM YYYY')}}</li>
                                            <li><span class="far fa-user-circle"></span> {{$post->author->firstName}}, {{$post->author->lastName}}</li>
                                        </ul>
                                    </div>
                                    <h4>{{$post->title}}</h4>
                                    <div class="text">
                                        {!! $post->body!!}
                                    </div>
                                </div>
                            </div>
                            <div class="info-row clearfix">
                                <div class="tags-info"><strong>Tags:</strong> <a href="#">Business</a>, <a
                                        href="#">Agency</a>, <a href="#">Technology</a></div>
                                <div class="cat-info"><strong>Category:</strong> <a href="#">Business</a>, <a
                                        href="#">Agency</a></div>
                            </div>
                        </div>

                        <div class="post-control-two">
                            <div class="row clearfix">
                                <div class="control-col col-md-6 col-sm-12">
                                    <div class="control-inner">
                                        <h4><a href="#">A DEEP UNDERSTANDING OF OUR AUDIENCE</a></h4>
                                        <a href="#" class="over-link"></a>
                                    </div>
                                </div>
                                <div class="control-col col-md-6 col-sm-12">
                                    <div class="control-inner">
                                        <h4><a href="#">EXPERIENCES THAT CONNECT WITH PEOPLE</a></h4>
                                        <a href="#" class="over-link"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Comments Area-->
                        <div class="comments-area">
                            <div class="comments-title">
                                <h3>2 Comments</h3>
                            </div>
                            <div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb">
                                        <figure class="thumb"><img src="{{asset('public/client/images/resource/author-7.jpg')}}" alt="">
                                        </figure>
                                    </div>
                                    <div class="info">
                                        <div class="name">Jessica Brown</div>
                                        <div class="date">20 May, 2020 . 4:00 pm</div>
                                    </div>
                                    <div class="text">Lorem Ipsum is simply dummy free text of the available
                                        printing and typesetting been the industry standard dummy text ever sincer
                                        condimentum purus.</div>
                                    <div class="reply-btn">
                                        <a class="theme-btn btn-style-one" href="about.html">
                                            <i class="btn-curve"></i>
                                            <span class="btn-title">Reply</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb">
                                        <figure class="thumb"><img src="{{asset('public/client/images/resource/author-8.jpg')}}" alt="">
                                        </figure>
                                    </div>
                                    <div class="info">
                                        <div class="name">David Martin</div>
                                        <div class="date">20 May, 2020 . 4:00 pm</div>
                                    </div>
                                    <div class="text">Lorem Ipsum is simply dummy free text of the available
                                        printing and typesetting been the industry standard dummy text ever sincer
                                        condimentum purus.</div>
                                    <div class="reply-btn">
                                        <a class="theme-btn btn-style-one" href="about.html">
                                            <i class="btn-curve"></i>
                                            <span class="btn-title">Reply</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--Leave Comment Form-->
                            <div class="leave-comments">
                                <div class="comments-title">
                                    <h3>Leave a comment</h3>
                                </div>
                                <div class="default-form comment-form">
                                    <form method="post" action="contact.html">
                                        <div class="row clearfix">
                                            <div class="col-md-6 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Your Name" required="">
                                            </div>

                                            <div class="col-md-6 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email Address"
                                                    required="">
                                            </div>

                                            <div class="col-md-6 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Phone Number"
                                                    required="">
                                            </div>

                                            <div class="col-md-6 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Subject" required="">
                                            </div>

                                            <div class="col-md-12 col-sm-12 form-group">
                                                <textarea name="message" placeholder="Your Comments"></textarea>
                                            </div>

                                            <div class="col-md-12 col-sm-12 form-group">
                                                <button type="submit" class="theme-btn btn-style-one">
                                                    <i class="btn-curve"></i>
                                                    <span class="btn-title">Submit Comment</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
				   </div>

				  <!--Sidebar Side-->
				  <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
						<aside class="sidebar blog-sidebar">

                            <div class="sidebar-widget recent-posts">
								  <div class="widget-inner">
										<div class="sidebar-title">
											 <h4>Latest News</h4>
										</div>

										@foreach($random_posts as $random)
										<div class="post">
											 <figure class="post-thumb">
												 <img src="{{$random->feature_image}}" height="200" alt="">
											 </figure>
											 <h5 class="text"><a href="{{route('app.blog',$random->slug)}}">{{$random->title}}</a></h5>
										</div>
										@endforeach

								  </div>
							 </div>

                             <div class="sidebar-widget archives">
								  <div class="widget-inner">
										<div class="sidebar-title">
											 <h4>Categories</h4>
										</div>
										<ul>
											@foreach($categories as $category)
												<li><a href="{{route('app.blogs.category',$category->slug)}}">{{$category->name}} ({{$category->posts->count()}})</a></li>
											@endforeach
										</ul>
								  </div>
							 </div>

							 <div class="sidebar-widget popular-tags">
								  <div class="widget-inner">
										<div class="sidebar-title">
											 <h4>Tags</h4>
										</div>
										<div class="tags-list clearfix">
											@foreach($tags as $tag)
											 <a href="{{route('app.blogs.tag',$tag->slug)}}">{{ucFirst($tag->name)}}</a>,
											@endforeach 
										</div>
								  </div>
							 </div>

							

						</aside>
				  </div>

			 </div>
		</div>
  	</div>

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
