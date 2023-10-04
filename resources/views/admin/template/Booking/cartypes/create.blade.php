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
                           			<li class="breadcrumb-item active">Create</li>
                           			<li class="breadcrumb-item text-right"><a href="{{route('theme.cartypes.index')}}">Back</a></li>
                        		</ol>
                     		</nav>
                  		</div>
               		</div>
            	</div>
            	<div class="container-fluid">
               		<div class="container-fluid">
               			<form role="form" data-toggle="validator" action="{{route('theme.cartypes.store')}}" method="post" enctype="multipart/form-data">@csrf
			   			<div class="row">

						   <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control inputtemp" name="user_id" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                        		<input type="hidden" class="inputtemp form-control" name="template_id" value="{{$themetemplate->id}}">
                        	</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Name</label>
						  			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{ old('name') }}" data-error="This field is required.">
						  			@if ($errors->has('name'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('name') }}</strong>
		                                </span>
		                            @endif
		                            <div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Short Description</label>
						  			<textarea class="form-control" placeholder="Add Description" name="description">{{ old('description') }}</textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Image</label>
							  		<br>
							  		<input type="file" name="image" id="imgInp file-7" class="inputfile inputfile-6 form-control" accept="image/*" required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Selected Image</label>
							  		<br>
							  		<input type="file" name="s_image" id="imgInp file-7" class="inputfile inputfile-6 form-control" accept="image/*" required>
								</div>
							</div>
							<div class="col-lg-12" id="show_hide_ex_charges" style="display: none;">
								<div class="form-group f-g-o">
									<label for="usr">Extra Charges(Amount)</label>
									<input type="number" id="extra_price" class="simple_req form-control" placeholder="Enter Extra Charges Amount" data-error="This field is required." name="extra_price" step=".01" value="">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Extra Charges</label>
						  			<div class="d-flex">
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3 mr-3">
							  					<input type="radio" onclick="yesnoCheck();" id="extr_charges_yes" name="extra_charge" class="custom-control-input" value="1">
							  					<label class="custom-control-label" for="extr_charges_yes">Yes</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" onclick="yesnoCheck();" id="extr_charges_no" name="extra_charge" class="custom-control-input" checked="" value="0">
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
											<div class="custom-control custom-radio mt-3 mr-3">
							  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" checked="" value="active">
							  					<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive">
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

