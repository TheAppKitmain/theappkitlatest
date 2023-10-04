@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="mt-20 addteame-main">
        <div class="card-header">
        <h3>Edit Work</h3>
        </div>
        <div class="card-body">    
        	<form role="form" data-toggle="validator" action="{{route('our_work.update',$our_work->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">App name</label>
                        <input type="text" class="form-control{{ $errors->has('app_name') ? ' is-invalid' : '' }}" placeholder="Add title" name="app_name" required value="{{ $our_work->app_name }}" data-error="This field is required.">
                        @if ($errors->has('app_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_name') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>   

                <div class="col-lg-6 col-xl-6 col-md-12" id="post_thumnail">
                    <div class="form-group f-g-o">
                        <label for="usr">App Logo</label>
                        <input type="file" name="app_logo" id="imgInp file-7" value="{{ $our_work->app_logo }}" class="inputfile inputfile-6 form-control{{ $errors->has('app_logo') ? ' is-invalid' : '' }}" accept="image/*">
                        @if ($errors->has('app_logo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_logo') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">App Screenshots</label>
                        <input type="file" name="app_screenshots[]" id="imgInp file-7"  class="inputfile inputfile-6 form-control{{ $errors->has('app_screenshots') ? ' is-invalid' : '' }}" multiple accept="image/*">
                        @if ($errors->has('app_screenshots'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_screenshots') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Select Type</label>
                        <select class="form-control" name="app_type" id="imgInp file-7">
                            <option>Android</option>
                            <option>iOS</option>
                            <option>Web</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Client Name</label>
                        <input type="text" name="client_name" id="imgInp file-7" value="{{ $our_work->client_name }}" class="inputfile inputfile-6 form-control{{ $errors->has('client_name') ? ' is-invalid' : '' }}" accept="image/*">
                        @if ($errors->has('client_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('client_name') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Client Designation</label>
                        <input type="text" name="client_designation" id="imgInp file-7" value="{{ $our_work->client_designation }}" class="inputfile inputfile-6 form-control{{ $errors->has('client_designation') ? ' is-invalid' : '' }}" accept="image/*">
                        @if ($errors->has('client_designation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('client_designation') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Ios Link</label>
                        <input type="link" name="app_links" id="imgInp file-7" value="{{ $our_work->app_links }}" class="inputfile inputfile-6 form-control{{ $errors->has('app_links') ? ' is-invalid' : '' }}" accept="image/*">
                        @if ($errors->has('app_links'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_links') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Android Link</label>
                        <input type="link" name="app_android_link" id="imgInp file-7" value="{{ $our_work->app_android_link }}" class="inputfile inputfile-6 form-control{{ $errors->has('app_android_link') ? ' is-invalid' : '' }}" accept="image/*">
                        @if ($errors->has('app_android_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_android_link') }}</strong>
                            </span>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 col-md-12">
                <div class="form-group">
                    <label for="Name">App Reviews</label>
                    <textarea type="text" name="app_reviews" id="app_reviews" rows="8" cols="50" class="form-control  @error('app_reviews') is-invalid @enderror" required>{{ $our_work->app_reviews }}</textarea>
                    @error('app_reviews')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                </div>
                
                <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                    <div class="form-group"><button class="btn-style btn-color" type="submit">Update</button></div>
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
@include('admin.super_admin.partials.footer')