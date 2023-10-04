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
                           			<li class="breadcrumb-item"><a href="{{route('theme.booking_faqs.index')}}">Faq</a></li>
                           			<li class="breadcrumb-item active">Create</li>
                           			<li class="breadcrumb-item text-right"><a href="{{route('theme.booking_faqs.index')}}">Back</a></li>
                        		</ol>
                     		</nav>
                  		</div>
               		</div>
            	</div>
            	<div class="container-fluid">
               	<div class="container-fluid">
               		<form role="form" data-toggle="validator" action="{{route('theme.booking_faqs.store')}}" method="post">
               			@csrf
      			   			<div class="row">
								 <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control inputtemp" name="user_id" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                        		<input type="hidden" class="inputtemp form-control" name="template_id" value="{{$themetemplate->id}}">
                        	</div>
      							<div class="col-lg-12">
      								<div class="form-group f-g-o">
      						  			<label for="usr">Question</label>
      						  		<textarea class="form-control" placeholder="Add Question" name="question" required="required">{{ old('question') }}</textarea>
      								</div>
      							</div>
      							<div class="col-lg-12">
      								<div class="form-group f-g-o">
      						  			<label for="usr">Answer</label>
      						  			<textarea class="form-control" placeholder="Add Answer" name="answer" required="required">{{ old('answer') }}</textarea>
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

