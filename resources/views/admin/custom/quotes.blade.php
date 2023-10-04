@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
          <div class="card">
          @if( count($quotes) == 0) 
          <div class="card-header ">
            <h2>Your quote will be available once all project details are finalised</h2>
          </div>
          <div class="card-body">
            <img class="img-responsive" src="{{asset('asset/images/agreement.png')}}" alt="">
          </div>
          @else
          @foreach($quotes as $quote)
          <div class="card-header">
            <h2>{{$quote->quote_title}}</h2>
          </div>
          <div class="card-body text-center">
          <div class="card p-20 top-header-qu">
                <h6><b>Please review your quote below</b></h6>
            </div>
            <img class="img-responsive" src="{{asset('asset/images/agreement.png')}}" alt=""><br><br>
            <a href="{{asset($quote->quote_doc)}}" download class="btn btn-primary">Download Quote</a>
          </div>
          @endforeach
          
          @endif

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>




<!-- <div class="mainwrapper">
   <div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="mt-20">
    <div class="card-header">
                    <h2>Quotes</h2>
                </div>
                
     <div class="row justify-content-center">
      @if( count($quotes) == 0)
          <h1 class="title_content">Your qoute will be available once all project details are finalised</h1>
      @else
      @foreach($quotes as $quote)
      <div class="col-md-4">
         <div class="card card-bug quote-card">
            <div class="des-detail-img">
            <div class="card">
                    <div class="card-header">
            <h2>Quote's</h2>
          </div>
          <div class="card-body text-center">
           
            <h6><strong>Quote Title:</strong></h6>
               <p>{{$quote->quote_title}}</p>
            <img class="img-responsive" src="http://127.0.0.1:8000/asset/images/agreement.png" alt=""><br><br>
            <div class="card p-20">
                <h6><b>Please click below to download quote :</b></h6>
            </div>
            <div class="bug-img-box-super-admin">
                  <a class="btn btn-primary qute" href="{{asset($quote->quote_doc)}}" download>
                  <i class="fa fa-download" aria-hidden="true"></i> Download Quote's </a>
            </div>
          </div>
            </div>
         </div>
      </div>
      @endforeach
   @endif
   </div>
</div>
</div>
</div>
</div>
</div>
</div> -->
@include('admin.custom.partials.footer')



