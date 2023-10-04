@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')

<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="main-container-inner">
        	<div class="container-fluid">
            <div class="row no-gutters">
               <div class="col-lg-12">
               <nav class="faqall">
                  <ol class="breadcrumb breadcrumb-own-admin">
                     <li class="breadcrumb-item breadcrumb-item-one"><a href="{{route('faq.index')}}">Faq's</a></li>
                     <li class="breadcrumb-item active">Create</li>    
                  </ol>
               </div>
              </nav>
            </div>
         </div>
         <div class="">
            <div class="container-fluid">
               <div class="">
                  <form role="form" data-toggle="validator" action="{{route('faq.store')}}" method="post">
               		@csrf
      			   	<div class="row faqrowcraete">
      						<div class="col-lg-12">
      							<div class="form-group f-g-o">
      						  		<label for="usr">Question</label>
      						  		<textarea class="form-control faqquestiontextarea" placeholder="Add Question" name="question" required data-error="This field is required.">{{ old('question') }}</textarea>
                              <div class="help-block with-errors"></div>
      							</div>
      						</div>
      						<div class="col-lg-12">
      							<div class="form-group f-g-o">
      						  		<label for="usr">Answer</label>
      						  		<textarea class="form-control" placeholder="Add Answer" name="answer" required="required" data-error="This field is required.">{{ old('answer') }}</textarea>
                              <div class="help-block with-errors"></div>
      							</div>
      						</div>
      						<div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
      							<div class="form-group"><button type="submit" class="btn-style btn-color btnsavefaq">Save</button></div>
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


@include('admin.super_admin.partials.footer')