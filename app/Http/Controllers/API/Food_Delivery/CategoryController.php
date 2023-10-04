<?php

namespace App\Http\Controllers\API\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\FoodCategory;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
        $categories = FoodCategory::where('parent_id',0)->where('status','active')->where('owner_id',$request->owner_id)->where('template_id',$request->template_id)->orderBy('position','asc')->select('id','name','image')->paginate(10);
        
        if(count($categories)>0)
        {
            return response()->json(['status'=>true,'payload'=>$categories,'message'=>'List of all categories.']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'No category found.']);
        }
    }
}
