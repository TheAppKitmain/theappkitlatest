<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class TemplateuserController extends Controller
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
        $user = User::findorfail($id);
        return view('admin.template.edit_user', compact('user'));
    }

    public function new_user(Request $request){
        if($request->isMethod('get')):
            $user = Auth::user();
            $all_developers = User::where('parent_id',$user->id)->orderBy('id','desc')->get();
            return view('admin.template.new_user',compact('all_developers','user'));
        endif;
        if($request->isMethod('post')):
            $customer = Auth::user();
              $this->validate($request,[
                'number' => ['required','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
              ]);
              $user = new User;
              $user->first_name = $request->manager_name;
              $user->role_id = $request->role_id;
              $user->business_name = $customer->business_name;
              $user->email = $request->email;
              $user->number = $request->number;
              $user->country = $customer->country;
              $user->user_type = $customer->user_type;
              $user->parent_id = $customer->id;
              $user->password = Hash::make($request->password);
              $user->is_email_verified = 1;
              if($user->save()){
                session::flash('statuscode','info');
                return back()->with('status','Data is Added');
              } else {
                session::flash('statuscode','error');
                return back()->with('status','Something went wrong');
              }
        endif;
    }

    public function edit_customer_user($id){
        $project_manager = User::where('id', $id)->first();
        $user = Auth::user();
        $all_developers = User::where('parent_id',$user->id)->orderBy('id','desc')->get();
        if(is_null($project_manager)){
            session::flash('statuscode','error');
            return back()->with('error','No User Found');
        } else {
            return view('admin.template.edit_customer_user',compact('project_manager','all_developers'));
        }
    }

    public function update_customer_user(Request $request,$id){
        $project_manager = User::find($id);
        if(!is_null($project_manager)){
        
            $this->validate($request,[
              'number' => ['required','unique:users,number,'.$id],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
            ]);
            $project_manager->first_name = $request->manager_name;
            $project_manager->email = $request->email;
            $project_manager->number = $request->number;
            if($request->has('password')){
              $project_manager->password = Hash::make($request->password);
            }
            if($project_manager->update()){
                session::flash('statuscode','info');
                return back()->with('status','Data is Updated');
            } else {
                session::flash('statuscode','error');
                return back()->with('status','Something went wrong');
            }
        } 
        else 
        {
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
        }
    }

    public function delete_user($id){
        $project_manager = User::find($id);
   
       if(!is_null($project_manager)){
           $project_manager->delete(); 
           session::flash('statuscode','info');

           return back()->with('status','Deleted successfully');
       } else {
           session::flash('statuscode','error');
           return back()->with('status','Something went wrong');
       }
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
        $data = array();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['number'] = $request->phone_number;
        $data['country'] = $request->country;
        $user = User::where('id',$id)->update($data);
        session::flash('statuscode','info');
        return redirect('my-temp-account')->with('status','User is updated');

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
