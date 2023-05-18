<?php

use App\Http\Requests\OrderStoreRequest;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'namespace' => 'App\Http\Controllers\Front',
], function () {
    Route::get('redirect/facebook', 'ProvidersController@loginUsingFacebook')->name('facebook.login');
    Route::get('callback/facebook', 'ProvidersController@callbackFromFacebook')->name('facebook.callback');

    Route::get('redirect/google', 'ProvidersController@loginUsingGoogle')->name('google.login');
    Route::get('callback/google', 'ProvidersController@callbackFromGoogle')->name('google.callback');
});


Route::post('get-child-cat/{id}', function (Illuminate\Http\Request $request, $id) {
    $subs = \App\Models\Category::select('id', 'title','cat_icon', 'parent_id')->where('parent_id', $id)->get();
    return response(['status' => 1, 'message' => 'None', 'data' => $subs]);
});

Route::post('get-cat-attrs/{id}', function (Illuminate\Http\Request $request, $id) {
    $attrs = \App\Models\Category::with(['attributes' => function ($q) {
        $q->where('type_of', 'other')->orderBy('lft', 'ASC')->with(['options' => function ($q) {
            $q->orderBy('lft', 'ASC');
        }]);
    }])->select('id')->where('id', $id)->first();
    return response(['status' => 1, 'message' => 'Attrs', 'data' => $attrs]);
});

Route::post('get-child-city/{id}', function (Illuminate\Http\Request $request, $id) {
    $cities = \App\Models\Location::select('id', 'name', 'parent_id')->where('parent_id', $id)->get();
    return response(['status' => 1, 'message' => 'None', 'data' => $cities]);
});

Route::post('get-child-state/{id}', function (Illuminate\Http\Request $request, $id) {
    $cities = \App\Models\Location::select('id', 'name', 'parent_id')->where('parent_id', $id)->get();
    if ($cities->count() > 0) {
        return response(['status' => 1, 'message' => 'Data', 'data' => $cities]);
    } else {
        return response(['status' => 0, 'message' => 'Empty', 'data' => '']);

    }
});




Route::post('add-to-wish', function (\Illuminate\Http\Request $request) {

    if (!backpack_auth()->check()) {
        return response()->json(['status' => 0, 'msg' => 'برجاء تسجيل الدخول أولا', 'data' => null]);
    }

    if (empty($request->id)) {
        return response()->json(['status' => 0, 'msg' => 'حدث خطأ ما برجاء المحاولة فيما بعد', 'data' => null]);
    }
    $client_ad = \App\Models\Clientad::select('id')->find($request->id);
    // return $product;
    if (empty($client_ad)) {
        return response()->json(['status' => 0, 'msg' => 'حدث خطأ ما برجاء المحاولة فيما بعد', 'data' => null]);
    }

    //where('cart_id', null)->

    $already_wishlist = \App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id', $client_ad->id)->first();
    // return $already_wishlist;
    if ($already_wishlist) {
        return response()->json(['status' => 0, 'msg' => 'هذا الإعلان موجود بالفعل في قائمة المحفوظات', 'data' => null]);

    } else {
        $wishlist = new \App\Models\Wish();
        $wishlist->user_id = backpack_auth()->user()->id;
        $wishlist->client_ad_id = $client_ad->id;
        $wishlist->save();
    }
    return response()->json(['msg' => 'تم إضافة الإعلان لقائمة المفضلة', 'status' => 1, 'data' => null]);
})->name('add.to.wish');


Route::post('testing', function (\Illuminate\Http\Request $request) {
    $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

    if (!$receiver->isUploaded()) {
        // file not uploaded
    }

    $fileReceived = $receiver->receive(); // receive file
    if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
        $file = $fileReceived->getFile(); // get file
        $extension = $file->getClientOriginalExtension();
        $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
        $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

        $name = $file->store('/', 'ad_covers');

//            return response(['data' => $name]);
//            $disk = Storage::disk(config('filesystems.default'));
//            $path = $disk->putFileAs('crm_files', $file, $fileName);

        // delete chunked file
        unlink($file->getPathname());
        return [
            'path' => asset('assets/ad_covers/' . $name),
            'filename' => $name
        ];
    }

    // otherwise return percentage informatoin
    $handler = $fileReceived->handler();
//        return ['data' => $request];
    return [
        'done' => $handler->getPercentageDone(),
        'status' => true
    ];
})->name('files.upload.large');
Route::post('delete-cover', function (\Illuminate\Http\Request $request) {
    if ($request->cover_image_name != "") {
        unlink(public_path('/assets/ad_covers/' . $request->cover_image_name));
        return response()->json(['msg' => 'done', 'status' => 1, 'data' => 'Deleted']);
    } else {
        return response()->json(['msg' => 'done', 'status' => 1, 'data' => 'First Time']);

    }
})->name('delete.cover');


