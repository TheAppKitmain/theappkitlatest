@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper ">
         <div class="main-container">
            <div class="main-container-inner maininnerallpagescontainer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row owncard addprdctrow mt-20 addprdctrowmaintabs">
                           <div class="col-md-12">
                              <div class="tab">
                              @if ($splashscreen == NULL)
                                    <button id="splashscreen1" class="tablinks active" onclick="openCity(event, 'splashscreen') ">Splash Screen <span class="theme-tab-number-w">1</span> </button>
                                 @else
                                    <button id="splashscreen1" class="tablinks active template-tab-color" onclick="openCity(event, 'splashscreen') ">Splash Screen <span class="theme-tab-number-green">1</span> </button>
                                 @endif

                                 @if ($tempsignupsetting == NULL)
                                 <button id="signup1" class="tablinks" onclick="openCity(event, 'signup')">Sign Up <span class="theme-tab-number-w">2</span> </button>
                                 @else
                                 <button id="signup1" class="tablinks template-tab-color" onclick="openCity(event, 'signup')">Sign Up <span class="theme-tab-number-green">2</span> </button>
                                 @endif

                                 @if ($temploginsetting == NULL)
                                 <button id="login1" class="tablinks" onclick="openCity(event, 'login')">Login <span class="theme-tab-number-w">3</span> </button>
                                 @else
                                 <button id="login1" class="tablinks template-tab-color" onclick="openCity(event, 'login')">Login <span class="theme-tab-number-green">3</span> </button>
                                 @endif

                                 @if(count($collections) == 0)
                                 <button id="home1" class="tablinks" onclick="openCity(event, 'home')">Home <span class="theme-tab-number-w">4</span> </button>
                                 @else
                                 <button id="home1" class="tablinks template-tab-color" onclick="openCity(event, 'home')">Home <span class="theme-tab-number-green">4</span> </button>
                                 @endif

                                 @if(count($products) == 0)
                                 <button id="add_prodcut1" class="tablinks" onclick="openCity(event, 'add_prodcut')">Add Product <span class="theme-tab-number-w">5</span> </button>
                                 @else
                                 <button id="add_prodcut1" class="tablinks template-tab-color" onclick="openCity(event, 'add_prodcut')">Add Product <span class="theme-tab-number-green">5</span></button>
                                 @endif
                                 <button id="my_account1" class="tablinks" onclick="openCity(event, 'rest_screens')">Other Screeens</button>
                              </div>

<!-------------------------------------============================  Add Product  ==========================----------------------------------------------->

