@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="main-container">
   <div class="main-container-inner">
      <div class="container-fluid">
         <div class="row clearfix text-left ">
            <div class="col-md-12">
               <div class="row card owncard">
                  <div class="col-md-12">
                   <h2 class="add_title">Edit Coupon</h2>

                    <form method ="POST" action="{{route('theme.updatecoupon',$coupon->id)}}" enctype="multipart/form-data" id="coupon_validation">
                     @csrf
                     <div class="form-group">
                     @if(Auth::user()->parent_id == 0)  
                                        <input type="hidden" class="form-control" name="owner_id" value="{{ Auth::user()->id}}">
                                        @else
                                        <input type="hidden" class="form-control" name="owner_id" value="{{ Auth::user()->parent_id}}">     
                                        @endif                     </div>

                     <div class="form-group">
                        <input type="hidden" class="form-control inputtemp" name="template_id" value="{{$themetemplate->id}}">
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Coupon Code</label>
                        <input type="text" name="coupon_code" class="form-control inputtemp" value="{{ $coupon->coupon_code }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Description</label>
                        <input type="text" name="description" class="form-control inputtemp" value="{{ $coupon->description }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Cart Amount</label>
                        <input type="text" name="cart_amount" class="form-control inputtemp" value="{{ $coupon->cart_amount }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Discount type</label>
                        <select name="discount_type" class="form-control inputtemp " value="{{ old('discount_type') }}"  required>
                           <option value="percentage">Percentage</option>
                           <option value="fixed">Fixed</option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Discount on coupon</label>
                        <input type="number" name="discount" class="form-control inputtemp" value="{{$coupon->discount }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">Limit</label>
                        <input type="number" name="limit" class="form-control inputtemp" value="{{$coupon->limit }}" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">From</label>
                        <input type="text" id="datepicker" name="from_date" placeholder="yy-mm-dd" value="{{ date('Y-m-d',strtotime($coupon->from_date)) }}" class="form-control inputtemp" required>
                     </div>

                     <div class="form-group">
                        <label class="pr-label">To</label>
                        <input type="text" id="datepicke" name="to_date" placeholder="yy-mm-dd"  value="{{ date('Y-m-d',strtotime($coupon->to_date)) }}" class="form-control inputtemp" required>
                     </div>

                     <div class="form-group">
                         <label class="pr-label">Status</label>
                         <input type="radio" name="status" value="1" checked="checked"> Active
                         <input type="radio" name="status" value="0"> Inactive
                     </div>
                           <button type="submit" class="btn btn-primary">Save</button>
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
<script>
   $( "#datepicker" ).datepicker(
       {
         minDate:0,
         dateFormat:'yy-mm-dd',
       });
</script>
<script>
   $( "#datepicke" ).datepicker(
       {
         minDate:0,
         dateFormat:'yy-mm-dd',
       });
</script>
