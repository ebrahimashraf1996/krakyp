<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Clientad;
use App\Models\Setting;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;
use function Ramsey\Uuid\Lazy\toString;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }

    public function show($slug, Request $request)
    {
        $cat = Category::where('slug', $slug)->first();
        SEOMeta::setTitle($cat->title . ' - ' . $this->settings['title']);
        SEOMeta::setDescription($cat->description);
        SEOMeta::addMeta('offer:published_time', $cat->created_at->toW3CString(), 'property');


        SEOMeta::addMeta('offer:section-title', $cat->title, 'property');
        SEOMeta::addMeta('offer:section-description', $cat->description, 'property');


        $cat->tags;
        foreach ($cat->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }

        OpenGraph::setTitle($cat->title . ' - ' . $this->settings['title']);
        OpenGraph::setDescription($cat->description);
        OpenGraph::addProperty('type', $cat->title);
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        OpenGraph::setUrl(route('cat.show', $cat->slug));
        OpenGraph::addImage(asset($cat->image));

        JsonLd::setTitle($cat->title . ' - ' . $this->settings['title']);
        JsonLd::setDescription($cat->description);
        JsonLd::setType($cat->title);
        JsonLd::addImage(asset($cat->image));

        General::seoContacts();


//return $request;
        if ($request->has('cat_id') && $request->cat_id != null) {

            $attrs = Category::with(['attributes' => function ($q) {
                $q->with('options');
            }])->where('id', $request->cat_id)->select('id', 'slug')->first()->attributes;

//            return $attrs;


            $free_client_ads_in_cat = Clientad::query();
            $free_client_ads_in_cat->where('cat_id', $request->cat_id);
            $free_client_ads_in_cat->with('clientAdAttrsAnswers');

            $paid_client_ads_in_cat = Clientad::query();
            $paid_client_ads_in_cat->where('cat_id', $request->cat_id);
            $paid_client_ads_in_cat->with('clientAdAttrsAnswers');

            if (!empty($_GET['from_']) && !empty($_GET['to_'])) {
                $from_ = $_GET['from_'];
                $to_ = $_GET['to_'];
                $price[0] = intval($from_);
                $price[1] = intval($to_);

                $free_client_ads_in_cat->whereBetween('price', $price);
                $paid_client_ads_in_cat->whereBetween('price', $price);
            }


            if (empty($_GET['all']) || !empty($_GET['all']) && $_GET['all'] != 1) {
                if (!empty($_GET['attrs'])) {
                    $attrs = $_GET['attrs'];
                    $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) {
                        $q->where('attr_id', null);
                    });
                    $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) {
                        $q->where('attr_id', null);
                    });
//                 return $attrs;
                    foreach ($attrs as $k => $attr_item) {
//                     return $attr_item;
                        if ($attr_item != 0) {
                            $arr = explode('-', $k);
                            $attr_id = $arr[0];
                            $answer_val = $arr[1];
                            $free_client_ads_in_cat->orWhereHas('clientAdAttrsAnswers', function ($q) use ($attr_id, $answer_val) {
                                $q->where('attr_id', $attr_id)->where('answer_value', $answer_val);
                            });
                            $paid_client_ads_in_cat->orWhereHas('clientAdAttrsAnswers', function ($q) use ($attr_id, $answer_val) {
                                $q->where('attr_id', $attr_id)->where('answer_value', $answer_val);
                            });
                        }
                    }
                }

            }
            // if (!empty($_GET['status']) && $_GET['status'] == 'free') {
            //     $free_client_ads_in_cat->where('status', 'free');
            //     $free_client_ads_in_cat = $free_client_ads_in_cat->get();
            //     $paid_client_ads_in_cat = Category::select('id')->where('id', null)->get();

            // } elseif (!empty($_GET['status']) && $_GET['status'] == 'paid') {
            //     $paid_client_ads_in_cat->where('status', 'paid');
            //     $paid_client_ads_in_cat = $paid_client_ads_in_cat->get();
            //     $free_client_ads_in_cat = Category::select('id')->where('id', null)->get();
            // } else {
            //     $free_client_ads_in_cat = $free_client_ads_in_cat->where('status', 'free')->get();
            //     $paid_client_ads_in_cat = $paid_client_ads_in_cat->where('status', 'paid')->get();
            // }

