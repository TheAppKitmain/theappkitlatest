@extends('appkit_frontend.layouts.main')
@section('content')

      <div class="row">
               <div class="col-md-12" class="error_handling">
                  @if(Session::get('alert'))
                        <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                           <p>{{Session::get('message')}} </p>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
                     @endif
               </div>
      </div>
      <!-- header end -->
      <!-- banner start -->
     <!-- start breadcrumb section -->
        <section class="faqtopbanner" style="background-image: url(&quot;images/faq-banner.png&quot;);">
        <div class="bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 display-table">
                    <h6>Frequently asked questions</h6>
                    <h1>FAQs</h1>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- end breadcrumb section -->
   
        <!-- start answer section -->
        <section class="faqsection">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 center-col">
                          <h2 class="faqh2">Common Questions</h2>
                        <!-- start accordion -->
                        <div class="accordion" id="accordionExample">


                        @foreach($faqs as $faq)               
                        <div class="card">
                            <div class="card-header" id="heading{{$faq->id}}">
                                <h2 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$faq->id}}">{{$faq->question}}<i class="fa fa-plus"></i></button>									
                                </h2>
                            </div>
                            <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="heading{{$faq->id}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>{{$faq->answer}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach



                    </div>
                        <!-- end accordion -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end answer section --> 
  


 
    

     
      <!-- footer start-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60055d69c31c9117cb6fb561/1esaf9pl3';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

      <!-- footer end -->
      @endsection
