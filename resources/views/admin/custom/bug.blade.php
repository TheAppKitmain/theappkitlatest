@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
@include('admin.custom.delete')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row clearfix">
  <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header">
              <h2>Bugs</h2>
            </div>
            <div class="card-body bug-bx">
            <form method ="POST" action="{{route('app.bug.store')}}" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                 @if(Auth::user()->parent_id == 0)  
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                 @else
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                 @endif
                    <input type="hidden" class="form-control" name="bugby" value="client">
                </div>
                <div class="row clearfix" id="bugs">
                    <div class="col-md-4">
                        <div class="form-group bug-container buddon">
                          <label for="">Bug Type</label>
                          <select name="bug_type[]" id="bugtype" class="form-control">
                            <option value="Functional (Something not working)">Functional (Something not working)</option>
                            <option value="Functional (Something missing)">Functional (Something missing)</option>
                            <option value="User Interface (e.g. text, colours, element positioning etc.)">User Interface (e.g. text, colours, element positioning etc.)</option>
                            <option value="Other">Other</option>
                          </select>
                          <label for="">Bug Description</label>
                          <textarea name="bug_description[]" class="form-control" placeholder="Explain Bug" required></textarea>
                          <label for="">Bug Screenshot</label>
                          <input type="hidden" id="bug_count_id" value="1">
                          <input type="file" name="bug_screenshot[0][]" class="form-control valid" multiple>
                          <div class="form-group">
                              <label for="exampleFormControlSelect1">Bug For</label>
                              <select class="form-control" id="bug_device" name="bug_device[]">
                                 <option>Android</option>
                                 <option>iOS</option>
                                 <option>Android & iOS</option>
                                 <option>Admin Panel</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="exampleFormControlSelect1">Bug Priority</label>
                              <select class="form-control" id="bug_priority" name="bug_priority[]">
                                 <option>Low</option>
                                 <option>Medium</option>
                                 <option>High</option>
                              </select>
                           </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Finished</button>
                <a id="btnAdd" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
            </form>
          </div>

          @if(count($bugs )> 0)
            <div class="card-header"><h2>Bugs Status</h2></div>
            <div class="card-body bottom-bugs">
            <div class="row">
                <div class="col-sm-12 p-20">
                    <h6 class="title-h6"><b>In this section you will find the current status of all previous bugs. <br></b></h6>
                </div>
                  @foreach($bugs as $bug)
                 <div class="col-md-6">
                  <div class="card p-20 card-bug-main">
                    <a onclick="deleteData('{{route('delete_bug',$bug->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @if($bug->bug_screenshot)
                              @php
                                 $ext = substr($bug->bug_screenshot, strrpos($bug->bug_screenshot, '.', -1), strlen($bug->bug_screenshot));
                                 $array_img_ext = array('.jpeg','.jpg','.png','.gif');
                                 $array_vid_ext = array('.3g2','.3gp','.avi','.flv','.h264','.m4v','.mkv','.mov','.mp4','.mpg','.mpeg','.rm','.swf','.vob','.wmv');
                              @endphp
                              @if(in_array($ext, $array_img_ext))
                              <h6><b>Bug Screenshort :</b></h6>
                              <div class="bug-img-box-super-admin">
                                 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                 <div class="carousel-inner">
                                    @foreach($bug->img_arry as $data)
                                    @if($loop->first)
                                    <div class="carousel-item active">
                                    @else
                                    <div class="carousel-item">
                                    @endif
                                       <a href="{{asset($data)}}" download>
                                       <img class="d-block bug-screenshot" src="{{asset($data)}}" alt="First slide">
                                    </div>
                                    @endforeach
                                 </div>
                                 <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                 </a>
                                 </div>
                              </div>
                              
                              @elseif(in_array($ext, $array_vid_ext))
                              <h6><b>Bug Video :</b></h6>
                                 <a href="{{asset($bug->bug_screenshot)}}" download>Download video
                                 </a>
                              @else
                              <h6><b>Bug File :</b></h6>
                                 <a href="{{asset($bug->bug_screenshot)}}" download>Download
                                 </a>
                              @endif
                              @endif
                     <div class="d-flex">
                        <h6><b>Bug No :</b></h6>
                        <p class="bug-type-p">#{{$bug->id}}</p>
                    </div>
                    <div class="d-flex">
                    <h6><b>Bug Posted on :</b></h6>
                    <p class="bug-type-p"><td>{{date('d-m-Y', strtotime($bug->created_at))}}</td></p>
                    </div>
                    <div class="d-flex">
                    <h6><b>Bug Type :</b></h6>
                    <p class="bug-type-p">{{$bug->bug_type}}</p>
                    </div>
                    @if($bug->bugby == 'pm')
                     <div class="d-flex">
                    <h6><b>Posted by :</b></h6>
                    <p class="bug-type-p">{{$bug->bugby}}</p>
                    </div>
                    @endif

                    @if(!is_null($bug->bug_device))
                     <div class="d-flex">
                    <h6><b>Bug For :</b></h6>
                    <p class="bug-type-p">{{$bug->bug_device}}</p>
                    </div>
                    @endif

                    @if(!is_null($bug->bug_priority))
                     <div class="d-flex">
                    <h6><b>Bug Priority :</b></h6>
                    <p class="bug-type-p">{{$bug->bug_priority}}</p>
                    </div>
                    @endif

                    <h6><b>Bug Description :</b></h6><p>{{$bug->bug_description}}</p>
                    <div class="d-flex"><h6><b>Bug Status :</b></h6>
                     <p class="bug-type-p">@if($bug->status == 0) Pending @elseif($bug->status == 1) In Progress @elseif($bug->status == 2) In Progress @else Completed @endif</p>
                    </div>
                  </div>
                 </div>
                  @endforeach
                  </div>
            </div>
            @endif
    </div>
  </div>
</div>
</div>
</div>
</div>
@include('admin.custom.partials.footer')
<script>
  function deleteData(url){
      $.ajax({
         type:'get',
         url:url,
         success:function(results){
            if (results.success === true) {
                swal("Done!", results.message, "success");
            } else {
                swal("Error!", results.message, "error");
            }
            setTimeout(function(){location.reload();}, 1000)
         }
      })
   }
</script>
