@extends('appkit_frontend.layouts.main')
@section('content')
<div class="banner-ourwork">
         <div class="container">
            <div class="row">
				
			   <div class="col-md-12">
			   		<h1>Our Clients</h1>
			   </div>
			   <div class="price-tabs">
					<ul class="nav nav-tabs our_clients_tab" id="myTab" role="tablist">
						<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Apps</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Websites</a>
						</li>
					</ul>

					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="row">
								@foreach($our_works as $work)
										@if($work->app_type !== "Web") 
										<div class="col-md-3">
											<a href="{{route('work.show',$work->id)}}">
													<div class="ourworkbox">
														<div class="ourworkboximages">
															<img src="{{$work->app_logo}}">
														</div>
														<h4>{{$work->app_name}}</h4>
													</div>
											</a>		
										</div>
										@endif	
								@endforeach
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="row">
								@foreach($our_works as $work) 
										@if($work->app_type == "Web")
											<div class="col-md-3">
												<a href="{{route('work.show',$work->id)}}">
													<div class="ourworkbox">
														<div class="ourworkboximages">
															<img src="{{$work->app_logo}}">
														</div>
														<h4>{{$work->app_name}}</h4>
													</div>
												</a>		
											</div>
										@endif
								@endforeach
							</div>
						</div>
					</div>
			   </div>
			  
            </div>
         </div>
      </div>

@endsection
