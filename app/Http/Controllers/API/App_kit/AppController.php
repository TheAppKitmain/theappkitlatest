<?php

namespace App\Http\Controllers\API\App_kit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Aboutapp;
use App\Designdetail;
use App\Assignpm;
use App\Devloperapps;
use Illuminate\Support\Facades\Storage;
use App\User;

class AppController extends Controller
{
    public function app_detail()
    {
        if (Auth::user()->parent_id == 0) {
            $id = Auth::user()->id;
            $user = User::find($id);
            if ($user->role_id == 1 || $user->role_id == 3) :
                $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'app')->orderBy('id', 'desc')->get();

                if (!empty($aboutapps->logo)) {
                    return response()->json(['status' => true, 'payload' => $aboutapps]);
                } else {
                    return response()->json(['status' => true, 'payload' => $aboutapps, 'designdetail' => "https://theappkit.co.uk/images/placeholder_logo.png"]);
                }

            elseif ($user->role_id == 2) :
                $customers = Assignpm::where('project_manager_id', $id)->pluck('customer_id')->toArray();

                $apps = Aboutapp::with('designdetail')->whereIn('user_id', $customers)->orderBy('id', 'desc')->get();



                if (!empty($apps->logo)) {
                    return response()->json(['status' => true, 'payload' => $apps,]);
                } else {
                    return response()->json(['status' => true, 'payload' => $apps, 'designdetail' => "https://theappkit.co.uk/images/placeholder_logo.png"]);
                }

            else :
            endif;
        } else {
            $id =  Auth::user()->parent_id;
            $user = User::find($id);
            if ($user->role_id == 1 || $user->role_id == 3) :
                $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'app')->orderBy('id', 'desc')->get();

                if (!empty($aboutapps->logo)) {
                    return response()->json(['status' => true, 'payload' => $aboutapps]);
                } else {
                    return response()->json(['status' => true, 'payload' => $aboutapps, 'designdetail' => "https://theappkit.co.uk/images/placeholder_logo.png"]);
                }

            elseif ($user->role_id == 2) :
                $customers = Assignpm::where('project_manager_id', $id)->pluck('customer_id')->toArray();

                $apps = Aboutapp::with('designdetail')->whereIn('user_id', $customers)->orderBy('id', 'desc')->get();



                if (!empty($apps->logo)) {
                    return response()->json(['status' => true, 'payload' => $apps,]);
                } else {
                    return response()->json(['status' => true, 'payload' => $apps, 'designdetail' => "https://theappkit.co.uk/images/placeholder_logo.png"]);
                }

            else :
            endif;
        }
    }


    public function app_store(Request $request)
    {
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_name'] = $request->app_name;
        $data['app_idea'] = $request->app_idea;
        $wireframes = $request->file('wireframes');
        if ($wireframes) {
            $name = time() . '.' . $wireframes->getClientOriginalExtension();
            $image_full_name = 'img_' . $name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($wireframes));
            $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
            $data['wireframes'] = $url;
        }
        $data['idea'] = $request->idea;
        $data['lookfor'] = $request->lookfor;
        $data['website'] = $request->website;
        $data['platform_type'] = "app";
        $aboutapp = Aboutapp::create($data);
        if (!empty($aboutapp)) {
            if ($request->file('app_logo')) {
                $app_logo = new Designdetail;
                $app_logo->user_id = $request->user_id;
                $app_logo->app_id = $aboutapp->id;
                $image = $request->file('app_logo');
                if ($image) {
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $image_full_name = 'img_' . $name;
                    $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($image));
                    $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                    $app_logo->logo = $url;
                }
                $app_logo->save();
            }
            session()->put('app_id', $aboutapp->id);
            return response()->json(['status' => true, 'payload' => 'Great! Schedule a chat with an advisor']);
        } else {
            return back()->with('status', 'Something went wrong');
        }
    }

    public function app_update(Request $request)
    {
        $data = array();
        $data['app_name'] = $request->app_name;
        $data['app_idea'] = $request->app_idea;
        $wireframes = $request->file('wireframes');
        if ($wireframes) {
            $name = time() . '.' . $wireframes->getClientOriginalExtension();
            $image_full_name = 'img_' . $name;
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
            Storage::disk('s3')->put($filePath, file_get_contents($wireframes));
            $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
            $data['wireframes'] = $url;
        }
        $data['idea'] = $request->idea;
        $data['lookfor'] = $request->lookfor;
        $data['website'] = $request->website;
        $data['platform_type'] = "app";
        $aboutapp = Aboutapp::where('id', $request->app_id)->update($data);
        if ($aboutapp == true) {
            if ($request->has('app_logo')) {
                $check_alredy = Designdetail::where('app_id', $request->app_id)->first();
                if (!is_null($check_alredy)) {
                    $image = $request->file('app_logo');
                    if ($image) {
                        $name = time() . '.' . $image->getClientOriginalExtension();
                        $image_full_name = 'img_' . $name;
                        $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                        Storage::disk('s3')->put($filePath, file_get_contents($image));
                        $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                        $check_alredy->logo = $url;
                    }
                    $check_alredy->save();
                } else {
                    $app_logo = new Designdetail;
                    $app_logo->app_id = $request->app_id;
                    $app_logo->user_id = $request->user_id;
                    $image = $request->file('app_logo');
                    if ($image) {
                        $name = time() . '.' . $image->getClientOriginalExtension();
                        $image_full_name = 'img_' . $name;
                        $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                        Storage::disk('s3')->put($filePath, file_get_contents($image));
                        $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                        $app_logo->logo = $url;
                    }
                    $app_logo->save();
                }
            }

            return response()->json(['status' => true, 'payload' => 'App detail updated']);
        } else {
            return response()->json(['status' => false, 'payload' => 'Something went wrong']);
        }
    }
}
