<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodProductInformation;
use App\Models\Template\Food_Delivery\FoodProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\ThemeTemplate;
use Validator;
use Image;
use Auth;
use Session;

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

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $products = FoodProduct::orderBy('id','desc')->where('owner_id', $id)->where('template_id', $template_id)->paginate(10);
        if(count($products)>0)
        {
            foreach($products as $product)
            {
                $cat = explode(',',$product->category_id);
                $parent_id = FoodCategory::whereParentId(0)->whereIn('id',$cat)->first();
                $cat_name = FoodCategory::findMany($cat);
                $name = $cat_name->pluck('name')->toArray();
                $product->category_name = implode(',',$name);
                $product->cat_id =  $parent_id->id ?? "";
            }
        }
        return view('admin.template.Food_Delivery.products.index',compact('products'));
        
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
        $categories = FoodCategory::where('status','active')->where('owner_id', $id)->where('template_id', $template_id)->where('status','active')->whereParentId(0)->get();
		$products = [];
		$subcategories = [];
        return view('admin.template.Food_Delivery.products.add_product',compact('categories','products','subcategories'));
        
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
    public function store(Request $request)
    {
        // return $request->all();
        session(['product_image' => $request->product_image]);
        $this->validate($request,[
            'product_name'=>"unique:food_products,product_name",
        ]);
        if(!empty($request->subcategory_id) && (!is_null($request->subcategory_id))):
        $category_id = implode(',',$request->subcategory_id);
        $request->category_id = implode(',',array($category_id,$request->category_id));
        endif;
        $product = new FoodProduct;
        $product->product_type = $request->product_type;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->price = $request->price ?? 0;
		$product->product_stock = $request->product_stock ?? 0;

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

        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        if($product->save())
        {
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
            session::flash('statuscode','info');
            return back()->with('status','Product has been created successfully!.');
        }
        else
        {
            session::flash('statuscode','info');

            return back()->with('status','Product has not been created successfully!.');
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
        $product = FoodProduct::show($id);
        return $product;
        //return view('products.show',compact('product'));
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

        if(session('theme_id') != null){

        $categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId(0)->get(['name','id']);
        $product = FoodProduct::with('product_informations','product_images')->where('owner_id', $user_id)->where('template_id', $template_id)->find($id);
        $ids = explode(',',$product->category_id);
        $subcategories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereIn('id',$ids)->get();
        $categoryid = $subcategories->pluck('id')->toArray();
        $products = FoodProduct::where('category_id', 'like', '%' . $id . '%')->where('owner_id', $user_id)->where('template_id', $template_id)->orderBy('id','desc')->get();
        return view('admin.template.Food_Delivery.products.edit',compact('categories','product','categoryid','subcategories','products'));
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'product_name'=>"unique:food_products,product_name,".$id,
        ]);
        if(!empty($request->subcategory_id)):
        $category_id = implode(',',$request->subcategory_id);
        $request->category_id = implode(',',array($category_id,$request->category_id));
        endif;
        $product = FoodProduct::find($id);
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->product_stock = $request->product_stock ?? 0;
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
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        if($product->save())
        {
            if((!empty($request->attr))&&(!empty($request->product_price))&&(!empty($request->attribute_id)))
            {
                for($i=0;$i<count($request->attr);$i++)
                {
                    $attr = $request->attr[$i];
                    $price = $request->product_price[$i];
                    $ids = $request->attribute_id[$i];
                    if(!is_null($attr) && (!is_null($price)) && (!is_null($ids)) ):
                    FoodProductInformation::whereId($ids)->update([
                        'attribute_name'=>$attr,
                        'product_price'=>$price,
                        'product_id'=>$product->id
                    ]);
                    endif;
                }
            }

            session::flash('statuscode','info');
            return back()->with('status','Product has been updated successfully!.');


        }
        else
        {
            session::flash('statuscode','info');
            return back()->with('status','Product has not been updated!.');


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
        $product = FoodProduct::find($id);
        if(!is_null($product))
        {
            $product->delete();
            session::flash('statuscode','error');
            return back()->with('status','Product has been removed successfully!.');

        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Product has not been removed!.');
        }
    }

	public function add_product_page(Request $request,$id)
	{

        if($request->isMethod('get')):

            $user_id = auth()->user()->id;
            $template_id = session('theme_id');

            if(session('theme_id') != null){

            $themetemplate = ThemeTemplate::where('id', $template_id)->first();
    		$categories = FoodCategory::where('status','active')->whereParentId(0)->where('owner_id', $user_id)->where('template_id', $template_id)->orderBy('id','asc')->get();
    		$subcategories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId($id)->get();
            $another_categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->with('children')->whereNotIn('id',[$id])->whereParentId(0)->get();
            $ids = $subcategories->pluck('id')->toArray();
            $cat_id = (integer)$id;
            array_unshift($ids,$cat_id);
            $products = FoodProduct::whereRaw('FIND_IN_SET(?,category_id)', [$ids])->where('owner_id', $user_id)->where('template_id', $template_id)->orderByRaw('position = 0', 'ASC', 'position')->get();

            }
            else{
                Auth::logout();
                return redirect('login');
            }
    		return view('admin.template.Food_Delivery.products.add_product',compact('categories','products','subcategories','another_categories','themetemplate'));
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

    public function edit_product($id,$product_id)
    {

        $user_id = auth()->user()->id;

        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $categories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId(0)->get(['name','id']);
        $product = FoodProduct::with('product_informations','product_images')->where('owner_id', $user_id)->where('template_id', $template_id)->find($product_id);
        $subcategories = FoodCategory::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->whereParentId($id)->get(['name','id']);
        $another_categories = FoodCategory::where('status','active')->with('children')->where('owner_id', $user_id)->where('template_id', $template_id)->whereNotIn('id',[$id])->whereParentId(0)->get();
        $ids = $subcategories->pluck('id')->toArray();
        $cat_id = (integer)$id;
        array_unshift($ids,$cat_id);
        $products = FoodProduct::whereRaw('FIND_IN_SET(?,category_id)', [$ids])->where('owner_id', $user_id)->where('template_id', $template_id)->orderByRaw('position = 0', 'ASC', 'position')->get();
        return view('admin.template.Food_Delivery.products.product_edit',compact('categories','product','products','subcategories','another_categories'));
    
        }
        else{
            Auth::logout();
            return redirect('login');
        }

    }

    public function update_product(Request $request,$id,$product_id)
    {
        if(isset($request->is_continoue) && !is_null($request->is_continoue)):
            $validator = Validator::make($request->all(),[

            ]);
        else:
            $validator = Validator::make($request->all(),[
                'product_name'=>"unique:food_products,product_name,".$product_id,

            ]);
        endif;

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        if(!empty($request->subcategory_id)):
        $category_id = implode(',',$request->subcategory_id);
        $request->category_id = implode(',',array($category_id,$request->category_id));
        endif;
        $product = FoodProduct::find($product_id);

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->product_stock = $request->product_stock ?? 0;

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
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
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
            if((!empty($request->attr))&&(!empty($request->product_price))&&(!empty($request->attribute_id)))
            {
                for($i=0;$i<count($request->attr);$i++)
                {
                    $attr = $request->attr[$i];
                    $price = $request->product_price[$i];
                    $ids = $request->attribute_id[$i];
                    if(!is_null($attr) && (!is_null($price)) ):
                        $matchThese = ['id'=>$ids];
                        FoodProductInformation::updateOrCreate($matchThese,[
                            'attribute_name'=>$attr,
                            'product_price'=>$price,
                            'product_id'=>$product->id
                        ]);
                    endif;
                }
            }
            if($product->product_type == "simple")
            {
                FoodProductInformation::whereProductId($product->id)->delete();
            }

            \Session::flash('message', 'Product has been updated successfully!.');
            \Session::flash('alert', 'success');
            return response()->json(['status'=>true]);
        }
        else
        {
            \Session::flash('message', 'Product has not been updated successfully!.');
            \Session::flash('alert', 'danger');
            return response()->json(['status'=>true]);
        }
    }

    public function removeProductImage(Request $request)
    {
        $image = FoodProductImage::find($request->id);
        if(!is_null($image)):
            $image->delete();
            return response()->json(['status'=>true,'message'=>'Image has been deleted successfully.']);
        else:
            return response()->json(['status'=>false,'message'=>'Image not exists.']);
        endif;
    }

    public function update_position(Request $request)
    {
        $product = FoodProduct::find($request->id);
        if(!is_null($product)):
            $product->position = $request->position;
            $product->save();
            return redirect()->back()->with(['alert'=>'success','message'=>'Product sort has been updated!.']);
        else:
            return redirect()->back()->with(['alert'=>'danger','message'=>'Product sort has not been updated!.']);
        endif;
    }
}
