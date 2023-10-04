
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
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_theme_settings.index','theme.booking_theme_settings.create','theme.booking_theme_settings.edit','theme.booking_theme_settings.show']) ? 'active' : '' }}" href="{{ URL::to('theme/booking_theme_settings') }}">
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

                <li class="{{ in_array(Route::currentRouteName(), ['theme.cartypes.create','theme.cartypes.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/cartype.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/cartypewhite.png')}}" alt="logo"></span><span class="menuname">Car Types</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.cartypes.create','theme.cartypes.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.cartypes.create']) ? 'active' : '' }}" href="{{route('theme.cartypes.create')}}">Add New Car type</a>
                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.cartypes.index']) ? 'active' : '' }}" href="{{route('theme.cartypes.index')}}">All Car types</a>
                    </li>
                  </ul>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.services.create','theme.services.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/car-service.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/car-servicewhite.png')}}" alt="logo"></span><span class="menuname">Services</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.services.create','theme.services.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.services.create']) ? 'active' : '' }}" href="{{route('theme.services.create')}}">Add New Service</a>
                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.services.index']) ? 'active' : '' }}" href="{{route('theme.services.index')}}">All Services</a>
                    </li>
                  </ul>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.deals.create','theme.deals.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/deals.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/dealswhite.png')}}" alt="logo"></span><span class="menuname">Deals</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.deals.create','theme.deals.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.deals.create']) ? 'active' : '' }}" href="{{route('theme.deals.create')}}">Add New Deal</a>
                    </li>

                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.deals.index']) ? 'active' : '' }}" href="{{route('theme.deals.index')}}">All Deals</a>
                    </li>
                  </ul>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.booking_promo.create','theme.booking_promo.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/faqicon.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/faqiconwhite.png')}}" alt="logo"></span><span class="menuname">Promo</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.booking_promo.create','theme.booking_promo.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_promo.create']) ? 'active' : '' }}" href="{{route('theme.booking_promo.create')}}">Add New Promo</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_promo.index']) ? 'active' : '' }}" href="{{route('theme.booking_promo.index')}}">All Promo</a>
                    </li>
                  </ul>
               </li>

               <li class="{{ in_array(Route::currentRouteName(), ['theme.booking_faqs.create','theme.booking_faqs.index']) ? 'active' : '' }} sidebar-dropdown">
                  <a href="#">
                  <span class="navimages"><img class="navinactivimg" src="{{asset('asset/images/promo.png')}}" alt="logo"><img class="navactivimg" src="{{asset('asset/images/promowhite.png')}}" alt="logo"></span><span class="menuname">Faqs</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['theme.booking_faqs.create','theme.booking_faqs.index'])) style="display:block;" @else style="display:none;" @endif>                
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_faqs.create']) ? 'active' : '' }}" href="{{route('theme.booking_faqs.create')}}">Add New Faq</a>
                    </li>
                    <li>
                      <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_faqs.index']) ? 'active' : '' }}" href="{{route('theme.booking_faqs.index')}}">All Faqs</a>
                    </li>
                  </ul>
               </li>



               
               @php $count_order = \App\Models\Template\Food_Delivery\FoodOrder::where('status',null)->count();@endphp
       
              <li>
                  <a class="{{ (request()->is('theme/booking_orders')) ? 'active' : '' }}" href="{{route('theme.booking_orders.index')}}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-contract-active.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-contract.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Orders({{$count_order}})</span>
                  </a>
               </li>

               <li>
                  <a class="{{ (request()->is('theme/booking_contacts')) ? 'active' : '' }}" href="{{route('theme.booking_contacts')}}">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/contactus-img.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/contactuswhite.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Contact Us</span>
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

               <li class="{{ in_array(Route::currentRouteName(), ['theme.storestripe','theme.addstripe','theme.stripe','theme.editstripe']) ? 'active' : '' }} sidebar-dropdown">
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
                  <a class="{{ in_array(Route::currentRouteName(), ['theme.booking_customers.index','theme.booking_customers.create','theme.booking_customers.edit','theme.booking_customers.show']) ? 'active' : '' }}" href="{{ URL::to('theme/booking_customers') }} ">
                  <span class="navimages">
                  <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-3.png')}}" alt="logo">
                  <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31.png')}}" alt="logo">
                  </span>
                  <span class="menuname">Customers</span>
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

      



