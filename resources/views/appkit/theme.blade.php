@extends('appkit_frontend.layouts.main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="select-template-wrapper">
   <div class="container">
      <div class="row">
      </div>
      <div class="row">
         <div class="col-md-3">
            <h2 class="cat-h"> Categories</h2>
            <ul class="select-template-tabs">
               <li><a href="#"></a></li>
                  <li class="active-temp"><a href="#" class="tablinks active" onclick="all_apps()">All Apps</a></li>
                  @foreach($themecategories as $themecategory)
                        <?php $url = route(
                            'category_theme',
                            $themecategory->id
                        ); ?>
                        <li ><a href="#" onclick="category_product('{{$url}}')" class="tablinks active" >{{$themecategory->category_name}}</a></li>
                  @endforeach
            </ul>
         </div>
         <div class="col-md-9">
            <div id="London" class="row tabcontent  select-template-row" style="display: block;">
            <div class="row">
               @foreach($template as $data)
               <div class="col-md-4 ourworkcol default_show">
                   <div class="our-work-img">
                    <a class="tp-btn" onClick="template_modal('{{$data->id}}')" href="#"><i class="fa fa-eye" aria-hidden="true"></i> Theme Preview</a>
                    <a href="#" id="add_theme" onClick="template_modal('{{$data->id}}')">
                        <img class="bgmb" src="{{$data->theme_thumbnail}}" alt="right-mobile">
                        <div class="hover-overlayer">{{$data->theme_name}}</div>
                      </a>                         
                   </div>
               </div> 
               @endforeach
               </div>
               <div class="row new_product_show">               
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-------===== Theme Slider =======----->

<div class="modal theme-modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="slider-main">
          <div id="themepre" class="carousel slide" data-ride="carousel">
        </div>
      </div>
    </div>  
</div>
</div>
</div>

<script>
 function submitDetailsForm(){ $("#myform").submit()};
 function all_apps(){
      $('.default_show').show();
      $('.new_product_show').empty();
   }
function category_product(url){
    $('.default_show').hide();
    $.ajax({
       type:'get',
       url:url,
       success:function(data){
          $('.new_product_show').empty().append(data);
       }
    })
}
</script>
@endsection