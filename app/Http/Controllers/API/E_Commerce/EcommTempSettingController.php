<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use App\Models\Template\E_Commerce\SplashScreen;
use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Models\Template\E_Commerce\ProductAttribute;
use App\Models\Template\E_Commerce\ProductVariation;
use App\Models\Template\E_Commerce\ProductCategory;
use App\Models\Template\E_Commerce\TempLoginSetting;
use App\Models\Template\E_Commerce\TempSignupSetting;
use App\Models\Template\E_Commerce\EcommerceProductFavorite;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\TempPrivacyPolicy;
use Validator;
use App\Models\Template\E_Commerce\AppUser;
use Auth;
use Illuminate\Http\Request;

class EcommTempSettingController extends Controller
{
    public function products(Request $request)
    {
        $products = Product::with('get_collection_name')->get();
        $productCategory = ProductCategory::all();
        $productAttribute = ProductAttribute::all();
        $productVariation = ProductVariation::all();

        $token = $request->header('Authorization');

        if(!empty($token)) {

            $app_user_id =  Auth::guard('app_user_api')->user()->id;

            if(count($products) > 0):
                foreach($products as $product){
                    $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();

                    if(!is_null($like)):
                        $product->favourite = 1;
                    else:
                        $product->favourite = 0;
                    endif;
                }
            endif;
        }

        return response()->json(array('product'=>$products,'productCategory'=>$productCategory,'productAttribute'=>$productAttribute,'productVariation'=>$productVariation));
    }

    public function searchproduct(Request $request)
    {
        $products = Product::with('get_collection_name')->get();
        $productCategory = ProductCategory::all();
        $productAttribute = ProductAttribute::all();
        $productVariation = ProductVariation::all();

        $token = $request->header('Authorization');

        if(!empty($token)) {

            $app_user_id =  Auth::guard('app_user_api')->user()->id;

            if(count($products) > 0):
                foreach($products as $product){

                    $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();

                    if(!is_null($like)):
                        $product->favourite = 1;
                    else:
                        $product->favourite = 0;
                    endif;
                }
            endif;
        }else{

            if(count($products) > 0):
                foreach($products as $product){
                   
                        $product->favourite = 0;
                }
            endif;

        }

        return response()->json(array('product'=>$products,'productCategory'=>$productCategory,'productAttribute'=>$productAttribute,'productVariation'=>$productVariation));
    }

    public function collections()
    {
        $collections = EcommerceCollection::all();
        foreach($collections as $collection){
            if($collection->collection_image !== null){

                $collection->collection_image = config('services.base_url').$collection->collection_image;
            }
            else{

                $collection->collection_image = $collection->collection_image;
            }
        }
        return response()->json(['success' => $collections]);

    }




    public function splashscreen()
    {
        $splashscreen = SplashScreen::all();
        return response()->json(['success' => $splashscreen]);

    }

    public function loginscreen()
    {
        $loginsettings = TempLoginSetting::all();
        return response()->json(['success' => $loginsettings]);

    }

    public function signupscreen()
    {
        $signupsettings = TempSignupSetting::all();
        return response()->json(['success' => $signupsettings]);

    }

