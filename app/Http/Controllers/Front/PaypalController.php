<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Catpackage;
use App\Models\Boughtpackage;

class PaypalController extends Controller
{
    public function payment($payment, $order_id) {
        // return $payment. $order_id;
        $usd_conv = Setting::select('usd')->first()->usd;

         $id = decrypt($order_id);
         $order = Order::with(['cart_info' => function($q) {
            $q->with('userPack');
        }])->find($id);
        
        // return $order->cart_info->sum('price')/$usd_conv;
        $data = [];
        $data['items'] = [
            [
                'name' => 'باقات اعلانية',
                'price' => number_format($order->cart_info->sum('price')/$usd_conv, 2),
                'description' => 'باقات اعلانية سوبر',
                'qty' => 1,
            ]
        ];
        
        // return $data['items'];

        $data['invoice_id'] = 1;

        $data['invoice_description'] = "Order Invoice";

        $data['return_url'] = route('paypal.success', $order_id);

        $data['cancel_url'] = route('paypal.cancel', $order_id);
        // return $usd_conv;
         $data['total'] = number_format($order->cart_info->sum('price')/$usd_conv, 2);
        //  $data['total'] + 1;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }

    public function cancel() {
        dd('You Have Canceled This Payment');
    }

    public function success(Request $request, $id) {
        $id = decrypt($id);
        $provider = new ExpressCheckout;
         $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            

            $order = Order::with('cart_info')->find($id);
            
            $trans = new Transaction;
            
            $trans->order_id = $order->id;
            $trans->trnx_id = $response['CORRELATIONID'];
            $trans->pay_order_id = $response['PAYERID'];
            if($response['ACK'] == "SUCCESS" || $response['ACK'] == "SUCCESSWITHWARNING") {
                $trans->is_success = 1;
            } else {
                $trans->is_success = 0;
            }
            $trans->is_pending = 0;
            
            $trans->hmac = $response['TOKEN'];
            $trans->currency = 'USD';
            $trans->amount_cents = $response['AMT'];
            $trans->string_req = $response['TOKEN'];
            $trans->save();
            
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
            
        
            
            
            
        }
        return redirect(route('site.home'))->with(['error' => 'حدث خطأ ما .. برجاء المحاولة مرة آخري']);

    }



}
