<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodProductInformation;
use App\Models\Template\Food_Delivery\FoodProductAttribute;
use App\Models\Template\Food_Delivery\FoodFeaturedProduct;
use App\Models\Template\Food_Delivery\FoodProductImage;
use App\ThemeTemplate;
use Validator;
use Image;
use Auth;
use Session;


class ProductAttributeController extends Controller
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
        $product_id = FoodProduct::where('owner_id', $id)->where('template_id', $template_id)->pluck('id');
        $products = FoodFeaturedProduct::with('product')->whereIn('product_id', $product_id)->orderBy('position','asc')->get();
        return view('admin.template.Food_Delivery.product_attributes.index',compact('products'));
        
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
        $products = FoodProduct::where('status','active')->where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
        return view('admin.template.Food_Delivery.product_attributes.create',compact('products'));
        
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
        $this->validate($request,[
            'name'=>'required|unique:food_product_attributes'
        ]);
        
        $product_id = $request->product_id;
        $request->product_id = implode(',',$request->product_id);
   
        $attributes = new FoodProductAttribute;
        $attributes->name = $request->name;
        $attributes->status = $request->status;
        $attributes->product_id = $request->product_id;
        if($attributes->save())
        {
            $attribute = FoodProductAttribute::first();

            foreach($product_id as $product)
            {
                FoodFeaturedProduct::create(['product_id'=>$product,'product_attribute_id'=>$attribute->id]);
            }

            // foreach($request->product_id as $ky=>$val){

            //     $assign_child = new FoodFeaturedProduct;
            //     $assign_child->product_id = $val;
            //     $assign_child->product_attribute_id = $attribute->id;
            //     $assign_child->save();

            // } 
            session::flash('statuscode','info');
            return redirect()->route('theme.food_product_attributes.index')->with('status','Featured product has been added successfully!.');
        }
        else
        {
            return redirect()->route('theme.food_product_attributes.index')->with(['status' ,'Attributes has not been created successfully!.']);
        }

        // $attribute = FoodProductAttribute::first();

        // foreach($request->product_id as $product)
        // {
        //     FoodFeaturedProduct::create(['product_id'=>$product,'product_attribute_id'=>$attribute->id]);
        // }

        // session::flash('statuscode','info');
        // return redirect()->route('theme.food_product_attributes.index')->with('status','Featured product has been added successfully!.');
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

        $user_id = auth()->user()->id;

        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $attribute = FoodProductAttribute::find($id);
        if(!is_null($attribute)):
            $productId = FoodFeaturedProduct::where('product_attribute_id',$attribute->id)->pluck('product_id')->toArray();
            $products = FoodProduct::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Food_Delivery.product_attributes.edit',compact('attribute','products','productId'));
        else:
            $products = FoodProduct::where('status','active')->where('owner_id', $user_id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Food_Delivery.product_attributes.create',compact('products'));
        endif;
        
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
            'name'=>'required|unique:food_product_attributes,name,'.$id
        ]);

        $attributes = FoodProductAttribute::find($id);
        $attributes->name = $request->name;
        // $attributes->product_id = $request->product_id;
        $attributes->status = $request->status;
        if($attributes->save())
        {
            $request->position = isset($request->position) ? $request->position : 1;
            foreach($request->product_id as $product)
            {
                FoodFeaturedProduct::updateOrCreate(['product_id'=>$product,'product_attribute_id'=>$attributes->id]);
            }
            session::flash('statuscode','info');
            return redirect()->route('theme.food_product_attributes.index')->with('status','Featured product has been updated successfully!.');
  
        }
        else
        {
            session::flash('statuscode','info');
            return redirect()->route('theme.food_product_attributes.index')->with('status','Featured product has not been updated!.');
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
        $attribute = FoodFeaturedProduct::find($id);
        if($attribute->delete())
        {
            session::flash('statuscode','error');
            return back()->with('status','Featured product has been removed successfully!.');
           
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Featured product has not been removed!.');
        }
    }

    public function position(Request $request, $id)
    {
        $attribute = FoodFeaturedProduct::find($id);

        $attribute->position = $request->position;
        if($attribute->save())
        {
            session::flash('statuscode','info');
            return back()->with('status','Featured product has been updated successfully!.');
            
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Not Found.');
  
        }
    }

    public function get_category(Request $request)
    {
        $categories = FoodCategory::with('children')->find($request->id);
        if(!is_null($categories))
        {
            $cat = "";$pro="";
            if(count($categories->children)>0)
            {
                foreach($categories->children as $category)
                {
                    $cat.='<option value='.$category->id.'>'.$category->name.'</option>';
                }
            }
            else
            {
                $cat = "<option value=0>No category found!.</option>";
            }
            $products = FoodProduct::where('category_id', 'like', '%' . $categories->id . '%')->where('status','active')->orderBy('id','desc')->get();
            if(count($products)>0):
				foreach($products as $product):
					$pro.='<tr><td>'.$product->id.'</td><td><img src="'.$product->product_image.'" style="width:100px; height:100px"></td><td>'.$product->product_name.'</td><td>'.$product->price.'</td><td>'.$product->status.'</td></tr>';
				endforeach;
			endif;
			return response()->json(["category"=>$cat,"products"=>$pro]);
        }
        else
        {
            $cat = "Category not found.";
            $products = "Product no found!.";
            return response()->json(["category"=>$cat,"products"=>$products]);
        }
    }

    public function get_subcategory(Request $request)
    {
        $categories = FoodCategory::find($request->id);
        if(!is_null($categories))
        {
            $pro="";
            $products = FoodProduct::where('category_id', 'like', '%' . $categories->id . '%')->where('status','active')->orderBy('id','desc')->get(['id','product_name']);
            if(count($products)>0)
            {
                foreach($products as $product)
                {
                    $pro.="<option value=".$product->id.">".$product->product_name."</option>";
                }
            }
            else
            {
                $pro.="<option value=0>No product found!.</option>";
            }
            return response()->json($pro);
        }
        else
        {
            $pro = "Product no found!.";
            return response()->json($pro);
        }
    }
}
