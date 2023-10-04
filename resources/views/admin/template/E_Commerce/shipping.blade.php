@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner ">
               <div class="container-fluid">
                  <div class="row">        
                    <div class="shippping_details">
                        <div class="row">
                           <div class="col-lg-12">
                           <h2 class="add_title mb-30 main-title-top" >Add Shipping Details <a class="tooltip-btn" data-tooltip="Here you can add shippings details" data-tooltip-location="right"> ?</a></h2>
                           <form method="post" action="">
                              <form method="POST" action="{{route('theme.shipping.store')}}" enctype="multipart/form-data">
                                 @csrf
                                 <div class="form-group">
                                 @if(Auth::user()->parent_id == 0)  
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                  @else
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
                  @endif                                 </div>
                                 <div class="form-group">
                                    <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                                 </div>
                                 <div class="form-group">
                                    <input type="hidden" class="form-control" name="country" id="country" value="{{Auth::user()->country}}">
                                 </div>
                                 <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                       <input type="text" name="shipping_name[]" class="form-control m-input" placeholder="E.g - First Class / Next Day" autocomplete="off" required>
                                       @if(Auth::user()->country == 'United Kingdom')
                                       <div class="form-group-cur shipng-input-grp">
                                       <input type="number" name="shipping_price[]" class="form-control m-input " placeholder="Shipping Price" autocomplete="off" required>
                                       <img class="cur-img cur_pound" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                       </div>
                                       @else
                                       <div class="form-group-cur shipng-input-grp">
                                       <input type="number" name="shipping_price[]" class="form-control m-input " placeholder="Shipping Price" autocomplete="off" required>
                                       <img class="cur-img" src="{{asset('images/cur-1.png')}}" alt="right-mobile">
                                       </div>
                                       @endif
                                       <div class="input-group-append">                
                                             <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                       </div>
                                    </div>

                                 </div>
                                 <div id="newRow">   </div>
                                 <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                                 <button type="submit" class="btn btn-primary">Save</button>
                              <form>
                              </form>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-12 no-padding mt-40">
                        <div class="card card-own table-wrapper">
                           <div class="card-header text-center table-heading">
                              <h2>Shippings</h2>
                           </div>
                           <div class="card-body mt-20">
                              <table id="example" class="table table-bordered table-striped table-main" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Shipping Name</th>
                                       <th>Shipping Price</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($shippings as $shipping)  
                                    <tr>
                                       <td class="pd-2" scope="col">{{$shipping->shipping_name}}</td>
                                       @if(Auth::user()->country == 'United Kingdom')
                                       <td class="pd-2"><img  class="shipping_pound" src="{{asset('images/cur-2.png')}}" alt="right-mobile">{{$shipping->shipping_price}}</td>
                                       @else
                                       <td class="pd-2"><img  class="shipping_dollar" src="{{asset('images/cur-1.png')}}" alt="right-mobile">{{$shipping->shipping_price}}</td>
                                       @endif
                                       <td class="text-center">    
                                          <a href="{{ route('theme.shipping.edit',$shipping->id)}}" class="btnedit" id="edit" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <a onclick="deleteShippingData('{{route('theme.shipping.destroy',$shipping->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    @endforeach
                                    </tr>
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
   </div>
</main>

<div id="myProductModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteShippingForm">
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


  <div class="modal fade popup-template-modal" id="shipping_details" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
         <h1>Adding your Shipping name and prices will show in the custom checkout screen. The price of shipping will be calculated and added to the order total </h1>
   <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>




<!-- main end -->
@include('admin.template.partials.footer')

<script>

   function deleteShippingData(url){
      $("#deleteShippingForm").attr('action', url);
      $('#myProductModal').modal();
   }

</script>

<script type="text/javascript">
   // add row
   $("#addRow").click(function () {
      var html = '';

      var country = $("#country").val()

      html += '<div id="inputFormRow">';
      html += '<div class="input-group mb-3">';
      html += '<input type="text" name="shipping_name[]" class="form-control m-input" placeholder="E.g - First Class / Next Day" autocomplete="off" required>';

      if(country == 'United Kingdom'){

         html += '<div class="form-group-cur shipng-input-grp">';
         html += '<input type="text" name="shipping_price[]" class="form-control m-input" placeholder="Shipping Price" autocomplete="off" required>';
         html += '<img  class="cur-img cur_pound" src="{{asset("images/cur-2.png")}}" alt="right-mobile">';
         html += '</div>';
      }

      else{

         html += '<div class="form-group-cur shipng-input-grp">';
         html += '<input type="text" name="shipping_price[]" class="form-control m-input" placeholder="Shipping Price" autocomplete="off" required>';
         html += '<img  class="cur-img cur_pound" src="{{asset("images/cur-1.png")}}" alt="right-mobile">';
         html += '</div>';
      }

      html += '<div class="input-group-append">';
      html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
      html += '</div>';
      html += '</div>';

      $('#newRow').append(html);
   });

   // remove row
$(document).on('click', '#removeRow', function () {

   $(this).closest('#inputFormRow').remove();

});

// function cssLayout() {
//     document.getElementById("css").href = this.value;
// }


// function setCookie(){
//     var date = new Date("Februari 10, 2013");
//     var dateString = date.toGMTString();
//     var cookieString = "Css=document.getElementById("css").href" + dateString;
//     document.cookie = cookieString;
// }

// function getCookie(){
//     alert(document.cookie);
// }

// window.onbeforeunload = function(event){
//       return "hello";
//    };

$( document ).ready(function() {

   var screen8 =  $.cookie("shipping");

      if(screen8 == undefined)
      {

         $('body').find('#shipping_details').modal('show');
         $.cookie("shipping", 1);

      }else(screen8 == 1)
      {
         
         $('body').find('#shipping_details').modal('hide');

      } 

   
});
</script>