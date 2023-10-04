<!doctype html>
<html class="no-js" lang="en">
    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Blog</title>
      <!-- Bootstrap -->
      <link rel="icon" href="images/moblogo.png" type="image/png" sizes="16x16">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- bootstrap -->
        <link rel="stylesheet" href="<?php echo url ('/'); ?>/css/bootstrap.min.css" />
        <link href="<?php echo url ('/'); ?>/blogs/appkit/css/style.css" rel="stylesheet">
        <!-- style -->
        <link rel="stylesheet" href="<?php echo url ('/'); ?>/blogs/css/style.css" />
        <!-- responsive css -->
        <link rel="stylesheet" href="<?php echo url ('/'); ?>/blogs/css/responsive.css" />
        
    </head>
    <body>
    <header>
         <div class="header-menu desktop-navbar">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                        <a class="navbar-brand" href="{{ URL::to('/') }}">The App Kit</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                           <ul class="navbar-nav ml-auto">
                             <li class="nav-item dropdown" id="open_menu">
                                 
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Solution
                                 </a>
                                 <div class="dropdown-menu" id="menu_dropdown"  aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item  " href="{{ URL::to('shopify') }}">Shopify Apps</a>
                                    <a class="dropdown-item" href="{{ URL::to('Ecommerce') }}">E-commerce Apps</a>
                                    <a class="dropdown-item" href="{{ URL::to('booking') }}">Bookings Apps</a>
                                    <a class="dropdown-item no-border" href="{{ URL::to('documents') }}">Documents Apps</a>        
                                 </div>
                                 </li> 
                                 <li class="nav-item">
                                 <a class="nav-link" href="{{ URL::to('residential') }}">Residential</a>
                              </li> 
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ URL::to('pricing') }}">Pricing</a>
                              </li>
                              <li class="nav-item">   
                                 <a class="nav-link" href="{{ URL::to('work') }}">Our work</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ URL::to('contact_us') }}">Contact us</a>
                              </li>
                              @guest
                              @if (Route::has('logout'))
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                              </li>
                              @endif
                              <div class=" my-2 my-lg-0 right-search">
                                 <a class="btncreateapp " href="{{ URL::to('buildapp') }}">
                                 Create an App
                                 </a>
                              </div>
                              @else
                              <li class="nav-item dropdown" id="open_login_menu">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="usernameright">{{ Auth::user()->first_name[0] }}</span>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right" id="menu_login_dropdown" aria-labelledby="navbarDropdown">
                                    
                                    @if(Auth::user()->user_type == "template")

                                    <a class="dropdown-item" href="{{ URL::to('/home') }}">Dashboard</a>

                                    @elseif(Auth::user()->user_type == "custom")

                                    <a class="dropdown-item" href="{{ URL::to('/home') }}">Dashboard</a>
                                    
                                    @else

                                    <a class="dropdown-item" href="{{ URL::to('/admin') }}">Dashboard</a>

                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                    </form>
                                 </div>
                              </li>
                              @endguest
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
         <div class="mob-navbar ">
            <div class="navbar navbar-custom">
               <a  href="{{ URL::to('/') }}"><img class="moblogo" src="{{asset('images/logo.png')}}" alt="Logo"/></a>
               <div class="navbar-buttons">
                 <span><img class="open-menu" src="{{asset('images/menu.png')}}" alt=""/></span>
               </div>
            </div>
            <!-- Overlay Navigation Menu -->
            <div class="overlay">
               <img class="logo-mobile-overlayer" src="{{asset('images/mob-logo.png')}}" alt="Logo"/>
               <nav class="overlay-menu navbar navbar-expand-lg navbar-light navbar-custom">
                  <ul class="menu-top">
                     <li><a href="#"></a></li>

                     <li><a href="{{ URL::to('shopify') }}">Shopify Apps</a></li>
                    <li><a href="{{ URL::to('Ecommerce') }}">Ecommerce</a></li>
                    <li><a href="{{ URL::to('booking') }}">Booking Apps</a></li>
                    <li><a href="{{ URL::to('documents') }}">Documents Apps</a></li>
                    
                    <li><a href="{{ URL::to('residential') }}">Residential</a></li>
                     <li><a href="{{ URL::to('pricing') }}">Pricing</a></li>
                     <li><a href="{{ URL::to('work') }}">OUR WORK </a></li>
                     <li><a href="{{ URL::to('contact_us') }}">CONTACT US</a></li>
                     @guest
                     @if (Route::has('logout'))
                     <li><a href="{{ route('login') }}">LOGIN</a></li>
                     @endif
                     <li class="create-app"><a href="{{ URL::to('buildapp') }}"> Create an App </a></li>
                     @else
                              <li class="nav-item dropdown-mobile" id="usernamebolg">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ Auth::user()->first_name}} {{ Auth::user()->last_name}} 
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right" id="mobile_login_menu" aria-labelledby="navbarDropdown">
                                    
                                    @if(Auth::user()->user_type == "template")
                                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                    @elseif(Auth::user()->user_type == "custom")
                                    <a class="dropdown-item" href="/home">Dashboard</a>
                                    @else
                                    <a class="dropdown-item" href="/admin">Dashboard</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                    </form>
                                 </div>
                              </li>
                     @endguest
                  </ul>
				  <ul class="social-icons">
                  <li><a href="# "><i class="fa fa-facebook " aria-hidden="true "></i></a></li>
                  <li><a href="# "><i class="fa fa-twitter " aria-hidden="true "></i></a></li>
                  <li><a href="# "><i class="fa fa-instagram " aria-hidden="true "></i></a></li>
                  <li><a href="# "><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
               </ul>
               </nav>
               <ul class="close-icon">
                  <li><img class="close-menu" src="{{asset('images/close.png')}}" alt=""/></li>
               </ul>
               
            </div>
         </div>
      </header>
        <section class="catgary-section">
        <div class="container">
               <div class="row">
                  <div class="col-md-12">
        <ul class="catgarymainbox" id="filterBycategoires">
            <a href="{{url('blog')}}">
            <li class="facetwp-radio <?php if($blogcategory == NULL) { echo 'blogcatname-checked'; } ?>">
               <img class="facet-radio-img" src="{{asset('asset/images/iconscat/all-icon@3x.png')}}">
               <img class="facet-radio-img__white" src="{{asset('asset/images/iconscat/all-icon-white@3x.png')}}">
               <span>All </span>
            </li>
          </a>
            @foreach($blogcategories as $data)
                <a href="{{url('blog-category/'.$data->slug)}}">
                  <li class="facetwp-radio <?php if($blogcategory == $data->slug) { echo 'blogcatname-checked'; } ?>" data-url="{{url('bloglist/'.$data->slug)}}">
                     <img class="facet-radio-img" src="{{$data->image}}" alt="Featured">
                     <img class="facet-radio-img__white" src="{{asset('asset/images/iconscat/featured-white.png')}}" alt="Featured">
                     <span>{{$data->name}}</span>
                  </li>
                </a>
            @endforeach


      </ul>
