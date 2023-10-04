@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
   <div class="container-fluid">
      <div class="row clearfix">
      <div class="col-md-12">
         <!-- <a href="{{ URL::to('dashboard') }}" class="btn btn-danger">Switch to Dashboard</a> -->
      <div class="">
      <div class="row home-row-main">
         <div class="col-md-6 left-home">
            <div class="lft-content">
                <h1 class="letsh">Welcome </h1>
                <p>The App Kit dashboard is your guide to launching a successful app into the app store. You will first need to complete the ‘ Your App Idea’ tab which will give our team some insights into your App idea ahead of our meeting. Once completed, please schedule a chat with one of our Project Managers who will be able to give you some feedback on your idea and explain how the App development process works.</p>
            </div>
         </div>
         <div class="col-md-6 right-home">
            <div class="card right-video">

            <iframe width="100%" height="400" src="https://www.youtube.com/embed/FBwyjzFXFLk" frameborder="0" allow="accelerometer; autoplay=1&showinfo=0&controls=0; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
         </div>
      </div>
      </div>
      </div>
      </div>
   </div>
</div>
</div>

@include('admin.team.partials.footer')