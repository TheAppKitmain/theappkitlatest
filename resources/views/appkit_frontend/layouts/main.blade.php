<!DOCTYPE html>
<html lang="en">
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
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <!--<script src="{{asset('template/js/jquery.min.js')}}"></script>-->
      <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   </head>
   <body>
      <!-- header start -->
      
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
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="{{ URL::to('solutions') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Solution
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item  " href="{{ URL::to('shopify') }}">Shopify Apps</a>
                                    <a class="dropdown-item" href="{{ URL::to('Ecommerce') }}">E-commerce Apps</a>
                                    <a class="dropdown-item" href="{{ URL::to('booking') }}">Bookings Apps</a>
                                    <a class="dropdown-item no-border" href="{{ URL::to('documents') }}">Documents Apps</a>                                   
                                 </div>
                                 </li>
                              <!-- <li class="nav-item">
                                 <a class="nav-link" href="{{ URL::to('residential') }}">Residential</a>
                              </li>  -->
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
                              <li class="nav-item dropdown desktoprightmenu">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="usernameright">{{ Auth::user()->first_name[0] }}</span>
                                 <!-- <div class="d-flex"><span class="username-top">{{ Auth::user()->first_name[0] }}</span></div> -->
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    @if(Auth::user()->user_type == "template")

                                    <a class="dropdown-item" href="{{ URL::to('/home') }}">Dashboard</a>

                                    @elseif(Auth::user()->user_type == "custom")

                                    <a class="dropdown-item" href="{{ URL::to('/home') }}">Dashboard</a>

                                    @elseif(Auth::user()->user_type == "shopify")

                                    <a class="dropdown-item" href="{{ URL::to('/shopify_page') }}">Dashboard</a>
                                    
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
                    
                    <!-- <li><a href="{{ URL::to('residential') }}">Residential</a></li> -->
                     <li><a href="{{ URL::to('pricing') }}">Pricing</a></li>
                     <li><a href="{{ URL::to('work') }}">OUR WORK </a></li>
                     <li><a href="{{ URL::to('contact_us') }}">CONTACT US</a></li>
                     @guest
                     @if (Route::has('logout'))
                     <li><a href="{{ route('login') }}">LOGIN</a></li>
                     @endif
                     <li class="create-app"><a href="{{ URL::to('buildapp') }}"> Create an App </a></li>
                     @else
                              <li class="nav-item dropdown-mobile">
                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               {{ Auth::user()->first_name}} {{ Auth::user()->last_name}} 
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
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
      @yield('content')
<!-- Template Modal here -->
       <div class="modal" tabindex="-1" role="dialog"  aria-hidden="true" id="template_section">
            <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                 
                  <div class="modal-body">
                     <img src="{{asset('images/comingsoon-img.png')}}" alt="">
                  </div>
               </div>
            </div>
      </div>
<!-- Template Modal End here -->



<footer>
         <div class="container">
            <div class="row">
               <!-- <div class="col-md-12 text-center"> -->
               <!-- <a class="navbar-brand " href="https://theappkit.co.uk">The App Kit</a> -->
               <!-- </div> -->
               <div class="col-md-4">
                  <h4>Solutions</h4>
                  <ul class="footerlinks">
                  <li><a href="{{ URL::to('shopify') }}">Shopify Apps</a></li>
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
                     <li><a href="{{ URL::to('privacy_policy') }}">Privacy Policy</a></li>
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



<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
<script src="{{ asset('js/owl.carousel.js') }} "></script>
<script src="{{ asset('js/owl.carousel.min.js') }} "></script>
<script src="{{ asset('js/custom.js') }} "></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('js/countrySelect.js') }}"></script>
<script src="{{ asset('js/jquery.ccpicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en"></script>
<script>
         $(document).ready(function() {
            $("#phoneField").CcPicker();
            $("#country_selector").countrySelect();
         });
</script>

<script type="text/javascript">
$('#reload').click(function () {
$.ajax({
type: 'GET',
url: 'reload-captcha',
success: function (data) {
$(".captcha span").html(data.captcha);
}
});
});
</script>

