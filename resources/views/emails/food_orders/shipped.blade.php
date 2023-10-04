@component('mail::message')
@php 
$shop = App\Models\Template\Food_Delivery\FoodShop::first();
$currency = html_entity_decode($shop->currency_symbol);
@endphp
Hello {{$order->user->name}},

@component('mail::panel')
<p>Thank you for your purchase.</p>
<p>Your order no is <strong>{{$order->order_no}}</strong></p>
<ul>
	<li>Delivery Schedule : <span style="text-transform: uppercase;">{{$order->schedule}}</span></li>

	<?php 
	$charge_amount = "2";
	if(!is_null($order->apply_promo)){
			if($order->apply_promo->total <= "7.5"){
				$shop->delivery_charges += $charge_amount;
				$shop->delivery_charges = (string)$shop->delivery_charges;
				if($shop->delivery_charges == "4.5"){
					$shop->delivery_charges = "4.50";	
				}
		
		?>
			<li>Delivery Charges : {{$currency}}{{$shop->delivery_charges}}</li>
		<?php
		}else{
		?>
			<li>Delivery Charges : {{$currency}}{{$shop->delivery_charges}}</li>
		<?php
		}

	}
	else
	{
		
		if($order->subtotal <= "7.5"){
			$shop->delivery_charges += $charge_amount;
			$shop->delivery_charges = (string)$shop->delivery_charges;
			if($shop->delivery_charges == "4.5"){
				$shop->delivery_charges = "4.50";	
			}

		?>
			<li>Delivery Charges : {{$currency}}{{$shop->delivery_charges}}</li>
		<?php
		}else{
		?>
			<li>Delivery Charges : {{$currency}}{{$shop->delivery_charges}}</li>
		<?php
		}
	}
	?>

<?php
if(!is_null($order->apply_promo)){
?>
	<li>Promo : {{$order->apply_promo->promo->promo_code ?? "-"}}</li>
	<li>Total : {{$currency}} {{$order->apply_promo->total ?? "-"}}</li>
	<li>Discount Price : {{$currency}} {{$order->apply_promo->discount_price ?? "-"}}</li>
	<li>Grand Total : {{$currency}} {{$order->apply_promo->grand_total ?? "-"}}</li>
<?php
}else{
?>

	<li>Sub Total : {{$currency}} {{$order->subtotal ?? "-"}}</li>
	<li>Total : {{$currency}} {{$order->total ?? "-"}}</li>
<?php
}
?>
</ul>


@endcomponent

@php $items = App\Models\Template\Food_Delivery\FoodCartItem::whereCartId($order->cart->id)->with('products','product_informations')->get(); @endphp

@component('mail::table')
|Items|Qty|Price|
</br>
@foreach($items as $item)
	@if(count($item->product_informations)>0)
	|{{$item->products->first()->product_name}} {{$item->product_informations->first()->attribute_name ?? ""}}|{{$item->qty}}|{{$item->product_informations->first()->product_price}}|
    @else
	|{{$item->products->first()->product_name}}|{{$item->qty}}|{{$currency}}{{$item->products->first()->price}}|
    @endif
@endforeach

@endcomponent

@component('mail::button', ['url' => json_decode(json_encode($order->order_charges['receipt_url']))]) Payment Receipt @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
