@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
          <div class="card">
          @if($agreement == NULL) 
          <div class="card-header">
            <h2>No agreement Yet </h2>
          </div>
          <div class="card-body">
            <img class="img-responsive" src="{{asset('asset/images/agreement.png')}}" alt="">
          </div>
          @else
          <div class="card-header">
            <h2>Our Contract</h2>
          </div>
          <div class="card-body text-center">
          <div class="card p-20">
                <h6><b>Please review your agreement below</b></h6>
            </div>
            <img class="img-responsive" src="{{asset('asset/images/agreement.png')}}" alt=""><br><br>
            <a href="{{asset($agreement->agreement)}}" download class="btn btn-primary">Download Agreement</a>
          </div>
          
          @endif

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
@include('admin.custom.partials.footer')
