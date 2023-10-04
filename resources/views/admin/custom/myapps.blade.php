@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')

<div class="mainwrapper">
<div class="mainwrapper-inner-container">
   <div class="container-fluid">
      <div class="row clearfix">
      
        <div class="col-md-12 text-right">
        <div class="add-app-new">
   
          <a class="add-new-app-btn" href="{{ URL::to('app/aboutapp') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New App</a>
          <a class="add-new-app-btn" href="{{ route('app.aboutwebapp.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> add new website</a>
          
        </div>
        </div>

</div>
    <div class="row home-row-main myapps-cn">
        @if(count($aboutapps) == 0)
          <h1 class="no_app">You have no Apps</h1>
        @else
          @foreach($aboutapps as $aboutapp)
          <div class="col-md-3 all_apps myapp-bx-b">
            @if($aboutapp->platform_type == 'app')
            <a  href="{{route('app.aboutapp.show',$aboutapp->id)}}">
            @else
            <a  href="{{route('app.aboutwebapp.show',$aboutapp->id)}}">
            @endif
              <div class="mayappbox">
                @if(!is_null($aboutapp->designdetail))
              <img class="logous1" src="{{asset($aboutapp->designdetail->logo)}}">
            @else
              <img class="logous1" src="{{asset('images/placeholder_logo.png')}}">
            @endif
              <img class="app-frame" src="{{asset('asset/images/myappname.png')}}" alt="logo">
                <h2>{{ $aboutapp->app_name }}</h2>
              </div>
            </a> 
          </div>
          @endforeach
        @endif
       </div>
      </div> 
      </div>
</div>

<!-- Modal -->
<div class="modal fade modal-aboutapp" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body app_pre">
        <div class="row">
          <div class="col-md-4">
            <div class="modal-aboutapp-inner-box card">
                @if(count($aboutapps) == 0)
                <h1 class="no_app">No App yet. Click above button to create new App</h1>
                @else
                @foreach($aboutapps as $aboutapp)
                     <a  href="{{route('app.aboutapp.show',$aboutapp->id)}}"><i class="fa fa-pencil edit-icon" aria-hidden="true"></i> </a>
                     <h3 class="abt-ap-ttl">About App</h3>
                      <p>{{ $aboutapp->app_idea }}</p>
                      <p><strong>1) Have you thought about this idea for a while?</strong></p>
                     <p style="text-transform: capitalize;">{{ $aboutapp->idea }}</p>
                     <p><strong>2) Are you looking for an iOS & Android App?</strong></p>
                     <p style="text-transform: capitalize;">{{ $aboutapp->lookfor }}</p>
                     <p><strong>3) Do you require a website to be developed with the App?</strong></p>
                     <p style="text-transform: capitalize;">{{ $aboutapp->website }}</p>
                  @endforeach
                  @endif
            </div>
           </div>
       </div>
      </div>
    </div>
  </div>
</div>



@include('admin.custom.partials.footer')