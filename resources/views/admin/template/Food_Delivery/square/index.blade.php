@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
   <div class="main-container">
      <div class="main-container-inner  mt-40">
         <div class="container-fluid">
            <div class="row clearfix text-left ">
               <div class="col-md-12">
                  <div class="card card-own">
                     <div class="card">
                        <div class="card-header">
                           <h3>Square Credentials</h3>
                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                           <thead>
                              <tr>
                                 <th>Id</th>
                                 <th>Square key</th>
                                 <th>Square token</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($squares as $square)
                              <tr>
                                 <td>{{$square->id}}</td>
                                 <td>{{$square->square_key}}</td>
                                 <td>{{$square->square_token}}</td>
                                 <td>
                                    <a href="{{route('theme.editsquare',$square->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a onclick="deletethemeData('{{route('theme.destroysquare',$square->id)}}')" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
<div id="mytemplateModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>

         <form method="POST" action="" id="deletetemplateForm">
            @csrf
            {{ method_field('Post') }}
            <div class="modal-body">
               <p>Do you really want to delete this Sqaure? This process cannot be undone.</p>
            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>
@include('admin.template.partials.footer')
 <script>
   function deletethemeData(url){
           $("#deletetemplateForm").attr('action', url);
           $('#mytemplateModal').modal();
       }
</script>
