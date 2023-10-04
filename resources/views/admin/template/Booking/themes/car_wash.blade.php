@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')
<!-- main start-->
<style>
span.theme-tab-number-green {
    padding: 4px;
    background: #fff;
    color: green;
    border-radius: 50px;
}
  
  span.theme-tab-number {
    background: green;
    color: #fff;
    border-radius: 50%;
    padding: 4px;
}
</style>
<main onload="checkCookie()">
   <div class="main-home">
      <div class="main-wrapper ">
         <div class="main-container">
            <div class="main-container-inner maininnerallpagescontainer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row owncard addprdctrow mt-20 addprdctrowmaintabs ">
                           <div class="col-md-12">
                              <div class="tab">

                                 @if ($splashscreen == NULL)
                                    <button id="splashscreen1" class="tablinks active" onclick="openCity(event, 'splashscreen') "><span class="theme-tab-number-w">1</span> Splash Screen  </button>
                                 @else
                                    <button id="splashscreen1" class="tablinks active template-tab-color" onclick="openCity(event, 'splashscreen') ">
                                      <span class="theme-tab-number-green">1</span> Splash Screen  </button>
                                 @endif

                                 @if ($tempsignupsetting == NULL)
                                 <button id="signup1" class="tablinks" onclick="openCity(event, 'signup')"><span class="theme-tab-number-w">2</span> Sign Up  </button>
                                 @else
                                 <button id="signup1" class="tablinks template-tab-color" onclick="openCity(event, 'signup')"><span class="theme-tab-number-green">2</span> Sign Up  </button>
                                 @endif

                                 @if ($temploginsetting == NULL)
                                 <button id="login1" class="tablinks" onclick="openCity(event, 'login')"><span class="theme-tab-number-w">3</span> Login  </button>
                                 @else
                                 <button id="login1" class="tablinks template-tab-color" onclick="openCity(event, 'login')"><span class="theme-tab-number-green">3</span> Login  </button>
                                 @endif

                                 <!-- @if(count($collections) == 0)
                                 <button id="home1" class="tablinks" onclick="openCity(event, 'home')"><span class="theme-tab-number-w">4</span> Home  </button>
                                 @else
                                 <button id="home1" class="tablinks template-tab-color" onclick="openCity(event, 'home')"><span class="theme-tab-number-green">4</span> Home  </button>
                                 @endif

                                 @if(count($products) == 0)
                                 <button id="add_prodcut1" class="tablinks" onclick="openCity(event, 'add_prodcut')"><span class="theme-tab-number-w">5</span> Add Product  </button>
                                 @else
                                 <button id="add_prodcut1" class="tablinks template-tab-color" onclick="openCity(event, 'add_prodcut')"><span class="theme-tab-number-green">5</span> Add Product </button>
                                 @endif -->

                                 <button id="my_account1" class="tablinks" onclick="openCity(event, 'rest_screens')">Other Screeens</button>

                              </div>

<!-------------------------------------============================  Add Product  ==========================----------------------------------------------->

<div id="add_prodcut" class="tabcontent">

</div>
<!-------------------------------------============================ Product End ==========================----------------------------------------------->


