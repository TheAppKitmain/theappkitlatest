@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
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
                                <li class="breadcrumb-item active">Blog Categories</li>    
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="main-page-container">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 col-md-12">
                            @if(Session::get('alert'))
                            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                            <p>{{Session::get('message')}} </p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-12">
                            <h4 class="custom-bg">Add New Category</h4>
                            <form role="form" data-toggle="validator" action="{{route('blogcategory.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="form-group f-g-o">
                                        <label for="usr">Name</label>
                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{ old('name') }}" data-error="This field is required.">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="form-group f-g-o">
                                        <label for="usr">Description</label>
                                        <textarea rows="5" class="form-control" placeholder="Add Description" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>                        
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="form-group f-g-o">
                                        <label for="usr">Image</label>
                                        <input type="file" name="image" id="imgInp file-7" class="inputfile inputfile-6 form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" accept="image/*">
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6">
                                    <div class="form-group f-g-o">
                                        <label for="usr">Status</label>
                                        <div class="d-flex">
                                            <div class="w3-half">
                                                <div class="custom-control custom-radio mt-3">
                                                    <input type="radio" id="customRadio1" name="status" class="custom-control-input" value= "active" checked="">
                                                    <label class="custom-control-label" for="customRadio1">Active</label>
                                                </div>
                                            </div>
                                            <div class="w3-half">
                                                <div class="custom-control custom-radio mt-3">
                                                    <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive">
                                                    <label class="custom-control-label" for="customRadio2">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                                    <div class="form-group">
                                        <button class="btn-style btn-color" type="submit">Add New Category</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-9 col-xl-9 col-md-12">
                            <div class="cat-box shadow-d data-table-wrapper">
                                <div class="table-title-main-top"><h3 class="table-title-main">Categories</h3></div>
                                <div class="table-wrapper">
                                   <table class="categoty_table table table-striped table-bordered" style="width:100%"> 
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

        @foreach($categories as $category)
        <tr class="parent">
            <td class="text-capitalize">{{$category->name}}</td>
            <td class="">{{$category->slug}}</td>
            <td class="text-capitalize">{{$category->status}}</td>
            <td>
                 <a href="{{route('blogcategory.edit',$category->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a onclick="delete_pm('{{route('blogcategory.destroy',$category->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    </div>
</div>
    </div>
</div>
</div>
</div>
</div>

@include('admin.super_admin.partials.footer')