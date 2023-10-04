<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use App\Models\Template\Booking\BookingCartype;
use Illuminate\Support\Facades\Storage; 
use App\ThemeTemplate;
use Illuminate\Http\Request;

class CartypeController extends Controller
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
            $cartypes = BookingCartype::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Booking.cartypes.index',compact('cartypes'));
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

        return view('admin.template.Booking.cartypes.create',compact('themetemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>"required|unique:booking_cartypes"]);
        $cartype = new BookingCartype;
        $cartype->owner_id = $request->user_id;
        $cartype->template_id = $request->template_id;
        $cartype->name = $request->name;
        $cartype->description = $request->description;
        $cartype->extra_charges = $request->extra_charge;
        if(is_null($request->extra_price)){ $ex_price = 0; } else { $ex_price = $request->extra_price; }
        $cartype->extra_price = $ex_price;
        $cartype->status = $request->status;
        $cart_image = $request->file('image');
        if($cart_image)
        {
            $name = time().'.'.$cart_image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($cart_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $cartype->image = $url;
        }
        if($cartype->save())
        {
          return redirect()->route('theme.cartypes.index')->with(['alert'=>'success','message'=>'Car type has been created successfully!.']);
        }
        else
        {
          return redirect()->route('theme.cartypes.index')->with(['alert'=>'danger','message'=>'Car type has not been created!.']);  
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
        $cartype = BookingCartype::find($id);
        return view('admin.template.Booking.cartypes.show',compact('cartype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartype = BookingCartype::find($id);
        return view('admin.template.Booking.cartypes.edit',compact('cartype'));
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
            'name'=>"required|unique:booking_cartypes,name,".$id,
        ]);
        $cartype = BookingCartype::find($id);
        $cartype->name = $request->name;
        $cartype->description = $request->description;
        $cartype->extra_charges = $request->extra_charge;
        if(is_null($request->extra_price))
        {
            $ex_price = 0;
        }
        else
        {
            $ex_price = $request->extra_price;
        }
        $cartype->extra_price = $ex_price;
        $cartype->status = $request->status;
        if($request->hasFile('image'))
        { 
            $cartype->image = $request->file('image')->store('cartype');
            $cartype->s_image = $request->file('s_image')->store('cartype'); 
        }
        if($cartype->save())
        {
            return redirect()->route('theme.cartypes.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>$cartype->name.' Car type has been updated successfully!.']);
        }
        else
        {
            return redirect()->route('theme.cartypes.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Car type has not been updated!.']);  
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
        $cartype = BookingCartype::find($id);
        if(!is_null($cartype))
        { 
            $cartype->delete(); 
            return redirect()->route('admin.template.Booking.cartypes.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Car type has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('admin.template.Booking.cartypes.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Car type has not been deleted!.']);  
        }
    }
}
