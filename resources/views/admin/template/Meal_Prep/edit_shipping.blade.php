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
                            <div class="row edit-shiping-row">
                                
                                <div class="col-lg-12 mt-20">
                                <h2 class="add_title mb-30 main-title-top" >Update Shipping Details <a class="tooltip-btn" data-tooltip="Here you can update shippings details" data-tooltip-location="right"> ?</a></h2>

                                    <form method="POST" action="{{route('theme.shipping.update',$shipping->id)}}" enctype="multipart/form-data">

                                       @csrf
                                       <input type="hidden" name="_method" value="PUT">

                                       <div class="form-group">
                                          <input type="hidden" class="form-control" name="user_id" value="{{$shipping->user_id}}">
                                       </div>
                                       <div class="form-group">
                                          <input type="hidden" class="form-control" name="template_id" value="{{$shipping->template_id}}">
                                       </div>
                                       <div class="form-group">
                                          <input type="text" name="shipping_name[]" class="form-control m-input" placeholder="Shipping Name" value="{{$shipping->shipping_name}}" autocomplete="off" required>
                                       </div>
                                       <div class="form-group">
                                       @if(Auth::user()->country == 'United Kingdom')
                                       <div class="form-group-cur form-group-curncy">
                                          <input type="number" name="shipping_price[]" class="form-control m-input" placeholder="Shipping Price" value="{{$shipping->shipping_price}}" autocomplete="off" required>
                                          <img  class="cur-img cur_pound" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                        </div>
                                        @else
                                        <div class="form-group-cur form-group-curncy">
                                          <input type="number" name="shipping_price[]" class="form-control m-input" placeholder="Shipping Price" value="{{$shipping->shipping_price}}" autocomplete="off" required>
                                          <img  class="cur-img cur_dollar" src="{{asset('images/cur-1.png')}}" alt="right-mobile">
                                          </div>
                                        @endif
                                       </div>
                                       <button type="submit" class="btn btn-primary">Update</button>

                                    <form>
                                </div>
                            </div>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

<!-- main end -->
@include('admin.template.partials.footer')

