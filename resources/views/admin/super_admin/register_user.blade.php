@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
<?php
    $ip = $_SERVER['REMOTE_ADDR'];
    // the IP address to query
    //$ip = '203.134.206.89';
    $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    if ($query && $query['status'] == 'success') {
    $countryCode = $query['countryCode'];
    $countryCodesmall = strtolower($countryCode);
    }
    ?>
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-sm-4">
            <div class="mt-20">
              <div class="">
                <div class="card-header"><h3>Add New User</h3></div>
                <div class="card-body"> 
                 <form method ="POST" action="{{route('custom_users')}}" name="registration">
                   @csrf
                  <div class="form-group project-man-form">
                    <label for="Name">Business Name*</label>
                    <input type="text" name="business_name" class="form-control" placeholder="Enter Business Name" value="{{ old('business_name') }}" required> 
                    <label for="Name">First Name*</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{ old('first_name') }}" required>
                    <label for="Name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{ old('last_name') }}"> 
                    <input type="hidden" name="role_id" value="1">
                    <input type="hidden" name="user_type" value="custom">
                    <label for="Email">Email*</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" autocomplete="false"  name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="Email">Mobile*</label>
                    <!-- <input type="number" id="phoneField" name="number" placeholder="Enter Number"
                                        data-maxlength="10"
                                        class="phone-field form-control  @error('number') is-invalid @enderror" required> -->
                    <input type="number" id="phoneField" data-maxlength="13" class="phone-field form-control" name="number" placeholder="Enter Number" class="phone-field form-control  @error('number') is-invalid @enderror" required value="{{ old('number') }}">
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="Email">Country*</label>
                    <input type="hidden" id="countryCode" data-country="{{ $countryCodesmall }}" value="{{ $countryCode }}">
                    <input id="country_selector" type="text" class="form-control @error('country') is-invalid @enderror" name="country">
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="pass">Password* (8 characters minimum)</label>

                    <input type="password" id="pass" class="form-control" name="password" minlength="8" required autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" placeholder="Enter Password">
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
              <div class="mt-20">
                <div class="card-header">
                    <h2>All Custom Users</h2>
                </div>
                <div class="table-height-container table-height-container-sup">
                  <table class="table" id="all_custom_users">
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
                          @foreach ($all_developers as $key => $user)
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