@component('mail::message')
@php 

@endphp
Hello {{$order->app_user->name}},

@component('mail::panel')
<p>Tax Invoice</p>
<p>Your order no is <strong>{{$order->order_number}}</strong></p>
@endcomponent

@php $shipping_address = \App\Models\Template\E_Commerce\ShippingAddress::where('app_user_id',$order->app_user->id)->first(); @endphp

<table class="table">
  <tbody>
    <tr>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Order Id:</b>{{$order->order_number}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Bill To</b></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Ship To</b></td>
    </tr>
    <tr>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Order Date:</b>{{$order->created_at}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>{{$shipping_address->full_name}}</b></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>{{$shipping_address->full_name}}</b></td>
    </tr>
    <tr>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Invoice Date:</b>{{$order->created_at}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$shipping_address->house_no}},{{$shipping_address->area}},{{$shipping_address->city}},{{$shipping_address->state}},{{$shipping_address->pincode}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$shipping_address->house_no}},{{$shipping_address->area}},{{$shipping_address->city}},{{$shipping_address->state}},{{$shipping_address->pincode}}</td>
    </tr>
    <tr>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Phone:</b>{{$shipping_address->number}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Phone:</b>{{$shipping_address->number}}</td>
    </tr>
  </tbody><br><br>

  <table class="table">
  <tbody>
    <tr>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Product Name:</b></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Qty</b></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Gross Amount</b></td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;"><b>Total</b></td>
    </tr>
    <tr>
    @php $product = \App\Models\Template\E_Commerce\Product::where('id',$order->product_id)->first();
        $cart_detail = \App\Models\Template\E_Commerce\EcommCartDetail::where('id',$order->cart_detail_id)->first();
    @endphp
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$product->product_name}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$cart_detail->qty}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$product->product_price}}</td>
      <td style="box-sizing:border-box; max-width:100vw; padding: 15px;">{{$order->total}}</td>
    </tr>
  </tbody><br><br>
</table>




@endcomponent