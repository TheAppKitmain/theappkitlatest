@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
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
        <button class="tablinks active" id="UserDetails_" onclick="openCity(event, 'UserDetails')">User Details</button>
        <button class="tablinks" id="AboutApp_" onclick="openCity(event, 'AboutApp')">About App</button>
        <button class="tablinks" id="Addtask_" onclick="openCity(event, 'Addtask')">Tasks</button>
        <button class="tablinks" id="Bugs_" onclick="openCity(event, 'Bugs')">Bugs</button>
        <button class="tablinks" id="Builds_" onclick="openCity(event, 'Builds')">Add Builds</button>
        <button class="tablinks" id="Design_" onclick="openCity(event, 'Design')">Design Details</button>
        <button class="tablinks" id="Store_information_" onclick="openCity(event, 'Store_information')">Store Information</button>
        <button class="tablinks" id="Appstore_" onclick="openCity(event, 'Appstore')">App Store</button>
        <button class="tablinks" id="Domain_" onclick="openCity(event, 'Domain')">Domain Details</button>
        <button class="tablinks" id="Build_udid_" onclick="openCity(event, 'Build_udid')">Build UDID</button>
        <button class="tablinks" id="Agreement_" onclick="openCity(event, 'Agreement')">Add Agreement</button>
        <button class="tablinks" id="Quote_" onclick="openCity(event, 'Quote')">Add Quote</button>
        <button class="tablinks" id="Payment_" onclick="openCity(event, 'Payment')">Payment</button>
        <button class="tablinks" id="Developer_" onclick="openCity(event, 'Developer')">Assign Developer</button>
        <button class="tablinks" id="Upload_details_" onclick="openCity(event, 'Upload_details')">Gmail Account</button>
        <button class="tablinks" id="Admin_Upload_detail_" onclick="openCity(event, 'Admin_Upload_detail')">Admin Details</button>
        <button class="tablinks" id="Maintenance_" onclick="openCity(event, 'Maintenance')">Maintenance</button>
    </div>
</div>

