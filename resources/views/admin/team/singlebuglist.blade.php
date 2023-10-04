@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row clearfix">
  <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header">
              <h2>Bugs</h2>
            </div>
            <div class="bugtablemain">          
             <div class="col-md-4">
                        <div class="card card-bug mt-20">
                           <div class="des-detail-img">
                            @if($bugsdata->bug_screenshot)
                              @php
                                 $ext = substr($bugsdata->bug_screenshot, strrpos($bugsdata->bug_screenshot, '.', -1), strlen($bugsdata->bug_screenshot));
                                 $array_img_ext = array('.jpeg','.jpg','.png','.gif');
                                 $array_vid_ext = array('.3g2','.3gp','.avi','.flv','.h264','.m4v','.mkv','.mov','.mp4','.mpg','.mpeg','.rm','.swf','.vob','.wmv');  
                              @endphp
                              @if(in_array($ext, $array_img_ext))
                              <h6><b>Bug Screenshot :</b></h6>
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
                                 <h6 class=""><strong>Bug for</strong></h6>
                                 <p class="bug-type-p superadbug">{{$bugsdata->bug_device}}</p>
                              </div>
                              @endif
                              <h6><strong>Bug Description:</strong></h6>
                              <p>{{$bugsdata->bug_description}}</p>
                              @if($bugsdata->bug_estimated_date	!= 0000-00-00)  
                              <h6 class=""><strong>Estimated Date</strong></h6>
                              <p class="bug-type-p superadbug">{{date('d-m-Y', strtotime($bugsdata->bug_estimated_date))}}</p>
                              @endif  
                              <select class="getstatus_confirm" data-bug="{{$bugsdata->id}}">
                                 <option>Select Status</option>
                                 <option @if($bugsdata->status == 0) selected @endif value="0">Pending</option>
                                 <option @if($bugsdata->status == 1) selected @endif value="1">In progress</option>
                                 <option @if($bugsdata->status == 2) selected @endif value="2">Done</option>
                              </select> 
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
                  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Estimated Date: </label><br>
                  <?php $mytime = Carbon\Carbon::now();
                     $current_date =  $mytime->toDateString();
                  ?>
                  @if($bugsdata->bug_estimated_date == "0000-00-00")
                  <input id="date" name="bug_date" class="from-control" style="width: 100%;" value="{{$current_date}}" type="date"><br><br>
                  @else
                  <input id="date" name="bug_date" class="from-control" style="width: 100%;" value="{{$bugsdata->bug_estimated_date}}" type="date"><br><br>
                  @endif

                  <div id="require_store_update">
                        <label for="androidbuild">Requires Store Update</label>
                        <input unchecked type="checkbox" id="require_store" name="require_store" value="0" class="Confirmedandroid">
                  </div>

               </div>
               <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Submit</button>
            </form>
         </div>
         </div>
      </div>
  </div>
@include('admin.team.partials.footer')
<script type="text/javascript">

	$('.getstatus_confirm').change(function() {  
       var staus_id = $(this).val();
       var bug_id = $(this).attr('data-bug');

       $('body').find('#bugModal').modal('show'); 
       
      if(staus_id !== 2){
         $('#require_store_update').hide();
      }
      
      if(staus_id == 2){
         $('#require_store_update').show();
      }

       $('.bug_id').empty().val(bug_id);
       $('.staus_id').empty().val(staus_id);
       window.scrollTo(0,0);

      if(staus_id == 2){

      $('#date').attr('readonly', true);

      }else{
      $('#date').attr('readonly', false);

      }

     });
     
	   $("#bug_status").submit(function(a) {

      $('body').find('#bugModal').modal('hide');  
       a.preventDefault();
        $.ajax({
        url: "{{ route('developer_bugstatus') }}",
        type: "POST",        
        data: new FormData(this),         
        contentType: false,         
        cache: false,  
        processData:false,

        success:function(response){

         console.log(response)
            if(response == 0){
                  var staus_value = "Pending";
               }else if(response == 1){
                  var staus_value = "In Progress";
               }else{
                  var staus_value = "Complete";
               }
               swal(staus_value, "Bug status updated successfully", "success");
         }

         });
   });
</script>