</div>
         </div>
         </div>
        </sction>
        <!-- start blog section -->
        <section class="no-padding wow fadeIn">
            <div class="container-fluid">
                <div class="row blog-post-style4">
                    <div class="col-md-12 no-padding xs-padding-15px-lr">
                        <ul class="blog-grid blog-4col gutter-small">
                            <li class="grid-sizer"></li>
                            <!-- start blog post item -->
                            @foreach($blogs as $blog)
                           
                            <li class="grid-item wow fadeInUp">
                                <figure>
                                <a href="{{route('blog.show',$blog->id)}}">
                                    <div class="blog-img bg-extra-dark-gray">
                                        <a href="{{route('blog.show',$blog->id)}}"><img src="{{$blog->blog_meta->thumbnail}}" alt="" ></a>
                                    </div>
                                    <figcaption>
                                        <div class="portfolio-hover-main text-left">
                                            <div class="blog-hover-box vertical-align-bottom">
                                            <!-- <p>2021-03-31 05:48:10           25 April 2017</p> -->
                                                <span class="post-author text-extra-small text-medium-gray text-uppercase display-block margin-5px-bottom xs-margin-5px-bottom">{{date('d', strtotime($blog->created_at))}} {{date('M', strtotime($blog->created_at))}} {{date('Y', strtotime($blog->created_at))}} | by <a href="{{route('blog.show',$blog->id)}}" class="text-medium-gray">{{$blog->blog_meta->seo_title ?? ""}}</a></span>
                                                <h6 class="alt-font display-block text-white font-weight-600 no-margin-bottom"><a href="{{route('blog.show',$blog->id)}}" class="text-white">{{$blog->post_title}}</a></h6>
                                                <p class="text-medium-gray margin-10px-top width-80 md-width-100 blog-hover-text">{{ substr($blog->post_content, 0, 100) }}</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                    </a>
                                </figure>
                            </li>
                            
                            @endforeach
                            <!-- end blog post item -->
                        </ul>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!-- end post content -->
