<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Faq;
use Illuminate\Http\Request;
use Session;

class FaqController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('position','asc')->get();
        return view('admin.super_admin.faq.index',compact('faqs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.super_admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,['question'=>"required", 'answer'=>"required"]);
        $faq = new Faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if($faq->save())
        {          
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has been created successfully!.');    
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has not been created!.');  
        }
    }


    public function position(Request $request, $id)
    {
        $faq = Faq::find($id);

        $faq->position = $request->position;
        if($faq->save())
        {
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has been updated successfully!.'); 
  
          
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Not Found.');
  
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
        $faq = Faq::find($id);
        return view('admin.super_admin.faq.edit',compact('faq'));
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
        $this->validate($request,['question'=>"required", 'answer'=>"required"]);
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if($faq->save())
        {   
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has been updated successfully!.');    
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has not been updated!.');      
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
        $faq = Faq::find($id);

        if(!is_null($faq))
        {
            $faq->delete();
            
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has been deleted successfully!.');
        }
        else
        {
            Session::flash('statuscode','info');
            return redirect('faq')->with('status','Faq has not been deleted!.');
        }
    }
}
