<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AttributeChild;
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


//        $cat->tags;
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
        $main_cat_id = $request->has('new_main_cat_id') && $request->new_main_cat_id != null ? $request->new_main_cat_id : $cat->mainCategory->id;
        $sub_cat_id = $request->has('new_sub_cat_id') && $request->new_sub_cat_id != null ? $request->new_sub_cat_id : $cat->id;
        $country_id = $request->has('new_country_id') && $request->new_country_id != null ? $request->new_country_id : $request->request->remove('new_country_id');
        $city_id = $request->has('new_city_id') && $request->new_city_id != null ? $request->new_city_id : $request->request->remove('new_city_id');
        $new_from_ = $request->has('new_from_') && $request->new_from_ != null ? $request->new_from_ : $request->request->remove('new_from_');
        $new_to_ = $request->has('new_to_') && $request->new_to_ != null ? $request->new_to_ : $request->request->remove('new_to_');
        $attrs = $request->has('attrs') ? $request->attrs : null;
        $attrs_yes_no = $request->has('attrs_yes_no') ? $request->attrs_yes_no : null;
        $from_to_attrs = $request->has('from_to') ? $request->from_to : null;


        $free_client_ads_in_cat = Clientad::query();
        $free_client_ads_in_cat->where('cat_id', $sub_cat_id);

        $paid_client_ads_in_cat = Clientad::query();
        $paid_client_ads_in_cat->where('cat_id', $sub_cat_id);


        // Price Filter
        if ($new_from_ != '' && $new_to_ != '') {
            $free_client_ads_in_cat->whereBetween('price', [$new_from_, $new_to_]);
            $paid_client_ads_in_cat->whereBetween('price', [$new_from_, $new_to_]);
        }


        // Country Filter
        if (isset($country_id) && $country_id != '') {
            $free_client_ads_in_cat->where('country_id', $country_id);
            $paid_client_ads_in_cat->where('country_id', $country_id);
        }

        // City Filter
        if (isset($city_id) && $city_id != '') {
            if ($city_id != 'all') {
                $free_client_ads_in_cat->where('city_id', $city_id);
                $paid_client_ads_in_cat->where('city_id', $city_id);
            }
        }

        // Attrs Filter
        if ($attrs != null && count($attrs) > 0) {
            foreach ($attrs as $k => $val) {

                $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $val) {
                    $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->where('attr_id', $k)->whereIn('answer_value', $val);
                });

                $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $val) {
                    $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->where('attr_id', $k)->whereIn('answer_value', $val);
                });
            }
        }


        // Yes No Filter
        if ($attrs_yes_no != null && count($attrs_yes_no) > 0) {
            $attrs_yes_no = array_filter($attrs_yes_no);
            $attrs_yes_no = array_keys($attrs_yes_no);

            $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($attrs_yes_no) {
                $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->whereIn('attr_id', $attrs_yes_no);
            });

            $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($attrs_yes_no) {
                $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->whereIn('attr_id', $attrs_yes_no);
            });
        }

        // From To Filter
        if ($from_to_attrs != null && count($from_to_attrs) > 0) {
            foreach ($from_to_attrs as $k => $val) {
                if ($val['from'] != null && $val['to'] != null) {
                    $from_val = intval($val['from']);
                    $to_val = intval($val['to']);

                    $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $val, $from_val, $to_val) {
                        $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->where('attr_id', $k)->whereBetween('answer_value', [$from_val, $to_val]);
                    });

                    $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($k, $val, $from_val, $to_val) {
                        $q->select('id', 'client_ad_id', 'attr_id', 'answer_value')->where('attr_id', $k)->whereBetween('answer_value', [$from_val, $to_val]);
                    });
                }
            }
        }

        // Sorting
        if (!empty($_GET['new_sort_by'])) {
            $ordering = $_GET['new_sort_by'];
            switch ($ordering) {
                case "cr_asc":
                    $free_client_ads_in_cat->orderBy('created_at', 'asc');
                    $paid_client_ads_in_cat->orderBy('created_at', 'asc');
                    break;
                case "pr_asc":
                    $free_client_ads_in_cat->orderBy('price', 'asc');
                    $paid_client_ads_in_cat->orderBy('price', 'asc');
                    break;
                case "pr_desc":
                    $free_client_ads_in_cat->orderBy('price', 'desc');
                    $paid_client_ads_in_cat->orderBy('price', 'desc');
                    break;
                default:
                    $free_client_ads_in_cat->orderBy('created_at', 'desc');
                    $paid_client_ads_in_cat->orderBy('created_at', 'desc');
            }
        }


        $free_client_ads_in_cat = $free_client_ads_in_cat->free()->selection()->published()->notCanceled()->get();
        $paid_client_ads_in_cat = $paid_client_ads_in_cat->paid()->notEnd()->published()->notCanceled()->selection()->get();