    public function productsbycategories(Request $request)
    {
        $rules = [
            'cat_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails())
	    {
	      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
	    }
	    else
	    {

            $token = $request->header('Authorization');


            if(!empty($token)) {

            $app_user_id =  Auth::guard('app_user_api')->user()->id;
            $products = Product::where('collection_id', $request->cat_id)->get();

            if(count($products) > 0):
                foreach($products as $product){
                    $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();
                    if(!is_null($like)):
                        $product->favourite = 1;
                    else:
                        $product->favourite = 0;
                    endif;
                }
            endif;
        }
        else{

            $products = Product::where('collection_id', $request->cat_id)->get();
            if(count($products) > 0):
                foreach($products as $product){ 
                     
                        $product->favourite = 0; 
                }
            endif;

        }

            return response()->json(['success' => true, 'payload' => $products]);


        }

    }

    public function productsrange(Request $request)
    {
        $colors = []; $sizes = [];
        $rules = [ 'cat_id' => 'required' ];
        $validator = Validator::make($request->all(), $rules);
	    if ($validator->fails())
	    {
	      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
	    }
	    else
	    {
            $product_id = Product::where('collection_id', $request->cat_id)->pluck('id');
            $variations = ProductAttribute::whereIn('product_id',$product_id)->get();
            if(count($variations)>0)
            {
                foreach($variations as $variation)
                {
                    $push_colors = explode(',',$variation->variant_color);
                    foreach($push_colors as $col)
                    {
                        array_push($colors,$col);
                    }
                    $push_sizes = explode(',',$variation->variant_size);
                    foreach($push_sizes as $col)
                    {
                        array_push($sizes,$col);
                    }
                }
            }
            $new_colors = array_unique($colors);
            $new_data = array_values($new_colors);
            $new_sizes = array_unique($sizes);
            //$new_data_size = array_value($new_sizes);
            $colors = array_map("unserialize", array_unique(array_map("serialize", $new_data)));
            $sizes = array_map("unserialize", array_unique(array_map("serialize", $new_sizes)));
            $min_price = Product::where('collection_id', $request->cat_id)->get()->min('product_price');
            $max_price = Product::where('collection_id', $request->cat_id)->get()->max('product_price');
            $ranges = [];
            $currentRangeValue = $min_price;
            $step = 100;

            while ($currentRangeValue < $max_price)
            {
                $rangeStart = $currentRangeValue + 1;
                $currentRangeValue = $currentRangeValue + $step;

                $ranges[] = [$rangeStart,$currentRangeValue];
            }
            return response()->json(['success' => true, 'min_price' => $min_price, 'max_price' => $max_price,'colors'=>$colors,'sizes'=>$sizes,'price_range'=>$ranges]);
        }
    }


    public function productfavourite(Request $request)
    {
        $app_user_id =  Auth::guard('app_user_api')->user()->id;

        if(!is_null($app_user_id)):

            $rules = ['product_id' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
            }
            else
            {
                $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$request->product_id)->first();
                if(!is_null($like)){

                    $like->delete();
                    
                    $products = Product::where('collection_id', $request->cat_id)->get();

                    if(count($products) > 0):
                        foreach($products as $product){
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$request->product_id)->first();

                            if(!is_null($like)):

                                $product->favourite = 1;
                                
                            else:
                                $product->favourite = 0;
                            endif;

                        }
                    endif;

                    return response()->json(['status' => true,'products' => $products,'message' => 'unliked']);

                } else {

                    $product_favourite = new EcommerceProductFavorite;
                    $product_favourite->app_user_id = $app_user_id;
                    $product_favourite->product_id = $request->product_id;
                    $product_favourite->save();

                    $products = Product::where('collection_id', $request->cat_id)->get();

                    if(count($products) > 0):
                        foreach($products as $product){
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$request->product_id)->first();
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
                        }
                    endif;

                    return response()->json(['status' => true,'products' => $products,'message' => 'liked']);
                }
            }

        else:
            return response()->json(['status' => false,'message' => 'user not found']);
        endif;

    }

    public function productbycat_login(Request $request) {
        $app_user_id =  Auth::guard('app_user_api')->user()->id;

        if(!is_null($app_user_id)):
            $rules = [ 'cat_id' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
              return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            }
            else
            {
                $products = Product::where('collection_id', $request->cat_id)->get();

                    if(count($products) > 0):
                        foreach($products as $product){
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
                        }
                    endif;

                return response()->json(['success' => true, 'payload' => $products]);
            }
        else:
            return response()->json(['status' => false,'message' => 'user not found']);
        endif;

    }

    public function show_favourite() {

        $app_user_id =  Auth::guard('app_user_api')->user()->id;
        $product_id = EcommerceProductFavorite::where('app_user_id',$app_user_id)->pluck('product_id');
        $products = Product::whereIn('id', $product_id)->get();
        return response()->json(['success' => true, 'payload' => $products]);

    }

    public function productdetails(Request $request)
    {
        $data=[]; $variation_color=[]; $variation_size=[];
        $rules = [ 'product_id' => ['required'] ];
        $validator = Validator::make($request->all(), $rules);
	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {

        $product = Product::find($request->product_id);    
        $token = $request->header('Authorization');
        
        
            if(!is_null($product))
            {

                if(!empty($token)) {

                $app_user_id =  Auth::guard('app_user_api')->user()->id;
                $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$request->product_id)->first();
    
                if(!is_null($like)):
                    $favourite = 1;
                else:
                    $favourite = 0;
                endif;
                
                $product_attributes = ProductAttribute::where('product_id', $product->id)->get();

                if(count($product_attributes)>0)
                {
                    foreach($product_attributes as $attribute)
                    {
                        $colors = explode(',', $attribute->variant_color);
                        $size = explode(',',$attribute->variant_size);
                        foreach($colors as $key=>$color)
                        {
                            array_push($variation_color,$color);
                            array_unique($variation_color);
                            foreach($size as $sz)
                            {
                                $variant = $color."/".$sz;
                                $variations = ProductVariation::where('product_id',$request->product_id)->where('variant_name',$variant)->get();
                                if(count($variations)>0)
                                {
                                    foreach($variations as $variation)
                                    {
                                        $sizes = explode('/',$variation->variant_name);
                                        //$data[] = array('color'=>$color,'size'=>$sz);
                                        array_push($variation_size,$sz);
                                        array_unique($variation_size);
                                    }
                                }
                            }
                        }
                        $data = array('colors'=>$variation_color,'size'=>$variation_size);
                    }
                }
                $product->attributes = $data;

                }
                else
                {
    
                $favourite = 0;
          
                $product_attributes = ProductAttribute::where('product_id', $product->id)->get();

                if(count($product_attributes)>0)
                {
                    foreach($product_attributes as $attribute)
                    {
                        $colors = explode(',', $attribute->variant_color);
                        $size = explode(',',$attribute->variant_size);
                        foreach($colors as $key=>$color)
                        {
                            array_push($variation_color,$color);
                            array_unique($variation_color);
                            foreach($size as $sz)
                            {
                                $variant = $color."/".$sz;
                                $variations = ProductVariation::where('product_id',$request->product_id)->where('variant_name',$variant)->get();
                                if(count($variations)>0)
                                {
                                    foreach($variations as $variation)
                                    {
                                        $sizes = explode('/',$variation->variant_name);
                                        array_push($variation_size,$sz);
                                        array_unique($variation_size);
                                    }
                                }
                            }
                        }
                        $data = array('colors'=>$variation_color,'size'=>$variation_size);
                    }
                }
                $product->attributes = $data;

            }
            return response()->json(['status' => true, 'product'=>$product , 'favourite'=>$favourite]);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'Product not found.']);
            }
     
        }       
      
    }


    public function loginproductdetails(Request $request)
    {
        $data=[]; $variation_color=[]; $variation_size=[];
        $rules = [ 'product_id' => ['required'] ];
        $validator = Validator::make($request->all(), $rules);
	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {

        $product = Product::find($request->product_id);    
        $token = $request->header('Authorization');
        
        
            if(!is_null($product))
            {

                if(!empty($token)) {

                $app_user_id =  Auth::guard('app_user_api')->user()->id;
                $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$request->product_id)->first();
    
                if(!is_null($like)):
                    $favourite = 1;
                else:
                    $favourite = 0;
                endif;
                
                $product_attributes = ProductAttribute::where('product_id', $product->id)->get();

                if(count($product_attributes)>0)
                {
                    foreach($product_attributes as $attribute)
                    {
                        $colors = explode(',', $attribute->variant_color);
                        $size = explode(',',$attribute->variant_size);
                        foreach($colors as $key=>$color)
                        {
                            array_push($variation_color,$color);
                            array_unique($variation_color);
                            foreach($size as $sz)
                            {
                                $variant = $color."/".$sz;
                                $variations = ProductVariation::where('product_id',$request->product_id)->where('variant_name',$variant)->get();
                                if(count($variations)>0)
                                {
                                    foreach($variations as $variation)
                                    {
                                        $sizes = explode('/',$variation->variant_name);
                                        //$data[] = array('color'=>$color,'size'=>$sz);
                                        array_push($variation_size,$sz);
                                        array_unique($variation_size);
                                    }
                                }
                            }
                        }
                        $data = array('colors'=>$variation_color,'size'=>$variation_size);
                    }
                }
                $product->attributes = $data;

                }
                else
                {
    
                $favourite = 0;
          
                $product_attributes = ProductAttribute::where('product_id', $product->id)->get();

                if(count($product_attributes)>0)
                {
                    foreach($product_attributes as $attribute)
                    {
                        $colors = explode(',', $attribute->variant_color);
                        $size = explode(',',$attribute->variant_size);
                        foreach($colors as $key=>$color)
                        {
                            array_push($variation_color,$color);
                            array_unique($variation_color);
                            foreach($size as $sz)
                            {
                                $variant = $color."/".$sz;
                                $variations = ProductVariation::where('product_id',$request->product_id)->where('variant_name',$variant)->get();
                                if(count($variations)>0)
                                {
                                    foreach($variations as $variation)
                                    {
                                        $sizes = explode('/',$variation->variant_name);
                                        array_push($variation_size,$sz);
                                        array_unique($variation_size);
                                    }
                                }
                            }
                        }
                        $data = array('colors'=>$variation_color,'size'=>$variation_size);
                    }
                }
                $product->attributes = $data;

            }
            return response()->json(['status' => true, 'product'=>$product , 'favourite'=>$favourite]);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'Product not found.']);
            }
     
        }       
      
    }



    public function filter_products(Request $request)
    {
        $rules = ['owner_id'=>'required','template_id'=>'required','cat_id'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $token = $request->header('Authorization');
            if(isset($request->color) && isset($request->size) && !empty($request->color) && !empty($request->size) && isset($request->start_price) && !empty($request->start_price) && isset($request->end_price) && !empty($request->end_price))
            {
                $variation=[];

                foreach($request->size as $key=>$value)
                {
                    foreach($request->color as $keys=>$values)
                    {
                        $variation[] = $values."/".$value;
                    }
                }

                $variations = \App\Models\Template\E_Commerce\ProductVariation::whereIn('variant_name',$variation)->pluck('product_id');
                if(count($variations)>0)
                {                
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('template_id',$request->template_id)->where('collection_id',$request->cat_id)->whereBetween('product_price',[$request->start_price,$request->end_price])->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {
                        
                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

                    
            }
            else if(isset($request->color) && isset($request->size) && !empty($request->color) && !empty($request->size))
            {
                $variation=[];

                foreach($request->size as $key=>$value)
                {
                    foreach($request->color as $keys=>$values)
                    {
                        $variation[] = $values."/".$value;
                    }
                }

                $variations = \App\Models\Template\E_Commerce\ProductVariation::whereIn('variant_name',$variation)->pluck('product_id');
                if(count($variations)>0)
                {
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('template_id',$request->template_id)->where('collection_id',$request->cat_id)->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {
                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                       
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

                
            }
            else if(isset($request->color) && !empty($request->color) && isset($request->start_price) && !empty($request->start_price) && isset($request->end_price) && !empty($request->end_price))
            {
                $variations = \App\Models\Template\E_Commerce\ProductAttribute::whereRaw('FIND_IN_SET(?,variant_color)', [$request->color])->pluck('product_id');
                if(count($variations)>0)
                {
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('collection_id',$request->cat_id)->where('template_id',$request->template_id)->whereBetween('product_price',[$request->start_price,$request->end_price])->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {                      
                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

            }
            else if(isset($request->size) && !empty($request->size) && isset($request->start_price) && !empty($request->start_price) && isset($request->end_price) && !empty($request->end_price))
            {
                $variations = \App\Models\Template\E_Commerce\ProductAttribute::whereRaw('FIND_IN_SET(?,variant_size)', [$request->size])->pluck('product_id');
                if(count($variations)>0)
                {
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('collection_id',$request->cat_id)->where('template_id',$request->template_id)->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {
                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

            }
            else if(isset($request->color) && !empty($request->color))
            {
                $variations = \App\Models\Template\E_Commerce\ProductAttribute::whereRaw('FIND_IN_SET(?,variant_color)', [$request->color])->pluck('product_id');
                if(count($variations)>0)
                {
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('collection_id',$request->cat_id)->where('template_id',$request->template_id)->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {                       
                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

  
            }
            else if(isset($request->size) && !empty($request->size))
            {
                $variations = \App\Models\Template\E_Commerce\ProductAttribute::whereRaw('FIND_IN_SET(?,variant_size)', [$request->size])->pluck('product_id');
                if(count($variations)>0)
                {
                    
                    $products = \App\Models\Template\E_Commerce\Product::whereIn('id',$variations)->where('user_id',$request->owner_id)->where('collection_id',$request->cat_id)->where('template_id',$request->template_id)->findMany($variations);
                    if(!empty($token)) {
                        $app_user_id =  Auth::guard('app_user_api')->user()->id;
                        foreach ($products as $product){
    
                            $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                            if(!is_null($like)):
                                $product->favourite = 1;
                            else:
                                $product->favourite = 0;
                            endif;
    
                        }
    
                    }else{
    
                        foreach ($products as $product){
                                        
                                $product->favourite = 0;
                        }
                    }
                    if(count($products)>0)
                    {

                        return response()->json(['status'=>true,'filter_payload'=>$products]);
                    }
                    else
                    {
                        return response()->json(['status'=>false,'message'=>'Product not found']);
                    }
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }

            }
            else if(isset($request->start_price) && !empty($request->start_price) && isset($request->end_price) && !empty($request->end_price))
            {
                             
                $products = \App\Models\Template\E_Commerce\Product::where('user_id',$request->owner_id)->where('collection_id',$request->cat_id)->where('template_id',$request->template_id)->whereBetween('product_price',[$request->start_price,$request->end_price])->get();
                if(!empty($token)) {
                    $app_user_id =  Auth::guard('app_user_api')->user()->id;
                    foreach ($products as $product){

                        $like = EcommerceProductFavorite::where('app_user_id',$app_user_id)->where('product_id',$product->id)->first();            
                        if(!is_null($like)):
                            $product->favourite = 1;
                        else:
                            $product->favourite = 0;
                        endif;

                    }

                }else{

                    foreach ($products as $product){
                                    
                            $product->favourite = 0;
                    }
                }

                if(count($products)>0)
                {                               
                    return response()->json(['status'=>true,'filter_payload'=>$products]);
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'Product not found']);
                }
               
            }
            else
            {
                return response()->json(['status'=>false,'message'=>"No product found."]);
            }
        }
    }


    public function product_variations(Request $request)
    {
        $data = [];
        $rules = ['color'=>'required','product_id'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $attributes = ProductAttribute::where('product_id',$request->product_id)->whereRaw('FIND_IN_SET(?,variant_color)', [$request->color])->get();
            if(count($attributes)>0)
            {
                foreach($attributes as $attribute)
                {
                    $colors = explode(',', $attribute->variant_color);
                    $size = explode(',',$attribute->variant_size);
                    foreach($colors as $key=>$color)
                    {
                        foreach($size as $sz)
                        {
                            if($color == $request->color)
                            {
                                $variant = $color."/".$sz;
                                $variations = ProductVariation::where('product_id',$request->product_id)->where('variant_name',$variant)->get();
                                if(count($variations)>0)
                                {
                                    foreach($variations as $variation)
                                    {
                                        $sizes = explode('/',$variation->variant_name);
                                        $new_data = array('size'=>$sizes[1],'image'=>$variation->variant_image);
                                        array_push($data,$new_data);
                                    }
                                }
                            }
                        }
                    }
                }
                $data = array_map("unserialize", array_unique(array_map("serialize", $data)));
                return response()->json(['status'=>true,'product_variations_payload'=>$data]);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'No data.']);
            }
        }
    }

    public function sorting(Request $request)
    {

        $rules = ['type'=>'required','cat_id'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            if ($request->type == 'asc'){

            $products = Product::where('collection_id',$request->cat_id)->orderBy('product_price','asc')->get();

            }elseif($request->type == 'desc'){

            $products = Product::where('collection_id',$request->cat_id)->orderBy('product_price','desc')->get();

            }elseif($request->type == 'popular'){

            $products = Product::where('collection_id',$request->cat_id)->get(); 

            }elseif($request->type == 'new'){

            $products = Product::where('collection_id',$request->cat_id)->orderBy('id','desc')->get();

            }

            return response()->json(['success' => true, 'products' => $products]);

        }
    }



}
