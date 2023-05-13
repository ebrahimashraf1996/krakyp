<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Boughtpackage;
use App\Models\Cart;
use App\Models\Catpackage;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Testpay;



use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Nafezly\Payments\Classes\FawryPayment;


class PaymentsController extends Controller
{
    private $paymob_api_key;
    private $paymob_integration_id;
    private $paymob_iframe_id;
    private $currency;
    private $wallet_integration_id;


    public function __construct()
    {
        $this->paymob_api_key = config('nafezly-payments.PAYMOB_API_KEY');
        $this->paymob_integration_id = config('nafezly-payments.PAYMOB_INTEGRATION_ID');
        $this->paymob_iframe_id = config("nafezly-payments.PAYMOB_IFRAME_ID");
        $this->currency = config("nafezly-payments.PAYMOB_CURRENCY");
        $this->wallet_integration_id = config("nafezly-payments.PAYMOB_WALLET_INTEGRATION_ID");
    }


    public function payment_verify($payment, $order_id) {
//        return decrypt($order_id);
//        $payment = new FawryPayment();

//        $order_id = 14;
        $id = decrypt($order_id);
        $order = Order::with('cart_info')->find($id);
//        $cart_items = Cart::with('order')->where('order_id', 17)->get();
//        $this->setPassedVariablesToGlobal($amount,$user_id,$user_first_name,$user_last_name,$user_email,$user_phone,$source);

        $amount = $order->total_amount;
        $user_id = $order->user_id;
        $user_first_name = $order->first_name;
        $user_last_name = $order->last_name;
        if($order->email != null) {
            $user_email = $order->email;
        } else {
            $user_email = "NA";
        }
        $user_phone = $order->phone;
//        $source = $order->total_amount;

//        $required_fields = ['amount', 'user_first_name', 'user_last_name', 'user_email', 'user_phone'];
//        $this->checkRequiredFields($required_fields, 'PayMob', func_get_args());

         $request_new_token = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/auth/tokens', [
                "api_key" => $this->paymob_api_key
            ])->json();

//        return $request_new_token['token'];

        $get_order = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
                "auth_token" => $request_new_token['token'],
                "delivery_needed" => "false",
                "amount_cents" => $amount * 100,
                "items" => []
            ])->json();

