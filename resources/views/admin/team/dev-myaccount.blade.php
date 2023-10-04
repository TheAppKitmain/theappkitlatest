@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card usr-detail-main-box">
                <div class="card-header">
                    <h2>My Account <a class="user_edit_btn" href="{{route('custom_user.edit',Auth::user()->id)}}">
                    <i class="fa fa-pencil edit-icon" aria-hidden="true"></i>
                </a></h2>
                </div>
                <div class="card-body">
                    <ul class="userdetails">
                        <li>Name:<span>{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</span></li>
                        <li>Email:<span>{{ Auth::user()->email }}</span></li>
                        <li>Business Name:<span>{{ Auth::user()->business_name }}</span></li>
                        <li>Number:<span>{{ Auth::user()->number}}</span></li>
                        <li>Country:<span>{{ Auth::user()->country }}</span></li>
                    </ul>
                </div>
            </div>   
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('admin.team.partials.footer')



