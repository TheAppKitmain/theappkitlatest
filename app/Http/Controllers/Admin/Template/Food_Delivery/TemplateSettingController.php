<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usertheme;
use App\Models\Template\E_Commerce\SplashScreen;
use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Models\Template\E_Commerce\TempLoginSetting;
use App\Models\Template\E_Commerce\TempSignupSetting;
use App\Models\Template\E_Commerce\ProductCategory;
use App\Models\Template\E_Commerce\AppSetting;
use App\Models\Template\E_Commerce\Shipping;
use App\Models\Template\Food_Delivery\FoodProductInformation;
use App\Models\Template\Food_Delivery\FoodProductImage;
use App\Models\Template\Food_Delivery\FoodWorkingDay;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodBanner;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;
use App\ThemeTemplate;
use Auth;
use DB;
use Session;

class TemplateSettingController extends Controller
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

        $theme_code = session('theme_code');
        
        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $splashscreen = SplashScreen::where('user_id', $id)->where('template_id', $template_id)->first();
        $temploginsetting = TempLoginSetting::where('user_id', $id)->where('template_id', $template_id)->first();
        $tempsignupsetting = TempSignupSetting::where('user_id', $id)->where('template_id', $template_id)->first();
        $banner = FoodBanner::where('owner_id', $id)->where('template_id', $template_id)->get();    
        $parents = FoodCategory::where('parent_id',0)->where('owner_id', $id)->where('template_id', $template_id)->get(['id','name']);
        $categories = FoodCategory::where('parent_id','0')->where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
        $subcategories = FoodCategory::where('status','active')->where('owner_id', $id)->where('template_id', $template_id)->whereParentId($id)->get();
        $another_categories = FoodCategory::where('status','active')->where('owner_id', $id)->where('template_id', $template_id)->with('children')->whereNotIn('id',[$id])->whereParentId(0)->get();
        $ids = $subcategories->pluck('id')->toArray();
        $cat_id = (integer)$id;

        array_unshift($ids,$cat_id);

        $products = FoodProduct::whereRaw('FIND_IN_SET(?,category_id)', [$ids])->where('owner_id', $id)->where('template_id', $template_id)->orderByRaw('position = 0', 'ASC', 'position')->get();

        $food_products = FoodProduct::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
        if(count($food_products)>0)
        {
            foreach($food_products as $product)
            {
                $cat = explode(',',$product->category_id);
                $parent_id = FoodCategory::whereParentId(0)->whereIn('id',$cat)->first();
                $cat_name = FoodCategory::findMany($cat);
                $name = $cat_name->pluck('name')->toArray();
                $product->category_name = implode(',',$name);
                $product->cat_id =  $parent_id->id ?? "";
            }
        }

        }
        else{
            Auth::logout();
            return redirect('login');
        }

        if($theme_code == 'yummy-restuarant_5ELQQ8'){

            return view('admin.template.Food_Delivery.themes.car_wash',compact('splashscreen','banner','themetemplate','temploginsetting','parents','products','food_products','subcategories','another_categories','categories','tempsignupsetting'));
        }

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

        $user_id = auth()->user()->id;
        $themetemplate = ThemeTemplate::where('id', $id)->first();
              
        session()->put('theme_id',$id);
        
        session()->put('theme_code', $themetemplate->theme_code);

        $splashscreen = SplashScreen::where('user_id', $user_id)->where('template_id', $id)->first();
        $temploginsetting = TempLoginSetting::where('user_id', $user_id)->where('template_id', $id)->first();
        $tempsignupsetting = TempSignupSetting::where('user_id', $user_id)->where('template_id', $id)->first();
        $banner = FoodBanner::where('owner_i d', $user_id)->where('template_id', $id)->get();
        $parents = FoodCategory::where('parent_id',0)->where('owner_id', $user_id)->where('template_id', $id)->get(['id','name']);
        $categories = FoodCategory::where('parent_id','0')->where('owner_id', $user_id)->where('template_id', $id)->orderBy('id','desc')->get();
        $subcategories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $id)->whereParentId($id)->get();
        $another_categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $id)->with('children')->whereNotIn('id',[$id])->whereParentId(0)->get();
        $ids = $subcategories->pluck('id')->toArray();
        $cat_id = (integer)$id;
        array_unshift($ids,$cat_id);

        $products = FoodProduct::whereIn('category_id', $ids)->where('owner_id', $user_id)->where('template_id', $id)->get();

        $food_products = FoodProduct::orderBy('id','desc')->where('owner_id', $user_id)->where('template_id', $id)->get();
        if(count($food_products)>0)
        {
            foreach($food_products as $product)
            {
                $cat = explode(',',$product->category_id);
                $parent_id = FoodCategory::whereParentId(0)->whereIn('id',$cat)->first();
                $cat_name = FoodCategory::findMany($cat);
                $name = $cat_name->pluck('name')->toArray();
                $product->category_name = implode(',',$name);
                $product->cat_id =  $parent_id->id ?? "";
            }
        }
 
        if($themetemplate->theme_code == 'yummy-restuarant_5ELQQ8'){
             return view('admin.template.Food_Delivery.themes.car_wash',compact('splashscreen','banner','themetemplate','temploginsetting','parents','products','food_products','subcategories','another_categories','categories','tempsignupsetting'));
        }
    }


    public function working_days(Request $request)
    {
        if($request->isMethod('get')):
           
            $days = FoodWorkingDay::get();
          
            return view('admin.template.Food_Delivery.working_days.index',compact('days'));

        endif;

        if($request->isMethod('post')):

                foreach($request->status as $key=>$value)
                { 
                    $update = FoodWorkingDay::whereDayId($key)->update([
                        'owner_id'=>$request->owner_id,
                        'start_time'=>$request->start_time[$key],
                        'end_time'=>$request->end_time[$key],
                        'status'=>$value
                    ]);
                }  
                
            return redirect()->route('theme.working_days')->with(['alert'=>'success','message'=>'Working Days has been successfully updated!.']);
            
        endif;
    }



    public function add_product_page(Request $request,$id)
	{

        if($request->isMethod('get')):

            $user_id = auth()->user()->id;
            $template_id = session('theme_id');

            if(session('theme_id') != null){

            $themetemplate = ThemeTemplate::where('id', $template_id)->first();          
            $splashscreen = SplashScreen::where('user_id', $user_id)->where('template_id', $template_id)->first();
            $temploginsetting = TempLoginSetting::where('user_id', $user_id)->where('template_id', $template_id)->first();
            $tempsignupsetting = TempSignupSetting::where('user_id', $user_id)->where('template_id', $template_id)->first();
            $banner = FoodBanner::where('owner_id', $user_id)->where('template_id', $template_id)->get();
            $parents = FoodCategory::where('parent_id',0)->where('owner_id', $user_id)->where('template_id', $template_id)->get(['id','name']);
    		$categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId(0)->orderBy('id','asc')->get();
    		$subcategories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId($id)->get();
            $another_categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->with('children')->whereNotIn('id',[$id])->whereParentId(0)->get();
            $ids = $subcategories->pluck('id')->toArray();
            $cat_id = (integer)$id;
            array_unshift($ids,$cat_id);

            $products = FoodProduct::whereRaw('FIND_IN_SET(?,category_id)', [$ids])->where('owner_id', $user_id)->where('template_id', $template_id)->orderByRaw('position = 0', 'ASC', 'position')->get();

            $food_products = FoodProduct::orderBy('id','desc')->where('owner_id', $user_id)->where('template_id', $template_id)->get();
                if(count($food_products)>0)
                {
                    foreach($food_products as $product)
                    {
                        $cat = explode(',',$product->category_id);
                        $parent_id = FoodCategory::whereParentId(0)->whereIn('id',$cat)->first();
                        $cat_name = FoodCategory::findMany($cat);
                        $name = $cat_name->pluck('name')->toArray();
                        $product->category_name = implode(',',$name);
                        $product->cat_id =  $parent_id->id ?? "";
                    }
                }
            }

            else{
                Auth::logout();
                return redirect('login');
            }
            if($themetemplate->theme_code == 'yummy-restuarant_5ELQQ8'){
    		return view('admin.template.Food_Delivery.themes.car_wash',compact('splashscreen','banner','food_products','themetemplate','temploginsetting','tempsignupsetting','parents','categories','products','subcategories','another_categories','themetemplate'));
            }else{
            return view('admin.template.Food_Delivery.themes.yummy_restaurants',compact('splashscreen','food_products','themetemplate','temploginsetting','tempsignupsetting','parents','categories','products','subcategories','another_categories','themetemplate'));    
            }
        endif;
        
        if($request->isMethod('post')):

            if(isset($request->is_continoue) && !is_null($request->is_continoue)):
            $validator = Validator::make($request->all(),[

            ]);
            else:
                $validator = Validator::make($request->all(),[
                    'product_name'=>"unique:food_products,product_name",

                ]);
            endif;

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()]);
            }
            if(!empty($request->subcategory_id) && (!is_null($request->subcategory_id))):
            $category_id = implode(',',$request->subcategory_id);
            $request->category_id = implode(',',array($category_id,$request->category_id));
            endif;
            $product = new FoodProduct;
            $product->template_id = $request->template_id;
            $product->owner_id = $request->owner_id;
            $product->product_type = $request->product_type;
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->price = $request->price ?? 0;
            $product->product_stock = $request->product_stock ?? 0;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->status = $request->status;

            $image = $request->file('product_image');
            if($image)
            {
                $name = time().'.'.$image->getClientOriginalExtension();
                $image_full_name = 'img_'.$name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                $product->product_image = $url;
            }
            if($product->save())
            {
                if(isset($request->product_images)):
                    if($request->hasFile('product_images')):
                        foreach($request->file('product_images') as $image)
                        {
                            $name = time().'.'.$image->getClientOriginalExtension();
                            $image_full_name = 'img_'.$name;
                            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                            Storage::disk('s3')->put($filePath, file_get_contents($image));
                            $image_url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;

                            FoodProductImage::create([
                                'product_id'=>$product->id,
                                'product_image'=>$image_url
                            ]);
                        }
                    endif;
                endif;
                if((!empty($request->attr))&&(!empty($request->product_price)))
                {
                    for($i=0;$i<count($request->attr);$i++)
                    {
                        $attr = $request->attr[$i];
                        $price = $request->product_price[$i];
                        if(!is_null($attr) && (!is_null($price)) ):
                        FoodProductInformation::create([
                            'attribute_name'=>$attr,
                            'product_price'=>$price,
                            'product_id'=>$product->id
                        ]);
                        endif;
                    }
                }

                \Session::flash('message', 'Product has been created successfully!.');
                \Session::flash('alert', 'success');
                return response()->json(['status'=>true]);
            }
            else
            {
                \Session::flash('message', 'Product has not been created successfully!.');
                \Session::flash('alert', 'danger');
                return response()->json(['status'=>true]);
            }
        endif;
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