<div id="add_prodcut" class="tabcontent">
<div class="main-wrapper ">
   <div class="main-container">
      <div class="main-container-inner">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-8 own-8-col">
                  <div class="row card owncard addprdctrow">
                     <div class="col-md-12">
                        <form class="" method="POST" action="{{route('theme.products.store')}}" enctype="multipart/form-data" id="product_validation">
                           @csrf
                           <div class="row">
                              <div class="col-md-8 left-product-col">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                       @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                                       </div>
                                       <div class="form-group">
                                          <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                                       </div>
                                       <div class="form-group">
                                          <label class="pr-label" for="">Product Name</label>
                                          <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="Product Name" required>
                                          @error('product_name')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                       </div>
                                       <div class="form-group">
                                          <input type="hidden" class="form-control" name="slug" id="slug">
                                       </div>
                                       <div class="form-group">
                                          <label class="pr-label" for="">Product Description</label>
                                          <textarea class="form-control" id="product_description" rows="6" name="product_description" placeholder="Product Description"></textarea>
                                       </div>
                                      
                                    </div>
                                 </div>
                                 <div class="row">
                                    <!-- Product Prize: -->
                                    <div class="col-md-12">
                                       <h5 class="">Product Price</h5>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="pr-label" for="exampleInputEmail1" class="float-right">Regular Price </label>
                                          <div class="form-group-cur">  
                                          <input type="number" class="form-control" id="product_price" name="product_price" aria-describedby="emailHelp" placeholder="Regular Price">
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
                                          <label class="pr-label" for="exampleInputEmail1" class="float-right">Sale Price (Optional)</label>
                                          <div class="form-group-cur">
                                          <input type="number" class="form-control" id="sale_price" name="sale_price" aria-describedby="emailHelp" placeholder="Sale Price">
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
                                          <label class="pr-label" for="exampleInputEmail1" class="float-right">SKU (Stock Keeping Unit) (Optional)</label>
                                          <input type="text" class="form-control" id="stock_unit" name="stock_unit" aria-describedby="emailHelp"> 
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">  
                                          <label class="pr-label" for="exampleInputEmail1" class="float-right">Stock Qty</label>
                                          <input type="number" class="form-control" id="stock_qty" name="stock_qty" aria-describedby="emailHelp">
                                       </div>
                                    </div>
                                 </div>
                      
                                 <!-- Product Variants  -->
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label class="pr-label" for="exampleInputPassword1"><b>Variants</b></label>
                                       </div>
                                       <div class="input-group">
                                          <div class="custom_checkbox ">
                                             <label  class="ch-checkbox">
                                             <input type="checkbox" id="product_variant"  value="">
                                             <span for="product_variant"><i class="ch-icon icon-tick"></i>Product Variant </span>
                                             </label>
                                          </div>
                                       </div>
                                       <div id="variant_form">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label class="pr-label" for="exampleInputEmail1" class="float-right" id="selectdata" >Enter Color: <a class="tooltip-btn" data-tooltip="Here you can enter product color" data-tooltip-location="right"> ?</a></label>
                                                   <select class="form-control product_color" multiple="multiple" id="pieces" name="variant_color[]" style="width:100%;" placeholder="select Color"></select>
                                                </div>
                                                <div class="col-md-6">  
                                                   <label class="pr-label" for="exampleInputEmail1" class="float-right">Enter Size: <a class="tooltip-btn" data-tooltip="Here you can enter product size" data-tooltip-location="right"> ?</a></label>
                                                   <select class="form-control product_size" id="pieces1" multiple="multiple" name="variant_size[]" style="width:100%;" placeholder="select Size"></select>
                                                </div>
                                             </div>
                                          </div>
                                          <p><a id="show"></a></p>
                                          <div id="variant_values"></div>
                                       </div>
                                       <div class="form-group">
                                       <button type="submit" class="btn btn-primary savbtnpro m-0">Save Product</button>
                                    
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Product Images  -->
                              <div class="col-md-4 right-prd">
                                 <div class="product-image-right">
                                    <label class="pr-label text-center">Product Image <a class="tooltip-btn" data-tooltip="Please select atleast one image 1500 x 1500px" data-tooltip-location="right"> ?</a></label>
                                    <div class="form-group">

                                       <input type="file" accept="image/*" class="form-control imagee  @error('product_image') is-invalid @enderror" id="product_image" name="product_image" required>

                                       <label for="product_image" class="mainproductlabel">

                                          <div class="roduct-imgmn-img-box">
                                             <img  class="product-imgmn product_image_screen" src="{{asset('asset/images/product-main.png')}}" alt="right-mobile">
                                          </div>
                                          
                                       </label>

                                       @error('product_image')
                                          <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                          </span>
                                       @enderror

                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <input id="product_display_image" type="file" accept="image/*" class="form-control imagee " name="product_display_image_1">

                                          <label for="product_display_image" class="mainproductlabel">
                                             <div class="roduct-imgmn-img-box">
                                                <img class="product-imgmn display_image_screen" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen" alt="right-mobile">
                                             </div>
                                          </label>
                                          
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <input id="product_display_image_1" type="file" accept="image/*" class="form-control imagee " name="product_display_image_2">
                                          <label for="product_display_image_1" class="mainproductlabel">
                                             <div class="roduct-imgmn-img-box">
                                                <img class="product-imgmn display_image_screen_2" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen_2" alt="right-mobile">
                                             </div>
                                          </label>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <input id="product_display_image_2" type="file" accept="image/*" class="form-control imagee " name="product_display_image_3">
                                          <label for="product_display_image_2" class="mainproductlabel">
                                             <div class="roduct-imgmn-img-box">
                                                <img class="product-imgmn display_image_screen_3" src="{{asset('asset/images/product-main.png')}}" id="display_image_screen_3" alt="right-mobile">
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
                                          <input type="text" class="form-control" placeholder="" name="product_type">
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Collection -->
                                 <div class="row mt-30">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label class="pr-label" for="">Collections</label>
                                          <select class="form-control" id="product_collection" name="product_collection" required>
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
              
               <!----====== Product Preview =====---->

               <div class="col-md-4 own-4-col ecom-temp-reddress">
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
                                             <img class="productimgprv product_image_screen" src="{{asset('asset/images/Studio_image_jhsgajfd.png')}}" id="product_image_screen" alt="toggle image">
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             <img class="productimgprv display_image_screen" src="{{asset('asset/images/preview/ecom-2-singleproduct-1.png')}}" id="product_image_screen" alt="toggle image">
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             <img class="productimgprv display_image_screen_2" src="{{asset('asset/images/preview/ecom-2-singleproduct-1.png')}}" id="product_image_screen" alt="toggle image">
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                       <div class="carousel-item">
                                          <div class="product-image-box">
                                             <img class="productimgprv display_image_screen_3" src="{{asset('asset/images/preview/ecom-2-singleproduct.png')}}" id="product_image_screen" alt="toggle image">
                                             <img class="backimg" src="{{asset('asset/images/preview/back.png')}}" id="product_image_screen" alt="toggle image">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="product-name-box">
                                    <h3 id="pro_name">White co ord boyfriend blazer</h3>
                                    <div class="p-price-box text-center">

                                       @if(Auth::user()->country == 'United Kingdom')
                                          <span class="p-old-price"><img  class="cur_pound_preview" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="sale_price_preview">90.00 </spam></span>
                                          <span class="new-price"><img  class="cur_pound_preview_1" src="{{asset('images/cur-2.png')}}" alt="right-mobile"><spam id="pro_price">80.00 <spam></span>
                                       @else
                                          <span class="p-old-price">$<spam id="sale_price_preview">90.00 </spam></span>
                                          <span class="new-price">$<spam id="pro_price">80.00 <spam></span>
                                       @endif

                                    </div>
                                 </div>
                                 <div class="p-product-des-box">
                                    <h5>Product description</h5>
                                    <p id="pro_description">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
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
               </div>
               <div class="col-md-12 no-padding mt-40">
                     <div class="card card-own table-wrapper">
                        <div class="card-header text-center table-heading">
                           <h2>Products</h2>
                        </div>
                        <div class="card-body mt-20">
                           <table id="product_details" class="table table-bordered table-striped table-main" style="width:100%">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Stock qty</th>
                                    <th>Product Price</th>
                                    <th>Collection Name</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($products as $product)  
                                 <tr>
                                    <td class="pd-2" scope="col">{{$product->product_name}}</td>
                                    <td class="pd-2">{{$product->stock_qty}}</td>
                                    @if(Auth::user()->country == 'United Kingdom')                                                                 
                                    <td class="pd-2"><img class="cur_pound_preview product_cur_price" src="{{asset('images/cur-2.png')}}" alt="right-mobile">{{$product->product_price}}</td>
                                    @else
                                    <td class="pd-2">$ {{$product->product_price}}</td>
                                    @endif
                                    <td class="pd-2">{{$product->get_collection_name->collection_name ?? ""}}</td>
                                    <td class="text-center">    
                                       <a href="{{ route('theme.edit_variants',$product->id)}}" class="btnedit btn btn-success" id="edit_variant" name="edit_variant">Edit Variant</a>
                                       <a href="{{ route('theme.products.edit',$product->id)}}" class="btnedit" id="edit" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                       <a onclick="deleteProductData('{{route('theme.products.destroy',$product->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
