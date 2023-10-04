<?php

namespace App\Http\Controllers\API\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Template\Booking\BookingAppUser;
use App\Models\Template\Booking\BookingShop;
use App\Role;
use App\Models\Template\Booking\BookingUserInformation;
use App\Models\Template\Booking\BookingUserCarData;
use App\Models\Template\Booking\BookingCartype;
use App\Models\Template\Booking\BookingDeal;
use App\Models\Template\Booking\BookingService;
use App\Models\Template\Booking\BookingDealservice;
use App\Models\Template\Booking\BookingPostcode;
use App\Models\Template\Booking\BookingWorkingday;
use Carbon\Carbon;
use App\Models\Template\Booking\BookingOrder;
use App\Models\Template\Booking\Postcode;
use DB;
use URL;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Template\Booking\BookingFaq;
use Paginate;
use App\Models\Template\Booking\BookingJobimages;
use App\Models\Template\Booking\ApplyBookingPromo;
use App\Models\Template\Booking\BookingCardDetail;
use App\Models\Template\Booking\BookingPromo;
use App\Models\Template\Booking\BookingContactUs;
use App\Models\Template\Booking\BookingCount;
use App\PushNotification;

class AppController extends Controller
{
    public function cartypes()
    {
        $cartypes = BookingCartype::whereStatus('active')->orderBy('id', 'asc')->get();
        if (count($cartypes) > 0) :
            $total = count($cartypes);
            // for ($i = 0; $i < $total; $i++) {
            //     $cartypes[$i]['s_image'] = URL::to('/') . '/images/' . $cartypes[$i]['s_image'];
            // }
            return response()->json(['status' => true, 'message' => 'List of all cartypes.', 'payload' => $cartypes]);
        else :
            return response()->json(['status' => false, 'message' => 'No cartype found.']);
        endif;
    }

    public function deals()
    {
        $deals = BookingDeal::whereStatus('active')->orderBy('id', 'asc')->get();
        if (count($deals) > 0) :
            $total = count($deals);
            for ($i = 0; $i < $total; $i++) {
                // $deals[$i]['s_image'] = URL::to('/') . '/images/' . $deals[$i]['s_image'];
            }
            return response()->json(['status' => true, 'message' => 'List of all deals.', 'payload' => $deals]);
        else :
            return response()->json(['status' => false, 'message' => 'No deal found.']);
        endif;
    }

    public function free_booking_deals()
    {
        $first =  "Sho'Up N Wash";
        $second =  "Sho'Up N Clean";
        $second_deal = BookingDeal::where('name', $second)->first();
        $deals = BookingDeal::whereStatus('active')->where('name', '!=', $first)->orderBy('id', 'asc')->get();
        if (count($deals) > 0) :
            $total = count($deals);
            for ($i = 0; $i < $total; $i++) {
                // $deals[$i]['s_image'] = URL::to('/') . '/images/' . $deals[$i]['s_image'];
                $deals[$i]['price'] = number_format($deals[$i]['price'] - $second_deal->price, 2);
            }
            return response()->json(['status' => true, 'message' => 'List of deals for free booking.', 'discount' => number_format($second_deal->price, 2), 'payload' => $deals]);
        else :
            return response()->json(['status' => false, 'message' => 'No deal found.']);
        endif;
    }

    public function vat_servicefee()
    {
        $results = BookingShop::first(['vat', 'servicefee']);
        if (!is_null($results)) :

            return response()->json(['status' => true, 'message' => 'Vat and service fee.', 'payload' => $results]);
        else :
            return response()->json(['status' => false, 'message' => 'No data found.']);
        endif;
    }

    /*--Old Api--*/

    public function postcode(Request $request)
    {
        $rules = ['postcode' => 'required', 'lat' => 'required', 'long' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $shop = BookingShop::first();
            if (!is_null($shop)) {
                $results = BookingShop::select(['*', DB::raw('( 6371 * acos( cos( radians(' . $request->lat . ') ) * cos( radians( shop_lat ) ) * cos( radians( shop_long ) - radians(' . $request->long . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians(shop_lat) ) ) ) AS distance')])->first();
                $postcode = str_replace(' ', '', $request->postcode);
                if ($results->distance <= 3 && strtoupper($shop->shop_location) == strtoupper($postcode)) {
                    return response()->json(['status' => true, 'message' => "Thanks for using ShoUp Car wash App."]);
                } else {
                    return response()->json(['status' => false, 'message' => "Sorry,We do not provide service in your area.!"]);
                }
            }
        }
    }

