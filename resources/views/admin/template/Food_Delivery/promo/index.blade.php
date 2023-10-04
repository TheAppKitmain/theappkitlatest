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
						<li class="breadcrumb-item active">Promo</li>
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

				<h2 class="table-title-custom">Promo</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Promo Code</th>
				                <th>Promo Type</th>
				                <th>Discount/Amount</th>
				                <th>Action</th>
            				</tr> 
        				</thead>
        				<tbody>
        					@foreach($promos as $promo)
            				<tr>
            					<td>{{$promo->id}}</td>
				                <td>{{$promo->promo_code}}</td>
				                <td class="text-capitalize">{{$promo->promo_type}}</td>
				                <td>{{$promo->discount}}/{{$promo->amount}}</td>
				                <td>
									<a href="{{route('theme.food_promo.edit',$promo->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>

									<a onclick="deleteData('{{route('theme.food_promo.destroy',$promo->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<div id="myfoodpromoModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="post" action="" id="deletefoodpromoForm">
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


@include('admin.template.Food_Delivery.partials.footer')

<script>
function deleteData(url)
{

    $("#deletefoodpromoForm").attr('action', url);
    $('#myfoodpromoModal').modal();
}   
</script>