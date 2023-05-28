<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Clientad;
use App\Models\Setting;
use App\Models\User;
use App\Models\Viewsnum;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientAdsController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }



    public function show($slug)
    {
        $check = Clientad::select('id', 'slug', 'status', 'is_published', 'is_canceled', 'reason_id')->slug($slug)->first();
        if ($check->is_published == 1 && $check->is_canceled == 0) {

            if ($check->status == 'free') {
                $client_ad = Clientad::with(['cat' => function ($q) {
                    $q->with(['mainCategory' => function ($q) {
                        $q->select('id', 'title', 'slug', 'status');
                    }])->select('title', 'slug', 'id', 'status', 'parent_id')->active();
                }])->selection()->published()->owner()->wiCountry()->wiCity()->wiState()->slug($slug)->first();
            } else {
                $client_ad = Clientad::with(['cat' => function ($q) {
                    $q->with(['mainCategory' => function ($q) {
                        $q->select('id', 'title', 'slug', 'status');
                    }])->select('title', 'slug', 'id', 'status', 'parent_id')->active();
                }])->selection()->published()->owner()->wiAttrAnswers()->wiCountry()->wiCity()->wiState()->slug($slug)->first();
                if ($client_ad->end_date < date("Y-m-d")) {
                    return redirect(route('site.home'))->with(['error' => 'هذا الإعلان منتهي الصلاحية ']);
                }
            }


            \General::singleClientAd($slug);
//return $client_ad;
            $related_paid_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()
                ->published()->where('cat_id', $client_ad->cat_id)->where('id', '!=', $client_ad->id)->get();
            $related_free_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->
            published()->where('cat_id', $client_ad->cat_id)->where('id', '!=', $client_ad->id)->get();
            Viewsnum::create([
                'client_ad_id' => $client_ad->id
            ]);
            return view('front.pages.client_ad_details', compact('client_ad', 'related_free_client_ads', 'related_paid_client_ads'));

        } elseif ($check->is_published == 0 && $check->is_canceled == 0) {
            return redirect()->back()->with(['error' => 'الإعلان مازال تحت المراجعة .. سيتم إبلاغكم  بمجرد قبول الإعلان']);

        } else {
            $client_ad = Clientad::with('reason')->select('id', 'slug', 'status', 'is_published', 'is_canceled', 'reason_id')->slug($slug)->first();
            return redirect()->back()->with(['error' => 'لقد تم رفض الإعلان بسبب ' . $client_ad->reason->reason_val]);
        }

    }

    public function sellerAds($serial) {


//        return $serial;
        $user = User::where('serial_num', $serial)->first();
        SEOMeta::setTitle($user->name . ' - ' . $this->settings->title);
        OpenGraph::setTitle($user->name . ' - ' . $this->settings->title);
        JsonLd::setTitle($user->name . ' - ' . $this->settings->title);
        \General::seoCommon();
        $paid_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->published()->notCanceled()->notEnd()->seller($user->id)->get();
        $free_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->notCanceled()->seller($user->id)->get();
        $count = $free_client_ads_published->count() + $paid_client_ads_published->count();

        return view('front.pages.seller_ads', compact('paid_client_ads_published', 'free_client_ads_published', 'count', 'user'));
    }
}
