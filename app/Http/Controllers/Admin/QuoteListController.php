<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Mail\Sendtaskupdate;
use App\Mail\SendTaskprogressupdate;
use App\Mail\NoteMail;
use App\quote;
use App\User;

class QuoteListController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){

        $user_id = quote::get()->pluck('user_id');
        
        // $users = User::whereIn('id',$user_id)->with('quote_list')->orderBy('quote_list.created_at', 'desc')->get();

        $users = User::with('quote_list')->join('quotes', 'quotes.user_id', '=', 'users.id')->select('users.*') 
        ->orderBy('quotes.id', 'DESC')
        ->get();
        
        return view('admin.super_admin.quote_list',compact('users'));
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_quotes($id)
    {
        $customer = User::where('id', $id)->first();
        $notes = \App\quote::with('user')->where('user_id',$id)->get();
        $assignpm = \App\Assignpm::where('customer_id', $id)->first();
        foreach($notes as $note):
            $note->date = \Carbon\Carbon::parse($note->created_at)->isoFormat('Do MMM YYYY');
        endforeach;

        return view('admin.super_admin.quote_details',compact('customer','notes','assignpm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quote_status(Request $request){

        $staus_id = $request->staus_id;
        $taskid   = $request->taskid;
        $userid   = $request->userid;
        $timeline =  \App\quote::find($taskid);

        if(!is_null($timeline)){          
            $timeline->status = $staus_id;
            $timeline->update();
                if($staus_id == "3"):
                    $customer_id = $userid;
                    $assignpm = \App\Assignpm::where('customer_id', $customer_id)->first();
                    if (!is_null($assignpm)) {
                        $assignpm->is_confirmed = "1";
                        $assignpm->update();
                    }
                endif;
            return 0;
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

    public function delete_quote($id)
    {
        $note = \App\quote::find($id);
    
        if(!is_null($note)){
            $note->delete();
            $success = true;
            $message = "quote deleted successfully";
        } else {
            $success = true;
            $message = "Something went wrong";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    
}
