<header>
    <div class="mob-rw">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 mob-col-none">
                    <div class="logo">
                        <a class="brndlogoimg" href="{{ URL::to('/') }}">
                            <img class="" src="{{ asset('asset/images/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-sm-9 ryt-dropdown">
                    <div class="mob-icons">
                        <i class="fa fa-bars closeside" aria-hidden="true"></i>
                        <i class="fa fa-times " aria-hidden="true"></i>
                    </div>
                    <div class="float-right mob-right-txt">
                        <nav class="navbar navbar-expand-lg navbar-light ">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <?php



	 if(Auth::user()->parent_id == 0){
		$user_id = Auth::user()->id;
	 }else{
		$user_id = Auth::user()->parent_id;
	 }

	 $have_temp = App\Usertheme::where('user_id',$user_id)->first();
	 if(!is_null($have_temp)){ ?>
                                <a href="{{ URL::to('dashboard') }}" class="btn btn-success btn-swtch-temp">Switch to
                                    Template</a>
                                <?php
	 }
	 else
	 {
     ?>
                                <a href="{{ URL::to('themes') }}" class="btn btn-success btn-swtch-temp">Switch to
                                    Template</a>
                                <?php
	 }
?>

                                <!-- <a href="#" class="btn btn-success btn-swtch-temp temp_popup">Switch to Template</a>  -->
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown dropdown-right notification-li d-flex">
                                        <a class="nav-link dropdown-toggle user-rightimg" href="javascript:void(0)"
                                            id="navbarDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span>
                                                <p class="username-fl">{{ Auth::user()->first_name[0] }}</p>
                                            </span>
                                        </a>
                                        <a class="lgot" href="{{ route('logout') }}">
                                            <img class="" src="{{ asset('asset/images/sidebar-icon-4.png') }}"
                                                alt="logo"><span class="menuname">Log out</span>
                                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                        <div class="dropdown-menu dropdownmenutop" aria-labelledby="navbarDropdown">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
