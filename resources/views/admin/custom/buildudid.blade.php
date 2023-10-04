@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
        <div class="mt-20">
            <div class="card-header">
                <h2>Add your UDID Numbers</h2>
            </div> 
            <div class="card-body">
                <div class="p-20 bug-user-col">
                    <h6><b>In this section you will find the most up to date test builds for your App. <br><br>
                    Please delete the current builds you have on your devices before installing the new links</b>
                    </h6>
                    <br><br>
                    <p>In order for you to test your App before launching, we require your UDID number from your device. ( iOS devices only)</p><br>
                    <p>Note - Google play users do not require a UDID number </p></br>
                    <p>You can find this number by clicking this link and following the steps - <a target="_blank" href="https://www.udid.tech">https://www.udid.tech</a></p><br>
                    @if(count($all_udids) > 0)
                         <form method="POST" action="{{route('app.buildudid.store')}}" enctype="multipart/form-data" name="registration">
                            @csrf
                            <div class="row clearfix bug-user-col" id="bugsud">
                                <?php $i = 0; ?>
                                @foreach($all_udids as $udid) 
                                <div class="col-md-4 ">
                                    <div class="form-group bug-container">
                                        @if($i != 0)
                                        <i class="fa fa-trash-o deletei" aria-hidden="true"></i>
                                        @endif
                                        <div class="form-group">
                                        @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                     
                                        <input type="hidden" class="form-control" name="main_id[]" value="{{$udid->id}}" >
                                        </div>
                                        <div class="form-group">
                                           <label for="yourappname">Please paste your UDID number below </label>
                                           <input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID" value="{{$udid->udid}}" required>
                                        </div>
                                        <div class="form-group">
                                            @if($udid->add_screenshot)
                                             <img src="{{asset($udid->add_screenshot)}}" style="width:80px;height:80px;">
                                            @endif
                                          <label for="">Add Screenshot</label>
                                          <input type="file" name="add_screenshot[]" class="form-control valid">
                                        </div>
                                    </div>
                               </div>
                               <?php $i++; ?>
                               @endforeach
                            </div>
                            <a id="btnAddud" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                       </form>
                       @else
                       <form method ="POST" action="{{route('app.buildudid.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix" id="bugsud">
                                <div class="col-md-4">
                                 <div class="form-group bug-container">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}" >
                                    <input type="hidden" class="form-control" name="main_id[]" value="0" >
                                </div>
                                <div class="form-group">
                                   <label for="yourappname">Please paste your UDID number below </label>
                                   <input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID" required>
                                </div>
                                <div class="form-group">
                                <label for="">Add Screenshot</label>
                                  <input type="file" name="add_screenshot[]" class="form-control valid">
                                </div>
                                </div>
                               </div>
                            </div>
                            <a id="btnAddud" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                       </form> 
                   @endif
                </div>
            </div>
        
            @if(!is_null($have_test_builds))
            <div class="card-header">
                <h2>Test Builds</h2>
            </div>
            <div class="card-body">
                <div class="card p-20">
                    <h6><b>In this section you will find the most up to date test builds for your App. <br><br>
                    Please delete the current builds you have on your devices before installing the new links</b>
                    </h6>
                </div>
                <ul class="list-inline build-ul">
                    @if(!is_null($have_test_builds->androidbuild) && $have_test_builds->status_a == 1)
                    <li class="list-inline-item d-flex">
                      <img src="{{asset('images/im1.png')}}">
                      <p id="copyandroid">{{$have_test_builds->androidbuild}}</p>
                      <button class="btn btn-info" onclick="copyToClipboard('#copyandroid')">Copy URL</button>
                    </li>
                    @endif

                    @if(!is_null($have_test_builds->iosbuild) && $have_test_builds->status_i == 1)
                    <li class="list-inline-item d-flex">
                        <img src="{{asset('images/im2.png')}}">
                        <p id="copyios">{{$have_test_builds->iosbuild}}</p>
                        <button class="btn btn-info" onclick="copyToClipboard('#copyios')">Copy URL</button>
                    </li>   
                    @endif
                </ul>
            </div>
            @endif
        </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
function copyToClipboard(element) {
     var $temp = $("<input>");
     $("body").append($temp);
     $temp.val($(element).html()).select();
     document.execCommand("copy");
     $temp.remove();
}
</script>
@include('admin.custom.partials.footer')