    public function postcode_new(Request $request)
    {
        $data = str_replace(' ', '', trim($request->postcode));
        $postcode =  strtoupper($data);
        if (strlen($postcode) == 6) {
            $first =  substr($postcode, 0, 3);
            $last = substr($postcode, 3);
            $postcode_final = $first . " " . $last;
        } else {
            $first =  substr($postcode, 0, 4);
            $last = substr($postcode, -3);
            $postcode_final = $postcode_final = $first . " " . $last;
        }
        $post_Data =  BookingPostcode::where('postcode', $postcode_final)->first();
        if ($post_Data) {
            $results = BookingShop::select(['*', DB::raw('( 6371 * acos( cos( radians(' . $post_Data->latitude . ') ) * cos( radians( shop_lat ) ) * cos( radians( shop_long ) - radians(' . $post_Data->longitude . ') ) + sin( radians(' . $post_Data->latitude . ') ) * sin( radians(shop_lat) ) ) ) AS distance')])->first();

            if ($results->distance <= 8.04672) {
                return response()->json(['status' => true, 'data' => $post_Data, 'message' => "Thanks for using Corner Shop App."]);
            } else {
                return response()->json(['status' => false, 'message' => "Sorry,We can't deliver to this area."]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Postcode is not correct"]);
        }
    }

    public function deal_services(Request $request)
    {
        $rules = ['deal_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $deal_service = BookingDealservice::select('service_id')->where('deal_id', $request->deal_id)->get()->toArray();
            $ids = array();
            foreach ($deal_service as $key => $value) {
                array_push($ids, $value['service_id']);
            }

            $services = BookingService::whereIn('id', $ids)->get(['id', 'name']);

            if (count($services) > 0) :
                return response()->json(['status' => true, 'message' => 'List of services included in deal.', 'payload' => $services]);
            else :
                return response()->json(['status' => false, 'message' => 'No deal services found.']);
            endif;
        }
    }

    public function workingday_time(Request $request)
    {
        $rules = ['date' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $date = $request->date;
            $day = Carbon::parse($date)->format('l');
            $booked_slot = BookingOrder::where('date', $date)->get('time')->toArray();
            $booked_time = array();
            if ($booked_slot) {
                foreach ($booked_slot as $key => $value) {
                    array_push($booked_time, $value['time']);
                }
            }
            $days_time = BookingWorkingday::where('day_name', $day)->get(['day_name', 'start_time', 'end_time', 'status'])->toArray();
            $days_time[0]['booked_slots'] = $booked_time;
            if (count($days_time) > 0) :
                return response()->json(['status' => true, 'message' => 'Working time and booked slots.', 'payload' => $days_time]);
            else :
                return response()->json(['status' => false, 'message' => 'No Working day and time found']);
            endif;
        }
    }


    public function faqs()
    {
        $faqs = BookingFaq::paginate(10, ['id', 'question', 'answer']);
        if (count($faqs) > 0) :
            return response()->json(['status' => true, 'message' => 'List of all faqs.', 'payload' => $faqs]);
        else :
            return response()->json(['status' => false, 'message' => 'No faqs found.']);
        endif;
    }

    /*------------------Single Customer API-------------------------------*/

    public function add_newcar(Request $request)
    {
        $rules = ['cartype' => 'required', 'licence_plate' => 'required|unique:booking_user_car_data', 'make' => 'required', 'model' => 'required', 'year' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $customer_id = Auth::guard('booking_app_user_api')->user()->id;
            $user_car_data = new BookingUserCarData;
            $user_car_data->app_user_id = $customer_id;
            $user_car_data->licence_plate = $request->licence_plate;
            $user_car_data->make = $request->make;
            $user_car_data->model = $request->model;
            $user_car_data->year = $request->year;
            $user_car_data->cartype = $request->cartype;
            if ($user_car_data->save()) :
                return response()->json(['status' => true, 'message' => 'Car added successfully']);
            else :
                return response()->json(['status' => false, 'message' => 'Something went wrong.']);
            endif;
        }
    }

    public function customer_allcars(Request $request)
    {
        $all_cars = BookingUserCarData::where('app_user_id', $request->user()->id)->get();
        if (count($all_cars) > 0) :
            $total = count($all_cars);
            for ($i = 0; $i < $total; $i++) {
                $cartype = BookingCartype::find($all_cars[$i]['cartype']);
                $all_cars[$i]['cartype'] = $cartype->name;
            }
            return response()->json(['status' => true, 'message' => 'List of all cars', 'payload' => $all_cars]);
        else :
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        endif;
    }

    public function select_car(Request $request)
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $update = BookingUserCarData::where('app_user_id', $request->user()->id)->update(['mode' => '0']);
            $set_default = BookingUserCarData::where([['app_user_id', '=', $request->user()->id], ['id', '=', $request->id]])
                ->update(['mode' => '1']);

            if ($set_default) :
                return response()->json(['status' => true, 'message' => 'Customer default car updated']);
            else :
                return response()->json(['status' => false, 'message' => 'Something went wrong.']);
            endif;
        }
    }

