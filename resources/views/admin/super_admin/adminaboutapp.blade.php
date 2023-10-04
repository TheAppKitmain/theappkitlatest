@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
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
                  About Your App
                @endif
              @else
                About Your App
              @endif
            </h2>
        </div>
  <div class="card-body">
    @if(!is_null($about_app))
    <form method ="POST" action="{{route('app.adminaboutapp.update',$about_app->id)}}" enctype="multipart/form-data" name="registration">
     @csrf
     {{ method_field('PUT') }}
    @else
    <form method ="POST" action="{{route('app.adminaboutapp.store')}}" enctype="multipart/form-data" name="registration">
      @csrf
    @endif
  <input type="hidden" name="typeforplatfor" value="app">   
  <div class="form-group">
    <label for="yourappname">Your App Name</label>
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
    <input type="hidden" class="form-control" name="user_id" value="{{ Session::get('user_id')}}">
  </div>

  <div class="form-group">
    <label for="app_logo">Upload App logo</label><br>
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
    <label for="">Your App idea</label>
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
    <h6>Have you thought about this idea for a while?</h6>
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
     <h6>Are you looking for an iOS & Android App?</h6>
     @if(!is_null($about_app))
      @if(!is_null($about_app->lookfor))
      <div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="ios" name="looking" class="custom-control-input" value="ios" {{$about_app->lookfor == 'ios' ? "checked" : "" }}>
        <label class="custom-control-label" for="ios">iOS</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="android" name="looking" class="custom-control-input" value="android" {{$about_app->lookfor == 'android' ? "checked" : "" }}> 
        <label class="custom-control-label" for="android">Android</label>
    </div>

    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="both" name="looking" class="custom-control-input" value="both" {{$about_app->lookfor == 'both' ? "checked" : "" }}>
        <label class="custom-control-label" for="both">Both</label>
    </div>
    @else
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="ios" name="looking" class="custom-control-input" value="ios" required>
        <label class="custom-control-label" for="ios">iOS</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="android" name="looking" class="custom-control-input" value="android" required> 
        <label class="custom-control-label" for="android">Android</label>
    </div>

    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="both" name="looking" class="custom-control-input" value="both" required>
        <label class="custom-control-label" for="both">Both</label>
    </div>
     @endif
    @else
     <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="ios" name="looking" class="custom-control-input" value="ios" required>
        <label class="custom-control-label" for="ios">iOS</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="android" name="looking" class="custom-control-input" value="android" required> 
        <label class="custom-control-label" for="android">Android</label>
    </div>

    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="both" name="looking" class="custom-control-input" value="both" required>
        <label class="custom-control-label" for="both">Both</label>
    </div>
      @endif
  </div>
  <div class="yn1">

    <h6>Do you require a website to be developed with the App?</h6>
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
   




  

@include('admin.super_admin.partials.footer')

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