//            return $paid_client_ads_in_cat;

            $cat = Category::with(['attributes' => function ($q) {
                $q->orderBy('lft', 'ASC')->with(['options' => function ($q) {
                    $q->orderBy('lft', 'ASC');
                }]);
            }])->where('slug', $slug)->select('id', 'slug', 'title', 'parent_id')->first();
            $attributes = $cat->attributes;
            $min = $_GET['from_'];
            $max = $_GET['to_'];
            return view('front.pages.cat_show', compact('free_client_ads_in_cat',
                'paid_client_ads_in_cat', 'attributes', 'cat', 'min', 'max'));

//            $free_client_ads_in_cat = $free_client_ads_in_cat->get();
//            return $free_client_ads_in_cat;

        } else {
            $cat = Category::with(['attributes' => function ($q) {
                $q->with('options');
            }])->where('slug', $slug)->select('id', 'slug', 'title', 'parent_id')->first();
            $attributes = $cat->attributes;
            $min = Clientad::where('cat_id', $cat->id)->select('price')->min('price');
            $max = Clientad::where('cat_id', $cat->id)->select('price')->max('price');

            $free_client_ads_in_cat = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->where('cat_id', $cat->id)->get();
            $paid_client_ads_in_cat = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->where('cat_id', $cat->id)->get();
        }
        return view('front.pages.cat_show', compact('free_client_ads_in_cat', 'paid_client_ads_in_cat', 'attributes', 'cat', 'min', 'max'));
    }

    public function mainShow($slug, Request $request)
    {
//        return $request;
        $maincat = Category::where('slug', $slug)->first();
        SEOMeta::setTitle($maincat->title . ' - ' . $this->settings['title']);
        SEOMeta::setDescription($maincat->description);
        SEOMeta::addMeta('offer:published_time', $maincat->created_at->toW3CString(), 'property');


        SEOMeta::addMeta('offer:section-title', $maincat->title, 'property');
        SEOMeta::addMeta('offer:section-description', $maincat->description, 'property');


        $maincat->tags;
        foreach ($maincat->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }

        OpenGraph::setTitle($maincat->title . ' - ' . $this->settings['title']);
        OpenGraph::setDescription($maincat->description);
        OpenGraph::addProperty('type', $maincat->title);
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        OpenGraph::setUrl(route('mainCat.show', $maincat->slug));
        OpenGraph::addImage(asset($maincat->image));

        JsonLd::setTitle($maincat->title . ' - ' . $this->settings['title']);
        JsonLd::setDescription($maincat->description);
        JsonLd::setType($maincat->title);
        JsonLd::addImage(asset($maincat->image));

        General::seoContacts();


//return $request;
        if ($request->has('maincat_id') && $request->maincat_id != null) {


//            $attrs = Category::with(['attributes' => function ($q) {
//                $q->with('options');
//            }])->where('id', $request->cat_id)->select('id', 'slug')->first()->attributes;

//            return $attrs;


            $free_client_ads_in_cat = Clientad::query();
            $free_client_ads_in_cat->where('maincat_id', $request->maincat_id);
//            $free_client_ads_in_cat->with('clientAdAttrsAnswers');

            $paid_client_ads_in_cat = Clientad::query();
            $paid_client_ads_in_cat->where('maincat_id', $request->maincat_id);
//            $paid_client_ads_in_cat->with('clientAdAttrsAnswers');


            if (!empty($_GET['cat_id']) && $_GET['cat_id'] != 'all') {
                $free_client_ads_in_cat->where('cat_id', $request->cat_id);
                $free_client_ads_in_cat->with('clientAdAttrsAnswers');

                $paid_client_ads_in_cat->where('cat_id', $request->cat_id);
                $paid_client_ads_in_cat->with('clientAdAttrsAnswers');

                $cat = Category::with(['attributes' => function ($q) {
                    $q->with('options');
                }])->where('id', $request->cat_id)->select('id', 'slug', 'title', 'parent_id')->first();

                $attributes = $cat->attributes;

            } else {
                $cat = 'all';
                $attributes = null;
            }


            if (!empty($_GET['from_']) && !empty($_GET['to_'])) {
                $from_ = $_GET['from_'];
                $to_ = $_GET['to_'];
                $price[0] = intval($from_);
                $price[1] = intval($to_);

                $free_client_ads_in_cat->whereBetween('price', $price);
                $paid_client_ads_in_cat->whereBetween('price', $price);
            }

//            return  $free_client_ads_in_cat = $free_client_ads_in_cat->wiCountry()->wiCity()->wiState()->owner()->published()->where('status', 'free')->get();
//            return  $paid_client_ads_in_cat = $paid_client_ads_in_cat->wiCountry()->wiCity()->wiState()->notEnd()->published()->get();


            if (empty($_GET['all_attrs_inp']) || !empty($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] != 1) {
                if (!empty($_GET['attrs'])) {
                    //                return "test";
                    foreach ($request->attrs as $k => $v) {
                        if ($v != 'all') {
                            $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $v) {
                                $q->where('attr_id', $k)->where('answer_value', $v);
                            });
                            $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $v) {
                                $q->where('attr_id', $k)->where('answer_value', $v);
                            });
                        }
                    }
