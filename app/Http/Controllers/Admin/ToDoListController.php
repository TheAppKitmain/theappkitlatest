<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\ToDoList;
use App\TaskReply;
use App\Mail\ToDoListMail;
use App\Mail\TaskMail;
use Session;
use Auth;


class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_users = User::where('role_id', 2)->get();

        $todo_lists = ToDoList::orderBy('id', 'desc')->where('user_ids', 'like', '%' . Auth::user()->id . '%')->get();
        $send_lists = ToDoList::orderBy('id', 'desc')->where('owner_id', Auth::user()->id)->get();
        return view("admin.super_admin.to_do_list", compact('todo_lists', 'all_users', 'send_lists'));
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
        $this->validate($request, [
            'message' => ['required'],
        ]);

        $selected_customer = implode(',', $request->select_customers);

        $to_do_list = new ToDoList;
        $to_do_list->owner_id = $request->user_id;
        $to_do_list->user_id = $selected_customer;
        $to_do_list->user_ids = $selected_customer;
        $to_do_list->message = $request->message;
        $to_do_list->save();

        foreach ($request->select_customers as $ky => $val) {
            $user = User::find($val);
            $bugstatus['business_name'] = $user->first_name;
            $bugstatus['message'] = $request->message;
            Mail::to($user->email)->send(new ToDoListMail($bugstatus));
        }

        Session::flash('statuscode', 'info');
        return redirect('to_do_list')->with('status', 'Submitted.');
    }


    public function view_list($id)
    {
        $view_list = ToDoList::orderBy('id', 'asc')->where('id', $id)->first();

        $task_replies = TaskReply::orderBy('id', 'asc')->where('task_id', $id)->get();
        foreach ($task_replies as $replynote) :
            $replynote->date = \Carbon\Carbon::parse($replynote->created_at)->isoFormat('Do MMM YYYY');
        endforeach;

        return view("admin.super_admin.view_list", compact('view_list', 'task_replies'));
    }

    public function task_reply(Request $request)
    {
        $this->validate($request, [
            'task_reply' => ['required'],
        ]);

        $to_do_list = new TaskReply;
        $to_do_list->task_id = $request->task_id;
        $to_do_list->user_id = $request->user_id;
        $to_do_list->task_reply = $request->task_reply;
        $to_do_list->save();

        $user = User::find($request->user_id);
        $bugstatus['business_name'] = $user->first_name;
        $bugstatus['message'] = $request->task_reply;
        Mail::to($user->email)->send(new ToDoListMail($bugstatus));

        Session::flash('statuscode', 'info');
        return back()->with('status', 'Submitted.');
    }


    public function delete_task($id)
    {
        $task = ToDoList::where('id', $id)->delete();

        $success = true;
        $message = "Task deleted successfully";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function task_status(Request $request)
    {

        $staus_id = $request->staus_id;
        $taskid  = $request->taskid;

        $timeline = ToDoList::find($taskid);

        if (!is_null($timeline)) {

            $timeline->status = $staus_id;
            $timeline->update();

            $user =  User::find($timeline->user_id);
            $dataList['taskid'] = $taskid;
            $dataList['status_id'] = $staus_id;

            Mail::to($user->email)->send(new TaskMail($dataList));
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
        $faq = ToDoList::find($id);

        if (!is_null($faq)) {
            $faq->delete();

            Session::flash('statuscode', 'info');
            return back()->with('status', 'Task deleted successfully');
        } else {
            Session::flash('statuscode', 'info');
            return back()->with('status', 'Task has not been deleted!.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

        $faq = ToDoList::find($id);

        if (!is_null($faq)) {
            $faq->delete();

            Session::flash('statuscode', 'info');
            return redirect('faq')->with('status', 'Task deleted successfully');
        } else {
            Session::flash('statuscode', 'info');
            return redirect('faq')->with('status', 'Task has not been deleted!.');
        }
    }
}
