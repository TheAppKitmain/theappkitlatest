<header>
<div class="mob-rw">
<div class="container-fluid">
<div class="row">
<div class="col-sm-3 mob-col-none">
<div class="logo">
<a class="brndlogoimg" href="{{ URL::to('/') }}">
<img class="" src="{{asset('asset/images/logo.png')}}" alt="logo">
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


<!-- <a href="#" class="btn btn-success btn-swtch-temp temp_popup">Switch to Template</a>  -->
<ul class="navbar-nav mr-auto">
<li class="nav-item dropdown dropdown-right notification-li d-flex">
<a class="nav-link dropdown-toggle user-rightimg" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span><p class="username-fl"></p></span>
</a>
<a class="lgot lgot-dev" href="{{ route('logout') }}">
<img class="" src="{{asset('asset/images/sidebar-icon-4.png')}}" alt="logo"><span class="menuname">Log out</span>
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
		<img class="" src="{{asset('asset/images/logo.png')}}" alt="logo">
		</a>
	</div>
<nav class="sidenavbar">
<ul class="sidenavbarul">

<li class="{{ in_array(Route::currentRouteName(), ['dev-dashboard.index']) ? 'active' : '' }}">
	<a href="{{ URL::to('home') }}">
	<span class="navimages">
	<img class="navinactivimg" src="{{asset('asset/images/dash-1.png')}}" alt="logo">
	<img class="navactivimg" src="{{asset('asset/images/dash.png')}}" alt="logo">
	</span>
	<span class="menuname">Dashboard</span>
	</a>
</li>
<li class="{{ in_array(Route::currentRouteName(), ['developer_app','developer_app_data']) ? 'active' : '' }}">
<a href="{{route('developer_app')}}">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-my-templates.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-my-templates-active.png')}}" alt="logo">
</span>
<span class="menuname">My Apps</span>
</a>
</li>
@php
$developer_id = auth()->user()->id;
$get_developer_apps = App\Devloperapps::where('developer_id',$developer_id)->pluck('app_id');
$bugsdata = App\Bug::whereIn('app_id',$get_developer_apps)->where('status',0)->count();
@endphp
<li class="{{ in_array(Route::currentRouteName(), ['developer_buglist']) ? 'active' : '' }}">
    <a class="" href="{{route('developer_buglist')}}">
    <span class="navimages">
        <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-user.png')}}" alt="logo">
        <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-user-active.png')}}" alt="logo">
    </span><span class="menuname">Bugs ({{$bugsdata}})</span>
    </a>
</li>
<li class="{{ in_array(Route::currentRouteName(), ['employee_update.index']) ? 'active' : '' }}">
    <a class="" href="{{route('employee_update.index')}}">
    <span class="navimages">
        <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-user.png')}}" alt="logo">
        <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-user-active.png')}}" alt="logo">
    </span><span class="menuname">Employee Updates</span>
    </a>
</li>
                
<li class="{{ in_array(Route::currentRouteName(), ['developer_tasks','developer_timeline']) ? 'active' : '' }}">
    <a class="" href="{{route('developer_tasks')}}">
    <span class="navimages">
        <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-user.png')}}" alt="logo">
        <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-user-active.png')}}" alt="logo">
    </span><span class="menuname">Tasks</span>
    </a>
</li>

<?php
$main_id =  explode(',',config('helper.dev_appkit_developer'));
if(in_array(Auth::user()->id, $main_id)){
?>
  <li class="{{ in_array(Route::currentRouteName(), ['appkitupdate.index']) ? 'active' : '' }}">
                    <a class="" href="{{ URL::to('appkitupdate') }}">
                    <span class="navimages">
                        <img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-user.png')}}" alt="logo">
                        <img class="navactivimg" src="{{asset('asset/images/sidebar-icon-user-active.png')}}" alt="logo">
                    </span><span class="menuname">Appkit Update</span>
                    </a>
                </li>
<?php } ?>
<li class="{{ in_array(Route::currentRouteName(), ['dev-myaccount.index']) ? 'active' : '' }}">
<a class="" href="{{ URL::to('dev-myaccount') }}">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-user.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-user-active.png')}}" alt="logo">
</span>
<span class="menuname">My Account</span>
</a>
</li>                 

<!-- 

<li class="">
<a href="#">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-my-templates.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-my-templates-active.png')}}" alt="logo">
</span>
<span class="menuname">My Apps / Web</span>
</a>
</li>
<li class="">
<a href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-my-templates.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-my-templates-active.png')}}" alt="logo">
</span>
<span class="menuname">My Website</span>
</a>
</li>

<li class="">
<a class="" href="#">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-3.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31.png')}}" alt="logo">
</span>
<span class="menuname">Task List</span>
</a>
</li>
<li class="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-5.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-51.png')}}" alt="logo">
</span>
<span class="menuname">Bugs</span>
</a>
</li>

<li class="">

<a class="" href="#">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-chat.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-chat-active.png')}}" alt="logo">
</span>
<span class="menuname">Chat</span>
</a>
</li>

<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-chat.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-chat-active.png')}}" alt="logo">
</span>
<span class="menuname">Schedule a chat</span>
</a>
</li>


<li class="">
<a class="" href="#">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-5.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-51.png')}}" alt="logo">
</span>
<span class="menuname">Quotes</span>
</a>
</li>
<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-5.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-51.png')}}" alt="logo">
</span>
<span class="menuname">Design</span>
</a>
</li>
<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-domain.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-domain-active.png')}}" alt="logo">
</span>
<span class="menuname">Domain Details</span>
</a>
</li>

<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-3.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-31.png')}}" alt="logo">
</span>
<span class="menuname">App Store</span>
</a>
</li>

<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-payment.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-payment-active.png')}}" alt="logo">
</span>
<span class="menuname">Payments</span>
</a>
</li>


<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-buld.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-buld-active.png')}}" alt="logo">
</span>
<span class="menuname">Test Builds</span>
</a>
</li>
<li class="">
<a class="" href="">
<span class="navimages">
<img class="navinactivimg" src="{{asset('asset/images/sidebar-icon-contract-active.png')}}" alt="logo">
<img class="navactivimg" src="{{asset('asset/images/sidebar-icon-contract.png')}}" alt="logo">
</span>
<span class="menuname">Contract</span>
</a>
</li> -->




</ul>
</nav>
</div>
</div>