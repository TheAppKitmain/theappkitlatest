@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner ">
            <div class="main-wrapper ">
    <div class="main-container-inner ">
    	<div class="card-main ">
        	<div class="container-fluid no-padding ">
           		<div class="row no-margin">
              		<div class="col-md-12">
                 		<nav>
                    		<ol class="breadcrumb page-title-top">
                       			
                       			<li class="breadcrumb-item"><a href="{{route('theme.food_promo.index')}}">Promo</a></li>
                       			<li class="breadcrumb-item active">Create</li>
                       			<li class="breadcrumb-item text-right"><a href="{{route('theme.food_promo.index')}}">Back</a></li>
                    		</ol>
                 		</nav>
              		</div>
           		</div>
        	</div>
			
        	<div class="container-fluid createpromocontainer">
           		<div class="">
           			<form role="form" data-toggle="validator" action="{{route('theme.food_promo.store')}}" method="post" enctype="multipart/form-data">@csrf
		   			<div class="row">
						<div class="col-lg-12">
                        <div class="form-group">
								@if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="inputtemp form-control" name="template_id" value="{{$themetemplate->id}}">
                            </div>
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Promo Code</label>
					  			<input type="text" class="inputtemp form-control{{ $errors->has('promo_code') ? ' is-invalid' : '' }}" placeholder="Enter Promo Code" name="promo_code" required data-error="This field is required." value="{{ old('promo_code') }}">
					  			@if ($errors->has('promo_code'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('promo_code') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>

						<!-- <div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Promo Type</label>
					  			<div class="">
					  				<input type="radio" class="promo_type" name="promo_type" value="discount" checked="checked"> Discount
					  				<input type="radio" class="promo_type" name="promo_type" value="amount"> Amount
					  			</div>
							</div>
						</div> -->
						<div class="col-lg-12 col-xl-12 col-md-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Promo Type </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="promo_type_discount" name="promo_type" class="custom-control-input promo_type inputtemp" value="discount" checked="">
						  					<label class="custom-control-label" for="promo_type_discount">Discount</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="promo_type_amount" name="promo_type" class="custom-control-input inputtemp promo_type" value="amount">
						  					<label class="custom-control-label" for="promo_type_amount">Amount</label>
										</div>
					  				</div>
					  			</div>
							</div>
						</div>
                        <div class="col-lg-12 col-xl-12 col-md-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">How many times users can apply promo?</label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="promo_type_single" name="user_limit" class="custom-control-input promo_type inputtemp" value="single" checked="">
						  					<label class="custom-control-label" for="promo_type_single">Single</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="promo_type_multiple" name="user_limit" class="custom-control-input inputtemp promo_type" value="amount">
						  					<label class="custom-control-label" for="promo_type_multiple">Multiple</label>
										</div>
					  				</div>
					  			</div>
							</div>
						</div>
						<!-- <div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">How many times users can apply promo?</label>
					  			<div class="">
					  				<input  type="radio" name="user_limit" value="single" checked="checked"> Single
					  				<input  type="radio" name="user_limit" value="multiple"> Multiple
					  			</div>
							</div>
						</div> -->

						<div class="col-lg-12 discount_div">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Discount</label>
					  			<input type="number" class="inputtemp form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="Enter Discount" name="discount" required data-error="This field is required" value="{{ old('discount') }}">
					  			@if ($errors->has('discount'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('discount') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-12 amount_div" style="display: none">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Amount</label>
					  			<input type="text" class="inputtemp form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="Enter Amount" name="amount" value="{{ old('amount') }}" required pattern="^[0-9]\d*(\.\d+)?$" data-pattern-error="Please enter a valid price." data-error="This field is required">
					  			@if ($errors->has('amount'))
	                                <span class="inputtemp invalid-feedback" role="alert"><strong>{{ $errors->first('amount') }}</strong></span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-12 cart_amount_div" style="display: none">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Cart Amount</label>
					  			<input type="text" class="inputtemp form-control{{ $errors->has('cart_amount') ? ' is-invalid' : '' }}" placeholder="Enter Amount" name="cart_amount" value="{{ old('cart_amount') }}" required pattern="^[0-9]\d*(\.\d+)?$" data-pattern-error="Please enter a valid price." data-error="This field is required">
					  			@if ($errors->has('cart_amount'))
	                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('cart_amount') }}</strong></span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr"> Description</label>
					  			<textarea class="inputtemp form-control" placeholder="Add Description" required data-error="This field is required." name="description">{{ old('description') }}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-12 col-md-12">
							<div class="form-group f-g-o">
					  			<label class="labeltemp	" for="usr">Status </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="customRadio1" name="status" class="custom-control-input inputtemp" checked="" value="active">
						  					<label class="custom-control-label" for="customRadio1">Active</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio">
						  					<input type="radio" id="customRadio2" name="status" class="custom-control-input inputtemp" value="inactive">
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
   </div>
</div>
</div>

@include('admin.template.Food_Delivery.partials.footer')
<script type="text/javascript">
	var checked = $('.promo_type:checked').val();
	if(checked == "discount")
	{
		$('.discount_div').css('display','block');
		$('.amount_div').css('display','none');
		$('.amount_div').find('input').removeAttr("required");
		$('.amount_div').find('input').val(0);
		$('.cart_amount_div').css('display','none');
		$('.cart_amount_div').find('input').removeAttr("required");
		$('.cart_amount_div').find('input').val(0);
	}
	$('.promo_type').on('change',function()
	{
		var value = $(this).val();
		if(value == "amount")
		{
			$('.discount_div').css('display','none');
			$('.discount_div').find('input').removeAttr("required");
			$('.discount_div').find('input').val(0);

			$('.amount_div').css('display','block');			
			$('.cart_amount_div').css('display','block');
		}
		if(value == "discount")
		{
			$('.discount_div').css('display','block');
			$('.amount_div').css('display','none');
			$('.amount_div').find('input').removeAttr("required");
			$('.amount_div').find('input').val(0);
			$('.cart_amount_div').css('display','none');
			$('.cart_amount_div').find('input').removeAttr("required");
			$('.cart_amount_div').find('input').val(0);
		}
	})
</script>