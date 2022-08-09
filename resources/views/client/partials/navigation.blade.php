<!-- Main Header -->
<header class="main-header header-style-one ">

   <!-- Header Upper -->
   <div class="header-upper">
       <div class="inner-container clearfix">
           <!--Logo-->
           <div class="logo-box">
               <div class="logo">
                   <a href="{{route('app.home')}}">
                       <img src="{{setting('app_icon')}}" id="thm-logo" alt="Digizigs Technologies Light">
                   </a>
               </div>
           </div>
           <div class="nav-outer clearfix">
               <!--Mobile Navigation Toggler-->
               <div class="mobile-nav-toggler">
                   <span class="icon flaticon-menu-2"></span>
                   <span class="txt">Menu</span>
               </div>

               {{-- {{menu('Header Menu','client.partials.header_menu')}} --}}

               <!-- Main Menu -->
               <nav class="main-menu navbar-expand-md navbar-light">
                   <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                       <ul class="navigation clearfix">

                           <li class="dropdown {{ Request::is('/') ? 'current' : '' }}">
                               <a href="{{route('app.home')}}">Home</a>
                           </li>

                           <li class="dropdown {{ Request::is('about') ? 'current' : '' }}"><a href="{{route('app.about')}}">About Us</a></li>

                           <li class="dropdown {{ Request::is('service') ? 'current' : '' }}"><a href="{{route('app.service')}}">Services</a>
                               <!-- <ul>
                                   <li><a href="{{route('app.service')}}">All Services</a></li>
                                   <li><a href="web-development.html">Website Development</a></li>
                                   <li><a href="graphic-designing.html">Graphic Designing</a></li>
                                   <li><a href="digital-marketing.html">Digital Marketing</a></li>
                                   <li><a href="seo.html">SEO & Content Writting</a></li>
                                   <li><a href="app-development.html">App Development</a></li>
                                   <li><a href="ui-designing.html">UI/UX Designing</a></li>
                               </ul> -->
                           </li>

                           <li class=" dropdown {{ Request::is('blogs') ? 'current' : '' }}">
                               <a href="{{route('app.blogs')}}">Blog</a>
                           </li>

                           <li class="{{ Request::is('contact') ? 'current' : '' }}"><a href="{{route('app.contact')}}">Contact</a></li>

                       </ul>
                   </div>
               </nav>
           </div>

           <div class="other-links clearfix">
               <!--Search Btn-->
               <div class="search-btn">
                   <button type="button" class="theme-btn search-toggler">
                       <span class="flaticon-loupe"></span>
                   </button>
               </div>

               <div class="link-box">
                   <div class="call-us">
                       <a class="link" href="tel:+91 9712340450">
                           <span class="icon"></span>
                           <span class="sub-text">Connect Anytime</span>
                           <span class="number">info@devlomatix.com</span>
                       </a>
                   </div>
               </div>

           </div>

       </div>
   </div>
   <!--End Header Upper-->

</header>
<!-- End Main Header -->

<!--Mobile Menu-->
<div class="side-menu__block">


   <div class="side-menu__block-overlay custom-cursor__overlay">
       <div class="cursor"></div>
       <div class="cursor-follower"></div>
   </div><!-- /.side-menu__block-overlay -->
   <div class="side-menu__block-inner ">
       <div class="side-menu__top justify-content-end">

           <a href="#" class="side-menu__toggler side-menu__close-btn"><img src="{{asset('public\client\images/icons/close-1-1.png')}}"
                   alt=""></a>
       </div><!-- /.side-menu__top -->


       <nav class="mobile-nav__container">
           <!-- content is loading via js -->
       </nav>
       <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
       <div class="side-menu__content">
           <p>We are a leading Application development agency.</p>
           <p>
               <a href="mailto:info@digizigs.com">info@digizigs.com</a>
                <br> <a href="tel:+91-9712340450">+91 971 234 0450</a></p>
           <div class="side-menu__social">
               <a href="#"><i class="fab fa-facebook-square"></i></a>
               <a href="#"><i class="fab fa-twitter"></i></a>
               <a href="#"><i class="fab fa-instagram"></i></a>
               <a href="#"><i class="fab fa-pinterest-p"></i></a>
           </div>
       </div><!-- /.side-menu__content -->
   </div><!-- /.side-menu__block-inner -->
</div><!-- /.side-menu__block -->
