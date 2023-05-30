<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageSendRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\Allvisit;
use App\Models\AttributeChild;
use App\Models\Boughtpackage;
use App\Models\Category;
use App\Models\Catpackage;
use App\Models\Clientad;
use App\Models\Message;
use App\Models\Order;
use App\Models\Post;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Vonage\Voice\get;

class OverAllController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
        $ip = \General::getUserIP();
        $ip = "158.201.233.166";

        $data = \Location::get($ip);
        if ($data !== false) {
            $check = Allvisit::where('ip_address', $ip)->first();
            if (!$check) {
                Allvisit::create([
                    'ip_address' => $data->ip,
                    'country' => $data->countryName,
                    'city' => $data->cityName,
                    'state' => $data->regionName,
                ]);
            } else {
                $check->counts = $check->counts + 1;
                $check->save();
            }
        }
    }

    public function index()
    {
        SEOMeta::setTitle(__('messages.home') . ' - ' . $this->settings->title);
        OpenGraph::setTitle(__('messages.home') . ' - ' . $this->settings->title);
        JsonLd::setTitle(__('messages.home') . ' - ' . $this->settings->title);

        \General::seoCommon();

        $posts = Post::with(['category' => function ($q) {
            $q->select('id', 'title');
        }])->active()->select('id', 'title', 'summary', 'image', 'slug', 'created_at', 'blogcategory_id')->featured()->get();
        $banners = \App\Models\Banner::select('image_alt', 'image', 'url', 'status')->orderBy('lft', 'asc')->active()->get();
        $banners_mobile = \App\Models\MobileBanner::select('image_alt', 'image', 'url', 'status')->orderBy('lft', 'asc')->active()->get();
        $cats = \App\Models\Category::where('parent_id', null)->get();
        $locations = \App\Models\Location::where('parent_id', null)->get();
        $paid_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->orderBy('created_at', 'desc')->limit(11)->get();
        $free_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->orderBy('created_at', 'desc')->limit(11)->get();
        $featured_cats = \App\Models\Category::where('is_featured', 'Featured')->select('id', 'title', 'slug', 'image', 'parent_id')->get();
        return view('front.pages.index', compact('cats', 'locations', 'paid_client_ads', 'free_client_ads', 'banners', 'banners_mobile', 'posts', 'featured_cats'));
    }

    public function getAllAds()
    {
        SEOMeta::setTitle('جميع الإعلانات - ' . $this->settings->title);
        OpenGraph::setTitle('جميع الإعلانات - ' . $this->settings->title);
        JsonLd::setTitle('جميع الإعلانات - ' . $this->settings->title);

        \General::seoCommon();
        $paid_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->orderBy('created_at', 'desc')->get();
        $free_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->orderBy('created_at', 'desc')->get();
        $featured_cats = \App\Models\Category::where('is_featured', 'Featured')->select('id', 'title', 'slug', 'image', 'parent_id')->get();
        return view('front.pages.all_ads', compact('paid_client_ads', 'free_client_ads', 'featured_cats'));
    }


