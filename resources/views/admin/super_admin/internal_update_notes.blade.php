@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3>Add Notes</h3>
        </div>
        <div class="card-body"> 
        <form method ="POST" action="{{route('store_notes')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="customer_id" value="{{$customer->id}}">
            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
        </div>
        <div class="row clearfix" id="interal_notes">
        <div class="col-md-6">
        <div class="form-group bug-container">
            <label for="Add Note"> Add Note: </label>
            <textarea name="internal_notes[]" id="ckeditor_1" class="form-control" placeholder="Note" rows="10" cols="50" required></textarea>
        </div>
        </div>
        <script>CKEDITOR.replace("ckeditor_1"); </script>
        </div>
        <a id="add_notes" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
        <button type="submit" class="btn btn-primary">Save</button>       
        </form>
    </div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="nt-show">
    <h3 class="titleapp">Requests</h3>
    <div class="row">
    @foreach($notes as $note)


    <div class="col-md-6">
        <div class="card card-bug">
        <div class="row">
            <div class="col-md-6">        
            <p class="nt_date"><strong>Date: {{$note->date}}</strong></p>
            </div>
            <div class="col-md-6 text-right">
            <a onclick="deleteData('{{route('delete_note',$note->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>              
            </div>
        </div>
        
            @if($note->progress_status == 0 || $note->progress_status == 1)
            <div class="custom_checkbox">
            <label class="ch-checkbox">
            <input style="display:none" name="selector[]" class="ads_Checkbox" type="checkbox" value="{{$note->id}}" />
            <span style="display:none" class="ads_Checkbox"><i class="ch-icon icon-tick"></i></span>
            </label>
        </div>
            @endif
            <div class="des-detail-img">
                <div class="d-flex">
                </div>
                <p>{!!$note->notes!!}</p><br>
                
                @if($note->progress_status == 2)
                <span>Status:Completed</span>
                @else
                <select class="getstatustask_confirm" data-taskid="{{$note->id}}" data-userid="{{$note->user_id}}">                    
                <option>Select Status</option>
                    <option @if($note->progress_status == 0) selected @endif value="0">Pending</option>
                    <option @if($note->progress_status == 1) selected @endif value="1">In progress</option>
                    <option @if($note->progress_status == 2) selected @endif value="2">Done</option>
                </select>
                
                @endif
                <a href="{{ route('view_note',$note->id)}}" class="btnedit btn btn-success note_view" id="edit_note" name="edit_note">View</a>
                <a href="javascript:void(0)" data-id="{{ $note->id }}" onclick="editPost(event.target)" class="btnedit btn btn-success note_edit">Edit</a>
                <p class="text-right"><b>{{$note->user->first_name}}{{$note->user->last_name}}</b></p>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
</div>
    </div>
</div>
</div>
</div>
</div>

<!-- Modal -->

<?php  $notes = App\InternalUpdates::where('id',0)->count(); ?>

<div class="modal fade" id="bugModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form name="bug_status" method ="POST" action="{{route('update_notes')}}" id="bug_status">
               @csrf
               <div class="form-group">                 
                  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Edit Note </label>
                  <input type="hidden" class="form-control" name="note_id" id="note_id">
                  <textarea name="bug_note" id="internal_note" class="internal_note_edit" placeholder="Edit Note" rows="10" cols="50"></textarea>
               </div>
               <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Update</button>
            </form>
         </div>
         </div>
      </div>
  </div>

@include('admin.super_admin.partials.footer')
<script>

$('.getstatustask_confirm').change(function() {  
      //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
           url: "{{ route('note_status') }}",
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
                swal("Note Status Updated successfully", "", "success");
                location.reload();
            }
           },
    });
});

function editPost(event) {
    var id  = $(event).data("id");
    let _url = `/edit_note/${id}`;
    $.ajax({
      url: _url,
      type: "GET",
      success: function(response) {
          if(response) {
            $('.internal_note_edit').val(response.bug_note);
            CKEDITOR.replace("internal_note");
            $("#note_id").val(response.note_id);
            $('body').find('#bugModal').modal('show');
          }
      }
    });
  }

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