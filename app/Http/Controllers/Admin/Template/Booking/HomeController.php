<?php

namespace App\Http\Controllers\Admin\Template\Booking;
use App\Models\Template\Booking\BookingContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function working_day_time(Request $request)
    {
        if($request->isMethod('get'))
        {
            $all_days = WorkingDay::get();
            return view('working_day_time.index',compact('all_days'));
        }
        if($request->isMethod('post'))
        {
            foreach($request->status as $key=>$value)
            {
                $update = WorkingDay::whereday_id($key)->update([
                    'start_time'=>$request->start_time[$key],
                    'end_time'=>$request->end_time[$key],
                    'status'=>$value
                ]);
            }

            return redirect()->route('working_day_time')->with(['alert'=>'success','message'=>'Working days and time has been successfully updated.!']);
        }
    }

    public function contact_us(Request $request)
    {
       $contact_us = BookingContactUs::all();
       return view('admin.template.Booking.contact_us.index',compact('contact_us'));
    }

    public function view_message($id)
    {
        $message = BookingContactUs::find($id);
        return view('admin.template.Booking.contact_us.show',compact('message'));
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
