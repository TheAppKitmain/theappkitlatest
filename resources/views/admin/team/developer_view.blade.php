@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
    <div class="mainwrapper-inner-container main-wrpr-usr-view">
        <div class="container-fluid">
            <div class="row clearfix aboutappcontainer">
                <div class="col-md-12">
                    <div class="card"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix aboutappcontainer">
                <div class="col-md-12">
                    <div class="abtapps-box">
                        @foreach ($aboutapps as $app)
                            <li class="abtappsli"><a href="#">{{ $app->app_name }}</a></li>
                        @endforeach
                    </div>
                    <div class="">
                        <div class="tab">
                            <button class="tablinks active" id="AboutApp_" onclick="openCity(event, 'AboutApp')">About
                                App</button>
                            <button class="tablinks" id="Addtask_" onclick="openCity(event, 'Addtask')">Tasks</button>
                            <button class="tablinks" id="Bugs_" onclick="openCity(event, 'Bugs')">Bugs</button>
                            <button class="tablinks" id="Builds_" onclick="openCity(event, 'Builds')">Add
                                Builds</button>
                            <button class="tablinks" id="Design_" onclick="openCity(event, 'Design')">Design
                                Details</button>
                            <button class="tablinks" id="Appstore_" onclick="openCity(event, 'Appstore')">App
                                Store</button>
                            <button class="tablinks" id="Domain_" onclick="openCity(event, 'Domain')">Domain
                                Details</button>
                            <button class="tablinks" id="AdminDetails_" onclick="openCity(event, 'AdminDetails')">Admin
                                Details</button>
                            <button class="tablinks" id="UploadDetail_" onclick="openCity(event, 'UploadDetail')">Gmail
                                Details</button>
                        </div>

                    </div>
                    <!--------------------------------- Start About App Data------------------------------------->
                    <div id="AboutApp" class="tabcontent" style="display: block;">
                        @if (count($aboutapps) == 0)
                            <h1 class="empty-title">Client has not added details</h1>
                        @else
                            @foreach ($aboutapps as $aboutapp)
                                <div class="about-app-box">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h3 class="titleapp">App Name</h3>
                                            <h6> {{ $aboutapp->app_name }}</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <h3 class="titleapp">App Description</h3>
                                            <h6>{{ $aboutapp->app_idea }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-app-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="ques">Have you thought about this idea for a while?</h2>
                                            <h6> {{ $aboutapp->idea }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="ques">Are you looking for an iOS & Android App?</h2>
                                            <h6> {{ $aboutapp->lookfor }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="ques">Do you require a website to be development with the App?
                                            </h2>
                                            <h6> {{ $aboutapp->website }}</h6>
                                        </div>
                                        <div class="col-md-12">
                                            @if (!is_null($aboutapp->wireframes))
                                                <a class="download-btn" href="{{ asset($aboutapp->wireframes) }}"
                                                    download><i class="fa fa-download" aria-hidden="true"></i> Download
                                                    Wireframes</a>
                                            @else
                                                <a class="download-btn" href="#"><i class="fa fa-download"
                                                        aria-hidden="true"></i> Download Wireframes</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-----------------Show Notes----------------->
                            <div class="nt-show">
                                <h3 class="titleapp">Notes</h3>
                                <div class="row">
                                    @foreach ($aboutappnotes as $aboutappnote)
                                        <div class="col-md-6">
                                            <div class="m-note note-abt">
                                                <p class="nt_date"><strong>Date:
                                                        {{ $aboutappnote->created_at }}</strong></p>
                                                <p>{!! $aboutappnote->add_note !!}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--------------------------------- End About App Data------------------------------------->
                    <div id="Appstore" class="tabcontent">
                        <h3 class="titleapp"> App store</h3>
                        <div class="row">
                            @if (!is_null($store))
                                @if (!is_null($store->done_ios))
                                    <div class="col-md-6">
                                        <div class="stp_cmplt card card-bug">
                                            <h2><i class="fa fa-apple" aria-hidden="true"></i> iOS</h2>
                                            <h3>Completed Steps for iOS</h3>
                                            <img src="{{ asset('images/tick1.png') }}" style="width: 35px;">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="stp_cmplt card card-bug">
                                            <h2><i class="fa fa-apple" aria-hidden="true"></i> iOS</h2>
                                            <h3>Completed Steps for iOS</h3>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($store->done_android))
                                    <div class="col-md-6">
                                        <div class="stp_cmplt card card-bug">
                                            <h2><i class="fa fa-android" aria-hidden="true"></i> Android</h2>
                                            <h3>Completed Steps for Android</h3>
                                            <img src="{{ asset('images/tick1.png') }}" style="width: 35px;">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="stp_cmplt card card-bug">
                                            <h2><i class="fa fa-android" aria-hidden="true"></i> Android</h2>
                                            <h3>Completed Steps for Android</h3>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-md-6">
                                    <div class="stp_cmplt card card-bug">
                                        <h2><i class="fa fa-apple" aria-hidden="true"></i> iOS</h2>
                                        <h3>Completed Steps for iOS</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stp_cmplt card card-bug">
                                        <h2><i class="fa fa-android" aria-hidden="true"></i> Android</h2>
                                        <h3>Completed Steps for Android</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--------------------------------- Start Domain Detail Data------------------------------------->
                <div id="Domain" class="tabcontent">
                    @if ($domaindetail == null)
                        <h1 class="empty-title">Client has not added domain details</h1>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="titleapp">Domain Details</h3>
                                <div class="card card-bug">
                                    <ul class="list-inline ul-details">
                                        <li class="list-inline-item"><i class="fa fa-globe"
                                                aria-hidden="true"></i>{{ $domaindetail->domain_details }}</li>
                                        <li class="list-inline-item"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            {{ $domaindetail->domain_provider }}</li>
                                        <li class="list-inline-item"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            {{ $domaindetail->domain_email }}</li>
                                        <li class="list-inline-item"><i class="fa fa-lock" aria-hidden="true"></i>
                                            {{ $domaindetail->domain_password }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!--------------------------------- End Domain Detail Data------------------------------------->
                <!--------------------------------- Start Design Detail Data------------------------------------->
                <div id="Design" class="tabcontent">
                    @if ($designdetail == null)
                        <h1 class="empty-title">Client has not added design details</h1>
                    @else
                        <h3 class="titleapp">Design Details</h3>
                        <div class="card card-bug">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="sp-des-dt">Logo</h4>
                                    <div class="des-detail-img logo-app-sup">
                                        <a href="{{ asset($designdetail->logo) }}" download><img
                                                src="{{ asset($designdetail->logo) }}"></a>
                                    </div>
                                </div>
                                @if ($designdetail->design_details != null)
                                    <div class="col-md-3">
                                        <div class="des-detail-img ">
                                            <h4>Reference Link</h4>
                                            <a class="ref-link"
                                                href="{{ $designdetail->design_details }}">{{ $designdetail->design_details }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <h4 class="sp-des-dt">Designs Screens</h4>
                            <div class="row designscreensrow">
                                @if ($designdetail->dp1 != null)
                                    @php
                                        $file_parts = pathinfo($designdetail->dp1);
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="des-detail-img">
                                            @if ($file_parts['extension'] == 'jpg' || $file_parts['extension'] == 'png')
                                                <a href="{{ asset($designdetail->dp1) }}" download><img
                                                        src="{{ asset($designdetail->dp1) }}"></a>
                                            @else
                                                <a href="{{ asset($designdetail->dp1) }}" download>Download
                                                    Document</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($designdetail->dp2 != null)
                                    @php
                                        $file_parts = pathinfo($designdetail->dp2);
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="des-detail-img">
                                            @if ($file_parts['extension'] == 'jpg' || $file_parts['extension'] == 'png')
                                                <a href="{{ asset($designdetail->dp2) }}" download><img
                                                        src="{{ asset($designdetail->dp2) }}"></a>
                                            @else
                                                <a href="{{ asset($designdetail->dp2) }}" download>Download
                                                    Document</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($designdetail->dp3 != null)
                                    @php
                                        $file_parts = pathinfo($designdetail->dp3);
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="des-detail-img">
                                            @if ($file_parts['extension'] == 'jpeg' || $file_parts['extension'] == 'png')
                                                <a href="{{ asset($designdetail->dp3) }}" download><img
                                                        src="{{ asset($designdetail->dp3) }}"></a>
                                            @else
                                                <a href="{{ asset($designdetail->dp3) }}" download>Download
                                                    Document</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($designdetail->dp4 != null)
                                    @php
                                        $file_parts = pathinfo($designdetail->dp4);
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="des-detail-img">
                                            @if ($file_parts['extension'] == 'jpeg' || $file_parts['extension'] == 'png')
                                                <a href="{{ asset($designdetail->dp4) }}" download><img
                                                        src="{{ asset($designdetail->dp4) }}"></a>
                                            @else
                                                <a href="{{ asset($designdetail->dp4) }}" download>Download
                                                    Document</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <!--------------------------------- End Design Detail Data------------------------------------->

                <!--------------------------------- Start Bug Data------------------------------------->
                <div id="Bugs" class="tabcontent bugtabcontaner bugcontaner-bx">
                    @if (count($bugdetails) == 0)
                        <h1 class="empty-title">No bugs reported by the client</h1>
                    @else
                        <h3 class="titleapp">Bugs Details</h3>
                        <input type="hidden" class="myapp_id" name="app_id" value="{{ $app_id }}">
                        <input type="hidden" class="myapp_user_id" name="user_id" value="{{ $user->id }}">
                        <button id="show_mul_option">Select multiple to send</button>
                        <select style="display:none" id="sendtom_select">
                            <option value="0">Select</option>
                            <option value="1">In progress</option>
                            <option value="2">Done</option>
                        </select>
                        <button style="display:none" id="sendtomultiple">Send</button>
                        <div class="row dv_bug_row">
                            @foreach ($bugdetails as $bugdetail)
                                <div class="col-md-6">
                                    <div class="card card-bug">
                                        @if ($bugdetail->status == 0 || $bugdetail->status == 1)
                                            <div class="custom_checkbox">
                                                <label class="ch-checkbox">
                                                    <input style="display:none" name="selector[]" class="ads_Checkbox"
                                                        type="checkbox" value="{{ $bugdetail->id }}" />
                                                    <span style="display:none" class="ads_Checkbox"><i
                                                            class="ch-icon icon-tick"></i></span>
                                                </label>
                                            </div>
                                        @endif
                                        <div class="des-detail-img">
                                            @if ($bugdetail->bug_screenshot)
                                                @php
                                                    $ext = substr($bugdetail->bug_screenshot, strrpos($bugdetail->bug_screenshot, '.', -1), strlen($bugdetail->bug_screenshot));
                                                    $array_img_ext = ['.jpeg', '.jpg', '.png', '.gif'];
                                                    $array_vid_ext = ['.3g2', '.3gp', '.avi', '.flv', '.h264', '.m4v', '.mkv', '.mov', '.mp4', '.mpg', '.mpeg', '.rm', '.swf', '.vob', '.wmv'];
                                                @endphp
                                                @if (in_array($ext, $array_img_ext))
                                                    <h6><b>Bug Screenshort :</b></h6>
                                                    <div class="bug-img-box-super-admin">
                                                        <a href="{{ asset($bugdetail->bug_screenshot) }}" download>

                                                            <div id="carouselExampleControls" class="carousel slide"
                                                                data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach ($bugdetail->img_arry as $data)
                                                                        @if ($loop->first)
                                                                            <div class="carousel-item active">
                                                                        @else
                                                                            <div class="carousel-item">
                                                                        @endif
                                                                        <img class="d-block bug-screenshot"
                                                                            src="{{ asset($data) }}"
                                                                            alt="First slide">
                                                                </div>
                                                @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            @elseif(in_array($ext, $array_vid_ext))
                                <h6><b>Bug Video :</b></h6>
                                <a href="{{ asset($bugdetail->bug_screenshot) }}" download>Download video
                                </a>
                            @else
                                <h6><b>Bug File :</b></h6>
                                <a href="{{ asset($bugdetail->bug_screenshot) }}" download>Download
                                </a>
                            @endif
                    @endif
                    <div class="d-flex">
                        <h6><b>Bug No :</b></h6>
                        <p class="bug-type-p">#{{ $bugdetail->id }}</p>
                    </div>
                    <div class="d-flex">
                        <h6 class=""><strong>Date</strong></h6>
                        <p class="bug-type-p superadbug">{{ date('d-m-Y', strtotime($bugdetail->created_at)) }}</p>
                    </div>
                    <div class="d-flex">
                        <h6 class=""><strong>Posted By</strong></h6>
                        <p class="bug-type-p superadbug">{{ $bugdetail->bugby }}</p>
                    </div>
                    <div class="d-flex">
                        <h6 class=""><strong>Bug Type:</strong></h6>
                        <p class="bug-type-p superadbug">{{ $bugdetail->bug_type }}</p>
                    </div>
                    @if (!is_null($bugdetail->bug_device))
                        <div class="d-flex">
                            <h6 class=""><strong>Bug for</strong></h6>
                            <p class="bug-type-p superadbug">{{ $bugdetail->bug_device }}</p>
                        </div>
                    @endif
                    <h6><strong>Bug Description:</strong></h6>
                    <p>{{ $bugdetail->bug_description }}</p>
                    @if ($bugdetail->bug_estimated_date != 0000 - 00 - 00)
                        <h6 class=""><strong>Estimated Date</strong></h6>
                        <p class="bug-type-p superadbug">
                            {{ date('d-m-Y', strtotime($bugdetail->bug_estimated_date)) }}
                        </p>
                    @endif
                    @if ($bugdetail->status == 3)
                        <span>Status:Completed</span>
                    @else
                        <select class="getstatus_confirm" data-bug="{{ $bugdetail->id }}">
                            <option>Select Status</option>
                            <option @if ($bugdetail->status == 0) selected @endif value="0">Pending</option>
                            <option @if ($bugdetail->status == 1) selected @endif value="1">In Progress</option>
                            <option @if ($bugdetail->status == 2) selected @endif value="2">Done</option>
                        </select>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!--------------------------------- End Bug Data------------------------------------->







<!--------------------------------- Start Admin Detail Data------------------------------------->
<div id="AdminDetails" class="tabcontent">
    @if (!is_null($adminDetail))
        <div class="card">
            <div class="card-header">
                <h2>Admin Details</h2>
            </div>
            <div class="card-body">
                <p><b>Email :</b> {{ $adminDetail->email }}</p>
                <p><b>Password :</b> {{ $adminDetail->password }}</p>
                <p><b>Url :</b> <a href="{{ $adminDetail->url }}">{{ $adminDetail->url }}</a></p>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h2>No Details Found</h2>
            </div>
        </div>
    @endif
</div>

<!--------------------------------- End Admin Detail Data------------------------------------->


<!--------------------------------- Start Gmail Detail Data------------------------------------->
<div id="UploadDetail" class="tabcontent">
    @if (!is_null($uploadDetail))
        <div class="card">
            <div class="card-header">
                <h2>Admin Details</h2>
            </div>
            <div class="card-body">
                <p><b>Email :</b> {{ $uploadDetail->email }}</p>
                <p><b>Password :</b> {{ $uploadDetail->password }}</p>

            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h2>No Details Found</h2>
            </div>
        </div>
    @endif
</div>

<!--------------------------------- End Gmail Detail Data------------------------------------->


<!--------------------------------- Start Add Build  ------------------------------------->
<div id="Builds" class="tabcontent add-buld-tabcontnr">
    <div class="row">
        @if (count($buildudids) > 0)
            @foreach ($buildudids as $buildudid)
                <div class="col-md-4">
                    <div class="card card-bug">
                        <div class="des-detail-img">
                            <h4>UDID</h4>
                            <p>{{ $buildudid->udid }}</p>
                            @if ($buildudid->add_screenshot)
                                <img src="{{ asset($buildudid->add_screenshot) }}">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    @endif
    <div class="col-md-12 bld-col">
        <form method="POST" action="{{ route('uploadbuild_developer') }}" enctype="multipart/form-data">
            @csrf
            <h3 class="titleapp"> Add Builds</h3>
            <div class="card card-bug">
                <div class="row">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" class="form-control" name="app_id" value="{{ $app_id }}">
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12 no-padding">
                            @if (!is_null($test_build))
                                <div class="form-group">
                                    <label for="androidbuild">Android Build</label>
                                    <input type="text" @if (!is_null($test_build->androidbuild)) value="{{ $test_build->androidbuild }}" @else value="" @endif name="androidbuild" class="form-control">
                                    <label for="iosbuild">iOS Build</label>
                                    <input type="text" @if (!is_null($test_build->iosbuild)) value="{{ $test_build->iosbuild }}" @else value="" @endif name="iosbuild" class="form-control">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="androidbuild">Android Build</label>
                                    <input type="text" name="androidbuild" value="" class="form-control">
                                    <label for="iosbuild">iOS Build</label>
                                    <input type="text" value="" name="iosbuild" class="form-control">
                                </div>

                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>


<div id="Addtask" class="tabcontent maintabsupercontent">
    <div class="row">
        <?php
                   if (in_array(Auth::user()->id, $developer_id)){
                   ?>
        <div class="col-md-6">
            <form method="POST" action="{{ route('developer_timeline_add') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" value="{{ session('user_id') }}" name="user_id">
                    <input type="hidden" value="{{ session('app_id') }}" name="app_id">
                    <input type="hidden" class="form-control" name="task_type" value="design">
                    <input type="hidden" class="form-control" name="status" value="1">
                </div>
                <div id="timeline">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Add task"> Add task</label>
                            <textarea name="task_description[]" id="add_task_1" class="form-control" placeholder=""
                                rows="2" cols="10" required=""></textarea>
                        </div>
                    </div>
                    <script>
                        CKEDITOR.replace("add_task_1");
                    </script>
                </div>
                <a id="btnAddt" type="button" class="btn btn-info" data-toggle="tooltip"
                    data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <?php } ?>
        <div class="col-md-12">
            <h2 class="admin-taskh">Task list</h2>
            @foreach ($timelines as $timeline)
                <div class="taskbox-admin">
                    <!-- <a onclick="deleteData('{{ route('delete_task', $timeline->id) }}')" class="btndelete">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                             </a> -->
                    <p>{!! $timeline->task_description !!}</p>
                    @if ($timeline->status == 4)
                        <span>Status:Complete</span>
                    @else
                        <select class="getstatustask_confirm" data-taskid="{{ $timeline->id }}"
                            data-userid="{{ $timeline->user_id }}">
                            <option @if ($timeline->status == 1) selected @endif value="1">Pending</option>
                            <option @if ($timeline->status == 2) selected @endif value="2">In progress</option>
                            <option @if ($timeline->status == 3) selected @endif value="3">Done</option>
                    @endif
                    </select>
                </div>
            @endforeach
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
                        <input type="hidden" id="bug_id" name="bug_id" class="bug_id" value="">
                        <input type="hidden" id="staus_id" name="staus_id" class="staus_id" value="">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Bug Notes</label>
                        <textarea name="bug_note" id="bug_note" class="form-control" placeholder="Bug Note" rows="10"
                            cols="50"></textarea><br>
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Estimated Date: </label><br>

                        <?php $mytime = Carbon\Carbon::now();
                        $current_date = $mytime->toDateString();
                        ?>
                        <input id="date" class="from-control" style="width: 100%;" name="bug_date"
                            value="{{ $current_date }}" type="date"><br><br>
                        
                        <div id="require_store_update">
                            <label for="androidbuild">Requires Store Update</label>
                            <input unchecked type="checkbox" id="require_store" name="require_store" value="1" class="Confirmedandroid">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-default btn-success btn-block"><span
                            class="glyphicon glyphicon-off"></span>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.team.partials.footer')
<script>
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
        window.scrollTo(0, 0);

        if (staus_id == 2) {

            $('#date').attr('readonly', true);

        } else {
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
            processData: false,

            success: function(response) {
                if (response == 0) {
                    var staus_value = "Pending";
                } else if (response == 1) {
                    var staus_value = "In Progress";
                } else {
                    var staus_value = "Done";
                }
                swal(staus_value, "Bug status updated successfully", "success");
                location.reload();
            }

        });
    });
</script>
<script>
    // function deleteData(url){
    //     $.ajax({
    //        type:'get',
    //        url:url,
    //        success:function(results){
    //           if (results.success === true) {
    //               swal("Done!", results.message, "success");
    //           } else {
    //               swal("Error!", results.message, "error");
    //           }
    //           setTimeout(function(){location.reload();}, 1000)
    //        }
    //     })
    //  }

    $('.getstatustask_confirm').change(function() {
        //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
            url: "{{ route('developer_timeline_tasksstatus') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "staus_id": staus_id,
                "taskid": taskid,
                "userid": userid,
            },
            success: function(response) {
                if (response == 0) {
                    swal("Task Status Updated successfully", "", "success");
                }
            },
        });
    });
    $("#show_mul_option").click(function(a) {
        $("#sendtom_select").show();
        $("#sendtomultiple").show();
        $(".ads_Checkbox").show();
    });

    $("#sendtomultiple").click(function(a) {
        var myapp_id = $(".myapp_id").val();
        var user_id = $(".myapp_user_id").val();
        var status = $('#sendtom_select').val();
        if (status == 0) {
            alert("please select status for bug");
        }
        var val = [];
        $(':checkbox:checked').each(function(i) {
            val[i] = $(this).val();
        });
        if (val.length <= 0) {
            alert("please select the bugs");
        } else {
            $.ajax({
                url: "{{ route('multiple_status_bug') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                    "myapp_id": myapp_id,
                    "status": status,
                    'user_id': user_id,
                    "val": val,
                },
                success: function(response) {
                    if (response == 1) {
                        swal("Status Updated successfully", "", "success");
                        location.reload();
                    }
                },
            });
        }

    });
</script>
