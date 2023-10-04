<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usertheme;
use App\Models\Template\TempPrivacyPolicy;
use App\ThemeTemplate;

class EcommerceThemeController extends Controller
{
    public function ecommerce_theme() 
    { 
        $themetemplate = ThemeTemplate::all();

        if(count($themetemplate) == 0){
            return response()->json(['status'=>False,'ecommerce_themes' => $themetemplate]);
        }
        else{
            return response()->json(['status'=>True,'ecommerce_themes' => $themetemplate]);
        }
    }

    public function usertheme() 
    { 
        $usertheme = Usertheme::all();

        if(count($usertheme) == 0){
            return response()->json(['status'=>False,'user_themes' => $usertheme]);
        }
        else{
            return response()->json(['status'=>True,'user_themes' => $usertheme]);
        }

    }

    public function privacy_policy() 
    { 
        $privacy_policy = TempPrivacyPolicy::all();

        if(count($privacy_policy) == 0){
            return response()->json(['status'=>False,'privacy_policy' => $privacy_policy]);
        }
        else{
            return response()->json(['status'=>True,'privacy_policy' => $privacy_policy]);
        }

    }


}
