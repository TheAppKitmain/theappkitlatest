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
                           			<li class="breadcrumb-item"><a href="{{route('theme.deals.index')}}">Deal</a></li>
                           			<li class="breadcrumb-item active">Edit</li>
                           			<li class="breadcrumb-item text-right"><a href="{{route('theme.deals.index')}}">Back</a></li>
                        		</ol>
                     		</nav>
                  		</div>
               		</div>
            	</div>
            	<div class="container-fluid">
               		<div class="container-fluid">
               			<form action="{{ route ('theme.deals.update', $deal->id) }}" method="post" enctype="multipart/form-data">
               			@csrf
               			{{ method_field('PUT') }}
						   <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control inputtemp" name="user_id" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                        		<input type="hidden" class="inputtemp form-control" name="template_id" value="{{$deal->template_id}}">
                        	</div>
			   			<div class="row">
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Name</label>
						  			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{old('name', $deal->name)}}">
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
						  			<textarea class="form-control" placeholder="Add Description" name="description">{{ old('description',$deal->description ?? '') }}</textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div id="atlest_one"></div>
								<div class="form-group f-g-o">
						  			<label for="usr"><b>Select Services</b></label><br>
						  			@foreach($services as $service)
									<input type="checkbox" id="one" name="service_id[]" value="{{$service->id}}" <?php if(in_array($service->id, $sel_dealservice)) echo 'checked'; ?>>
  									<label for="one">{{$service->name}}</label><br>
									@endforeach
								</div>
								<!-- <div class="form-group f-g-o">
						  			<label for="usr">Select Services</label>
						  			<select class="form-control" name="service_id[]" multiple="multiple">
							  		@foreach($services as $service)
									<option value="{{$service->id}}" <?php //if(in_array($service->id, $sel_dealservice)) echo 'selected="selected"'; ?> >{{$service->name}}</option>
									@endforeach
									</select>
								</div> -->
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Deal Price</label>
						  			<input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter Deal Price" name="price" required value="{{old('price', $deal->price)}}" step=".01" data-error="This field is required.">
						  			@if ($errors->has('price'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('price') }}</strong>
		                                </span>
		                            @endif
		                            <div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group f-g-o">
									<label for="usr">Service Time(Hours)</label>
									<input type="number" class="simple_req form-control{{ $errors->has('hour') ? ' is-invalid' : '' }}" required placeholder="Enter No Of Service Hours" data-error="This field is required." name="hour" value="{{old('hour', $deal->hour)}}">
									@if ($errors->has('hour'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('hour') }}</strong>
										</span>
									@endif
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group f-g-o">
									<label for="usr">Service Time(Minutes)</label>
									<input type="number" class="simple_req form-control{{ $errors->has('minute') ? ' is-invalid' : '' }}" required placeholder="Enter No Of Service Minutes" data-error="This field is required." name="minute" value="{{old('minute', $deal->minute)}}">
									@if ($errors->has('minute'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('minute') }}</strong>
										</span>
									@endif
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Image</label>
							  		</br>

							  		@if(!empty($deal->image))
								        <img style="width:150px;height:150px" src="{{$deal->image}}">
								    @endif
							
							  		</br>
							  		<input type="file" name="image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Selected Image</label>
							  		</br>
							  		@if(!empty($deal->s_image))
								        <img style="width:150px;height:150px" src="{{ URL::to('/') }}/images/{{$deal->s_image}}">
								    @endif
							  		</br>
							  		<input type="file" name="s_image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
								</div>
							</div>
							<div class="col-lg-6 col-xl-4 col-md-6">
								<div class="form-group f-g-o">
						  			<label for="usr">Status </label>
						  			<div class="d-flex">
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" {{$deal->status == "active" ? "checked" : ""}} value="active">
							  					<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$deal->status == "inactive" ? "checked" : ""}}>
							  					<label class="custom-control-label" for="customRadio2">Inactive</label>
											</div>
						  				</div>
						  			</div>
								</div>
							</div>
					
							<div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
								<div class="form-group"><button type="submit" id="submit_btn" class="btn-style btn-color">Save</button></div>
							</div>

			   			</div>
			   			</form>
			   		</div>
            	</div>
         	</div>              
</div>
</div>



@include('admin.template.Booking.partials.footer')

