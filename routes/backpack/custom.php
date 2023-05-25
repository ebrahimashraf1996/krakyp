<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
//        (array) 'testing'
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('attribute', 'AttributeCrudController');
    Route::crud('option', 'OptionCrudController');
    Route::post('attribute/{id}/addOptions', 'AttributeCrudController@addOptions')->name('addOptions');
    Route::post('cat/{id}/add-packages', 'CategoryCrudController@addPackes')->name('addPackages');
    Route::crud('tag', 'TagCrudController');
    Route::crud('setting', 'SettingCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('catpackage', 'CatpackageCrudController');
    Route::crud('banner', 'BannerCrudController');
    Route::crud('blogcategory', 'BlogcategoryCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('message', 'MessageCrudController');
    Route::crud('clientad', 'ClientadCrudController');
    Route::crud('under-review', 'UnderClientadCrudController');
    Route::crud('rejected', 'RejectedClientadCrudController');
    Route::crud('reason', 'ReasonCrudController');
    Route::crud('test-cat', 'TestCategoryCrudController');
    Route::crud('reordering-attribute', 'ReorderingAttributeCrudController');
//    Route::get('attribute-reordering', 'ReorderingAttributeCrudController@saveReorder')->name('attribute.reordering');
    Route::crud('mobilebanner', 'MobilebannerCrudController');
}); // this should be the absolute last line of this file




































Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
        (array) 'testing'
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('test-cat', 'TestCategoryCrudController');
}); // this should be the absolute last line of this file