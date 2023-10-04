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
                                    <h2>Admin Details</h2>
                                </div>
                                <div class="card-body">
                                    <p><b>Email :</b> {{ $upload_details->email }}</p>
                                    <p><b>Password :</b> {{ $upload_details->password }}</p>
                                    <p><b>Url :</b> <a
                                            href="{{ $upload_details->url }}">{{ $upload_details->url }}</a></p>
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
