<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home</title>
      <!-- Bootstrap -->
      <link rel="icon" href="images/moblogo.png" type="image/png" sizes="16x16">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,400&display=swap" rel="stylesheet">
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
   </head>
      <!-- header end -->
      <div class="sign-up-wrapper otp-wrapper">
            <div class="row">
            <div class="col-md-12">
               @if(Session::get('alert'))
                     <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                        <p>{{Session::get('message')}} </p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     </div>
                     @endif
            </div>
            </div>
            <div class="help-block with-errors"></div>
            <div class="container">
               <div class="row sign-up-conteiner">
                  </div>
               <div class="row sign-up-conteiner verify-email">
                  <div class="col-md-6 signup-left">
                  <div class="left-sign-text">
                     <h1 class="color-white">Verify your account</h1>
                     <h3 class="color-white">Check your email for the verification code.</h3>
                     <img class="password-img" src="images/password.png">
                  </div>
                  </div>
                  <div class="col-md-6 signup-right">
                  
               <h2 class="text-center color-blue">Enter Code</h2>  
                     <form method="post" data-toggle="validator" action="{{route('user_otp')}}">
                           @csrf
                           <div class="d-flex ">
                                 <input type="text" class="form-control otpcode inputs" name="otp"  maxlength="6" autocomplete="off">
                           </div>
                        
                           <div class=" btn-group-rs">
                              <div class="btn-container mt-5 text-center submit-btn-opt">
                                    <button type="submit" class="btn-color btn-style">
                                       Submit
                                    </button>
                              </div>
                              <div class="text-center  btn-group-rs">
                                 <a href="otp_resend" class="resend-link" > Resend</a>  
                              </div>
                              <p class="spm-msg">Note: If you didn’t receive the email, please check your spam / junk mail</p>
                           </div>
                     </form>
            </div>
         </div>
      </div>
      </div>

      <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <p class="text-white text-center">© The App Kit 2021</p>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer end -->



<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/owl.carousel.js') }} "></script>
<script src="{{ asset('js/owl.carousel.min.js') }} "></script>
<script src="{{ asset('js/bootstrap.min.js ') }}"></script>
<script src="{{ asset('js/custom.js') }} "></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('js/countrySelect.js') }}"></script>
<script src="{{ asset('js/jquery.ccpicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

<script>
      


