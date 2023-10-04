@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper ">
         <div class="main-container">
            <div class="main-container-inner">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="row card owncard">
                           <div class="col-md-12">
                           <!-- <div class="card-header text-center table-heading mb-40">
                                 <h2>Edit Product</h2>
                              </div> -->
                              <h2 class="add_title">Edit Product</h2>
                              <form class="" method="POST" action="{{route('theme.products.update',$product->id)}}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="_method" value="PUT">
                                 <div class="row">
                                    <div class="col-md-8 left-product-col">
                                       <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
@if(Auth::user()->parent_id == 0)  
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                  @else
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
                  @endif                                             </div>
                                             <div class="form-group">
                                                <input type="hidden" class="form-control" name="template_id" value="{{$product->template_id}}">
                                             </div>
                                         

                                             <div class="form-group">
                                                <label class="pr-label" for="">Product Name:</label>
                                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="Product Name" value="{{$product->product_name}}">
                                                @error('product_name')
                                                   <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                   </span>
                                                @enderror 
                                             </div>
                                             <div class="form-group">
                                                <input type="hidden" class="form-control" name="slug"  value="{{$product->slug}}" id="slug">
                                             </div>
                                             <div class="form-group">
                                                <label class="pr-label" for="">Product Description:</label>
                                                <textarea class="form-control" id="product_description" name="product_description" placeholder="Product Description" rows="6" required>{{$product->product_description}}</textarea>
                                             </div>

                                          </div>
                                       </div>
                                       <div class="row">
                                          <!-- Product Prize: -->
                                          <div class="col-md-12">
                                             <h5 class="">Product Price:</h5>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="pr-label" for="exampleInputEmail1" class="float-right">Regular Price:</label>
                                                <div class="form-group-cur">  
                                                <input type="text" class="form-control" id="product_price" name="product_price" value="{{$product->product_price}}" aria-describedby="emailHelp" placeholder="Regular Price" required>
                                                @if(Auth::user()->country == 'United Kingdom')
                                                <img  class="cur-img cur_pound" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                @else
                                                <img  class="cur-img" src="{{asset('images/cur-1.png')}}" alt="right-mobile">
                                                @endif 
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">  
                                                <label class="pr-label" for="exampleInputEmail1" class="float-right">Sale Price:</label>
                                                <div class="form-group-cur">  
                                                <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{$product->sale_price}}" aria-describedby="emailHelp" placeholder="Sale Price">
                                                @if(Auth::user()->country == 'United Kingdom')
                                                <img  class="cur-img cur_pound" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                @else
                                                <img  class="cur-img" src="{{asset('images/cur-1.png')}}" alt="right-mobile">
                                                @endif
                                                </div> 
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <!-- SKU: -->
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="pr-label" for="exampleInputEmail1" class="float-right">SKU (Stock Keeping Unit):</label>
                                                <input type="text" class="form-control" id="stock_unit" name="stock_unit" value="{{$product->stock_unit}}" aria-describedby="emailHelp" placeholder="" > 
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">  
                                                <label class="pr-label" for="exampleInputEmail1" class="float-right">Stock Qty:</label>
                                                <input type="text" class="form-control" id="stock_qty" name="stock_qty" value="{{$product->stock_qty}}" aria-describedby="emailHelp" placeholder="" >
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Inventory: -->
                                       <!-- <div class="row">
                                       <div class="col-md-12">
                                       <div class="input-group">
                                          <div class="custom_checkbox ">
                                             <label  class="ch-checkbox">
                                             <input type="checkbox" id="edit_shipping"  value="" checked>
                                             <span for="defaultCheck1"><i class="ch-icon icon-tick"></i>Shipping</span>
                                             </label>
                                          </div>
                                       </div>
                                        </div>
                                        </div>   -->
                                       <!-- Shipping  -->
                                       <!-- <div id="edit_form_shipping">
                                          <div class="form-group shipping-box-inner">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <label class="pr-label" for="exampleInputEmail1" class="">Weight:</label>
                                                   <div class="row no-gutters">
                                                      <div class="d-flex shipping-box-row shipping-box-row-top">
                                                         <input type="text" class="form-control" id="shipping_weight" name="shipping_weight" value="{{$product->shipping_weight}}" aria-describedby="emailHelp" placeholder="0.0">
                                                         <select id="inputState" class="form-control float-left">
                                                            <option selected>Kg</option>
                                                            <option>Oz</option>
                                                            <option>lb</option>
                                                            <option>g</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <label class="pr-label" for="exampleInputEmail1" class="">length:</label>
                                                   <div class="d-flex shipping-box-row">
                                                         <input type="text" class="form-control" id="shipping_length" name="shipping_length" value="{{$product->shipping_length}}" aria-describedby="emailHelp" placeholder="0.0">
                                                         <select id="inputState" class="form-control float-left">
                                                            <option selected>cm</option>
                                                            <option>inch</option>
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <label class="pr-label" for="exampleInputEmail1" class="">Width:</label>
                                                   <div class="d-flex shipping-box-row">
                                                         <input type="text" class="form-control" id="shipping_width" name="shipping_width" value="{{$product->shipping_width}}" aria-describedby="emailHelp" placeholder="0.0">
                                                         <select id="inputState" class="form-control float-left">
                                                            <option selected>cm</option>
                                                            <option>inch</option>
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="pr-label" for="exampleInputEmail1" class="">Height:</label>
                                                   <div class="d-flex shipping-box-row">
                                                      <input type="text" class="form-control" id="shipping_height" name="shipping_height" value="{{$product->shipping_height}}" aria-describedby="emailHelp" placeholder="0.0">
                                                      <select id="inputState" class="form-control float-left">
                                                         <option selected>cm</option>
                                                         <option>inch</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div> -->
                                       <button type="submit" class="btn btn-primary">Update Product</button>
                                    </div>
                                    <div class="col-md-4 right-prd">
                                        <div class="product-image-right">
                                        <label class="pr-label text-center">Product Image <a class="tooltip-btn" data-tooltip="Please select atleast one image 1500 x 1500px" data-tooltip-location="right"> ?</a></label>
                                            <div class="form-group">
                                                <input type="file" class="form-control imagee" id="product_image" name="product_image">
                                                <label for="product_image" class="mainproductlabel">
                                            <div class="roduct-imgmn-img-box">
                                            @if(!empty($product->product_image))
                                                <img  class="product-imgmn product_image_screen" src="{{asset($product->product_image)}}" id="product_image_screen" alt="right-mobile">
                                             @else
                                                <img  class="product-imgmn product_image_screen" src="{{asset('template/images/dummy_product.jpg')}}" id="product_image_screen" alt="right-mobile">
                                             @endif       
                                            </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input id="product_display_image" type="file" class="form-control imagee " name="product_display_image_1">
                                                <label for="product_display_image" class="mainproductlabel">
                                            <div class="roduct-imgmn-img-box">
                                                @if(!empty($product->product_display_image_1))
                                                      <img class="product-imgmn display_image_screen" src="{{asset($product->product_display_image_1)}}" id="display_image_screen" alt="right-mobile">
                                                @else
                                                      <img class="product-imgmn display_image_screen" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen" alt="right-mobile">
                                                @endif
                                            </div>
                                                </label>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input id="product_display_image_1" type="file" class="form-control imagee " name="product_display_image_2">
                                                <label for="product_display_image_1" class="mainproductlabel">
                                            <div class="roduct-imgmn-img-box">
                                                @if(!empty($product->product_display_image_2))
                                                      <img class="product-imgmn display_image_screen_2" src="{{asset($product->product_display_image_2)}}" id="display_image_screen_2" alt="right-mobile">
                                                @else
                                                      <img class="product-imgmn display_image_screen_2" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen_2" alt="right-mobile">
                                                @endif
                                            </div>
                                                </label>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input id="product_display_image_2" type="file" class="form-control imagee" name="product_display_image_3">
                                                <label for="product_display_image_2" class="mainproductlabel">
                                            <div class="roduct-imgmn-img-box">
                                                @if(!empty($product->product_display_image_3))
                                                   <img class="product-imgmn display_image_screen_3" src="{{asset($product->product_display_image_3)}}" id="display_image_screen_3" alt="right-mobile">
                                                @else  
                                                   <img class="product-imgmn display_image_screen_3" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen_3" alt="right-mobile">
                                                @endif
                                            </div>
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Organization -->
                                        <div class="row">
                                          <div class="col-md-12">
                                             <h5 class="">Organization</h5>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="pr-label" for="">Product type</label>
                                                <input type="text" class="form-control" placeholder="" value="{{$product->product_type}}" name="product_type" required> 
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Organization -->
                                        <div class="row mt-30">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="pr-label" for="">Collections</label>
                                                <select class="form-control" id="product_collection" name="product_collection">
                                                    @foreach($collections as $collection)
                                                      <option value="{{$collection->id}}">{{$collection->collection_name}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                     
                                
                              </form>
                           </div>
                        </div>

                     </div>
                  <div class="col-md-4">

                  @if(session()->get('theme_code') == 'war_678')
                     <div class="preview-box">
                     <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                     <div class="tutorial-video-box">
                        <div class="tutorial-video-box-inner">
                           <div class="preview-right-main-wrapper">
                              <div class="p-mobile-header">
                                 <img class="tglimg" src="{{asset('asset/images/preview/tglimg.png')}}" alt="toggle image">
                                 @if(!isset($splashscreen))
                                    <img class="logoprv preview" id="preview" src="{{asset('asset/images/preview/logoprv.png')}}" alt="logo"> 
                                 @elseif ($splashscreen->splash_logo == NULL)
                                 <img class="logoprv preview" id="preview" src="{{asset('asset/images/preview/logoprv.png')}}" alt="logo">
                                 @else
                                    <img class="logoprv preview" id="preview" src="{{asset($splashscreen->splash_logo)}}" alt="logo"> 
                                 @endif 
                                 <img class="srchicn" src="{{asset('asset/images/preview/ic_search_24px.png')}}" alt="logo">
                                 <img class="hicn" src="{{asset('asset/images/preview/hicn.png')}}" alt="logo">
                                 <span class="cardcount text-center">5</span>
                              </div>
                              <div class="product-preview-container">
                                 <div id="demo" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                       <li data-target="#demo" data-slide-to="0" class="active"></li>
                                       <li data-target="#demo" data-slide-to="1"></li>
                                       <li data-target="#demo" data-slide-to="2"></li>
                                       <li data-target="#demo" data-slide-to="3"></li>
                                    </ul>
                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                       <div class="carousel-item active">
                                          <div class="product-image-box">

                                             @if(!isset($product->product_image)) 
                                             <img class="productimgprv product_image_screen" src="{{asset('asset/images/preview/productimg-w.png')}}" id="product_image_screen" alt="toggle image">
                                             @else
                                             <img class="productimgprv product_image_screen" src="{{asset($product->product_image)}}" id="product_image_screen" alt="toggle image">
                                             @endif
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             @if(!isset($product->product_display_image_1)) 
                                             <img class="productimgprv display_image_screen" src="{{asset('asset/images/preview/productimg-w-r.png')}}" id="product_image_screen" alt="toggle image">
                                             @else
                                             <img class="productimgprv display_image_screen" src="{{asset($product->product_display_image_1)}}" id="product_image_screen" alt="toggle image">
                                             @endif   
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             @if(!isset($product->product_display_image_2))
                                             <img class="productimgprv display_image_screen_2" src="{{asset('asset/images/preview/productimg-w.png')}}" id="product_image_screen" alt="toggle image">
                                             @else   
                                             <img class="productimgprv display_image_screen_2" src="{{asset($product->product_display_image_2)}}" id="product_image_screen" alt="toggle image">
                                             @endif   
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             @if(!isset($product->product_display_image_3))
                                                <img class="productimgprv display_image_screen_3" src="{{asset('asset/images/preview/productimg-w-r.png')}}" id="product_image_screen" alt="toggle image">
                                             @else
                                                <img class="productimgprv display_image_screen_3" src="{{asset($product->product_display_image_3)}}" id="product_image_screen" alt="toggle image">
                                             @endif
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="product-name-box">

                                    @if(!isset($product->product_name))
                                       <h3 id="pro_name">White co ord boyfriend blazer</h3>
                                    @else
                                       <h3 id="pro_name">{{$product->product_name}}</h3>
                                    @endif
                                    
                                    <div class="p-price-box text-center">

                                    @if(Auth::user()->country == 'United Kingdom')
                                          @if(!isset($product->product_price))                                    
                                             <span class="p-old-price"><img  class="cur_pound_preview" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="pro_price">90.00</spam></span>
                                          @else
                                             <span class="p-old-price"><img  class="cur_pound_preview" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="pro_price">{{$product->product_price}}</spam></span>
                                          @endif

                                          @if(!isset($product->sale_price))
                                             <span class="new-price"><img  class="cur_pound_preview_1" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="sale_price_preview">80.00<spam></span>
                                          @else
                                             <span class="new-price"><img  class="cur_pound_preview_1" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="sale_price_preview">{{$product->sale_price}}<spam></span>
                                          @endif 
                                    @else
                                          @if(!isset($product->product_price))                                    
                                             <span class="p-old-price">$<spam id="pro_price">90.00</spam></span>
                                          @else
                                             <span class="p-old-price">$<spam id="pro_price">{{$product->product_price}}</spam></span>
                                          @endif

                                          @if(!isset($product->sale_price))
                                             <span class="new-price">$<spam id="sale_price_preview">80.00<spam></span>
                                          @else
                                             <span class="new-price">$<spam id="sale_price_preview">{{$product->sale_price}}<spam></span>
                                          @endif
                                    @endif  

                                    </div>
                                 </div>
                                 <div class="p-product-des-box">
                                    <h5>Product description</h5>
                                    @if(!isset($product->product_description))
                                    <p id="pro_description">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                                    @else
                                    <p id="pro_description">{{$product->product_description}}</p>
                                    @endif
                                    <div class="row no-gutters">
                                       <div class="col-md-6">
                                       <select class="form-control ecomm_color_select" id="ecomm_color_select" name="ecomm_color_select" aria-invalid="false">
                                          <option id="ecomm_color_option">select</option>
                                       </select>
                                       </div>
                                       <div class="col-md-6">
                                          <ul class="p-size-ul list-inline">
                                             <li class="selected-licolor list-inline-item">S</li>
                                             <li class="list-inline-item">M</li>
                                             <li class="list-inline-item select-lisize">L</li>
                                             <li class="list-inline-item">XL</li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="bottom-fav-button d-flex text-center">
                                    <div class="fav-icn">
                                       <img class="hrt" src="{{asset('asset/images/preview/hrt.png')}}" alt="toggle image">
                                    </div>
                                    <button type="submit" class="btn btn-addbag bagimgbtn"> <img class="bagimg" src="{{asset('asset/images/preview/bagimg.png')}}" alt="toggle image">Add to cart</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               
               @elseif(session()->get('theme_code') == 'red_896')

               @include('admin.template.E_Commerce.themes.product_preview.reddress_product')

               @elseif(session()->get('theme_code') == 'fur_369')

               @include('admin.template.E_Commerce.themes.product_preview.shop_way_product')

               @endif

               

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