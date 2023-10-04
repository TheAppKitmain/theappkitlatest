<?php

namespace App\Http\Controllers\Admin\Template\Meal_Prep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\Shipping;
use App\ThemeTemplate;
use Session;

class ShippingController extends Controller
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
        $shippings = Shipping::where('user_id', $id)->where('template_id', $template_id)->get();
        return view('admin.template.E_Commerce.shipping', compact('themetemplate','shippings'));
        
        }
        else{
            Auth::logout();
            return redirect('login');
        }
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
        $data = array();
        $shipping_names = $request->shipping_name;
        $data['template_id'] = $request->template_id;     
        $data['user_id'] = $request->user_id;
        $shipping_price = $request->shipping_price;

        if(!empty($request->shipping_name && $request->shipping_price)){
            foreach($shipping_names as $key=>$shipping_name){

                Shipping::create([   

                    'template_id' => $data['template_id'],
                    'user_id' => $data['user_id'],
                    'shipping_name'=> $shipping_name,
                    'shipping_price'=> $shipping_price[$key],
                ]);
            }
            session::flash('statuscode','info');
            return redirect('theme/shipping')->with('status','Submit');
        }else{

            session::flash('statuscode','info');
            return redirect('theme/shipping')->with('status','Please enter Shipping Details');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $template_id = session('theme_id');
        $shipping = Shipping::where('user_id', $user_id)->where('template_id', $template_id)->where('id', $id)->first();
        return view('admin.template.E_Commerce.edit_shipping', compact('shipping'));
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
        $data = array();
        $shipping_names = $request->shipping_name;
        $data['template_id'] = $request->template_id;     
        $data['user_id'] = $request->user_id;
        $shipping_price = $request->shipping_price;

        foreach($shipping_names as $key=>$shipping_name){

            Shipping::where('id',$id)->update([   

                'template_id' => $data['template_id'],
                'user_id' => $data['user_id'],
                'shipping_name'=> $shipping_name,
                'shipping_price'=> $shipping_price[$key],
            ]);
        }
        session::flash('statuscode','info');
        return redirect('theme/shipping')->with('status','Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();
        session::flash('statuscode','error');
        return redirect('theme/shipping')->with('status','Deleted');
    }
}
