@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">

<div class="row">
<div class="col-md-12">
<div class="nt-show">
    <h3 class="titleapp">Quote List</h3>
    <div class="row">
    @foreach($notes as $note)


    <div class="col-md-6">
        <div class="card card-bug">
        <div class="row">
            <div class="col-md-6">
            <p><strong>Business Name: {{$customer->business_name}}</strong></p><br>        
            <p class="nt_date"><strong>Date: {{$note->date}}</strong></p>
            </div>
            <div class="col-md-6 text-right">
            <a onclick="deleteData('{{route('delete_quote',$note->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>              
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
                <p>{{$note->quote_title}}</p><br>
                <a class="btn btn-primary" href="{{ asset($note->quote_doc) }}" download>Download Previous Quote</a>
                @if($note->status == 3)
                <span>Status:Paid</span>
                @if($assignpm->is_confirmed == "1")
                <p class="text-right">Client is confirmed</p>
                @endif
                @else
                
                
                <select class="getstatustask_confirm" data-taskid="{{$note->id}}" data-userid="{{$note->user_id}}">                    
                    <option>Select Status</option>
                    <option @if($note->status == 0) selected @endif value="0">Sent</option>
                    <option @if($note->status == 1) selected @endif value="1">Accepted</option>
                    <option @if($note->status == 2) selected @endif value="2">Signed</option>
                    <option @if($note->status == 3) selected @endif value="3">Paid</option>
                </select> 

                @endif
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

@include('admin.super_admin.partials.footer')
<script>

$('.getstatustask_confirm').change(function() {  
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
           url: "{{ route('quote_status') }}",
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
                swal("Status Updated successfully", "", "success");
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