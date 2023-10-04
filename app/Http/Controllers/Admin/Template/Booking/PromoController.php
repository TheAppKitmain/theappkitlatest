<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use App\Models\Template\Booking\BookingPromo;
use App\Models\Template\Booking\BookingService;
use App\ThemeTemplate;
use Illuminate\Http\Request;

class PromoController extends Controller
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
            $promos = BookingPromo::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Booking.promo.index',compact('promos'));
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
        $id = auth()->user()->id;
        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();

        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.Booking.promo.create',compact('themetemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'promo_code'=>'required|unique:booking_promos'
        ]);
        $promo = new BookingPromo;
        $promo->owner_id = $request->user_id;
        $promo->template_id = $request->template_id;
        $promo->promo_code = $request->promo_code;
        $promo->description = $request->description;
        $promo->discount = $request->discount;
        $promo->status = $request->status;
        if($promo->save())
        {
            return redirect()->route('theme.booking_promo.index')->with(['alert'=>'success','message'=>$promo->promo_code.' promo has been created successfully!.']);
        }
        else
        {
            return redirect()->route('theme.booking_promo.index')->with(['alert'=>'danger','message'=>'Promo has not been created successfully!.']);
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
        $promo = BookingPromo::find($id);
        return view('admin.template.Booking.promo.edit',compact('promo'));
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
        $this->validate($request,[
            'promo_code'=>'required|unique:booking_promos,promo_code,'.$id
        ]);
        $promo = BookingPromo::find($id);
        $promo->promo_code = $request->promo_code;
        $promo->description = $request->description;
        $promo->discount = $request->discount;
        $promo->status = $request->status;
        if($promo->save())
        {
            return redirect()->route('admin.template.Booking.promo.index')->with(['alert'=>'success','message'=>$promo->promo_code.' promo has been updated successfully!.']);
        }
        else
        {
            return redirect()->route('admin.template.Booking.promo.index')->with(['alert'=>'danger','message'=>'Promo has not been updated successfully!.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = BookingPromo::find($id);
        if(!is_null($promo))
        {
            $promo->delete();
           return redirect()->route('theme.booking_promo.index')->with(['alert'=>'success','message'=>'Promo code has been removed successfully!.']);
        }
        else
        {
            return redirect()->route('theme.booking_promo.index')->with(['alert'=>'danger','message'=>'Promo code has not been removed successfully!.']);
        }
    }
}
