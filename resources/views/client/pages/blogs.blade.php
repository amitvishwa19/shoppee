
@extends('client.layout.layout')

@section('title','Blog')


@section('style')
@endsection


@section('content')

	{{-- <!-- Banner Section -->
	<section class="page-banner">
		<div class="image-layer" style="background-image:url({{asset('public/client/images/background/image-7.jpg')}});"></div>
		<div class="shape-1"></div>
		<div class="shape-2"></div>
		<div class="banner-inner">
			 <div class="auto-container">
				  <div class="inner-container clearfix">
						<h1>Blog Posts</h1>
						<div class="page-nav">
							 <ul class="bread-crumb clearfix">
							 		<li><a href="{{route('app.home')}}">Home</a></li>
								  	<li class="active">Blog Posts</li>
							 </ul>
						</div>
				  </div>
			 </div>
		</div>
  	</section>
	<!--End Banner Section --> --}}

	<div class="sidebar-page-container">
		<div class="auto-container">
			 <div class="row clearfix">

				  <!--Content Side-->
				  <div class="content-side col-lg-8 col-md-12 col-sm-12">
						

                            
							@foreach($posts as $post)

							<div class="blog-posts">
                                <!--News Block-->
                                <div class="news-block-two">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <a href="{{route('app.blog',$post->slug)}}"><img src="{{$post->feature_image}}" alt=""></a>
                                        </div>
                                        <div class="lower-box">
                                            <div class="post-meta">
                                                    <ul class="clearfix">
                                                        <li><span class="far fa-clock"></span>{{\Carbon\Carbon::parse($post->created_at)->isoFormat('D MMM YYYY')}}</li>
                                                        <li><span class="far fa-user-circle"></span> {{ $post->author->firstName }},{{ $post->author->lastName }}</li>
                                                        <li><span class="far fa-comments"></span> 2 Comments</li>
                                                    </ul>
                                            </div>
                                            <h4><a href="{{route('app.blog',$post->slug)}}">{{$post->title}}</a>
                                            </h4>
                                            <div class="text">{!!str_limit($post->body,400)!!}</div>

                                        </div>
                                    </div>
                            	</div>

								</div>
								<div class="more-box">
									<a class="theme-btn btn-style-one" href="{{route('app.blog',$post->slug)}}">
										<i class="btn-curve"></i>
										<span class="btn-title">Load more posts</span>
									</a>
								</div>
                            @endforeach
							 

						
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
