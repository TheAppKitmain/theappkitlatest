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
        <h3>Add Categories</h3>
        </div>
        <div class="card-body"> 
        <form method ="POST" action="{{route('addcategory.store')}}" enctype="multipart/form-data" name="registration">
        @csrf
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" required>
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="category_slug" name="slug" required>
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