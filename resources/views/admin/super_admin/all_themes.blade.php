@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@include('admin.super_admin.confirm_delete')

<div class="mainwrapper sup-admin-mainwrapper">
  <div class="mainwrapper-inner-container">
  <div class="container-fluid">
  <div class="row clearfix aboutappcontainer">
      <div class="col-md-12">
      <div class="mt-20">
      <div class="card-header">
        <h3>All Themes</h3>
     </div>
     <div class="table-height-container">
      <table class="table">
          <thead>
            <tr>

              <!-- <th scope="col">#</th> -->
              <th scope="col">Theme Thumbnail</th>
              <th scope="col">Theme Name</th>
              <th scope="col">Category</th>
          
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>   
            
              <tr>
                    @foreach($themetemplates as $themetemplate)
                  <td><img src="{{$themetemplate->theme_thumbnail}}" style="width:40px;"></td>
                  <td>{{$themetemplate->theme_name}}</td>
                  <td>{{$themetemplate->theme_category->category_name ?? ""}}</td>
                  <td><a class="viewbtn" href="{{route('allthemes.edit',$themetemplate->id)}}">Edit</a></td>
                  <td><a class="viewbtn" onclick="delete_pm('{{route('allthemes.destroy',$themetemplate->id)}}')">Delete</a></td>
                
              </tr>    
              @endforeach
          </tbody>
        </table>
        </div>
  </div>
  </div>
  </div></div></div>
</div>

@include('admin.super_admin.partials.footer')
