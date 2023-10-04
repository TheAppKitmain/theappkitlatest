@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
    <div class="mainwrapper-inner-container main-wrpr-usr-view">
        <div class="container-fluid">
            <div class="row clearfix aboutappcontainer">
                <div class="col-md-12">
                    <div class="card"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix aboutappcontainer">
                <div class="col-md-12">
                    <div class="abtapps-box">
                        
                    </div>
                    <div class="">
                        <div class="tab shopify_tab">
                            <button class="tablinks active" id="AboutApp_" onclick="openCity(event, 'AboutApp')">User Details</button>                      
                        </div>
                    </div>
                    <!--------------------------------- Start About App Data------------------------------------->
                    <div id="AboutApp" class="tabcontent" style="display: block;">
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
                    </div>
                    @endif


@include('admin.super_admin.partials.footer')

