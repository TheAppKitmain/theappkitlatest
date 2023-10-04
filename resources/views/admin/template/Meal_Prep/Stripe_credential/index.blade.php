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
                  <div class="card card-own">
                     <div class="card">
                        <div class="card-header">
                           <h3>Stripe Credentials</h3>
                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                           <thead>
                              <tr>
                                 <th>Id</th>
                                 <th>Stripe key</th>
                                 <th>Stripe Secret</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($stripes as $stripe)
                              <tr onclick="location.href=">
                                 <td>{{$stripe->id}}</td>
                                 <td>{{$stripe->stripe_key}}</td>
                                 <td>{{$stripe->stripe_secret}}</td>
                                 <td>
                                    <a href="{{route('theme.editstripe',$stripe->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a onclick="deletethemeData('{{route('theme.destroystripe',$stripe->id)}}')" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
<div id="mytemplateModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>

         <form method="POST" action="" id="deletetemplateForm">
            @csrf
            {{ method_field('Post') }}
            <div class="modal-body">
               <p>Do you really want to delete this Stripe? This process cannot be undone.</p>
            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>
@include('admin.template.partials.footer')
 <script>
   function deletethemeData(url){
           $("#deletetemplateForm").attr('action', url);
           $('#mytemplateModal').modal();
       }
</script>
