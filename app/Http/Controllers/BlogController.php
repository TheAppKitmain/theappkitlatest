<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blogcategories;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogcategory = null;
        $blogs = Blog::with('blog_meta')->paginate(8);

        foreach($blogs as $blog){

        $blog->date = date('d/m/Y', strtotime($blog->created_at));

        }

        $blogcategories = Blogcategories::get(); 
        return view('appkit_frontend.blogs',compact('blogs','blogcategories','blogcategory'));

    }



    public function bloglist($blogcategory = null){

     $get_category_id = Blogcategories::where('slug',$blogcategory)->first('id');
     $blogs = Blog::where('blogcategory_id',$get_category_id->id)->with('blog_meta')->paginate(8);
     foreach($blogs as $blog){

        $blog->date = date('d/m/Y', strtotime($blog->created_at));

    }
     $blogcategories = Blogcategories::get(); 

     return view('appkit_frontend.blogs',compact('blogs','blogcategories','blogcategory'));

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
       
        $blog = Blog::with('blog_meta')->with('blogcategory')->where('id', $id)->first();

        $blog->date = date('d/m/Y', strtotime($blog->created_at));
        
        return view('appkit_frontend.show_blog',compact('blog'));
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
