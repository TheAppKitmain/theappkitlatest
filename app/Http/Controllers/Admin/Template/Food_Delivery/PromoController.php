<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\FoodPromo;
use App\ThemeTemplate;
use Auth;
use Session;

class PromoController extends Controller
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

            $promos = FoodPromo::orderBy('id','desc')->where('owner_id', $id)->where('template_id', $template_id)->get();
            return view('admin.template.Food_Delivery.promo.index',compact('promos'));

        }
        else{
            Auth::logout();
            return redirect('login');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->user()->id;
        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();

        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.Food_Delivery.promo.create',compact('themetemplate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[ 'promo_code'=>'required|unique:food_promos' ]);
        $promo = new FoodPromo;
        $promo->owner_id = $request->user_id;
        $promo->template_id = $request->template_id;
        $promo->promo_code = $request->promo_code;
        $promo->description = $request->description;
        $promo->promo_type = $request->promo_type;
        $promo->user_limit = $request->user_limit;
        $promo->discount = $request->discount ?? 0;
        $promo->amount = $request->amount ?? 0;
        $promo->cart_amount = $request->cart_amount ?? 0;
        $promo->status = $request->status;

        if($promo->save())
        {
            session::flash('statuscode','info');
            return back()->with('status','Promo has not been created successfully!.');
        }
        else
        {
            session::flash('statuscode','info');
            return back()->with('status','Promo has not been created successfully!.');
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
        $promo = FoodPromo::find($id);
        return view('admin.template.Food_Delivery.promo.edit',compact('promo'));
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
        $this->validate($request,[ 'promo_code'=>'required|unique:food_promos,promo_code,'.$id ]);

        $promo = FoodPromo::find($id);
        $promo->promo_code = $request->promo_code;
        $promo->description = $request->description;
        $promo->promo_type = $request->promo_type;
        $promo->user_limit = $request->user_limit;
        $promo->discount = $request->discount ?? 0;
        $promo->amount = $request->amount ?? 0;
        $promo->cart_amount = $request->cart_amount ?? 0;
        $promo->status = $request->status;

        if($promo->save())
        {
            session::flash('statuscode','info');
            return redirect()->route('theme.food_promo.index')->with('status','Promo code has been updated successfully!.');
           
        }
        else
        {
            session::flash('statuscode','info');
            return redirect()->route('theme.food_promo.index')->with('status','Promo code has not been updated!.');
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
        $promo = FoodPromo::find($id);
        if(!is_null($promo))
        {
            $promo->delete();
            
            session::flash('statuscode','error');
            return back()->with('status','Promo code has been removed successfully!.');
            
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Promo code has been not removed successfully!.');
        }
    }
}