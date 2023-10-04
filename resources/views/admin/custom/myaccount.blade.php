@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card usr-detail-main-box">
                <div class="card-header">
                    <h2>My Account <a class="user_edit_btn" href="{{route('custom_user.edit',$user->id)}}">
                    <i class="fa fa-pencil edit-icon" aria-hidden="true"></i>
                </a></h2>
                </div>
                <div class="card-body">
                    <ul class="userdetails">
                        <li>Name:<span>{{ $user->first_name }}&nbsp;{{ $user->last_name }}</span></li>
                        <li>Email:<span>{{ $user->email }}</span></li>
                        <li>Business Name:<span>{{ $user->business_name }}</span></li>
                        <li>Number:<span>{{ $user->number}}</span></li>
                        <li>Country:<span>{{ $user->country }}</span></li>
                    </ul>
                @if($user->parent_id == 0)    
                <a href="{{ URL::to('new_user') }}" class="btn btn-success btn-swtch-temp float-right">Add New User</a>
                @else
                @endif
                </div>
            </div>   
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('admin.custom.partials.footer')



