@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')

<div class="main-home">
<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item"><a href="{{route('theme.deals.index')}}">Deal</a></li>
						<li class="breadcrumb-item active">{{$deal->name}}</li>
						<li class="breadcrumb-item text-right"><a href="{{route('theme.deals.index')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="product-details-box">
					@if(!is_null($deal->image)) 
					<div class="product-details-images">
						<img src="{{$deal->image}}">
					</div>
					@endif
					<div class="w-100 float-left main-deatils">
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$deal->name}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Description:</div><div class="float-right right-desi">{{$deal->description}}
							</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Deal Services:</div>
							<div class="float-right right-desi">
								@foreach($services as $service)
									<?php echo '- '. $service .'<br>'; ?>
								@endforeach
							</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Date :</div><div class="float-right right-desi">
								{{$deal->created_at->format('d M Y h:i A')}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Price :</div><div class="float-right right-desi text-capitalize">
							{{$deal->price}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Service Time :</div><div class="float-right right-desi text-capitalize"> @if($deal->hour > 0) {{$deal->hour}} Hours @endif @if($deal->minute > 0) {{$deal->minute}} minute @endif</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Status :</div><div class="float-right right-desi text-capitalize">{{$deal->status}} </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@include('admin.template.Booking.partials.footer')

