@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper sup-admin-mainwrapper">
  <div class="mainwrapper-inner-container">
  <div class="container-fluid">
  <div class="row clearfix aboutappcontainer">
      <div class="col-md-12">
      <div class="mt-20">
      <div class="card-header">
        <h3>Custom Users</h3>
     </div>
     <div class="table-height-container">

      
      <table id="all_users" class="table">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Name</th>
              <th scope="col">Business Name</th>
              <th scope="col">Email</th>
              <th scope="col">Number</th>
              <th scope="col">Country</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
              <tr>
                  <!-- <td scope="row">{{$user->id}}</td> -->
                  <td>{{$user->first_name}}{{$user->last_name}}</td>
                  <td>{{$user->business_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->number}}</td>
                  <td>{{$user->country}}</td>
                  @if($user->active_status == "0")
                  <td><a class="viewbtn" href="{{ route('get_started.show',$user->id) }}">Send Mail</a></td>
                  @else
                  <td><p><span class="get_started_status">Already Send</span></p></td>  
                  @endif
              </tr>    
              @endforeach
          </tbody>
        </table>
        </div>
  </div>
  </div>
  </div></div></div>
</div>
@include('admin.super_admin.partials.footer')