<div class="preview-box">
                                                   <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                                   <div class="tutorial-video-box">
                                                      <div class="tutorial-video-box-inner">
                                                         <div class="preview-right-main-wrapper">
                                                            <div class="e-com-3-p-mobile-header">
                                                               <i class="fa fa-bars e-com-3-tglimg" aria-hidden="true"></i>
                                                               <i class="fa fa-search e-com-3-srchicn" aria-hidden="true"></i>
                                                               <i class="fa fa-shopping-cart e-com-3-shoping-cart" aria-hidden="true"></i>
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
                                                                           <i class="fa fa-heart-o fa-heart-o-ecom-3" aria-hidden="true"></i>
                                                                           @if(!isset($product->product_image)) 
                                                                           <img class="productimgprv e-com-3-productimgprv product_image_screen" src="{{asset('template/images/shop_your_way/ecom-3-singleproduct.jpg')}}" id="product_image_screen" alt="toggle image">
                                                                            @else
                                                                            <img class="productimgprv e-com-3-productimgprv product_image_screen" src="{{asset($product->product_image)}}" id="product_image_screen" alt="toggle image">
                                                                            @endif
                                                                           
                                                                        </div>
                                                                     </div>
                                                                     <div class="carousel-item">
                                                                        <div class="product-image-box">
                                                                           <i class="fa fa-heart-o fa-heart-o-ecom-3" aria-hidden="true"></i>
                                                                           @if(!isset($product->product_display_image_1)) 
                                                                           <img class="productimgprv e-com-3-productimgprv display_image_screen" src="{{asset('template/images/shop_your_way/ecom-3-singleproduct.jpg')}}" id="product_image_screen" alt="toggle image">
                                                                            @else
                                                                            <img class="productimgprv display_image_screen" src="{{asset($product->product_display_image_1)}}" id="product_image_screen" alt="toggle image">
                                                                            @endif
                                                                           
                                                                        </div>
                                                                     </div>
                                                                     <div class="carousel-item">
                                                                        <div class="product-image-box">
                                                                           <i class="fa fa-heart-o fa-heart-o-ecom-3" aria-hidden="true"></i>
                                                                           @if(!isset($product->product_display_image_2)) 
                                                                           <img class="productimgprv e-com-3-productimgprv display_image_screen_2" src="{{asset('template/images/shop_your_way/ecom-3-singleproduct.jpg')}}" id="product_image_screen" alt="toggle image">
                                                                            @else
                                                                            <img class="productimgprv display_image_screen" src="{{asset($product->product_display_image_2)}}" id="product_image_screen" alt="toggle image">
                                                                            @endif

                                                                        </div>
                                                                     </div>
                                                                     <div class="carousel-item">
                                                                        <div class="product-image-box">
                                                                           <i class="fa fa-heart-o fa-heart-o-ecom-3" aria-hidden="true"></i>

                                                                           @if(!isset($product->product_display_image_3)) 
                                                                           <img class="productimgprv e-com-3-productimgprv display_image_screen_3" src="{{asset('template/images/shop_your_way/ecom-3-singleproduct.jpg')}}" id="product_image_screen" alt="toggle image">
                                                                            @else
                                                                            <img class="productimgprv display_image_screen" src="{{asset($product->product_display_image_3)}}" id="product_image_screen" alt="toggle image">
                                                                            @endif
                                                                           
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="e-com-3-p-product-des-box">
                                                                  <h5>Product description</h5>
                                                                   @if(!isset($product->product_description))
                                                                    <p id="pro_description">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                                                                    @else
                                                                    <p id="pro_description">{{$product->product_description}}</p>
                                                                    @endif
                                                                  <div class="row no-gutters">
                                                                     <div class="col-md-12">
                                                                        <h5 class="h5-title-ecom-2">Select Color</h5>
                                                                        <select class="form-control ecomm_color_select ecom-3-fr" id="ecomm_color_select" name="ecomm_color_select" aria-invalid="false">
                                                                           <option id="ecomm_color_option">select</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="e-com-3-bottom-fav-container">

                                                            <div class="e-com-3-bottom-fav-button d-flex">
                                                                    @if(!isset($product->product_name))
                                                                    <h3 id="pro_name">White co ord boyfriend blazer</h3>
                                                                    @else
                                                                    <h3 id="pro_name">{{$product->product_name}}</h3>
                                                                    @endif
                                                                  <div class="e-com-3-p-price-box furniture_price">

                                                                  @if(Auth::user()->country == 'United Kingdom')                                                                 
                                                                  <span class="ecom-pricespan">Price: 
                                                                  @if(!isset($product->product_price)) 
                                                                     <span class="p-old-price ecom-pricespan">
                                                                        <img  class="cur_pound_preview" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                                        <spam class="e-com-3-p-old-price" id="sale_price_preview">90.00 </spam>
                                                                     </span>
                                                                  @else
                                                                  <span class="p-old-price ecom-pricespan">
                                                                        <img  class="cur_pound_preview" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                                        <spam class="e-com-3-p-old-price" id="sale_price_preview">{{$product->product_price}}</spam>
                                                                  </span>                                                                 
                                                                  @endif
                                                                  </span>
                                                                  @if(!isset($product->sale_price))
                                                                  <span class="new-price e-com-3-new-price">
                                                                     <img  class="cur_pound_preview_1" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                                     <spam id="pro_price">80.00<spam>
                                                                  </span>
                                                                  @else

                                                                  <span class="new-price e-com-3-new-price">
                                                                     <img  class="cur_pound_preview_1" src="{{asset('images/cur-2.png')}}" alt="right-mobile">
                                                                     <spam id="pro_price">{{$product->sale_price}}<spam>
                                                                  </span>

                                                                  @endif

                                                                  @else
                                                                  <span class="ecom-pricespan">Price:
                                                                  @if(!isset($product->product_price))   
                                                                  <span class="p-old-price ecom-pricespan">$
                                                                  <spam id="sale_price_preview e-com-3-p-old-price">90.00 </spam>
                                                                  </span>
                                                                  @else
                                                                  <span class="p-old-price ecom-pricespan">$
                                                                  <spam id="sale_price_preview e-com-3-p-old-price">{{$product->product_price}}</spam>
                                                                  </span>
                                                                  @endif
                                                                  @if(!isset($product->sale_price)) 
                                                                  </span>
                                                                  <span class="new-price ecom-pricespan">$<spam id="pro_price">80.00 <spam>
                                                                  </span>
                                                                  @else
                                                                  </span>
                                                                  <span class="new-price ecom-pricespan">$<spam id="pro_price">{{$product->sale_price}}<spam>
                                                                  </span>
                                                                  @endif
                                                                  @endif
                                                                  </div>
                                                               </div>
                                                               <div class="e-com-3-bottom-fav-button d-flex">
                                                                  <button type="submit" class="btn e-com-3-btn-addbag e-com-3-bagimgbtn"><img class="e-com-3-bagimage" src="{{asset('template/images/shop_your_way/ecom-3-bagimg.png')}}" id="product_image_screen" alt="toggle image"> Add</button>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>