</header>
<div class="sidemenu-wrapper mobile-sidenev">
    <div class="sidemenu">
        <div class="logo logo-mob-sidebar">
            <a class="brndlogoimg" href="{{ URL::to('/') }}">
                <img class="" src="{{ asset('asset/images/logo.png') }}" alt="logo">
            </a>
        </div>
        <nav class="sidenavbar">
            <ul class="sidenavbarul">

                <li class="{{ request()->is('home') ? 'active' : '' }}">
                    <a href="{{ URL::to('home') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/dash-1.png') }}" alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/dash.png') }}" alt="logo">
                        </span>
                        <span class="menuname">Dashboard</span>
                    </a>
                </li>
                <?php
                if (Auth::user()->parent_id == 0) {
                    $user_id = Auth::user()->id;
                } else {
                    $user_id = Auth::user()->parent_id;
                } ?>
                @php
                    $aboutapps = App\Aboutapp::where('user_id', $user_id)
                        ->where('platform_type', 'app')
                        ->count();
                    $aboutwebapps = App\Aboutapp::where('user_id', $user_id)
                        ->where('platform_type', 'web')
                        ->count();
                @endphp
                @if ($aboutapps > 0)
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['myapps.index', 'app.aboutapp.index', 'app.aboutapp.show']) ? 'active' : '' }}">
                        <a href="{{ URL::to('myapps') }}">
                            <span class="navimages">
                                <img class="navinactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">My Apps ({{ $aboutapps }})</span>
                        </a>
                    </li>
                @else
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['app.myapps.index', 'app.aboutapp.index']) ? 'active' : '' }}">
                        <a href="{{ URL::to('myapps') }}">
                            <span class="navimages">
                                <img class="navinactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}"
                                    alt="logo">
                            </span>
                            @if ($aboutwebapps > 0)
                                <span class="menuname">My Apps</span>
                            @elseif($aboutapps > 0)
                                <span class="menuname">My Website</span>
                            @else
                                <span class="menuname">My Apps / Web</span>
                            @endif
                        </a>
                    </li>
                @endif
                @if ($aboutwebapps > 0)
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['mywebapps', 'app.aboutwebapp.create', 'app.aboutwebapp.show']) ? 'active' : '' }}">
                        <a href="{{ URL::to('mywebapps') }}">
                            <span class="navimages">
                                <img class="navinactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">My Website ({{ $aboutwebapps }})</span>
                        </a>
                    </li>
                @endif
                @if (request()->routeIs('app*'))
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['app.project_timeline.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/project_timeline') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-3.png') }}"
                                    alt="logo">
                                <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-31.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">Task List</span>
                        </a>
                    </li>
                    <li class="{{ in_array(Route::currentRouteName(), ['app.bug.index']) ? 'active' : '' }}"><a
                            class="" href="{{ URL::to('app/bug') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-5.png') }}"
                                    alt="logo">
                                <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-51.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">Bugs</span>
                        </a>
                    </li>
                @endif
                <li class="{{ in_array(Route::currentRouteName(), ['app.chat.index']) ? 'active' : '' }}">
                    <a class="" href="{{ URL::to('app/chat') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-chat.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-chat-active.png') }}"
                                alt="logo">
                        </span>
                        <span class="menuname">Chat (<span id="total_unread_count_c">@php echo App\Http\Controllers\Admin\Custom\ChatController::get_count(); @endphp</span>)</span>
                    </a>
                </li>
                @if (!request()->routeIs('app*'))
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['schedulechat.index', 'schedulechat.create', 'schedulechat.edit', 'app.schedulechat.show']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('schedulechat') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-chat.png') }}"
                                    alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-chat-active.png') }}" alt="logo">
                            </span>
                            <span class="menuname">Schedule a chat</span>
                        </a>
                    </li>
                @endif

                @if (request()->routeIs('app*'))

                    <li class="{{ in_array(Route::currentRouteName(), ['app.quote.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/quote') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-5.png') }}"
                                    alt="logo">
                                <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-51.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">Quotes</span>
                        </a>
                    </li>
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['app.designdetail.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/designdetail') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-5.png') }}"
                                    alt="logo">
                                <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-51.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">Design</span>
                        </a>
                    </li>
                    <li
                        class="{{ in_array(Route::currentRouteName(), ['app.domaindetail.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/domaindetail') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-domain.png') }}"
                                    alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-domain-active.png') }}" alt="logo">
                            </span>
                            <span class="menuname">Domain Details</span>
                        </a>
                    </li>
                    @if ($aboutapps > 0)

                        <li class="sidebar-dropdown">
                            <a href="#">
                                <span class="navimages"><img class="navinactivimg"
                                        src="{{ asset('asset/images/sidebar-icon-3.png') }}" alt="logo"><img
                                        class="navactivimg" src="{{ asset('asset/images/sidebar-icon-31.png') }}"
                                        alt="logo"></span><span class="menuname">App Store</span><i
                                    class="fa fa-angle-right" aria-hidden="true"></i></a>
                            <ul class="sidebar-submenu" style="display:none;">
                                <li>
                                    <a class="{{ in_array(Route::currentRouteName(), ['app.appstore.index']) ? 'active' : '' }}"
                                        href="{{ route('app.appstore.index') }}">Create Accounts</a>
                                </li>
                                <li>
                                    <a class="{{ in_array(Route::currentRouteName(), ['app.appstore.create']) ? 'active' : '' }}"
                                        href="{{ route('app.appstore.create') }}">Store Info</a>
                                </li>
                            </ul>
                        </li>

                    @endif

                    <?php
                    $app_id = session('app_id');
                    $user_id = auth()->user()->id;
                    $check_payment = App\quote::where('app_id', $app_id)
                        ->where('user_id', $user_id)
                        ->first();
                    ?>
                    @if (!is_null($check_payment))
                        <li class="{{ in_array(Route::currentRouteName(), ['app.payment.index']) ? 'active' : '' }}">
                            <a class="" href="{{ URL::to('app/payment') }}">
                                <span class="navimages">
                                    <img class="navinactivimg"
                                        src="{{ asset('asset/images/sidebar-icon-payment.png') }}" alt="logo">
                                    <img class="navactivimg"
                                        src="{{ asset('asset/images/sidebar-icon-payment-active.png') }}" alt="logo">
                                </span>
                                <span class="menuname">Payments</span>
                            </a>
                        </li>
                    @endif




                    <li class="{{ in_array(Route::currentRouteName(), ['app.buildudid.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/buildudid') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-buld.png') }}"
                                    alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-buld-active.png') }}" alt="logo">
                            </span>
                            <span class="menuname">Test Builds</span>
                        </a>
                    </li>
                    <li class="{{ in_array(Route::currentRouteName(), ['app.agreement.index']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('app/agreement') }}">
                            <span class="navimages">
                                <img class="navinactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-contract-active.png') }}" alt="logo">
                                <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-contract.png') }}"
                                    alt="logo">
                            </span>
                            <span class="menuname">Contract</span>
                        </a>
                    </li>

                    <li class="{{ in_array(Route::currentRouteName(), ['show_admin_details']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('show_admin_details') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                    alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-user-active.png') }}" alt="logo">
                            </span>
                            <span class="menuname">Admin Details</span>
                        </a>
                    </li>

                    <li class="{{ in_array(Route::currentRouteName(), ['show_details']) ? 'active' : '' }}">
                        <a class="" href="{{ URL::to('show_details') }}">
                            <span class="navimages">
                                <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                    alt="logo">
                                <img class="navactivimg"
                                    src="{{ asset('asset/images/sidebar-icon-user-active.png') }}" alt="logo">
                            </span>
                            <span class="menuname">Gmail Account</span>
                        </a>
                    </li>


                    <!--
<li>
<a class="" href="{{ URL::to('app/testbuild') }}">
<img class="" src="{{ asset('asset/images/sidebar-icon-5.png') }}" alt="logo">
<span class="menuname">Test Builds</span>
</a>
</li>
<li>
<a class="" href="{{ URL::to('app/bug') }}">
<img class="" src="{{ asset('asset/images/sidebar-icon-5.png') }}" alt="logo">
<span class="menuname">Bugs</span>
</a>
</li>
<li>
<a class="" href="{{ URL::to('app/payment') }}">
<img class="" src="{{ asset('asset/images/sidebar-icon-5.png') }}" alt="logo">
<span class="menuname">Payments</span>
</a>
</li>
<li>
<a class="" href="{{ URL::to('app/agreement') }}">
<img class="" src="{{ asset('asset/images/sidebar-icon-5.png') }}" alt="logo">
<span class="menuname">Contract</span>
</a>
</li>
<li>
<a class="" href="{{ URL::to('app/team') }}">
<img class="" src="{{ asset('asset/images/sidebar-icon-5.png') }}" alt="logo">
<span class="menuname">Team</span>
</a>
</li> -->

                @endif

                <!-- <li class="{{ in_array(Route::currentRouteName(), ['new_user', 'edit_customer_user']) ? 'active' : '' }}">
 <a href="{{ route('new_user') }}"><span class="navimages"><img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span class="menuname">Add New Users</span></a>
</li> -->





                <li
                    class="{{ in_array(Route::currentRouteName(), ['myaccount.index', 'myaccount.create', 'myaccount.edit', 'app.myaccount.show']) ? 'active' : '' }}">
                    <a class="" href="{{ URL::to('myaccount') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span>
                        <span class="menuname">My Account</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
