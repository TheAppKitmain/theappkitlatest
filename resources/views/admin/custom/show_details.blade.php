@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
    <div class="mainwrapper-inner-container">
        <div class="smallmainwrapper">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12">
                        @if (!is_null($upload_details))
                            <div class="card">
                                <div class="card-header">
                                    <h2>Gmail Account</h2>
                                </div>
                                <div class="card-body">
                                    <p><b>Email :</b> {{ $upload_details->email }}</p>
                                    <p><b>Password :</b> {{ $upload_details->password }}</p>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    <h2>No Details Found</h2>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.custom.partials.footer')
