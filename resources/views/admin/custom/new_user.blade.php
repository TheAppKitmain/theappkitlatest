@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-sm-4">
            <div class="mt-20">
              <div class="">
                <div class="card-header"><h3>Add New</h3></div>
                <div class="card-body"> 
                 <form method ="POST" action="{{route('new_user')}}" name="registration">
                   @csrf
                  <div class="form-group project-man-form">
                    <label for="Name">Name*</label>
                    <input type="text" name="manager_name" class="form-control" placeholder="Enter Name" value="{{ old('manager_name') }}" required> 
                    <input type="hidden" name="role_id" value="{{$user->role_id}}">
                    <label for="Email">Email*</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" autocomplete="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="Email">Mobile*</label>
                    <input type="number" id="phoneField" name="number" placeholder="Enter Number" maxlength="10" class="phone-field form-control  @error('number') is-invalid @enderror" required value="{{ old('number') }}">
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="pass">Password* (8 characters minimum)</label>
                    <input type="password" id="pass" class="form-control" name="password" minlength="8" required placeholder="Enter Password">
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
                    <h2>All Users</h2>
                </div>
                <div class="table-height-container table-height-container-sup">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Number</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($all_developers as $key => $user)
                          <tr>
                              <td scope="row">{{++$key}}</td>
                              <td>{{$user->first_name}}</td>
                                <td>{{$user->email}}</td>
                              <td>{{$user->number}}</td>
                              <td>
                                <a class="viewbtn" href="{{route('edit_customer_user',[$user->id])}}">Edit</a>
                                <a class="viewbtn" onclick="delete_pm('{{ route('delete_user', [$user->id]) }}')">Delete</a>
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