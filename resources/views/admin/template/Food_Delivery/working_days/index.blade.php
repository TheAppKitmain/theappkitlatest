@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
      <div class="main-wrapper ">
         <div class="main-container">
            <div class="main-container-inner dashboard-mainbox">
            <div class="maininnerallpagescontainer">
    <div class="container-fluid">
    
        <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
				@if(Session::get('alert'))
				<div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
				  <p>{{Session::get('message')}} </p>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				@endif
			</div>
            <div class="row">
            <div class="container-fluid no-padding">  
            <nav>
                <ol class="breadcrumb page-title-top text-center">
                    <li class="breadcrumb-item active text-center">Working Days</li>
                </ol>
            </nav>     
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12">
                <form action="{{ route('theme.working_days') }}" method="POST">
                @csrf
                @if(Auth::user()->parent_id == 0)  
                <input type="hidden" class="inputtemp form-control inputtemp" name="owner_id" value="{{ Auth::user()->id}}">
                @else
                <input type="hidden" class="inputtemp form-control inputtemp" name="owner_id" value="{{ Auth::user()->parent_id}}">     
                @endif
                    @foreach($days as $day)
                    <div class="daycontainer">
                        <input type="hidden" value="{{$day->day_id}}" name="id[]">
                        <h3 class="float-left">{{$day->day_name}}</h3>
                        <div class="startdatbox float-left">
                            <label><b>Start Time</b></label><br>
                            <input type="time" id="start_time_{{$day->day_id}}" class="start_time" name="start_time[]" value="{{$day->start_time}}">
                        </div>
                        <div class="startdatbox float-left">
                            <label><b>End Time</b></label><br>
                            <input type="time" id="end_time_{{$day->day_id}}" class="end_time" name="end_time[]" value="{{$day->end_time}}">
                        </div>
                        <div class="workingdaysstatus float-left">
                            <label><b>Status</b></label>
                            <div class="daystatusbox d-flex">
                                <div class="radiobox">
                                    <input type="radio" id="{{$day->day_name}}1" name="status[{{$day->day_id}}]" value="active" {{$day->status == "active" ? "checked" :""}}>
                                        <label for="{{$day->day_name}}1"><h2>Active</h2></label>
                                </div>
                                <div class="radiobox">
                                    <input type="radio" id="{{$day->day_name}}2" name="status[{{$day->day_id}}]" value="inactive" {{$day->status == "inactive" ? "checked" :""}}>
                                    <label for="{{$day->day_name}}2"><h2>Inctive</h2></label>
                                </div>
                            </div>
                        </div>                      
                    </div>
                    @endforeach
                    <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                        <div class="form-group"><button class="btn-style btn-color" type="submit">Save</button>
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
@include('admin.template.Food_Delivery.partials.footer')
