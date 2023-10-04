<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\EmployeeUpdate;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeUpdateMail;
use Session;

class EmployeeUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_time = Carbon::now()->toDateString();
        $update_list = EmployeeUpdate::where('user_id',auth()->user()->id)->where('update_time',$current_time)->first();
        $type = 1;
        return view("admin.team.employee_update",compact('update_list','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_updates_list()
    {
        $users = User::where('parent_id', 0)->where('role_id', '4')->orderBy('id', 'desc')->get();
        return view('admin.super_admin.employee_updates_list', compact('users'));
    }

    

    public function show_employee_updates($id)
    {
        $employee_updates = EmployeeUpdate::where('user_id', $id)->paginate(5);
        return view('admin.super_admin.show_employee_updates', compact('employee_updates'));
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
            'updates'=>'required|string',
        ]);
        $current_time = Carbon::now()->toDateString();
        $employee_update_list = EmployeeUpdate::where('user_id',$request->user_id)->where('update_time',$current_time)->first();
        if(!is_null($employee_update_list))
        {
      
        Session::flash('statuscode','info');
        return back()->with('status','You already send mail today !!');  

        }else{
            $employee_update = new EmployeeUpdate;
            $employee_update->user_id = $request->user_id;
            $employee_update->updates = $request->updates;
            $employee_update->update_time = $current_time;

            if($employee_update->save()){
                $user = User::find($request->user_id);
                $employee_update['user_name'] = $user->first_name;
                $employee_update['updates'] = $request->updates;
                Mail::to('sameer.ece564@gmail.com')->cc('admin@smartitventures.com')->send(new EmployeeUpdateMail($employee_update));  
                Session::flash('statuscode','info');
                return back()->with('status','Submitted!!');
            }
            else
            {
                Session::flash('statuscode','info');
                return back()->with('status','Something went wrong !!');  
            }
            
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
        $EmployeeUpdate = EmployeeUpdate::find($id);

        if(!is_null($EmployeeUpdate))
        {
            $EmployeeUpdate->delete();
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Deletted!!');
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Something went wrong !!');
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
        $update = EmployeeUpdate::find($id);
        $update_list = EmployeeUpdate::first();
        $type = 2;
        return view('admin.team.employee_update', compact('update', 'update_list', 'type'));
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
            'updates'=>'required|string',
        ]);
        $current_time = Carbon::now()->toDateString();
        $employee_update = EmployeeUpdate::find($id);
        $employee_update->user_id = $request->user_id;
        $employee_update->updates = $request->updates;
        $employee_update->update_time = $current_time;
        if($employee_update->save())
        {          
            $user = User::find($request->user_id);

            $employee_update['user_name'] = $user->first_name;
            $employee_update['updates'] = $request->updates;

            Mail::to('sameer.ece564@gmail.com')->cc('admin@smartitventures.com')->send(new EmployeeUpdateMail($employee_update));  
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Submitted!!');    
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Something went wrong !!');  
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
        $EmployeeUpdate = EmployeeUpdate::find($id);

        if(!is_null($EmployeeUpdate))
        {
            $EmployeeUpdate->delete();
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Deletted!!');
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('employee_update')->with('status','Something went wrong !!');
        }
    }
}
