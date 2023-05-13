<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }

    public function checkout ($payment) {
        SEOMeta::setTitle('إتمام الطلب' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('إتمام الطلب' . ' - ' . $this->settings->title);
        JsonLd::setTitle('إتمام الطلب' . ' - ' . $this->settings->title);

        \General::seoCommon();

        $payment = decrypt($payment);
        $cart_items = General::getAllProductFromCart();
        return view('front.pages.checkout', compact('cart_items', 'payment'));
    }
    public function completeOrder(OrderStoreRequest $request) {
// return $request;
        $add_order =  $this->addOrder($request);
//        return $add_order['status'];
        if ($add_order['status']) {
            if($request->payment == 'paypal') {
                return redirect()->route('paypal.payment', ['payment' => $request->payment, 'order_id' => encrypt($add_order['order_id'])])->with(['success' => __('messages.order-submitted')]);
            } else if ($request->payment == 'visa'){
                return redirect()->route('payment-verify', ['payment' => $request->payment, 'order_id' => encrypt($add_order['order_id'])])->with(['success' => __('messages.order-submitted')]);
            } else {
                return redirect()->route('wallet-verify', ['payment' => $request->payment, 'order_id' => encrypt($add_order['order_id'])])->with(['success' => __('messages.order-submitted')]);
            }
        } else {
            request()->session()->flash('error', 'حدث خطأ ما .. برجاء المحاولة فيما بعد');
            return redirect()->back();
        }
    }

    public function addOrder($request) {
        if (empty(Cart::where('user_id', backpack_user()->id)->where('order_id', null)->first())) {
            request()->session()->flash('error', 'السلة فارغة !');
            return back();
        }
        DB::beginTransaction();

        $order = Order::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'address_one' => $request->address,
            'address_two' => $request->address_2,
            'postal_code' => $request->postal_code,
            'notes' => $request->notes,
            'order_number' => 'KRA-' . strtoupper(Str::random(10)),
            'user_id' => backpack_user()->id,
            'total_amount' => \General::totalCartPrice(),
            'quantity' => \General::cartCount(),
            'status' => 'new',
            'payment_method' => $request->payment,
            'payment_status' => 'unpaid',
        ]);

        if ($order) {
            Cart::where('user_id', backpack_user()->id)->where('order_id', null)->update(['order_id' => $order->id]);
            // $new_order = Order::with('cart_info', 'user')->find($order->id);
            DB::commit();
            return [
                'status' => 'saved',
                'order_id' => $order->id
            ];
        } else {
            return [
                'status' => 'error',
                'order_id' => null
            ];

        }

    }

}
