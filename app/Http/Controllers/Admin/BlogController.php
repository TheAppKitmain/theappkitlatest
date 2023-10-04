<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Blog;
use App\Blogcategories;
use App\Blogmeta;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Blog::with('blog_meta')->orderBy('post_date','desc')->paginate(5);
        foreach($posts as $post){
          if($post->blogcategory_id == 0){
           $post->category_name = 'Article';
          }else{
           $categories = Blogcategories::where('id',$post->blogcategory_id)->first();
           $post->category_name = $categories->name;
          }
        }
        return view("admin.super_admin.blog.index",compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Blogcategories::orderBy('id','asc')->get();
        return view("admin.super_admin.blog.create",compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['category_id'=>"required",'post_title' => 'required|unique:blogs']);
        $carbon = Carbon::now();
        $today_date_time = $carbon->toDateTimeString();
        $post = new Blog;
        $post->user_id =  Auth::id();
        $post->post_title = $request->post_title;
        $post->post_name = Str::slug($request->post_title, '-');
        $post->post_content = $request->post_content;
        $post->post_status = $request->post_status;
        $post->post_date = $today_date_time;
        $post->blogcategory_id =$request->category_id;

        if($post->save()){ 
                $post_meta = new Blogmeta;
                $post_meta->blog_id = $post->id;
                $post_meta->video_url = $request->video_url;
                $post_meta->seo_title = $request->seo_title;
                $post_meta->meta_tags = $request->meta_tags;
                $post_meta->meta_description = $request->meta_description;
                $image = $request->file('thumbnail');
                if ($image) {

	            $name = time().'.'.$image->getClientOriginalExtension();
	            $image_full_name = 'img_'.$name;
	            $filePath = 'theappkit/theappkitproject/superadmin/blogcategory/' . $image_full_name;
	            Storage::disk('s3')->put($filePath, file_get_contents($image));
	            $url = config('services.base_url')."/theappkit/theappkitproject/superadmin/blogcategory/".$image_full_name;
	            $post_meta->thumbnail = $url;
               }
               if($post_meta->save())
               {
                    return redirect()->route('theme_blog.index')->with(['alert'=>'success','message'=>'Blog has been created successfully!.']);
               }
               else
               {
                    return redirect()->route('theme_blog.index')->with(['alert'=>'danger','message'=>'Something went wrong while adding Blog.']); 
               }
        }
        else
        {
          return redirect()->route('theme_blog.index')->with(['alert'=>'danger','message'=>'Something went wrong while adding Blog.']);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $posts = Blog::with('blog_meta')->find($id);
        $categories = Blogcategories::orderBy('id','asc')->get();
        return view("admin.super_admin.blog.edit",compact('posts','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'category_id'=>"required",
            'post_title' => "required|unique:blogs,post_title,".$id
        ]);
        $post = Blog::find($id);
        $post->user_id =  Auth::id();
        $post->post_title = $request->post_title;
        $post->post_name = Str::slug($request->post_title, '-');
        $post->post_content = $request->post_content;
        $post->post_status = $request->post_status;
        $post->blogcategory_id =$request->category_id;

        if($post->update()){ 
                $post_meta = Blogmeta::where('blog_id',$post->id)->first();
                $post_meta->blog_id = $post->id;
                $post_meta->video_url = $request->video_url;
                $post_meta->seo_title = $request->seo_title;
                $post_meta->meta_tags = $request->meta_tags;
                $post_meta->meta_description = $request->meta_description;
                $image = $request->file('thumbnail');
                if ($image) {

	            $name = time().'.'.$image->getClientOriginalExtension();
	            $image_full_name = 'img_'.$name;
	            $filePath = 'theappkit/theappkitproject/superadmin/blogcategory/' . $image_full_name;
	            Storage::disk('s3')->put($filePath, file_get_contents($image));
	            $url = config('services.base_url')."/theappkit/theappkitproject/superadmin/blogcategory/".$image_full_name;
	            $post_meta->thumbnail = $url;
               }
               if($post_meta->update())
               {
                    return redirect()->route('theme_blog.index')->with(['alert'=>'success','message'=>'Blog has been Updated successfully!.']);
               }
               else
               {
                    return redirect()->route('theme_blog.index')->with(['alert'=>'danger','message'=>'Something went wrong while Update Blog.']); 
               }
        }
        else
        {
          return redirect()->route('theme_blog.index')->with(['alert'=>'danger','message'=>'Something went wrong while Update Blog.']);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Blog::with('blog_meta')->find($id);
        if(!is_null($post))
        {
            $post->delete(); 
            return redirect()->route('theme_blog.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Blog has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('theme_blog.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Blog has not been deleted!.']);  
        }
    }
}
