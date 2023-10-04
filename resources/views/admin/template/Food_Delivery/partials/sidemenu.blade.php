
<div class="sidemenu-wrapper">
         <div class="sidemenu">
         <a class="navbar-brand mobile-logbar" href="{{ URL::to('/') }}"> The App Kit</a>
            <nav class="sidenavbar">       
               <ul class="sidenavbarul">
               <li>
                  <a class="{{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{ URL::to('dashboard') }}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-1.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-1-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Home Screen</span>
                  </a>
               </li>
               <li>     
                  <?php  $count = App\Usertheme::where('user_id',Auth::user()->id)->count(); ?>

                  <a class="{{ in_array(Route::currentRouteName(), ['myapp.index','myapp.create','myapp.edit','myapp.show']) ? 'active' : '' }}" href="{{ URL::to('myapp') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-2.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-2-active.png')}}" alt="logo">
                  </span>
                  @if($count > 1)
                  <span class="menuname"> My Apps ({{$count}})</span>
                  @else
                  <span class="menuname"> My App ({{$count}})</span>
                  @endif
                  </a>
               </li>   

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.food_theme_settings.index','theme.food_theme_settings.create','theme.food_theme_settings.edit','theme.food_theme_settings.show']) ? 'active' : '' }}" href="{{ URL::to('theme/food_theme_settings') }}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-20-active.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-20-unactive.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Apps Screens</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.app_settings.index','theme.app_settings.create','theme.app_settings.edit','theme.app_settings.show']) ? 'active' : '' }}" href="{{ URL::to('theme/app_settings') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-21-unactive.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-21-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">App Settings</span>
                  </a>
               </li>

                <li class="{{ in_array(Route::currentRouteName(), ['theme.food_category.create','theme.food_category.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/catgory.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/catgory-white.png')}}" alt="logo"></span><span class="menuname">Categories</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.food_category.create','theme.food_category.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_category.create']) ? 'active' : '' }}" href="{{route('theme.food_category.create')}}">Add New Category</a>
                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_category.index']) ? 'active' : '' }}" href="{{route('theme.food_category.index')}}">All Categories</a>
                    </li>
                  </ul>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.food_products.index','theme.food_product_attributes.index','theme.add_products','theme.food_product_attributes.edit']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-product.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/sidebar-icon-product-active.png')}}" alt="logo"></span><span class="menuname">Products</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.food_products.index','theme.food_product_attributes.index','theme.add_products','theme.food_product_attributes.edit'])) style="display:block;" @else style="display:none;" @endif>
                  
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.add_products']) ? 'active' : '' }}" href="{{route('theme.add_products',1)}}">Add New Products</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_products.index']) ? 'active' : '' }}" href="{{route('theme.food_products.index')}}">All Products</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_product_attributes.edit']) ? 'active' : '' }}" href="{{route('theme.food_product_attributes.edit',1)}}">Add Featured Products</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_product_attributes.index']) ? 'active' : '' }}" href="{{route('theme.food_product_attributes.index')}}">Featured Products</a>
                    </li>
                  </ul>
               </li>

               

                <li class="{{ in_array(Route::currentRouteName(), ['theme.food_promo.create','theme.food_promo.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-cpn.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31-cpn-white.png')}}" alt="logo"></span><span class="menuname">Promo</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.food_promo.create','theme.food_promo.index'])) style="display:block;" @else style="display:none;" @endif>
                  
                    <li>

                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_promo.create']) ? 'active' : '' }}" href="{{route('theme.food_promo.create')}}">Add New Promo</a>

                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.food_promo.index']) ? 'active' : '' }}" href="{{route('theme.food_promo.index')}}">All Promo</a>
                    </li>
                  </ul>
               </li>

                <li>
                  <a class="{{ (request()->is('theme/banner')) ? 'active' : '' }}" href="{{ URL::to('theme/banner') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/billboard.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/billboard_active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Banner</span>
                  </a>
               </li>

               <li>
                  <a class="{{ (request()->is('theme/shop')) ? 'active' : '' }}" href="{{ URL::to('theme/shop') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/shop.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/shop-white.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Shop</span>
                  </a>
               </li>

               @php $count_order = \App\Models\Template\Food_Delivery\FoodOrder::where('status',null)->count();@endphp
       
              <li>
                  <a class="{{ (request()->is('theme/food_orders')) ? 'active' : '' }}" href="{{route('theme.orders')}}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-contract-active.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-contract.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Orders({{$count_order}})</span>
                  </a>
               </li>
