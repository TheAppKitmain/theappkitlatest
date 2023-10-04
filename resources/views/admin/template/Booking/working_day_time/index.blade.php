@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')

<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item active">Working Day's</li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row"> 
			<div class="col-lg-12 col-xl-12 col-md-12">
				@if(Session::get('alert'))
				<div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
				  <p>{{Session::get('message')}} </p>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				@endif
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
			<form action="{{ route('working_day_time') }}" method="POST">@csrf
			@foreach($all_days as $day)
			<div class="row daycontainer">
				<div class="col-lg-3">
					<div class="form-group f-g-o">
						<h3>{{$day->day_name}}</h3>
						<input type="hidden" value="{{$day->day_id}}" name="id[]">
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-group f-g-o">
						<label for="usr">Start Time</label>
						<input id="start_time_{{$day->day_id}}" class="start_time" name="start_time[]" value="{{$day->start_time}}">
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-group f-g-o">
						<label for="usr">End Time</label>
						<input id="end_time_{{$day->day_id}}" class="end_time" name="end_time[]" value="{{$day->end_time}}">
					</div>
				</div>

				<div class="col-lg-3">
				<div class="form-group f-g-o">
					<div class="d-flex">
						<div class="w3-half">
						<div class="custom-control custom-radio mt-3">
							<input type="radio" id="{{$day->day_name}}1" name="status[{{$day->day_id}}]" class="custom-control-input" value="active" {{$day->status == "active" ? "checked" :""}}>
							<label class="custom-control-label" for="{{$day->day_name}}1">Active</label>
						</div>
						</div>
						<div class="w3-half">
						<div class="custom-control custom-radio mt-3">
							<input type="radio" id="{{$day->day_name}}2" name="status[{{$day->day_id}}]" class="custom-control-input" value="inactive" {{$day->status == "inactive" ? "checked" :""}}>
							<label class="custom-control-label" for="{{$day->day_name}}2">Inactive</label>
						</div>
						</div>
					</div>
				</div>
				</div>		
			</div>
			@endforeach
			<div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
				<div class="form-group"><button type="submit" class="btn-style btn-color">Save</button></div>
			</div>
			</form>
			</div>
		</div>
	</div>
     	</div>            
							
</div>



@include('admin.template.Booking.partials.footer')

