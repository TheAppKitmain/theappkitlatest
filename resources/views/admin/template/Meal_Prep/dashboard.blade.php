@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper ">
         <div class="main-container">
            <div class="main-container-inner dashboard-mainbox">
            <div class="main-container-inner dashboard-mainbox-inner">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-6">
                           <h1 class="adminname-top dash-h">Welcome {{ Auth::user()->business_name }}</h1>
                              <p class="tophomep dash-h">We’re delighted you’ve chosen us to help build your mobile app</p>
                              <div class="home-services-box">
                                 <h4>Get Started</h4>
                                 <p>To get started click <b>My Apps</b> on the left panel and select your chosen template. Once you've created your App, click on <b>Publish</b> and we'll do the rest. It's that simple!</p>
                                 <!-- <div class="btn-box"><a class="btn-color btn-style" href="#">Learn More</a></div> -->
                              </div>
                           </div>
                           <div class="col-md-6 text-center">
                    
                              <div class="tutorial-video-boxmdl text-center">
                                 <iframe width="100%" height="350" src="https://www.youtube.com/embed/NB1Hvp7dleE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                        </div>
                     </div>
                   
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</main>
<!-- main end -->
</body>
</html>
@include('admin.template.partials.footer')