Route::get('checkSlug', function (\Illuminate\Http\Request $request) {
    $slug = General::slugOfAd($request->title);
    return response()->json(['slug' => $slug]);
})->name('checkSlug');


Route::get('checkSlug-blog', function (\Illuminate\Http\Request $request) {
    $slug = General::slugOfBlog($request->title);
    return response()->json(['slug' => $slug]);
})->name('checkSlugBlog');

Route::get('checkSlug-post', function (\Illuminate\Http\Request $request) {
    $slug = General::slugOfPost($request->title);
    return response()->json(['slug' => $slug]);
})->name('checkSlugPost');
Route::get('checkSlug-cat', function (\Illuminate\Http\Request $request) {
    $slug = General::slugOfPost($request->title);
    return response()->json(['slug' => $slug]);
})->name('checkSlugCat');


Route::post('get-user-packages', function (Illuminate\Http\Request $request) {
    if (!backpack_auth()->check()) {
        return response()->json(['status' => 0, 'msg' => 'برجاء تسجيل الدخول أولا', 'data' => null]);
    }
    $packs = \App\Models\Boughtpackage::with(['clientAds' => function($q) {
        $q->where('is_published', '1')->where('is_canceled', '0')->orWhere('is_published', '0')->where('is_canceled', '0');
    }])->where('user_id', $request->id)->where('full_ads', 0)->where('cat_id', $request->subcat_id)->get();

    return response()->json(['status' => 1, 'msg' => 'باكدجات العميل', 'data' => $packs]);
});





Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {

    /* Start Done */
    Route::post('checkPackages/{id}', 'OverAllController@checkPackages')->name('checkPackages');

    Route::get('show-icons', 'OverAllController@showIcons')->name('show.icons');

    Route::get('client-ad/{slug}', 'ClientAdsController@show')->name('client_ad.show');
    Route::get('cat/{slug}', 'CategoriesController@show')->name('cat.show');
    Route::get('mainCat/{slug}', 'CategoriesController@mainShow')->name('mainCat.show');
    Route::get('articles', 'BlogController@index')->name('articles.index');
    Route::get('articles/{slug}', 'BlogController@show')->name('articles.show');
    Route::get('/', 'OverAllController@index')->name('site.home');
    Route::get('about-us', 'OverAllController@about')->name('about.us');
    Route::get('contact-us', 'OverAllController@contactUs')->name('contact.us');
    Route::post('contact-us', 'OverAllController@sendContact')->name('send.contact.us');
    Route::post('show-packages', 'OverAllController@packagesShow')->name('packages.show');

    Route::get('search-results', 'OverAllController@search')->name('search.results');
    Route::get('get-search-results', 'OverAllController@newSearchResult')->name('new.search.get');


    Route::get('privacy-policy', 'OverAllController@privacy')->name('privacy.policy');
    Route::get('terms', 'OverAllController@terms')->name('terms');
    Route::get('seller-posts/{serial}', 'ClientAdsController@sellerAds')->name('seller.ads');


    /* End Done */

    /* Start New */
    Route::get('quick-search', 'OverAllController@quickSearch')->name('quick.search');
    /* End New */


    Route::get('ahaaaaa', function () {
         $ordered_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->get();
//        $id = $ordered_attributes->attr_id;
        foreach ($ordered_attributes as $item) {
             $attr = Attribute::find($item->attr_id)->type_of;
            \Illuminate\Support\Facades\DB::table('attr_cat')->where('attr_id', $item->attr_id)->update([
                'main_other' => $attr
            ]);
        }
//        $ordered_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->where('cat_id','=', 10)->where('parent_id', 84)->orderBy('lft', 'ASC')->get();
//
//        return $ordered_attributes;
    });







    Route::group(['middleware' => 'UserAuth'], function () {


        /* Start Done */

        Route::get('cart', 'CartController@index')->name('cart.index');
        Route::post('add-to-cart/{id}', 'CartController@addToCart')->name('add.cart');
        Route::get('delete-cart/{id}', 'CartController@cartDelete');
        Route::get('/add-post', 'PostsController@addPostOne')->middleware('IsInfoComplete')->middleware('PhoneVerified')->name('add.post');

        Route::post('upload-organize', 'PostsController@uploadOrganize')->name('uploadOrganize');
        Route::post('upload-try', 'PostsController@uploadTry')->name('uploadTry');
        Route::post('delete-organized', 'PostsController@deleteOrganize')->name('deleteOrganize');

        Route::post('new-post-add', 'PostsController@newAddPost')->name('new.post.add');


        Route::get('add-post-one', 'PostsController@addPostStepOne')->name('add.post.one');
        Route::get('add-post-two', 'PostsController@addPostStepTwo')->middleware('PhoneVerified')->name('add.post.two');
        Route::get('otp', 'OtpController@sendOtp')->name('otp.sender');
        Route::post('resend-otp', 'OtpController@resendOtp')->name('otp.resend');

        Route::get('verifying', 'OtpController@verifying')->name('verifying.view')->middleware('PhoneExists');
        Route::post('verifying', 'OtpController@verifyPost')->name('verify.post');

        Route::get('buy-package', 'OverAllController@buyPackage')->name('buy-package');

        Route::get('my_packages', 'OverAllController@packsBills')->name('packages.bills');
        Route::get('pack_ads/{id}', 'OverAllController@packMyAds')->name('pack.myAds');

        Route::get('wish-list', 'WishesController@index')->name('wish.list');
        Route::get('delete-wish', 'WishesController@delete')->name('wish.delete');

        Route::post('/upload', 'DropzoneController@store')->name('dropzone.store');
        Route::get('personal-edit', 'OverAllController@personalEdit')->name('personal.edit');
        Route::post('personal-edit', 'OverAllController@personalUpdate')->name('personal.update');

        Route::post('delete/file', 'DropzoneController@deleteFileDrop')->name('delete.file.drop');

        Route::get('checkout/{payment}', 'OrdersController@checkout' )->name('checkout')->middleware('NotEmptyCart');
        Route::post('complete-order', 'OrdersController@completeOrder')->name('complete-order');

        Route::group(['prefix' => 'user-posts'], function () {
            Route::get('/', 'OverAllController@userPosts')->name('user.posts');
            Route::get('/published', 'OverAllController@userPostsPublished')->name('user.posts.published');
            Route::get('/under-review', 'OverAllController@userPostsUnder')->name('user.posts.under');
            Route::get('/expired', 'OverAllController@userPostsExpired')->name('user.posts.expired');
            Route::get('/canceled', 'OverAllController@userPostsCanceled')->name('user.posts.canceled');

        });

        Route::get('paypal/pay/{payment?}/{order_id}', 'PaypalController@payment')->name('paypal.payment');
        Route::get('cancel/{id}', 'PaypalController@cancel')->name('paypal.cancel');
        Route::get('payment/success/{id}', 'PaypalController@success')->name('paypal.success');


        Route::get('/payments/verify/{payment?}/{order_id}', [\App\Http\Controllers\Front\PaymentsController::class, 'payment_verify'])->name('payment-verify');
        Route::get('/payment-status', [\App\Http\Controllers\Front\PaymentsController::class, 'paymentStatus'])->name('payment-status');


        Route::get('/wallet/verify/{payment?}/{order_id}', [\App\Http\Controllers\Front\PaymentsController::class, 'wallet_verify'])->name('wallet-verify');
        Route::get('/v-wallet-status', [\App\Http\Controllers\Front\PaymentsController::class, 'walletStatus'])->name('wallet-status');


        /* End Done */












    });
});















