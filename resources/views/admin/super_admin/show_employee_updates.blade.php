@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row">

<div class="col-md-12">
<div class="card-header">
        <h3>Employee Updates</h3>
     </div>
<div class="nt-show">
<div class="row">
@if (count($employee_updates) == 0)
<h4 class="text-center w-100 p-2">No Updates Found</h4>
@else

    @foreach($employee_updates as $employee_update)
    <div class="col-md-12">
    <div class="form-group bug-container employee_update">
    <div class="">
        <p>{!!$employee_update->updates!!}</p>
    </div>
    <p class="text-right"><b >Date</b> : {{$employee_update->update_time}}</p>
    </div>
    </div>
    @endforeach

    {{ $employee_updates->links() }}
@endif
</div>
</div>
</div>
    </div>
</div>
</div>
</div>
</div>

@include('admin.super_admin.partials.footer')
<script>
