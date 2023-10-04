<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\SquareCredentials;
use App\ThemeTemplate;
use Session;

class ECommSquareCredentialsController extends Controller
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
        $squares = SquareCredentials::orderBy('id','desc')->where('user_id', $id)->where('template_id', $template_id)->paginate(6);
        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.Food_Delivery.square.index',compact('squares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.Food_Delivery.square.create', compact('themetemplate'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesquare(Request $request)
    {

        $square = new SquareCredentials;
        $square->user_id = $request->user_id;
        $square->template_id = $request->template_id;
        $square->square_key = $request->square_key;
        $square->square_token = $request->square_token;
        $square->save();

        session::flash('statuscode','info');
        return redirect('theme/square')->with('status','Data is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SquareCredentials  $SquareCredentials
     * @return \Illuminate\Http\Response
     */
    public function show(SquareCredentials $SquareCredentials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SquareCredentials  $SquareCredentials
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $square = SquareCredentials::findOrFail($id);
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.Food_Delivery.square.edit', compact('themetemplate','square'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SquareCredentials  $SquareCredentials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

        {
            $this->validate($request,['square_key'=>'unique:square_credentials,square_key,'.$id]);
            $square= SquareCredentials::find($id);
            $square->user_id = $request->user_id;
            $square->template_id = $request->template_id;
            $square->square_key = $request->square_key;
            $square->square_token = $request->square_token;
            $square->update();

            session::flash('statuscode','info');
            return redirect('theme/square')->with('status','Data is Updated');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SquareCredentials  $SquareCredentials
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $squares = SquareCredentials::where('id',$id);
        $squares->delete();
        Session::flash('statuscode','info');
        return redirect('theme/square')->with('status','Square is Deleted');
    }
}
