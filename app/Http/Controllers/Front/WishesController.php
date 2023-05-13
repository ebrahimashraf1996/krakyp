<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Wish;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;

class WishesController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }
    public function index () {
        SEOMeta::setTitle(' قائمة المفضلة - ' . $this->settings->title);
        OpenGraph::setTitle('قائمة المفضلة - ' . $this->settings->title);
        JsonLd::setTitle('قائمة المفضلة - ' . $this->settings->title);
        \General::seoCommon();
//    return $paid_wished_items = General::getAllPaidItemsFromWishList()[0]->clientAd->id;
        $paid_wished_items = General::getAllPaidItemsFromWishList();
        $free_wished_items = General::getAllFreeItemsFromWishList();

        $wishes_count = count($free_wished_items) + count($paid_wished_items);
        return view('front.pages.wish_list', compact('paid_wished_items', 'free_wished_items', 'wishes_count'));
    }
    public function delete(Request $request) {
        $wish = Wish::where('user_id', backpack_auth()->user()->id)->find($request->id);
        if ($wish) {
            $wish->delete();
            $count = Wish::where('user_id', backpack_auth()->user()->id)->count();
            return response()->json(['status' => 1 , 'msg' => 'تم حذف الإعلان من قائمة المحفوظات', 'count' => $count]);

        } else {
            return response()->json(['status' => 0 , 'msg' => 'حدث خطأ ما برجاء المحاولة مرة أخري']);
        }
    }
}
