<header>
	  <div class="header-wrapper">
     <div class="temp-mob-icons">
         <i class="fa fa-bars closeside" aria-hidden="true"></i>         
      </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12 ryt-dropdown">
                  <nav class="navbar navbar-expand-lg navbar-light bg-light temp-mob-logo">
                     <a class="navbar-brand desktop-navbarlogo" href="{{ URL::to('/') }}">
                     The App Kit
                     </a>
                     <ul class="navbar-nav ml-auto navbar-top-buttons mobile-right-header">
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <div class="d-flex"><span class="username-top">{{ Auth::user()->first_name[0] }}</span></div>
                              </a>
                              <div class="dropdown-menu right-drp" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}">
                              <span class="menuname"> Log out</span>
                              <form id="logout-form" action="/logout" method="POST" class="d-none">
                                 @csrf
                              </form>
                               </a>
                                 
                              </div>
                           </li>
                        </ul>
                     <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button> -->
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="form-inline my-2 my-lg-0">
                           <!-- <input class="form-control header-top-search" type="search" placeholder="Search" aria-label="Search"> -->
                        </form>
                        <ul class="navbar-nav ml-auto navbar-top-buttons desktop-right-header">
                         
                        @if(request()->routeIs('theme*')) 
                           <a class="nav-link letbuild theme_publish_app" href="{{ URL::to('theme/publish') }}" >Publish App</a>
                        @endif      
                           <a class="nav-link letbuild" href="{{ URL::to('home') }}" >Switch to custom</a>
                           <!-- <li class="nav-item">
                              <a class="nav-link letbuild" href="" data-toggle="modal" data-target="#buildapp" >Let Us Build your App</a>
                           </li> -->
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <div class="d-flex"><span class="username-top">{{ Auth::user()->first_name[0] }}</span></div>
                              </a>
                              <div class="dropdown-menu right-drp" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}">
                              <span class="menuname"> Log out</span>
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
</header>