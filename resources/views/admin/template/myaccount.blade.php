@include('admin.template.partials.head')
@include('admin.template.partials.header')
<?php $theme_code = session('theme_code'); 

if($theme_code == 'yummy-restuarant_5ELQQ8'){
?>
   @include('admin.template.Food_Delivery.partials.sidemenu')
<?php
}
elseif($theme_code == 'car-wash_13MZEO'){
?>   
@include('admin.template.Booking.partials.sidemenu')
<?php
}
else{
?>   
   @include('admin.template.partials.sidemenu')
<?php   
} 
?>

<div class="main-home">
<div class="mainwrapper-main">
<div class="mainwrapper-pgs">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper-profile">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>My Account <a class="user_edit_btn" href="template_user/{{ Auth::user()->id }}/edit">
                    <i class="fa fa-pencil edit-icon" aria-hidden="true"></i>
                </a></h2>
                </div>
                <div class="card-body">
                    <ul class="userdetails">
                        <li>Name:<span>{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</span></li>
                        <li>Email:<span>{{ Auth::user()->email }}</span></li>
                        <li>Business Name:<span>{{ Auth::user()->business_name }}</span></li>
                        <li>Number:<span>{{ Auth::user()->number}}</span></li>
                        <li>Country:<span>{{ Auth::user()->country }}</span></li>
                    </ul>
                    <br>

                  

                  @if(Auth::user()->parent_id == 0)  
                  <a href="{{ URL::to('temp_new_user') }}" class="btn btn-success btn-swtch-temp float-right">Add New User</a>
                  @else
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

@include('admin.template.partials.footer')