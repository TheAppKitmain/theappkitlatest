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
                     <li class="breadcrumb-item"><a href="{{route('faq.index')}}">Faq's</a></li>
                     <li class="breadcrumb-item active">Edit</li>    
                  </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="main-page-container">
            <div class="container-fluid">
               <div class="container-fluid">
                  <form role="form" data-toggle="validator" action="{{route('faq.update',$faq->id)}}" method="post">
                  @csrf
                  @method('PUT')
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Question</label>
                        <textarea class="form-control" placeholder="Add Question" name="question" required="required" data-error="This field is required.">{{ old('question',$faq->question) }}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group f-g-o">
                        <label for="usr">Answer</label>
                        <textarea class="form-control" placeholder="Add Answer" name="answer" required="required" data-error="This field is required.">{{ old('answer',$faq->answer) }}</textarea>
                        <div class="help-block with-errors"></div>
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


@include('admin.super_admin.partials.footer')