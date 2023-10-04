@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper task">
   <div class="mainwrapper-inner-container">
      <div class="container-fluid">
        <div class="row clearfix">
        <div class="col-md-12">
        <div class="card-header">
        <h3>Daily Update</h3>
     </div>
        @if ($type == 1)
        <form method="POST" action="{{route('employee_update.store')}}" enctype="multipart/form-data">
         @else
         <form method="POST" action="{{route('employee_update.update', $update->id)}}" enctype="multipart/form-data">
         @endif
         @csrf
         @if ($type == 2)
            {{ method_field('PUT') }}
         @endif
         <div class="form-group">
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
         </div>
         <div class="row clearfix" id="employee_update">
            <div class="col-md-12">
               <div class="form-group">
                  <label for="Add task"><?php echo $type == 1 ? 'Add Daily Update ' : 'Edit Daily Update'; ?></label>
                  <textarea name="updates" id="ckeditor_1" class="form-control" placeholder="Add Daily Update Here" rows="10" cols="10" required><?php echo $type == 2 ? $update->updates : ''; ?></textarea>
                  <script>CKEDITOR.replace("ckeditor_1"); </script>
                  @if ($errors->has('updates'))
                     <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('updates') }}</strong>
                     </span>
                  @endif
                  <div class="help-block with-errors"></div>
               </div>
            </div>
         </div>
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
        </div>                   
        </div>
      </div>
    <div class="col-md-12">
        <h2 class="admin-taskh">Today Update</h2>

        <div class="nt-show">
<div class="row">
        <div class="col-md-12">
        @if (!is_null($update_list))
        <div class="form-group bug-container">
        <div class="col-md-12 text-right">
            <a href="{{route('employee_update.destroy',$update_list->id)}}" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </div>
        <div class="des-detail-img p-  l-20">
            <div class="d-flex">
            </div>
            <p>{!!$update_list->updates!!}</p><br>
            <p class="text-right"><b >Date</b> : {{$update_list->update_time}}</p>
            <a href="{{ route('employee_update.edit',$update_list->id)}}" class="btnedit btn btn-success note_view" id="view_list" name="view_list">Edit</a>
        </div>
        </div>
        @else
        <h4 class="text-center w-100 p-2">No Updates Found Today</h4>
         @endif
        </div>
        </div>
        </div>
    </div>  

   </div>
</div>
@include('admin.super_admin.partials.footer')
