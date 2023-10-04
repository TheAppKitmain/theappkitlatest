@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
<div class="row clearfix aboutappcontainer">
    <div class="col-md-12">
        <div class="card">

        @if( Session::has('status'))
        <script>
          $(document).ready(function(){
          $("#myModal").modal();
          }); 
        </script>
        @endif


        <div class="card-header">
            <h2>
              @if(!is_null($about_app))
                @if(!is_null($about_app->app_name))
                  {{$about_app->app_name}}
                @else
                  About Your Website
                @endif
              @else
                About Your Website
              @endif
            </h2>
        </div>
  <div class="card-body">
    @if(!is_null($about_app))
    <form method ="POST" action="{{route('app.aboutwebapp.update',$about_app->id)}}" enctype="multipart/form-data" name="registration">
     @csrf
     {{ method_field('PUT') }}
    @else
    <form method ="POST" action="{{route('app.aboutwebapp.store')}}" enctype="multipart/form-data" name="registration">
      @csrf
    @endif 
    <input type="hidden" name="typeforplatfor" value="web">
  <div class="form-group">
    <label for="yourappname">Your Website Name</label>
    @if(!is_null($about_app))
      @if(!is_null($about_app->app_name))
        <input type="text" id="name" name="app_name" class="form-control" id="app_name" placeholder="Enter App Name" value="{{$about_app->app_name}}">
      @else
        <input type="text" id="name" name="app_name" class="form-control" id="app_name" placeholder="Enter App Name" value="">
      @endif
    @else
      <input type="text" id="name" name="app_name" class="form-control" id="app_name" placeholder="Enter App Name" value="">
    @endif
  </div>
  <div class="form-group">
  @if(Auth::user()->parent_id == 0)  
    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
    @else
    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
    @endif
      </div>

  <div class="form-group">
    <label for="app_logo">Upload logo</label><br>
    @if(!is_null($about_app))
      @if(!is_null($about_app->wireframes))
      <input type="file" name="app_logo" id="app_logo" value="{{$about_app->wireframes}}">
      @else
      <input type="file" name="app_logo" id="app_logo">
      @endif
    @else
    <input type="file" name="app_logo" id="app_logo">
    @endif
  </div>

  <div class="form-group">
    <label for="wireframes">Upload screen designs / Wireframes (Optional)</label><br>
    @if(!is_null($about_app))
      @if(!is_null($about_app->wireframes))
    <input type="file" name="wireframes" id="wireframes" value="{{$about_app->wireframes}}">
    @else
    <input type="file" name="wireframes" id="wireframes">
    @endif
    @else
    <input type="file" name="wireframes" id="wireframes">
    @endif
  </div>
  <div class="form-group">
    <label for="">Your Website Idea</label>
     @if(!is_null($about_app))
    @if(!is_null($about_app->app_idea))
    <textarea class="form-control" id="app_idea" name="app_idea" rows="3" placeholder="Give us a brief outline of your App idea">{{$about_app->app_idea}}</textarea>
    @else
    <textarea class="form-control" id="app_idea" name="app_idea" rows="3" placeholder="Give us a brief outline of your App idea"></textarea>
    @endif
    @else
    <textarea class="form-control" id="app_idea" name="app_idea" rows="3" placeholder="Give us a brief outline of your App idea"></textarea>
    @endif
  </div>
  <!---------------------------------------Questions------------------------------------>
  <div class="yn">
    <h6>Do you have an existing website?</h6>
    @if(!is_null($about_app))
      @if(!is_null($about_app->idea))
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="yes" name="idea" class="custom-control-input" value="yes" {{$about_app->idea == 'yes' ? "checked" : "" }}>
            <label class="custom-control-label" for="yes">Yes</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="no" name="idea" class="custom-control-input" value="no" {{$about_app->idea == 'no' ? "checked" : "" }}>
            <label class="custom-control-label" for="no">No</label>
        </div>
      @else
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="yes" name="idea" class="custom-control-input" value="yes" required>
            <label class="custom-control-label" for="yes">Yes</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="no" name="idea" class="custom-control-input" value="no" required>
            <label class="custom-control-label" for="no">No</label>
        </div>
      @endif
    @else
      <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="yes" name="idea" class="custom-control-input" value="yes" required>
          <label class="custom-control-label" for="yes">Yes</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="no" name="idea" class="custom-control-input" value="no" required>
          <label class="custom-control-label" for="no">No</label>
      </div>
    @endif
  </div>

  <div class="ques">
     <h6>Have you bought the domain name yet?</h6>
     @if(!is_null($about_app))
      @if(!is_null($about_app->domain))
      <div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="ios" name="domain" class="custom-control-input" value="yes" {{$about_app->domain == 'yes' ? "checked" : "" }}>
        <label class="custom-control-label" for="ios">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="android" name="domain" class="custom-control-input" value="no" {{$about_app->domain == 'no' ? "checked" : "" }}> 
        <label class="custom-control-label" for="android">No</label>
    </div>
    @else
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="ios" name="domain" class="custom-control-input" value="yes" required>
        <label class="custom-control-label" for="ios">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="android" name="domain" class="custom-control-input" value="no" required> 
        <label class="custom-control-label" for="android">No</label>
    </div>
    </div>
     @endif
    @else
     <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="ios" name="domain" class="custom-control-input" value="yes" required>
        <label class="custom-control-label" for="ios">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="android" name="domain" class="custom-control-input" value="no" required> 
        <label class="custom-control-label" for="android">No</label>
    </div>
      @endif
  </div>



  <div class="yn1">

    <h6>Do you require an App developed for your business?</h6>
    @if(!is_null($about_app))
      @if(!is_null($about_app->website))
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="yes1" name="website" class="custom-control-input" value="yes"  {{$about_app->website == 'yes' ? "checked" : "" }}>
        <label class="custom-control-label" for="yes1">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="no1" name="website" class="custom-control-input" value="no" {{$about_app->website == 'no' ? "checked" : "" }}>
        <label class="custom-control-label" for="no1">No</label>
    </div>
      @else
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="yes1" name="website" class="custom-control-input" value="yes" required>
        <label class="custom-control-label" for="yes1">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="no1" name="website" class="custom-control-input" value="no" required>
        <label class="custom-control-label" for="no1">No</label>
    </div>
    @endif
    @else
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="yes1" name="website" class="custom-control-input"  value="yes" required>
        <label class="custom-control-label" for="yes1">Yes</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="no1" name="website" class="custom-control-input"  value="no" required>
        <label class="custom-control-label" for="no1">No</label>
    </div>
    @endif
  </div>

  <div class="form-group">
  <button type="submit" id="register-app" class="btn btn-primary">Save</button>
  </div>


</form>
    </div>
        </div>
            </div>
</div>     
</div>    
</div>       
   




  

@include('admin.custom.partials.footer')

<!-- <script>
  $('#register-app').click(function() {
        $(this).attr('disabled','disabled');
        $("form[name='registration']").submit();
          return true;
});
</script> -->

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>