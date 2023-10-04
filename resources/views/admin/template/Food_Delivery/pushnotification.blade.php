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
<div class="main-home push-notification-page">
   <div class="main-container">
      <div class="main-container-inner">
         <div class="container-fluid">
            <div class="row clearfix">
               <div class="col-md-12">
                  <div class="card card-own table-wrapper">
                     <div class="card-header text-center table-heading">
                        <h2>Notifications</h2>
                     </div>
                     <div class="card-body m-t-20">
                        <form method ="POST" action="{{route('theme.manage_food_notification')}}" name="registration">
                           @csrf
                           <div class="form-group">
                           @if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif                            </div>

                           <div class="form-group">
                              <label class="pr-label" for="exampleInputEmail1">Send To (all or select)</label>
                              <select id="select_user_type"  type="text"  class="form-control publish-textarea" name="select_user_type">
                                    <option selected value="1">Send To all</option>
                                    <option value="2">Send From List</option>
                              </select>
                           </div>

                           <div class="form-group hidden" id="select_customers_form">
                              <label class="pr-label" for="exampleInputEmail1">Select Customers</label>
                              <select id="select_customers" multiple="multiple"  type="text" placeholder="select customers"  style="width:100%;" class="form-control" name="select_customers[]">
                                    @foreach($all_users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                              </select>
                           </div>

                            <div class="form-group">
                            <label class="pr-label" for="exampleInputEmail1">Notification Title:</label>
                                 <input type="text" class="form-control publish-textarea" name="notify_title" placeholder="Enter Title" id="notify_title">
                            </div>


                           <div class="form-group">
                              <label class="pr-label" for="exampleInputEmail1">Notification Body:</label>
                              <textarea class="form-control publish-textarea" id="notify_message" name="notify_message" placeholder="Enter Message" rows="4" required></textarea>
                           </div>

                           <div class="form-group">
                              <button type="submit" class="btn btn-primary">Send</button>
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
@include('admin.template.partials.footer')

<script>

$("#select_customers").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})

'use strict';


document.querySelector('#select_user_type').addEventListener('change', function() {

   
   var element = document.getElementById("select_customers_form");

   if(this.value == 2){    
      element.classList.remove("hidden");
   }else{
      element.classList.add("hidden");
   }


});




</script>