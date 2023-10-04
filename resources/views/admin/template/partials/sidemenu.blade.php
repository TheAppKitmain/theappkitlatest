
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
               
                  <?php 
                  if(Auth::user()->parent_id == 0){
                     $user_id = Auth::user()->id;
                     }else{
                     $user_id = Auth::user()->parent_id;	 
                  }
                  $count = App\Usertheme::where('user_id',$user_id)->count(); ?>

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

               @if(request()->routeIs('theme*'))

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.coupon.index','theme.coupon.create','theme.theme_settings.edit','theme.theme_settings.show']) ? 'active' : '' }}" href="{{ URL::to('theme/theme_settings') }}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-20-active.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-20-unactive.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Apps Screens</span>
                  </a>
               </li>

               

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.branding.index','theme.branding.create','theme.branding.edit','theme.branding.show']) ? 'active' : '' }}" href="{{ URL::to('theme/branding') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-21-unactive.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-21-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">App Settings</span>
                  </a>
               </li>


               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.products.index','theme.products.create','theme.products.edit','theme.products.show']) ? 'active' : '' }}" href="{{ URL::to('theme/products') }}">
                  <span class="navimages">
                     <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-product.png')}}" alt="logo">
                     <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-product-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Products</span>
                  </a>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.coupon','theme.addcoupon']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-cpn.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31-cpn-white.png')}}" alt="logo"></span><span class="menuname">Coupon</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.coupon','theme.addcoupon'])) style="display:block;" @else style="display:none;" @endif>

                    <li>

                      <a class="{{ in_array(Route::currentRouteName(), ['theme.coupon']) ? 'active' : '' }}" href="{{ URL::to('theme/coupon') }}">Coupon</a>

                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.addcoupon']) ? 'active' : '' }}" href="{{ URL::to('theme/addcoupon') }}">Add coupon</a>
                    </li>
                  </ul>
               </li>


               <li class="{{ in_array(Route::currentRouteName(), ['theme.storestripe','theme.addstripe','theme.stripe','theme.editstripe']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-3.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31.png')}}" alt="logo"></span><span class="menuname">Stripe</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.stripe','theme.addstripe'])) style="display:block;" @else style="display:none;" @endif>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.stripe']) ? 'active' : '' }}" href="{{ URL::to('theme/stripe') }}">Stripe Credentials</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.addstripe']) ? 'active' : '' }}" href="{{ URL::to('theme/addstripe') }}">Add Stripe Credential</a>
                    </li>
                  </ul>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.shipping.index','theme.shipping.create','theme.shipping.edit','theme.shipping.show']) ? 'active' : '' }}" href="{{ URL::to('theme/shipping') }}" >
                  <span class="navimages">
                     <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-333.png')}}" alt="logo">
                     <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-333-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Shipping</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.paymentinfo.index','theme.paymentinfo.create','theme.paymentinfo.edit','theme.paymentinfo.show']) ? 'active' : '' }}" href="{{ URL::to('theme/paymentinfo') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-21-unactive.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-21-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Accepting Payments</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.myorders.index','theme.myorders.create','theme.myorders.edit','theme.myorders.show']) ? 'active' : '' }}" href="{{ URL::to('theme/myorders') }}">
                  <span class="navimages">
                     <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-contract-active.png')}}" alt="logo">
                     <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-contract.png')}}" alt="logo">
                  </span>
                  <span class="menuname">My Orders</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.notifications.index','theme.notifications.create','theme.notifications.edit','theme.notifications.show']) ? 'active' : '' }}" href="{{ URL::to('theme/notifications') }}">
                  <span class="navimages">
                     <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-notification.png')}}" alt="logo">
                     <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-notification-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Notifications</span>
                  </a>
               </li>

               <li>
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.privacypolicy.index','theme.privacypolicy.create','theme.privacypolicy.edit','theme.privacypolicy.show']) ? 'active' : '' }}" href="{{ URL::to('theme/privacypolicy') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-21-unactive.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-21-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Privacy Policy</span>
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

               @endif

                  <!-- <li class="sidebar-dropdown">
                     <a href="#">
                     <span class="navimages">
					 <img class="navinactivimg" src="{{asset('asset/images/icon-3.png')}}" alt="logo">
					 <img class="navactivimg" src="{{asset('asset/images/icon-3-active.png')}}" alt="logo">
					 </span>
					 <span>Online Store</span>
                     <i class="fa fa-angle-right" aria-hidden="true"></i>
                     </a>
                     <ul class="sidebar-submenu" style="display:none;">
                        <li>
                           <a href="{{ URL::to('collections') }}">Collections</a>
                        </li>
                        <li>
                           <a href="{{ URL::to('products') }}">Products</a>
                        </li>
                     </ul>
                  </li> -->

                  <!-- <li>
                     <a class="" href="{{ URL::to('pushnotification') }}">
                     <span class="navimages">
                        <img class="navinactivimg" src="{{asset('asset/images/icon-4.png')}}" alt="logo">
                        <img class="navactivimg" src="{{asset('asset/images/icon-4-active.png')}}" alt="logo">
					      </span>
					      <span class="menuname">Notifications & Email</span>
                     </a>
                  </li> -->
                     <!-- <li>
                        <a class="" href="{{ URL::to('publish') }}">
                        <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/icon-5.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/icon-5-active.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Publish</span>
                        </a>
                     </li> -->
				      <!-- <li>
                     <a class="" href="#">
                     <span class="navimages">
                        <img class="navinactivimg" src="{{asset('asset/images/icon-6.png')}}" alt="logo">
                        <img class="navactivimg" src="{{asset('asset/images/icon-6-active.png')}}" alt="logo">
					      </span>
					      <span class="menuname">Billing / Payments</span>
                     </a>
                  </li> -->

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





