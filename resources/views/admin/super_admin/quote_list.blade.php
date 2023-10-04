@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper sup-admin-mainwrapper">
  <div class="mainwrapper-inner-container">
  <div class="container-fluid">
  <div class="row clearfix aboutappcontainer">
      <div class="col-md-12">
      <div class="mt-20">
      <div class="card-header">
        <h3>Users Quote list</h3>
     </div>
     <div class="table-height-container">
      
      <table id="all_users" class="table">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Business Name</th>
              <th scope="col">Country</th>
              <th scope="col" class="text-center">Send</th>
              <th scope="col" class="text-center">Accepted</th>
              <th scope="col" class="text-center">Signed</th>
              <th scope="col" class="text-center">Paid</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
              <tr>
                  <!-- <td scope="row">{{$user->id}}</td> -->
                  <td>{{$user->business_name}}</td>
                  <td>{{$user->country}}</td>
                  <?php  $count = App\quote::where('status',0)->where('user_id',$user->id)->count(); ?>
                  <td class="text-center progress_count"><span class="usernameright">{{$count}}</span></td>
                  <?php  $count = App\quote::where('status',1)->where('user_id',$user->id)->count(); ?>
                  <td class="text-center progress_count"><span class="progressright">{{$count}}</span></td>
                  <?php  $count = App\quote::where('status',2)->where('user_id',$user->id)->count(); ?>
                  <td class="text-center progress_count"><span class="progress_done_right">{{$count}}</span></td>
                  <?php  $count = App\quote::where('status',3)->where('user_id',$user->id)->count(); ?>
                  <td class="text-center progress_count"><span class="usernamecenter">{{$count}}</span></td>
                  <td><a class="viewbtn" href="{{ route('show_quotes',$user->id) }}">View</a></td>
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
