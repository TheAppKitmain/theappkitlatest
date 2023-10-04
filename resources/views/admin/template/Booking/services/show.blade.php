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
						<li class="breadcrumb-item"><a href="{{route('theme.services.index')}}">Service</a></li>
						<li class="breadcrumb-item active">{{$service->name}}</li>
						<li class="breadcrumb-item text-right"><a href="{{route('theme.services.index')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="product-details-box">
					@if(!is_null($service->image)) 
					<div class="product-details-images">
						<img src="{{$service->image}}">
					</div>
					@endif
					<div class="w-100 float-left main-deatils">
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$service->name}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Date :</div><div class="float-right right-desi">{{$service->created_at->format('d M Y h:i A')}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Status :</div><div class="float-right right-desi text-capitalize">{{$service->status}} </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>



@include('admin.template.Booking.partials.footer')

