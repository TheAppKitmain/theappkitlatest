<!doctype html>
<html class="no-js" lang="en">
    <head>

    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Create a Mobile App for Your Business</title>
      <meta name="description" content="Ready to turn your Idea into a reality? TheAppKit can make that happen!"/>
      <!-- Bootstrap -->
      <link rel="icon" href="images/moblogo.png" type="image/png" sizes="16x16">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,400&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@800;900&display=swap" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/style.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/responsive.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/owl.carousel.min.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/owl.carousel.css" rel="stylesheet">
      <link href="<?php echo url ('/'); ?>/css/responsive.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/jquery.ccpicker.css') }}">
      <link rel="stylesheet" href="{{ asset('css/countrySelect.css') }}">
      <script src="{{asset('template/js/jquery.min.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
        
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

      <div class="sign-up-wrapper shopify_page text-center">
        <div class="container">
            <div class="row sign-up-conteiner">
               <div class="col-md-12 signup-left">
                  <div class="left-sign-text">
                     <h1 class="color-white"> THANK YOU!! </h1>
                     <h3 class="color-white">A member of the team will be in touch shortly</h3>
                  </div>
               </div>       
            </div>
        </div>
      </div>
<footer>
         <div class="container">
            <div class="row">

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