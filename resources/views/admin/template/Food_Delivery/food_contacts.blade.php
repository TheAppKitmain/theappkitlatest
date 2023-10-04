@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="main-wrapper">
      <div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item active">Inbox</li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-xl-12 col-md-12">
				<h2 class="table-title-custom">Inbox</h2>
			</div>
			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Name</th>
				               <!--  <th>Email</th> -->
				                <th>Phone no</th>
								<!-- <th>Order No</th> -->
				                <th>View</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($contacts as $contact)
            				<tr>
            					<td>{{$contact->id}}</td>
				                <td class="text-capitalize">{{$contact->name}}</td>
				                <!-- <td>{{$contact->email}}</td> -->
				                <td>{{$contact->phone_no}}</td>
								<!-- <td>{{$contact->order_id}}</td> -->
				                <td class="text-capitalize"><a href="{{route('theme.food_contacts.show',$contact->id)}}">View</a></td>
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
@include('admin.template.Food_Delivery.partials.footer')

