@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<?php
   $ip = $_SERVER['REMOTE_ADDR'];
//    dd($ip); // the IP address to query
   // $ip = '223.235.199.230';
   $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
   if($query && $query['status'] == 'success') {
    $countryCode = $query['countryCode'];
    $countryCodesmall =  strtolower($countryCode);
   }
   ?>
<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
   <div class="main-container">

      <div class="main-container-inner">
         <div class="container-fluid">
            <div class="row clearfix text-left ">
               <div class="col-md-12">
                  <div class="card-own">
                     <div class="card">
                     <h2 class="add_title">Coupon</h2>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                           <thead>
                              <tr>
                                 <th>Id</th>
                                 <th>Coupon code</th>
                                 <th>Coupon limit</th>
                                 <th>Discount type</th>
                                 <th>Discount</th>
                                 <th>From </th>
                                 <th>To </th>
                                 <th>Status</th>
                                 <th>Description</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($coupons as $coupon)
                              <tr onclick="location.href='">
                                 <td>{{$coupon->id}}</td>
                                 <td>{{$coupon->coupon_code}}</td>
                                 <td>{{$coupon->limit}}</td>
                                 <td>{{$coupon->discount_type}}</td>
                                 <td>
                                    {{$coupon->discount}}
                                    @if($coupon->discount_type === "percentage")
                                    %
                                    @else
                                     @if($countryCode =='GB')
                                      £
                                     @else
                                      $
                                     @endif
                                    @endif
                                 </td>
                                 <td>{{$coupon->from_date}}</td>
                                 <td>{{$coupon->to_date}}</td>
                                 <td>{{$coupon->status == 1 ? "Active" : "Inactive"}}</td>
                                 <td>{{$coupon->description}}</td>
                                 <td>
                                    <a href="{{route('theme.editcoupon',$coupon->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a onclick="deletethemeData('{{route('theme.destroycoupon',$coupon->id)}}')" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
               <p>Do you really want to delete this coupon? This process cannot be undone.</p>
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
@include('admin.template.partials.footer')
<script>
   function deletethemeData(url){
           $("#deletetemplateForm").attr('action', url);
           $('#mytemplateModal').modal();
       }
</script>