//                    $attrs = $_GET['attrs'];
//                 return $attrs;
                }
            }

            if (!empty($_GET['status']) && $_GET['status'] == 'free') {
                $free_client_ads_in_cat->where('status', 'free');
                $free_client_ads_in_cat = $free_client_ads_in_cat->wiCountry()->wiCity()->wiState()->published()->get();
                $paid_client_ads_in_cat = Category::select('id')->where('id', null)->get();

            } elseif (!empty($_GET['status']) && $_GET['status'] == 'paid') {
                $paid_client_ads_in_cat->where('status', 'paid');
                $paid_client_ads_in_cat = $paid_client_ads_in_cat->wiCountry()->wiCity()->wiState()->notEnd()->published()->get();
                $free_client_ads_in_cat = Category::select('id')->where('id', null)->get();
            } else {
                $free_client_ads_in_cat = $free_client_ads_in_cat->wiCountry()->wiCity()->wiState()->owner()->published()->where('status', 'free')->get();
                $paid_client_ads_in_cat = $paid_client_ads_in_cat->wiCountry()->wiCity()->wiState()->owner()->notEnd()->published()->where('status', 'paid')->get();
            }

//            return $paid_client_ads_in_cat;


            $min = $_GET['from_'];
            $max = $_GET['to_'];
            return view('front.pages.maincat_show', compact('free_client_ads_in_cat',
                'paid_client_ads_in_cat', 'attributes', 'maincat', 'cat', 'min', 'max'));

//            $free_client_ads_in_cat = $free_client_ads_in_cat->get();
//            return $free_client_ads_in_cat;

        } else {

            $maincat = Category::where('slug', $slug)->select('id', 'slug', 'title', 'parent_id')->first();
//            $attributes = $cat->attributes;
            $min = Clientad::where('maincat_id', $maincat->id)->select('price')->min('price');
            $max = Clientad::where('maincat_id', $maincat->id)->select('price')->max('price');

            $free_client_ads_in_cat = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->where('maincat_id', $maincat->id)->get();
            $paid_client_ads_in_cat = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->where('maincat_id', $maincat->id)->get();

            return view('front.pages.maincat_show', compact('free_client_ads_in_cat', 'paid_client_ads_in_cat', 'maincat', 'min', 'max'));

        }
    }
}
