@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></li>
						<li class="breadcrumb-item active">{{$product->product_name}}</li>
						<li class="breadcrumb-item text-right"><a href="{{route('products.index')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="product-details-box">
					<div class="product-details-images"><img src="{{$product->image}}"></div>
					<div class="w-100 float-left main-deatils	">
						<div class="w-100 float-left">
							<div class="float-left left-title">Category:</div><div class="float-right right-desi">{{$product->category->name ?? ''}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$product->product_name}}</div>
						</div>
						<div class="w-100 float-left">
							 <div class="float-left left-title">Shop:</div><div class="pfloat-right right-desi">CDS</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Price:</div><div class="float-right right-desi">${{$product->price}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">long description:</div><div class="float-right right-desi">{{$product->long_description}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">short description:</div><div class="float-right right-desi">{{$product->short_description}}	 </div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">date :</div><div class="float-right right-desi">{{$product->created_at->format('d M Y h:i A')}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">status :</div><div class="float-right right-desi">{{$product->status}} </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@include('admin.template.Food_Delivery.partials.footer')
