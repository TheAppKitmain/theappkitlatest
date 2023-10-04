@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="main-wrapper">
	<div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
		
						<li class="breadcrumb-item active">Banner</li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
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
			<div class="col-lg-4 col-xl-4 col-md-4">
				<div class="add_banner_form">
					<h4 class="">Add Banner</h4>
					<form role="form" data-toggle="validator" action="{{route('theme.banner')}}" method="post" enctype="multipart/form-data">
					@csrf
						<div class="row">
							<div class="col-lg-12">
                                <div class="form-group">
								@if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif                                  
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="inputtemp form-control" name="template_id" value="{{$themetemplate->id}}">
                                </div>
								<div class="form-group f-g-o">
									<label class="labeltemp" for="usr">Name</label>
									<input type="text" class="inputtemp form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter Name" name="name" value="{{ old('name') }}">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
									<label class="labeltemp" for="usr">Image</label>
									<input type="file" class="inputtemp form-control" name="banner" required data-error="This field is required." accept="image/*">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-4 col-md-6">
								<div class="form-group f-g-o shopac-dcf-g">
									<label class="labeltemp" for="usr">Status </label>
									<div class="d-flex">
										<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
												<input type="radio" id="customRadio1" name="status" class="custom-control-input" checked="" value="active">
												<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
										</div>
										<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
												<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive">
												<label class="custom-control-label" for="customRadio2">Inactive</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="form-group text-right "><button type="submit" class="btn-style btn-color btn-save">Save</button></div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-8 col-xl-8 col-md-8">
				<div class="cat-box shadow-d data-table-wrapper">
					<table class="banner_table table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
            					<th>Image</th>
				                <th>Name</th>
				                <th>Sort</th>
								<th>Status</th>
				                <th>Delete</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($banners as $banner)
            				<tr>
            					<td>{{$banner->id}}</td>
				                <td>
				                	@if(!is_null($banner))
				                		<img src="{{$banner->banner}}" style="width:100px;height:100px">
				                	@endif
				                </td>
				                <td class="text-capitalize">{{$banner->name ?? "-"}}</td>
				                <td class="text-capitalize">

				                	<form action="{{route('theme.banner_position',$banner->id)}}" method="post" enctype="multipart/form-data">	
										@csrf
										<input class="tableinput" type="number" name="position" value="{{$banner->position}}">
										<input type="submit" value="Save" class="btn btn-sm btn-primary">
									</form>
									
				                </td>
								<td class="text-capitalize">{{$banner->status}}</td>
				                <td>									
				                	<a onclick="deleteData('{{route('theme.banner_delete',$banner->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				                </td>
            				</tr>
            				@endforeach
            			</tbody>
    				</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<div id="myfoodbannerModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="post" action="" id="deletefoodbannerForm">
				@csrf
				{{ method_field('post') }}
				<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

@include('admin.template.Food_Delivery.partials.footer')
<script>
function deleteData(url)
{
    $("#deletefoodbannerForm").attr('action', url);
    $('#myfoodbannerModal').modal();
}   
</script>
