@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')

<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="main-wrapper">
	<div class="main-container">
		<div class="main-container-inner">
			<div class="container-fluid">
		        <div class="row no-gutters">
		            <div class="col-md-12">
						<nav class="faqall">
							<ol class="breadcrumb breadcrumb-own-admin">
	                            <li class="breadcrumb-item active">Faq's</li>    
                        	</ol>
						</nav>
		            </div>
		        </div>
		    </div>
		    <div class="">
				<div class="container-fluid">
					<div class="row"> 
						<div class="col-lg-12 col-xl-12 col-md-12">
							@if(Session::get('alert'))
							<div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
							  <p>{{Session::get('message')}} </p>
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							@endif
							<!-- <h2 class="table-title-custom">List of all faqs</h2> -->
						</div>

						<div class="col-lg-12 col-xl-12 col-md-12">
							<div class="cat-box shadow-d data-table-wrapper">
								<div class="table-title-main-top"><h3 class="table-title-main">Faq's</h3></div>
                                <div class="table-wrapper">
									<table id="example" class="datatable table table-striped table-bordered" style="width:100%">
				        				<thead>
				            				<tr>
				            					<th>ID</th>
								                <th>Question</th>
								                <th>Answer</th>
												<th>Sorting</th>
								               	<th>Action</th>
				            				</tr>
				        				</thead>
				        				<tbody>
				        					@foreach($faqs as $faq)
				            				<tr>
				            					<td>{{$faq->id}}</td>
								                <td class="text-capitalize">{{ substr($faq->question, 0, 20) }}</td>																			
								                <td class="text-capitalize">{{ substr($faq->answer, 0, 100) }}</td>
												<td class="text-capitalize faqtdsorting">
													<form action="{{route('faq-position',$faq->id)}}" method="post" enctype="multipart/form-data">	
														@csrf
														
														<input class="tableinput" type="number" name="position" value="{{$faq->position}}">
														<input type="submit" value="Save" class="btn btn-sm btn-primary">
													</form>
				                				</td>
								                <td>
													<a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<a onclick="deleteData('{{route('faq.destroy', $faq->id ) }}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
	</div>
</div>
    </div>
</div>
</div>
</div>
</div>

<!-- Faq Delete Modal here -->

<div id="myfaqModal" class="modal fade">
<div class="modal-dialog modal-confirm">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Are you sure?</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<form method="post" action="" id="deleteForm">
			@csrf
			{{ method_field('DELETE') }}
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
</div>

	<!-- Faq Delete Modal End here -->

@include('admin.super_admin.partials.footer')

<script>

function deleteData(url)

{
    $("#deleteForm").attr('action', url);
    $('#myfaqModal').modal();
} 

</script>