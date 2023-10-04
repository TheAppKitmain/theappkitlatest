<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        if(Auth::user()->role->name == 'custom')
        {
            return "custom";
            return redirect('/home');
        }

        else if(Auth::user()->role->name == 'admin')
        {
            return "admin";   
            return redirect()->route('admin.index');
        }
        
        else
        {
            return "dashboard";   
            return redirect('/dashboard');
        }
    }

    public function blogs()
    {
        dd("sss");
        //return view ('appkit_frontend.contact');

    }
}
