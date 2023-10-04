<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\webbug;
use Session;
use App\User;

class WebBugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$id=session('user_id');
        $main_id =  config('helper.dev_appkit_developer');
        $user_id = explode(",", $main_id);


        $webbugs = webbug::where('user_id', $main_id)->get();
        return view('admin.super_admin.web-update', compact('webbugs'));
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
        $main_id =  config('helper.dev_appkit_developer');
        $user_id = explode(",", $main_id);

        $id = [];
        $bug_type = $request->bug_type;
        $bug_descriptions = $request->bug_description;
        $status = $request->status;
        if (count($request->bug_description) > 0) {
            foreach ($request->bug_description as $ky => $val) {
                $bug = new webbug;
                $bug->bug_description = $val;
                $bug->bug_type = $bug_type[$ky];
                $bug->status = $status[$ky];
                $bug->user_id = $main_id;
                if (!empty($request->bug_screenshot)) {
                    foreach ($request->file('bug_screenshot') as $key => $value) {
                        if ($ky == $key) {
                            $image_name = date('dmy_H_s_i');
                            $ext = strtolower($value->getClientOriginalExtension());
                            $image_full_name = $image_name . '_' . $key . '.' . $ext;
                            $upload_path = 'media/';
                            $image_url = $upload_path . $image_full_name;
                            $success = $value->move($upload_path, $image_full_name);

                            $bug->bug_screenshot = $image_url;
                        }
                    }
                }

                $bug->save();
                $id[] = $bug->id;
            }
        }
        //return $id;

        session::flash('statuscode', 'info');
        return back()->with('status', 'Data is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $webbugs = webbug::where('user_id', $id)->get();

        return view('admin.super_admin.web-update', compact('webbugs', 'user'));
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
    public function custom_delete($id)
    {
        $webbugs = webbug::find($id);
        if (!is_null($webbugs)) {
            $webbugs->delete();
            $success = true;
            $message = "Task deleted successfully";
        } else {
            $success = true;
            $message = "Something went wrong";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
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

    public function bugstatus(Request $request)
    {
        $staus_id = $request->staus_id;
        $bugId  = $request->taskid;

        $web_bug = webbug::find($bugId);

        if (!is_null($web_bug)) {

            $web_bug->status = $staus_id;
            $web_bug->update();
            return 0;
        }
    }
}
