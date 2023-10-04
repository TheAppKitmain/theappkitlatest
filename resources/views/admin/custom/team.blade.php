@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h2>The App Kit Team</h2>
        </div>
        <div class="card-body">
        @if( count($teams) >= 0)
          <h1 class="title_content">The Team will be added once the project is started</h1>

        @else
          <div class="row">
          @foreach ($teams as $team)
          <div class="col-md-4">
          <div class="team-member-box">
          <div class="team-member-img">
          <img src="{{asset($team->profile_image)}}">
          </div>
          <h2>{{$team->member_name}}</h2>
          <h5>{{$team->member_designation}}</h5>
          </div>
          </div>
          @endforeach
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



