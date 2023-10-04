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
						<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{route('contact_us')}}">Contact Us</a></li>
						<li class="breadcrumb-item text-right"><a href="{{route('contact_us')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="product-details-box">
					<div class="w-100 float-left main-deatils">
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$message->name}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Email:</div><div class="float-right right-desi">{{$message->email}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Comment :</div><div class="float-right right-desi">{{$message->message}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Date time :</div><div class="float-right right-desi">{{$message->created_at->format('d M Y h:i A')}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>             	
</div>
</div>



@include('admin.template.Booking.partials.footer')

