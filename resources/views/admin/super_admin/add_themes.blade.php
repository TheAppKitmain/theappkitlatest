@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')

<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="mt-20 addteame-main">
        <div class="card-header">
        <h3>Add Theme</h3>
        </div>
        <div class="card-body"> 
        <form method ="POST" action="{{route('addtheme.store')}}" enctype="multipart/form-data" name="registration">
        @csrf
        <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="theme_name" id="theme_name" class="form-control  @error('theme_name') is-invalid @enderror" required>
                    @error('theme_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="">Select Category</label>
            <select class="form-control" id="" name="category_id">
                @foreach($themecategories as $themecategory)
                    <option value="{{$themecategory->id}}">{{$themecategory->category_name}}</option>
                @endforeach
            </select>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="Name">Theme Description</label>
                <textarea type="text" name="theme_details" id="theme_details" rows="8" cols="50" class="form-control  @error('theme_details') is-invalid @enderror" required></textarea>
                @error('theme_details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="theme_slug" name="slug" required>
            </div>
            </div>
            

            <!-- <div class="col-md-6">
                <div class="form-group">
                <label for="">Sub Domain</label>
                <input type="text" name="sub_domain" id="sub_domain" class="form-control  @error('sub_domain') is-invalid @enderror">
                    @error('sub_domain')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                <label for="">Is Active</label>
                <div class="d-flex">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="yes" name="is_active" class="custom-control-input"  value="1">
                        <label class="custom-control-label" for="yes">Yes</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="no" name="is_active" class="custom-control-input"  value="0">
                        <label class="custom-control-label" for="no">No</label>
                    </div>
                    </div>
                </div>
            </div> -->

            <div class="col-md-12">
            <div class="form-group">
            <label for="Profile Image">Upload Theme Thumbnail</label>
                <div class="field row custom-row-th">
                <input type="file" id="theme_thumbnail" class="form-control" name="theme_thumbnail" required/>
                </div>
            </div>
            </div>


            <div class="col-md-12">
            <div class="form-group">
            <label for="Profile Image">Upload Theme Screenshots</label>
                <div class="field row custom-row-th">
                <input type="file" id="files" class="form-control" name="theme_screenshots[]" multiple required/>
                </div>
            </div>
            </div>

            <!-- <div class="col-md-12">
            <div class="form-group">
            <label for="Profile Image">Theme Code</label>
                <div class="field row custom-row-th">
                    <input type="text" id="theme_code" class="form-control" name="theme_code" required/>
                </div>
            </div>
            </div> -->

            <!-----------------------------------ADD PLAN ID's---------------------------------->
            <div class="col-md-12">
            <h3 class="pln-id">Add Plan Id's</h3>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="Profile Image"> Monthly in GBP</label>
                <div class="field row custom-row-th">
                <input type="text" id="files" class="form-control" name="monthly_gbp" />
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="Profile Image"> Yearly in GBP</label>
                <div class="field row custom-row-th">
                <input type="text" id="files" class="form-control" name="yearly_gbp" />
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="Profile Image"> Monthly in USD</label>
                <div class="field row custom-row-th">
                <input type="text" id="files" class="form-control" name="monthly_usd" />
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="Profile Image"> Yearly in USD</label>
                <div class="field row custom-row-th">
                <input type="text" id="files" class="form-control" name="yearly_usd" />
                </div>
            </div>
            </div>
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

@include('admin.super_admin.partials.footer')