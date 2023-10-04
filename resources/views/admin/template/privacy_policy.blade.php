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
   <div class="payment-wrapper">
      <div class="payment-wrapper-inner">
         <div class="container-fluid">
            <div class="row">
            <div class="shippping_details">
                <div class="row">
                    <div class="col-lg-12">
                    <h2 class="add_title mb-30 main-title-top" >Add Privacy Policy <a class="tooltip-btn" data-tooltip="Here you can add privacy policy content" data-tooltip-location="right"> ?</a></h2>
                    <form method="post" action="">
                        <form method="POST" action="{{route('theme.privacypolicy.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            @if(Auth::user()->parent_id == 0)  
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                  @else
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
                  @endif                            </div>
                            <div class="form-group">
                            <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                            </div>
                            <div class="form-group">
                            <label class="pr-label" for="exampleInputEmail1">Policy Content:</label>
                            <textarea class="form-control publish-textarea" id="privacy_content" name="privacy_content" placeholder="Enter Content" rows="4" required></textarea>
                        </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        <form>
                        </form>
                    </div>
                </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.template.partials.footer')
