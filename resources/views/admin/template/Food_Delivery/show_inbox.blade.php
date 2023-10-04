@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item"><a href="{{route('theme.food_contacts.index')}}">Inbox</a></li>
						<li class="breadcrumb-item active">{{$contacts->name}}</li>
						<li class="breadcrumb-item text-right"><a href="{{route('theme.food_contacts.index')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row no-gutters cat-box shadow-d">
			<div class="col-md-12">
				<div class="product-details-box">
					<div class="w-100 float-left main-deatils	">
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$contacts->name}}</div>
						</div>
						{{-- <div class="w-100 float-left">
							<div class="float-left left-title">Email:</div><div class="float-right right-desi">{{$contacts->email}}</div>
						</div> --}}
						<!-- <div class="w-100 float-left">
							<div class="float-left left-title">Customer Service Email:</div><div class="float-right right-desi">{{$contacts->customer_service_email}}</div>
						</div> -->
						<div class="w-100 float-left">
							<div class="float-left left-title">Phone No:</div><div class="float-right right-desi">{{$contacts->phone_no}}</div>
						</div>
						{{-- <div class="w-100 float-left">
							<div class="float-left left-title">Order No:</div><div class="float-right right-desi">{{$contacts->order_id}}</div>
						</div> --}}
						<div class="w-100 float-left">
							<div class="float-left left-title">Message :</div><div class="float-right right-desi text-capitalize">{{$contacts->message}} </div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Date :</div><div class="float-right right-desi">{{$contacts->created_at}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@include('admin.template.Food_Delivery.partials.footer')