//    public function getAllAds() {
//        SEOMeta::setTitle('نتائج البحث - ' . $this->settings->title);
//        OpenGraph::setTitle( 'نتائج البحث - ' . $this->settings->title);
//        JsonLd::setTitle( 'نتائج البحث - ' . $this->settings->title);
//
//        \General::seoCommon();
//        $paid_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->orderBy('created_at', 'desc')->get();
//        $free_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->orderBy('created_at', 'desc')->get();
//        $featured_cats = \App\Models\Category::where('is_featured', 'Featured')->select('id', 'title', 'slug', 'image', 'parent_id')->get();
//        return view('front.pages.all_ads', compact('paid_client_ads', 'free_client_ads', 'featured_cats'));
//    }

    public function quickSearch(Request $request)
    {
//        return $request;

        SEOMeta::setTitle('نتائج البحث - ' . $this->settings->title);
        OpenGraph::setTitle('نتائج البحث - ' . $this->settings->title);
        JsonLd::setTitle('نتائج البحث - ' . $this->settings->title);

        if ($request->has('key_word') && $request->key_word != null && $request->has('quick_cat') && $request->quick_cat != null) {
            $paid_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->notEnd()->selection()->published()->where('cat_id', $request->quick_cat)->where('title', 'like', '%' . $request->key_word . '%')->orderBy('created_at', 'desc')->get();
            $free_client_ads = \App\Models\Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->where('cat_id', $request->quick_cat)->where('title', 'like', '%' . $request->key_word . '%')->orderBy('created_at', 'desc')->get();
            return view('front.pages.quick_search_result', compact('paid_client_ads', 'free_client_ads'));

        } else {
            return redirect(route('site.home'))->with(['error' => 'برجاء ادخال بيانات البحث']);
        }

    }

    public function privacy()
    {
        SEOMeta::setTitle(' سياسة الخصوصية - ' . $this->settings->title);
        OpenGraph::setTitle('سياسة الخصوصية - ' . $this->settings->title);
        JsonLd::setTitle('سياسة الخصوصية - ' . $this->settings->title);
        \General::seoCommon();

        $settings = Setting::first();
        return view('front.pages.privacy', compact('settings'));
    }

    public function terms()
    {
        SEOMeta::setTitle(' بنود الخدمة - ' . $this->settings->title);
        OpenGraph::setTitle('بنود الخدمة - ' . $this->settings->title);
        JsonLd::setTitle('بنود الخدمة - ' . $this->settings->title);
        \General::seoCommon();

        $settings = Setting::first();
        return view('front.pages.terms', compact('settings'));

    }

    public function about()
    {
        SEOMeta::setTitle(' من نحن - ' . $this->settings->title);
        OpenGraph::setTitle('من نحن - ' . $this->settings->title);
        JsonLd::setTitle('من نحن - ' . $this->settings->title);
        \General::seoCommon();

        $about_us = Setting::select('id', 'description')->first();
        return view('front.pages.about-us', compact('about_us'));
    }

    public function contactUs(Request $request)
    {
        SEOMeta::setTitle(' تواصل معنا - ' . $this->settings->title);
        OpenGraph::setTitle('تواصل معنا - ' . $this->settings->title);
        JsonLd::setTitle('تواصل معنا - ' . $this->settings->title);
        \General::seoCommon();
//        return $request;
        if ($request->has('client_ad_serial') && $request->client_ad_serial != null) {
            $client_ad_serial = $request->client_ad_serial;
        } else {
            $client_ad_serial = null;
        }
        if ($request->has('seller_serial') && $request->seller_serial != null) {
            $client_serial = $request->seller_serial;
        } else {
            $client_serial = null;
        }
//
        return view('front.pages.contact-us', compact('client_ad_serial', 'client_serial'));
    }


    public function sendContact(MessageSendRequest $request)
    {
        $message = Message::create($request->all());
        if ($message)
            return redirect()->back()->with(['success' => __('messages.success-message')]);
        return redirect()->back()->with(['error' => __('messages.failed-message')]);
    }

    public function personalEdit()
    {
        SEOMeta::setTitle('تعديل البيانات الشخصية' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('تعديل البيانات الشخصية' . ' - ' . $this->settings->title);
        JsonLd::setTitle('تعديل البيانات الشخصية' . ' - ' . $this->settings->title);

        \General::seoCommon();
        if (backpack_auth()->check()) {
            $user = backpack_auth()->user();
            return view('front.pages.personal-edit', compact('user'));
        } else {
            return redirect('site.home')->with(['error' => __('messages.failed-message')]);
        }
    }

    public function personalUpdate(PersonalUpdateRequest $request)
    {
//        return $request;
        $user = backpack_auth()->user();
        $old_phone = $user->phone;
        if ($request->edit_photo_check == '1' && $request->image != null) {
            $fileName = "";
            $fileName = uploadImage('users', $request->image);
            $user->update([
                'image' => 'uploads/users/' . $fileName,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whats_app' => $request->whats_app,
                'description' => $request->description,
            ]);

        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whats_app' => $request->whats_app,
                'description' => $request->description,
            ]);
        }
        if ($old_phone != $request->phone) {
            $user->update([
                'is_verified' => '0',
                'phone_verified' => null,
                'otp' => rand(1111, 9999)
            ]);
            return redirect()->route('verifying.view')->with(['success' => 'تم تحديث بياناتك بنجاح .. يرجى تأكيد رقم الهاتف']);

        } else {
            return redirect()->back()->with(['success' => 'تم تحديث بياناتك بنجاح']);
        }
    }

    public function userPosts()
    {
        SEOMeta::setTitle('جميع الإعلانات' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('جميع الإعلانات' . ' - ' . $this->settings->title);
        JsonLd::setTitle('جميع الإعلانات' . ' - ' . $this->settings->title);

        \General::seoCommon();

        if (backpack_auth()->check()) {
            $free_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->notCanceled()->mine()->get();
            $paid_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->published()->notCanceled()->notEnd()->mine()->get();
            $free_client_ads_under_reviewed = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->notPublished()->notCanceled()->mine()->get();
            $paid_client_ads_under_reviewed = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->notPublished()->notCanceled()->mine()->get();
            $paid_client_ads_expired = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->ended()->selection()->published()->notCanceled()->mine()->get();
            $free_client_ads_canceled = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->notPublished()->Canceled()->mine()->get();
            $paid_client_ads_canceled = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->notPublished()->Canceled()->mine()->get();

            $count = $free_client_ads_published->count() + $paid_client_ads_published->count() + $free_client_ads_under_reviewed->count() + $paid_client_ads_under_reviewed->count() +
                $paid_client_ads_expired->count() + $free_client_ads_canceled->count() + $paid_client_ads_canceled->count();
//            return $count;
            return view('front.pages.my_ads.all', compact('free_client_ads_published',
                'paid_client_ads_published',
                'free_client_ads_under_reviewed', 'paid_client_ads_under_reviewed', 'paid_client_ads_expired', 'free_client_ads_canceled',
                'paid_client_ads_canceled', 'count'));
        } else {
            return redirect(url('login'))->with(['error' => 'يرجي تسجيل الدخول أولا .. ']);
        }
    }

    public function userPostsPublished()
    {
        SEOMeta::setTitle('الإعلانات المقبولة' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('الإعلانات المقبولة' . ' - ' . $this->settings->title);
        JsonLd::setTitle('الإعلانات المقبولة' . ' - ' . $this->settings->title);

        \General::seoCommon();
        if (backpack_auth()->check()) {
            $free_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->published()->notCanceled()->mine()->get();
            $paid_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->published()->notCanceled()->notEnd()->mine()->get();

            $count = $free_client_ads_published->count() + $paid_client_ads_published->count();
//            return $count;
            return view('front.pages.my_ads.all', compact('free_client_ads_published',
                'paid_client_ads_published', 'count'));
        } else {
            return redirect(url('login'))->with(['error' => 'يرجي تسجيل الدخول أولا .. ']);
        }
    }

    public function userPostsUnder()
    {
        SEOMeta::setTitle('الإعلانات تحت المراجعة' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('الإعلانات تحت المراجعة' . ' - ' . $this->settings->title);
        JsonLd::setTitle('الإعلانات تحت المراجعة' . ' - ' . $this->settings->title);

        \General::seoCommon();
        if (backpack_auth()->check()) {
            $free_client_ads_under_reviewed = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->notPublished()->notCanceled()->mine()->get();
            $paid_client_ads_under_reviewed = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->notPublished()->notCanceled()->mine()->get();

            $count = $free_client_ads_under_reviewed->count() + $paid_client_ads_under_reviewed->count();
//            return $count;
            return view('front.pages.my_ads.all', compact(

                'free_client_ads_under_reviewed', 'paid_client_ads_under_reviewed', 'count'));
        } else {
            return redirect(url('login'))->with(['error' => 'يرجي تسجيل الدخول أولا .. ']);
        }
    }

    public function userPostsExpired()
    {
        SEOMeta::setTitle('الإعلانات المنتهية' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('الإعلانات المنتهية' . ' - ' . $this->settings->title);
        JsonLd::setTitle('الإعلانات المنتهية' . ' - ' . $this->settings->title);

        \General::seoCommon();
        if (backpack_auth()->check()) {
            $paid_client_ads_expired = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->ended()->selection()->published()->notCanceled()->mine()->get();

            $count = $paid_client_ads_expired->count();
//            return $count;
            return view('front.pages.my_ads.all', compact('paid_client_ads_expired', 'count'));
        } else {
            return redirect(url('login'))->with(['error' => 'يرجي تسجيل الدخول أولا .. ']);
        }
    }

    public function userPostsCanceled()
    {
        SEOMeta::setTitle('الإعلانات المرفوضة' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('الإعلانات المرفوضة' . ' - ' . $this->settings->title);
        JsonLd::setTitle('الإعلانات المرفوضة' . ' - ' . $this->settings->title);

        \General::seoCommon();
        if (backpack_auth()->check()) {
            $free_client_ads_canceled = Clientad::wiCountry()->wiCity()->wiState()->owner()->free()->selection()->notPublished()->Canceled()->mine()->get();
            $paid_client_ads_canceled = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->notPublished()->Canceled()->mine()->get();

            $count = $free_client_ads_canceled->count() + $paid_client_ads_canceled->count();
//            return $count;
            return view('front.pages.my_ads.all', compact('free_client_ads_canceled', 'paid_client_ads_canceled', 'count'));
        } else {
            return redirect(url('login'))->with(['error' => 'يرجي تسجيل الدخول أولا .. ']);
        }
    }

    public function packagesShow(Request $request)
    {
        SEOMeta::setTitle('إظهار الباقات' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('إظهار الباقات' . ' - ' . $this->settings->title);
        JsonLd::setTitle('إظهار الباقات' . ' - ' . $this->settings->title);

        \General::seoCommon();
//    return $request;
        $packs = \App\Models\Catpackage::where('cat_id', $request->sub_cat_id)->get();
        return view('front.pages.show-packages', compact('packs'));

    }

    public function buyPackage()
    {
        SEOMeta::setTitle('شراء باقة' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('شراء باقة' . ' - ' . $this->settings->title);
        JsonLd::setTitle('شراء باقة' . ' - ' . $this->settings->title);

        \General::seoCommon();
        $cats = \App\Models\Category::where('parent_id', null)->get();
        return view('front.pages.buy-package', compact('cats'));
    }

    public function checkPackages(Request $request)
    {
        $id = $request->id;
        $check = Catpackage::where('cat_id', $id)->first();
        if ($check) {
            return response()->json(['status' => 1, 'msg' => 'have']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Not']);
        }
    }


    public function newTestResult(Request $request)
    {
//        return $request;
        $main_cat_id = $request->has('new_main_cat_id') && $request->new_main_cat_id != null ? $request->new_main_cat_id : $request->request->remove('new_main_cat_id');
        $sub_cat_id = $request->has('new_sub_cat_id') && $request->new_sub_cat_id != null ? $request->new_sub_cat_id : $request->request->remove('new_sub_cat_id');
        $country_id = $request->has('new_country_id') && $request->new_country_id != null ? $request->new_country_id : $request->request->remove('new_country_id');
        $city_id = $request->has('new_city_id') && $request->new_city_id != null ? $request->new_city_id : $request->request->remove('new_city_id');
        $new_from_ = $request->has('new_from_') && $request->new_from_ != null ? $request->new_from_ : $request->request->remove('new_from_');
        $new_to_ = $request->has('new_to_') && $request->new_to_ != null ? $request->new_to_ : $request->request->remove('new_to_');
        $attrs = $request->has('attrs') ? $request->attrs : null;
        $attrs_yes_no = $request->has('attrs_yes_no') ? $request->attrs_yes_no : null;
        $from_to_attrs = $request->has('from_to') ? $request->from_to : null;


        $free_client_ads_in_cat = Clientad::query();
        $free_client_ads_in_cat->where('cat_id', 10);

        $paid_client_ads_in_cat = Clientad::query();
        $paid_client_ads_in_cat->where('cat_id', 10);


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


//        return $paid_client_ads_in_cat;

    }

    public function newSearchResult(Request $request)
    {
//        return $request;


        $cat = Category::select('slug', 'id')->find($request->new_sub_cat_id);
        $cat = Category::where('slug', $cat->slug)->first();
        SEOMeta::setTitle('نتائج البحث' . ' - ' . $this->settings['title']);
        SEOMeta::setDescription($cat->description);
        SEOMeta::addMeta('offer:published_time', $cat->created_at->toW3CString(), 'property');


        SEOMeta::addMeta('offer:section-title', 'نتائج البحث', 'property');
        SEOMeta::addMeta('offer:section-description', $cat->description, 'property');


//        $cat->tags;
        foreach ($cat->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }

        OpenGraph::setTitle('نتائج البحث' . ' - ' . $this->settings['title']);
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


        $main_cat_id = $request->has('new_main_cat_id') && $request->new_main_cat_id != null ? $request->new_main_cat_id : $request->request->remove('new_main_cat_id');
        $sub_cat_id = $request->has('new_sub_cat_id') && $request->new_sub_cat_id != null ? $request->new_sub_cat_id : $request->request->remove('new_sub_cat_id');
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


        $cat = Category::where('id', $request->new_sub_cat_id)->select('id', 'slug', 'title', 'parent_id')->first();

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
//        $other_attributes = AttributeChild::with([
//            'attribute' => function ($q) {
//                $q->with(['options' => function ($q) {
//                    $q->orderBy('lft', 'asc');
//                }])
//                    ->select('id', 'title', 'appearance', 'unit');
//            },
//        ])
//            ->where('cat_id', $cat->id)
//            ->where('main_other', 'other')
//            ->where('parent_id', null)
//            ->orderBy('lft', 'asc')
//            ->get();

        $min = (!empty($_GET['from_']) ? $_GET['from_'] : '');
        $max = (!empty($_GET['to_']) ? $_GET['to_'] : '');

        $countries = \App\Models\Location::with(['cities' => function ($q) {
            $q->with('cities');
        }])->where('parent_id', null)->get();


        return view('front.pages.search_results', compact('free_client_ads_in_cat',
            'paid_client_ads_in_cat', 'main_attributes', 'cat', 'min', 'max', 'countries'));

    }

    public function search(Request $request)
    {
//        return $request;
        if ($request->has('subcat') && $request->subcat != null) {
            $cat = Category::select('slug', 'id')->find($request->subcat);
            $cat = Category::where('slug', $cat->slug)->first();
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
//            return $attrs;
            if ($request->has('adv') && $request->subcat != '1') {
                $free_client_ads_in_cat = Clientad::query();
                $free_client_ads_in_cat->where('cat_id', $request->subcat);
//                $free_client_ads_in_cat->with('clientAdAttrsAnswers');

                $paid_client_ads_in_cat = Clientad::query();
                $paid_client_ads_in_cat->where('cat_id', $request->subcat);
                $paid_client_ads_in_cat->with('clientAdAttrsAnswers');


                if (!empty($_GET['from'])) {
//                return 'test';
                    $from_ = intval($_GET['from']);
//                $to_ = $_GET['to_'];

                    $free_client_ads_in_cat->where('price', '>', $from_);
                    $paid_client_ads_in_cat->where('price', '>', $from_);
                }

                if (!empty($_GET['to'])) {
//                return 'test';
                    $to_ = intval($_GET['to']);
                    $free_client_ads_in_cat->where('price', '<', $to_);
                    $paid_client_ads_in_cat->where('price', '<', $to_);
                }


                if (!empty($_GET['country'])) {
                    $country_id = $_GET['country'];
                    $free_client_ads_in_cat->where('country_id', $country_id);
                    $paid_client_ads_in_cat->where('country_id', $country_id);
                }


                if (!empty($_GET['city']) && $_GET['city'] != 'all') {
                    $city_id = $_GET['city'];
                    $free_client_ads_in_cat->where('city_id', $city_id);
                    $paid_client_ads_in_cat->where('city_id', $city_id);
                }

                if (!empty($_GET['state']) && $_GET['state'] != 'all') {
                    $state_id = $_GET['state'];
                    $free_client_ads_in_cat->where('state_id', $state_id);
                    $paid_client_ads_in_cat->where('state_id', $state_id);
                }

                if (!empty($_GET['sort'])) {
                    $ordering = $_GET['sort'];
//                return $ordering;
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


                if (!empty($_GET['attrs'])) {
                    $attrs = $_GET['attrs'];
//                    return $attrs;
//                    $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) {
//                        $q->where('attr_id', null);
//                    });
//                    $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) {
//                        $q->where('attr_id', null);
//                    });
//                 return $attrs;
                    foreach ($attrs as $k => $attr_item) {
//                     return $attr_item;
                        if ($attr_item != 0) {
                            $arr = explode('-', $k);
//                            return $arr;
                            $attr_id = $arr[0];
                            $answer_val = $arr[1];
                            $free_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($attr_id, $answer_val) {
                                $q->where('attr_id', $attr_id)->where('answer_value', $answer_val);
                            });
                            $paid_client_ads_in_cat->whereHas('clientAdAttrsAnswers', function ($q) use ($attr_id, $answer_val) {
                                $q->where('attr_id', $attr_id)->where('answer_value', $answer_val);
                            });
                        }
                    }
                }
                $free_client_ads_in_cat = $free_client_ads_in_cat->free()->published()->notCanceled()->get();
                $paid_client_ads_in_cat = $paid_client_ads_in_cat->paid()->notEnd()->published()->notCanceled()->get();


//            return $paid_client_ads_in_cat;

                $cat = Category::with(['attributes' => function ($q) {
                    $q->with('options');
                }])->where('id', $request->subcat)->select('id', 'slug', 'title', 'parent_id')->first();
                $attributes = $cat->attributes;
                $min = (!empty($_GET['from_']) ? $_GET['from_'] : '');
                $max = (!empty($_GET['to_']) ? $_GET['to_'] : '');

                $country_id = (!empty($_GET['country']) ? $_GET['country'] : '');

                $city_id = (!empty($_GET['city']) ? $_GET['city'] : '');

                $state_id = (!empty($_GET['state']) ? $_GET['state'] : '');
                $countries = \App\Models\Location::with(['cities' => function ($q) {
                    $q->with('cities');
                }])->where('parent_id', null)->get();

                return view('front.pages.search_results', compact('free_client_ads_in_cat',
                    'paid_client_ads_in_cat', 'attributes', 'cat', 'min', 'max', 'country_id', 'city_id', 'state_id', 'countries'));

            } else {

                $free_client_ads_in_cat = Clientad::query();
                $free_client_ads_in_cat->where('cat_id', $request->subcat);

                $paid_client_ads_in_cat = Clientad::query();
                $paid_client_ads_in_cat->where('cat_id', $request->subcat);

                if (!empty($_GET['from'])) {
//                return 'test';
                    $from_ = intval($_GET['from']);
//                $to_ = $_GET['to_'];

                    $free_client_ads_in_cat->where('price', '>', $from_);
                    $paid_client_ads_in_cat->where('price', '>', $from_);
                }

                if (!empty($_GET['to'])) {
//                return 'test';
                    $to_ = intval($_GET['to']);
                    $free_client_ads_in_cat->where('price', '<', $to_);
                    $paid_client_ads_in_cat->where('price', '<', $to_);
                }

                if (!empty($_GET['country'])) {
                    $country_id = $_GET['country'];
                    $free_client_ads_in_cat->where('country_id', $country_id);
                    $paid_client_ads_in_cat->where('country_id', $country_id);
                }

                if (!empty($_GET['city']) && $_GET['city'] != 'all') {
                    $city_id = $_GET['city'];
                    $free_client_ads_in_cat->where('city_id', $city_id);
                    $paid_client_ads_in_cat->where('city_id', $city_id);
                }

                if (!empty($_GET['state']) && $_GET['state'] != 'all') {
                    $state_id = $_GET['state'];
                    $free_client_ads_in_cat->where('state_id', $state_id);
                    $paid_client_ads_in_cat->where('state_id', $state_id);
                }

                if (!empty($_GET['sort'])) {
                    $ordering = $_GET['sort'];
//                return $ordering;
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


//            return $paid_client_ads_in_cat;

                $cat = Category::with(['attributes' => function ($q) {
                    $q->with('options');
                }])->where('id', $request->subcat)->select('id', 'slug', 'title', 'parent_id')->first();
                $attributes = $cat->attributes;
                $min = (!empty($_GET['from_']) ? $_GET['from_'] : '');
                $max = (!empty($_GET['to_']) ? $_GET['to_'] : '');

                $country_id = (!empty($_GET['country']) ? $_GET['country'] : '');

                $city_id = (!empty($_GET['city']) ? $_GET['city'] : 'all');

                $state_id = (!empty($_GET['state']) ? $_GET['state'] : 'all');

                $countries = \App\Models\Location::with(['cities' => function ($q) {
                    $q->with('cities');
                }])->where('parent_id', null)->get();

                return view('front.pages.search_results', compact('free_client_ads_in_cat',
                    'paid_client_ads_in_cat', 'attributes', 'cat', 'min', 'max', 'country_id', 'city_id', 'state_id', 'countries'));
            }
        } else {
            return redirect(route('site.home'))->with(['success' => 'حدث خطأ ما برجاء المحاولة فيما بعد']);
        }

    }

    public function packsBills()
    {

        $packs = Boughtpackage::with(['clientAds' => function ($q) {
            $q->where('is_published', '1')->where('is_canceled', '0')->orWhere('is_published', '0')->where('is_canceled', '0');
        }])->where('user_id', backpack_auth()->user()->id)->get();
//        $count = $packs->clientAds->where('is_published', '1')->where('is_canceled', '0')->count() + $packs->clientAds->where('is_published', '0')->where('is_canceled', '0')->count();

        $orders = Order::with('cart_info')->where('user_id', backpack_user()->id)->orderBy('id', 'desc')->get();
        if ($orders) {
            SEOMeta::setTitle('باقاتي' . ' - ' . $this->settings['title']);
            OpenGraph::setTitle('باقاتي' . ' - ' . $this->settings['title']);
            JsonLd::setTitle('باقاتي' . ' - ' . $this->settings['title']);
            \General::seoCommon();

            return view('front.pages.orders', compact('orders', 'packs'));
        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);
        }
    }

    public function packMyAds($id)
    {
//        return $id;
        SEOMeta::setTitle('إعلاناتي' . ' - ' . $this->settings['title']);
        OpenGraph::setTitle('إعلاناتي' . ' - ' . $this->settings['title']);
        JsonLd::setTitle('إعلاناتي' . ' - ' . $this->settings['title']);
        \General::seoCommon();

        $paid_client_ads_published = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->published()->notCanceled()->notEnd()->mine()->userPack($id)->get();
        $paid_client_ads_under_reviewed = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->selection()->notPublished()->notCanceled()->mine()->userPack($id)->get();
        $paid_client_ads_expired = Clientad::wiCountry()->wiCity()->wiState()->owner()->paid()->ended()->selection()->published()->notCanceled()->mine()->userPack($id)->get();

        $count = $paid_client_ads_published->count() + $paid_client_ads_under_reviewed->count() +
            $paid_client_ads_expired->count();
        $pack = Boughtpackage::where('user_id', backpack_auth()->user()->id)->find($id);
//        return $pack;
        if ($pack) {
            return view('front.pages.packMyAds', compact('paid_client_ads_published', 'paid_client_ads_under_reviewed', 'paid_client_ads_expired', 'count', 'pack'));

        } else {
            return redirect(route('site.home'))->with(['error' => 'حدث خطأ ما .. برجاء المحاولة فيما بعد']);
        }
//            return $count;
    }

    public function showIcons()
    {
        return view('icons.index');
    }
}
