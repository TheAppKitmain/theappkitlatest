@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="main-wrapper">
    <div class="main-container">
        <div class="main-container-inner">
            <div class="container-fluid">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <nav>
                            <ol class="breadcrumb breadcrumb-own-admin">
                                <li class="breadcrumb-item active">Edit Blog Category</li>    
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
   <div class="main-page-container">
                <div class="container-fluid">
                       <form role="form" data-toggle="validator" action="{{route('blogcategory.update',$category->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Name</label>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{old('name', $category->name)}}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Short Description</label>
                                    <textarea rows="5" class="form-control" placeholder="Add Description" name="description">{{old('description', $category->description)}}</textarea>
                                </div>
                            </div>
     
                     
                          
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Image ( Upload high resolution images like 1242x695)</label>
                                    <br>
                                    <img src="<?php echo $category->image; ?>" style="width:100px;height:100px">
                                    <br>
                                    <input type="file" name="image" id="imgInp file-7" class="inputfile inputfile-6 form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" accept="image/*">
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Status </label>
                                    <div class="d-flex">
                                        <div class="w3-half">
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="customRadio1" name="status" class="custom-control-input" {{$category->status == "active" ? "checked" : ""}} value="active">
                                                <label class="custom-control-label" for="customRadio1">Active</label>
                                            </div>
                                        </div>
                                        <div class="w3-half">
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$category->status == "inactive" ? "checked" : ""}}>
                                                <label class="custom-control-label" for="customRadio2">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                                <div class="form-group"><button type="submit" class="btn-style btn-color">Save</button></div>
                            </div>
                        </div>
                        </form>
                </div>
                </div>
        </div>
    </div>
</div>
    </div>
</div>
</div>
</div>
</div>

@include('admin.super_admin.partials.footer')