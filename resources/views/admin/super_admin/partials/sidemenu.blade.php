<header>
    <div class="mob-rw super-admin-header">
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
                    <div class="float-right">
                        <nav class="navbar navbar-expand-lg navbar-light ">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown dropdown-right notification-li">
                                        <a class="nav-link dropdown-toggle  user-rightimg" href="javascript:void(0)"
                                            id="navbarDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('asset/images/userimage.png') }}">
                                        </a>
                                        <div class="dropdown-menu dropdownmenutop" aria-labelledby="navbarDropdown">

                                            <a class="" href="{{ route('logout') }}">
                                                <a href="{{ route('logout') }}"
                                                    class="dropdown-item text-center text-primary font-weight-bold py-3">Log
                                                    Out</a>
                                                <form id="logout-form" action="/logout" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </a>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
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
                <li class="{{ in_array(Route::currentRouteName(), ['custom_users', 'edit_custom_users']) ? 'active' : '' }}">
                    <a href="{{ route('custom_users') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span
                            class="menuname">Regsiter Users</span></a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['quote_list', 'show_notes', 'view_note']) ? 'active' : '' }}">
                    <a href="{{ URL::to('quote_list') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Quote List</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Custom Users</span>
                    </a>
                </li>
                <li class="{{ request()->is('shopify_customers') ? 'active' : '' }}">
                    <a href="{{ URL::to('shopify_customers') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Shopify Users</span>
                    </a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['user_template.index', 'user_template.create', 'user_template.edit']) ? 'active' : '' }}">
                    <a class="" href="{{ URL::to('user_template') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Template Users</span>
                    </a>
                </li>

                <li
                    class="{{ in_array(Route::currentRouteName(), ['get_started.index', 'get_started.create', 'get_started.edit']) ? 'active' : '' }}">
                    <a class="" href="{{ URL::to('get_started') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Get Started</span>
                    </a>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['myclientspending', 'myclientsconfirmed']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="#"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}"
                                alt="logo"></span><span class="menuname">My Clients</span><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-submenu" @if(in_array(Route::currentRouteName(), ['myclientspending', 'myclientsconfirmed'])) style="display:block;" @else style="display:none;" @endif>
                        <li class="{{ in_array(Route::currentRouteName(), ['myclientspending']) ? 'active' : '' }}">

                            <a href="{{ route('myclientspending') }}">Pending Clients</a>
                        </li>
                        <li
                            class="{{ in_array(Route::currentRouteName(), ['myclientsconfirmed']) ? 'active' : '' }}">
                            <a href="{{ route('myclientsconfirmed') }}">Ongoing Clients</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['buglist', 'getbug']) ? 'active' : '' }}">
                    <a class="" href="{{ route('buglist') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Bugs</span>
                    </a>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['manage_notification']) ? 'active' : '' }}">
                    <a href="{{ route('manage_notification') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/notification.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/notification_active.png') }}"></span><span
                            class="menuname">Notifications</span></a>
                </li>

                <li
                    class="{{ in_array(Route::currentRouteName(), ['internal_update', 'show_notes', 'view_note']) ? 'active' : '' }}">
                    <a href="{{ URL::to('internal_update') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-user.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Requested</span>
                    </a>
                </li>
                
                <li class="{{ in_array(Route::currentRouteName(), ['to_do_list.index']) ? 'active' : '' }}">
                    <a href="{{ URL::to('to_do_list') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('images/edit.png') }}" alt="logo">
                            <img class="navactivimg" src="{{ asset('images/edit_white.png') }}" alt="logo">
                        </span><span class="menuname">To Do List</span>
                    </a>
                </li>

            <!-- <li class="{{ in_array(Route::currentRouteName(), ['chat.index']) ? 'active' : '' }}">
                    @php
                        $messages_count = App\Message::where('to', auth()->user()->id)
                            ->where('is_read', 0)
                            ->count();
                    @endphp
                    <a href="{{ route('chat.index') }}"><span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-chat.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-chat-active.png') }}"
                                alt="logo">
                        </span><span class="menuname">Chat ({{ $messages_count }})</span></a>
                </li> -->

                <li class="{{request()->is('get_all_messages') ? 'active' : ''}}">
                    <a href="{{ route('get_all_messages') }}">
                    <span class="navimages">
                        <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-chat.png') }}"
                            alt="logo">
                        <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-chat-active.png') }}"
                            alt="logo">
                    </span>Chat (<span id="total_unread_count">@php echo App\Http\Controllers\Admin\FirebaseController::get_count(); @endphp</span>)</a>
                </li>
                
                <!-- @if (Session::has('user_id') && Session::has('app_id')) <li class="{{ in_array(Route::currentRouteName(), ['timeline.index']) ? 'active' : '' }}">
                    <a href="{{ route('timeline.index') }}"><span class="navimages">
                    <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo">
                    <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}" alt="logo">
                    </span><span class="menuname">Add Task</span></a>
                </li> @endif -->

               

                <li
                    class="{{ in_array(Route::currentRouteName(), ['myteam.index', 'addteam.index']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="#"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-3.png') }}" alt="logo"><img
                                class="navactivimg" src="{{ asset('asset/images/sidebar-icon-31.png') }}"
                                alt="logo"></span><span class="menuname">Team</span><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-submenu" @if (in_array(Route::currentRouteName(), ['myteam.index', 'addteam.index'])) style="display:block;" @else style="display:none;" @endif>
                        <li class="{{ in_array(Route::currentRouteName(), ['myteam.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('myteam') }}">My Team</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['addteam.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('addteam') }}">Add Team</a>
                        </li>
                    </ul>
                </li>


                <li
                    class="{{ in_array(Route::currentRouteName(), ['faq.index', 'faq.create']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="#"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-88.png') }}" alt="logo"><img
                                class="navactivimg" src="{{ asset('asset/images/sidebar-icon-88-white.png') }}"
                                alt="logo"></span><span class="menuname">FAQ</span><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-submenu" @if (in_array(Route::currentRouteName(), ['faq.index', 'faq.create'])) style="display:block;" @else style="display:none;" @endif>
                        <li class="{{ in_array(Route::currentRouteName(), ['faq.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('faq') }}">FAQ's</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['faq.create']) ? 'active' : '' }}">
                            <a href="{{ route('faq.create') }}">Add FAQ</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['blogcategory.index']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="{{ URL::to('blogcategory') }}"><span class="navimages"><img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-3.png') }}" alt="logo"><img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-31.png') }}" alt="logo"></span><span class="menuname">Blog categories</span></a>
                </li>


             <li class="{{ in_array(Route::currentRouteName(), ['theme_blog.index', 'theme_blog.create']) ? 'active activea' : '' }} sidebar-dropdown"><a href="#"><span class="navimages"><img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-88.png') }}" alt="logo"><img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-88-white.png') }}" alt="logo"></span><span class="menuname">Blog</span><i class="fa fa-angle-right"aria-hidden="true"></i></a>
                <ul class="sidebar-submenu" @if (in_array(Route::currentRouteName(), ['theme_blog.index', 'theme_blog.create'])) style="display:block;" @else style="display:none;" @endif>
                    <li class="{{ in_array(Route::currentRouteName(), ['theme_blog.index']) ? 'active' : '' }}">
                        <a href="{{ URL::to('theme_blog') }}">Blogs</a>
                    </li>
                    <li class="{{ in_array(Route::currentRouteName(), ['theme_blog.create']) ? 'active' : '' }}">
                        <a href="{{ route('theme_blog.create') }}">Add Blog</a>
                    </li>
                </ul>
            </li>

            <li class="{{ in_array(Route::currentRouteName(), ['our_work.index', 'our_work.create']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="#"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-88.png') }}" alt="logo"><img
                                class="navactivimg" src="{{ asset('asset/images/sidebar-icon-88-white.png') }}"
                                alt="logo"></span><span class="menuname">Our Work</span><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-submenu" @if (in_array(Route::currentRouteName(), ['our_work.index', 'our_work.create'])) style="display:block;" @else style="display:none;" @endif>
                        <li class="{{ in_array(Route::currentRouteName(), ['our_work.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('our_work') }}">App Details</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['our_work.create']) ? 'active' : '' }}">
                            <a href="{{ route('our_work.create') }}">Add Works</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['addtheme.index', 'addcategory.index']) ? 'active activea' : '' }} sidebar-dropdown">
                    <a href="#"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-my-templates.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-my-templates-active.png') }}"
                                alt="logo"></span><span class="menuname">Templates</span><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                    <ul class="sidebar-submenu" @if (in_array(Route::currentRouteName(), ['addtheme.index', 'addcategory.index'])) style="display:block;" @else style="display:none;" @endif>
                        <li class="{{ in_array(Route::currentRouteName(), ['allthemes.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('allthemes') }}">All Themes</a>
                        </li>
                        <li class="{{ in_array(Route::currentRouteName(), ['addtheme.index']) ? 'active' : '' }}">
                            <a href="{{ URL::to('addtheme') }}">Add Theme</a>
                        </li>
                        <li
                            class="{{ in_array(Route::currentRouteName(), ['addcategory.index', 'addcategory.create', 'addcategory.edit']) ? 'active' : '' }}">
                            <a href="{{ URL::to('addcategory') }}">Add Category</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['project_manager', 'edit_project_manager']) ? 'active' : '' }}">
                    <a href="{{ route('project_manager') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span
                            class="menuname">Project managers</span></a>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['developers', 'edit_developers']) ? 'active' : '' }}">
                    <a href="{{ route('developers') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span
                            class="menuname">Developers</span></a>
                </li>
                
                <?php
                   $main_id =  explode(',',config('helper.super_admin_id'));
                   if(in_array(Auth::user()->id, $main_id)){
                 ?>
                <li class="{{ in_array(Route::currentRouteName(), ['web-update.index']) ? 'active' : '' }}">
                    <a href="{{ route('web-update.index') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span
                            class="menuname">Updates</span></a>
                </li>
                <?php } ?>

                <?php
                   $main_id =  explode(',',"49,59");
                   if(in_array(Auth::user()->id, $main_id)){
                 ?>
                <li class="{{ in_array(Route::currentRouteName(), ['employee_updates_list']) ? 'active' : '' }}">
                    <a href="{{ route('employee_updates_list') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/ggg.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/hhhh.png') }}"></span><span
                            class="menuname">Employee Updates</span></a>
                </li>
                <?php } ?>

                <!-- <li class="{{ in_array(Route::currentRouteName(), ['employee_updates_list']) ? 'active' : '' }}">
                    <a href="{{ route('employee_updates_list') }}"><span class="navimages"><img class="navinactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user.png') }}" alt="logo"><img
                                class="navactivimg"
                                src="{{ asset('asset/images/sidebar-icon-user-active.png') }}"></span><span
                            class="menuname">Employee Updates</span></a>
                </li> -->

                <li>
                    <a class="" href="{{ route('logout') }}">
                        <span class="navimages">
                            <img class="navinactivimg" src="{{ asset('asset/images/sidebar-icon-4.png') }}"
                                alt="logo">
                            <img class="navactivimg" src="{{ asset('asset/images/sidebar-icon-41.png') }}"
                                alt="logo">
                        </span>
                        <span class="menuname"> Log out</span>

                        <form id="logout-form" action="/logout" method="POST" class="d-none">
                            @csrf
                        </form>

                    </a>
                </li>

        </nav>
    </div>
</div>