<!-- 
               <li>
                  <a class="{{ (request()->is('theme/working_days')) ? 'active' : '' }}" href="{{route('theme.working_days')}}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-contract-active.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-contract.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Working Days</span>
                  </a>
               </li> -->

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.privacypolicy.index','theme.privacypolicy.create','theme.privacypolicy.edit','theme.privacypolicy.show']) ? 'active' : '' }}" href="{{ URL::to('theme/privacypolicy') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-21-unactive.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-21-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Privacy Policy</span>
                  </a>
               </li>

               <!-- <li class="{{ in_array(Route::currentRouteName(), ['theme.storestripe','theme.addstripe','theme.stripe','theme.editstripe']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/stripeimg.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/stripewhite.png')}}" alt="logo"></span><span class="menuname">Stripe</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.stripe','theme.addstripe'])) style="display:block;" @else style="display:none;" @endif>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.stripe']) ? 'active' : '' }}" href="{{ URL::to('theme/stripe') }}">Stripe Credentials</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.addstripe']) ? 'active' : '' }}" href="{{ URL::to('theme/addstripe') }}">Add Stripe Credential</a>
                    </li>
                  </ul>
               </li> -->

               <li class="{{ in_array(Route::currentRouteName(), ['theme.storesquare','theme.addsquare','theme.square','theme.editsquare']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/aqimg.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/aqimgwhite.png')}}" alt="logo"></span><span class="menuname">Square</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.square','theme.addsquare'])) style="display:block;" @else style="display:none;" @endif>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.square']) ? 'active' : '' }}" href="{{ URL::to('theme/square') }}">Square Credentials</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.addsquare']) ? 'active' : '' }}" href="{{ URL::to('theme/addsquare') }}">Add Square Credential</a>
                    </li>
                  </ul>
               </li>

                <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.paymentinfo.index','theme.paymentinfo.create','theme.paymentinfo.edit','theme.paymentinfo.show']) ? 'active' : '' }}" href="{{ URL::to('theme/paymentinfo') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/paymentonline.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/onlinepaymentwhite.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Accepting Payments</span>
                  </a>
               </li>        

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.food_customers.index','theme.food_customers.create','theme.food_customers.edit','theme.food_customers.show']) ? 'active' : '' }}" href="{{ URL::to('theme/food_customers') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-3.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Customers</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.food_contacts.index','theme.food_contacts.create','theme.food_contacts.edit','theme.food_contacts.show']) ? 'active' : '' }}" href="{{ URL::to('theme/food_contacts') }} ">
                  <span class="navimages">
                    <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-chat.png')}}" alt="logo">
                    <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-chat-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Inbox</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.food_notifications.index','theme.food_notifications.create','theme.food_notifications.edit','theme.food_notifications.show']) ? 'active' : '' }}" href="{{ URL::to('theme/food_notifications') }}">
                  <span class="navimages">
                     <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-notification.png')}}" alt="logo">
                     <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-notification-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Notifications</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.publish.index','theme.publish.create','theme.publish.edit','theme.publish.show']) ? 'active' : '' }}" href="{{ URL::to('theme/publish') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-5.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-5-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Publish App</span>
                  </a>
               </li>

               <li>
               <a class="{{ in_array(Route::currentRouteName(), ['my-temp-account.index','my-temp-account.create','template_user.edit','my-temp-account.show']) ? 'active' : '' }}" href="{{ URL::to('my-temp-account') }}">
                <span class="navimages">
                <img class="navinactivimg" src="{{asset('asset/images/icon-7.png')}}" alt="logo">
                <img class="navactivimg" src="{{asset('asset/images/icon-7-active.png')}}" alt="logo">
                </span>
                <span class="menuname">My Account</span>
                          </a>
                          <a class="mob-a-d" href="{{ URL::to('home') }}">
                          <span class="navimages">
                <img class="navinactivimg" src="{{asset('asset/images/icon-7.png')}}" alt="logo">
                <img class="navactivimg" src="{{asset('asset/images/icon-7-active.png')}}" alt="logo">
                </span>
                <span class="menuname">Switch to custom</span>
                     </a>
               </li>


               </ul>
            </nav>
         </div>
      </div>

      



