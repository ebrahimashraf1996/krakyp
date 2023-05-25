<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }

    public function index()
    {

    }

    public function addPostOne()
    {
        SEOMeta::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        JsonLd::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);

        \General::seoCommon();
        $categories_with_attrs = Category::with(['attributes' => function ($q) {
            $q->with('options');
        }])->get();

        $cats = \App\Models\Category::where('parent_id', null)->get();
        $locations = \App\Models\Location::where('parent_id', null)->get();
        return view('front.pages.add-post-one', compact('cats', 'locations', 'categories_with_attrs'));
    }

    public function addPostStepOne(\Illuminate\Http\Request $request)
    {
//    return $request;
        SEOMeta::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        JsonLd::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);

        \General::seoCommon();
        $cat = \App\Models\Category::with(['attributes' => function ($q) {
            $q->with('options');
        }])->find($request->sub_cat_id);

        $categories = Category::with('attributes')->get();
        return view('front.pages.add-post-two', compact('request', 'cat'));
    }


    public function uploadOrganize(Request $request)
    {

        $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path('upload'), $imageName);

        return response()->json(['uploaded' => '/organized/' . $imageName]);
    }

    public function uploadTry(Request $request)
    {
        $countfiles = count($_FILES['files']['name']);

        $upload_location = "organized/";

        $files_arr = array();


        for ($index = 0; $index < $countfiles; $index++) {

            if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                // File name
                $filename = time() . '_' . $_FILES['files']['name'][$index];
//                return response()->json(['status' => 1, 'data' => $filename]);

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png", "jpeg", "jpg");

                // Check extension
                if (in_array($ext, $valid_ext)) {

                    // File path
                    $path = $upload_location . $filename;

                    // Upload file
                    if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
                        $files_arr[] = $filename;
                    }
                }
            }
        }


        return response()->json(['status' => 1, 'data' => $files_arr]);
    }


    public function deleteOrganize(Request $request)
    {
        if (\File::exists(public_path('/organized/' . $request->image_path))) {
            \File::delete(public_path('/organized/' . $request->image_path));
            return response()->json(['status' => 1, 'msg' => 'تم مسح الصورة']);

        } else {
            return response()->json(['status' => 0, 'msg' => 'حدث خطأ ما .. برجاء المحاولة مرة اخري']);
        }

    }


    public function addPostStepTwo(Request $request)
    {
        SEOMeta::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);
        JsonLd::setTitle('أنشر إعلانك' . ' - ' . $this->settings->title);

        \General::seoCommon();

        $attr_vals = explode('sperator', $request->attr_vals);
        $emptyRemoved = array_filter($attr_vals);