<!-------------------------------------============================ Product End ==========================----------------------------------------------->


<!-------------------------------------============================  Splash Screen =============================----------------------------------------------->
<div id="splashscreen" class="tabcontent" style="display: block;">
   <div class="tab-content-inner">
      <div class="row">
         <div class="col-md-8 own-8-col">
            <div class="card-body m-t-20">
               <form  method ="POST" action="{{route('theme.splashscreen')}}" enctype="multipart/form-data" name="splashscreen_form">
                  @csrf
                  <div class="form-group">
                  @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                  </div>
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                  </div>
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="template_name" name="template_name" value="{{$themetemplate->theme_name}}">
                  </div>

                  <div class="d-flex form-group formgrouplabel">
                     <label class="lbh">Upload Logo <a class="tooltip-btn" data-tooltip="Upload Image 1000 x 1000px" data-tooltip-location="right"> ?</a></label>                
                     <input id="inp1" type="file" accept="image/*" class="form-control splash_logo" name="splash_logo">
                     <label for="inp1" class="splogoinput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                     <div class="delete-box-cm" id="remove_logo_image" onClick="removereddresslogoimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove logo image</div>
                  </div>

                  <div class="d-flex form-group formgrouplabel">
                     <label class="lbh">Splash Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1535 x 3600px" data-tooltip-location="right"> ?</a></label>
                     <input type="file" accept="image/*" id="inp2"  class="form-control splash_bg_image" name="splash_background_image" onchange="splshbgimgshow()">
                     <label for="inp2" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                     <div class="delete-box-cm" id="remove_splash_image" onClick="removesplashimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove splash image</div>
                  </div>

                  <h6  class="text-left ortitle">Or</h6>
                  <div class="d-flex form-group">
                     <label class="lbh">Splash Background Color</label>
                     @if($splashscreen == NULL)
                     <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="#ffffff"> 
                     @else
                        @if($splashscreen->splash_background_color !== "#ffffff")
                        <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                        @else
                        <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                        @endif 
                     @endif
                  </div>
                  <div class=" form-group">
                     <button class="savebtn">Save</button>
                  </div>
               </form>
            </div>
         </div>
         <!--======  Splash Screen Preview =====-->                    
         <div class="col-md-4 own-4-col  splash-ecomreddress">
         <div class="preview-box">
                  <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                  <div class="tutorial-video-box text-center">
                  <div class="tutorial-video-box-inner">
                  
                     <div class="">
                        <div class="e-com-2-sign-login">
                           <div class="preview-right-main-wrapper">

                              @if(!isset($splashscreen))

                              <div class="e-com-2-splashbg splash-bgimage" id="splash_screen_bg">
                                 <img class="splashbg" src="{{asset('asset/images/splash/spalshbg.png')}}" id="splash_bg" alt="eyeimage" >
                                 <img class="e-com-2-applogoimg preview" src="{{asset('asset/images/red-logo.png')}}" id="splash_logo" alt="eyeimage">
                              </div>

                              @else

                                 @if($splashscreen->splash_background_color == "#ffffff" && !is_null($splashscreen->splash_background_image))
                                 <div class="e-com-2-splashbg splash-bgimage" id="splash_screen_bg">
                                    <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" >
                                    @if($splashscreen->splash_logo == NULL)
                                       <img class="applogoimg preview" src="{{asset('asset/images/red-logo.png')}}" id="splash_logo" alt="eyeimage">   
                                    @else
                                       <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                    @endif
                                 <div>

                                 @elseif($splashscreen->splash_background_color == "#ffffff" && $splashscreen->splash_background_image == null)
                                  <div class="e-com-2-splashbg splash-bgimage" id="splash_screen_bg">
                                    <img class="splashbg" src="{{asset('asset/images/splash/spalshbg.png')}}" id="splash_bg" alt="">
                                    @if($splashscreen->splash_logo == NULL)   
                                       <img class="applogoimg preview" src="{{asset('asset/images/red-logo.png')}}" id="splash_logo" alt="eyeimage">
                                    @else 
                                       <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                    @endif
                                 </div>
                               
                                 @else

                                 <div class="e-com-2-splashbg splash-bgimage" id="splash_screen_bg" style="background-color:{{$splashscreen->splash_background_color}};">
                                    <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" style="display:none;" >

                                    @if($splashscreen->splash_logo == NULL)   
                                       <img class="applogoimg preview" src="{{asset('asset/images/red-logo.png')}}" id="splash_logo" alt="eyeimage">
                                    @else 
                                       <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                    @endif

                                 </div>
                                 @endif

                              @endif

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
<!-------------------------------------============================  Splash Screen End ==========================----------------------------------------------->
                              

