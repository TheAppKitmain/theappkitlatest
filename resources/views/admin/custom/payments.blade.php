@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper main-payment-wrapper">
   <div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix aboutappcontainer">
    <div class="col-md-12">
      <div class="mt-20">
        <div class="card-header">
        <h2>Payments</h2>
        </div>
        <div class="card-body payment-carbody">
        @if($invoicepayment == NULL)
        <h6>No Payment link yet</h6>
        @else
           @foreach($invoicepayment->tiers as $tier)
              <div class="d-flex">
                   <div class="midle-pay">
                       <div class="form-group">
                          <label >Price</label>
                         <div class="time-d">$ {{$tier->tier_price}}</div>
                      </div>
                   </div>
                   <div class="right-pay">
                      <div class="form-group">
                         <label >Due Date</label>
                          <div class="price-d"><?php echo date("M j Y", strtotime($tier->date)); ?></div>
                      </div>
                   </div>
                   @if(!empty($tier->invoice_url))
                   <div class="right-pay">
                      <div class="form-group">
                        @if($tier->status == 'paid')
                         <a href="#" target="_blank" class="btn btn-info pay_done">Paid</a>
                        @else
                         <a href="{{$tier->invoice_url}}" target="_blank" class="btn btn-info">Pay now</a>
                        @endif
                      </div>
                   </div>
                   @endif
               </div>
          @endforeach
        @endif
        </div>
      </div>
    </div>
</div>    
</div>       
   
@include('admin.custom.partials.footer')