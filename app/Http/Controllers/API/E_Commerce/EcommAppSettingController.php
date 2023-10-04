<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use App\Models\Template\E_Commerce\AppSetting;
use Illuminate\Http\Request;

class EcommAppSettingController extends Controller
{
    public function index() 
    { 
        $appsetting = AppSetting::all();
        return response()->json(['success' => $appsetting]);

    }
}
