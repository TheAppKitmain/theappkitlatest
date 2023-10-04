@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row clearfix">
  <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header">
              <h2>Bug</h2>
            </div>
            <div class="bugtablemain">          
             <div class="col-md-12">
                        <div class="card card-bug">
                           <div class="des-detail-img">
                            @if($bugsdata->bug_screenshot)
                              @php
                                 $ext = substr($bugsdata->bug_screenshot, strrpos($bugsdata->bug_screenshot, '.', -1), strlen($bugsdata->bug_screenshot));
                                 $array_img_ext = array('.jpeg','.jpg','.png','.gif');
                                 $array_vid_ext = array('.3g2','.3gp','.avi','.flv','.h264','.m4v','.mkv','.mov','.mp4','.mpg','.mpeg','.rm','.swf','.vob','.wmv');  
                              @endphp
                              @if(in_array($ext, $array_img_ext))
                              <h6><b>Bug Screenshort :</b></h6>
                              <div class="bug-img-box-super-admin">
                                 <a href="{{asset($bugsdata->bug_screenshot)}}" download>
                                 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                 <div class="carousel-inner">
                                    @foreach($bugsdata->img_arry as $data)
                                    @if($loop->first)
                                    <div class="carousel-item active">
                                    @else
                                    <div class="carousel-item">
                                    @endif
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
                              </div>
                              @elseif(in_array($ext, $array_vid_ext))
                              <h6><b>Bug Video :</b></h6>
                                 <a href="{{asset($bugsdata->bug_screenshot)}}" download>Download video
                                 </a>
                              @else
                              <h6><b>Bug File :</b></h6>
                                 <a href="{{asset($bugsdata->bug_screenshot)}}" download>Download
                                 </a> 
                              @endif
                              @endif
                              <div class="d-flex">
                              <h6 class=""><strong>Bug Type:</strong></h6>
                              <p class="bug-type-p superadbug">{{$bugsdata->bug_type}}</p>
                              </div>
                              @if(!is_null($bugsdata->bug_device))
                              <div class="d-flex">
                                 <h6 class=""></h6>Bug for:</strong></h6>
                                 <p class="bug-type-p superadbug">{{$bugsdata->bug_device}}</p>
                              </div>
                              @endif
                              <h6><strong>Bug Description:</strong></h6>
                              <p>{{$bugsdata->bug_description}}</p>

                              @if(!is_null($bugsdata->require_store))
                              <div class="d-flex">
                                 @if($bugsdata->require_store == "1")
                                 <h6><strong>Requires Store Update</strong></h6>
                                 @endif
                              </div>
                              @endif

                              @if($bugsdata->status == 0)
                              <p><span class="bug_change_status">Status:Pending</span></p>
                              @elseif($bugsdata->status == 1)
                              <p><span class="bug_change_status">Status:In progress</span></p>
                              @elseif($bugsdata->status == 2)
                              <p><span class="bug_change_status">Status:Done</span></p>
                              @else
                              <p><span class="bug_change_status">Status:Complete</span></p>
                              @endif
                              <select class="getstatus_confirm" data-bug="{{$bugsdata->id}}">
                                 <option>Select Status</option>
                                 <!-- <option @if($bugsdata->status == 0) selected @endif value="1">Pending</option>
                                 <option @if($bugsdata->status == 1) selected @endif value="1">In progress</option> -->
                                 <option @if($bugsdata->status == 2) selected @endif value="2">Done</option>
                                 <option @if($bugsdata->status == 3) selected @endif value="3">Complete</option>
                              </select>

                              <!-- <div class="md-form">
                                 <h6 class=""><strong>Estimated Time:</strong></h6>
                                 <input type="time" id="estimated_time" name="estimated_time">
                              </div>   -->
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

   <!-- Modal -->

   <div class="modal fade" id="bugModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form name="bug_status" id="bug_status">
               @csrf
               <div class="form-group">
                  <input type="hidden" id="bug_id"  name="bug_id" class="bug_id" value="">
                  <input type="hidden" id="staus_id" name="staus_id" class="staus_id" value="">
                  <input type="hidden" id="user_id" name="user_id" value="{{$bugsdata->user_id}}">
                  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Bug Notes</label>
                  <textarea name="bug_note" id="bug_note" class="form-control" placeholder="Bug Note" rows="10" cols="50"></textarea><br>
               </div>
               <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Submit</button>
            </form>
         </div>
         </div>
      </div>
  </div>
@include('admin.super_admin.partials.footer')
<script type="text/javascript">

	$('.getstatus_confirm').change(function() {  

       var staus_id = $(this).val();
       var bug_id = $(this).attr('data-bug');

       $('body').find('#bugModal').modal('show');  
       $('.bug_id').empty().val(bug_id);
       $('.staus_id').empty().val(staus_id);
       window.scrollTo(0,0);

     });
     
	   $("#bug_status").submit(function(a) {

      $('body').find('#bugModal').modal('hide');  
       a.preventDefault();
        $.ajax({
        url: "{{ route('bugstatus') }}",
        type: "POST",        
        data: new FormData(this),         
        contentType: false,         
        cache: false,  
        processData:false,

        success:function(response){
         //console.log(response)
            if(response == 2){
                  var staus_value = "Done";
                  $(".bug_change_status").text('Status:Done');
               }else{
                  var staus_value = "Complete";
                  $(".bug_change_status").text('Status:Complete');
               }
               swal(staus_value, "Bug status updated successfully", "success");
         }

         });
   });

 
</script>