<!-------------------------------------============================  Splash Screen =============================----------------------------------------------->
<div id="splashscreen" class="tabcontent" style="display: block;">
   <div class="tab-content-inner">
      <div class="row">
         <div class="col-md-8 own-8-col">
            <div class="card-body m-t-20">
               <form enctype="multipart/form-data" name="car_splashscreen_form">
                  @csrf
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                  </div>
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                  </div>
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="template_name" name="template_name" value="{{$themetemplate->theme_name}}">
                  </div>

                  <div class="d-flex form-group formgrouplabel">
                     <label class="lbh">Upload Logo <a class="tooltip-btn" data-tooltip="Upload Image 1000 x 1000px" data-tooltip-location="right"> ?</a></label>                
                     <input id="inp1" type="file" accept="image/*" class="form-control car_splash_logo" name="splash_logo">
                     <label for="inp1" class="splogoinput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                     <div class="delete-box-cm" id="remove_logo_image" onClick="removecarlogoimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove logo image</div>
                  </div>

                  <div class="d-flex form-group formgrouplabel">
                     <label class="lbh">Splash Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1535 x 3600px" data-tooltip-location="right"> ?</a></label>
                     <input type="file" accept="image/*" id="inp2"  class="form-control car_splash_bg_image" name="splash_background_image" onchange="splshbgimgshow()">
                     <label for="inp2" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                     <div class="delete-box-cm" id="remove_splash_image" onClick="removecarsplashimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove splash image
                     </div>
                  </div>
                  <h6  class="text-left ortitle">Or</h6>
                  <div class="d-flex form-group">
                     <label class="lbh">Splash Background Color</label>
                     @if($splashscreen == NULL)
                     <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="#ffffff"> 
                     @else
                        @if($splashscreen->splash_background_color !== "#ffffff")
                        <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                        @else
                        <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                        @endif 
                     @endif
                  </div>
                  <div class=" form-group">
                     <button class="savebtn">Next</button>
                  </div>
               </form>
            </div>
         </div>
         <!--======  Splash Screen Preview =====-->                    
         <div class="col-md-4 own-4-col">
            <div class="preview-box">
               <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
               <div class="tutorial-video-box text-center">
                  <div class="tutorial-video-box-inner">
                     <div class="preview-right-main-wrapper">
                        @if(!isset($splashscreen))

                        <div class="splash-bgimage" id="splash_screen_bg">
                           <img class="splashbg" src="{{asset('template/images/car_wash/splashcar1.png')}}" id="splash_bg" alt="eyeimage" >
                           <img class="applogoimg preview" src="{{asset('template/images/car_wash/carwash1.png')}}" id="splash_logo" alt="eyeimage">
                        </div>

                        @else

                           @if($splashscreen->splash_background_color == "#ffffff" && !is_null($splashscreen->splash_background_image))
                           <div class="splash-bgimage" id="splash_screen_bg">
                              <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" >
                              @if($splashscreen->splash_logo == NULL)
                                 <img class="applogoimg preview" src="{{asset('template/images/car_wash/carwash1.png')}}" id="splash_logo" alt="eyeimage">   
                              @else
                                 <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                              @endif
                           <div> 
                           @else

                           <div class="splash-bgimage" id="splash_screen_bg" style="background-color:{{$splashscreen->splash_background_color}};">
                              <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" style="display:none;" >

                              @if($splashscreen->splash_logo == NULL)   
                                 <img class="applogoimg preview" src="{{asset('template/images/car_wash/carwash1.png')}}" id="splash_logo" alt="eyeimage">
                              @else 
                                 <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                              @endif

                           </div>
                           @endif

                        @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-------------------------------------============================  Splash Screen End ==========================----------------------------------------------->
                              

<!-------------------------------------============================  Login  ==========================----------------------------------------------->

