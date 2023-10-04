@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3>To Do List</h3>
        </div>
        <div class="card-body">
        <form method ="POST" action="{{route('to_do_list.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
        </div>

        <div class="col-md-12">
        <div class="form-group bug-container">
            <label for="Add Note"> Add Message: </label>
            <textarea name="message" id="ckeditor_1" class="form-control" placeholder="Enter Message" rows="10" cols="50" required></textarea>
            <script>CKEDITOR.replace("ckeditor_1"); </script>

            <label class="pr-label" for="exampleInputEmail1">Assign To:</label>
            <select id="select_customers" multiple="multiple" type="text" placeholder="select user" class="form-control" name="select_customers[]">
                @foreach($all_users as $user)
                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                @endforeach
            </select><br><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>


        </form>
    </div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="nt-show">
    <!-- <h3 class="titleapp">My List</h3> -->
    <div class="tab">
        <button class="tablinks active" id="My_Tasks_" onclick="openCity(event, 'My_Tasks')">Tasks for me</button>
        <button class="tablinks" id="Send_Tasks_" onclick="openCity(event, 'Send_Tasks')">Tasks sent by me</button>
    </div>

    <div id="My_Tasks" class="tabcontent" style="display: block;">
        <div class="row">
        @foreach($todo_lists as $todo_list)
        <div class="col-md-12">
        <div class="form-group bug-container">
        <div class="col-md-12 text-right">
            <a href="{{route('to_do_list.destroy',$todo_list->id)}}" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </div>
        <div class="des-detail-img">
            <div class="d-flex">
            </div>
            @if($todo_list->status == 0 || $todo_list->status == 1)
            <div class="custom_checkbox">
            <label class="ch-checkbox">
            <input style="display:none" name="selector[]" class="ads_Checkbox" type="checkbox" value="{{$todo_list->id}}" />
            <span style="display:none" class="ads_Checkbox"><i class="ch-icon icon-tick"></i></span>
            </label>
            </div>
            @endif

            <p>{!!$todo_list->message!!}</p><br>
            @if($todo_list->status == 2)
            <span>Status:Completed</span>
            @else
            <select class="getstatustask_confirm" data-taskid="{{$todo_list->id}}" data-userid="{{$todo_list->user_id}}">
            <option>Select Status</option>
                <option @if($todo_list->status == 0) selected @endif value="0">Pending</option>
                <option @if($todo_list->status == 1) selected @endif value="1">In progress</option>
                <option @if($todo_list->status == 2) selected @endif value="2">Done</option>
            </select>

            @endif

            <a href="{{ route('view_list',$todo_list->id)}}" class="btnedit btn btn-success note_view" id="view_list" name="view_list">View</a>
            <p class="text-right">By <b>{{$todo_list->owner->first_name}}{{$todo_list->owner->last_name}}</b></p>
        </div>
        </div>
        </div>
        @endforeach
        </div>
    </div>

    <div id="Send_Tasks" class="tabcontent">
        <div class="row">
            @foreach($send_lists as $todo_list)
            <div class="col-md-12">
            <div class="form-group bug-container">
            <div class="col-md-12 text-right">
                <a href="{{route('to_do_list.destroy',$todo_list->id)}}" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </div>

            <div class="des-detail-img">
                <div class="d-flex">
                </div>
                <p>{!!$todo_list->message!!}</p><br>
                @if($todo_list->status == 0)
                <span>Status:Pending</span>
                @elseif($todo_list->status == 1)
                <span>Status:In progress</span>
                @elseif($todo_list->status == 2)
                <span>Status:Done</span>
                @endif
                <a href="{{ route('view_list',$todo_list->id)}}" class="btnedit btn btn-success note_view" id="view_list" name="view_list">View</a>
                @php
                   $get_sent_users = explode(',',$todo_list->user_ids);
                @endphp
                <p class="text-right">Sent To:<br>
                @foreach($get_sent_users as $userid)
                  @php
                  $user = App\User::where('id',$userid)->first();
                  @endphp
                   @if(!is_null($user))
                  <b>{{$user->first_name}}</b></br>
                   @endif
                @endforeach
                </p>
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

$("#select_customers").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})

$('.getstatustask_confirm').change(function() {
      //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
           url: "{{ route('task_status') }}",
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
                swal("List Status Updated successfully", "", "success");
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
