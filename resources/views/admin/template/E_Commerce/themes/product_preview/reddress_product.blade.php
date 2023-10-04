<div class="preview-box">
                     <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                     <div class="tutorial-video-box">
                        <div class="tutorial-video-box-inner">
                           <div class="preview-right-main-wrapper">
                              <div class="p-mobile-header">
                                 <img class="tglimg" src="{{asset('asset/images/preview/tglimg.png')}}" alt="toggle image">

                                 @if(!isset($splashscreen))
                                 <img class="logoprv preview" id="preview" src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                 @elseif ($splashscreen->splash_logo == NULL)
                                    <img class="logoprv preview" id="preview" src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                 @else
                                    <img class="logoprv preview" id="preview" src="{{asset($splashscreen->splash_logo)}}" alt="logo"> 
                                 @endif  

                                 <img class="srchicn" src="{{asset('asset/images/preview/ic_search_24px.png')}}" alt="logo">
                                 <img class="hicn" src="{{asset('asset/images/preview/hicn.png')}}" alt="logo">
                                 <i class="fa fa-shopping-cart e-com-2-cart-icnright" aria-hidden="true"></i>
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
                                            <img class="productimgprv product_image_screen" src="{{asset('asset/images/ecom-2-singleproduct.png')}}" id="product_image_screen" alt="toggle image">
                                             @else
                                             <img class="productimgprv product_image_screen" src="{{asset($product->product_image)}}" id="product_image_screen" alt="toggle image">
                                             @endif
                                            
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">

                                          @if(!isset($product->product_display_image_1)) 
                                          <img class="productimgprv display_image_screen" src="{{asset('asset/images/preview/ecom-2-singleproduct-1.png')}}" id="product_image_screen" alt="toggle image">
                                             @else
                                             <img class="productimgprv display_image_screen" src="{{asset($product->product_display_image_1)}}" id="product_image_screen" alt="toggle image">
                                             @endif 
                                             
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                            @if(!isset($product->product_display_image_2))
                                            <img class="productimgprv display_image_screen_2" src="{{asset('asset/images/preview/ecom-2-singleproduct-1.png')}}" id="product_image_screen" alt="toggle image">
                                             @else   
                                             <img class="productimgprv display_image_screen_2" src="{{asset($product->product_display_image_2)}}" id="product_image_screen" alt="toggle image">
                                             @endif   
                                             
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">

                                            @if(!isset($product->product_display_image_3))
                                                <img class="productimgprv display_image_screen_3" src="{{asset('asset/images/preview/ecom-2-singleproduct.png')}}" id="product_image_screen" alt="toggle image">
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
                                          <ul class="p-size-ul list-inline" id="ecomm_size_select">
                                             <li class="selected-licolor list-inline-item">S</li>
                                             <li class="list-inline-item">M</li>
                                             <li class="list-inline-item select-lisize">L</li>
                                             <li class="list-inline-item">XL</li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="e-com-2-bottom-fav-button d-flex">
                                    <button type="submit" class="btn e-com-2-btn-wishlist"> <i class="fa fa-heart-o e-com-2-hicnbtn" aria-hidden="true"></i>Wishlist</button>
                                    <button type="submit" class="btn e-com-2-btn-addbag e-com-2-bagimgbtn"><img class="e-com-2-bagimage" src="{{asset('asset/images/ecom-2-bagimg.png')}}" id="product_image_screen" alt="toggle image"> Add Product</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>