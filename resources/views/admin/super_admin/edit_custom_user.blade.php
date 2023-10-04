@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-md-4">
            <div class="mt-20">
              <div class="">
                <div class="card-header"><h3>{{$project_manager->first_name}}</h3></div>
                <div class="card-body"> 
                  <form method="POST" action="{{route('update_custom_users',[$project_manager->id,'DV'])}}" enctype="multipart/form-data" name="registration">
                  @csrf
                  {{ method_field('PUT') }}
                  <div class="form-group project-man-form">
                    <label for="Name">Business Name*</label>
                    <input type="text" name="business_name" class="form-control" placeholder="Enter Business Name" value="{{ old('business_name',$project_manager->business_name) }}" required>
                    <label for="Name">First Name*</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{ old('first_name',$project_manager->first_name) }}" required>
                    <label for="Name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{ old('last_name',$project_manager->last_name) }}"> 
                    <input type="hidden" name="role_id" value="1">
                    <input type="hidden" name="user_type" value="custom">
                    <label for="Email">Email*</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" autocomplete="email" value="{{ old('email',$project_manager->email) }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="Email">Mobile*</label>
                    <input type="number" id="phoneField" name="number" placeholder="Enter Number"  maxlength="10" class="phone-field form-control  @error('number') is-invalid @enderror" required value="{{ old('number',$project_manager->number) }}">
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="Email">Country*</label>
                    <input id="country_selector" type="text" class="form-control" name="country" value="{{$project_manager->country}}"  style="width:100%;">
					
                    <label for="pass">Password (Optional: Update your password)</label>
                    <input type="password" id="pass" class="form-control" name="password" minlength="8" placeholder="Enter Password">
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
              <div class="mt-20">
                <div class="card-header">
                    <h2>All Custom Users</h2>
                </div>
                <div class="table-height-container">
                  <table class="table" id="all_users">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Business Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Number</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($all_developers  as $key => $user)
                          <tr>
                              <td scope="row">{{++$key}}</td>
                              <td>{{$user->business_name}}</td>
                                <td>{{$user->email}}</td>
                              <td>{{$user->number}}</td>
                              <td>
                               <a class="viewbtn" href="{{route('edit_custom_users',[$user->id,'DV'])}}">Edit</a>
                                <a class="viewbtn" onclick="delete_pm('{{route('delete_custom_users',[$user->id,'DV'])}}')">Delete</a>
                              </td>
                          </tr>    
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
   </div>
</div>
@include('admin.super_admin.partials.footer')
<script>
   $('#edit_number').keyup(validateMaxLength);
function validateMaxLength()

{
        var text = $(this).val();
        var maxlength = $(this).data('maxlength');

        if(maxlength > 0)  
        {
                $(this).val(text.substr(0, maxlength)); 
        }
}
$(document).ready(function(){
    $('#pass').attr('autocomplete','off');
    $('#email').attr('autocomplete','off');
    });
</script>