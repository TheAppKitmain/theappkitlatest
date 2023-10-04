@extends('appkit_frontend.layouts.main')
@section('content')

<div class="log-in-wrapper">
         <div class="container">
            <div class="row signinrow">
               <div class="col-md-6">
               <div class="left-login-text">
                  <h1>Log</h1>
				  <h2><img class="dot" src="images/imgdot.png"> in</h2>
                  <div class="btn-container mt-5">
                    <img class="shap9" src="images/shap9.png">
                  </div>
               </div>
               </div>
               <div class="col-md-6">
               <form method="POST" action="{{ route('login') }}" name="registration_form">
               @csrf
                    <div class="right-login">
                     <div class="form-group form-group-custome">
                     <input id="email" type="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                       @error('email')
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                       @enderror
                 </div>
                     <div class="form-group form-group-custome">
                     <div class="form-group form-group-custome">
                                <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                  <div class="input-group">
                    <div class="pull-left w-50">
                        <div class="custom_checkbox">
                            <label class="ch-checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span><i class="ch-icon icon-tick"></i>Remember Me</span>
                            </label>
                        </div>
                    </div>
                  <div class="pull-right forgot">
                  <a href="{{ route('password.request') }}">Forgot Password</a>
                  </div>
                </div>
				<div class="btn-container mt-5 text-center">
                   <button type="submit" class="btn-color btn-style">Log in</button>
                </div>
				<!-- <div class="btn-containercreate-ac mt-5 text-center">
                     <a class="btn-create-ac" href="sign_up.html">Create an account</a>
                </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endsection