<!--------------------------------- Start User Details Data------------------------------------->
<div id="UserDetails" class="tabcontent" style="display: block;">
    @if ($user == null)
        <h1 class="empty-title">Client has no information</h1>
    @else
        <div class="row">
            <div class="col-md-12">
                <h3 class="titleapp">User Information</h3>
                <div class="card card-bug">
                    <div class="row">
                        <div class="col-md-6 store_info_details ">
                            <label class="plcy-label">First Name</label>
                            <h5>{{ $user->first_name }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Last Name</label>
                            <h5>{{ $user->last_name }}</h5>
                        </div><br><br>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Business Name</label>
                            <h5>{{ $user->business_name }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Country</label>
                            <h5>{{ $user->country }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Email</label>
                            <h5>{{ $user->email }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Number</label>
                            <h5>{{ $user->number }}</h5>
                        </div>
                        @if (!is_null($user->referred_by))
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Referred By</label>
                            <h5>{{ $user->referred_by }}</h5>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!--------------------------------- Start About App Data------------------------------------->

<div id="AboutApp" class="tabcontent">
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
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('aboutappnotes.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_id"
                                    value="{{ $user->id }}">
                                <input type="hidden" class="form-control" name="app_id"
                                    value="{{ $app_id }}">
                            </div>
                            <div class="row clearfix" id="bugsn">
                                <div class="col-md-6">
                                    <div class="form-group bug-container">
                                        <label for="Add Note"> Add Note </label>
                                        <textarea name="add_note[]" id="ckeditor_1"
                                            class="form-control" placeholder="Note" rows="10"
                                            cols="50"></textarea>
                                    </div>
                                </div>
                                <script>
                                    CKEDITOR.replace("ckeditor_1");
                                </script>
                            </div>
                            <a id="btnAddn" type="button" class="btn btn-info" data-toggle="tooltip"
                                data-original-title="Add more controls"><i
                                    class="glyphicon glyphicon-plus-sign"></i>Add New</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <!-----------------Show Notes----------------->
        <div class="nt-show">
            <h3 class="titleapp">My Notes</h3>
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

    <div id="Addtask" class="tabcontent maintabsupercontent">
    <h3 class="titleapp"> Add Task</h3>
    <form method="POST" action="{{ route('timeline.store') }}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class="col-md-6">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{ session('user_id') }}" name="user_id" id="tast_user_id">
                <input type="hidden" value="{{ $user->id }}" name="customer_id">
                <input type="hidden" value="{{ session('app_id') }}" name="app_id" id="tast_app_id">
                <div class="d-flex prddflx">
                    @if (!is_null($task_list))
                        @if ($task_list->task_type == 0)
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio1" name="task_type" class="custom-control-input"
                                        checked="" value="0">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio1">Design</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio2" name="task_type" class="custom-control-input"
                                        value="1">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio2">Development</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio3" name="task_type" class="custom-control-input"
                                        value="2">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio3">Complete</label>
                                </div>
                            </div>
                        @elseif($task_list->task_type == 1)
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio1" name="task_type" class="custom-control-input"
                                        value="0">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio1">Design</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio2" name="task_type" class="custom-control-input"
                                        checked="" value="1">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio2">Development</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio3" name="task_type" class="custom-control-input"
                                        value="2">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio3">Complete</label>
                                </div>
                            </div>
                        @else
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio1" name="task_type" class="custom-control-input"
                                        value="0">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio1">Design</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio2" name="task_type" class="custom-control-input"
                                        value="1">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio2">Development</label>
                                </div>
                            </div>
                            <div class="w3-half">
                                <div class="custom-control custom-radio mt-3">
                                    <input type="radio" id="customRadio3" name="task_type" class="custom-control-input"
                                        checked="" value="2">
                                    <label class="custom-control-label user_view_radio"
                                        for="customRadio3">Complete</label>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="w3-half">
                            <div class="custom-control custom-radio mt-3">
                                <input type="radio" id="customRadio1" name="task_type" class="custom-control-input"
                                    checked="" value="0">
                                <label class="custom-control-label user_view_radio" for="customRadio1">Design</label>
                            </div>
                        </div>
                        <div class="w3-half">
                            <div class="custom-control custom-radio mt-3">
                                <input type="radio" id="customRadio2" name="task_type" class="custom-control-input"
                                    value="1">
                                <label class="custom-control-label user_view_radio"
                                    for="customRadio2">Development</label>
                            </div>
                        </div>
                        <div class="w3-half">
                            <div class="custom-control custom-radio mt-3">
                                <input type="radio" id="customRadio3" name="task_type" class="custom-control-input"
                                    value="2">
                                <label class="custom-control-label user_view_radio" for="customRadio3">Complete</label>
                            </div>
                        </div>
                    @endif
                </div>
                <input type="hidden" class="form-control" name="status" value="1">
            </div>
            <div id="timeline">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Add task"> Add task</label>
                        <textarea name="task_description[]" id="add_task_1" class="form-control" placeholder="" rows="2"
                            cols="10" required=""></textarea>
                    </div>
                </div>
                <script>
                    CKEDITOR.replace("add_task_1");
                </script>
            </div>
            <a id="btnAddt" type="button" class="btn btn-info" data-toggle="tooltip"
                data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <div class="col-md-12">
        <h2 class="admin-taskh">Task list</h2>
        <select id="short_task_list">
            <option value="0">All Task</option>
            <option value="1">Pending</option>
            <option value="2">In progress</option>
            <option value="3">Done</option>
        </select>
        <div class="outer_taklist">
            @foreach ($timelines as $timeline)
                <div class="taskbox-admin task_type_{{ $timeline->status }}">
                    <a onclick="deleteData('{{ route('delete_task', $timeline->id) }}')" class="btndelete">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    <p>{!! $timeline->task_description !!}</p>
                    <select class="getstatustask_confirm" data-taskid="{{ $timeline->id }}"
                            data-userid="{{ $timeline->user_id }}">
                            <option @if ($timeline->status == 1) selected @endif value="1">Pending</option>
                            <option @if ($timeline->status == 2) selected @endif value="2">In progress</option>
                            <option @if ($timeline->status == 3 || $timeline->status == 4) selected @endif value="3">Done</option>
                    </select>
                </div>
            @endforeach
        </div>
    </div>
</div>

 <!--------------------------------- Start Bug Data------------------------------------->
 <div id="Bugs" class="tabcontent bugtabcontaner bugcontaner-bx">
            <form method="POST" action="{{ route('pm_bugs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" class="form-control" name="app_id" value="{{ $app_id }}">
                    <input type="hidden" class="form-control" name="bugby" value="pm">
                </div>
                <div class="row clearfix" id="bugsint">
                    <div class="col-md-4">
                        <div class="form-group bug-container buddon">
                            <label for="">Bug Type</label>
                            <select name="bug_type[]" id="bugtype" class="form-control">
                                <option value="Functional (Something not working)">Functional (Something not working)
                                </option>
                                <option value="Functional (Something missing)">Functional (Something missing)</option>
                                <option value="User Interface (e.g. text, colours, element positioning etc.)">User
                                    Interface (e.g. text, colours, element positioning etc.)</option>
                                <option value="Other">Other</option>
                            </select>
                            <label for="">Bug Description</label>
                            <textarea name="bug_description[]" class="form-control" placeholder="Explain Bug"
                                required></textarea>
                            <label for="">Bug Screenshot</label>
                            <input type="hidden" id="bug_count_id" value="1">
                            <input type="file" name="bug_screenshot[0][]" multiple class="form-control valid">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Bug For</label>
                                <select class="form-control" id="bug_device" name="bug_device[]">
                                    <option>Android</option>
                                    <option>iOS</option>
                                    <option>Android & iOS</option>
                                    <option>Admin Panel</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Bug Priority</label>
                              <select class="form-control" id="bug_priority" name="bug_priority[]">
                                 <option>Low</option>
                                 <option>Medium</option>
                                 <option>High</option>
                              </select>
                           </div>
                            <label for="">for client</label>
                            <input type="checkbox" class="bugforclient" value="0">
                            <input class="bugforclientHidden" type="hidden" value="0" name="bugforclient[]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Finished</button>
                        <a id="btnAddint" type="button" class="btn btn-info" data-toggle="tooltip"
                            data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add
                            New</a>
                    </div>
                </div>
            </form>

            @if (count($bugdetails) == 0)
                <h1 class="empty-title">No bugs reported by the client</h1>
            @else
                <h3 class="titleapp">Bugs Details</h3>
                <input type="hidden" class="myapp_id" name="app_id" value="{{ $app_id }}">
                <input type="hidden" class="myapp_user_id" name="user_id" value="{{ $user->id }}">
                <button id="show_mul_option">Select multiple to send</button>
                <select style="display:none" id="sendtom_select">
                    <option value="0">Select</option>
                    <option value="3">Complete</option>
                </select>
                <button style="display:none" id="sendtomultiple">Send</button>
                <div class="row dv_bug_row">
                    @foreach ($bugdetails as $bugdetail)
                        <div class="col-md-6">
                            <div class="card card-bug">
                                @if ($bugdetail->status == 2)
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
                                                <div id="carouselExampleControls{{$bugdetail->id}}" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach ($bugdetail->img_arry as $data)
                                                            @if ($loop->first)
                                                                <div class="carousel-item active">
                                                                @else
                                                                    <div class="carousel-item">
                                                            @endif
                                                            <a href="{{ asset($data) }}" download>
                                                                <img class="d-block bug-screenshot"
                                                                    src="{{ asset($data) }}" alt="First slide">
                                                            </div>
                                                        @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls{{$bugdetail->id}}" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls{{$bugdetail->id}}" role="button"
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
                            @if (!is_null($bugdetail->bug_device))
                                <div class="d-flex">
                                    <h6 class=""><strong>Bug for</strong></h6>
                                    <p class="bug-type-p superadbug">{{ $bugdetail->bug_device }}</p>
                                </div>
                            @endif

                            @if(!is_null($bugdetail->bug_priority))
                            <div class="d-flex">
                            <h6><b>Bug Priority :</b></h6>
                            <p class="bug-type-p">{{$bugdetail->bug_priority}}</p>
                            </div>
                            @endif

                            <div class="d-flex">
                                <h6 class=""><strong>Bug Type:</strong></h6>
                                <p class="bug-type-p superadbug">{{ $bugdetail->bug_type }}</p>
                            </div>
                            <h6><strong>Bug Description:</strong></h6>
                            <p>{{ $bugdetail->bug_description }}</p>
                            @if ($bugdetail->status == 0)
                                <p><span class="bug_change_status">Status:Pending</span></p>
                            @elseif($bugdetail->status == 1)
                                <p><span class="bug_change_status">Status:In progress</span></p>
                            @elseif($bugdetail->status == 2)
                                <p><span class="bug_change_status">Status:Done</span></p>
                            @else
                                <p><span class="bug_change_status">Status:Complete</span></p>
                            @endif
                            <select class="getstatus_confirm" data-bug="{{ $bugdetail->id }}">
                                <option>Select Status</option>
                                <option @if ($bugdetail->status == 2) selected @endif
                                    value="2">Done</option>
                                <option @if ($bugdetail->status == 3) selected @endif
                                    value="3">Complete</option>
                            </select>

                        </div>
                    </div>
                </div>
@endforeach
</div>
@endif
</div>

<!--------------------------------- End Bug Data------------------------------------->

<!--------------------------------- Start Add Build  ------------------------------------->
<div id="Builds" class="tabcontent add-buld-tabcontnr">
    <div class="">
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
        <form method="POST" action="{{ route('uploadbuild.store') }}" enctype="multipart/form-data">
            @csrf
            <h3 class="titleapp"> Add Builds</h3>
            <div class="card card-bug card-bug-row-tn">
                <div class="">
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
                            @if (!is_null($test_build))
                                <label for="androidbuild">Verify Android Build</label>
                                <input @if ($test_build->status_a == 1) checked @else unchecked @endif type="checkbox" class="Confirmedandroid"
                                    data-appid="{{ $app_id }}" data-userid="{{ $user->id }}" data-testbuild="{{ $test_build->id }}">
                                <label for="androidbuild">Verify Ios Build</label>
                                <input @if ($test_build->status_i == 1) checked @else unchecked @endif type="checkbox" class="Confirmeios"
                                    data-appid="{{ $app_id }}" data-userid="{{ $user->id }}" data-testbuild="{{ $test_build->id }}">
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
<!--------------------------------- End Build & Agreement------------------------------------->

<!--------------------------------- Start Design Detail Data------------------------------------->

<div id="Design" class="tabcontent">
    @if ($designdetail == null)
        <h1 class="empty-title">Client has not added design details</h1>
    @else
        <h3 class="titleapp">Design Details</h3>
        <div class="card card-bug card-bug-row-t">
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
                                <a href="{{ asset($designdetail->dp1) }}" download>Download Document</a>
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
                                <a href="{{ asset($designdetail->dp2) }}" download>Download Document</a>
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
                                <a href="{{ asset($designdetail->dp3) }}" download>Download Document</a>
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
                                <a href="{{ asset($designdetail->dp4) }}" download>Download Document</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <form method="POST" action="{{ route('add_xd_link') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" class="form-control" name="user_id"
                    value="{{ $user->id }}">
                <input type="hidden" class="form-control" name="app_id"
                    value="{{ $app_id }}">
            </div>
            <div class="row clearfix" id="bugsn1">
                <div class="col-md-6">
                    <div class="form-group bug-container">
                        <label for="Add Note"> Add XD Links </label>
                        <input type="text" class="form-control" name="add_note[]" placeholder="Add XD Links">
                    </div>
                </div>
            
            </div>
            <a id="btnAddn1" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls">
                <i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
<!--------------------------------- End Design Detail Data------------------------------------->

<!--------------------------------- Start Store Information ------------------------------------->
<div id="Store_information" class="tabcontent">
    @if ($store_information == null)
        <h1 class="empty-title">Client has not store information</h1>
    @else
        <div class="row">
            <div class="col-md-12">
                <h3 class="titleapp">Store Information</h3>
                <div class="card card-bug">
                    <div class="row">
                        <div class="col-md-6 store_info_details ">
                            <label class="plcy-label">Promotional Text</label>
                            <h5>{{ $store_information->promotional_text }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">App Subtitle</label>
                            <h5>{{ $store_information->app_subtitle }}</h5>
                        </div><br><br>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Keywords</label>
                            <h5>{{ $store_information->keywords }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Support URL</label>
                            <h5>{{ $store_information->support_url }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Marketing URL</label>
                            <h5>{{ $store_information->marketing_url }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">App Description</label>
                            <h5>{{ $store_information->app_description }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Age Rating</label>
                            <h5>{{ $store_information->age_rating }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">App Country</label>
                            <h5>{{ $store_information->app_country }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Privacy Policy URl</label>
                            <h5>{{ $store_information->privacy_policy_url }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Primary Language</label>
                            <h5>{{ $store_information->primary_language }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Primary App Category</label>
                            <h5>{{ $store_information->primary_app_category }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Secondary App Category</label>
                            <h5>{{ $store_information->secondary_app_category }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">App Price</label>
                            <h5>{{ $store_information->app_price }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Screenshot</label>
                            <img src="{{ asset($store_information->screenshots) }}"
                                style="width:80px;height:80px;">
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">First Name</label>
                            <h5>{{ $store_information->first_name }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Last Name</label>
                            <h5>{{ $store_information->last_name }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Email</label>
                            <h5>{{ $store_information->email }}</h5>
                        </div>
                        <div class="col-md-6 store_info_details">
                            <label class="plcy-label">Contact Number</label>
                            <h5>{{ $store_information->number }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<!--------------------------------- End Store Information ------------------------------------->

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

<!--------------------------------- Start Build UDID------------------------------------->

<div id="Build_udid" class="tabcontent">
    @if(count($all_udids) > 0)
            <form method="POST" action="{{route('app.buildudid.store')}}" enctype="multipart/form-data" name="registration">
            @csrf
            <div class="row clearfix bug-user-col" id="bugsud">
                <?php $i = 0; ?>
                @foreach($all_udids as $udid) 
                <div class="col-md-4 ">
                    <div class="form-group bug-container">
                        @if($i != 0)
                        <i class="fa fa-trash-o deletei" aria-hidden="true"></i>
                        @endif
                        <div class="form-group">
                        @if($user->parent_id == 0)  
                        <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
                        @else
                        <input type="hidden" class="form-control" name="user_id" value="{{$user->parent_id}}">     
                        @endif                     
                        <input type="hidden" class="form-control" name="main_id[]" value="{{$udid->id}}" >
                        </div>
                        <div class="form-group">
                            <label for="yourappname">Please paste your UDID number below </label>
                            <input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID" value="{{$udid->udid}}" required>
                        </div>
                        <div class="form-group">
                            @if($udid->add_screenshot)
                                <img src="{{asset($udid->add_screenshot)}}" style="width:80px;height:80px;">
                            @endif
                            <label for="">Add Screenshot</label>
                            <input type="file" name="add_screenshot[]" class="form-control valid">
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach
            </div>
            <a id="btnAddud" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        @else
        <form method ="POST" action="{{route('app.buildudid.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix" id="bugsud">
                <div class="col-md-4">
                    <div class="form-group bug-container">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}" >
                    <input type="hidden" class="form-control" name="main_id[]" value="0" >
                </div>
                <div class="form-group">
                    <label for="yourappname">Please paste your UDID number below </label>
                    <input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID" required>
                </div>
                <div class="form-group">
                <label for="">Add Screenshot</label>
                    <input type="file" name="add_screenshot[]" class="form-control valid">
                </div>
                </div>
                </div>
            </div>
            <a id="btnAddud" type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add New</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </form> 
    @endif
</div>

<!--------------------------------- End Build UDID------------------------------------->

<div id="Agreement" class="tabcontent agreement-tabcontent">
    <form method="POST" action="{{ route('agreement_upload') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="titleapp">Agreement</h3>
        <div class="card card-bug card-bug-agr">
            <div class="row">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" class="form-control" name="app_id" value="{{ $app_id }}">
                </div>
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="agreement">Add Agreement</label>
                        <input type="file" name="agreement" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
    @if ($agreements !== null)
        <div class="col-md-3">
            <a class="btn btn-primary" href="{{ asset($agreements->agreement) }}" download>Download Previous
                Agreement</a>
        </div>
    @endif
</div>

<!--------------------------------- Start Quote------------------------------------------>
<div id="Quote" class="tabcontent quitetabcontainern">
    <div class="about-app-box supbug-containersupbug-container">
        <div class="row">
            @if ($quote == null)
                <div class="col-md-12">
                    <form method="POST" action="{{ route('quotes.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="quote">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id" value="{{ $app_id }}">
                        </div>
                        <div class="row clearfix" id="bugsq">
                            <div class="col-md-6">
                                <div class="form-group bug-container">
                                    <label for="Quote Title">Quote Title</label>
                                    <input type="text" name="quote_title" class="form-control" required>
                                    <label for="Add Quote"> Add Quote </label>
                                    <input type="file" name="quote_doc" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            @else
                <div class="col-md-12">
                    <form method="POST" action="{{ route('update_quote', $quote->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id" value="{{ $app_id }}">
                        </div>
                        <div class="row clearfix" id="bugsq">
                            <div class="col-md-6">
                                <div class="form-group bug-container ">
                                    <label for="Quote Title">Quote Title</label>
                                    <input type="text" name="quote_title" class="form-control"
                                        value="{{ $quote->quote_title }}" required>
                                    <label for="Add Quote"> Add Quote </label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="file" name="quote_doc" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            @if ($quote->quote_doc)
                                                <a class="btn btn-primary" href="{{ asset($quote->quote_doc) }}"
                                                    download>Download Previous Quote</a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
<!-----------------------------------------End Quote----------------------------------------->

<!--------------------------------- Start Add Payment------------------------------------->
<div id="Payment" class="tabcontent admin-payment-tab">
    <div class="col-md-12">
        @php
            $get_assign_pm = App\Assignpm::where('customer_id', $user->id)->first();
        @endphp
        @if (!empty($get_assign_pm))
            <div class="d-flex">
                <div class="left-pay">
                    <div class="form-group">
                        <label>Confirmed Client</label>
                        <input @if ($get_assign_pm->is_confirmed == 1) checked @endif data-customer-id="{{ $user->id }}" type="checkbox"
                            class="ConfirmedmyCheck">
                    </div>
                </div>
            </div>
        @endif
    </div>
    <form method="POST" action="{{ route('quotes.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_type" value="quote_tier">
        <input type="hidden" value="{{ session('app_id') }}" name="app_id">
        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
        <div class="row clearfix" id="bugsq">
            <div class="col-md-12">
                <div class="form-group bug-container">
                    <div class="currency_data">
                        <label for="Add Price"> Select Currency </label>
                        <select name="currency_type" id="currency">
                            <option value="$">$</option>
                            <option value="£">£</option>
                        </select>
                    </div>
                    <div class="col-md-12 input_fields_container input_fields_price-main">
                        <div class="row">
                            <div class="col-md-4 Q-price" style="padding-left: 0px;">
                                <label for="First Payment"> Invoice Link </label>
                                <input type="url" name="invoice_url[]" class="form-control" required>
                            </div>
                            <div class="col-md-3 Q-price" style="padding-left: 0px;">
                                <label for="Add Price"> Add price </label>
                                <input type="number" name="quote_price[]" class="form-control" required>
                            </div>
                            <div class="col-md-3 D-price">
                                <label for="Due Date">Due Date</label>
                                <input type="date" name="date[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 add_tyer_btn" style="margin-top: 31px;"><a id="add_new_tyer"
                                    type="button" class="btn btn-info" style="float: right;"><i
                                        class="glyphicon glyphicon-plus-sign"></i>Add Tier</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-04">Save</button>
                </div>
            </div>
        </div>
    </form>
    @if (!$quotetier)
        <h1 class="empty-title">No Payments Found</h1>
    @else
        <div class="col-md-12">
            <div class="form-group bug-container mr-02">
                @foreach ($quotetier as $tier)
                    <div class="d-flex">
                        <div class="left-pay">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label for="First Payment">Invoice Link</label>
                                <input type="url" name="invoice_url[]" class="form-control"
                                    value="{{ $tier->invoice_url }}" required>
                            </div>
                        </div>
                        <div class="midle-pay">
                            <div class="form-group">
                                <label>Price</label>
                                <div class="time-d">{{ $tier->currency_type }} {{ $tier->tier_price }}</div>
                            </div>
                        </div>
                        <div class="right-pay">

                            <div class="form-group">
                                <label>Due Date</label>

                                @if ($tier->date == null)
                                    <div class="price-d"></div>
                                @else
                                    <div class="price-d"><?php echo date('M j Y', strtotime($tier->date)); ?></div>
                                @endif

                            </div>

                        </div>
                        <div class="right-pay">
                            <div class="form-group">
                                <label>paid</label>
                                <div>
                                    <p><input @if ($tier->status == 'paid') checked @endif data-tier-id="{{ $tier->id }}" type="checkbox"
                                            class="myCheck"></p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tiers_id[]" value="{{ $tier->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<!--------------------------------- End Payment ------------------------------------->

<!--------------------------------- Assign Developer ------------------------------------->
<div id="Developer" class="tabcontent admin-payment-tab">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="titleapp"> Select Developers</h3>
                            </div>
                        </div>
                        <form class="devasign" method="post" action="{{ route('select-developers') }}">
                            @csrf
                            <input type="hidden" value="{{ session('app_id') }}" name="app_id">
                            <select name="developer[]" class="mySelect for" multiple="multiple" style="width: 100%">
                                @foreach ($developers as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->first_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="titleapp"> Assigned Developers</h3>
                            </div>
                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Developer</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assigned_developers as $developer)
                                    <tr>
                                        <td>{{ $developer->first_name }}</td>
                                        <td><a class="viewbtn"
                                                href="{{ route('remove-developers', $developer->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--------------------------------- Assign Developer ------------------------------------->
       
<!--------------------------------- Upload_details ------------------------------------->

<div id="Upload_details" class="tabcontent agreement-tabcontent">
    <div class="card card-bug card-bug-row-t">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="upload_details" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id"
                                value="{{ $app_id }}">
                            <label for="Email">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter Email" name="email" value="@if (!is_null($upload_details)) {{ $upload_details->email }} @endif" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="Password">Password</label>
                            <input id="password" type="passowrd"
                                class="form-control @error('passowrd') is-invalid @enderror"
                                placeholder="Enter Password" value="@if (!is_null($upload_details)) {{ $upload_details->password }} @endif" name="password" autocomplete="passowrd" required>
                            @error('passowrd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary text-center">Save</button>
                        </div><br><br>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<!--------------------------------- Upload_details end ------------------------------------->

<!--------------------------------- Upload_Admin__details ------------------------------------->
<div id="Admin_Upload_detail" class="tabcontent agreement-tabcontent">
    <div class="card card-bug card-bug-row-t">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="Admin_Upload_details" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id"
                                value="{{ $app_id }}">
                            <label for="Email">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter Email" name="email" value="@if (!is_null($admin_upload_details)) {{ $admin_upload_details->email }} @endif" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="Password">Password</label>
                            <input id="password" type="passowrd"
                                class="form-control @error('passowrd') is-invalid @enderror"
                                placeholder="Enter Password" value="@if (!is_null($admin_upload_details)) {{ $admin_upload_details->password }} @endif"
                                name="password" autocomplete="passowrd" required>
                            @error('passowrd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="url">Url</label>
                            <input id="url" type="url" class="form-control @error('url') is-invalid @enderror"
                                placeholder="Enter url" value="@if (!is_null($admin_upload_details)) {{ $admin_upload_details->url }} @endif" name="url"
                                required>
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary text-center">Save</button>
                        </div><br><br>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<!--------------------------------- Upload_Admin__details end ------------------------------------->

<!--------------------------------- Maintenance ------------------------------------->

<div id="Maintenance" class="tabcontent agreement-tabcontent">
    <div class="card card-bug card-bug-row-t">
        <div class="row">
            <div class="col-md-4">
                <form id="maintanence_mail" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id"
                                value="{{ $app_id }}">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary text-center">Send Maintenance
                                Mail</button>
                        </div><br><br>                       
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form id="missed_maintanence_mail" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id"
                                value="{{ $app_id }}">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary text-center">Send Missed Maintenance Mail </button>
                        </div><br><br>                       
                    </div>
                </form>
                </div>
                <div class="col-md-4">
                <form id="missed_server_mail" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id"
                                value="{{ $user->id }}">
                            <input type="hidden" class="form-control" name="app_id"
                                value="{{ $app_id }}">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary text-center">Send Missed Server Mail</button>
                        </div><br><br>                       
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--------------------------------- Maintenance end ------------------------------------->

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
                            cols="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default btn-success btn-block"><span
                            class="glyphicon glyphicon-off"></span>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.super_admin.partials.footer')
<script>
    $("input:checkbox.Confirmedandroid").click(function() {
        var app_id = $(this).attr('data-appid');
        var testbuild_id = $(this).attr('data-testbuild');
        var user_id = $(this).attr('data-userid');

        if ($(this).is(":checked")) {
            var checked = 1;
        } else {
            var checked = 0;
        }
        $.ajax({
            url: "{{ route('verifyandroid') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "app_id": app_id,
                "user_id": user_id,
                "testbuild_id": testbuild_id,
                "checked": checked,
            },
            success: function(response) {
                if (response == 1) {
                    swal("Verified Successfully");
                } else {
                    swal("Status Change");
                }
            },
        });

    });
    $("input:checkbox.Confirmeios").click(function() {
        var app_id = $(this).attr('data-appid');
        var testbuild_id = $(this).attr('data-testbuild');
        var user_id = $(this).attr('data-userid');

        if ($(this).is(":checked")) {
            var checked = 1;
        } else {
            var checked = 0;
        }
        $.ajax({
            url: "{{ route('verifyios') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "app_id": app_id,
                "user_id": user_id,
                "testbuild_id": testbuild_id,
                "checked": checked,
            },
            success: function(response) {
                if (response == 1) {
                    swal("Verified Successfully");
                } else {
                    swal("Status Change");
                }
            },
        });

    });

    $("input:checkbox.ConfirmedmyCheck").click(function() {
        var customer_id = $(this).attr('data-customer-id');
        if ($(this).is(":checked")) {
            var checked = 1;
        } else {
            var checked = 0;
        }
        $.ajax({
            url: "{{ route('clientsstatus') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "customer_id": customer_id,
                "checked": checked,
            },
            success: function(response) {
                //alert(response);
                if (response == 1) {
                    swal("Customer Confirmed Successfully");
                } else {
                    swal("Customer Confirmed Status Change");
                }
            },
        });
    });

    $("input:checkbox.myCheck").click(function() {
        var tier_id = $(this).attr('data-tier-id');
        if ($(this).is(":checked")) {
            var paid_status = 'paid';
        } else {
            var paid_status = 'unpaid';
        }
        $.ajax({
            url: "{{ route('paymentstatus') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "tier_id": tier_id,
                "paid_status": paid_status,
            },
            success: function(response) {
                swal(response, "Payment status updated successfully", "success");
            },
        });
    });


    $('.getstatus_confirm').change(function() {

        var staus_id = $(this).val();
        var bug_id = $(this).attr('data-bug');

        $('body').find('#bugModal').modal('show');
        $('.bug_id').empty().val(bug_id);
        $('.staus_id').empty().val(staus_id);
        window.scrollTo(0, 0);

    });


    $("#bug_status").submit(function(a) {

        $('body').find('#bugModal').modal('hide');
        a.preventDefault();
        $.ajax({
            url: "{{ route('bugstatus') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                if (response == 2) {
                    var staus_value = "Done";
                    $(".bug_change_status").text('Status:Done');
                } else {
                    var staus_value = "Complete";
                    $(".bug_change_status").text('Status:Complete');
                }
                swal(staus_value, "Bug status updated successfully", "success");
                location.reload();
            }

        });
    });

    $("#maintanence_mail").submit(function(a) {
        a.preventDefault();
        $.ajax({
            url: "{{ route('maintanence_mail') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                var staus_value = "Complete";
                $(".bug_change_status").text('Status:Complete');
                swal(staus_value, "Mail send successfully", "success");
            }

        });
    });

    $("#missed_maintanence_mail").submit(function(a) {
        a.preventDefault();
        $.ajax({
            url: "{{ route('missed_maintanence_mail') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                var staus_value = "Complete";
                $(".bug_change_status").text('Status:Complete');
                swal(staus_value, "Mail send successfully", "success");
            }

        });
    });

    $("#missed_server_mail").submit(function(a) {
        a.preventDefault();
        $.ajax({
            url: "{{ route('missed_server_mail') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                var staus_value = "Complete";
                $(".bug_change_status").text('Status:Complete');
                swal(staus_value, "Mail send successfully", "success");
            }

        });
    });

    $("#upload_details").submit(function(a) {
        a.preventDefault();
        $.ajax({
            url: "{{ route('upload_details') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                if (response == 1) {
                    var staus_value = "Complete";
                    $(".bug_change_status").text('Status:Complete');
                    swal(staus_value, "Submitted", "success");
                }
            }

        });
    });


    $("#Admin_Upload_details").submit(function(a) {

        a.preventDefault();
        $.ajax({
            url: "{{ route('UploadAdminDetail') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                //alert(response);
                if (response == 1) {
                    var staus_value = "Complete";
                    $(".bug_change_status").text('Status:Complete');
                    swal(staus_value, "Submitted", "success");
                }
            }

        });
    });
</script>
<script>
    function deleteData(url) {
        $.ajax({
            type: 'get',
            url: url,
            success: function(results) {
                if (results.success === true) {
                    swal("Done!", results.message, "success");
                } else {
                    swal("Error!", results.message, "error");
                }
                setTimeout(function() {
                    location.reload();
                }, 1000)
            }
        })
    }

    $('.getstatustask_confirm').change(function() {
        //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
            url: "{{ route('timeline_tasksstatus') }}",
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
    // var data = <?php $developers; ?>; // Programatically-generated options array with > 5 options
    var placeholder = "select";
    $(".mySelect").select2({
        placeholder: placeholder,
        allowClear: false,
        minimumResultsForSearch: 5
    });

    $("body").on("click", ".bugforclient", function() {
        $(this).next().val($(this).is(':checked') ? '1' : '0');
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
                url: "{{ route('pmmultiple_status_bug') }}",
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

    $('#short_task_list').change(function() {
        var staus_id = $(this).val();
        if (staus_id == 0) {
            $(".task_type_0").show();
            $(".task_type_1").show();
            $(".task_type_2").show();
            $(".task_type_3").show();
            $(".task_type_4").show();
        } else {
            $(".task_type_0").hide();
            $(".task_type_1").hide();
            $(".task_type_2").hide();
            $(".task_type_3").hide();
            $(".task_type_4").hide();
            $(".task_type_" + staus_id).show();
        }
    });
</script>
