<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use App\Models\Template\Food_Delivery\FoodAppUser;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\E_Commerce\AppUser;
use Illuminate\Support\Facades\Storage; 
use Auth;
use Session;
use App\ThemeTemplate;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shops(Request $request)
    {

         $postcode = str_replace(' ', '', $request->shop_location);

        if($request->isMethod('get'))
        {
            
        $id = auth()->user()->id;
        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $shop = FoodShop::first();

        }
        else{
            Auth::logout();
            return redirect('login');
        }
            return view('admin.template.Food_Delivery.food_shop',compact('shop','themetemplate'));
        }
        if($request->isMethod('post'))
        {
            $foodshop = FoodShop::where( 'app_user_id', $request->user_id)->where('template_id', $request->template_id)->first();
            $app_user = AppUser::where('owner_id',$request->user_id)->where('template_id', $request->template_id)->first();

            if(is_null($foodshop)){

                $data = array();
                $data['app_user_id'] = $app_user->id;
                $data['template_id'] = $request->template_id;
                $data['shop_name'] = $request->shop_name;
                $data['shop_descrption'] = $request->shop_descrption;
                $data['shop_location'] = $request->shop_location;
                $data['shop_lat'] = $request->shop_lat;
                $data['shop_long'] = $request->shop_long;
                $data['currency'] = $request->currency;
                $data['currency_symbol'] = $request->currency_symbol;
                $data['delivery_charges'] = $request->delivery_charges;
                $data['status'] = $request->status;
                $shop_image = $request->file('shop_image');

                if ($shop_image) {

                $name = time().'.'.$shop_image->getClientOriginalExtension();
                $image_full_name = 'img_'.$name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($shop_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                $data['shop_image'] = $url;
                }
               
                $appuser = FoodShop::create($data);
             
            }else{

                $data = array();
                $data['app_user_id'] = $request->user_id;
                $data['template_id'] = $request->template_id;
                $data['shop_name'] = $request->shop_name;
                $data['shop_descrption'] = $request->shop_descrption;
                $data['shop_location'] = $request->shop_location;
                $data['shop_lat'] = $request->shop_lat;
                $data['shop_long'] = $request->shop_long;
                $data['currency'] = $request->currency;
                $data['currency_symbol'] = $request->currency_symbol;
                $data['delivery_charges'] = $request->delivery_charges;
                $data['status'] = $request->status;
                $shop_image = $request->file('shop_image');

                if ($shop_image) {

                $name = time().'.'.$shop_image->getClientOriginalExtension();
                $image_full_name = 'img_'.$name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($shop_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                $data['shop_image'] = $url;
                }
               
                $appuser = FoodShop::where('app_user_id',$request->user_id)->update($data);


            }
         
            session::flash('statuscode','info');
            return back()->with('status','Shop information has been updated successfully!.');
            
        }
    }
}