<footer>
         <div class="container">
            <div class="row">
               <!-- <div class="col-md-12 text-center"> -->
               <!-- <a class="navbar-brand " href="https://theappkit.co.uk">The App Kit</a> -->
               <!-- </div> -->
               <div class="col-md-4">
                  <h4>Solutions</h4>
                  <ul class="footerlinks">
                  <li><a href="{{ URL::to('Shopify') }}">Shopify Apps</a></li>
                  <li><a href="{{ URL::to('Ecommerce') }}">E-commerce Apps</a></li>
                     <li><a href="{{ URL::to('booking') }}">Bookings Apps</a></li>      
                     <li><a href="{{ URL::to('#') }}">Delivery Apps</a></li>
                     <li><a href="{{ URL::to('#') }}">Carwash Apps</a></li>
                  </ul>
               </div>
               <div class="col-md-4 right-footer">
                  <h4>Resources</h4>
                  <ul class="footerlinks">
                     <li><a href="#">Help Centre </a></li>
                     <li><a href="{{ URL::to('faqs') }}">FAQ’s</a></li>
                     <li><a href="{{ URL::to('blog') }}">Blog</a></li>
                  </ul>
               </div>
               <div class="col-md-4">
                  <h4>Company</h4>
                  <ul class="footerlinks">
                     <li><a href="#">About us</a></li>
                     <li><a href="{{ URL::to('contact_us') }}">Contact us</a></li>
                     <li><a href="#">Terms</a></li>
                     <li><a href="#">Privacy Policy</a></li>
                  </ul>
               </div>
               <div class="col-md-12">
                  <div class="footer-bottom text-center">
                     <a href="https://www.instagram.com/theappkit/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                     <a href="https://www.facebook.com/theappkid"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                     <a href="https://youtu.be/NB1Hvp7dleE"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                     <p>Copyright © 2021 <a href="#">The App kit</a> </p>
                  </div>
               </div>
            </div>
         </div>
      </footer>        

        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/skrollr.min.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/smooth-scroll.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.appear.js"></script>
        <!-- menu navigation -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/bootsnav.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.nav.js"></script>
        <!-- animation -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/wow.min.js"></script>
        <!-- page scroll -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/page-scroll.js"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/swiper.min.js"></script>
        <!-- counter -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.count-to.js"></script>
        <!-- parallax -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.stellar.js"></script>
        <!-- magnific popup -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.magnific-popup.min.js"></script>
        <!-- portfolio with shorting tab -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/isotope.pkgd.min.js"></script>
        <!-- images loaded -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/imagesloaded.pkgd.min.js"></script>
        <!-- pull menu -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/classie.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/hamburger-menu.js"></script>
        <!-- counter  -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/counter.js"></script>
        <!-- fit video  -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.fitvids.js"></script>
        <!-- equalize -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/equalize.min.js"></script>
        <!-- skill bars  -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/skill.bars.jquery.js"></script> 
        <!-- justified gallery  -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/justified-gallery.min.js"></script>
        <!--pie chart-->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/jquery.easypiechart.min.js"></script>
        <!-- instagram -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/instafeed.min.js"></script>
        <!-- retina -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/retina.min.js"></script>
        <!-- revolution -->
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/revolution/js/jquery.themepunch.revolution.min.js"></script>

        <script type="text/javascript" src="<?php echo url ('/'); ?>/blogs/js/main.js"></script>



<script>

$(document).ready(function() {

$("#filterBycategoires").change(function() {
  var option = $(this).find('li:blogcatname-checked');
  window.location.href = option.data("url");
});
    
});

</script>

              <script>

         // mobile navbar
         $(document).ready(function() {
             $('.open-menu').on('click', function() {
                 $('.overlay').addClass('open');
             });
         
             $('.close-menu').on('click', function() {
                 $('.overlay').removeClass('open');
             });
         });
// active bar
$(".ourworkul li a").click(function() {
    $(this).parent().addClass('active-workli').siblings().removeClass('active-workli');

});

$(".select-template-tabs li a").click(function() {
    $(this).parent().addClass('active-temp').siblings().removeClass('active-temp');

});

$('#open_menu').click(function() {

  if ($('#menu_dropdown').hasClass('open')){

    $('#menu_dropdown').removeClass('open');

  } else {

    $('#menu_dropdown').addClass('open');

  }

});


$('#open_login_menu').click(function() {

if ($('#menu_login_dropdown').hasClass('open')){

  $('#menu_login_dropdown').removeClass('open');

} else {

  $('#menu_login_dropdown').addClass('open');

}

});

$('#usernamebolg').click(function() {

if ($('#mobile_login_menu').hasClass('open')){

  $('#mobile_login_menu').removeClass('open');

} else {

  $('#mobile_login_menu').addClass('open');

}

});




      </script>
    </body>
</html>