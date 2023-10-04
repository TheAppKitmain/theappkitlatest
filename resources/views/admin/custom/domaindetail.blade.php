@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Domain Details</h2><br>

                    <p>You will need to purchase a domain name for your business. You can purchase a domain from Godaddy for super cheap! </p><br>
                    <a target="_blank" href="www.godaddy.com">www.godaddy.com</a>
                </div>
                <div class="card-body">
                    @if(!is_null($domain_detail))
                    <form method ="POST" action="{{route('app.domaindetail.update',$domain_detail->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @else
                    <form method ="POST" action="{{route('app.domaindetail.store')}}" enctype="multipart/form-data">
                    @csrf
                    @endif
                    <input type="hidden" name="app_id" value="{{session('app_id')}}">
                    <div class="form-group">
                    @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                    </div>
                    <div class="form-group">
                    <label for="">If you already have a domain, please enter it below.</label>
                    @if(!is_null($domain_detail))
                         @if(!is_null($domain_detail->domain_details))
                             <textarea class="form-control" id="domian_details" name="domain_details" placeholder="Enter Domain" rows="4">{{$domain_detail->domain_details}}</textarea>
                         @else
                            <textarea class="form-control" id="domian_details" name="domain_details" placeholder="Enter Domain" rows="4"></textarea>
                         @endif
                     @else
                     <textarea class="form-control" id="domian_details" name="domain_details" placeholder="Enter Domain" rows="4"></textarea>
                     @endif
                    </div>
                    <p>We will need to access your domain DNS in order to keep all files for your App together in one place. To allow us access you will need to:</p><br>
                    <ul>
                    1) Log in to your domain provider<br>
                    2) Go to settings<br>
                    3) Click teams or member access<br>
                    4) Enter our email documents@theappkit.co.uk
                    </ul><br>
                    <h6><b>Alternatively you can provide your email and password to the account and allow our team to take care of this for you.</b></h6><br>
                    <div class="form-group">
                    <label for="">Domain Provider</label>
                    @if(!is_null($domain_detail))
                     @if(!is_null($domain_detail->domain_provider))
                    <input type="text" class="form-control" name="domain_provider" id="domain_provider" placeholder="Domain Provider" value="{{$domain_detail->domain_provider}}">
                    @else
                    <input type="text" class="form-control" name="domain_provider" id="domain_provider" placeholder="Domain Provider">
                    @endif
                    @else
                    <input type="text" class="form-control" name="domain_provider" id="domain_provider" placeholder="Domain Provider">
                    @endif
                    </div>
                    <div class="form-group">
                    <label for="">Email</label>
                    @if(!is_null($domain_detail))
                     @if(!is_null($domain_detail->domain_email))
                    <input type="text" class="form-control" name="domain_email" id="domain_email" placeholder="email" value="{{$domain_detail->domain_email}}">
                    @else
                    <input type="text" class="form-control" name="domain_email" id="domain_email" placeholder="email">
                    @endif
                    @else
                    <input type="text" class="form-control" name="domain_email" id="domain_email" placeholder="email">
                    @endif
                    </div>
                    <div class="form-group">
                    <label for="">Password</label>
                    @if(!is_null($domain_detail))
                     @if(!is_null($domain_detail->domain_password))
                    <input type="text" class="form-control" name="domain_password" id="domain_password" placeholder="password" value="{{$domain_detail->domain_password}}">
                       @else
                    <input type="text" class="form-control" name="domain_password" id="domain_password" placeholder="password">
                    @endif
                    @else
                    <input type="text" class="form-control" name="domain_password" id="domain_password" placeholder="password">
                    @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
                
        </div>
    </div>
</div>
</div>
</div>
</div>


@include('admin.custom.partials.footer')
