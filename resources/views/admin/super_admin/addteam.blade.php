@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')

<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3>Add Team Member</h3>
        </div>
        <div class="card-body"> 
        <form method ="POST" action="{{route('addteam.store')}}" enctype="multipart/form-data" name="registration">
       @csrf
        <div class="form-group">
          <label for="Name">Name</label>
          <input type="text" name="member_name" class="form-control" required>
          <label for="Designation">Designation</label>
          <input type="text" name="member_designation" class="form-control" required>
          <label for="Profile Image">Profile Image</label>
          <input type="file" name="profile_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.super_admin.partials.footer')