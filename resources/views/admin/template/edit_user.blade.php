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
      <div class="main-wrapper ">
      <div class="mainwrapper-main">
<div class="mainwrapper-pgs">
         <div class="main-container">
            <div class="main-container-inner">
<div class="smallmainwrapper_edit">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center table-heading">
                    <h2>Edit Custom User</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('template_user.update',$user->id)}}" name="registration">
                    
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="form-group">
                        <label class="pr-label" for="">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user->first_name}}" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label class="pr-label" for="">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user->last_name}}" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label class="pr-label" for="">Country</label><br>
                        <input id="country_selector" type="text" class="form-control" name="country" value="{{$user->country}}" style="width:100%;">
					</div>
                    <div class="form-group">
                        <label class="pr-label" for="">Number</label>
                        <input type="number" name="phone_number" placeholder="Enter Number" value="{{$user->number}}" class="phone-field form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label class="pr-label" for="">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror " name="email" id="email" value="{{$user->email}} "placeholder="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
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

@include('admin.template.partials.footer')