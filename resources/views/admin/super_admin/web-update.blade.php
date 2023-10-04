@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper task">
    <div class="mainwrapper-inner-container">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">

                    <form method="POST" action="{{ route('web-update.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="status[]" value="1">
                        </div>
                        <div class="row clearfix" id="bugsweb">
                            <div class="col-md-4">
                                <div class="form-group bug-container buddon">
                                    <label for="">Bug Type</label>
                                    <select name="bug_type[]" id="bugtype" class="form-control">
                                        <option value="Functional (Something not working)">Functional (Something not
                                            working)</option>
                                        <option value="Functional (Something missing)">Functional (Something missing)
                                        </option>
                                        <option value="User Interface (e.g. text, colours, element positioning etc.)">
                                            User Interface (e.g. text, colours, element positioning etc.)</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="">Bug Description</label>
                                    <textarea name="bug_description[]" class="form-control" placeholder="Explain Bug"
                                        required></textarea>
                                    <label for="">Bug Screenshot</label>
                                    <input type="file" name="bug_screenshot[]" class="form-control valid">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Finished</button>
                        <a id="btnAddweb" type="button" class="btn btn-info" data-toggle="tooltip"
                            data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>Add
                            New</a>
                    </form>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 p-20">

                <h6 class="title-h6"><b>Website Updates <br></b></h6>
            </div>
            @foreach ($webbugs as $webbug)
                <div class="col-md-6">

                    <div class="card p-20 card-bug-main">
                        <div class="form-group bug-container">
                            <a onclick="deleteData('{{ route('delete_webbug', $webbug->id) }}')" class="btndelete"><i
                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                            @if (!is_null($webbug->bug_screenshot))
                                <h6><b>Bug Screenshot :</b></h6>
                                <img class="bug-screenshot" src="{{ asset($webbug->bug_screenshot) }}">
                            @endif
                            <div class="d-flex">
                                <h6><b>Bug Posted on :</b></h6>
                                <p class="bug-type-p">
                                    <td>{{ date('d-m-Y', strtotime($webbug->created_at)) }}</td>
                                </p>
                            </div>
                            <div class="d-flex">
                                <h6><b>Bug Type :</b></h6>
                                <p class="bug-type-p">{{ $webbug->bug_type }}</p>
                            </div>
                            <div class="d-flex">
                                <h6><b>Bug Description :</b></h6>
                                <p class="bug-type-p">{{ $webbug->bug_description }}</p>
                            </div>
                            <div class="des-detail-img">
                                <div class="d-flex">
                                </div>
                                @if ($webbug->status == 0 || $webbug->status == 1)
                                    <div class="custom_checkbox">
                                        <label class="ch-checkbox">
                                            <input style="display:none" name="selector[]" class="ads_Checkbox"
                                                type="checkbox" value="{{ $webbug->id }}" />
                                            <span style="display:none" class="ads_Checkbox"><i
                                                    class="ch-icon icon-tick"></i></span>
                                        </label>
                                    </div>
                                @endif
                                @if ($webbug->status == 2)
                                    <span>Status:Completed</span>
                                @else
                                    <select class="getstatus_confirm" data-taskid="{{ $webbug->id }}"
                                        data-userid="{{ $webbug->user_id }}">
                                        <option>Select Status</option>
                                        <option @if ($webbug->status == 0) selected @endif value="0">
                                            Pending</option>
                                        <option @if ($webbug->status == 1) selected @endif value="1">
                                            In progress</option>
                                        <option @if ($webbug->status == 2) selected @endif value="2">
                                            Complete</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>





@include('admin.super_admin.partials.footer')

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
</script>
<script>
    $('.getstatus_confirm').change(function() {
        //alert("sss");
        var staus_id = $(this).val();
        var taskid = $(this).attr('data-taskid');
        var userid = $(this).attr('data-userid');
        $.ajax({
            url: "{{ route('web_bugstatus') }}",
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
                    swal("List Status Updated successfully", "", "success");
                    location.reload();
                }
            },
        });
    });
</script>
