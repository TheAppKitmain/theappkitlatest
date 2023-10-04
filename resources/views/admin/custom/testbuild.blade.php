@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">

            @if($testbuild == NULL)
            <div class="card-header">
                <h2>Test Builds</h2>
            </div> 
            <div class="card-body">

            <div class="card p-20">
                <h6><b>In this section you will find the most up to date test builds for your App. <br><br>
                Please delete the current builds you have on your devices before installing the new links</b>
                </h6>
                <br><br>
                  <p>In order for you to test your App before launching, we require your UDID number from your device. ( iOS devices only)</p><br>

               <p>Note - Google play users do not require a UDID number </p></br>

            <p>You can find this number by clicking this link and following the steps - <a target="_blank" href="https://get.udid.io/">https://get.udid.io/</a></p>
                <form method ="POST" action="{{route('app.buildudid.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix" id="bugsud">
                        <div class="col-md-4">
                         <div class="form-group bug-container">
                        <div class="form-group">
                        @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                        </div>
                        <div class="form-group">
                           <label for="yourappname">Please paste your UDID number below </label>
                           <input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID">
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
                
            </div>
             
            </div>
            
        
          <div class="card-body buildimg-wrapper">
            <img class="img-responsive" src="{{asset('asset/images/android.png')}}" alt="">
            <img class="img-responsive" src="{{asset('asset/images/App-Store.png')}}" alt="">
          </div>
            @else
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
                <li class="list-inline-item d-flex">
                    <img src="asset/images/android.png">
                    
                    <p id="copyandroid">{{$testbuild->androidbuild}}</p>
                  <button class="btn btn-info" onclick="copyToClipboard('#copyandroid')">Copy URL</button>
                    
                
                </li>
                <li class="list-inline-item d-flex">
                    <img src="asset/images/App-Store.png">
               
            <p id="copyios">{{$testbuild->iosbuild}}</p><button class="btn btn-info" onclick="copyToClipboard('#copyios')">Copy URL</button>
                
            
                </li>   
            </ul>
            </div>
            @endif
        </div>
        </div>
    </div>
</div>
</div>
</div>
 <div class="ud_id">
             
               
             
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
