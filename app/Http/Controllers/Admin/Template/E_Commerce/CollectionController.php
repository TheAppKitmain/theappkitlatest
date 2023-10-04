<?php

namespace App\Http\Controllers\Admin\Template\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Usertheme;
use App\Models\Template\E_Commerce\ProductCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Session;
use Image;
use Illuminate\Support\Facades\Storage;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = EcommerceCollection::where('user_id',$request->user_id)
        ->where('template_id',$request->template_id)
        ->where('collection_name',$request->collection_name)->first();
        if(!is_null($check)){
            $this->validate($request,[
                'collection_name'=>'required|string|max:255|unique:ecommerce_collections',
                'slug'=>'|string|max:255|unique:ecommerce_collections',
            ]);
        }
        
        $data = array();
        $data['collection_name'] = $request->collection_name;
        $slug = $request->user_id.'/'.$request->template_id.'/'.$request->slug;   
        $data['slug'] = $slug;
        $data['template_id'] = $request->template_id;     
        $data['user_id'] = $request->user_id;
        $data['collection_description'] = $request->collection_description;
        $image = $request->file('collection_image');
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            if ($extension == "png" ) {
                $name = time().'.'.$extension;             
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($image));
                $url = "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['collection_image'] = $url;
            } else {
                session::flash('statuscode','info');
                return back()->with('status','Only PNG file is required');
            }
        }
        $ecommercecollection = EcommerceCollection::create($data);
        session::flash('statuscode','info');
        return back()->with('status','Collection is Added');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $collection = EcommerceCollection::findOrFail($id);
        return view('admin.template.E_Commerce.edit_collection', compact('collection'));
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
        $template_id = session('theme_id');

        $collection_name = EcommerceCollection::find($id);   

        $this->validate($request,[
            'collection_name' =>  
            [
                'required', 
                Rule::unique('ecommerce_collections')->ignore($id)->where('user_id',$user_id)->where('template_id',$template_id)
            ]
        ]);
        $data = array();

        $data['collection_name'] = $request->collection_name;

        if($request->collection_name !== $collection_name->collection_name)
        {      
            $slug = $request->user_id.'/'.$template_id.'/'.$request->slug;
            $data['slug'] = $slug;
        }
        
        $data['user_id'] = $request->user_id;     
        $data['collection_description'] = $request->collection_description;
        $image = $request->file('collection_image');
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            if ($extension == "png" ) {
                $name = time().'.'.$extension;             
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($image));
                $url = "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['collection_image'] = $url;
            } else {
                session::flash('statuscode','info');
                return redirect('theme/theme_settings')->with('status','Only PNG file is required');
            }
        }
        $collection = EcommerceCollection::where('id',$id)->update($data);
        session::flash('statuscode','info');
        return redirect('theme/theme_settings')->with('status','Collection is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = EcommerceCollection::findOrFail($id);
        $collection->delete();
        $product = Product::where('collection_id',$id)->delete();

        session::flash('statuscode','error');
        return back()->with('status','Collection is Deleted');
    }
}