//        $cat = Category::where('id', $request->new_sub_cat_id)->select('id', 'slug', 'title', 'parent_id')->first();

        $main_attributes = AttributeChild::with([
            'attribute' => function ($q) {
                $q->with(['options' => function ($q) {
                    $q->orderBy('lft', 'asc');
                }])
                    ->select('id', 'title', 'appearance', 'unit');
            },
        ])
            ->where('cat_id', $cat->id)
            ->where('main_other', 'main')
            ->where('parent_id', null)
            ->orderBy('lft', 'asc')
            ->get();

        $min = (!empty($_GET['from_']) ? $_GET['from_'] : '');
        $max = (!empty($_GET['to_']) ? $_GET['to_'] : '');


        $countries = \App\Models\Location::with(['cities' => function ($q) {
            $q->with('cities');
        }])->where('parent_id', null)->get();


        return view('front.pages.cat_show', compact('free_client_ads_in_cat',
            'paid_client_ads_in_cat', 'main_attributes', 'cat', 'min', 'max', 'countries'));
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

        $main_cat_id = $request->has('new_main_cat_id') && $request->new_main_cat_id != null ? $request->new_main_cat_id : $maincat->id;
        $country_id = $request->has('new_country_id') && $request->new_country_id != null ? $request->new_country_id : $request->request->remove('new_country_id');
        $city_id = $request->has('new_city_id') && $request->new_city_id != null ? $request->new_city_id : $request->request->remove('new_city_id');
        $new_from_ = $request->has('new_from_') && $request->new_from_ != null ? $request->new_from_ : $request->request->remove('new_from_');
        $new_to_ = $request->has('new_to_') && $request->new_to_ != null ? $request->new_to_ : $request->request->remove('new_to_');

        $free_client_ads_in_cat = Clientad::query();
        $free_client_ads_in_cat->where('maincat_id', $main_cat_id);

        $paid_client_ads_in_cat = Clientad::query();
        $paid_client_ads_in_cat->where('maincat_id', $main_cat_id);


        // Price Filter
        if ($new_from_ != '' && $new_to_ != '') {
            $free_client_ads_in_cat->whereBetween('price', [$new_from_, $new_to_]);
            $paid_client_ads_in_cat->whereBetween('price', [$new_from_, $new_to_]);
        }


        // Country Filter
        if (isset($country_id) && $country_id != '') {
            $free_client_ads_in_cat->where('country_id', $country_id);
            $paid_client_ads_in_cat->where('country_id', $country_id);
        }

        // City Filter
        if (isset($city_id) && $city_id != '') {
            if ($city_id != 'all') {
                $free_client_ads_in_cat->where('city_id', $city_id);
                $paid_client_ads_in_cat->where('city_id', $city_id);
            }
        }


        // Sorting
        if (!empty($_GET['new_sort_by'])) {
            $ordering = $_GET['new_sort_by'];
            switch ($ordering) {
                case "cr_asc":
                    $free_client_ads_in_cat->orderBy('created_at', 'asc');
                    $paid_client_ads_in_cat->orderBy('created_at', 'asc');
                    break;
                case "pr_asc":
                    $free_client_ads_in_cat->orderBy('price', 'asc');
                    $paid_client_ads_in_cat->orderBy('price', 'asc');
                    break;
                case "pr_desc":
                    $free_client_ads_in_cat->orderBy('price', 'desc');
                    $paid_client_ads_in_cat->orderBy('price', 'desc');
                    break;
                default:
                    $free_client_ads_in_cat->orderBy('created_at', 'desc');
                    $paid_client_ads_in_cat->orderBy('created_at', 'desc');
            }
        }


        $free_client_ads_in_cat = $free_client_ads_in_cat->free()->selection()->published()->notCanceled()->get();
        $paid_client_ads_in_cat = $paid_client_ads_in_cat->paid()->notEnd()->published()->notCanceled()->selection()->get();

        $countries = \App\Models\Location::with(['cities' => function ($q) {
            $q->with('cities');
        }])->where('parent_id', null)->get();



            return view('front.pages.maincat_show', compact('free_client_ads_in_cat',
                'paid_client_ads_in_cat', 'maincat'));
    }

    public function fromMainToSub(Request $request)
    {
        if ($request->new_sub_cat_id == 'all') {
            $main_cat = Category::find($request->new_main_cat_id);
            return redirect(route('mainCat.show', $main_cat->slug) . '?new_sort_by=cr_desc&new_country_id=' . $request->new_country_id . '&new_city_id=' . $request->new_city_id . '&new_from_=' . $request->new_from_ . '&new_to_=' . $request->new_to_);
        } else {
            $cat = Category::find($request->new_sub_cat_id);
            if ($cat) {
                return redirect(url('cat/' . $cat->slug . '?new_main_cat_id=' . $request->new_main_cat_id . '&new_sub_cat_id=' . $request->new_sub_cat_id . '&new_sort_by=cr_desc&new_country_id=' . $request->new_country_id . '&new_city_id=' . $request->new_city_id . '&new_from_=' . $request->new_from_ . '&new_to_=' . $request->new_to_));
            } else {
                return redirect(route('site.home'))->with(['error' => 'حدث خطأ ما .. برجاء المحاولة فيما بعد']);
            }
        }
    }


}
