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
                                <div class="table-title-main-top"><h3 class="table-title-main">Blogs</h3></div>
                                <div class="table-wrapper">
                                    <table id="example" class="datatable table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($posts as $post)
                                            <tr>
                                                <td class="text-capitalize">{{$post->post_title}}</td>
                                                <td class="text-capitalize">{{$post->category_name}}</td>   
                                                <td>
                                                   <?php echo date("M j, Y g:i a", strtotime($post->post_date)); ?> 
                                                </td>
                                                <td><a href="{{route('theme_blog.edit',$post->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a onclick="delete_pm('{{route('theme_blog.destroy',$post->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>                           
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      
                                    </table>
                                    {{ $posts->links() }}
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