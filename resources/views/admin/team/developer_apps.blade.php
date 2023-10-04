@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
   <div class="container-fluid">
      <div class="row clearfix">
         <div class="col-md-12 text-right">
         <div class="add-app-new">
   
<a  href="{{ URL::to('app/aboutapp') }}">Add New App</a>
</div>
</div>

</div>
           <div class="row admin-rowabtapp">
           
              <div class="super_admin_custom_users">
                
              </div>
           </div>
           <div class="row admin-rowabtappbtm super_admin_custom_users">
             @if(count($aboutapps) == 0)

            <h1 class="no_app">No App yet</h1>

            @else

            @foreach($aboutapps as $aboutapp)

            <div class="col-md-3 all_apps">
            <div class="mayappbox">
              <a href="{{route('developer_app_data',['id' => $aboutapp->user_id, 'app_id' => $aboutapp->id])}}">
              @if(!is_null($aboutapp->designdetail))
              <img class="logous1" src="{{asset($aboutapp->designdetail->logo)}}">
            @else
              <img class="logous1" src="{{asset('images/placeholder_logo.png')}}">
            @endif
              <img class="app-frame" src="{{asset('asset/images/myappnamesup.png')}}" alt="logo">
                <h2>{{ $aboutapp->app_name }}</h2>
              </a> 
            </div>
            </div>
            @endforeach
            @endif
            </div>
      </div>
   
</div>
</div>

@include('admin.team.partials.footer')