<script>     
$("#my_captcha_form").submit(function(a) {
  var response = grecaptcha.getResponse();
  if(response.length == 0) { 
      $('#captcha').html("You can't leave Captcha Code empty");
      return false;
  } else {
      a.preventDefault();
      $.ajax({
         url: "{{route('contact_us_appkit')}}",
         type: "POST",
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         success: function(response) {
            if (response == 1) {
               var staus_value = "Got it! A member of the team will be in touch shortly";
               swal(staus_value, "", "success");
            }
         }
      });
   }
});

$('#app-showcase1,#app-showcase2').owlCarousel({
         margin: 30,
         smartSpeed: 2000, // duration of change of 1 slide
         nav: true,
         navigation: true,
         responsiveClass: true,
         responsive: {
            0: {
                  items: 1,
                  nav: true
            },
            600: {
                  items: 1,
                  nav: false
            },
            1000: {
                  items: 1,
                  nav: true
            },
            1400: {
                  items: 1,
                  nav: true
            }
         }
      })
</script>
      
<script>
 function template_modal(id)
 {
   $('body').find('#largeModal').modal('show');
   $.ajax
   ({
      type:'get',
      url:'{{route("template_modal")}}',
      data:{'id':id}, 
      success:function(data)
      {
         $('#themepre').empty().append(data);
         var owl = $("#theme-showcase");
          owl.owlCarousel({
             loop: true,
             margin: 30,
             smartSpeed: 2000, // duration of change of 1 slide
             nav: true,
             navigation: true,
             responsiveClass: true,
             responsive: {
                 0: {
                     items: 1,
                     nav: true
                 },
                 600: {
                     items: 1,
                     nav: false
                 },
                 1000: {
                     items: 2,
                     nav: true
                 },
                 1400: {
                     items: 2,
                     nav: true 
                 }
             }
         });
      }
   }) 
 }
</script>
<script>
$(function() {
  $("form[name='registration_form']").validate({
    rules: {
      business_name: "required",
      first_name: "required",
      checkbox: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 8,
      },
      phone_number: {
        required: true,
        minlength: 10,
      }
    },
    messages: {
      business_name: "Enter your business name *",
      first_name: "Enter your first name *",
      email: "Enter your email *",
      checkbox: "Please agree to terms and condition *",
      password: {
        required: "Enter your password *",
        minlength: "Password must be at least 8 characters long *",  
      },
      phone_number: {
        required: "Enter your number *",
      },
      email: "Please enter a valid email address",
    },
    submitHandler: function(form) {
      var response = grecaptcha.getResponse();
      if(response.length == 0) { 
         $('#captcha').html("You can't leave Captcha Code empty");
         return false;
      } else {
         form.submit();
      }
    }
  });
});
</script>
<script>
 $('#phoneField').keyup(validateMaxLength);
function validateMaxLength()
{
  var text = $(this).val();
  var maxlength = $(this).data('maxlength');
  if(maxlength > 0){
    $(this).val(text.substr(0, maxlength)); 
  }
}
</script>

<script>
   $('#password').keyup(validateMaxLength);

function validateMaxLength()
{
        var text = $(this).val();
        var maxlength = $(this).data('maxlength');

        if(maxlength > 0)  
        {
                $(this).val(text.substr(0, maxlength)); 
        }
}
</script>

<!--Validation End-->


<script>
   $( document ).ready(function() {
      $("#country_selector").countrySelect();
      $("#phoneField").CcPicker();
   });
</script>

<script>

   @if(session('status'))
   swal({
   title: '{{session('status')}}',
   icon: '{{session('statuscode')}}',
   button: "OK",
   });
   @endif
   $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
<script>
         $('#clientsliderprop').owlCarousel({
             loop: true,
             margin: 30,
             smartSpeed: 2000, // duration of change of 1 slide
             nav: true,
             navigation: true,
             responsiveClass: true,
             responsive: {
                 0: {
                     items: 1,
                     nav: true
                 },
                 600: {
                     items: 1,
                     nav: false
                 },
                 1000: {
                     items: 1,
                     nav: true
                 },
                 1400: {
                     items: 1,
                     nav: true 
                 }
             }
         })
      </script>
   </body>
</html>
