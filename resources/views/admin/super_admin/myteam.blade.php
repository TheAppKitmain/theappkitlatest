@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-md-12">
              <div class="mt-20">
                <div class="card-header">
                    <h2>My team</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                      @foreach ($myteams as $myteam)
                      <div class="col-md-4">
                          <div class="team-member-box">
                            <div class="team-member-img">
                                <img src="{{asset($myteam->profile_image)}}">
                            </div>
                            <h2>{{$myteam->member_name}}</h2>
                            <h5>{{$myteam->member_designation}}</h5>
                          </div>
                      </div>
                      @endforeach
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
   </div>
</div>
@include('admin.super_admin.partials.footer')