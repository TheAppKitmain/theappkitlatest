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
<div class="main-container">
   <div class="main-container-inner  mt-40">
      <div class="container-fluid">
         <div class="row clearfix text-left ">
            <div class="col-md-12">
               <div class="row card owncard">
                  <div class="col-md-12">
                   <h2 class="add_title">Edit Stripe Credential</h2>

                    <form method ="POST" action="{{route('theme.updatestripe',$stripe->id)}}" enctype="multipart/form-data" id="stripe_validation">
                     @csrf
                     <div class="form-group">
                     @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="owner_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="owner_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                     </div>

                     <div class="form-group">
                        <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Stripe key</label>
                        <input type="text" name="stripe_key" class="form-control" value="{{ $stripe->stripe_key }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Stripe secret</label>
                        <input type="text" name="stripe_secret" class="form-control" value="{{ $stripe->stripe_secret }}" required>
                     </div>

                           <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('admin.template.partials.footer')