//        return $get_order['id'];

         $get_url_token = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
                "auth_token" => $request_new_token['token'],
                "expiration" => 36000,
                "amount_cents" => $get_order['amount_cents'],
                "order_id" => $get_order['id'],
                "billing_data" => [
                    "apartment" => "NA",
                    "email" => $user_email,
                    "floor" => "NA",
                    "first_name" => $user_first_name,
                    "street" => "NA",
                    "building" => "NA",
                    "phone_number" => $user_phone,
                    "shipping_method" => "NA",
                    "postal_code" => "NA",
                    "city" => "NA",
                    "country" => "NA",
                    "last_name" => $user_last_name,
                    "state" => "NA"
                ],
                "currency" => $this->currency,
                "integration_id" => $this->paymob_integration_id
            ])->json();


            $payment_id = $get_order['id'];
            $redirect_url = "https://accept.paymobsolutions.com/api/acceptance/iframes/" . $this->paymob_iframe_id . "?payment_token=" . $get_url_token['token'];
            $order->payment_id = $payment_id;
            $order->save();

        return redirect($redirect_url);







    }
    
    
    
    public function paymentStatus(Request $request) {
        // return $request->hmac;
        $data = request()->query();
        
        $amount_cents = $data['amount_cents'];
        $created_at = $data['created_at'];
        $currency = $data['currency'];
        $error_occured = $data['error_occured'];
        $has_parent_transaction = $data['has_parent_transaction'];
        $id = $data['id'];
        $integration_id = $data['integration_id'];
        $is_3d_secure = $data['is_3d_secure'];
        $is_auth = $data['is_auth'];
        $is_capture = $data['is_capture'];
        $is_refunded = $data['is_refunded'];
        $is_standalone_payment = $data['is_standalone_payment'];
        $is_voided = $data['is_voided'];
        $order_id = $data['order'];
        $owner = $data['owner'];
        $pending = $data['pending'];
        $source_data_pan = $data['source_data_pan'];
        $source_data_sub_type = $data['source_data_sub_type'];
        $source_data_type = $data['source_data_type'];
        $success = $data['success'];
        
        $hmac = $data['hmac'];
        
        
        $string_request = $amount_cents.$created_at.$currency.$error_occured.$has_parent_transaction.$id.$integration_id.$is_3d_secure.$is_auth.$is_capture.$is_refunded.$is_standalone_payment.$is_voided.$order_id.$owner.$pending.$source_data_pan.$source_data_sub_type.$source_data_type.$success;
        $hashed = hash_hmac('SHA512', $string_request, 'FC05C3B48EBDEAE1C14837A4EB51DDA9');
        
        // return $string_request.
        // "<br>" . $hmac.
        // "<br>" . $hashed;
        
        if ($hmac == $hashed) {
            
            $order = Order::with('cart_info')->where('payment_id', $order_id)->first();
            
            $trans = new Transaction;
            
            $trans->order_id = $order->id;
            $trans->trnx_id = $id;
            $trans->pay_order_id = $order_id;
            if($success == "false") {
                $trans->is_success = 0;
            } else {
                $trans->is_success = 1;
            }
            if($pending == "false") {
                $trans->is_pending = 0;
            } else {
                $trans->is_pending = 1;
            }
            $trans->hmac = $hmac;
            $trans->currency = $currency;
            $trans->amount_cents = $amount_cents;
            $trans->string_req = $string_request;
            $trans->save();
            
            if($success == "true") {
                foreach($order->cart_info as $item) {
                    $pack = Catpackage::find($item->pack_id);
                    Boughtpackage::create([
                        'title' => $pack->title,
                        'cat_id' => $pack->cat_id,
                        'user_id' => backpack_auth()->user()->id,
                        'ads_count' => $pack->ads_count,
                        'price' => $pack->price,
                        'duration' => $pack->duration,
                        'full_ads' => 0,
                    ]);
                }
                return redirect(route('site.home'))->with(['success' => 'تم إتمام عملية الشراء بنجاح']);
            } else {
                return redirect(route('site.home'))->with(['error' => 'حدث خطأ ما .. برجاء المحاولة مرة آخري']);
            }
        } else {
            return redirect(route('site.home'))->with(['error' => 'حدث خطأ ما .. برجاء المحاولة مرة آخري']);
        }
    }
    
    public function PaymentPostStatus(Request $request) {
        $therequest = $request;
        
        
          $json = json_decode($therequest);
        Transaction::create([
            'hmac' => $json->obj,
            'currency' => 'egp',
            'amount_cents' => '100',
            'trnx_id' => '1',
            'pay_order_id' => '1',
        ]);
        
        
        $amount_cents = $json->obj->amount_cents;
        // Transaction::create([
        //     'hmac' => $amount_cents,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $created_at = $json->obj->order->created_at;
        // Transaction::create([
        //     'hmac' => $created_at,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $currency = $json->obj->currency;
        // Transaction::create([
        //     'hmac' => $currency,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $error_occured = $json->obj->error_occured;
        // Transaction::create([
        //     'hmac' => $error_occured,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $has_parent_transaction = $json->obj->has_parent_transaction;
        // Transaction::create([
        //     'hmac' => $has_parent_transaction,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $id = $json->obj->id;
        // Transaction::create([
        //     'hmac' => $id,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $integration_id = $json->obj->integration_id;
        // Transaction::create([
        //     'hmac' => $integration_id,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_3d_secure = $json->obj->is_3d_secure;
        // Transaction::create([
        //     'hmac' => $is_3d_secure,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_auth = $json->obj->is_auth;
        // Transaction::create([
        //     'hmac' => $is_auth,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_capture = $json->obj->is_capture;
        // Transaction::create([
        //     'hmac' => $is_capture,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_refunded = $json->obj->is_refunded;
        // Transaction::create([
        //     'hmac' => $is_refunded,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_standalone_payment = $json->obj->is_standalone_payment;
        // Transaction::create([
        //     'hmac' => $is_standalone_payment,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $is_voided = $json->obj->is_voided;
        // Transaction::create([
        //     'hmac' => $is_voided,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $order_id = $json->obj->order->id;
        // Transaction::create([
        //     'hmac' => $order_id,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $owner = $json->obj->owner;
        // Transaction::create([
        //     'hmac' => $owner,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $pending = $json->obj->pending;
        // Transaction::create([
        //     'hmac' => $pending,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $source_data_pan = $json->obj->source_data->pan;
        // Transaction::create([
        //     'hmac' => $source_data_pan,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $source_data_sub_type = $json->obj->source_data->sub_type;
        // Transaction::create([
        //     'hmac' => $source_data_sub_type,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $source_data_type = $json->obj->source_data->type;
        // Transaction::create([
        //     'hmac' => $source_data_type,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $success = $json->obj->success;
        // Transaction::create([
        //     'hmac' => $success,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        $hmac = $json->obj->data->secure_hash;
        // Transaction::create([
        //     'hmac' => $hmac,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'trnx_id' => '1',
        //     'pay_order_id' => '1',
        // ]);
        
        
        $string_request = $amount_cents.$created_at.$currency.$error_occured.$has_parent_transaction.$id.$integration_id.$is_3d_secure.$is_auth.$is_capture.$is_refunded.$is_standalone_payment.$is_voided.$order_id.$owner.$pending.$source_data_pan.$source_data_sub_type.$source_data_type.$success;
        $hashed = hash_hmac('SHA512', $string_request, 'FC05C3B48EBDEAE1C14837A4EB51DDA9');
        // Transaction::create([
        //     'string_req' => $string_request,
        //     'hmac' => $hmac,
        //     'trnx_id' => $hashed,
        //     'currency' => 'egp',
        //     'amount_cents' => '100',
        //     'pay_order_id' => '1',
        // ]);
        // return $string_request.
        // "<br>" . $hmac.
        // "<br>" . $hashed;
        
        if($hmac == $hashed) {
            
            $order = Order::with('cart_info')->where('payment_id', $order_id)->first();
            
            $trans = new Transaction;
            
            $trans->order_id = $order->id;
            $trans->trnx_id = $id;
            $trans->pay_order_id = $order_id;
            if($success == "false") {
                $trans->is_success = 0;
            } else {
                $trans->is_success = 1;
            }
            if($pending == "false") {
                $trans->is_pending = 0;
            } else {
                $trans->is_pending = 1;
            }
            $trans->hmac = $hmac;
            $trans->currency = $currency;
            $trans->amount_cents = $amount_cents;
            $trans->string_req = $string_request;
            $trans->save();
            
            
            
            if($success == "false") {
                foreach($order->cart_info as $item) {
                    $pack = Catpackage::find($item->pack_id);
                    Boughtpackage::create([
                        'title' => $pack->title,
                        'cat_id' => $pack->cat_id,
                        'user_id' => backpack_auth()->user()->id,
                        'ads_count' => $pack->ads_count,
                        'price' => $pack->price,
                        'duration' => $pack->duration,
                        'full_ads' => 0,
                    ]);
                }
            }
        }
    }
    
    public function wallet_verify($payment, $order_id) {
        // $wallet_integration_id
        $id = decrypt($order_id);
        $order = Order::with('cart_info')->find($id);
        
//        $cart_items = Cart::with('order')->where('order_id', 17)->get();
//        $this->setPassedVariablesToGlobal($amount,$user_id,$user_first_name,$user_last_name,$user_email,$user_phone,$source);

        $amount = $order->total_amount;
        $user_id = $order->user_id;
        $user_first_name = $order->first_name;
        $user_last_name = $order->last_name;
        if($order->email != null) {
            $user_email = $order->email;
        } else {
            $user_email = "NA";
        }
        $user_phone = $order->phone;
//        $source = $order->total_amount;

//        $required_fields = ['amount', 'user_first_name', 'user_last_name', 'user_email', 'user_phone'];
//        $this->checkRequiredFields($required_fields, 'PayMob', func_get_args());

         return $request_new_token = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/auth/tokens', [
                "api_key" => $this->paymob_api_key
            ])->json();

