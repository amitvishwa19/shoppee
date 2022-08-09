 <!-- Main Footer -->
 <footer class="main-footer">
   <div class="auto-container">
       <!--Widgets Section-->
       <div class="widgets-section">
           <div class="row clearfix">

               <!--Column-->
               <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                   <div class="footer-widget logo-widget">
                       <div class="widget-content">
                           <div class="logo">
                               {{-- <a href="index-2.html"><img id="fLogo" src="{{setting('app.logo')}}" alt="" /></a> --}}
                           </div>
                           <div class="text">Welcome to our web design agency. Lorem ipsum simply free text
                               dolor sited amet cons cing elit.</div>
                           <ul class="social-links clearfix">
                               <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                               <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                               <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                               <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                           </ul>
                       </div>
                   </div>
               </div>

               <!--Column-->
               <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                   <div class="footer-widget links-widget">
                       <div class="widget-content">
                           <h6>Explore</h6>
                           <div class="row clearfix">
                               <div class="col-md-6 col-sm-12">
                                   <ul>
                                       <li><a href="#">About</a></li>
                                       <li><a href="#">Latest News</a></li>
                                       <li><a href="#">Contact</a></li>
                                   </ul>
                               </div>

                           </div>
                       </div>
                   </div>
               </div>

               <!--Column-->
               <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                   <div class="footer-widget info-widget">
                       <div class="widget-content">
                           <h6>Contact</h6>
                           <ul class="contact-info">
                               <li class="address"><span class="icon flaticon-pin-1"></span> Vadodara, India</li>
                               <li><span class="icon flaticon-email-2"></span>
                                   <a href="mailto:info@digizigs.com">info@devlomatix.com</a>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>

               <!--Column-->
               <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                   <div class="footer-widget newsletter-widget">
                       <div class="widget-content">
                           <h6>Newsletter</h6>

                           @if(!Request::cookie('subscription'))
                            <div class="newsletter-form">
                                <form method="post" action="{{route('app.subscribe')}}">
                                    @csrf
                                    <div class="form-group clearfix">
                                        <input type="email" name="email" value="" placeholder="Email Address" required="">
                                        @captcha
                                        <button type="submit" class="theme-btn">
                                            <span class="fa fa-envelope"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                           @endif
                            <div class="text">
                                @if(Request::cookie('subscription'))
                                    You are subscribed to our newsletter,we will send you updates via mail
                                @else
                                    Sign up for our latest news & articles. We won’t give you spam mails.
                                @endif

                            </div>
                       </div>
                   </div>
               </div>

           </div>

       </div>
   </div>

   <!-- Footer Bottom -->
   <div class="footer-bottom">
       <div class="auto-container">
           <div class="inner clearfix">
               <div class="copyright">&copy; copyright 2020 by Devlomatix Solutions</div>
           </div>
       </div>
   </div>

</footer>
