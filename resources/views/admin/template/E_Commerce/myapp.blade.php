@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner ">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12 text-right">
                        <div class="add-app-new">                          
                           <a class="add-new-app-btn" href="{{ URL::to('themes') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Select Template</a>                                 
                        </div>
                     </div>
                     <div class="col-md-12">

                        @if(count($themetemplates) == 1)
                           <div class="row owncard justify-content-center">
                        @else
                           <div class="row owncard">
                        @endif
                           @if(count($themetemplates) == 0)
                           <h1 class="no_app">You have no Themes</h1>
                           @else
                           @foreach($themetemplates as $themetemplate)                          
                           <div class="col-md-4 mt-20">
                              @if(empty($subscription))
                                 <a onclick="deletethemeData('{{route('theme.theme_settings.destroy',$themetemplate->id)}}')" class="btndelete deletebtn-theme" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                 @endif
                                 @if($themetemplate->category_id == 1)
                                 <a href="{{route('theme.theme_settings.show',$themetemplate->id)}}">
                                 @elseif($themetemplate->category_id == 4)
                                 <a href="{{route('theme.food_theme_settings.show',$themetemplate->id)}}">
                                 @elseif($themetemplate->category_id == 3)
                                 <a href="{{route('theme.booking_theme_settings.show',$themetemplate->id)}}">
                                 @elseif($themetemplate->category_id == 5)
                                 <a href="{{route('theme.meal_theme_settings.show',$themetemplate->id)}}">
                                 @endif
                                    <div class="card-header text-center tempname-user">
                                       <h2>{{$themetemplate->theme_name}}</h2>                                 
                                    </div>
                                    <div class="our-work-img tmpimgbx tmpimgbx-mn">                                
                                       <img class="bgmb1" src="{{asset($themetemplate->theme_thumbnail)}}" alt="right-mobile">
                                    </div>
                                 </a>
                                 @php
                                    $id = auth()->user()->id;
                                    $subscription = App\UserSubcription::where('user_id',$id)->where('template_id',$themetemplate->id)->first();
                                 @endphp
                                 @if(empty($subscription))
                                 <h3 class="unplbsh"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Unpublished</h3>
                                 @else
                                 <h3 class="published unplbsh"><i class="fa fa-cloud-download" aria-hidden="true"></i> Published</h3>
                                 @endif
                           </div>
                        @endforeach
                        @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>



<div class="modal fade popup-template-modal" id="mytemplateModal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="">
            <form method="post" action="" id="deletetemplateForm">
               @csrf
               {{ method_field('DELETE') }}
               <div class="modal-body">
                  <p>Do you really want to delete these records? This process cannot be undone.</p>
               </div>
               <div class="modal-footer mdl-ftr-del">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
               </div>
            </form>
         </div>
         </div>
      </div>
  </div>


<!-- main end -->
@include('admin.template.partials.footer')

<script>

function deletethemeData(url){
        $("#deletetemplateForm").attr('action', url);
        $('#mytemplateModal').modal();
    }

</script>
