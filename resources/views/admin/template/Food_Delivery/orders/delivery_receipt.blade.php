<!DOCTYPE html>
<html style="font-family: sans-serif; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
*,*:after ,*:before { box-sizing:border-box; }
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
<body style="min-width: 320px; text-align:center; background-color: #FFFFFF; width: 100%; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">

	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" align="left" valign="top" style="border-collapse: collapse; border-spacing: 0;">
		<tbody>
			<tr>
				<td align="center" valign="top" style="padding: 0; ">
					<table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; text-align: center;" border="0" valign="top">
							<tr><td><button onclick="window.print()" id="printbtn" style="float: right;margin-top: 21px;border: 1px solid #585858;font-size: 18px;padding: 5px 27px;border-radius: 4px;background: #e4e4e4;cursor: pointer;"><i class="fa fa-print" aria-hidden="true"></i> Print</button></td></tr>
							<tr>
								<td style="padding: 15px 20px;font-size: 30px;font-weight: bold;text-align: center; background: #68cce7;"><a href="#"><img src="https://i.ibb.co/0j05HvN/logorcpt.png" style="width: 170px;" border="0"></a></td>
							</tr>
							<tr>
							<table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0;">
								<tr>
									<td style="font-size: 26px;padding: 17px;background: #1861ae;color: #fff;font-weight: bold;"> {{$order->order_no}} </td>
									<td style="font-size: 26px;padding: 17px;background: #1861ae;color: #fff;font-weight: bold;text-align: right;"> {{$order->user->name}} </td>
								</tr>
							</table>
							</tr>
							<tr>
								<table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0;    margin: 0 auto; text-align: center;" border="0" valign="top" >
									<tr>
										<td style="font-size: 16px;padding:10px 20px 0px 20px;background: #ffffff;text-align: left;    font-weight: bold;"> 
										Placed at {{$order->created_at}}
										</td>
									</tr>
									<!-- <tr>
										<td style="font-size: 16px;padding: 10px 20px;background: #ffffff;text-align: left;    font-weight: bold;">
										Due at {{$order->delivered_at}}
										</td>
									</tr> -->
									<tr>
										<td style="font-size: 16px;padding:0px 20px 20px;background: #ffffff;text-align: left;    font-weight: bold;">
										{{$order->user->user_information->address ?? ""}} </br> {{$order->user->user_information->city ?? ""}} </br> {{$order->user->user_information->postcode ?? ""}}
										</td>
									</tr>
									<tr>
										<td style="font-size: 29px;padding: 20px;background: #ffffff;border-top: 2px solid #ccc;border-bottom: 2px solid #ccc;text-transform: uppercase;">
										Delivery
										</td>
									</tr>
									<!-- <tr>
										<td style="font-size: 18px;padding: 20px;background: #ffffff;text-align: left;border-bottom: 1px dotted #ccc;">Disposable items: No</td>
									</tr> -->
								</table>
							</tr>
							<tr>
								<table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0;margin: 0 auto;  text-align: center;" border="0" valign="top" >
									@foreach($order->items as $item)
										<tr>
											@if(count($item->product_informations)>0)
												<td style="font-size:17px;padding: 20px 20px 10px;text-align: left;font-weight: bold;">{{$item->qty}} X {{$item->products->first()->product_name}} {{$item->product_informations->first()->attribute_name ?? ""}}
												</td>
												<td style="font-size:17px;padding: 20px 20px 10px;text-align:right;">{{$order->currency}}{{$item->product_informations->first()->product_price}}</td>
			                                @else
			                                    <td style="font-size:17px;padding: 20px 20px 10px;text-align: left;font-weight: bold;">{{$item->qty}} X {{$item->products->first()->product_name}}</td>
												<td style="font-size:17px;padding: 20px 20px 10px;text-align:right;">{{$order->currency}}{{$item->products->first()->price}}</td>
			                                @endif
			                            </tr>
									@endforeach
								<tr>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;">Delivery Charges</td>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;text-align:right;">{{$order->currency}}{{$order->delivery_charges}}</td>
								</tr>
								<tr>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;">Subtotal</td>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;text-align:right;">{{$order->currency}}{{$order->subtotal}}</td>
								</tr>
								<tr>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;">Total</td>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;text-align:right;">
									@php $total = $order->subtotal+$order->delivery_charges@endphp
									{{$order->currency}}{{number_format($total,2)}}</td>
								</tr>
								@if(!is_null($order->apply_promo))
								<tr>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;">Discount Price</td>
									<td style="font-size:16px;padding: 10px 20px;background: #ffffff;text-align: left;    border-top: 2px solid #ccc;text-align:right;">{{$order->currency}}{{$order->apply_promo->discount_price ?? ""}}</td>
								</tr>
								@endif
								<tr>
									<td style="font-size:16px;font-weight: bold;padding: 20px 20px 20px;text-align:left;border-top: 2px solid #ccc;">Amount Paid</td>
									<td style="font-size:16px;font-weight: bold;padding: 12px 20px 20px;text-align:right;border-top: 2px solid #ccc;"> 
									{{$order->currency}}{{$order->total}}</td>
								</tr>
								</table>
							</tr>
							<tr>
								<table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0;    margin: 0 auto;  text-align: center;" border="0" valign="top"	>
									<tr><td style="font-size: 16px;border-top: 2px solid #ccc;padding: 14px;">Thank you for ordering from We Go Delivery</td></tr>
								</table>
							</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>