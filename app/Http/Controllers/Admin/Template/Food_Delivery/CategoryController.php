<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\ThemeTemplate;

class CategoryController extends Controller
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

            $categories = FoodCategory::where('parent_id','0')->where('owner_id', $id)->where('template_id', $template_id)->orderBy('position','asc')->get();
            return view('admin.template.Food_Delivery.categories.index',compact('categories'));

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
        $parents = FoodCategory::where('parent_id',0)->where('owner_id', $id)->where('template_id', $template_id)->get(['id','name']);

        }
        else{
            Auth::logout();
            return redirect('login');
        }

        return view('admin.template.Food_Delivery.categories.create',compact('parents','themetemplate'));
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
            'name'=>"required|unique:food_categories",
        ]);

        $category = new FoodCategory;
        $category->owner_id = $request->user_id;
        $category->template_id = $request->template_id;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->position = $request->position ?? 0;

        $image = $request->file('image');
        if($image)
        {
            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/'.$image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $category->image = $url;
        }
        if($category->save())
        {
            session::flash('statuscode','info');
            return back()->with('status','Category is added');
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Category is not added');
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
        $category = FoodCategory::with('children')->find($id);
        return view('admin.template.Food_Delivery.categories.show',compact('category'));
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

            $parents = FoodCategory::where('parent_id',0)->where('owner_id', $user_id)->where('template_id', $template_id)->get(['id','name']);
            $category = FoodCategory::find($id);  
            return view('admin.template.Food_Delivery.categories.edit',compact('parents','category'));

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
        if(!empty($request->name)):
            $this->validate($request,[
                'name'=>"required|unique:food_categories,name,".$id,
            ]);
        endif;
        $category = FoodCategory::find($id);
        $category->parent_id = $request->parent_id ?? $category->parent_id ;
        $category->name = $request->name ?? $category->name ;
        $category->description = $request->description ?? $category->description ;
        $category->status = $request->status ?? $category->status ;
        $category->position = $request->position?? $category->position ;
        $image = $request->file('image');
        if($image)
        {
            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
            $category->image = $url;
        }
        if($category->save())
        {
            FoodProduct::whereRaw('FIND_IN_SET(?,category_id)', [$category->id])->update(['status'=>$category->status]);

            session::flash('statuscode','info');      
            return back()->with(['status','category has been updated successfully!.']);
            // return redirect()->route('theme.food_category.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>$category->name.' category has been updated successfully!.']);
        }
        else
        {
            session::flash('statuscode','info');      
            return back()->with(['status','category has not been updated.']);
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
        $category = FoodCategory::find($id);
        if(!is_null($category))
        {
            $category->delete(); 

            session::flash('statuscode','error');      
            return back()->with(['status','Category has been deleted successfully!.']);


        }
        else
        {
            session::flash('statuscode','error');      
            return back()->with(['status','Category has not been deleted!.']);  
        }
    }
}
