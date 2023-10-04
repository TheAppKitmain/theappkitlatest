<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use App\Models\Template\Booking\BookingDeal;
use App\Models\Template\Booking\BookingDealservice;
use App\Models\Template\Booking\BookingService;
use Illuminate\Support\Facades\Storage;
use App\ThemeTemplate;
use DB;
use Illuminate\Http\Request;

class DealController extends Controller
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
            $deals = BookingDeal::where('owner_id', $id)->where('template_id', $template_id)->get();
            return view('admin.template.Booking.deals.index',compact('deals'));
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
        $services = BookingService::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','asc')->get();


        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.Booking.deals.create',compact('services','themetemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,['name'=>"required|unique:booking_deals"]);
        $deal = new BookingDeal;
        $deal->owner_id = $request->user_id;
        $deal->template_id = $request->template_id;
        $deal->name = $request->name;
        $deal->description = $request->description;
        $deal->price = $request->price;
        $deal->status = $request->status;
        $deal->hour = $request->hour;
        $deal->minute = $request->minute;
        $deak_image = $request->file('image');
        if($deak_image)
        {
            $name = time().'.'.$deak_image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($deak_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $deal->image = $url;
        }

        if($deal->save())
        { 
            $services = $request->input('service_id');
            
            foreach($services as $service){
              $deal_service = new BookingDealservice();
              $deal_service->deal_id = $deal->id;
              $deal_service->service_id = $service;
              $deal_service->save();
           }
          
          return redirect()->route('theme.deals.index')->with(['alert'=>'success','message'=>'Deal has been created successfully!.']);
        }
        else
        {
          return redirect()->route('theme.deals.index')->with(['alert'=>'danger','message'=>'Deal has not been created!.']);  
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
        $deal = BookingDeal::find($id);
        $deal_service = BookingDealservice::select('service_id')->where('deal_id', $id)->get()->toArray();
        $services=array();
        foreach ($deal_service as $key => $value) {
            $ser = BookingService::find($value['service_id']);
            array_push($services, $ser->name);
        }
        return view('admin.template.Booking.deals.show',compact('deal','services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deal = BookingDeal::find($id);
        $services = BookingService::orderBy('id','asc')->get();
        $deal_service = BookingDealservice::select('service_id')->where('deal_id', $id)->get()->toArray();
        $sel_dealservice=array();
        foreach ($deal_service as $key => $value) {
            array_push($sel_dealservice, $value['service_id']);
        }
        return view('admin.template.Booking.deals.edit',compact('deal','services','sel_dealservice'));
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
            'name'=>"required|unique:booking_deals,name,".$id,
        ]);
        $deal = BookingDeal::find($id);
        $deal->name = $request->name;
        $deal->description = $request->description;
        $deal->price = $request->price;
        $deal->status = $request->status;
        $deal->hour = $request->hour;
        $deal->minute = $request->minute;

        $deak_image = $request->file('image');
        if($deak_image)
        {
            $name = time().'.'.$deak_image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($deak_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $deal->image = $url;
        }
        if($deal->save())
        {   
            $rows = DB::table('dealservices')->where('deal_id', $deal->id)->delete();

            $services = $request->input('service_id');
            foreach($services as $service){
              $deal_service = new BookingDealservice();
              $deal_service->deal_id = $deal->id;
              $deal_service->service_id = $service;
              $deal_service->save();
           }

            return redirect()->route('theme.deals.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>$deal->name.' Deal has been updated successfully!.']);
        }
        else
        {
            return redirect()->route('theme.deals.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Deal has not been updated!.']);  
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
        $deal = BookingDeal::find($id);
        if(!is_null($deal))
        {
            $deal->delete(); 
            return redirect()->route('theme.deals.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Deal has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('theme.deals.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Deal has not been deleted!.']);  
        }
    }
}
