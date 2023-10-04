@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-wrapper">
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-lg-12">
            
        </div>
    </div>
</div>

<div class="main-page-container">
<div class="container-fluid">
    <div class="container-fluid">
        <form method="post" action="{{route('working_days.create',['id'=>$day->working_id])}}" enctype= multipart/form-data>
        @csrf
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="form-group f-g-o">
                    <label for="usr">Name</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name" name="name" required value="{{$day->name}}" readonly>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="form-group f-g-o">
                    <label for="usr">Start Time</label>
                    <!-- <input type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" placeholder="Enter Start Time" name="start_time" required value="{{$day->start_time}}">
                    @if ($errors->has('start_time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_time') }}</strong>
                        </span>
                    @endif -->
                    <input type='text' id='start_time' class="form-control" placeholder="Enter start time" name="start_time" required value="{{$day->start_time}}"/>
                    @if ($errors->has('start_time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="form-group f-g-o">
                    <label for="usr">End Time</label>
                    <!-- <input type="time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" placeholder="Enter end time" name="end_time" required value="{{$day->end_time}}"> -->
                    <input type='text' class="form-control" placeholder="Enter end time" name="end_time" required value="{{$day->end_time}}" id='end_time'/>
                    @if ($errors->has('end_time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-xl-4 col-md-6">
                <div class="form-group f-g-o">
                    <label for="usr">Status </label>
                    <div class="d-flex">
                        <div class="w3-half">
                            <div class="custom-control custom-radio mt-3">
                                <input type="radio" id="customRadio1" name="status" class="custom-control-input" value= "active" {{$day->status == 'active' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>
                        </div>
                        <div class="w3-half">
                            <div class="custom-control custom-radio mt-3">
                                <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$day->status == 'inactive' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customRadio2">Inactive</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                    <div class="form-group"><button class="btn-style btn-color" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@include('admin.template.Food_Delivery.partials.footer')
