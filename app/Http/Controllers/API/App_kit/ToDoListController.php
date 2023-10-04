<?php

namespace App\Http\Controllers\API\App_kit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\ToDoList;
use App\TaskReply;
use App\app_chat_images;
use App\Mail\ToDoListMail;
use App\Mail\TaskMail;
use Session;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class ToDoListController extends Controller
{

    public function index()
    {
        $all_users = User::where('role_id', 2)->get();

        $todo_lists = ToDoList::orderBy('id', 'desc')->where('user_ids', 'like', '%' . Auth::user()->id . '%')->get();
        $send_lists = ToDoList::where('owner_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return response()->json(['status' => True, "payload" => $todo_lists, "data" => $send_lists, "manager" => $all_users]);
    }


    public function store(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
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

            return response()->json(['status' => True, "message" => "Submitted"]);
        }
    }

    public function view_list(Request $request)
    {

        $id = $request->id;

        $task_replies = TaskReply::orderBy('id', 'desc')->where('task_id', $id)->get();
        if (count($task_replies) > 0) {
            foreach ($task_replies as $replynote) :
                $replynote->date = \Carbon\Carbon::parse($replynote->created_at)->isoFormat('Do MMM YYYY');
            endforeach;

            return response()->json(['status' => True, "payload" => $task_replies,]);
        } else {
            return response()->json(['status' => False, "payload" => "No Replies"]);
        }
    }

    public function task_reply(Request $request)
    {
        $rules = [
            'task_reply' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'task_reply' => $validator->errors()->first()]);
        } else {

            $to_do_list = new TaskReply;
            $to_do_list->task_id = $request->task_id;
            $to_do_list->user_id = $request->user_id;
            $to_do_list->task_reply = $request->task_reply;
            $to_do_list->save();

            $user = User::find($request->user_id);
            $bugstatus['business_name'] = $user->first_name;
            $bugstatus['message'] = $request->task_reply;

            Mail::to($user->email)->send(new ToDoListMail($bugstatus));

            return response()->json(['status' => True, "message" => "Submitted"]);
        }
    }
    public function delete_task(Request $request)
    {
        $id = $request->id;
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

        $staus_id = $request->status_id;
        $taskid  = $request->id;
        $timeline = ToDoList::find($taskid);

        if (!is_null($timeline)) {

            $timeline->status = $staus_id;
            $timeline->update();
            $user =  User::find($timeline->user_id);
            $dataList['taskid'] = $taskid;
            $dataList['status_id'] = $staus_id;

            Mail::to($user->email)->send(new TaskMail($dataList));
            return response()->json(['status' => True, "message" => "Status Updated"]);
        }
    }


    public function ChatImages(Request $request)
    {

        $rules = [
            'images' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'images' => $validator->errors()->first()]);
        } else {

            $user = new app_chat_images;
            $user->user_id = $request->user_id;
            $image = $request->file('images');
            if ($image) {
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image_full_name = 'img_' . $name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($image));
                $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                $user->images = $url;
            }
            $user->save();
            return response()->json(['status' => True, "message" => "Image Save",  "payload" => $user]);
        }
    }
}