    public function remove_car(Request $request)
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $car = BookingUserCarData::find($request->id);
            if ($car) :
                $car->delete();
                return response()->json(['status' => true, 'message' => 'Car removed successfully']);
            else :
                return response()->json(['status' => false, 'message' => 'Something went wrong.']);
            endif;
        }
    }

    /*--------------------------------Booking and Payment Section-------------------------------------*/


    public function check_promo(Request $request)
    {
        $rules = ['promo_code' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $check_promo = BookingPromo::where('promo_code', $request->promo_code)->whereStatus('active')->first();
            if (!is_null($check_promo)) {
                return response()->json(['status' => true, 'message' => 'Promo code details.', 'payload' => $check_promo]);
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid promo code.']);
            }
        }
    }

    public function apply_promo(Request $request)
    {
        $rules = ['promo_code' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $check_promo = BookingPromo::where('promo_code', $request->promo_code)->whereStatus('active')->first();
            if (!is_null($check_promo)) {
                $user = BookingAppUser::find($request->user()->id);
                if (!is_null($user)) :
                    $check_if_applied = ApplyBookingPromo::whereAppUserId($user->id)->where('promo_id', $check_promo->id)->first();
                    if (!is_null($check_if_applied)) :
                        return response()->json(['status' => false, 'message' => 'Promo code already used']);
                    else :
                        return response()->json(['status' => true, 'message' => 'Promo code details.', 'payload' => $check_promo]);
                    endif;
                else :
                    return response()->json(['status' => false, 'message' => 'User not found.']);
                endif;
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid promo code.']);
            }
        }
    }

    public function add_cards(Request $request)
    {
        $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
        if (!is_null($user)) :
            if ($request->isMethod('post')) :
                if (isset($request->card_id)) {
                    $cards = BookingCardDetail::whereAppUserId($user->id)->find($request->card_id);
                    if (!is_null($cards)) {
                        $cards->delete();
                        return response()->json(['status' => true, 'message' => 'Your card info has been deleted.']);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Card info not found.']);
                    }
                } else {
                    $rules = ['card_no' => 'required', 'exp_year' => 'required|numeric', 'exp_month' => 'required|numeric'];
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
                    } else {
                        $lists = BookingCardDetail::whereUserId($user->id)->where('card_no', $request->card_no)->get();
                        if (count($lists) > 0) {
                            return response()->json(['status' => false, 'message' => 'Card Details already exists.']);
                        } else {
                            $month = sprintf("%02d", $request->exp_month);
                            BookingCardDetail::create(['app_user_id' => $user->id, 'card_no' => $request->card_no, 'exp_year' => $request->exp_year, 'exp_month' => $month]);
                            return response()->json(['status' => true, 'message' => 'New card info has been created.']);
                        }
                    }
                }
            endif;
            if ($request->isMethod('get')) :
                $cards = BookingCardDetail::whereAppUserId($user->id)->get();
                if (count($cards) > 0) {
                    return response()->json(['status' => true, 'message' => 'List of all cards.', 'payload' => $cards]);
                } else {
                    return response()->json(['status' => false, 'message' => 'No card detail found.']);
                }
            endif;
        else :
            return response()->json(['status' => false, 'message' => 'User not found.']);
        endif;
    }



    public function generate_token()
    {
        return config('stripe.stripe_key');
        Stripe::setApiKey(config('stripe.stripe_secret'));
        $connectionToken = \Stripe\Token::create(['card' => [
            'number' => '4242424242424242',
            'exp_month' => 6,
            'exp_year' => 2021,
            'cvc' => '314',
        ],]);
        return $connectionToken;
    }

    public function add_booking(Request $request)
    {
        $rules = [
            'cartype_id' => 'required',
            'deal_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'vat' => 'required',
            'service_fee' => 'required',
            'total' => 'required',
            'licence_plate' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'booking_type' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $stripe = Stripe::setApiKey(config('stripe.stripe_secret'));
            $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
            if (!is_null($user)) {
                $booking_datetime = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));
                if ($request->booking_type == 0 || $request->booking_type == 2) {
                    $rules = ['stripe_id' => 'required'];
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
                    }

                    $results = BookingShop::first();
                    try {
                        $customer = Customer::create(array(
                            "name" => $user->name,
                            "email" => $user->email,
                            "phone" => $user->mobile,
                            "address" => ["city" => $user->user_information->city, "country" => "GB", "line1" =>  $user->user_information->address, "postal_code" => $user->user_information->postcode],
                            "source" => $request->stripe_id,
                            'description' => 'My First Test Customer (created for API docs)',
                        ));
                    } catch (\Stripe\Exception\CardException $e) {
                        $payload = array("status" => $e->getHttpStatus(), "type" => $e->getError()->type, "code" => $e->getError()->code, "param" => $e->getError()->param, "message" => $e->getError()->message);
                        return response()->json(['status' => false, "payload" => $payload, "message" => $e->getError()->message]);
                    } catch (\Stripe\Exception\RateLimitException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\InvalidRequestException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\AuthenticationException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\ApiConnectionException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\ApiErrorException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (Exception $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    }
                    try {
                        if (!empty($request->promo_id) && isset($request->promo_id)) :
                            $amount = $request->grand_total;
                        else :
                            $amount = $request->total;
                        endif;

                        $amount = number_format($amount);

                        $charge = Charge::create(array(
                            'customer' => $customer->id,
                            'amount'   =>  $amount * 100,
                            'currency' => $results->currency,
                            'description' => "Booking for Sho'up",
                            'receipt_email' => $user->email
                        ));

                        $status = $charge['status'];
                        if ($status == "succeeded") {
                            if ($request->booking_type == 0) {
                                if (!empty($request->promo_id) && isset($request->promo_id)) :
                                    $apply_promo = new ApplyBookingPromo;
                                    $apply_promo->app_user_id = $user->id;
                                    $apply_promo->promo_id = $request->promo_id;
                                    $apply_promo->total = $request->total;
                                    $apply_promo->discount_price = $request->discount_price;
                                    $apply_promo->grand_total = $request->grand_total;
                                    $apply_promo->save();
                                endif;
                            }
                            $latestOrder = new BookingOrder;
                            $latestOrder->app_user_id = Auth::guard('booking_app_user_api')->user()->id;
                            $latestOrder->stripe_id = $request->stripe_id;
                            $latestOrder->cartype_id = $request->cartype_id;
                            $latestOrder->deal_id = $request->deal_id;
                            $latestOrder->date = $request->date;
                            $latestOrder->time = $request->time;
                            $latestOrder->vat = $request->vat;
                            $latestOrder->service_fee = $request->service_fee;
                            $latestOrder->total = $amount;
                            $latestOrder->licence_plate = $request->licence_plate;
                            $latestOrder->make = $request->make;
                            $latestOrder->model = $request->model;
                            $latestOrder->year = $request->year;
                            $latestOrder->booking_datetime = $booking_datetime;
                            $latestOrder->payment_recipt = $charge['receipt_url'];
                            $latestOrder->booking_type = $request->booking_type;
                            if ($latestOrder->save()) :
                                $order = BookingOrder::find($latestOrder->id);
                                if ($request->booking_type == 0) {
                                    if (isset($apply_promo) && !is_null($apply_promo)) :
                                        $order->apply_promo_id = $apply_promo->id;
                                    endif;
                                }
                                if ($request->booking_type == 2) {
                                    BookingCount::where('app_user_id', $order->app_user_id)->delete();
                                }
                                $order->order_no = '#' . str_pad($latestOrder->id + 1, 3, "0", STR_PAD_LEFT);
                                if ($order->save()) :

                                    $registration_ids = $order->user->firebase_token;
                                    if (!is_null($registration_ids)) {
                                        $message = [
                                            "to" => $registration_ids,
                                            "priority" => 'high',
                                            "sound" => 'default',
                                            "badge" => '1',
                                            "notification" =>
                                            [
                                                "title" => "New Booking",
                                                "body" => "You have new booking to confirm.",
                                            ],
                                            "data" =>
                                            [
                                                "order_id" => $order->id,
                                                "order_no" => $order->order_no
                                            ]
                                        ];
                                        PushNotification::send($message);
                                    }

                                    return response()->json(['status' => true, 'message' => 'booking added successfully.', 'payload' => $order->order_no]);
                                else :
                                    return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                                endif;
                            else :
                                return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                            endif;
                        } elseif ($status == "pending") {
                            return response()->json(['status' => false, 'message' => 'Sorry, the payment cannot be completed now. Please try again later.']);
                        } else {
                            return response()->json(['status' => false, 'message' => 'Sorry, the payment cannot be completed now. Please try again later.']);
                        }
                    } catch (\Stripe\Exception\CardException $e) {
                        $payload = array("status" => $e->getHttpStatus(), "type" => $e->getError()->type, "code" => $e->getError()->code, "param" => $e->getError()->param, "message" => $e->getError()->message);
                        return response()->json(['status' => false, "payload" => $payload, "message" => $e->getError()->message]);
                    } catch (\Stripe\Exception\RateLimitException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\InvalidRequestException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\AuthenticationException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\ApiConnectionException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (\Stripe\Exception\ApiErrorException $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    } catch (Exception $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()]);
                    }
                } elseif ($request->booking_type == 1) {
                    $latestOrder = new BookingOrder;
                    $latestOrder->app_user_id = Auth::guard('booking_app_user_api')->user()->id;
                    $latestOrder->stripe_id = "FREE";
                    $latestOrder->cartype_id = $request->cartype_id;
                    $latestOrder->deal_id = $request->deal_id;
                    $latestOrder->date = $request->date;
                    $latestOrder->time = $request->time;
                    $latestOrder->vat = $request->vat;
                    $latestOrder->service_fee = $request->service_fee;
                    $latestOrder->total = $request->total;
                    $latestOrder->licence_plate = $request->licence_plate;
                    $latestOrder->make = $request->make;
                    $latestOrder->model = $request->model;
                    $latestOrder->year = $request->year;
                    $latestOrder->booking_datetime = $booking_datetime;
                    $latestOrder->payment_recipt = "FREE";
                    $latestOrder->booking_type = $request->booking_type;
                    if ($latestOrder->save()) :
                        $order = BookingOrder::find($latestOrder->id);
                        BookingCount::where('app_user_id', $order->app_user_id)->delete();
                        $order->order_no = '#' . str_pad($latestOrder->id + 1, 3, "0", STR_PAD_LEFT);
                        if ($order->save()) :
                            $this->admin_employee_tokens($order->id, $order->order_no);
                            return response()->json(['status' => true, 'message' => 'Booking added successfully.', 'payload' => $order->order_no]);
                        else :
                            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                        endif;
                    else :
                        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                    endif;
                }
            } else {
                return response()->json(['status' => false, 'message' => 'User not found.']);
            }
        }
    }

    public function contact_us(Request $request)
    {
        $rules = ['name' => 'required', 'email' => 'required', 'comment' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $contact_us = new BookingContactUs;
                $contact_us->name = $request->name;
                $contact_us->email = $request->email;
                $contact_us->message = $request->comment;
                if ($contact_us->save()) {
                    return response()->json(['status' => true, 'message' => 'Thank you for contacting us – we will get back to you soon!']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                }
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }


    public function cust_upcomeing_booking(Request $request)
    {
        try {
            $carbon = Carbon::now('Asia/Kolkata');
            $today_date_time = $carbon->toDateTimeString();
            $booking = BookingOrder::with('deal:id,name')->where('app_user_id', Auth::guard('booking_app_user_api')->user()->id)->where('status', '<=', '1')->where('booking_datetime', '>=', $today_date_time)->orderBy('booking_datetime', 'asc')->paginate(10);
            if (count($booking) > 0) :
                return response()->json(['status' => true, 'message' => 'List of all upcoming jobs.', 'payload' => $booking]);
            else :
                return response()->json(['status' => false, 'message' => 'No upcoming jobs found.']);
            endif;
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function cust_view_booking(Request $request)
    {
        $rules = ['booking_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $booking = BookingOrder::with('deal:id,name', 'cartype:id,name', 'apply_promo:id,promo_id,app_user_id,total,grand_total,discount_price')->find($request->booking_id, ['cartype_id', 'deal_id', 'payment_recipt', 'licence_plate', 'make', 'model', 'year', 'date', 'time', 'order_no', 'apply_promo_id', 'vat', 'service_fee', 'total', 'apply_promo_id']);

                if (!is_null($booking)) :
                    if (!is_null($booking['apply_promo'])) {
                        $booking['promo_details'] = BookingPromo::find($booking['apply_promo']['promo_id']);
                    }

                    $job_done_image = BookingJobimages::where('order_id', $request->booking_id)->get(['type', 'image']);
                    if (!is_null($job_done_image)) :
                        $total = count($job_done_image);
                        for ($i = 0; $i < $total; $i++) {
                            $job_done_image[$i]['image'] = URL::to('/') . '/' . $job_done_image[$i]['image'];
                        }
                        $booking['booking_images'] = $job_done_image;
                    endif;

                    return response()->json(['status' => true, 'message' => 'Booking full Details.', 'payload' => $booking]);
                else :
                    return response()->json(['status' => false, 'message' => 'Booking not found.']);
                endif;
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function cust_cancel_booking(Request $request)
    {
        $rules = ['booking_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $booking = BookingOrder::find($request->booking_id);
                if (!is_null($booking)) :
                    $booking->status = 3;
                    $booking->save();
                    return response()->json(['status' => true, 'message' => 'Booking cancelled successfully.']);
                else :
                    return response()->json(['status' => false, 'message' => 'Booking not found.']);
                endif;
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function cust_completed_booking(Request $request)
    {
        try {
            $booking = BookingOrder::with('deal:id,name')->where('app_user_id', $request->user()->id)->where('status', '2')->orderBy('booking_datetime', 'asc')->paginate(10);
            if (count($booking) > 0) :
                return response()->json(['status' => true, 'message' => 'List of all completed jobs.', 'payload' => $booking]);
            else :
                return response()->json(['status' => false, 'message' => 'No completed jobs found.']);
            endif;
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function booking_count(Request $request)
    {
        try {
            $booking_count =  BookingCount::where('app_user_id', $request->user()->id)->first(['booking_count']);
            if ($booking_count) {
                $total_booking = $booking_count['booking_count'];
            } else {
                $total_booking = 0;
            }
            return response()->json(['status' => true, 'message' => 'No of booking count.', 'payload' => $total_booking]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /*--------------------------------Admin app API Start-------------------------------------------*/

    public function all_new_jobs()
    {
        $carbon = Carbon::now('Asia/Kolkata');
        $date = $carbon->toDateString();
        $today_date_time = $carbon->toDateTimeString();
        $new_booking = BookingOrder::with('deal:id,name')
            ->whereStatus('0')
            ->where('booking_datetime', '>=', $today_date_time)
            ->orderBy('booking_datetime', 'asc')
            ->paginate(10);

        if (count($new_booking) > 0) :
            return response()->json(['status' => true, 'message' => 'List of all new jobs.', 'payload' => $new_booking]);
        else :
            return response()->json(['status' => false, 'message' => 'No jobs found.']);
        endif;
    }

    public function confirm_booking(Request $request)
    {
        $rules = ['booking_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $order = BookingOrder::find($request->booking_id);
                if (!is_null($order)) :
                    $order->status = '1';
                    if ($order->save()) {
                        $registration_ids = $order->user->firebase_token;
                        if (!is_null($registration_ids)) {
                            $message = [
                                "to" => $registration_ids,
                                "priority" => 'high',
                                "sound" => 'default',
                                "badge" => '1',
                                "type"  => "confimation",
                                "notification" =>
                                [
                                    "title" => "Confirmed",
                                    "body" => "Your booking has been confirmed.",
                                ],
                                "data" =>
                                [
                                    "order_id" => $order->id,
                                    "order_no" => $order->order_no
                                ]
                            ];
                            PushNotification::send($message);
                        }
                        return response()->json(['status' => true, 'message' => 'Booking confirmed successfully.']);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Something went wrong']);
                    }

                else :
                    return response()->json(['status' => false, 'message' => 'Booking Details Not found.']);

                endif;
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function all_upcomeing_jobs()
    {
        $carbon = Carbon::now('Asia/Kolkata');
        $date = $carbon->toDateString();
        $today_date_time = $carbon->toDateTimeString();
        $booking = BookingOrder::with('deal:id,name')->where('status', '1')->where('booking_datetime', '>=', $today_date_time)->orderBy('booking_datetime', 'asc')->paginate(10);
        if (count($booking) > 0) :
            return response()->json(['status' => true, 'message' => 'List of all upcoming jobs.', 'payload' => $booking]);
        else :
            return response()->json(['status' => false, 'message' => 'No upcoming jobs found.']);
        endif;
    }

    public function upcomeing_jobs_by_date(Request $request)
    {
        $rules = ['date' => 'required|date_format:Y-m-d'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $carbon = Carbon::now('Asia/Kolkata');
            $date = $carbon->toDateString();
            $today_date_time = $carbon->toTimeString();
            if ($date == $request->date) {
                $booking = BookingOrder::with('deal:id,name')->where('status', '1')->where('date', '=', $request->date)->where('time', '>=', $today_date_time)->orderBy('time', 'asc')->paginate(10);
            } else {
                $booking = BookingOrder::with('deal:id,name')->where('status', '1')->where('date', '=', $request->date)->orderBy('time', 'asc')->paginate(10);
            }

            if (count($booking) > 0) :
                return response()->json(['status' => true, 'message' => 'List of all upcoming jobs.', 'payload' => $booking]);
            else :
                return response()->json(['status' => false, 'message' => 'No upcoming jobs found for this date.']);
            endif;
        }
    }

    public function admin_view_full_job(Request $request)
    {
        $rules = ['booking_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $booking = BookingOrder::with('deal:id,name', 'cartype:id,name', 'apply_promo:id,promo_id,app_user_id,total,grand_total,discount_price')->find($request->booking_id, ['id', 'app_user_id', 'cartype_id', 'deal_id', 'payment_recipt', 'licence_plate', 'make', 'model', 'year', 'date', 'time', 'order_no', 'apply_promo_id', 'vat', 'service_fee', 'total', 'apply_promo_id']);

                if (!is_null($booking)) :
                    $booking['customer_info'] = BookingAppUser::find($booking['app_user_id'], ['name', 'email', 'mobile']);
                    $booking['customer_address'] = BookingUserInformation::Where('booking_app_user_id', $booking['app_user_id'])->first(['city', 'address', 'address_line', 'postcode']);
                    if (!is_null($booking['apply_promo'])) {
                        $booking['promo_details'] = BookingPromo::find($booking['apply_promo']['promo_id']);
                    }
                    return response()->json(['status' => true, 'message' => 'Booking full Details.', 'payload' => $booking]);
                else :
                    return response()->json(['status' => false, 'message' => 'Booking Details Not found..']);
                endif;
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function job_done(Request $request)
    {
        $rules = ['booking_id' => 'required', 'before_image' => 'required|array', 'after_image' => 'required|array'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $i = 0;
                foreach ($request->file('before_image') as $key => $value) {
                    $filename = time() . '_' . $i . '.' . $value->extension();
                    $value->move('images/job_done/' . $request->booking_id . '/beforeImage/', $filename);
                    $before_img = new BookingJobimages;
                    $before_img->order_id = $request->booking_id;
                    $before_img->image = 'images/job_done/' . $request->booking_id . '/beforeImage/' . $filename;
                    $before_img->type = 'before';
                    $before_img->save();
                    $i++;
                }

                $q = 0;
                foreach ($request->file('after_image') as $key => $value) {
                    $filename = time() . '_' . $q . '.' . $value->extension();
                    $value->move('images/job_done/' . $request->booking_id . '/afterImage/', $filename);
                    $after_img = new BookingJobimages;
                    $after_img->order_id = $request->booking_id;
                    $after_img->image = 'images/job_done/' . $request->booking_id . '/afterImage/' . $filename;
                    $after_img->type = 'after';
                    $after_img->save();
                    $q++;
                }

                $booking = BookingOrder::find($request->booking_id);
                $booking->status = '2';
                if ($booking->save()) {
                    $registration_ids = $booking->user->firebase_token;
                    if (!is_null($registration_ids)) {
                        $message = [
                            "to" => $registration_ids,
                            "priority" => 'high',
                            "sound" => 'default',
                            "badge" => '1',
                            "notification" =>
                            [
                                "title" => "Completed",
                                "body" => "Your job has been completed.",
                            ],
                            "data" =>
                            [
                                "order_id" => $booking->id,
                                "order_no" => $booking->order_no
                            ]
                        ];
                        PushNotification::send($message);
                    }

                    $check_booking = BookingCount::where('app_user_id', $booking->user_id)->first();
                    if (!is_null($check_booking)) {
                        if ($check_booking->booking_count == 4) {
                            $check_booking->delete();
                        } else {
                            $check_booking->booking_count = $check_booking->booking_count + 1;
                            $check_booking->update();
                        }
                    } else {
                        BookingCount::create(['app_user_id' => $booking->user_id, 'booking_count' => 1]);
                    }

                    $job_done_image = BookingJobimages::where('order_id', $request->booking_id)->get(['type', 'image']);
                    $total = count($job_done_image);
                    for ($i = 0; $i < $total; $i++) {
                        $job_done_image[$i]['image'] = URL::to('/') . '/' . $job_done_image[$i]['image'];
                    }
                    return response()->json(['status' => true, 'message' => 'New information has been created successfully.', 'payload' => $job_done_image]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something went wrong.']);
                }
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function all_completed_jobs()
    {
        try {
            $booking = BookingOrder::with('deal:id,name')->where('status', '2')->orderBy('booking_datetime', 'desc')->paginate(10);
            if (count($booking) > 0) :
                return response()->json(['status' => true, 'message' => 'List of all completed jobs.', 'payload' => $booking]);
            else :
                return response()->json(['status' => false, 'message' => 'No completed jobs found.']);
            endif;
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function admin_view_completed_job(Request $request)
    {
        $rules = ['booking_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $booking = BookingOrder::with('deal:id,name', 'cartype:id,name', 'apply_promo:id,promo_id,app_user_id,total,grand_total,discount_price')->find($request->booking_id, ['id', 'app_user_id', 'cartype_id', 'deal_id', 'payment_recipt', 'licence_plate', 'make', 'model', 'year', 'date', 'time', 'order_no', 'apply_promo_id', 'vat', 'service_fee', 'total', 'apply_promo_id']);

                if (!is_null($booking)) :
                    $booking['customer_info'] = BookingAppUser::find($booking['app_user_id'], ['name', 'email', 'mobile']);
                    $booking['customer_address'] = BookingUserInformation::Where('booking_app_user_id', $booking['app_user_id'])->first(['city', 'address', 'address_line', 'postcode']);
                    if (!is_null($booking['apply_promo'])) {
                        $booking['promo_details'] = BookingPromo::find($booking['apply_promo']['promo_id']);
                    }
                    $job_done_image = BookingJobimages::where('order_id', $request->booking_id)->get(['type', 'image']);
                    if (!is_null($job_done_image)) :
                        $total = count($job_done_image);
                        // for ($i = 0; $i < $total; $i++) {
                        //     $job_done_image[$i]['image'] = URL::to('/') . '/' . $job_done_image[$i]['image'];
                        // }
                        $booking['booking_images'] = $job_done_image;
                    endif;
                    return response()->json(['status' => true, 'message' => 'Completed Booking full Details.', 'payload' => $booking]);
                else :
                    return response()->json(['status' => false, 'message' => 'Completed Booking Details Not found..']);
                endif;
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function admin_employee_tokens($order_id, $order_no)
    {
        $users_id = DB::table('role_user')->where('role_id', '1')->orWhere('role_id', '3')->pluck('app_user_id')->toArray();
        $tokens = BookingAppUser::whereIn('id', $users_id)->get(['id', 'firebase_token']);
        foreach ($tokens as $value) {
            if (is_null($value->firebase_token)) {
                $message = [
                    "to" => $value->firebase_token,
                    "priority" => 'high',
                    "sound" => 'default',
                    "badge" => '1',
                    "notification" =>
                    [
                        "title" => "New Booking",
                        "body" => "You have new booking to confirm",
                    ],
                    "data" =>
                    [
                        "order_id" => $order_id,
                        "order_no" => $order_no
                    ]
                ];
                PushNotification::send($message);
            }
        }
    }
}
