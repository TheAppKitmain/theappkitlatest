<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Template\E_Commerce\Shipping;
use Illuminate\Http\Request;


class ShippingController extends Controller
{
    public function shipping_details() 
    { 
        $shipping = Shipping::all();

        if(count($shipping) == 0){
            return response()->json(['status'=>False,'shipping_details' => $shipping]);
        }
        else{
            return response()->json(['status'=>True,'shipping_details' => $shipping]);
        }
    }
}
