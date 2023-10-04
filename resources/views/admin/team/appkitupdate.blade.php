@include('admin.team.partials.head')
@include('admin.team.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
  <div class="row">
             <div class="col-sm-12 p-20">
                    <h6 class="title-h6"><b>Website Updates <br></b></h6>
                </div>
                 @foreach($webbugs as $webbug)
                    <div class="col-md-6">
                  <div class="card p-20 card-bug-main">
                    
                    @if(!is_null($webbug->bug_screenshot))
                    <h6><b>Bug Screenshot :</b></h6>
                    <img class="bug-screenshot" src="{{asset($webbug->bug_screenshot)}}">
                    @endif
                    <div class="d-flex">
                    <h6><b>Bug Posted on :</b></h6>
                    <p class="bug-type-p"><td>{{date('d-m-Y', strtotime($webbug->created_at))}}</td></p>
                    </div>
                    <div class="d-flex">
                    <h6><b>Bug Type :</b></h6>
                    <p class="bug-type-p">{{$webbug->bug_type}}</p>
                    </div>
                  

                    <h6><b>Bug Description :</b></h6><p>{{$webbug->bug_description}}</p>
               
                  </div>

                 </div>
               @endforeach
                </div>

</div>
</div>
</div>               
@include('admin.team.partials.footer')

