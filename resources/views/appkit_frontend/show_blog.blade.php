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
      <section class="faqtopbanner blogdetailtopbanner" >
        <div class="bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 display-table">
                    <h6>
                          <span class="blogmainname">{{date('d', strtotime($blog->created_at))}} {{date('M', strtotime($blog->created_at))}} {{date('Y', strtotime($blog->created_at))}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;by 

                                    
                              <a href="#" class="text-white-2">The Appkit</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                              <a href="#" class="text-white-2">{{$blog->blogcategory->name}}</a>
                          </span>
                    </h6>
                    <h1>{{$blog->post_title}}</h1>             
                    </div>
                </div>
            </div>
        </section>

        <section class="blogdetailmaincontainer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 display-table">
                    <div class="top-detailsblog-flex">
                    <div class="row">
                    <div class="col-md-5">
                    <div class="blogdetailimg text-center imgshadow">
                     <img class="img-responsive" src="{{$blog->blog_meta->thumbnail}}" alt="Featured">
                     </div>
                     </div>
                    <div class="col-md-7">
                    <div class="top-detailsblog">
                    <h2>{{$blog->post_title}}</h2>
                  
                   <p>{{$blog->post_content}}</p>
                   </div>
                   </div>
                     
                     </div>  
                     </div> 
                     
                     <div class="blogdetailimg text-center mt-100">
                     <iframe width="100%" height="550" src="{{$blog->blog_meta->video_url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
                     </div>   
                    </div>
                    
                </div>
            </div>
        </section>
  


    

     
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
