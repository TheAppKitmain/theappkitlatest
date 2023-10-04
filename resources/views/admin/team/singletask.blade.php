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
                        <div class="bugtablemain">
                            <div class="col-md-4">
                                <div class="card card-bug mt-20">
                                    <div class="des-detail-img">
                                        <h6><strong>Task Description:</strong></h6>
                                        <p>{!! $taskdata->task_description !!}</p>
                                        @if ($taskdata->status == 4)
                                            <span>Status:Complete</span>
                                        @else
                                            <select class="getstatustask_confirm" data-taskid="{{ $taskdata->id }}"
                                                data-userid="{{ $taskdata->user_id }}">
                                                <option @if ($taskdata->status == 1) selected @endif value="1">Pending</option>
                                                <option @if ($taskdata->status == 2) selected @endif value="2">In progress
                                                </option>
                                                <option @if ($taskdata->status == 3) selected @endif value="3">Done</option>
                                            </select>
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
@include('admin.team.partials.footer')
<script type="text/javascript">
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

</script>
