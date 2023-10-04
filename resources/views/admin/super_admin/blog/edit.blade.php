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
        <h3>Add Blog</h3>
        </div>
        <div class="card-body">    
        	<form role="form" data-toggle="validator" action="{{route('theme_blog.update',$posts->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Post title</label>
                                    <input type="text" class="form-control{{ $errors->has('post_title') ? ' is-invalid' : '' }}"
                                     placeholder="Add title" name="post_title" required value="{{ $posts->post_title }}" data-error="This field is required.">
                                    @if ($errors->has('post_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_title') }}</strong>
                                        </span>
                                    @endif
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Select Category</label>
                                    <select name="category_id" class="form-control">
                                     <option value="0">Article</option>
                                     @foreach($categories as $cat)
                                     <option <?php if($posts->blogcategory_id == $cat->id){ echo "selected"; } ?> value="{{$cat->id}}">{{$cat->name}}</option>
                                     @endforeach   
                                    </select>
                                </div>
                            </div>                
                            <div class="col-lg-6 col-xl-6 col-md-12" id="post_thumnail">
                                <div class="form-group f-g-o">
                                    <label for="usr">thumbnail</label>
                                    <?php if(!is_null($posts->blog_meta->thumbnail)){ ?> 
                                    <br>
                                         <img src="<?php echo $posts->blog_meta->thumbnail;?>" style="width:100px;">
                                    <br>
                                <?php } ?>
                                    <input type="file" name="thumbnail" id="imgInp file-7" class="inputfile inputfile-6 form-control{{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" accept="image/*">
                                    @if ($errors->has('thumbnail'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('thumbnail') }}</strong>
                                        </span>
                                    @endif
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                           
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Video Url</label>
                                    <input type="text" class="form-control" placeholder="Add Video Url" name="video_url"  value="{{ $posts->blog_meta->video_url }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Post Content</label>
                                    <textarea rows="8" class="ck_editor form-control" placeholder="Add Description" name="post_content">{{$posts->post_content}}</textarea>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Meta Title</label>
                                    <input type="text" class="form-control" placeholder="Seo Title" name="seo_title" value="{{ $posts->blog_meta->seo_title }}">
                                </div>
                            </div>   
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Meta tags (use comma in between each tags)</label>
                                    <input type="text" class="form-control" placeholder="Eg: Food,love,Travel" name="meta_tags" value="{{ $posts->blog_meta->meta_tags }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Meta Description</label>
                                    <textarea rows="3" class="form-control" placeholder="Add meta Description" name="meta_description">{{ $posts->blog_meta->meta_description }}</textarea>
                                </div>
                            </div>   
                            <div class="col-lg-3 col-xl-3 col-md-12">
                                <div class="form-group f-g-o">
                                    <label for="usr">Post status</label>
                                    <div class="d-flex">
                                        <div class="w3-half">
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="customRadio1" name="post_status" class="custom-control-input" value="publish" {{$posts->post_status == "publish" ? "checked" : ""}} value="publish">
                                                <label class="custom-control-label" for="customRadio1">Publish</label>
                                            </div>
                                        </div>
                                        <div class="w3-half">
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="customRadio2" name="post_status" class="custom-control-input" {{$posts->post_status == "draft" ? "checked" : ""}} value="draft">
                                                <label class="custom-control-label" for="customRadio2">Draft</label>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            
                            <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                                <div class="form-group"><button class="btn-style btn-color" type="submit">Save</button></div>
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