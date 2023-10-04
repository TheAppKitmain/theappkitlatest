@extends('appkit_frontend.layouts.main')
@section('content')
    <?php
    $ip = $_SERVER['REMOTE_ADDR'];
    // the IP address to query
    $ip = '203.134.206.89';
    $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    if ($query && $query['status'] == 'success') {
    $countryCode = $query['countryCode'];
    $countryCodesmall = strtolower($countryCode);
    }
    ?>
    <!-- header end -->
    <!-- sign-up-wrapper start -->
    <div class="sign-up-wrapper">
        <div class="container">
            <div class="row sign-up-conteiner">
                <div class="col-md-6 signup-left">
                    <div class="left-sign-text">
                        <h1 class="color-white">Welcome Back</h1>
                        <h3 class="color-white">Login with your email and password </h3>
                        <div class="signupbtn">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 signup-right">
                    <form method="POST" action="{{ route('user_register') }}" id="registration" name="registration_form">
                        @csrf
                        @if (isset($_GET['name']) && $_GET['name'] == 'custom')
                            <div class="form-group row">
                                <input type="hidden" id="template_name" name="template_name" value="">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="template_id" name="template_id" value="0">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="user_type" name="user_type" value="custom">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="role_id" name="role_id" value="1">
                            </div>
                        @elseif (isset($_GET['name']) && $_GET['name'] == 'shopify')
                            <div class="form-group row">
                                <input type="hidden" id="template_name" name="template_name" value="">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="template_id" name="template_id" value="0">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="user_type" name="user_type" value="shopify">
                            </div>
                            <div class="form-group row">
                                <input type="hidden" id="role_id" name="role_id" value="5">
                            </div>
                        @else
                            @if (isset($theme))
                                <div class="form-group row">
                                    <input type="hidden" id="template_name" name="template_name"
                                        value="{{ $theme->theme_name }}">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="slug" name="slug" value="{{ $theme->slug }}">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="template_id" name="template_id" value="{{ $theme->id }}">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="category_id" name="category_id"
                                        value="{{ $theme->category_id }}">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="user_type" name="user_type" value="template">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="role_id" name="role_id" value="3">
                                </div>
                            @else
                                <div class="form-group row">
                                    <input type="hidden" id="template_name" name="template_name" value="">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="template_id" name="template_id" value="0">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="user_type" name="user_type" value="custom">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" id="role_id" name="role_id" value="1">
                                </div>
                            @endif
                        @endif
                        <div class="row">

                            <div class="col-md-12">
                                <h2 class="text-center color-blue">SIGN UP NOW</h2>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-custome">
                                    <input id="business_name" type="text"
                                        class="form-control @error('business_name') is-invalid @enderror"
                                        name="business_name" value="{{ old('business_name') }}"
                                        placeholder="Enter Business Name" required>
                                    @error('business_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-custome">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" placeholder="Enter First Name" autofocus required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-custome">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="Enter Last Name" autofocus>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-custome">
                                    <input type="hidden" id="countryCode" data-country="{{ $countryCodesmall }}"
                                        value="{{ $countryCode }}">
                                    <input id="country_selector" type="text"
                                        class="form-control @error('country') is-invalid @enderror" name="country">
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-custome number_select_custom">
                                    <input type="number" id="phoneField" name="phone_number" placeholder="Enter Number"
                                        data-maxlength="10"
                                        class="phone-field form-control  @error('number') is-invalid @enderror" required>
                                    @error('number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-custome">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter Email" name="email" value="{{ old('email') }}"
                                        autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-custome">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        data-maxlength="18" placeholder="Enter Password" autocomplete="new-password"
                                        required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-custome">
                                    <input id="referred_by" type="text"
                                        class="form-control @error('referred_by') is-invalid @enderror"
                                        name="referred_by" value="{{ old('referred_by') }}"
                                        placeholder="Referred By (optional)">
                                    @error('referred_by')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="pull-left">
                                        <div class="custom_checkbox">
                                            <label class="ch-checkbox">
                                                <input type="checkbox" name="checkbox" id="checkbox" required><span class="term-service_1"><i
                                                        class="ch-icon icon-tick"></i>I have read and agree to the</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pull-right forgot term-service_2">
                                        <a href="#">Terms of Service.</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6LebwX8dAAAAABIAbM52tMvhlktjrZGQMZvWPM3f"></div>
                                <span id="captcha" style="color:red"></span>
                            </div>

                            <div class="col-md-12">
                                <div class="btn-container mt-5 text-center">
                                    <button type="submit" class="btn-color btn-style">
                                        Sign up
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
