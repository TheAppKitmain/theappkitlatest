<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Blogcategories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Blogcategories::orderBy('id','asc')->get();
        return view("admin.super_admin.blog.category.index",compact('categories'));
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
        $this->validate($request,[
            'name'=>"required|unique:blogcategories",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $category = new Blogcategories;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description;
        $category->status = $request->status;
        $image = $request->file('image');
        if ($image) {

            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/superadmin/blogcategory/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/superadmin/blogcategory/".$image_full_name;
            $category->image = $url;
        }
        if($category->save()){
            return redirect()->route('blogcategory.index')->with(['alert'=>'success','message'=>' Category has been created successfully!.']);
        }
        else
        {
          return redirect()->route('blogcategory.index')->with(['alert'=>'danger','message'=>'Category has not been created!.']);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blogcategories  $blogcategories
     * @return \Illuminate\Http\Response
     */
    public function show(Blogcategories $blogcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blogcategories  $blogcategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category = Blogcategories::find($id);
       return view("admin.super_admin.blog.category.edit",compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogcategories  $blogcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name'=>"required|unique:blogcategories,name,".$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $category = Blogcategories::find($id);
        $category->name = $request->name ?? $category->name ;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description ?? $category->description ;
        $category->status = $request->status ?? $category->status ;
        $image = $request->file('image');
        if ($image) {
            $name = time().'.'.$image->getClientOriginalExtension();
            $image_full_name = 'img_'.$name;
            $filePath = 'theappkit/theappkitproject/superadmin/blogcategory/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $url = config('services.base_url')."/theappkit/theappkitproject/superadmin/blogcategory/".$image_full_name;
            $category->image = $url;
        }
        if($category->save())
        {
            return redirect()->route('blogcategory.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>$category->name.' category has been updated successfully!.']);
        }
        else
        {
            return redirect()->route('blogcategory.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Category has not been updated!.']);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blogcategories  $blogcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      $category = Blogcategories::find($id);
        if(!is_null($category))
        {
            $category->delete(); 
            return redirect()->route('blogcategory.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Category has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('blogcategory.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Category has not been deleted!.']);  
        }
    }
}
