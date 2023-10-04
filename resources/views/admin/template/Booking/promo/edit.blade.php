@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')

<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="card-main card">
        	<div class="container-fluid no-padding ">
           		<div class="row no-gutters">
              		<div class="col-md-12">
                 		<nav>
                    		<ol class="breadcrumb page-title-top">
                       			<li class="breadcrumb-item"><a href="{{route('theme.booking_promo.index')}}">Promo</a></li>
                       			<li class="breadcrumb-item active">Edit</li>
                       			<li class="breadcrumb-item text-right"><a href="{{route('theme.booking_promo.index')}}">Back</a></li>
                    		</ol>
                 		</nav>
              		</div>
           		</div>
        	</div>
        	<div class="container-fluid">
           		<div class="container-fluid">
           			<form role="form" data-toggle="validator" action="{{route('theme.booking_promo.update', $promo->id)}}" method="post" enctype="multipart/form-data">
           				@csrf
           				{{ method_field('PUT') }}
		   			<div class="row">
					   <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control inputtemp" name="user_id" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                        		<input type="hidden" class="inputtemp form-control" name="template_id" value="{{$promo->template_id}}">
                        	</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Promo Code</label>
					  			<input type="text" class="form-control{{ $errors->has('promo_code') ? ' is-invalid' : '' }}" placeholder="Enter Promo Code" name="promo_code" required data-error="This field is required." value="{{ old('promo_code',$promo->promo_code) }}">
					  			@if ($errors->has('promo_code'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('promo_code') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Discount</label>
					  			<input type="number" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="Enter Discount" data-error="This field is required." name="discount" value="{{ old('discount',$promo->discount) }}">
					  			@if ($errors->has('discount'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('discount') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr"> Description</label>
					  			<textarea class="form-control" placeholder="Add Description" required data-error="This field is required." name="description">{{ old('description',$promo->description) }}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-4 col-md-6">
							<div class="form-group f-g-o">
					  			<label for="usr">Status </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" value="active" {{$promo->status == "active" ? "checked" : ""}}>
						  					<label class="custom-control-label" for="customRadio1">Active</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$promo->status == "inactive" ? "checked" : ""}}>
						  					<label class="custom-control-label" for="customRadio2">Inactive</label>
										</div>
					  				</div>
					  			</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
							<div class="form-group"><button type="submit" class="btn-style btn-color">Save</button></div>
						</div>

		   			</div>
		   			</form>
		   		</div>
        	</div>
     	</div>            
</div>
</div>



@include('admin.template.Booking.partials.footer')

