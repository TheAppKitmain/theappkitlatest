@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')

   

    <div class="main-home">
   <div class="main-container">
      <div class="main-container-inner  mt-40">
         <div class="container-fluid">
            <div class="row clearfix text-left ">
               <div class="col-md-12">
                  <div class="card card-own">
                  <!-- <div class="card-header text-center table-heading mb-40">
                        <h2>Edit Collections</h2>
                        </div> -->
                  <h2 class="add_title">Edit Collections</h2>                    
                  <div class="card-body ">
                     <form class="p-30" method="POST" action="{{route('theme.collections.update',$collection->id)}}" enctype="multipart/form-data">
                     @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                        <label class="pr-label" for="exampleInputEmail1">Collection Name:</label>
                           <input type="text" class="form-control @error('collection_name') is-invalid @enderror" id="collection_names" name="collection_name" value="{{$collection->collection_name}}" placeholder="Collection Name">
                              @error('collection_name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror 
                        </div>
                        <div class="form-group">
                           <input type="hidden" class="form-control" id="slugs" name="slug" value="{{$collection->slug}}">
                        </div>
                        <div class="form-group">
                        @if(Auth::user()->parent_id == 0)  
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
                  @else
                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
                  @endif                        </div>
                        <!-- <div class="form-group">
                           <label class="pr-label" for="exampleInputPassword1">Collection Description:</label>
                           <textarea class="form-control" id="collection_description" name="collection_description" rows="3" placeholder="Collection Description">{{$collection->collection_description}}</textarea>
                        </div> -->
                        <div class="form-group">
                           <label class="pr-label" for="exampleInputPassword1">Collection Image:</label>
                              <input id="collection_image" type="file" class="form-control imagee" name="collection_image" value="{{$collection->collection_image}}" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                           <label for="collection_image" class="splogoinput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                              
                              @if(!isset($collection->collection_image)) 
                              <img id="blah"/>
                              @else
                              <img id="blah" src="{{asset($collection->collection_image)}}" alt="">
                              @endif

                        </div>
                        <button type="submit" class="btn btn-primary">Update Collection</button>
                     </form>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('admin.template.partials.footer')