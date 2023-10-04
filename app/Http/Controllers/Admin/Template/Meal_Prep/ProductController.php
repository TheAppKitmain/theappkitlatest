<?php

namespace App\Http\Controllers\Admin\Template\Meal_Prep;

use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\ProductCategory;
use App\Models\Template\E_Commerce\ProductAttribute;
use App\Models\Template\E_Commerce\ProductVariation;
use App\Models\Template\Meal_Prep\MealProduct;
use App\Models\Template\E_Commerce\SplashScreen;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Usertheme;
use Session;
use Image;
use Artisan;
use Config;
use Auth;
use App;
use DB;


class ProductController extends Controller
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

        $products = MealProduct::with('get_collection_name')->where('user_id', $id)->where('template_id', $template_id)->paginate(6);

        }
        else{
            Auth::logout();
            return redirect('login');
        }


        return view("admin.template.E_Commerce.products", compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {   
        $id = auth()->user()->id;
        $usertheme = Usertheme::where('user_id', $id)->first();
        $collections = EcommerceCollection::where('user_id', $id)->get();
        return view('admin.template.E_Commerce.add_products', compact('collections','usertheme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $check = MealProduct::where('user_id',$request->user_id)
        ->where('template_id',$request->template_id)
        ->where('product_name',$request->product_name)->first();
        if(!is_null($check)){
            $this->validate($request,[
                'product_name'=>'required|string|max:255|unique:ecommerce_products',
                'slug'=>'|string|max:255|unique:ecommerce_products',
                'product_description'=>'required', 'string',
                'product_price'=>'required', 'string', 'max:255',
                'product_type'=>'required', 'string', 'max:255',
                'product_image'=>'required',
            ]);
        }


        $data = array();
        $data['product_name'] = $request->product_name;
        $slug = $request->user_id.'/'.$request->template_id.'/'.$request->slug;     
        $data['slug'] = $slug;
        $data['user_id'] = $request->user_id;
        $data['template_id'] = $request->template_id;
        $data['collection_id'] = $request->product_collection;
        $data['product_description'] = $request->product_description;
        $data['product_type'] = $request->product_type;
        $data['sale_price'] = $request->sale_price;
        $data['product_price'] = $request->product_price;
        $data['stock_unit'] = $request->stock_unit;
        $data['stock_qty'] = $request->stock_qty;
        $data['shipping_weight'] = $request->shipping_weight;
        $data['shipping_length'] = $request->shipping_length;
        $data['shipping_width'] = $request->shipping_width;
        $data['shipping_height'] = $request->shipping_height;
        $image = $request->file('product_image');

        if ($image) {

            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_image'] = $url;
        }

        $galleryimage1 = $request->file('product_display_image_1');

        if ($galleryimage1) {

            $name = time().'.'.$galleryimage1->getClientOriginalExtension();
            $image_full_name = 'img1_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage1));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_1'] = $url;
        }

        $galleryimage2 = $request->file('product_display_image_2');

        if ($galleryimage2) {

            $name = time().'.'.$galleryimage2->getClientOriginalExtension();
            $image_full_name = 'img2_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage2));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_2'] = $url;
        }

        $galleryimage3 = $request->file('product_display_image_3');

        if ($galleryimage3) {

            $name = time().'.'.$galleryimage3->getClientOriginalExtension();
            $image_full_name = 'img3_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage3));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_3'] = $url;
        }

        $product = Product::create($data);

        $product_id =  DB::getPdo()->lastInsertId();

        $product_collection = $request->product_collection;

        ProductCategory::create([                    
        'product_id' => $product_id,
        'collection_id' => $product_collection,
        'user_id' => $data['user_id'],
        ]);

 


        if(!empty($request->variant_color)){

           $variant_colors = implode(',',$request->variant_color);

           if(!empty($request->variant_size)){ 

             $variant_size = implode(',',$request->variant_size);
                ProductAttribute::create([                  
                    'product_id' => $product_id,
                    'user_id' => $data['user_id'],
                    'variant_color'=> $variant_colors,
                    'variant_size'=> $variant_size,
                ]);
           } else {
                ProductAttribute::create([                  
                    'product_id' => $product_id,
                    'user_id' => $data['user_id'],
                    'variant_color'=> $variant_colors
                ]);
           }
            
            $variant_price = $request->variant_price;
            $variant_names = $request->variant_name;
            $variant_qty = $request->variant_qty;
            $variant_image = $request->variant_image;
            $user_id = $request->user_id;

            foreach($variant_names as $ky=>$val){
                $product_variation = new ProductVariation;
                $product_variation->user_id = $user_id;
                $product_variation->product_id = $product_id;
                $product_variation->variant_name = $val;
                $product_variation->variant_price = $variant_price[$ky];
                $product_variation->variant_qty = $variant_qty[$ky];

                if(!empty($request->variant_image[$ky])){
                    foreach($request->file('variant_image') as $key=>$value){
                        if($ky == $key){

                            $name = time().'.'.$value->getClientOriginalExtension();
                            $image_full_name = $name.'_'.$key;
                            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                            Storage::disk('s3')->put($filePath, file_get_contents($value));
                            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                            $product_variation->variant_image = $url;

                        }
                    }
                }
                $product_variation->save();
            }

        session::flash('statuscode','info');
        return back()->with('status','Product is Added');
    }
    else
    {
        session::flash('statuscode','info');
        return back()->with('status','Product is Added');
        }
        
    }


    public function add_variant(Request $request)
    {   
       
        $product_id = $request->product_id;
        $user_id = $request->user_id;

        $exists = ProductVariation::where('variant_name',$request->variant_name)->where('product_id',$request->variant_name)->where('user_id',$request->user_id)->first();   
        if(!is_null($exists))
        {        
        session::flash('statuscode','info');
        return back()->with('status','Product Variant is Already Added');
        }else{

        if(!empty($request->variant_color)){

            $variant_colors = implode(',',$request->variant_color);
 
            if(!empty($request->variant_size)){ 
 
              $variant_size = implode(',',$request->variant_size);
                 ProductAttribute::create([                  
                     'product_id' => $product_id,
                     'user_id' => $user_id,
                     'variant_color'=> $variant_colors,
                     'variant_size'=> $variant_size,
                 ]);
            } else {
                 ProductAttribute::create([                  
                     'product_id' => $product_id,
                     'user_id' => $user_id,
                     'variant_color'=> $variant_colors
                 ]);
            }
             
             $variant_price = $request->variant_price;
             $variant_names = $request->variant_name;
             $variant_qty = $request->variant_qty;
             $variant_image = $request->variant_image;
             $user_id = $request->user_id;
 
             foreach($variant_names as $ky=>$val){
                 $product_variation = new ProductVariation;
                 $product_variation->user_id = $user_id;
                 $product_variation->product_id = $product_id;
                 $product_variation->variant_name = $val;
                 $product_variation->variant_price = $variant_price[$ky];
                 $product_variation->variant_qty = $variant_qty[$ky];
 
                 if(!empty($request->variant_image[$ky])){
                     foreach($request->file('variant_image') as $key=>$value){
                         if($ky == $key){
 
                             $name = time().'.'.$value->getClientOriginalExtension();
                             $image_full_name = $name.'_'.$key;
                             $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                             Storage::disk('s3')->put($filePath, file_get_contents($value));
                             $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                             $product_variation->variant_image = $url;
 
                         }
                     }
                 }
                 $product_variation->save();
             }
 
         session::flash('statuscode','info');
         return back()->with('status','Product is Added');
    }
}
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_id = $id;
        $product_attribute = ProductAttribute::where('product_id', $product_id)->first();
        $v_color = explode(',',$product_attribute->variant_color);
        $v_size  = explode(',',$product_attribute->variant_size);

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $template_id = session('theme_id');
        $splashscreen = SplashScreen::where('user_id', $user_id)->where('template_id', $template_id)->first();
        $collections = MealCollection::where('user_id', $user_id)->where('template_id', $template_id)->get();
        $product = MealProduct::findOrFail($id);
        return view('admin.template.E_Commerce.edit_product', compact('product','collections','splashscreen'));
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

        $user_id = $request->user_id;

        $product_name = MealProduct::find($id);   

        $this->validate($request,[
            'product_name' =>  
            [
                'required', 
                Rule::unique('meal_products')->ignore($id)->where('user_id',$user_id)->where('template_id',$request->template_id)
            ]
        ]);
        $data = array();

        $data['product_name'] = $request->product_name;

        if($request->product_name !== $product_name->product_name)
        {      
            $slug = $request->user_id.'/'.$request->template_id.'/'.$request->slug;
            $data['slug'] = $slug;
        }


        $data['user_id'] = $request->user_id;
        $data['template_id'] = $request->template_id;
        $data['collection_id'] = $request->product_collection;
        $data['product_description'] = $request->product_description;
        $data['product_type'] = $request->product_type;
        $data['sale_price'] = $request->sale_price;
        $data['product_price'] = $request->product_price;
        $data['stock_unit'] = $request->stock_unit;
        $data['stock_qty'] = $request->stock_qty;
        $data['shipping_weight'] = $request->shipping_weight;
        $data['shipping_length'] = $request->shipping_length;
        $data['shipping_width'] = $request->shipping_width;
        $data['shipping_height'] = $request->shipping_height;
        $image = $request->file('product_image');

        if ($image) {

            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_image'] = $url;
        }

        $galleryimage1 = $request->file('product_display_image_1');

        if ($galleryimage1) {

            $name = time().'.'.$galleryimage1->getClientOriginalExtension();
            $image_full_name = 'img1_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage1));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_1'] = $url;
        }

        $galleryimage2 = $request->file('product_display_image_2');

        if ($galleryimage2) {

            $name = time().'.'.$galleryimage2->getClientOriginalExtension();
            $image_full_name = 'img2_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage2));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_2'] = $url;
        }

        $galleryimage3 = $request->file('product_display_image_3');

        if ($galleryimage3) {

            $name = time().'.'.$galleryimage3->getClientOriginalExtension();
            $image_full_name = 'img3_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($galleryimage3));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $data['product_display_image_3'] = $url;
        }

        $product = MealProduct::where('id',$id)->update($data);
        session::flash('statuscode','info');
        return back()->with('status','Product is Updated');
    }


    public function edit_variant($id)
    {
        $user_id = auth()->user()->id;
        $productvariations = ProductVariation::where('product_id',$id)->get();
        return view('admin.template.E_Commerce.edit_product_variant', compact('productvariations','id','user_id'));
    }


    public function update_variant(Request $request)
    {
       $variant_id = $request->variant_id;
       $variant_price = $request->variant_price;
       $variant_name = $request->variant_name;
       $variant_qty = $request->variant_qty;
       $user_id = $request->user_id;
       $product_id = $request->product_id;

       if(!is_null($variant_id)){

        foreach($variant_id as $key=>$id){

            $product_variation = ProductVariation::find($id);
            $product_variation->user_id = $user_id[$key];
            $product_variation->product_id = $product_id[$key];
            $product_variation->variant_name = $variant_name[$key];
            $product_variation->variant_price = $variant_price[$key];
            $product_variation->variant_qty = $variant_qty[$key];

            if(!empty($request->variant_image[$key])){
                foreach($request->file('variant_image') as $ky=>$value){
                    if($key == $ky){      

                        $name = time().'.'.$value->getClientOriginalExtension();
                        $image_full_name = $name.'_'.$key;
                        $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                        Storage::disk('s3')->put($filePath, file_get_contents($value));
                        $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                        $product_variation->variant_image = $url;
                    }
                }
            }
                       
            $product_variation->save();
        }

        session::flash('statuscode','info');
        return back()->with('status','Product variant is Updated');

       }

       else
       {
         session::flash('statuscode','error');
         return back()->with('status','Please add aleast one variant to update');
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
        $product = MealProduct::findOrFail($id);
        $product_attribute = ProductAttribute::where('product_id', $id)->delete();
        $product_variation = ProductVariation::where('product_id', $id)->delete();
        $product_category = ProductCategory::where('product_id', $id)->delete();
        $product->delete();
        session::flash('statuscode','error');
        return back()->with('status','Product is Deleted');
    }

    public function del_variant($id)
    {
        $productvariation = ProductVariation::findOrFail($id);
        $productvariation->delete();
        session::flash('statuscode','error');
        return back()->with('status','Product variant is Deleted');
    }
}
