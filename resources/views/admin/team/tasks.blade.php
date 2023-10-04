@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row clearfix">
  <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header">
              <h2>Task</h2>
            </div>
            <div class="bugtablemain task_update_tablemain">
@if(!$tasks->isEmpty())                 
<table id="example" class="table table-striped table-bordered task_update_table" style="width:100%">
        <thead>
            <tr>
            	<th>App Name</th>
            	<th>Date</th>
            	<th>Task Description</th>
              <th>Status</th>
              <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $data)
              <tr>
              	  <td>{{$data->app_name}}</td>
              	  <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
              	  <td>{!!$data->task_description!!}</td>
                  <td>@if($data->status == 1) Pending @elseif($data->status == 2) In Progress  @elseif($data->status == 3) done @else Complete @endif</td>
                  <td><a class="viewbtn" href="{{ route('developer_timeline',$data->id) }}">View</a></td>
              </tr>    
              @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }}
@else
 <h2>No Task </h2>   
 @endif   
</div>

    </div>
  </div>
</div>
</div>
</div>
</div>               
@include('admin.team.partials.footer')

