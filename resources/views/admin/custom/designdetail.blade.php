@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Designs</h2><br>
                    <p>In this section you can upload any design inspiration, logos or documents which will help us bring your App to life.</p><br>
                    <p>You will also find our XD link below. This link will be used throughout the design process and will give you live updates on the screens for your App. In the XD link, feel free to leave comments on each page to help us understand what changes are required
                    </p><br>
                </div>
                <div class="card-body">
                  @if(is_null($design_details))
                    <form method ="POST" action="{{route('app.designdetail.store')}}" enctype="multipart/form-data" name="registration">
                        @csrf
                        <div class="form-group">
                        @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                        </div>
                        <div class="card uloadlogogrp mb-40">
                          <div class="form-group">
                            <label for="exampleInputPassword1">Upload Logo </label>
                            <br>
                            <input type="file" name="logo" id="logo">
                          </div>
                        </div>
                        <div class="card uloadlogogrp">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp1" id="dp1">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp2" id="dp2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp3" id="dp3">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp4" id="dp4">
                      </div>
                      </div>

                      <div class="form-group">
                        <label class="mt-20" for="">References link of app designs </label>
                            <textarea class="form-control" id="design_details" name="design_details" placeholder="Enter Links" rows="4"></textarea>
                      </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              @else
                  <form method="POST" action="{{route('app.designdetail.update',$design_details->id)}}" enctype="multipart/form-data" name="registration">
                  @csrf
                  {{ method_field('PUT') }}
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="user_id" value="{{$design_details->user_id}}">
                    </div>
                    <div class="card uloadlogogrp mb-40">
                        <div class="form-group">
                         <img src="{{asset($design_details->logo)}}" style="width:80px;height:80px;">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Upload Logo </label>
                          <br>
                          <input type="file" name="logo" id="logo">
                        </div>
                    </div>
                    <div class="card uloadlogogrp">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp1" id="dp1">
                        @if(!is_null($design_details->dp1))
                        <div class="down_dgn_details">
                          <a href="{{asset($design_details->dp1)}}" class="btn btn-success" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp2" id="dp2">
                        @if(!is_null($design_details->dp2))
                        <div class="down_dgn_details">
                          <a href="{{asset($design_details->dp2)}}" class="btn btn-success" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp3" id="dp3">
                        @if(!is_null($design_details->dp3))
                        <div class="down_dgn_details">
                          <a href="{{asset($design_details->dp3)}}" class="btn btn-success" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Upload Documents or Picture </label>
                        <br>
                        <input type="file" name="dp4" id="dp4">
                        @if(!is_null($design_details->dp4))
                        <div class="down_dgn_details">
                          <a href="{{asset($design_details->dp4)}}" class="btn btn-success" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="mt-20" for="">References link of app designs </label>
                    <textarea class="form-control" id="design_details" name="design_details" placeholder="Enter Links" rows="4">{{$design_details->design_details}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                  @endif
                </div>
            </div>  
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('admin.custom.partials.footer')