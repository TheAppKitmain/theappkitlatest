@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row clearfix">
  <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header">
              <h2>Bugs</h2>
            </div>
            <form method="get" action="{{route('buglist')}}">
            @csrf
             <div style="display: inline-block;width:40%!important;">
                <select id="bulk_option_select" name="bulk_option">
                  <option>Bulk actions</option>
                  <option value="delete">Delete Permanently</option>
                 </select>
                <button type="submit" class="btnedit btn btn-success note_view">Apply</button>
             </div>
             <div style="display: inline-block;width:59%!important;">
               <select id="dstatus" name="status">
                  <option value="10" <?php if($status == 10) echo 'selected'; ?>>All Bugs</option>
                  <option value="0" <?php if($status == 0) echo 'selected'; ?>>Pending</option>
                  <option value="1" <?php if($status == 1) echo 'selected'; ?>>In Progress</option>
                  <option value="2" <?php if($status == 2) echo 'selected'; ?>>Done</option>
               </select>
               <select id="dapps" name="appid">
                  <option value="0">All Apps</option>
                  @foreach($get_pm_apps as $app)
                  <option value="{{$app->id}}" <?php if($appid == $app->id) echo 'selected'; ?>>{{$app->app_name}}</option>
                  @endforeach
               </select>
              <button type="submit" class="btnedit btn btn-success note_view">Search</button>
            </div>
          <div class="bugtablemain">   
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th><input type="checkbox" id="checkall"></th>
                <th>Bug No.</th>
              	<th>App Name</th>
              	<th>Date</th>
              	<th>Type</th>
                <th>Status</th>
                <th>Preview</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody id="all_bugs_data">
              @foreach ($bugsdata as $data)
              <?php
                $appdata = App\Aboutapp::where('id',$data->app_id)->first();
              ?>
                <tr>
                    <td><input type="checkbox" id="bug_{{$data->id}}" class="custom_check_box" name="bug[]" value="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                	  <td>{{$appdata->app_name}}</td>
                	  <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                	  <td>{{$data->bug_type}}</td>
                    <td>@if($data->status == 0) Pending @elseif($data->status == 1) In Progress @elseif($data->status == 2) Done @else Complete @endif</td>
                    <td><a href="javascript:void(0)" data-id="{{ $data->id }}" onclick="editPost(event.target)" class="btnedit btn btn-success note_edit">Preview</a></td>
                    <td><a class="viewbtn" href="{{ route('getbug',$data->id) }}">View</a></td>
                </tr>    
              @endforeach
            </tbody>
            </table>
          </div>
          </form> 
    </div>
  </div>
</div>
</div>
</div>
</div> 
<div class="modal fade" id="bugModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
         <div class="card card-bug">
                  <div class="des-detail-img">
                    <h6><b>Bug Screenshort :</b></h6>
                    <div class="bug-img-box-super-admin">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                              <img class="d-block bug-screenshot" id="bug_screenshots" src="" alt="First slide">
                          </div>
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
          
                    <div class="d-flex">
                    <h6 class=""><strong>Bug Type:</strong></h6>
                    <p class="bug-type-p superadbug" id="bug_type"></p>
                    </div>
                  
                    <div class="d-flex">
                        <h6 class=""><strong>Bug for:</strong></h6>
                        <p class="bug-type-p superadbug" id="bug_device"></p>
                    </div>
                  
                    <h6><strong>Bug Description:</strong></h6>
                      <p id="bug_description"></p>
                  </div>
              </div>
         </div>
         </div>
      </div>
</div>
@include('admin.super_admin.partials.footer')
<script>
$(document).ready(function() {
  $('#myTable').DataTable( {"iDisplayLength": 25});
});


$('#checkall').click(function(event) {  //on click 
  var checked = this.checked;
  $('input:checkbox').not(this).prop('checked', this.checked);
});

function editPost(event) {
    var id  = $(event).data("id");
    let _url = `/bug_preview/${id}`;
    $.ajax({
      url: _url,
      type: "GET",
      success: function(response) {
          if(response) {
            $('#bug_device').html(response.bug_device);
            $('#bug_description').html(response.bug_description);
            $('#bug_type').html(response.bug_type);
            $('#bug_screenshot').html(response.bug_screenshot);
            $("#bug_id").val(response.bug_id);
            
            if(response.img_arry == ""){
              $(".des-detail-img").hide();
            }

            $.each(response, function(key, img_arry) {
              $("#bug_screenshots").attr('src', response.img_arry);
            })

            $('body').find('#bugModal').modal('show');
          }
      }
    });
  }
</script>
