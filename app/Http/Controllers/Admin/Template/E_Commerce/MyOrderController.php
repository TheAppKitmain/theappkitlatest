<?php

namespace App\Http\Controllers\Admin\Template\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlace;
use App\Models\Template\E_Commerce\AppUser;
use App\Models\Template\E_Commerce\EcommCart;
use App\Models\Template\E_Commerce\EcommDeviceType;
use App\Models\Template\E_Commerce\EcommCartDetail;
use App\Models\Template\E_Commerce\ShippingAddress;
use App\Models\Template\E_Commerce\PushNotification;
use App\Models\Template\E_Commerce\Shipping;
use App\ThemeTemplate;
use Session;
use App\Mail\OrderShipped;
use Auth;

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = auth()->user()->id;

        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $orders = Order::with('app_user')->where('owner_id', $id)->where('template_id', $template_id)->get();
        $data = [];
        $data['new_orders'] = Order::where('owner_id', $id)->where('template_id', $template_id)->whereStatus('0')->orderBy('id','desc')->get();
		$data['confirmed_orders'] = Order::where('owner_id', $id)->where('template_id', $template_id)->whereStatus('1')->orderBy('id','desc')->get();
		$data['shipped_orders'] = Order::where('owner_id', $id)->where('template_id', $template_id)->whereStatus('2')->orderBy('id','desc')->get();
        return view('admin.template.E_Commerce.orders.my_orders', compact('themetemplate','orders','data'));        
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }

	public function new_orders()
	{
		$data=[];
		$data['new_orders'] = Order::with('app_user')->whereStatus('0')->orderBy('id','desc')->get();
		return view('admin.template.E_Commerce.orders.new_orders',compact('data'));
	}

	public function confirmed_orders()
	{
		$data=[];
		$data['confirmed_orders'] = Order::with('app_user')->whereStatus('1')->orderBy('id','desc')->get();
		return view('admin.template.E_Commerce.orders.confirmed_orders',compact('data'));
	}

	public function shipped_orders()
	{
		$data=[];
		$data['shipped_orders'] = Order::with('app_user')->whereStatus("2")->orderBy('id','desc')->get();
		return view('admin.template.E_Commerce.orders.shipped_orders',compact('data'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('app_user')->findOrFail($id);
		$created_at = \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM YYYY');
        $address = ShippingAddress::where('id',$order->address_id)->first();
	    $order->items = EcommCartDetail::whereCartId($order->cart_id)->with('products')->get();
		$shipping = Shipping::where('user_id',$order->owner_id)->where('template_id',$order->template_id)->first();
		$order->order_total = 0;
		return view('admin.template.E_Commerce.orders.order_details',compact('order','address','shipping','created_at'));
    }


    public function update_status(Request $request)
	{
		$order = Order::find($request->id);

		if(!is_null($order)):
			$order->status = $request->status;

			$order->save();

			$app_id = $order->app_user->id;

			$device = EcommDeviceType::where('app_user_id',$app_id)->first();

			$registration_ids = $device->firebase_token;

			if(!is_null($registration_ids)):
				if($order->status == "1" || $order->status == "2")
				{
					$order->delivery_at = now();
					$order->save();
				}

				if($order->status == "0"):
					Mail::to('documents@theappkit.co.uk')->send(new OrderPlace($order));
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Confirmed",
	                            "body" => "Your order has been confirmed & is now being packed.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
							   "order_no"=> $order->order_number
							]
	                    ];
						PushNotification::send($message);
				endif;

				if($order->status == "1"):
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Completed",
	                            "body" => "Thank you for supporting local business. See you soon.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
							   "order_no"=> $order->order_number
							]
	                    ];
						PushNotification::send($message);
				endif;
				if($order->status == "2"):
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Delivery",
	                            "body" => "Not long now!, Your orders on the way.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
		                       "order_no"=> $order->order_number
	                        ]
	                    ];
						PushNotification::send($message);
				endif;
			endif;
			session::flash('statuscode','info');
            return back()->with('status','Order status has been changed.');
		else:
			session::flash('statuscode','info');
            return back()->with('status','Order not found.');
		endif;
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