//Route::post('test', function (\Illuminate\Http\Request $request) {
//    return $request;
//})->name('test');
//Route::get('test', function () {
//    $arr = [
//        "select_attr_3_4",
//        "select_attr_4_10",
//        "check_attr_6_1"
//    ];
//    foreach ($arr as $item) {
//        $new_parts = str_replace('attr_', '', $item);
//        $new_parts = explode('_', $new_parts);
//        $new_type = $new_parts[0];
//        $new_attr_id = $new_parts[1];
//        $new_answer = $new_parts[2];
//
////        return $new_answer;
//        $test = new \App\Models\Answer();
//        $test->client_ad_id = "81";
//        $test->attr_id = $new_attr_id;
//        $test->answer_value = $new_answer;
//        $test->answer_type = $new_type;
//        $test->save();
//    }
//
//
//    return "test";
//    $pack = \App\Models\Boughtpackage::with('clientAds')->where('user_id', backpack_auth()->user()->id)->find(1);
////    return $pack->clientAds->count();
//    $date_1 = date("Y-m-d");
//    return $date_2 = date('Y-m-d', strtotime($date_1 . ' + ' . $pack->duration . ' days'));
//
//    if ($date1 > $date2)
//        echo "$date1 is latest than $date2";
//    else
//        echo "$date1 is older than $date2";
//
//
//    if ($pack->clientAds->count() < $pack->ads_count) {
//        return 'tmam';
//    } else {
//        return "mesh tmam";
//    }
//});










