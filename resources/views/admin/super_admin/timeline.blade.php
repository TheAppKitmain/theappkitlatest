@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper task">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-6">

            <form method="POST" action="{{route('timeline.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <input type="hidden" value="{{session('user_id')}}" name="user_id">
                  <input type="hidden" value="{{session('app_id')}}" name="app_id">
                  <input type="hidden" class="form-control" name="task_type" value="design">
                  <input type="hidden" class="form-control" name="status" value="1">
               </div>
               <div class="row clearfix" id="timeline">
                  <div class="col-md-12">
                     <div class="form-group bug-container">
                        <label for="Add task"> Add task Designs</label>
                        <textarea name="task_description[]" id="ckeditor_1" class="form-control" placeholder="" rows="2" cols="10"></textarea>
                     </div>
                  </div>
               <!--    <script>CKEDITOR.replace("ckeditor_1"); </script> -->
               </div>
               <a id="btnAddt" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
               <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
                           
        </div>
      </div>
            <div class="col-md-6">
              <h2 class="admin-taskh">Task list</h2>
             <!--  <h6><strong>Task Description:</strong></h6> -->

               @foreach($timelines as $timeline)
               <div class="taskbox-admin">
                <a onclick="deleteData('{{route('delete_task',$timeline->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              <p>{{$timeline->task_description}}</p>
                <select class="getstatus_confirm" data-taskid="{{$timeline->id}}" data-userid="{{$timeline->user_id}}">
                  <option @if($timeline->status == 1) selected @endif value="1">Pending</option>
                  <option @if($timeline->status == 2) selected @endif value="2">In progress</option>
                  <option @if($timeline->status == 3) selected @endif value="3">Complete</option>

                </select>
              </div>  
              @endforeach
            
</div>  




   </div>
</div>
@include('admin.super_admin.partials.footer')

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

   $('.getstatus_confirm').change(function() {  
      //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
           url: "{{ route('timeline_tasksstatus') }}",
           type: "POST",
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           data: {
              "_token": "{{ csrf_token() }}",
               "staus_id": staus_id,
               "taskid": taskid,
               "userid": userid,
           },
           success: function(response) {
             if(response == 0) {
                swal("Task Status Updated successfully", "", "success");
            }
           },
        });
     });

</script>