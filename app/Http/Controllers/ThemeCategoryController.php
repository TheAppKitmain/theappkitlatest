<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThemeCategory;
use App\ThemeTemplate;
use App\Models\Template\E_Commerce\E_commerce_theme;
use App\Usertheme;
use Auth;
use Session;

class ThemeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

    }
    

    public function register_theme($slug,Request $request)
    {
        
        if(!Auth::check())
        {

            $theme = ThemeTemplate::whereSlug($slug)->first();
            return view('auth.register',compact('theme'));
        }

        else
        {
            $theme_id = ThemeTemplate::whereSlug($slug)->pluck('id');
            session()->put('slug', $slug);

            if(Auth::user()->parent_id == 0){
                $user_id = auth()->user()->id;
                $user_theme = \App\Usertheme::where('user_id',$user_id)->where('template_id',$request->theme_id)->count();
            }else{
                $user_id =  Auth::user()->parent_id;
                $user_theme = \App\Usertheme::where('user_id',$user_id)->where('template_id',$request->theme_id)->count();
            }    
            
            if($user_theme == 0)
            {
                \App\Usertheme::create([                    
                    'user_id' => $user_id,
                    'template_id' => $request['theme_id'],
                    'user_template' => $request['theme_name'],
                    'user_category' => $request['category_id'],
                ]);

                E_commerce_theme::create([
                    'owner_id' => $user_id,
                    'template_name' => $request['theme_name'],
                    'template_id' => $request['theme_id'],
                ]);
    
                if(Auth::user()->role->name == 'admin')
                {
                    return redirect()->route('super_admin');
                }else{
                    return redirect('myapp');
                }

            }
            
            else
            {
             if(Auth::user()->role->name == 'admin')
                {
                    return redirect()->route('super_admin');
                }else{
                    return redirect('myapp');
                }

            }
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
}
