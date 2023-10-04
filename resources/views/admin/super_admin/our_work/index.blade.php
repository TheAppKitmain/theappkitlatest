@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
    <div class="col-md-12">
    <div class="mt-20 addteame-main">
        <div class="card-body">    
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
                                <div class="table-title-main-top"><h3 class="table-title-main">Our Work</h3></div>
                                <div class="table-wrapper">
                                    <table id="example" class="datatable table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>App Name</th>
                                                <th>App Type</th>
                                                <th>App Logo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ourworks as $work)
                                            <tr>
                                                <td class="text-capitalize">{{$work->app_name}}</td>
                                                <td class="text-capitalize">{{$work->app_type}}</td>
                                                <td><img src="{{$work->app_logo}}" style="width:40px;"></td>
                                                <td><a href="{{route('our_work.edit',$work->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a onclick="delete_pm('{{route('our_work.destroy',$work->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>                           
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      
                                    </table>
                                    {{ $ourworks->links() }}
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
@include('admin.super_admin.partials.footer')