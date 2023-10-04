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
use App\Usertheme;
use App\ThemeTemplate;
use App\User;
use App\Mail\BugStatus;
use App\Aboutapp;
use App\InternalUpdates;
use App\Designdetail;
use App\Domaindetail;
use App\Bug;
use App\Payment;
use App\AboutappNote;
use App\Buildudid;
use App\quote;
use App\QuoteTier;
use App\Assignpm;
use Auth;
use App\Timeline;
use App\Devloperapps;
use App\Agreement;

class InternalUpdatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){

        $user_id = Aboutapp::get()->pluck('user_id');
        
        $users = User::whereIn('id',$user_id)->orWhere('user_type','custom')->withCount('internal_updates')->orderBy('internal_updates_count', 'desc')->get();
        
        return view('admin.super_admin.internal_updates',compact('users'));
    }  


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_notes($id)
    {
        $customer = User::where('id', $id)->first();
        $notes = \App\InternalUpdates::with('user')->where('customer_id',$id)->get();
        
        foreach($notes as $note):
            $note->date = \Carbon\Carbon::parse($note->created_at)->isoFormat('Do MMM YYYY');
        endforeach;

        return view('admin.super_admin.internal_update_notes',compact('customer','notes'));
    }


    public function note_status(Request $request){

        $staus_id = $request->staus_id;
        $taskid   = $request->taskid;

        $timeline =  \App\InternalUpdates::find($taskid);

        if(!is_null($timeline)){
            
            $timeline->progress_status = $staus_id;
            $timeline->update();
            $user =  \App\User::find($timeline->user_id);
            $dataList['taskid'] = $taskid;
            $dataList['status_id'] = $staus_id;

            Mail::to($user->email)->send(new NoteMail($dataList));
            return 0;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_notes(Request $request)
    {
         $data['user_id'] = $request->user_id;
         $data['customer_id'] = $request->customer_id;
         $addnotes = $request->internal_notes;
 
          foreach ($addnotes as $addnote) {
 
             \App\InternalUpdates::create([                    
             'notes' => $addnote,
             'user_id' => $data['user_id'],
             'customer_id' => $data['customer_id'],
             ]);
 
          }
         session::flash('statuscode','info');
         return back()->with('status','Submitted');
    }

    public function view_note($id)
    {   
        $note_status = \App\InternalUpdates::where('id',$id)->first();

        if(!is_null($note_status)){
            $note_status->status = 1;
            $note_status->update();           
        }

        $note = \App\InternalUpdates::where('id', $id)->first();

        $user = \App\User::find($note->user_id);

        $note_reply = \App\InternalUpdateNotes::with('user')->where('note_id', $note->id)->get();

        foreach($note_reply as $replynote):

            $replynote->date = \Carbon\Carbon::parse($replynote->created_at)->isoFormat('Do MMM YYYY');

        endforeach;

        return view('admin.super_admin.view_note',compact('note','note_reply','user'));
    }

    public function edit_note($id)
    {   
        $note_status = \App\InternalUpdates::where('id',$id)->first();
        return response()->json(['status' => True,'bug_note' => $note_status->notes ,'note_id' => $note_status->id]);

    }
    

    public function update_notes(Request $request)
    {

        $notes = \App\InternalUpdates::where('id',$request->note_id)->first();

        if(!is_null($notes)){
            $notes->notes = $request->bug_note;
            $notes->update();           
        }

        session::flash('statuscode','info');
        return back()->with('status','Updated');
    }

    public function note_reply(Request $request)
    {

        \App\InternalUpdateNotes::create([

            'note_id' => $request->note_id,
            'user_id' => $request->user_id,
            'note_reply' => $request->note_reply,
        ]);

        session::flash('statuscode','info');
        return back()->with('status','Submitted');

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
    public function delete_note($id)
    {
        $note = \App\InternalUpdates::find($id);
        
        if(!is_null($note)){
            $note->delete();
            $success = true;
            $message = "Note deleted successfully";
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
