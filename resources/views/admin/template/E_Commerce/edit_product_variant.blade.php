@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper ">
      <div class=" mainwrapper-main">
      <div class="mainwrapper-pgs ">
         <div class="main-container maim-addmorevariants">
            <div class="main-container-inner">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row card owncard">
                            <div class="col-md-12">
                            <!-- <div class="card-header text-center table-heading mb-40">
                                    <h2>Add More Variants</h2>
                            </div> -->
                            <h2 class="add_title">Add More Variants</h2>
                       
                                <form class="" method="POST" action="{{route('theme.add_variants')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="hidden" value="{{$id}}" name="product_id">
                                            <input type="hidden" value="{{$user_id}}" name="user_id">
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label class="pr-label" for="exampleInputEmail1" class="float-right" id="selectdata" >Select Color: <a class="tooltip-btn" data-tooltip="Please enter color name" data-tooltip-location="right"> ?</a></label>
                                            <select class="form-control product_color" multiple="multiple" id="pieces" name="variant_color[]" style="width:100%;" placeholder="select Color">

                                            </select>
                                            <i class="fa fa-angle-right arrow-bt" aria-hidden="true"></i>
                                        </div>
                                            <div class="col-md-6">  
                                            <label class="pr-label" for="exampleInputEmail1" class="float-right">Select Size: <a class="tooltip-btn" data-tooltip="Please enter size" data-tooltip-location="right"> ?</a></label>
                                            <select class="form-control product_size" id="pieces1" multiple="multiple" name="variant_size[]" style="width:100%;" placeholder="select Size">
                                            
                                            </select>
                                            <i class="fa fa-angle-right arrow-bt" aria-hidden="true"></i>
                                        </div>
                                    </div><br><br>
                                    <p><a id="show"></a></p>
                                    <div id="variant_values"></div>
                                    <button type="submit" class="btn btn-primary">Add</button>      
                                </form>
                                <br>
                            </div>
                            <div class="col-md-12">
                            <h2 class="add_title">Edit Variants</h2>
                            </div>

                           <div class="col-md-12">                           
                              <form class="" method="POST" action="{{route('theme.update_variants')}}" enctype="multipart/form-data">
                                    @csrf
                                    @foreach($productvariations as $productvariation)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">Variant:</label>
                                                <label class="lbh">{{$productvariation->variant_name}}</label>
                                                <input type="hidden" value="{{$productvariation->variant_name}}" name="variant_name[]">
                                                <input type="hidden" value="{{$productvariation->user_id}}" name="user_id[]">
                                                <input type="hidden" value="{{$productvariation->product_id}}" name="product_id[]">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Price:</label>
                                                <input type="number" class="form-control" id="variant_price" value="{{$productvariation->variant_price}}" name="variant_price[]" placeholder="0.00">
                                                <input type="hidden" value="{{$productvariation->id}}" name="variant_id[]">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Quantity:</label>
                                                <input type="number" class="form-control" id="variant_qty" value="{{$productvariation->variant_qty}}" name="variant_qty[]" placeholder="0">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Image:</label>
                                                <input type="file" class="form-control" id="variant_image" value="{{$productvariation->variant_image}}" name="variant_image[]">
                                            </div>
                                            <div class="col-md-2">  
                                                <a href="{{route('theme.del_variants',$productvariation->id)}}" class="btndelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                 <button type="submit" class="btn btn-primary">Update Variants</button>
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
</main>
<!-- main end-->
@include('admin.template.partials.footer')