<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use App\Models\Template\Booking\BookingService;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;
use App\ThemeTemplate;


class ServiceController extends Controller
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
            $services = BookingService::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Booking.services.index',compact('services'));
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
        return view('admin.template.Booking.services.create',compact('themetemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>"required|unique:booking_services"]);
        $service = new BookingService;
        $service->owner_id = $request->user_id;
        $service->template_id = $request->template_id;
        $service->name = $request->name;
        $service->status = $request->status;
        $service_image = $request->file('image');
        if($service_image)
        {
            $name = time().'.'.$service_image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($service_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $service->image = $url;
        }
        if($service->save())
        {
          return redirect()->route('theme.services.index')->with(['alert'=>'success','message'=>'Service has been created successfully!.']);
        }
        else
        {
          return redirect()->route('theme.services.index')->with(['alert'=>'danger','message'=>'Service has not been created!.']);  
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
        $service = BookingService::find($id);
        return view('admin.template.Booking.services.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = BookingService::find($id);
        return view('admin.template.Booking.services.edit',compact('service'));
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
        $this->validate($request,['name'=>"required|unique:booking_services,name,".$id,]);
        $service = BookingService::find($id);
        $service->name = $request->name;
        $service->status = $request->status;
        $service_image = $request->file('image');
        if($service_image)
        {
            $name = time().'.'.$service_image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($service_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $service->image = $url;
        }
        if($service->save())
        {
            return redirect()->route('theme.services.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>$service->name. ' service has been updated successfully!.']);
        }
        else
        {
            return redirect()->route('theme.services.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'service has not been updated!.']);  
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
        $service = BookingService::find($id);
        if(!is_null($service))
        { 
            $service->delete(); 
            return redirect()->route('theme.services.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Service has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('theme.services.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Service has not been deleted!.']);  
        }
    }
}
