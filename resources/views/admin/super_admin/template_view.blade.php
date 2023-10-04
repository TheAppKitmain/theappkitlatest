@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
  <div class="mainwrapper-inner-container">

<div class="container-fluid">
   <div class="row clearfix p-30 beta-wrapper">
      <div class="col-md-12">
         <div class="card">
            <div class="tab">
               <button class="tablinks active" onclick="openCity(event, 'UserDetails')">UserDetails</button> 
                <button class="tablinks" onclick="openCity(event, 'MyApp')">My App</button>
                <button class="tablinks" onclick="openCity(event, 'splashscreen')">Splash Screen</button>   
                <button class="tablinks" onclick="openCity(event, 'Branding')">Branding</button>
                <button class="tablinks" onclick="openCity(event, 'collections')">Collections</button>
                <button class="tablinks" onclick="openCity(event, 'products')">Products</button>
                <button class="tablinks" onclick="openCity(event, 'Maintenance')">Maintenance</button>


            </div>
             <!--------------------------------- Start User Details Data------------------------------------->
             <div id="UserDetails" class="tabcontent" style="display: block;">
                    @if ($user == null)
                        <h1 class="empty-title">Client has no information</h1>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="titleapp">User Information</h3>
                                <div class="card card-bug">
                                    <div class="row">
                                        <div class="col-md-6 store_info_details ">
                                            <label class="plcy-label">First Name</label>
                                            <h5>{{ $user->first_name }}</h5>
                                        </div>
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Last Name</label>
                                            <h5>{{ $user->last_name }}</h5>
                                        </div><br><br>
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Business Name</label>
                                            <h5>{{ $user->business_name }}</h5>
                                        </div>
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Country</label>
                                            <h5>{{ $user->country }}</h5>
                                        </div>
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Email</label>
                                            <h5>{{ $user->email }}</h5>
                                        </div>
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Number</label>
                                            <h5>{{ $user->number }}</h5>
                                        </div>
                                        @if (!is_null($user->referred_by))
                                        <div class="col-md-6 store_info_details">
                                            <label class="plcy-label">Referred By</label>
                                            <h5>{{ $user->referred_by }}</h5>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
            <!--------------------------------- My App ------------------------------------->
            <div id="MyApp" class="tabcontent">

                  <div class="main-home">
                     <div class="smallappmain-wrapper ">
                        <div class="main-container">
                           <div class="main-container-inner ">
                              <div class="container-fluid">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="row card owncard">
                                                <div class="col-md-12">
                                                   <div class="card-header text-center table-heading mb-10 use-template">
                                                   <h2>{{$themetemplate->theme_name}}</h2>
                                                   </div>
                                                </div>									   
                                             <div class="col-md-3 mt-20">
                                                <div class="our-work-img">
                                                   <img class="bgmb1" src="{{asset($themetemplate->theme_thumbnail)}}" alt="right-mobile">
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
          
            <!--------------------------------- Splash Screen ------------------------------------->
            <div id="splashscreen" class="tabcontent">
      
                     <div class="main-home">
                        <div class="smallappmain-wrapper ">
                           <div class="main-container">
                              <div class="main-container-inner ">
                                 <div class="container-fluid">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="row card owncard ">
                                                   <div class="col-md-12">
                                                      <div class="card-header text-center table-heading mb-10 use-template">
                                                      <h2>{{$themetemplate->theme_name}}</h2>
                                                      </div>
                                                   </div>
                                                   
                                                   @if($splashscreen == NULL)									   
                                                   
                                                   <h1 class="empty-title">Client has not added details</h1>

                                                   @else
                                                   <div class="col-md-6 mt-20">
                                                        <label class="plcy-label">Splash Logo</label>
                                                        <div class="w-100">
                                                         <img class="imgl" src="{{asset($splashscreen->splash_logo)}}" alt="right-mobile">
                                                         </div>
                                                   </div>

                                                   @if($splashscreen->splash_background_image == NULL)


                                                   @else
                                                      <div class="col-md-6 mt-20">
                                                      <label class="plcy-label">Splash Background image</label>
                                                            <img class="imgsp" src="{{asset($splashscreen->splash_background_image)}}" alt="right-mobile">
                                                      </div>
                                                   @endif

                                                   <div class="col-md-6 mt-20">
                                                      <label class="plcy-label">Background Color</label>
                                                         <h5>{{$splashscreen->splash_background_color}}</h5>
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

            <!--------------------------------- App Settings ------------------------------------->
            <div id="Branding" class="tabcontent">
       
                  <div class="main-home">
                     <div class="smallappmain-wrapper ">
                        <div class="main-container">
                           <div class="main-container-inner ">
                              <div class="container-fluid">
                                 <div class="row">
                                    <div class="col-md-12">
                                             <div class="row card owncard ">
                                       			
                                                <div class="col-md-12">
                                                   <div class="card-header text-center table-heading mb-10 use-template">
                                                   <h2>{{$themetemplate->theme_name}}</h2>
                                                   </div>
                                                </div>
                                                @if($appsetting == NULL)
                                                <h1 class="empty-title">Client has not added details</h1>
                                                @else										   
                                                <div class="col-sm-6">
												               <label class="plcy-label">Nav Background Color</label>
                                                   <h5>{{$appsetting->nav_bg_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Nav Heading Color</label>
                                                   <h5>{{$appsetting->nav_heading_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Nav Heading Font</label>
                                                   <h5>{{$appsetting->nav_heading_font}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Screen Background Color</label>
                                                   <h5>{{$appsetting->screen_bg_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Heading Color</label>
                                                   <h5>{{$appsetting->heading_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Heading Font</label>
                                                   <h5>{{$appsetting->heading_font}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Sub Heading Color</label>
                                                   <h5>{{$appsetting->sub_heading_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Sub Heading Font</label>
                                                   <h5>{{$appsetting->sub_heading_font}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Paragraph Color</label>
                                                   <h5>{{$appsetting->paragraph_color}}</h5>
                                                </div>
                                                <div class="col-sm-6 ">
												               <label class="plcy-label">Paragraph Font Size</label>
                                                   <h5>{{$appsetting->paragraph_font}}</h5>
                                                </div>
                                                <div class="col-sm-6 ">
												               <label class="plcy-label">Primary Button Color</label>
                                                   <h5>{{$appsetting->primary_btn_color}}</h5>
                                                </div>
                                                <div class="col-sm-6 ">
												               <label class="plcy-label">Primary Button Font Size</label>
                                                   <h5>{{$appsetting->primary_btn_font}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Primary Button Background Color</label>
                                                   <h5>{{$appsetting->primary_btnbg_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Success Button Color</label>
                                                   <h5>{{$appsetting->success_btn_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
												               <label class="plcy-label">Success Button Font size</label>
                                                   <h5>{{$appsetting->success_btn_font}}</h5>
                                                </div>
                                                <div class="col-sm-6 ">
                                                   <label class="plcy-label">Success Button Background Color</label>
                                                   <h5>{{$appsetting->success_btnbg_color}}</h5>
                                                </div>
                                                <div class="col-sm-6 ">
                                                   <label class="plcy-label">Danger Button Color</label>
                                                   <h5>{{$appsetting->danger_btn_color}}</h5>
                                                </div>
                                                <div class="col-sm-6">
                                                   <label class="plcy-label">Danger Button Font size</label>
                                                   <h5>{{$appsetting->danger_btn_font}}</h5>
                                                </div>
                                                <div class="col-sm-6">
                                                   <label class="plcy-label">Danger Button Background color</label>
                                                   <h5>{{$appsetting->danger_btnbg_color}}</h5>
                                                </div>
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

            <!--------------------------------- Maintenance ------------------------------------->

            <div id="Maintenance" class="tabcontent agreement-tabcontent">
               <div class="card card-bug card-bug-row-t">
                  <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                  <form id="maintanence_mail_data" >
                     @csrf
                        <div class="row">
                           <div class="form-group">
                              <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
                              <input type="hidden" class="form-control" name="app_id" value="{{$themetemplate->id}}">
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary text-center">Send Maintenance Mail</button>
                           </div><br><br>
                        </div>
                  </form>
                  </div>
                  <div class="col-md-4"></div>
                  </div>
               </div>
               </div>

            <!--------------------------------- Maintenance end ------------------------------------->

            <!--------------------------------- Products ------------------------------------->

            <div id="products" class="tabcontent">
      
                     <div class="main-home">
                        <div class="smallappmain-wrapper ">
                           <div class="main-container">
                              <div class="main-container-inner ">
                                 <div class="container-fluid">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="row card owncard ">
                                                   <div class="col-md-12">
                                                      <div class="card-header text-center table-heading mb-10 use-template">
                                                      <h2>{{$themetemplate->theme_name}}</h2>
                                                      </div>
                                                   </div>
                                                   
                                                   @if(count($products) == 0)
                                                   <h1 class="empty-title">Client has not added details</h1>
                                                   @else
                                                   <table id="product_details" class="table table-bordered table-striped table-main" style="width:100%">
                                                   <thead>
                                                      <tr>
                                                         <th>Product Name</th>
                                                         <th>Stock qty</th>
                                                         <th>Product Price</th>
                                                         <th>Sale Price</th>
                                                         <th>Product Image</th>
                                                         <th>Collection Name</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @foreach($products as $product)  
                                                      <tr>
                                                         <td class="pd-2" scope="col">{{$product->product_name}}</td>
                                                         <td class="pd-2">{{$product->stock_qty}}</td>
                                                         <td class="pd-2">{{$product->product_price}}</td>
                                                         <td class="pd-2">{{$product->sale_price}}</td> 
                                                         <td class="pd-2"><img class="imgsp" src="{{asset($product->product_image)}}" alt="right-mobile"></td>                                       
                                                         <td class="pd-2">{{$product->get_collection_name->collection_name ?? ""}}</td>
                                                      </tr>
                                                      @endforeach
                                                      </tr>
                                                   </tbody>
                                                </table>
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

             <!--------------------------------- Products ------------------------------------->

   <div id="collections" class="tabcontent">
      
      <div class="main-home">
         <div class="smallappmain-wrapper ">
            <div class="main-container">
               <div class="main-container-inner ">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="row card owncard ">
                                    <div class="col-md-12">
                                       <div class="card-header text-center table-heading mb-10 use-template">
                                       <h2>{{$themetemplate->theme_name}}</h2>
                                       </div>
                                    </div>
                                    
                                    @if(count($collections) == 0)
                                    <h1 class="empty-title">Client has not added details</h1>
                                    @else

                                    @foreach($collections as $collection)

                                    <div class="col-md-6 mt-20">
                                         <label class="plcy-label">Collection Name</label>
                                         <div class="w-100">
                                          <h1>{{$collection->collection_name}}</h1>
                                          </div>
                                    </div>

                                    <div class="col-md-6 mt-20">
                                          <label class="plcy-label">Collection Image</label>
                                          <div class="w-100">
                                          <img class="imgl" src="{{asset($collection->collection_image)}}" alt="right-mobile">
                                          </div>
                                    </div>

                                    @endforeach
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
</div>
</div>
</div>
<script>



   function openCity(evt, cityName) {
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
   }


</script>
@include('admin.super_admin.partials.footer')
<script>
      
$("#maintanence_mail_data").submit(function(a) {
 a.preventDefault();
  $.ajax({
  url: "{{ route('maintanence_mail') }}",
  type: "POST",        
  data: new FormData(this),         
  contentType: false,         
  cache: false,  
  processData:false,

  success:function(response){
   //alert(response);
      var staus_value = "Complete";
      $(".bug_change_status").text('Status:Complete');
      swal(staus_value, "Mail send successfully", "success");
   }

   });
});
</script>