@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')

<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner ">
            <div class="container-fluid no-padding ">
               		<div class="row no-gutters">
                  		<div class="col-md-12">
                     		<nav>
                        		<ol class="breadcrumb page-title-top">
                           			<li class="breadcrumb-item"><a href="{{route('theme.cartypes.index')}}">Car type</a></li>
                           			<li class="breadcrumb-item active">Edit</li>
                           			<li class="breadcrumb-item text-right"><a href="{{route('theme.cartypes.index')}}">Back</a></li>
                        		</ol>
                     		</nav>
                  		</div>
               		</div>
            	</div>
            	<div class="container-fluid">
               		<div class="container-fluid">
               			<form action="{{ route ('theme.cartypes.update', $cartype->id) }}" method="post" enctype="multipart/form-data">
               			@csrf
               			{{ method_field('PUT') }}
			   			<div class="row">
						   <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control inputtemp" name="user_id" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                        		<input type="hidden" class="inputtemp form-control" name="template_id" value="{{$cartype->template_id}}">
                        	</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Name</label>
						  			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{old('name', $cartype->name)}}">
						  			@if ($errors->has('name'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('name') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Short Description</label>
						  			<textarea class="form-control" placeholder="Add Description" name="description">{{old('description', $cartype->description)}}</textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Image</label>
							  		</br>
							  		@if(!empty($cartype->image))
								        <img style="width:150px;height:150px" src="{{$cartype->image}}">
								    @endif
							  		</br>
							  		<input type="file" name="image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Selected Image</label>
							  		</br>
							  		@if(!empty($cartype->s_image))
								        <img style="width:150px;height:150px" src="{{ URL::to('/') }}/images/{{$cartype->s_image}}">
								    @endif
							  		</br>
							  		<input type="file" name="s_image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
								</div>
							</div>
							@php
							 $display = 'none';
								if($cartype->extra_charges == 1){
								    $display = 'block';
								}
							@endphp
							<div class="col-lg-12" id="show_hide_ex_charges" style="display:<?php echo $display; ?>">
								<div class="form-group f-g-o">
									<label for="usr">Extra Charges(Amount)</label>
									<input type="number" id="extra_price" class="simple_req form-control" placeholder="Enter Extra Charges Amount" data-error="This field is required." name="extra_price" step=".01" value="{{$cartype->extra_price}}">
									<div class="help-block with-errors"></div>
								</div>
							</div>
						
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Extra Charges</label>
						  			<div class="d-flex">
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" onclick="yesnoCheck();" id="extr_charges_yes" name="extra_charge" class="custom-control-input" value="1" {{$cartype->extra_charges == "1" ? "checked" : ""}}>
							  					<label class="custom-control-label" for="extr_charges_yes">Yes</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" onclick="yesnoCheck();" id="extr_charges_no" name="extra_charge" class="custom-control-input" value="0" {{$cartype->extra_charges == "0" ? "checked" : ""}}>>
							  					<label class="custom-control-label" for="extr_charges_no">No</label>
											</div>
						  				</div>
						  			</div>
								</div>
							</div>

							<div class="col-lg-6 col-xl-4 col-md-6">
								<div class="form-group f-g-o">
						  			<label for="usr">Status </label>
						  			<div class="d-flex">
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" {{$cartype->status == "active" ? "checked" : ""}} value="active">
							  					<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$cartype->status == "inactive" ? "checked" : ""}}>
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
</div>



@include('admin.template.Booking.partials.footer')

