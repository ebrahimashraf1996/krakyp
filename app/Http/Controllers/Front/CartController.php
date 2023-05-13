<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Catpackage;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }

    public function index()
    {
        SEOMeta::setTitle(' سلة المشتريات - ' . $this->settings->title);
        OpenGraph::setTitle('سلة المشتريات - ' . $this->settings->title);
        JsonLd::setTitle('سلة المشتريات - ' . $this->settings->title);
        \General::seoCommon();
        if (!backpack_auth()->check()) {
            return redirect()->to(route('site.home'))->with(['error-auth' => 'برجاء تسجيل الدخول أولا']);
        }
        $cart_items = General::getAllProductFromCart();
        return view('front.pages.cart', compact('cart_items'));
    }

    public function addToCart(Request $request)
    {
        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => 'برجاء تسجيل الدخول أولا', 'data' => null]);
        }
        if (empty($request->id)) {
            return response()->json(['status' => 2, 'msg' => 'حدث خطأ ما برجاء المحاولة مرة اخري', 'data' => null]);
        }
        $pack = Catpackage::where('id', $request->id)->first();
        if (empty($pack)) {
            return response()->json(['status' => 2, 'msg' => 'حدث خطأ ما برجاء المحاولة مرة اخري', 'data' => null]);
        }
        $already_cart = Cart::where('user_id', backpack_user()->id)->where('order_id', null)->where('pack_id', $pack->id)->first();
        if ($already_cart) {
            return response()->json(['status' => 2, 'msg' => 'لقد تم إضافة هذه الباقة للعربة بالفعل', 'data' => null]);
        } else {
            $cart = new Cart;
            $cart->user_id = backpack_user()->id;
            $cart->pack_id = $pack->id;
            $cart->quantity = 1;
            $cart->price = $pack->price;
            $cart->amount = $pack->price;
            $cart->status = 'new';
            $cart->save();
            $cart_new_count = General::cartCount();

            return response()->json(['status' => 1, 'msg' => 'تم إضافة الباقة للعربة بنجاح', 'data' => ['new_count' => $cart_new_count]]);
        }
    }

    public function cartDelete($id)
    {
        $item_id = $id;
        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => 'برجاء تسجيل الدخول أولا', 'data' => null]);
        }
        $cart = Cart::where('user_id', backpack_auth()->user()->id)->find($id);
        $cart->delete();

        $cart_new_count = General::cartCount();
        $total_cart = General::getTotalCartPrice();

        return response()->json(['status' => 1, 'msg' => 'تم حذف العنصر بنجاح',
            'data' => ['id' => $item_id, 'count' => $cart_new_count, 'new_cost' => $total_cart]]);
    }
}
