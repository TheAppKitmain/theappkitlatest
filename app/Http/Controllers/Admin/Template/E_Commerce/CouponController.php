<?php

namespace App\Http\Controllers\Admin\Template\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\EcomCoupon;
use App\ThemeTemplate;
use Session;


class CouponController extends Controller
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
        $coupons = EcomCoupon::orderBy('id','desc')->where('owner_id', $id)->where('template_id', $template_id)->paginate(6);
    }
    else{
        Auth::logout();
        return redirect('login');
    }
        return view('admin.template.E_Commerce.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.E_Commerce.coupon.create', compact('themetemplate'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecoupon(Request $request)
    {
        $this->validate($request,['coupon_code'=>'unique:ecom_coupons']);
        $coupon = new EcomCoupon;
        $coupon->owner_id = $request->owner_id;
        $coupon->template_id = $request->template_id;
        $coupon->cart_amount = $request->cart_amount;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->from_date = date('Y-m-d',strtotime($request->from_date));
        $coupon->to_date = date('Y-m-d',strtotime($request->to_date));
        $coupon->limit = $request->limit;
        $coupon->status = $request->status;
        $coupon->description = $request->description;
        $coupon->save();

        session::flash('statuscode','info');
        return redirect('theme/coupon')->with('status','Data is Added');
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

        $coupon = EcomCoupon::findOrFail($id);
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.E_Commerce.coupon.edit', compact('themetemplate','coupon'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecoupon (Request $request, $id)
    {
        $this->validate($request,['coupon_code'=>'unique:ecom_coupons,coupon_code,'.$id]);
        $coupon = EcomCoupon::find($id);
        $coupon->owner_id = $request->owner_id;
        $coupon->template_id = $request->template_id;
        $coupon->cart_amount = $request->cart_amount;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->from_date = date('Y-m-d',strtotime($request->from_date));
        $coupon->to_date = date('Y-m-d',strtotime($request->to_date));
        $coupon->limit = $request->limit;
        $coupon->status = $request->status;
        $coupon->description = $request->description;
        $coupon->update();

        session::flash('statuscode','info');
        return redirect('theme/coupon')->with('status','Data is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroycoupon($id)
    {
        $coupons = EcomCoupon::where('id',$id);
        $coupons->delete();
        Session::flash('statuscode','error');
        return redirect('theme/coupon')->with('status','Coupon is Deleted');
}
}