//    return response()->json(['msg' => 'برجاء اختيار باقة اخري', 'status' => 0, 'data' => $request->attr_vals]);

        $country = \App\Models\Location::find($request->country);
        $new_ad = new \App\Models\Clientad();

        $separator = '-';
        $string = trim($request->title);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        $count = \App\Models\Clientad::where('slug', 'like', '%' . $string . '%')->get()->count();
        $string = $string . "-" . $count;

        $maincat_id = Category::find($request->sub_cat)->parent_id;

        if ($request->status === 'free') {
            $new_ad->title = $request->title;
            $new_ad->slug = $string;
            $new_ad->description = $request->description;
            $new_ad->price = $request->price;
//    $new_ad->cover = $request->cover_image;
            $new_ad->images = implode(',', $request->images);
            $new_ad->country_id = $request->country;
            $new_ad->city_id = $request->city_id;
            $new_ad->state_id = $request->state_id;
            $new_ad->is_published = 0;
            $new_ad->status = 'free';
            $new_ad->start_date = null;
            $new_ad->end_date = null;
            $new_ad->serial_num = strtoupper(Str::random(10));
            $new_ad->user_id = backpack_auth()->user()->id;
            $new_ad->cat_id = $request->sub_cat;
            $new_ad->maincat_id = $maincat_id;
            $new_ad->user_package_id = null;


        } elseif ($request->status === 'paid') {
            $new_ad->title = $request->title;
            $new_ad->slug = $string;
            $new_ad->description = $request->description;
            $new_ad->price = $request->price;
//    $new_ad->cover = $request->cover_image;
            $new_ad->images = implode(',', $request->images);
            $new_ad->country_id = $request->country;
            $new_ad->city_id = $request->city_id;
            $new_ad->state_id = $request->state_id;
            $new_ad->is_published = 0;
            $new_ad->status = 'paid';
            $new_ad->serial_num = strtoupper(Str::random(10));
            $new_ad->user_id = backpack_auth()->user()->id;
            $new_ad->cat_id = $request->sub_cat;
            $new_ad->maincat_id = $maincat_id;

            $pack = \App\Models\Boughtpackage::with(['clientAds' => function ($q) {
                $q->where('is_published', '1')->where('is_canceled', '0')->orWhere('is_published', '0')->where('is_canceled', '0');
            }])->where('user_id', backpack_auth()->user()->id)->find($request->pack_id);

            $start_date = date("Y-m-d");
            $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $pack->duration . ' days'));
            $count = $pack->clientAds->where('is_published', '1')->where('is_canceled', '0')->count() + $pack->clientAds->where('is_published', '0')->where('is_canceled', '0')->count();
            if ($count < $pack->ads_count) {

                $new_ad->user_package_id = $request->pack_id;
                $new_ad->duration = $pack->duration;
                $new_ad->start_date = null;
                $new_ad->end_date = null;
            } else {
                return response()->json(['msg' => 'برجاء اختيار باقة اخري', 'status' => 0, 'data' => null]);
            }
        }
        $new_ad->save();

        if ($new_ad->save()) {
            foreach ($emptyRemoved as $item) {
                $new_parts = str_replace('attr_', '', $item);
                $new_parts = explode('_', $new_parts);
                $new_type = $new_parts[0];
                $new_attr_id = $new_parts[1];
                $new_answer = $new_parts[2];

//        return $new_answer;
                $test = new \App\Models\Answer();
                $test->client_ad_id = $new_ad->id;
                $test->attr_id = $new_attr_id;
                $test->answer_value = $new_answer;
                $test->answer_type = $new_type;
                $test->save();
            }
            return response()->json(['msg' => 'تم إنشاء الإعلان بنجاح وهو الآن تحت المراجعة', 'status' => 1, 'data' => ['slug' => $new_ad->slug]]);
        } else {
            return response()->json(['msg' => 'error', 'status' => 0, 'data' => null]);
        }
    }

    public function newAddPost(Request $request)
    {
//        return $request;
        $separator = '-';
        $string = trim($request->title);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        $count = \App\Models\Clientad::where('slug', 'like', '%' . $string . '%')->get()->count();
        $string = $string . "-" . $count;

        $new_ad = new \App\Models\Clientad();


        if ($request->status === 'free') {
            $new_ad->title = $request->title;
            $new_ad->slug = $string;
            $new_ad->description = $request->description;
            $new_ad->price = $request->price;
            $new_ad->cover = $request->cover;
            $new_ad->images = implode(',', $request->images);
            $new_ad->country_id = $request->country_id;
            $new_ad->city_id = $request->city_id;
            $new_ad->state_id = $request->state_id;
            $new_ad->is_published = 0;
            $new_ad->status = 'free';
            $new_ad->start_date = null;
            $new_ad->end_date = null;
            $new_ad->serial_num = strtoupper(Str::random(10));
            $new_ad->user_id = backpack_auth()->user()->id;
            $new_ad->cat_id = $request->sub_cat_id;
            $new_ad->maincat_id = $request->main_cat_id;
            $new_ad->user_package_id = null;


        } else if ($request->status === 'paid') {
            $new_ad->title = $request->title;
            $new_ad->slug = $string;
            $new_ad->description = $request->description;
            $new_ad->price = $request->price;
            $new_ad->cover = $request->cover;
            $new_ad->images = implode(',', $request->images);
            $new_ad->country_id = $request->country_id;
            $new_ad->city_id = $request->city_id;
            $new_ad->state_id = $request->state_id;
            $new_ad->is_published = 0;
            $new_ad->status = 'paid';
            $new_ad->serial_num = strtoupper(Str::random(10));
            $new_ad->user_id = backpack_auth()->user()->id;
            $new_ad->cat_id = $request->sub_cat_id;
            $new_ad->maincat_id = $request->main_cat_id;

            $pack = \App\Models\Boughtpackage::with(['clientAds' => function ($q) {
                $q->where('is_published', '1')->where('is_canceled', '0')->orWhere('is_published', '0')->where('is_canceled', '0');
            }])->where('user_id', backpack_auth()->user()->id)->find($request->pack_id);

            if ($count < $pack->ads_count) {

                $new_ad->user_package_id = $request->pack_id;
                $new_ad->duration = $pack->duration;
                $new_ad->start_date = null;
                $new_ad->end_date = null;
            } else {
                return response()->json(['msg' => 'برجاء اختيار باقة اخري', 'status' => 0, 'data' => $request]);
            }


        }
        $check = $new_ad->save();

        if ($check) {
            foreach ($request->main_attributes as $single_array) {
                foreach ($single_array as $item) {
                    if ($item[1] != '0') {
                        $answer = Answer::create([
                            'client_ad_id' => $new_ad->id,
                            'attr_id' => $item[0],
                            'answer_value' => $item[1],
                        ]);
                    }
                }
            }
            foreach ($request->other_attributes as $single_array) {
                foreach ($single_array as $item) {
                    if ($item[1] != '0') {
                        $answer = Answer::create([
                            'client_ad_id' => $new_ad->id,
                            'attr_id' => $item[0],
                            'answer_value' => $item[1],
                        ]);
                    }
                }
            }

            return response()->json(['msg' => 'الإعلان قيد المراجعة', 'status' => 1, 'data' => ['slug' => $new_ad->slug]]);
        } else {
            return response()->json(['msg' => 'error', 'status' => 0, 'data' => null]);
        }


//        return $new_ad;
//        return response()->json(['status' => 1, 'msg' => 'test', 'data' => ['test' => $request->details['title']]]);
    }
}
