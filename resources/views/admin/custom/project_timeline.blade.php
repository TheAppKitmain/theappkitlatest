@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')


<!-- main start-->
<div class="mainwrapper">
            <div class=" maininnerallpagescontainer">
               <div class="mainwrapper-inner-container">
                  <div class="main-container-inner-shipping">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-12">
                              <ul class="topstepbox list-inline">
                                 <!-- <li class="top-bx list-inline-item frst-li completed-li">
                                    <p><span class="num-list "></span> <span class="text-list">Design</span></p>
                                 </li>
                                 <li class="top-bx list-inline-item">
                                    <p><span class="num-list"></span> <span class="text-list">Development</span></p>
                                 </li>
                                 <li class="top-bx list-inline-item last-li">
                                    <p><span class="num-list"></span> <span class="text-list">Complete</span></p>
                                 </li> -->
                                 <div class="card-header">
                                 <h2> Task List</h2>
                                 </div>
                              </ul>
                           </div>
                           <div class="col-md-12">
                                 <div class="tasklisting-container">
                                 <div class="tasklisting-container-scroll">
                                    @if( count($project_timelines) == 0) 
                                              <div class="card-header ">
                                       <h2>No tasks have been added to your project yet</h2>
                                     </div>
                                     @else
                                    <div class="row">

									           @foreach($project_timelines as $project_timeline)
                                       <div class="col-md-6">
                                          <div class="tasklist d-flex">
                                          	 
									           
                                             <div class="tick-lft">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                             </div>
                                             <div class="tick-lft">
                                                <p>{!!$project_timeline->task_description!!}</p>
                                             </div>
                                             <span class="status-span @if($project_timeline->status == 1) status-pending @elseif($project_timeline->status == 2)status-working @elseif($project_timeline->status == 3)status-done @else status-completed @endif">@if($project_timeline->status == 1) Pending @elseif($project_timeline->status == 2)In Progress @elseif($project_timeline->status == 3) Done @else Completed @endif</span>
                                              
                                          </div>
                                       </div>
                                       	@endforeach
          
          									@endif
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

@include('admin.custom.partials.footer')