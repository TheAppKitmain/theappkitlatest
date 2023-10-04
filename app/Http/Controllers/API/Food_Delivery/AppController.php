<?php

namespace App\Http\Controllers\API\Food_Delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;
use App\Mail\FoodSendEmail;
use App\ContactUs as contact;
use Validator;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\Food_Delivery\FoodProductAttribute;
use App\Models\Template\Food_Delivery\FoodFeaturedProduct;
use App\Models\Template\Food_Delivery\FoodCart;
use App\Models\Template\Food_Delivery\FoodCartItem;
use App\Models\Template\Food_Delivery\FoodContact;
use App\Models\Template\Food_Delivery\FoodBanner;
use App\Models\Template\Food_Delivery\FoodSendMail;
use App\Models\Template\Food_Delivery\FoodPostcode;
use DB;
class AppController extends Controller
{
    public function shopinfo()
    {
        $shopdata =  FoodShop::select('shop_lat','shop_long')->first();
        if($shopdata):
            return response()->json(['status'=>true,'message'=>'Shop data','payload'=>$shopdata]);
        else:
            return response()->json(['status'=>false,'message'=>'No data found.']);
        endif;

    }
    public function postcode_new(Request $request)
    {
       $data = str_replace(' ', '', trim($request->postcode));
       $postcode =  strtoupper($data);
       if(strlen($postcode) == 6){
        $first =  substr($postcode,0,3);
        $last = substr($postcode,3);
        $postcode_final = $first." ".$last;
       }elseif(strlen($postcode) == 5){
         $first =  substr($postcode,0,2);
         $last = substr($postcode,2);
         $postcode_final = $first." ".$last;
       }else{
        $first =  substr($postcode,0,4);
        $last = substr($postcode,-3);
        $postcode_final = $postcode_final = $first." ".$last;
       }
       //return $postcode_final = wordwrap($postcode,3,' ',true);
       $post_Data = FoodPostcode::where('postcode',$postcode_final)->first();
       if($post_Data)
       {
            $results = FoodShop::select(['*', DB::raw('( 6371 * acos( cos( radians('.$post_Data->latitude.') ) * cos( radians( shop_lat ) ) * cos( radians( shop_long ) - radians('.$post_Data->longitude.') ) + sin( radians('.$post_Data->latitude.') ) * sin( radians(shop_lat) ) ) ) AS distance')])->first();
            if($results->distance <= 6.43738)
            {
                return response()->json(['status'=>true,'data'=>$post_Data,'message'=>"Thanks for using We Go delivery App."]);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>"Sorry,We can't deliver to this area."]);
            }
        }
        else
        {
            return response()->json(['status'=>false,'message'=>"Sorry,We can't deliver to this area."]); 
        }
       

    }

    public function postcode(Request $request)
    {
        // $request['lat'] = "53.455180000000000";
        // $request['long'] = "-2.302130000000000";
        $rules = [ 'postcode'=>'required','lat'=>'required','long'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $shop = FoodShop::first();
            if(!is_null($shop))
            {
                $results = FoodShop::select(['*', DB::raw('( 6371 * acos( cos( radians('.$request->lat.') ) * cos( radians( shop_lat ) ) * cos( radians( shop_long ) - radians('.$request->long.') ) + sin( radians('.$request->lat.') ) * sin( radians(shop_lat) ) ) ) AS distance')])->first();
                $postcode = str_replace(' ', '', $request->postcode);
                //$pattern = "/^.*$postcode.*\$/mi";
                if($results->distance <= 3 && strtoupper($shop->shop_location) == strtoupper($postcode))
                {
                    return response()->json(['status'=>true,'message'=>"Thanks for using We Go delivery App."]);
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>"Sorry, We can't deliver to this area.",'distance'=>$results->distance]);
                }
            }
        }
    }

    public function send_email(Request $request)
    {
        $rules = [ 'postcode'=>'required','email'=>'required|email' ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $send_mail = new FoodSendMail;
            $send_mail->email = $request->email;
            //$send_mail->lat = $request->lat;
            //$send_mail->long = $request->long;
            $send_mail->postcode = $request->postcode;
            if($send_mail->save())
            {
                Mail::to($send_mail->email)->send(new FoodSendEmail($send_mail));
                return response()->json(['status'=>true,'message'=>'Thanks for sharing your information.']);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'Something error while sending mail.']);
            }
        }
    }

    public function categories()
    {
        $categories = FoodCategory::where('parent_id',0)->where('status','active')->orderBy('position','asc')->select('id','name','image')->paginate(10);
        if(count($categories)>0)
        {
            return response()->json(['status'=>true,'payload'=>$categories,'message'=>'List of all categories.']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'No category found.']);
        }
    }


    public function featured_product(Request $request)
    {
        $attribute = FoodProductAttribute::whereStatus('active')->first();
        if(!is_null($attribute)):
            $shop = FoodShop::first();
            $products = FoodFeaturedProduct::with('product')->where('product_attribute_id',$attribute->id)->orderBy('position','asc')->paginate(10);
            $attribute->makeHidden('product_id');
            $attribute->currency = html_entity_decode($shop->currency_symbol);
            foreach($products as $product)
            {
                $product->id = $product->product->id ?? "";
                $product->category_id = $product->product->category_id ?? "";
                $product->product_type = $product->product->product_type ?? "";
                $product->product_name = $product->product->product_name ?? "";
                $product->short_description = $product->product->short_description ?? "";
                $product->long_description = $product->product->long_description ?? "";
                $product->product_image = $product->product->product_image ?? "";
                $product->price = $product->product->price ?? "";
                $product->qty = 1;
                $ids = explode(',',$product->product->category_id);
                $category = FoodCategory::where('status','active')->whereIn('id',$ids)->where('parent_id',0)->get(['id','name']);
                $product->category = $category;
                if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                    if(isset($request->user_id) && !empty($request->user_id)):
                        $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                    else:
                        $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                    endif;
                    if(!is_null($cart)):
                        $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->product->id)->get();
                        $product->cart_items = $cart_items;
                    endif;
                endif;
            }
            $attribute->products = $products;
            return response()->json(['status'=>true,'message'=>'List of all featured products.','payload'=>$attribute]);
        else:
            return response()->json(['status'=>false,'message'=>'No item found.']);
        endif;
    }

    public function products(Request $request)
    {
        $rules = [ 'category_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $category = FoodCategory::with('children:parent_id,id,name,image')->where('status','active')->find($request->category_id,['id','name','image']);
            $results = FoodShop::first();
            $currency =  html_entity_decode($results->currency_symbol);
            if(!is_null($category))
            {
                $ids = $category->children->pluck('id')->toArray();
                $cat_id = (integer)$category->id;
                array_unshift($ids,$cat_id);
                $products = FoodProduct::with('product_informations','product_images')->where('status','active')->whereRaw('FIND_IN_SET(?,category_id)', [$ids])->orderByRaw('position = 0', 'ASC', 'position')->paginate(200);
                //$products = Product::with('product_informations','product_images')->whereIn('category_id',$ids)->orderByRaw('position = 0', 'ASC', 'position')->paginate(10);
                //$products = Product::with('product_informations','product_images')->where('category_id', 'like', '%' . $category->id . '%')->orderBy('position','asc')->paginate(10);
                
                if(count($products)>0)
                {
                    foreach($products as $product):
                        $product->qty = 1;
                        if(count($product->product_informations)>0):
                            $variation_id = $product->product_informations->pluck('id')->first();
                            $product->product_information_id = $variation_id;
                        endif;
                        if(is_null($product->product_image)):
                            $product->product_image = asset('images/default.jpg');
                        endif;
                        if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                            if(isset($request->user_id) && !empty($request->user_id)):
                                $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                            else:
                                $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                            endif;
                            if(!is_null($cart)):
                                $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                                $product->cart_items = $cart_items;
                            endif;
                        endif;

                    endforeach;
                    return response()->json(['status'=>true,'payload'=>array("categories"=>$category,"products"=>$products),'currency'=>$currency,'message'=>'List of all products.']);
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'No category found.']);
            }
        }
    }

    public function single_product_detail(Request $request)
    {
        $imagess = array();
        $rules = [ 'product_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
			$results = FoodShop::first();
            $currency =  html_entity_decode($results->currency_symbol);
            $product = FoodProduct::with('product_informations')->where('status','active')->find($request->product_id);
            if(is_null($product))
            {
                return response()->json(['status'=>false,'message'=>'No product found!.']);
            }
            else
            {
                if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                    if(isset($request->user_id) && !empty($request->user_id)):
                        $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                    else:
                        $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                    endif;
                    if(!is_null($cart)):
                        $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                        $product->cart_items = $cart_items;
                    endif;
                endif;
                $product->qty = 1;
                if(count($product->product_informations)>0):
                    $variation_id = $product->product_informations->pluck('id')->first();
                    $product->product_information_id = $variation_id;
                endif;
                if(is_null($product->product_image)):
                    $product->product_image = asset('images/default.jpg');
                    $product->product_images[] = array("id"=>$product->id,"product_id"=>$product->id,"product_image"=>asset('images/default.jpg'));
                else:

                    $product->product_images[] = array("id"=>$product->id,"product_id"=>$product->id,"product_image"=>$product->product_image);
                    foreach($product->product_images as $image)
                    {
                        array_push($imagess, $image);
                    }
                    unset($product->product_images);
                    $product->product_images = array_reverse($imagess);
                endif;
                $ids = explode(',',$product->category_id);
                $categories = FoodCategory::where('status','active')->findMany($ids,['id','name','image']);
                
                return response()->json(['status'=>true,'payload'=>array('product'=>$product,'categories'=>$categories),'currency'=>$currency,'message'=>'']);
            }
        }
    }

    public function product_show_according_to_catsub(Request $request)
    {
        $rules = [ 'category_id'=>'required|integer','subcategory_id'=>'required|integer' ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $categories = FoodCategory::with('children:parent_id,id,name,image')->where('status','active')->whereParentId($request->category_id)->whereId($request->subcategory_id)->first();
            if(!is_null($categories))
            {
                // $products = Product::with('product_informations','product_images')->where('category_id', 'like', '%' . $categories->id . '%')->orderBy('position','asc')->paginate(10);
    
                $ids = array($categories->id);
                $cat_id = (integer)$categories->parent_id;
                array_push($ids,$cat_id);

                $products = FoodProduct::with('product_informations','product_images')->where('status','active')->whereRaw('FIND_IN_SET(?,category_id)', [$ids])->orderByRaw('position = 0', 'ASC', 'position')->paginate(10);

                //$products = Product::with('product_informations','product_images')->whereIn('category_id',$ids)->orderByRaw('position = 0', 'ASC', 'position')->paginate(10);
                $results = FoodShop::first();
                $currency =  html_entity_decode($results->currency_symbol);
                if(count($products)>0)
                {
                    foreach($products as $product):
                        $product->qty = 1;
                        if(count($product->product_informations)>0):
                            $variation_id = $product->product_informations->pluck('id')->first();
                            $product->product_information_id = $variation_id;
                        endif;
                        if(is_null($product->product_image)):
                            $product->product_image = asset('images/default.jpg');
                        endif;
                        if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                            if(isset($request->user_id) && !empty($request->user_id)):
                                $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                            else:
                                $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                            endif;
                            if(!is_null($cart)):
                                $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                                $product->cart_items = $cart_items;
                            endif;
                        endif;

                    endforeach;
                    return response()->json(['status'=>true,'payload'=>array("categories"=>$categories,"products"=>$products),'currency'=>$currency,'message'=>'List of all products.']);
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'No category found.']);
            }
        }
    }

    public function search_product(Request $request)
    {
        $rules = [ 'search'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $products = FoodProduct::where('status','active')->where('product_name', 'like', '%' . $request->search . '%')->orderByRaw('position = 0', 'ASC', 'position')->pluck('product_name')->toArray();
            $categories = FoodCategory::where('status','active')->where('name', 'like', '%' . $request->search . '%')->orderBy('id','desc')->select('id','name','image')->pluck('name')->toArray();
            $new = array_merge($products, $categories);
            if(!empty($new))
            {
                return response()->json(['status'=>true,'paylaod'=>$new]);
            }
            else
            {
                return response()->json(['status'=>true,'paylaod'=>"no result found."]);
            }
        }
    }

    public function search(Request $request)
    {
        $rules = [ 'search'=>'required', ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        { 
            $products = FoodProduct::with('product_informations','product_images')->where('status','active')->where('product_name', 'like', '%' . $request->search . '%')->orderByRaw('position = 0', 'ASC', 'position')->get();
            $categories = FoodCategory::where('status','active')->where('name', 'like', '%' . $request->search . '%')->orderBy('id','desc')->select('id','name','image')->get();
            $results = FoodShop::first();
            $currency =  html_entity_decode($results->currency_symbol);
            if((count($products)>0)||(count($categories)>0))
            {
                foreach($products as $product):
                    $product->qty = 1;
                    if(count($product->product_informations)>0):
                        $variation_id = $product->product_informations->pluck('id')->first();
                        $product->product_information_id = $variation_id;
                    endif;
                    if(is_null($product->product_image)):
                        $product->product_image = asset('images/default.jpg');
                    endif;
                    if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                        if(isset($request->user_id) && !empty($request->user_id)):
                            $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                        else:
                            $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                        endif;
                        if(!is_null($cart)):
                            $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                            $product->cart_items = $cart_items;
                        endif;
                    endif;
                endforeach;
                return response()->json(['status'=>true,'message'=>'','payload'=>array('products'=>$products,'currency'=>$currency,'categories'=>$categories)]);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>$request->search.' search record not found.']);
            }
        } 
    }

    public function contact_us(Request $request)
    {
        $rules = [ 'name'=>'required','comment'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $contact_us = new FoodContact;
            $contact_us->name = $request->name;
            $contact_us->template_id = $request->template_id; 
            $contact_us->app_user_id = $request->app_user_id;
            //$contact_us->email = $request->email;
            $contact_us->message = $request->comment;
			//$contact_us->order_id = $request->order_no;
            $contact_us->phone_no = $request->phone_no;
            if($contact_us->save())
            {
               // Mail::to($contact_us->email)->send(new ContactUs());
                return response()->json(['status'=>true,'message'=>'Thanks for contacting with us.']);
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'Something problem occur.']);
            }
        }
    }

    public function related_products(Request $request)
    {
        $rules = [ 'category_id'=>'required','product_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $cat = explode(',',$request->category_id);
            $products = FoodProduct::with('product_informations','product_images')->where('status','active')->whereIn('category_id',[$request->category_id])->where('id','!=',$request->product_id)->orderByRaw('position = 0', 'ASC', 'position')->paginate(10);
            //$products = Product::with('product_informations','product_images')->where('category_id', 'like', '%' . $request->category_id . '%')->where('id','!=',$request->product_id)->orderBy('position','asc')->paginate(10);
            $results = FoodShop::first();
            if(count($products)>0):
                foreach($products as $product):
                    $product->qty = 1;
                    if(count($product->product_informations)>0):
                        $variation_id = $product->product_informations->pluck('id')->first();
                        $product->product_information_id = $variation_id;
                    endif;
                    if(is_null($product->product_image)):
                        $product->product_image = asset('images/default.jpg');
                    endif;
                    $ids = explode(',',$product->category_id);
                    $category = FoodCategory::where('status','active')->whereIn('id',$ids)->where('parent_id',0)->get(['id','name']);
                    $product->category = $category;
                    $product->price = html_entity_decode($results->currency_symbol)." ".$product->price;
                    if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                        if(isset($request->user_id) && !empty($request->user_id)):
                            $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                        else:
                            $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                        endif;
                        if(!is_null($cart)):
                            $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                            $product->cart_items = $cart_items;
                        endif;
                    endif;
                endforeach;
                return response()->json(['status'=>true,'payload'=>$products,'message'=>'List of related products']);
            else:
                return response()->json(['status'=>false,'message'=>'No related products found.']);
            endif;
        }
    }

    public function banners()
    {
        $banners = FoodBanner::whereStatus('active')->orderBy('position','asc')->get();
        if(count($banners)>0):
            return response()->json(['status'=>true,'message'=>'List of all banners.','payload'=>$banners]);
        else:
            return response()->json(['status'=>false,'message'=>'No banner found.']);
        endif;
    }
}