<div id="login" class="tabcontent">

   <div class="tab-content-inner">
      <div class="row">
         <div class="col-md-8 own-8-col">
            <div class="left-template-bx">
               <div class="card-body m-t-20">
                  <form  method ="POST" action="{{route('theme.loginscreen')}}" enctype="multipart/form-data" name="login_form">
                     @csrf
                     <div class="form-group">
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                     </div>
                     <div class="form-group">
                        <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                     </div>
                     <div class="d-flex form-group formgrouplabel">
                        
                        <label class="lbh">Login Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1500 x 2000px" data-tooltip-location="right"> ?</a></label>
                        <input type="file" accept="image/*" id="inp3"  class="form-control login_bg_img" name="login_bg_image">
                        <label for="inp3" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                        <div class="delete-box-cm" id="remove_login_image" onClick="removecarloginimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove image</div>
                        
                     </div>
                     @if($temploginsetting == NULL)
                     <div class="d-flex form-group formgrouplabel">
                        <label class="lbh">Login Background Color </label>
                        <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="#ffffff">                     
                     </div>
                     <div class="d-flex form-group">
                        <label class="lbh">Login Button Color</label>
                        <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="#343a40">                     
                     </div>
                     @else
                     <div class="d-flex form-group">
                        <label class="lbh">Login Background Color</label>
                        <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="{{$temploginsetting->login_bg_color}}">                     
                     </div>
                     <div class="d-flex form-group">
                        <label class="lbh">Login Button Color</label>
                        <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="{{$temploginsetting->login_btn_color}}">                     
                     </div>
                     @endif
                     <div class="d-flex form-group">
                        <label class="lbh">Font Size</label>
                        <select  id="login_dropdown" onchange="logindropshow()" type="text" name="login_btn_font_size" placeholder="select Font Size">
                        @if($temploginsetting == NULL)
                           <option value="20" >20px</option>
                              <option value="18">18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                           @elseif($temploginsetting->login_btn_font_size !== "16")
                              <option value="20" {{$temploginsetting->login_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                              <option value="18" {{$temploginsetting->login_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                              <option value="16" {{$temploginsetting->login_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                              <option value="14" {{$temploginsetting->login_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                              <option value="12" {{$temploginsetting->login_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                           </select>
                           @else
                           <option value="20" >20px</option>
                              <option value="18" >18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                        @endif
                     </div>
                     <div class=" form-group">
                        <button class="savebtn" type="submit">Next</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <!----====== Login Preview =====---->

         <div class="col-md-4 own-4-col">
         <div class="preview-box">
            <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
            <div class="tutorial-video-box text-center">

                  @if(!isset($tempsignupsetting))
                  <div class="tutorial-video-box-inner" id="back_image">
                  @else
                  <div class="tutorial-video-box-inner" id="back_image" style="background-color:{{$tempsignupsetting->login_bg_color}};">
                  @endif

                              <div class="preview-right-main-wrapper loginsign-ecom">
                                 <div class="splash-bgimage">
                                    <div class="ecom-6-beauty-sign">
                                       <div class="carwash-1-form-grp-container carwash-1-form-mr">
                              <div class="carwash-1-top-image">

                                 @if(!isset($temploginsetting))
                                                <img id="login_image" src="{{asset('template/images/car_wash/car-wash-img.png')}}">
                                                @elseif($temploginsetting->login_bg_image == NULL)
                                                <img id="login_image" src="{{asset('template/images/car_wash/car-wash-img.png')}}">
                                                @else
                                                <img id="login_image" src="{{asset($temploginsetting->login_bg_image)}}">
                                                @endif

                                 <img class="img-btmcrwsh" src="{{asset('template/images/car_wash/car-wash-topimg-after1.png')}}">

                                 </div>
                                 <div class="form-group carwash-1-email-group">
                                    <label class="carwash1">Email</label>
                                    <div class="carwash-1-group-icn-inp">
                                       <input class="form-cantrol" type="email" placeholder="Enter Email">
                                    </div>
                                 </div>
                                 <div class="form-group carwash-1-password-group">
                                    <label class="carwash1">Password</label>
                                    <div class="carwash-1-group-icn-inp">
                                       <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                    </div>
                                 </div>
                                 <p class="carwash-1-crate-forgotpass"><a class="cor-1-crate-acount" href="#">Forgot Password?</a></p>
                  
                                 <div class="form-group carwash-1-email-group">

                                 @if(!isset($temploginsetting))
                                    <button type="button" id="login_button" class="carwash-1-right-button ecom-5-logo-inbtn ecom-mt-20" href="#">Log In</button>
                                 @else
                                    <button type="button" id="login_button" class="carwash-1-right-button ecom-5-logo-inbtn ecom-mt-20" href="#" style="background-color:{{$temploginsetting->login_btn_color}}; font-size:{{$temploginsetting->login_btn_font_size}}px;">Log In</button>
                                 @endif   
                                 </div>
                                 <p class="carwash-1-crate-acount-p">Create a new account? <a class="cor-1-crate-acount" href="#">Sign Up</a></p>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </div>
   </div>

</div>
<!-------------------------------------============================  Login End  ==========================----------------------------------------------->


<!-------------------------------------============================  Sign Up ==========================----------------------------------------------->
   <div id="signup" class="tabcontent">
      <div class="tab-content-inner">
         <div class="row">
            <div class="col-md-8 own-8-col">
               <div class="left-template-bx">  
               <div class="card-body m-t-20">
                  <form  method ="POST" action="{{route('theme.signupscreen')}}" enctype="multipart/form-data" name="signup_form">
                     @csrf
                     <div class="form-group">
                           <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                     </div>
                     <div class="form-group">
                           <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                     </div>
                     <div class="d-flex form-group formgrouplabel">
                           <label class="lbh">SignUp Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1500 x 2000px" data-tooltip-location="right"> ?</a></label>
                           <input type="file" accept="image/*" id="inp4"  class="form-control signup_bg_img" name="signup_bg_image">
                           <label for="inp4" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                           <div class="delete-box-cm" id="remove_signup_image" onClick="removecarsignupimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove image
                     </div>

                     </div>
                     @if($tempsignupsetting == NULL)
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Background Color</label>
                              <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="#ffffff">                     
                     </div>
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Button Color</label>
                              <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="#343a40">                     
                     </div>
                     @else
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Background Color</label>
                              <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="{{$tempsignupsetting->signup_bg_color}}">                     
                     </div>
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Button Color</label>
                              <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="{{$tempsignupsetting->signup_btn_color}}">                     
                     </div>
                     @endif
                     <div class="d-flex form-group">
                     <label class="lbh">Font Size</label>
                           <select  id="signup_dropdown" onchange="signupdropshow()" type="text" name="signup_btn_font_size" placeholder="select Font Size">
                           @if($tempsignupsetting == NULL)
                           <option value="20" >20px</option>
                              <option value="18">18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                           @elseif($tempsignupsetting->signup_btn_font_size !== "16")
                              <option value="20" {{$tempsignupsetting->signup_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                              <option value="18" {{$tempsignupsetting->signup_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                              <option value="16" {{$tempsignupsetting->signup_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                              <option value="14" {{$tempsignupsetting->signup_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                              <option value="12" {{$tempsignupsetting->signup_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                           </select>
                           @else
                           <option value="20" >20px</option>
                              <option value="18" >18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                        @endif

                     </div>

                     @if(!is_null($tempsignupsetting))

                     @if($tempsignupsetting->status !== 0)

                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="1" name="signup_status" checked>
                        <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                     </div>

                     @else
                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                        <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                     </div>
                     @endif

                     @else
                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                        <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                     </div>
                     @endif

                     <div class=" form-group">
                        <button class="savebtn" type="submit">Next</button>
                     </div>
                     
                  </form>
               </div>  
               </div>
            </div>

            <!----====== Signup Preview =====---->

            <div class="col-md-4 own-4-col ">
            <div class="preview-box">
               <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
               <div class="tutorial-video-box text-center" >


               @if(!isset($tempsignupsetting))
               <div class="tutorial-video-box-inner" id="signup_back_color">
               @else
               <div class="tutorial-video-box-inner" id="signup_back_color" style="background-color:{{$tempsignupsetting->signup_bg_color}};">
               @endif

                     <div class="preview-right-main-wrapper loginsign-ecom">
                        <div class="splash-bgimage">
                     <div class="ecom-6-beauty-sign">                              
                     <div class="carwash-1-form-grp-container carwash-1-form-mr">
                     <div class="carwash-1-top-image">

                     @if(!isset($tempsignupsetting))
                     <img id="signup_back" src="{{asset('template/images/car_wash/car-wash-img.png')}}">
                     @elseif($tempsignupsetting->signup_bg_image == NULL)
                     <img id="signup_back" src="{{asset('template/images/car_wash/car-wash-img.png')}}">
                     @else
                     <img id="signup_back" src="{{asset($tempsignupsetting->signup_bg_image)}}">
                     @endif

                     <img class="img-btmcrwsh" src="{{asset('template/images/car_wash/car-wash-topimg-after1.png')}}">

                     </div>
                                    <div class="form-group carwash-1-email-group">
                        <label class="carwash1">Full Name</label>
                                       <div class="carwash-1-group-icn-inp">
                                          <input class="form-cantrol" type="text" placeholder="Enter Full Name">
                                       </div>
                                    </div>
                                    <div class="form-group carwash-1-email-group">
                        <label class="carwash1">Email</label>
                                       <div class="carwash-1-group-icn-inp">
                                          <input class="form-cantrol" type="email" placeholder="Enter Email">
                                       </div>
                                    </div>
                                    <div class="form-group carwash-1-password-group">
                     <label class="carwash1">Password</label>
                                       <div class="carwash-1-group-icn-inp">
                                          <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                       </div>
                                    </div>
                                    <div class="form-group carwash-1-email-group">
                     <label class="carwash1">Phone Number</label>
                                       <div class="carwash-1-group-icn-inp">
                                          <input class="form-cantrol" type="text" placeholder="Enter Mobile Number">
                                       </div>
                                    </div>
                     
                                    <div class="form-group carwash-1-email-group">

                                    @if(!isset($tempsignupsetting))
                                    <button type="button" id="signup_button" class="carwash-1-right-button ecom-5-logo-inbtn ecom-mt-20" href="#">Sign Up </button>
                                    @else
                                       <button type="button" id="signup_button" class="carwash-1-right-button ecom-5-logo-inbtn ecom-mt-20" href="#" style="background-color:{{$tempsignupsetting->signup_btn_color}}; font-size:{{$tempsignupsetting->signup_btn_font_size}}px;">Sign Up </button>
                                    @endif
                                    </div>

                                    <p class="carwash-1-crate-acount-p">Have an account?<a class="cor-1-crate-acount" href="#"> Log In</a></p>
                                 </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
</div>
<!-------------------------------------============================  Sign Up End ==========================----------------------------------------------->



<!-------------------------------------============================  Home Screen ==========================----------------------------------------------->
      <div id="home" class="tabcontent">
         <div class="tab-content-inner">
            <div class="row">
            <!--====== Add Collection =====-->  
               <div class="col-md-8 own-8-col">
                  <div class="row card owncard addprdctrow">
                     <div class="col-md-12">
                     <h2 class="add_title mb-30">Add Collections <a class="tooltip-btn" data-tooltip="Here you can upload your categories" data-tooltip-location="right"> ?</a></h2>
                        <form class="p-10" method="POST" action="{{route('theme.collections.store')}}" enctype="multipart/form-data" >
                        
                           @csrf
                           <div class="form-group">
                              <label class="pr-label" for="exampleInputEmail1">Collection Name:</label>
                              <input type="text" class="form-control @error('collection_name') is-invalid @enderror" id="collection_names" name="collection_name" placeholder="Collection Name" required>
                              @error('collection_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror 
                           </div>
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="slugs" name="slug">
                           </div>
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                           </div>
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                           </div>
                           <!-- <div class="form-group">
                              <label class="pr-label" for="exampleInputPassword1">Collection Description:</label>
                              <textarea class="form-control" id="collection_description" name="collection_description" rows="3" placeholder="Collection Description"></textarea>
                           </div> -->
                           <div class="form-group">
                              <label class="pr-label" for="exampleInputPassword1">Collection Image: <a class="tooltip-btn" data-tooltip="Upload image 150x120 px" data-tooltip-location="right"> ?</a></label>

                              <input id="collection_image" type="file" accept="image/x-png" class="form-control imagee" name="collection_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                              <label for="collection_image" class="splogoinput"> <i class="fa fa-upload" aria-hidden="true" ></i> Upload </label>
                              <!-- <input type="file" accept="image/*" onchange="loadFile(event)"> -->
                              <img id="blah"/>
                           </div>
                           <div class="form-group">
                           <button type="submit" class="btn btn-primary">Add Collection</button>
                           @if(count($collections) > 0)
                           <button class="savebtn" id="add_prodcut1" onclick="openCity(event, 'add_prodcut')">Next</button>
                           @endif
                           </div>
                        </form>
                     </div>
                  </div>

                  
               </div>

               <!--======  home Screen Preview =====-->  

               <div class="col-md-4 own-4-col">
                  <div class="preview-box">
                     <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                     <div class="tutorial-video-box">
                        <div class="app-preview cor-1-app-preview cor-1-group-container">
                           <div class="app-preview-inner">
                              <div id="back_image" class="e-com-1-background-color-ver"></div>
                              <div class="p-mobile-header">
                                 <i class="fa fa-bars tglimg" aria-hidden="true"></i>

                                 @if(!isset($splashscreen))
                                 <img class="logoprv preview" id="preview" src="{{asset('asset/images/preview/logoprv.png')}}" alt="logo"> 
                                 @elseif ($splashscreen->splash_logo == NULL)
                                 <img class="logoprv preview" id="preview" src="{{asset('asset/images/preview/logoprv.png')}}" alt="logo">
                                 @else
                                 <img class="logoprv preview" id="preview" src="{{asset($splashscreen->splash_logo)}}" alt="logo"> 
                                 @endif 

                                 <i class="fa fa-search srchicn" aria-hidden="true"></i>
                                 <i class="fa fa-heart-o hicn" aria-hidden="true"></i>
                                 <span class="cardcount text-center">5</span>
                              </div>
                              <div class="ecom-1-home-preview-container">
                                 <div class="ecom-1-home-container">
                                    

                                    @if(count($collections) == 0)

                                    <div class="ecom-1-home-box d-flex">
                                       <h4 class="w-50">Home</h4>
                                       <p class="w-50 text-right"><i class="fa fa-home" aria-hidden="true"></i></p>
                                    </div>
                                    <div class="ecom-2-home-box d-flex">
                                       <h4 class="w-50">New In</h4>
                                       <p class="w-50 text-right"><img class="ecom-1homeimg" src="{{asset('images/cloaths.png')}}" alt="logo"> </p>
                                    </div>
                                    <div class="ecom-2-home-box d-flex">
                                       <h4 class="w-50">Coats</h4>
                                       <p class="w-50 text-right"><img class="ecom-1homeimg" src="{{asset('images/coats.png')}}" alt="logo"> </p>
                                    </div>
                                    <div class="ecom-2-home-box d-flex">
                                       <h4 class="w-50">Tops</h4>
                                       <p class="w-50 text-right"><img class="ecom-1homeimg" src="{{asset('images/tops.png')}}" alt="logo"> </p>
                                    </div>
                                    <div class="ecom-2-home-box d-flex">
                                       <h4 class="w-50">Sweaters</h4>
                                       <p class="w-50 text-right"><img class="ecom-1homeimg" src="{{asset('images/sweaters.png')}}" alt="logo"> </p>
                                    </div>

                                    @else

                                       @foreach($collections as $collection)
                                       <div class="ecom-2-home-box d-flex">
                                          <h4 class="w-50">{{$collection->collection_name}}</h4>

                                          @if(!isset($collection->collection_image))
                                          <p class="w-50 text-right"><i class="fa fa-snowflake-o" aria-hidden="true"></i></p>
                                          
                                          @else
                                          <p class="w-50 text-right"><img class="ecom-1homeimg" src="{{config('services.base_url').$collection->collection_image}}" alt="logo"> </p>
                                          @endif
                                          
                                          
                                       </div>
                                       @endforeach

                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--======  Collections Table =====-->  
             
                  <div class="col-md-12 no-padding mt-40">
                        <div class="card card-own table-wrapper">
                           <div class="card-header text-center table-heading mb-40">
                              <h2>Collections</h2>
                           </div>
                           <div class="card-body m-t-20">
                              <table class="table table-bordered table-striped table-main" id="collections">
                                 <thead>
                                    <tr>
                                       <th class="text-center" scope="col" colspan="1"><a href="#" class="" >#</a></th>
                                       <th class="text-center" scope="col" colspan="1"><a href="#" class="">Title</a></th>
                                       <th scope="col" class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($collections as $collection)
                                    <tr>
                                    <td class="pd-2 text-center" scope="col">{{$loop->iteration}}</td>
                                       <td class="pd-2 text-center" scope="col">{{$collection->collection_name}}</td>
                                       <td class="text-center">
                                          <a href="{{ route('theme.collections.edit',$collection->id)}}"  class="btnedit" id="edit" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <a onclick="deleteData('{{route('theme.collections.destroy',$collection->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
            </div>
         </div>
      </div>                  
   </div>
</div>

<!-------------------------------------============================  My Account  ==========================----------------------------------------------->

<div id="rest_screens" class="tabcontent">
   <div class="tab-content-inner">
      <div class="row justify-content-center">
         <!--====== Add Collection =====-->  
         
         <!--======  home Screen Preview =====-->  
         <div class="col-md-4 own-4-col allscreensaslidercol-4">
            <div class="preview-box">
               <h3 class="app_screens_title">App Screens</h3>
               <div class="tutorial-video-box">
                  <div class="app-preview cor-1-app-preview cor-1-group-container appallscreenpreview">
           

                     <div id="theme-showcase-all" class="app-showcase-main owl-carousel">
                     <div class="theme-slide-itm">
                     <img class="appfrm appscreenprewe " src="{{asset('template/images/car_wash/7.png')}}"alt="">
                     </div>
                     <div class="theme-slide-itm">
                     <img class="appfrm appscreenprewe " src="{{asset('template/images/car_wash/8.png')}}" alt="">
                     </div>
                     <div class="theme-slide-itm">
                     <img class="appfrm appscreenprewe" src="{{asset('template/images/car_wash/9.png')}}" alt="">
                     </div>
                     <div class="theme-slide-itm">
                     <img class="appfrm appscreenprewe" src="{{asset('template/images/car_wash/14.png')}}" alt="">
                     </div>
                     </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>




</div>
   </div>
      </div>
         </div>
         </div>
      </div>
   </div>
</main>
   <!-- Modal -->
   <div class="modal fade popup-template-modal" id="splash_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>First screen users see when they open your App. This screen appears for a couple seconds.</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="signup_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="login_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
  <div class="modal fade popup-template-modal" id="home_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The first screen a users will view after logging in</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
  <div class="modal fade popup-template-modal" id="account_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The screen will show a users Account section</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
  <div class="modal fade popup-template-modal" id="wishlist_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The screen will show a users Wish List </h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="checkout_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>This screen will show a users Checkout Screen </h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="payment_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>This screen will show a users Payment Screen</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="add_product_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>List your products with variants of color and size if required </h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>



<script>

function openCity(evt, cityName) { 

   if(cityName == "splashscreen"){

      var screen1 = $.cookie("splashscreen");
 
      if(screen1 == undefined)
      {

         $('body').find('#splash_screen').modal('show');
         $.cookie("splashscreen", 1);

      }else(screen1 == 1)
      {
         $('body').find('#splash_screen').modal('hide');
      }
       
   }
   else if(cityName == "signup"){

      var screen2 =  $.cookie("signup");

      if(screen2 == undefined)
      {
         $('body').find('#signup_screen').modal('show');
         $.cookie("signup", 1);

      }else(screen2 == 1)
      {

         $('body').find('#signup_screen').modal('hide');

      }

   }
   else if(cityName == "login"){

      var screen3 =  $.cookie("login");

      if(screen3 == undefined)
      {
         $('body').find('#login_screen').modal('show');
         $.cookie("login", 1);

      }else(screen3 == 1)
      {
         $('body').find('#login_screen').modal('hide');
      }   

   }

   else if(cityName == "home"){

      var screen4 =  $.cookie("home");

      if(screen4 == undefined)
      {

      $('body').find('#home_screen').modal('show');
      $.cookie("home", 1);

      }else(screen4 == 1)
      {

         $('body').find('#home_screen').modal('hide');

      } 

   }
   else if(cityName == "add_prodcut"){

      var screen5 =  $.cookie("add_prodcut");

      if(screen5 == undefined)
      {

         $('body').find('#add_product_screen').modal('show');
         $.cookie("add_prodcut", 1);

      }else(screen5 == 1)
      {

         $('body').find('#add_product_screen').modal('hide');

      } 

   }
   else if(cityName == "my_account"){

      var screen6 =  $.cookie("my_account");

      if(screen6 == undefined)
      {

      $('body').find('#account_screen').modal('show');

      $.cookie("my_account", 1);

      }else(screen6 == 1)
      {

         $('body').find('#account_screen').modal('hide');

      } 

   }
   else if(cityName == "wishlist"){

      var screen7 =  $.cookie("wishlist");

      if(screen7 == undefined)
      {
      $('body').find('#wishlist_screen').modal('show');
      $.cookie("wishlist", 1);

      }else(screen7 == 1)
      {

         $('body').find('#wishlist_screen').modal('hide');

      } 

   }
   else if(cityName == "checkout"){

      var screen8 =  $.cookie("checkout");

      if(screen8 == undefined)
      {

         $('body').find('#checkout_screen').modal('show');
         $.cookie("checkout", 1);

      }else(screen8 == 1)
      {
         
         $('body').find('#checkout_screen').modal('hide');

      } 

   }
   else if(cityName == "payment"){

      var screen9 =  $.cookie("payment");

      if(screen9 == undefined)
      {

      $('body').find('#payment_screen').modal('show');
      $.cookie("payment", 1);

      }else(screen9 == 1)
      {
         
         $('body').find('#payment_screen').modal('hide');

      } 

   }
  
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   document.getElementById(cityName).style.display = "block";
   evt.currentTarget.className += " active";
   document.cookie = "cityName="+cityName+"1; expires=Thu, 18 Dec 2090 12:00:00 UTC; path=/";
}

document.addEventListener("DOMContentLoaded", function(event){
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   var selectedCity = getCookie("cityName");
   if(selectedCity){
      var result = selectedCity.match(/[^\d]+|\d+/g);
      if(result[0] != ""){
        document.getElementById(result[0]).style.display = "block";
        document.getElementById(selectedCity).className+= " active";
      } else {
         document.getElementById('splashscreen').style.display = "block";
         document.getElementById('splashscreen1').className+= " active"
      }
    } else {
         document.getElementById('splashscreen').style.display = "block";
         document.getElementById('splashscreen1').className+= " active"
   }
});
   
function getCookie(cname) {
       var name = cname + "=";
       var decodedCookie = decodeURIComponent(document.cookie);
       var ca = decodedCookie.split(';');
       for(var i = 0; i <ca.length; i++) {
           var c = ca[i];
           while (c.charAt(0) == ' ') {
               c = c.substring(1);
           }
           if (c.indexOf(name) == 0) {
               return c.substring(name.length, c.length);
           }
       }
       return "";
   }    
         
</script>

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>


<!--Category Delete Modal here -->

<div id="myModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteForm">
            @csrf
            {{ method_field('DELETE') }}
            <div class="modal-body">
               <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!--Category Delete Modal End here -->

<!--Product Delete Modal here -->

<div id="myProductModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteProductForm">
            @csrf
            {{ method_field('DELETE') }}
            <div class="modal-body">
               <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!--Product Delete Modal End here -->

@include('admin.template.partials.footer')
<script>
$('#signup_status').on('click' , function(){

   $('#signup_status').val('0');

   if($('#signup_status').is(":checked")){

      $('#signup_status:checked').val('1');

   }else{

      $('#signup_status').val('0');
   } 
});

/* --------------------------=========================  Splash Screen =======================----------------------- */

// Splash Logo

$(".car_splash_logo").change(function (e) {
    $('#remove_logo_image').show();
    url = URL.createObjectURL(e.target.files[0]),
    $(".preview").attr("src",url);
    console.log(url);
});

function removecarlogoimg() {
document.getElementById("splash_logo").src = "{{asset('template/images/car_wash/carwash1.png')}}";
$('#remove_logo_image').hide();
$('#inp1').val('');
}

// Splash BG Color

function splshbgshow() {

$('.splashbg').hide();
var x = document.getElementById("splash_bg_color").value;
document.getElementById("splash_screen_bg").style.backgroundColor = x;
document.getElementById("inp2").value = "";

}
function splshbgimgshow() {
  $('.splashbg').show();
  document.getElementById("splash_bg_color").value = "#ffffff";
}
function splshbgshopimgshow() {
  $('.e-com-3-splashbg').show();
  document.getElementById("splash_bg_color").value = "#ffffff";
}
// Splash BG Image

$(".car_splash_bg_image").change(function (e) {
    $('#remove_splash_image').show();
    $('#splash_bg').show();
    url = URL.createObjectURL(e.target.files[0]),
    $("#splash_bg").attr("src",url);
    console.log(url);
});

// Remove Splash BG Image

function removecarsplashimg() {
  document.getElementById("splash_bg").src = "{{asset('template/images/car_wash/splashcar1.png')}}";
  $('#remove_splash_image').hide();
}

/* --------------------------=========================  Splash Screen End =======================----------------------- */

/* --------------------------=========================  signup Screen =======================----------------------- */

// Remove signup Image

function removecarsignupimg() {
   return "dsds";
   document.getElementById("signup_back").src = "{{asset('template/images/car_wash/car-wash-img.png')}}";
   $('#remove_signup_image').hide();
   $('#inp4').val('');
}

/* --------------------------=========================  signup Screen End =======================----------------------- */

/* --------------------------=========================  Login Screen =======================----------------------- */

$("#inp3").change(function (e) {
   alert('dgdfhgf');
   $('.loginsignbg').css("display", "block");
   $('#remove_login_image').show();
   url = URL.createObjectURL(e.target.files[0]),
   $("#login_image").attr("src",url);
   console.log(url);
});

// Remove login Image

function removeloginimg() {
document.getElementById("login_image").src = "{{asset('images/econ-1-top-bg.png')}}";
$('#remove_login_image').hide();
$('#inp3').val('');
}

function loginbgshow() {
var x = document.getElementById("login_bg_color2").value;

$('.loginsignbg').css("display", "none");

document.getElementById("back_image").style.backgroundColor = x;
document.getElementById("login_image1").style.backgroundColor = x;
document.getElementById("login_image2").style.backgroundColor = x;
}

function loginbtnshow() {
var x1 = document.getElementById("login_bg_color1").value;
document.getElementById("login_button").style.backgroundColor = x1;
}

const logindropshow = () => {

var x = document.getElementById("login_dropdown").value;
if(x==='20'){
document.getElementById("login_button").style.fontSize = '20px';}
else if (x==='18'){
document.getElementById("login_button").style.fontSize = '18px';}
else if(x==='16'){
document.getElementById("login_button").style.fontSize = '16px';}
else if (x==='14'){
document.getElementById("login_button").style.fontSize = '14px';}
else if (x==='12'){
document.getElementById("login_button").style.fontSize = '12px';}
}

/* --------------------------=========================  Login Screen End =======================----------------------- */


</script>