//        return $request_new_token['token'];

        $get_order = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
                "auth_token" => $request_new_token['token'],
                "delivery_needed" => "false",
                "amount_cents" => $amount * 100,
                "items" => []
            ])->json();

//        return $get_order['id'];

         $get_url_token = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
                "auth_token" => $request_new_token['token'],
                "expiration" => 36000,
                "amount_cents" => $get_order['amount_cents'],
                "order_id" => $get_order['id'],
                "billing_data" => [
                    "apartment" => "NA",
                    "email" => $user_email,
                    "floor" => "NA",
                    "first_name" => $user_first_name,
                    "street" => "NA",
                    "building" => "NA",
                    "phone_number" => $user_phone,
                    "shipping_method" => "NA",
                    "postal_code" => "NA",
                    "city" => "NA",
                    "country" => "NA",
                    "last_name" => $user_last_name,
                    "state" => "NA"
                ],
                "currency" => $this->currency,
                "integration_id" => $this->wallet_integration_id
            ])->json();


            $payment_id = $get_order['id'];
            $redirect_url = "https://accept.paymobsolutions.com/api/acceptance/iframes/" . $this->paymob_iframe_id . "?payment_token=" . $get_url_token['token'];
            $order->payment_id = $payment_id;
            $order->save();

        return redirect($redirect_url);

        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