<!-------------------------------------============================  Login  ==========================----------------------------------------------->

<div id="login" class="tabcontent">

   <div class="tab-content-inner">
      <div class="row">
         <div class="col-md-8 own-8-col col">
            <div class="left-template-bx">
               <div class="card-body m-t-20">
                  <form  method ="POST" action="{{route('theme.loginscreen')}}" enctype="multipart/form-data" name="login_form">
                     @csrf
                     <div class="form-group">
                     @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                     </div>
                     <div class="form-group">
                        <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                     </div>
                     <!-- <div class="d-flex form-group formgrouplabel">
                        
                        <label class="lbh">Login Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1500 x 2000px" data-tooltip-location="right"> ?</a></label>
                        <input type="file" accept="image/*" id="inp3"  class="form-control login_bg_img" name="login_bg_image">
                        <label for="inp3" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                        <div class="delete-box-cm" id="remove_login_image" onClick="removeloginimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove image</div>
                        
                     </div> -->
                     @if($temploginsetting == NULL)
                     <div class="d-flex form-group formgrouplabel">
                        <label class="lbh ecom-label-reddress">Login Background Color </label>
                        <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="#ffffff">                     
                     </div>
                     <div class="d-flex form-group">
                        <label class="lbh">Login Button Color</label>
                        <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="#EE3A43">                     
                     </div>
                     @else
                     <div class="d-flex form-group">
                        <label class="lbh">Login Background Color</label>
                        <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="{{$temploginsetting->login_bg_color}}">                     
                     </div>
                     <div class="d-flex form-group">
                        <label class="lbh">Login Button Color</label>
                        <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="{{$temploginsetting->login_btn_color}}">                     
                     </div>
                     @endif
                     <div class="d-flex form-group">
                        <label class="lbh">Font Size</label>
                        <select  id="login_dropdown" onchange="logindropshow()" type="text" name="login_btn_font_size" placeholder="select Font Size">
                        @if($temploginsetting == NULL)
                           <option value="20" >20px</option>
                              <option value="18">18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                           @elseif($temploginsetting->login_btn_font_size !== "16")
                              <option value="20" {{$temploginsetting->login_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                              <option value="18" {{$temploginsetting->login_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                              <option value="16" {{$temploginsetting->login_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                              <option value="14" {{$temploginsetting->login_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                              <option value="12" {{$temploginsetting->login_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                           </select>
                           @else
                           <option value="20" >20px</option>
                              <option value="18" >18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                        @endif
                     </div>
                     <div class=" form-group">
                        <button class="savebtn" type="submit">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <!----====== Login Preview =====---->

         <div class="col-md-4 own-4-col reddress-loginpreview">
         <div class="preview-box">
                  <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                  <div class="tutorial-video-box text-center">
                  
                     <div class="app-preview cor-1-app-preview cor-1-group-container">

                        <div class="app-preview-inner e-com-2-app-preview e-com-2-group-container e-com-2-top-heade-nav e-com-2-sign-login"> 
                                      
                        @if(!isset($temploginsetting))
                        <div id="back_image" class="e-com-1-background-color-ver"></div>
                        @else
                        <div id="back_image" class="e-com-1-background-color-ver" style="background-color:{{$temploginsetting->login_bg_color}};"></div>
                        @endif

                           <div class="e-com-2-top-header-img">
                              <div class="e-com-2-log-header-img">
                                    @if(!isset($splashscreen))
                                    <img class="e-com-2log-img preview" id="preview"  src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                    @elseif ($splashscreen->splash_logo == NULL)
                                    <img class="e-com-2log-img preview" id="preview"  src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                    @else
                                    <img class="e-com-2log-img preview" id="preview"  src="{{asset($splashscreen->splash_logo)}}" alt="logo"> 
                                    @endif                               
                              </div>

                           </div>
                           <div class="e-com-2-form-grp-container e-com-2-form-mr">
                              <div class="form-group e-com-2-email-group">
                                 <label class="e-com-2-gr-label">Email</label>
                                 <div class="e-com-2-group-icn-inp">
                                    <i class="fa fa-envelope cor-1-envicon" aria-hidden="true"></i>
                                    <input class="form-cantrol" type="email" placeholder="Enter Your Email">
                                 </div>
                              </div>
                              <div class="form-group e-com-2-password-group m-b-5">
                                 <label class="e-com-2-gr-label">Password</label>
                                 <div class="e-com-2-group-icn-inp">
                                    <i class="fa fa-lock cor-1-lock" aria-hidden="true"></i>
                                    <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                 </div>
                              </div>
                              <div class="form-group text-right">
                                 <a class="e-com-2-link-f" href="#">Forgot Password?</a>
                              </div>
                            
                                 <div class="form-group">
                                 @if(!isset($temploginsetting))
                                    <button type="button" id="login_button" class="e-com-2-right-button ecom-2-logo-inbtn btn btn-dark" href="#">Sign in</button>
                                 @else
                                    <button type="button" id="login_button" class="e-com-2-right-button ecom-2-logo-inbtn btn btn-dark" href="#" style="background-color:{{$temploginsetting->login_btn_color}}; font-size:{{$temploginsetting->login_btn_font_size}}px;">Sign in</button>
                                 @endif   
                              </div>
                          
                              <p class="e-com-2-crate-acount-p">Create a new account?<a class="cor-1-crate-acount" href="#"> Sign up</a></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>

</div>
<!-------------------------------------============================  Login End  ==========================----------------------------------------------->


<!-------------------------------------============================  Sign Up ==========================----------------------------------------------->
   <div id="signup" class="tabcontent">
      <div class="tab-content-inner">
         <div class="row">
            <div class="col-md-8 own-8-col">
               <div class="left-template-bx">  
               <div class="card-body m-t-20">
                  <form  method ="POST" action="{{route('theme.signupscreen')}}" enctype="multipart/form-data" name="signup_form">
                     @csrf
                     <div class="form-group">
                     @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                     </div>
                     <div class="form-group">
                           <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                     </div>
                     <!-- <div class="d-flex form-group formgrouplabel">
                           <label class="lbh">SignUp Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1500 x 2000px" data-tooltip-location="right"> ?</a></label>
                           <input type="file" accept="image/*" id="inp4"  class="form-control signup_bg_img" name="signup_bg_image" >
                           <label for="inp4" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                           <div class="delete-box-cm" id="remove_signup_image" onClick="removesignupimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove image
                     </div>
                     </div> -->
                     @if($tempsignupsetting == NULL)
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Background Color</label>
                              <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="#ffffff">                     
                     </div>
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Button Color</label>
                              <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="#EE3A43">                     
                     </div>
                     @else
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Background Color</label>
                              <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="{{$tempsignupsetting->signup_bg_color}}">                     
                     </div>
                     <div class="d-flex form-group">
                           <label class="lbh">SignUp Button Color</label>
                              <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="{{$tempsignupsetting->signup_btn_color}}">                     
                     </div>
                     @endif
                     <div class="d-flex form-group">
                     <label class="lbh">Font Size</label>
                           <select  id="signup_dropdown" onchange="signupdropshow()" type="text" name="signup_btn_font_size" placeholder="select Font Size">
                           @if($tempsignupsetting == NULL)
                           <option value="20" >20px</option>
                              <option value="18">18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                           @elseif($tempsignupsetting->signup_btn_font_size !== "16")
                              <option value="20" {{$tempsignupsetting->signup_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                              <option value="18" {{$tempsignupsetting->signup_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                              <option value="16" {{$tempsignupsetting->signup_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                              <option value="14" {{$tempsignupsetting->signup_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                              <option value="12" {{$tempsignupsetting->signup_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                           </select>
                           @else
                           <option value="20" >20px</option>
                              <option value="18" >18px</option>
                              <option value="16" selected="selected">16px</option>
                              <option value="14" >14px</option>
                              <option value="12" >12px</option>
                           </select>
                        @endif

                     </div>

                     @if(!is_null($tempsignupsetting))

                     @if($tempsignupsetting->status !== 0)

                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="1" name="signup_status" checked>
                        <label class="custom-control-label" for="signup_status">Allow customers to browse your App without signing up</label>
                     </div>

                     @else
                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                        <label class="custom-control-label" for="signup_status">Allow customers to browse your App without signing up</label>
                     </div>
                     @endif

                     @else
                     <div class="custom-control custom-checkbox cust-chk">
                        <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                        <label class="custom-control-label" for="signup_status">Allow customers to browse your App without signing up</label>
                     </div>
                     @endif

                     <div class=" form-group">
                        <button class="savebtn" type="submit">Save</button>
                     </div>
                     
                  </form>
               </div>  
               </div>
            </div>

            <!----====== Signup Preview =====---->

            <div class="col-md-4 own-4-col signup-ecom-reddress">
            <div class="preview-box">
                     <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                     <div class="tutorial-video-box text-center">
                        <div class="app-preview e-com-2-app-preview e-com-2-group-container e-com-2-top-heade-nav e-com-2-sign-login">
                           <div class="app-preview-inner">
                           @if(!isset($tempsignupsetting))
                           <div id ="signup_back_color" class="background-color-ver"></div>
                           @else
                           <div id ="signup_back_color" class="background-color-ver" style="background-color:{{$tempsignupsetting->signup_bg_color}};"></div>
                           @endif
                             
                              <div class="e-com-2-top-header-img">
                                 <div class="e-com-2-top-header-img">
                                    <!--<div class="e-com-2-top-left-header">
                                       <div class="e-com-2-top-inner d-flex">
                                                   <div class="e-com-2-top-header">
                                                      <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                   </div>
                                                   <div class="e-com-2-top-middle-header">
                                                      <h3>Sign in</h3>
                                                   </div>
                                             </div>
                                       </div>-->
                                    <div class="e-com-2-log-header-img">
                                       @if(!isset($splashscreen))
                                       <img class="e-com-2log-img preview" id="preview"  src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                       @elseif ($splashscreen->splash_logo == NULL)
                                       <img class="e-com-2log-img preview" id="preview"  src="{{asset('asset/images/red-logo.png')}}" alt="logo">
                                       @else
                                       <img class="e-com-2log-img preview" id="preview"  src="{{asset($splashscreen->splash_logo)}}" alt="logo"> 
                                       @endif                               
                                    </div>
                                 </div>
                              </div>
                              <div class="e-com-2-sign-grp-container">
                                 <div class="form-group e-com-2-email-group m-b-5">
                                    <label class="e-com-2-gr-label">Full Name</label>
                                    <div class="e-com-2-group-icn-inp">
                                       <i class="fa fa-user" aria-hidden="true"></i>
                                       <input class="form-cantrol capitalize-input" type="text" placeholder="Enter Full Name">
                                    </div>
                                 </div>
                                 <div class="form-group e-com-2-email-group m-b-5">
                                    <label class="e-com-2-gr-label">Email</label>
                                    <div class="e-com-2-group-icn-inp">
                                       <i class="fa fa-envelope cor-1-envicon" aria-hidden="true"></i>
                                       <input class="form-cantrol" type="email" placeholder="Enter Your Email">
                                    </div>
                                 </div>
                                 <div class="form-group e-com-2-password-group m-b-5">
                                    <label class="e-com-2-gr-label">Password</label>
                                    <div class="e-com-2-group-icn-inp">
                                       <i class="fa fa-lock cor-1-lock" aria-hidden="true"></i>
                                       <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                    </div>
                                 </div>
                                 <div class="form-group e-com-2-email-group">
                                    <label class="e-com-2-gr-label">Number</label>
                                    <div class="e-com-2-group-icn-inp">
                                       <i class="fa fa-phone" aria-hidden="true"></i>
                                       <input class="form-cantrol" type="Number" placeholder="Enter Your Number">
                                    </div>
                                 </div>
                                 <div class="form-group">

                                    @if(!isset($tempsignupsetting))
                                    <button type="button" id="signup_button" class="e-com-2-right-button e-com-2-sign-upbtn btn btn-dark" href="#">Sign Up </button>
                                    @else
                                       <button type="button" id="signup_button" class="e-com-2-right-button e-com-2-sign-upbtn btn btn-dark" href="#" style="background-color:{{$tempsignupsetting->signup_btn_color}}; font-size:{{$tempsignupsetting->signup_btn_font_size}}px;">Sign Up </button>
                                    @endif
                                   
                                 </div>
                                 <p class="e-com-2-crate-acount-p">Create a new account?<a class="e-com-2-crate-acount" href="#"> Sign in</a></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
</div>
<!-------------------------------------============================  Sign Up End ==========================----------------------------------------------->



<!-------------------------------------============================  Home Screen ==========================----------------------------------------------->
      <div id="home" class="tabcontent">
         <div class="tab-content-inner">
            <div class="row">
            <!--====== Add Collection =====-->  
               <div class="col-md-8 own-8-col">
                  <div class="row card owncard addprdctrow">
                     <div class="col-md-12">
                     <h2 class="add_title mb-30">Add Collections <a class="tooltip-btn" data-tooltip="Here you can upload your categories" data-tooltip-location="right"> ?</a></h2>
                        <form class="p-10" method="POST" action="{{route('theme.collections.store')}}" enctype="multipart/form-data" >
                        
                           @csrf
                           <div class="form-group">
                              <label class="pr-label" for="exampleInputEmail1">Collection Name:</label>
                              <input type="text" class="form-control @error('collection_name') is-invalid @enderror" id="collection_names" name="collection_name" placeholder="Collection Name" required>
                              @error('collection_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror 
                           </div>
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="slugs" name="slug">
                           </div>
                           <div class="form-group">
                           @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                           </div>
                           <div class="form-group">
                              <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                           </div>
                           <!-- <div class="form-group">
                              <label class="pr-label" for="exampleInputPassword1">Collection Description:</label>
                              <textarea class="form-control" id="collection_description" name="collection_description" rows="3" placeholder="Collection Description"></textarea>
                           </div> -->
                           <div class="form-group">
                              <label class="pr-label" for="exampleInputPassword1">Collection Image: <a class="tooltip-btn" data-tooltip="Upload image 150x120 px" data-tooltip-location="right"> ?</a></label>

                              <input id="collection_image" type="file" accept="image/x-png" class="form-control imagee" name="collection_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                              <label for="collection_image" class="splogoinput"> <i class="fa fa-upload" aria-hidden="true" ></i> Upload </label>
                              <!-- <input type="file" accept="image/*" onchange="loadFile(event)"> -->
                              <img id="blah"/>
                           </div>
                           <div class="form-group">
                           <button type="submit" class="btn btn-primary">Add Collection</button>
                           @if(count($collections) > 0)
                           <button class="savebtn" id="add_prodcut1" onclick="openCity(event, 'add_prodcut')">Save</button>
                           @endif
                           </div>
                        </form>
                     </div>
                  </div>

                  
               </div>

               <!--======  home Screen Preview =====-->  

               <div class="col-md-4 own-4-col">
               <div class="preview-box">
                  <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                  <div class="tutorial-video-box text-center">
                     <div class="app-preview cor-1-app-preview">
                        <div class="background-color-ver"></div>

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


                        <div class="e-com-2-top-home">
                        @if(count($collections) == 0)
                           <div class="row no-gutters">
                              <div class="col-md-12">
                                 <div class="e-com-2-top-homeinr">
                                    <h2>Home</h2>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="e-com-2-cat-imgtext">
                                    <div class="e-com-2-cat-imgtext-inner">														 
                                       <img class="e-com-2-pro-1" src="{{asset('asset/images/pro-1.png')}}" alt="">
                                    </div>
                                    <h3>New In</h3>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="e-com-2-cat-imgtext">
                                    <div class="e-com-2-cat-imgtext-inner">														 
                                       <img class="e-com-2-pro-1" src="{{asset('asset/images/pro-2.png')}}" alt="">
                                    </div>
                                    <h3>coats</h3>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="e-com-2-cat-imgtext">
                                    <div class="e-com-2-cat-imgtext-inner">														 
                                       <img class="e-com-2-pro-1" src="{{asset('asset/images/pro-3.png')}}" alt="">
                                    </div>
                                    <h3>Tops</h3>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="e-com-2-cat-imgtext">
                                    <div class="e-com-2-cat-imgtext-inner">														 
                                       <img class="e-com-2-pro-1" src="{{asset('asset/images/pro-4.png')}}" alt="">
                                    </div>
                                    <h3>Kanitwear</h3>
                                 </div>
                              </div>
                           </div>
                           @else
                           <div class="row no-gutters">
                           <div class="col-md-12">
                              <div class="e-com-2-top-homeinr">
                                 <h2>Home</h2>
                              </div>
                           </div>
                           @foreach($collections as $collection)                           
                              <div class="col-md-6">
                                 <div class="e-com-2-cat-imgtext">
                                       <div class="e-com-2-cat-imgtext-inner">
                                       @if(!isset($collection->collection_image))
                                       <img class="e-com-3-pro-1" src="{{asset('template/images/dummy_product.jpg')}}" alt="">
                                 
                                       @else														 
                                          <img class="e-com-2-pro-1" src="{{config('services.base_url').$collection->collection_image}}" alt="">
                                       @endif
                                       </div>
                                       <h3>{{$collection->collection_name}}</h3>
                                 </div>
                              </div>
                           @endforeach
                           </div>
                           @endif
                        </div>
                     </div>

                    
                     
                  </div>
               </div>
               </div>
               <!--======  Collections Table =====-->  
             
                     <div class="col-md-12 no-padding mt-40">
                        <div class="card card-own table-wrapper">
                           <div class="card-header text-center table-heading mb-40">
                              <h2>Collections</h2>
                           </div>
                           <div class="card-body m-t-20">
                              <table class="table table-bordered table-striped table-main" id="collections">
                                 <thead>
                                    <tr>
                                       <th class="text-center" scope="col" colspan="1"><a href="#" class="" >#</a></th>
                                       <th class="text-center" scope="col" colspan="1"><a href="#" class="">Title</a></th>
                                       <th scope="col" class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($collections as $collection)
                                    <tr>
                                    <td class="pd-2 text-center" scope="col">{{$loop->iteration}}</td>
                                       <td class="pd-2 text-center" scope="col">{{$collection->collection_name}}</td>
                                       <td class="text-center">
                                       <a href="{{ route('theme.collections.edit',$collection->id)}}" id="" onclick="" class="btnedit" id="edit" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <a onclick="deleteData('{{route('theme.collections.destroy',$collection->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<!-------------------------------------============================  My Account  ==========================----------------------------------------------->
            <div id="rest_screens" class="tabcontent">
                  <div class="tab-content-inner">
                     <div class="row justify-content-center">
                        <!--====== Add Collection =====-->  
                        
                        <!--======  home Screen Preview =====-->  
                        <div class="col-md-4 own-4-col allscreensaslidercol-4">
                           <div class="preview-box">
                              <h3 class="app_screens_title">App Screens</h3>
                              <div class="tutorial-video-box">
                                 <div class="app-preview cor-1-app-preview cor-1-group-container">
                             
                                    <div id="theme-showcase-all" class="app-showcase-main owl-carousel">
                                    <div class="theme-slide-itm">
                                    <img class="appfrm appscreenprewe " src="{{asset('template/images/reddress/my_account.png')}}" alt="">
                                    </div>
                                    <div class="theme-slide-itm">
                                    <img class="appfrm appscreenprewe " src="{{asset('template/images/reddress/wishlist.png')}}" alt="">
                                    </div>
                                    <div class="theme-slide-itm">
                                    <img class="appfrm appscreenprewe" src="{{asset('template/images/reddress/checkout.png')}}"  alt="">
                                    </div>
                                    <div class="theme-slide-itm">
                                    <img class="appfrm appscreenprewe"  src="{{asset('template/images/reddress/payment.png')}}" alt="">
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
                  </div>
                  </div>
               </div>
            </div>
         </main>

<div class="modal fade popup-template-modal" id="splash_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>First screen users see when they open your App. This screen appears for a couple seconds.</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="signup_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

  <div class="modal fade popup-template-modal" id="login_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
  <div class="modal fade popup-template-modal" id="home_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The first screen a users will view after logging in</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
  <div class="modal fade popup-template-modal" id="account_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The screen will show a users other sections</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>
 

  <div class="modal fade popup-template-modal" id="add_product_screen" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>List your products with variants of color and size if required </h1>
<button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
         </div>
      </div>
  </div>

<script>

function openCity(evt, cityName) { 

if(cityName == "splashscreen"){

   var screen1 = $.cookie("splashscreen");

   if(screen1 == undefined)
   {
      $('body').find('#splash_screen').modal('show');
      $.cookie("splashscreen", 1);

   }else(screen1 == 1)
   {
      $('body').find('#splash_screen').modal('hide');
   }
    
}
else if(cityName == "signup"){

   var screen2 =  $.cookie("signup");

   if(screen2 == undefined)
   {
      $('body').find('#signup_screen').modal('show');
      $.cookie("signup", 1);

   }else(screen2 == 1)
   {

      $('body').find('#signup_screen').modal('hide');

   }

}
else if(cityName == "login"){

   var screen3 =  $.cookie("login");

   if(screen3 == undefined)
   {
      $('body').find('#login_screen').modal('show');
      $.cookie("login", 1);

   }else(screen3 == 1)
   {
      $('body').find('#login_screen').modal('hide');
   }   

}

else if(cityName == "home"){

   var screen4 =  $.cookie("home");

   if(screen4 == undefined)
   {

   $('body').find('#home_screen').modal('show');
   $.cookie("home", 1);

   }else(screen4 == 1)
   {
      $('body').find('#home_screen').modal('hide');
   } 

}
else if(cityName == "add_prodcut"){

   var screen5 =  $.cookie("add_prodcut");

   if(screen5 == undefined)
   {

      $('body').find('#add_product_screen').modal('show');
      $.cookie("add_prodcut", 1);

   }else(screen5 == 1)
   {

      $('body').find('#add_product_screen').modal('hide');

   } 

}
else if(cityName == "my_account"){

   var screen6 =  $.cookie("my_account");

   if(screen6 == undefined)
   {

   $('body').find('#account_screen').modal('show');

   $.cookie("my_account", 1);

   }else(screen6 == 1)
   {

      $('body').find('#account_screen').modal('hide');

   } 

}


   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   document.getElementById(cityName).style.display = "block";
   evt.currentTarget.className += " active";
   document.cookie = "cityName="+cityName+"1; expires=Thu, 18 Dec 2090 12:00:00 UTC; path=/";
}

document.addEventListener("DOMContentLoaded", function(event){
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   var selectedCity = getCookie("cityName");
   if(selectedCity){
      var result = selectedCity.match(/[^\d]+|\d+/g);
      if(result[0] != ""){
        document.getElementById(result[0]).style.display = "block";
        document.getElementById(selectedCity).className+= " active";
      } else {
         document.getElementById('splashscreen').style.display = "block";
         document.getElementById('splashscreen1').className+= " active"
      }
    } else {
         document.getElementById('splashscreen').style.display = "block";
         document.getElementById('splashscreen1').className+= " active"
   }
});
   
function getCookie(cname) {
       var name = cname + "=";
       var decodedCookie = decodeURIComponent(document.cookie);
       var ca = decodedCookie.split(';');
       for(var i = 0; i <ca.length; i++) {
           var c = ca[i];
           while (c.charAt(0) == ' ') {
               c = c.substring(1);
           }
           if (c.indexOf(name) == 0) {
               return c.substring(name.length, c.length);
           }
       }
       return "";
   }    
         
</script>

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>


<!--Category Delete Modal here -->

<div id="myModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteForm">
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

<!--Category Delete Modal End here -->

<!--Product Delete Modal here -->

<div id="myProductModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteProductForm">
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

<!--Product Delete Modal End here -->

@include('admin.template.partials.footer')
<script>
$('#signup_status').on('click' , function(){

   $('#signup_status').val('0');

   if($('#signup_status').is(":checked")){

      $('#signup_status:checked').val('1');

   }else{

      $('#signup_status').val('0');
   }


   
});
</script>