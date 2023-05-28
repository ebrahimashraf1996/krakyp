@extends('front.layouts.master')

@section('styles')
    <style>
        .nice-select {
            line-height: 28px !important;
        }

        #adv_opts_cont .nice-select {
            width: 100%;
        }

        nav.lower-nav {
            height: 100px;
            background: #ffffffa6
        }

        .attr_single .nice-select .attr_select_list {
            max-height: 285px;
            overflow-y: scroll;
        }

        #country_row {
            padding: 1rem 1.5rem
        }

        #atts_div .state {
            font-size: 16px;
        }


    </style>
@stop

@section('content')

    {{--    Start Search Section--}}
    <section class="new_banners container" dir="ltr">
        <div class="owl-carousel owl-theme" id="banners_section">
            @foreach($banners as $item)
                <div class="item banner_item">
                    <img src="{{asset($item->image)}}" alt="{{asset($item->image_alt)}}" width="100%">
                </div>
            @endforeach
        </div>


        <div class="owl-carousel owl-theme" id="banners_section_mobile">
            @foreach($banners_mobile as $item)
                <div class="item banner_item">
                    <img src="{{asset($item->image)}}" alt="{{asset($item->image_alt)}}" width="100%">
                </div>
            @endforeach
        </div>

{{--        Model--}}




        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-3 col-3 new_search_box"
                 style="height: 300px;background: #fff">
                <form action="{{route('new.search.get')}}" method="get" id="new_search_form">
                    <div class="row" dir="rtl">
                        <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1" id="new_main_cat">
                            <select class="form-control" id="new_main_cat_id" name="new_main_cat_id">
                                <option value="">اختر الفئة الرئيسية</option>
                                @foreach($cats as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1"
                             id="new_sub_cat_id_div" disabled="">
                            <select class="form-control" id="new_sub_cat_id" name="new_sub_cat_id" disabled=""
                                    style="width: 100%">
                                <option value="">اختر الفئة الفرعية</option>
                            </select>
                        </div>
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="new_from_div">
                            <input type="number" class="form-control" id="new_from_" name="new_from_"
                                   value="" placeholder="أقل سعر ج.م" required>
                        </div>
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="new_to_div">
                            <input type="number" class="form-control" id="new_to_" name="new_to_"
                                   value="" placeholder="أعلي سعر ج.م" required>
                        </div>
                        <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1" id="new_sort_div">
                            <select class="form-control" id="new_sort_by" name="new_sort_by">
                                <option value="cr_desc">من الأحدث إلي الأقدم</option>
                                <option value="cr_asc">من الأقدم إلي الأحدث</option>
                                <option value="pr_asc">من الأقل سعر إلي الأعلي سعر</option>
                                <option value="pr_desc">من الأعلي سعر إلي الأقل سعر</option>
                            </select>
                        </div>
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="get_result_btn_div">
                            <button type="submit" class="btn get_result_btn w-100" id="get_result_btn"><i
                                    class="fa-solid fa-magnifying-glass"></i> &nbsp;اظهر النتائج
                            </button>
                        </div>
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="get_result_btn_div">
                            <a class="btn w-100 new_adv_search" href="javascript:void(0);" id="new_adv_search"><i
                                    class="fa-solid fa-gears"></i> &nbsp;بحث متقدم</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



    {{--    <section style="height: 300px; background:#ddd;">--}}
    {{--        <i class="fa-solid fa-car-burst"></i>--}}
    {{--    </section>--}}

    {{--    <section class="search-section"--}}
    {{--             style="min-height: 70vh">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row text-center">--}}
    {{--                <div class="col-md-12 col-sm-12 col-12 m-auto mt-3">--}}
    {{--                    <h1 class="bold">--}}
    {{--                        اختر ما تريد من عقارات .. سيارات .. اكسسوارات والمزيد..--}}
    {{--                    </h1>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @php--}}
    {{--                $settings = \App\Models\Setting::select('search_bg')->first();--}}
    {{--            @endphp--}}
    {{--            <div class="row">--}}
    {{--                <form action="{{'search.clientAds'}}" method="get" id="search_form">--}}
    {{--                    <div class="col-md-9 col-sm-12 col-11 m-auto bordered search-div"--}}
    {{--                         style="background-image: url('{{asset($settings->search_bg)}}')">--}}
    {{--                        <div class="row " id="country_row">--}}
    {{--                            <div class="form-group col-md-4 " id="country_div">--}}
    {{--                                <label for="country" class="mb-1 bold">المحافظة</label>--}}
    {{--                                <select class="form-control" id="country" name="country">--}}
    {{--                                    <option value="">اختر المحافظة</option>--}}
    {{--                                    @foreach($locations as $item)--}}
    {{--                                        <option value="{{$item->id}}">{{$item->name}}</option>--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-4 col-12" id="city_id_div">--}}
    {{--                                <label for="city_id" class="mb-1 bold">المدينة</label>--}}
    {{--                                <select class="form-control" id="city_id" name="city_id" disabled="">--}}
    {{--                                    <option value="all">الكل</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-4 " id="state_id_div">--}}
    {{--                                <label for="state_id" class="mb-1 bold">الحي / المركز</label>--}}
    {{--                                <select class="form-control" id="state_id" name="state_id" disabled="">--}}
    {{--                                    <option value="all">الكل</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row" id="cats_row">--}}
    {{--                            <div class="form-group col-md-6 " id="main_cat">--}}
    {{--                                <label for="cat_id" class="mb-1 bold">الفئة الرئيسية</label>--}}
    {{--                                <select class="form-control" id="cat_id" name="cat_id">--}}
    {{--                                    <option value="">اختر الفئة الرئيسية</option>--}}
    {{--                                    @foreach($cats as $item)--}}
    {{--                                        <option value="{{$item->id}}">{{$item->title}}</option>--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-6 " id="sub_cat_id_div" disabled="">--}}
    {{--                                <label for="sub_cat_id" class="mb-1 bold">الفئة الفرعية</label>--}}
    {{--                                <select class="form-control" id="sub_cat_id" name="sub_cat_id" disabled="">--}}
    {{--                                    <option value="">اختر الفئة الفرعية</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row " id="pricing">--}}
    {{--                            <div class="form-group col-md-4 col-6 col-sm-6" id="from_div">--}}
    {{--                                <label for="from_" class="mb-2 bold">أقل سعر--}}
    {{--                                    <span class="text-muted">ج.م </span>--}}
    {{--                                </label>--}}
    {{--                                <input type="number" class="form-control" id="from_" name="from_"--}}
    {{--                                       value="" placeholder="أقل سعر ج.م">--}}

    {{--                            </div>--}}
    {{--                            <div class="form-group col-md-4 col-6 col-sm-6" id="to_div">--}}
    {{--                                <label for="to_" class="mb-2 bold">أعلي سعر--}}
    {{--                                    <span class="text-muted">ج.م </span>--}}
    {{--                                </label>--}}
    {{--                                <input type="number" class="form-control" id="to_" name="to_"--}}
    {{--                                       value="" placeholder="أعلي سعر ج.م">--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group col-md-4 col-12 col-sm-12" id="sort_div">--}}
    {{--                                <label for="sort_by" class="mb-2 bold">رتب حسب</label>--}}
    {{--                                <select class="form-control" id="sort_by" name="sort_by">--}}
    {{--                                    <option value="cr_desc">من الأحدث إلي الأقدم</option>--}}
    {{--                                    <option value="cr_asc">من الأقدم إلي الأحدث</option>--}}
    {{--                                    <option value="pr_asc">من الأقل سعر إلي الأعلي سعر</option>--}}
    {{--                                    <option value="pr_desc">من الأعلي سعر إلي الأقل سعر</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-12 col-12 col-sm-12">--}}
    {{--                                <div class="col-md-3 adv_opt_btn_div">--}}
    {{--                                    <a href="javascript:void(0);" class="bold blue l_17" id="adv_opt_btn">بحث متقدم--}}
    {{--                                        >></a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row text-center" id="adv_opts">--}}

    {{--                        </div>--}}


    {{--                    </div>--}}
    {{--                    <div class="col-md-9 col-sm-12 col-11 m-auto ">--}}
    {{--                        <div class="row" style="text-align: right">--}}
    {{--                            <div class="col-md-12 text-center" style="margin-bottom: -36px">--}}
    {{--                                <div class="col-md-4 m-auto col-12 col-sm-12">--}}
    {{--                                    <button class="btn search_btn" id="search_btn">عرض نتائج البحث</button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </form>--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    End Search Section--}}




    {{--    Start Featured Cats--}}
    <section class="featured-section special_cats mt-5 text-center">
        <div class="container">
            <div class="cats_section bordered row">
                @if(isset($featured_cats) && $featured_cats->count() > 0)
                    <div class="col-md-12 col-12 col-sm-12 m-t-26 special_cats_h">
                        <h3 class="bold">الفئات المميزة</h3>
                    </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-12 m-auto">


                <div class="owl-carousel owl-theme" id="featured_categories_carousel" dir="ltr">
                    @for($i=0; $i<3; $i++)


                    @foreach($featured_cats as $item)

                        <div class="m-auto cat_div" style=""
                             data-bs-target="1">
                            <a href="{{$item->parent_id == null ? route('mainCat.show', $item->slug) : route('cat.show', $item->slug)}}"
                               class="cat_link">
                                <div class="cat_img ">
                                    <img src="{{asset($item->image)}}" alt="cat_alt">
                                </div>
                                <div class="cat_title">
                                    <h5 class="bold">{{$item->title}}</h5>
                                </div>
                                <div class="cat_arrow">
                                    <div class="i_bg">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                    @endfor
                </div>
                </div>

                @endif


            </div>
        </div>
    </section>
    {{--    End Featured Cats--}}

    @if(isset($paid_client_ads) && $paid_client_ads->count() > 0 || isset($free_client_ads) && $free_client_ads->count() > 0 )
        {{--    Start Ads--}}
        <section class="client_ads_section mt-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h3 class="bold">إعلانات جديدة</h3>
                    </div>
                </div>
                <div class="row client_ads_div">
                    <div class="col-md-12 m-auto">
                        <div class="row" id="client_ads_cont">
                            @foreach($paid_client_ads as $key => $item)
                                <div class="col-md-3 col-6 col-sm-6 post  my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3"
                                         style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="mark_div">
                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        @if(backpack_auth()->check())
                                            <div class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}} not_hovered_wish" data-target="{{$item->id}} ">
                                                <a href="javascript:void(0)" class="wish-btn"
                                                   data-bs-target="{{$item->slug}}">
                                                    <img
                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                        alt="wish-icon">
                                                    <span class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="wish_div not_hovered_wish" data-target="{{$item->id}} ">
                                                <a href="{{url('login')}}">
                                                    <img src="{{asset('assets/front/images/heart.png')}}"
                                                         alt="wish-icon">
                                                    <span>أضف لقائمة الرغبات</span>

                                                </a>
                                            </div>
                                        @endif

                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('organized/'. $item->cover)}}"
                                                     alt="{{$item->slug}}">
                                            </div>
                                            <div class="location_card text-muted pt-2">
                                                <i class="fa fa-location-dot l_13" style="margin-left: 3px"></i>
                                                <small>{{$item->country->name}},</small>
                                                <small>{{$item->city->name}}</small>
                                                {{--                                            - <small>{{$item->state->name}}</small>--}}
                                            </div>

                                            <div class="titles bold">
                                                <h5 class="card-title mb-3 bold">{{$item->title}}</h5>
                                                <span style="font-weight: normal">السعر: </span>
                                                <span class="card-title  bold price colored">{{number_format($item->price, 0)}}</span>
                                                <span> ج.م</span>
                                            </div>
                                        </a>

                                        <div class="footer_card">
                                            <div class="text-muted position-relative">
                                                <small>عدد المشاهدات : {{$item->viewNum->count()}}</small>
                                                <small class="date_client_ad">
                                                    <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                                       style="margin-left: 3px"></i>
                                                    <span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                                </small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            @foreach($free_client_ads as $key => $item)
                                <div class="col-md-3 col-6 col-sm-6 post my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        @if(backpack_auth()->check())
                                            <div class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}} not_hovered_wish" data-target="{{$item->id}} ">
                                                <a href="javascript:void(0)" class="wish-btn"
                                                   data-bs-target="{{$item->slug}}">
                                                    <img
                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                        alt="wish-icon">
                                                    <span class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="wish_div not_hovered_wish" data-target="{{$item->id}} ">
                                                <a href="{{url('login')}}">
                                                    <img src="{{asset('assets/front/images/heart.png')}}"
                                                         alt="wish-icon">
                                                    <span>أضف لقائمة الرغبات</span>

                                                </a>
                                            </div>
                                        @endif
                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('organized/'. $item->cover)}}"
                                                     alt="{{$item->slug}}">
                                            </div>
                                            <div class="location_card text-muted pt-2">
                                                <i class="fa fa-location-dot l_13" style="margin-left: 3px"></i>
                                                <small>{{$item->country->name}},</small>
                                                <small>{{$item->city->name}}</small>
                                                {{--                                            - <small>{{$item->state->name}}</small>--}}
                                            </div>
                                            <div class="titles bold">
                                                <h5 class="card-title mb-3 bold">{{$item->title}}</h5>
                                                <span style="font-weight: normal">السعر: </span>
                                                <span class="card-title  bold price colored">{{number_format($item->price, 0)}}</span>
                                                <span> ج.م</span>
                                            </div>
                                        </a>

                                        <div class="footer_card">
                                            <div class="text-muted position-relative">
                                                <small>عدد المشاهدات : {{$item->viewNum->count()}}</small>
                                                <small class="date_client_ad">
                                                    <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                                       style="margin-left: 3px"></i>
                                                    <span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 col-12 col-sm-12 m-auto">
                                <button class="btn" id="see_more">اظهر المزيد</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--    End Ads--}}
    @endif



    {{--Start Counter Section--}}
    <div class="page-wrapper counter_section m-t-46" dir="ltr">
        <section class="funfact-one jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 50%">
            <img src="{{asset('assets/front/images/bg-fun.webp')}}"
                 class="jarallax-img" alt="counter_background">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="0ms"
                         style="text-align: left">
                        <div class="funfact-one__single funfact-one__single_1">
                            <h3 class="odometer counter_span" data-count="500">00</h3>
                            <p>عدد العملاء</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="100ms"
                         style="text-align: center">
                        <div class="funfact-one__single funfact-one__single_2">
                            <h3 class="odometer counter_span" data-count="24">00</h3>
                            <p>عدد ساعات العمل</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="200ms"
                         style="text-align: center">
                        <div class="funfact-one__single funfact-one__single_3">
                            <h3 class="odometer counter_span" data-count="200">00</h3>
                            <p>عدد الموظفين</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="300ms"
                         style="text-align: right">
                        <div class="funfact-one__single funfact-one__single_4">
                            <h3 class="odometer counter_span" data-count="3000">00</h3>
                            <p>مدي رضاء عملاؤنا</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--End Counter Section--}}






    {{--Start Posts Section--}}
    @if(isset($posts) && $posts->count() > 0)
        <section class="blog_section container my-5" style="">
            <div class="headline_div mb-3">
                <h3 class="bold mb-4 ts-0">آخر الأخبار</h3>
            </div>
            <div class="news_paper">
                @foreach($posts as $key => $item)
                    <div class="card">
                        <a href="{{route('articles.show', $item->slug)}}">
                            <div class="card__header">
                                @php
                                    $images =explode(',',$item->image);
                                    //dd($seo_image);
                                        //dd($photo);
                                @endphp
                                <img src="{{asset($images[0])}}" alt="{{$item->title}}" class="card__image"
                                     width="100%">
                            </div>
                            <div class="card__body blog_card_body">
                                <span class="tag tag-blue">{{$item->category->title}}</span>
                                <h4 class="bold">{{$item->title}}</h4>
                                <p>{{$item->summary}}</p>
                            </div>
                            <div class="card__footer" dir="{{General::getDir()}}">
                                <div class="user">
                                    <img src="{{asset('assets/front/images/avatar.png')}}" alt="publisher-image"
                                         class="user__image">
                                    <div class="user__info">
                                        <h5 class="bold">أ/ بديع</h5>
                                        <small>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    {{--End Posts Section--}}






    {{--    Start Banners--}}
    {{--    @if(isset($banners) && $banners->count() > 0)--}}
    {{--        <section class="banners-section container" dir="ltr">--}}
    {{--            <div class="owl-carousel owl-theme" id="banners_section">--}}
    {{--                @foreach($banners as $item)--}}
    {{--                    <div class="item banner_item">--}}
    {{--                        <img src="{{asset($item->image)}}" alt="{{asset($item->image_alt)}}" width="100%">--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--    @endif--}}
    {{--    End Banners--}}




    <input type="hidden" name="" value="" id="sub_cat_id_inp">
    <input type="hidden" name="" value="0" id="adv_status">



@endsection




@section('script')
    <script>


        $(window).scroll(function () {
            if ($(document).scrollTop() > 40) {
                $('nav.lower-nav').css({
                    'transition': '300ms',
                    'height': '82px',
                    'background': 'rgb(242 247 255)',
                });
            } else {
                $('nav.lower-nav').css({
                    'transition': '300ms',
                    'height': '100px',
                    'background': ' #ffffffa6'
                });
            }
        });

        $(document).ready(function () {


            /* Start New js */

            const lang = $('#lang').val();


            let new_main_cat_id = $('#new_main_cat_id');
            let new_sub_cat_id = $('#new_sub_cat_id');
            new_main_cat_id.select2();
            new_sub_cat_id.select2();

            new_main_cat_id.change(function () {
                let main_cat_id = $(this).val();
                if (main_cat_id !== "") {
                    $.ajax({
                        url: "/get-child-cat/" + main_cat_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: main_cat_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data);
                            new_sub_cat_id.removeAttr('disabled');
                            new_sub_cat_id.find('option').remove();
                            if (response.status === 1) {
                                let data = response.data;
                                console.log(data);
                                let html_option = '';
                                let new_data = [];

                                $.each(data, function (i, item) {
                                    new_data[i] = {
                                        id: item.id,
                                        text: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        html: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        title: item.title[lang]
                                    };
                                });
                                console.log(new_data);
                                new_sub_cat_id.select2({
                                    data: new_data,
                                    escapeMarkup: function (markup) {
                                        return markup;
                                    },
                                    templateResult: function (data) {
                                        return data.html;
                                    },
                                    templateSelection: function (data) {
                                        return data.text;
                                    }
                                });
                            }
                        }
                    });
                } else {
                }
            });

            let get_result_btn = $('#get_result_btn');

            get_result_btn.on('click', function (e) {

                let new_main_cat_id = $('#new_main_cat_id');
                let new_sub_cat_id = $('#new_sub_cat_id');
                let new_from_ = $('#new_from_');
                let new_to_ = $('#new_to_');
                let new_sort_by = $('#new_sort_by');

                if (new_main_cat_id.length && new_main_cat_id.val() === '' ||
                    new_sub_cat_id.length && new_sub_cat_id.val() === '' ||
                    new_from_.length && new_from_.val() === '' ||
                    new_to_.length && new_to_.val() === '' ||
                    new_sort_by.length && new_sort_by.val() === ''
                ) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        text: "برجاء ملء البيانات الخاصة بالبحث",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {
                    return true;
                }

            });


            let new_main_cat_id_mob = $('#new_main_cat_id_mob');
            let new_sub_cat_id_mob = $('#new_sub_cat_id_mob');

            new_main_cat_id_mob.select2({
                dropdownParent: $("#search_model")
            });
            new_sub_cat_id_mob.select2({
                dropdownParent: $("#search_model")
            });


            new_main_cat_id_mob.change(function () {
                let main_cat_id_mob = $(this).val();
                if (main_cat_id_mob !== "") {
                    $.ajax({
                        url: "/get-child-cat/" + main_cat_id_mob,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: main_cat_id_mob,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data);
                            new_sub_cat_id_mob.removeAttr('disabled');
                            new_sub_cat_id_mob.find('option').remove();
                            if (response.status === 1) {
                                let data = response.data;
                                console.log(data);
                                let html_option = '';
                                let new_data = [];

                                $.each(data, function (i, item) {
                                    new_data[i] = {
                                        id: item.id,
                                        text: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        html: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        title: item.title[lang]
                                    };
                                });
                                console.log(new_data);
                                new_sub_cat_id_mob.select2({
                                    data: new_data,

                                    dropdownParent: $("#search_model"),

                                    escapeMarkup: function (markup) {
                                        return markup;
                                    },
                                    templateResult: function (data) {
                                        return data.html;
                                    },
                                    templateSelection: function (data) {
                                        return data.text;
                                    }
                                });
                            }
                        }
                    });
                } else {
                }
            });

            let get_result_btn_mob = $('#get_result_btn_mob');

            get_result_btn_mob.on('click', function (e) {

                let new_main_cat_id_mob = $('#new_main_cat_id_mob');
                let new_sub_cat_id_mob = $('#new_sub_cat_id_mob');
                let new_from__mob = $('#new_from__mob');
                let new_to__mob = $('#new_to__mob');
                let new_sort_by_mob = $('#new_sort_by_mob');

                if (new_main_cat_id_mob.length && new_main_cat_id_mob.val() === '' ||
                    new_sub_cat_id_mob.length && new_sub_cat_id_mob.val() === '' ||
                    new_from__mob.length && new_from__mob.val() === '' ||
                    new_to__mob.length && new_to__mob.val() === '' ||
                    new_sort_by_mob.length && new_sort_by_mob.val() === ''
                ) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        text: "برجاء ملء البيانات الخاصة بالبحث",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {
                    return true;
                }

            });



            let client_ad_post = $('section.client_ads_section .card');

            let maxHeight = Math.max.apply(null, client_ad_post.map(function () {
                return $(this).height();
            }).get());

            // alert(maxHeight);
            client_ad_post.height(maxHeight);

            /* End New Js */


            /* Start Card For post_ad */
            // let client_ad_img = $('.client_ad_cover img');
            // let client_ad_cover_div = $('.client_ad_cover');
            // // alert(client_ad_cover_div.width());
            // let the_width = client_ad_cover_div.width();
            // client_ad_cover_div.css('height', the_width);
            // client_ad_img.css('height', the_width);
            /* End Card For post_ad */

            /* Start Search Method */

            /* End Search Method */


            // let client_ads_cont = $('#client_ads_cont');
            // let width_c = client_ads_cont.width();
            // let post = $('.post');
            // let count = post.length;
            // let height_ = post.height() + 16;
            // let width_ = post.width();
            // let count_in_row = Math.floor(width_c / width_);
            // client_ads_cont.height((12 / count_in_row * height_));
            //
            //
            // let see_more = $('#see_more');
            // see_more.on('click', function () {
            //     let visible_posts_count = client_ads_cont.height() / height_;
            //     let hidden_posts_count = Math.floor(Math.ceil(count / count_in_row) - visible_posts_count);
            //     // alert(12/count_in_row);
            //     // alert(Math.ceil(count/count_in_row));
            //     // alert(hidden_posts_count);
            //     if (hidden_posts_count > 3) {
            //         // alert('test');
            //         client_ads_cont.height(client_ads_cont.height() + (height_ * 3));
            //     } else if (hidden_posts_count === 3) {
            //         // alert('not');
            //         client_ads_cont.height(client_ads_cont.height() + (height_ * 3));
            //         see_more.remove();
            //     } else if (hidden_posts_count === 2) {
            //         client_ads_cont.height(client_ads_cont.height() + (height_ * 2));
            //         see_more.remove();
            //     } else {
            //         client_ads_cont.height(client_ads_cont.height() + (height_ * 1));
            //         see_more.remove();
            //     }
            // });
            //
            // $("#adv_opt_btn").click(function () {
            //     // alert('test')
            //     let val = $('#sub_cat_id').val();
            //     if (val === '') {
            //         Swal.fire({
            //             icon: 'error',
            //             text: "من فضلك اختر الفئة الفرعية لتفعيل البحث المتقدم",
            //             dangerMode: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'حسنا',
            //             showCloseButton: true,
            //         });
            //     } else {
            //         let adv_val = $('input#adv_status');
            //         if ($(window).width() > 720) {
            //             if (adv_val.val() === '0') {
            //                 adv_val.val('1');
            //                 $(".search_btn").css('margin-top', '-60px');
            //                 $(".special_cats").css({
            //                     'margin-top': '58px',
            //                     'transition': '600ms',
            //
            //                 });
            //
            //             } else {
            //                 adv_val.val('0');
            //                 $(".search_btn").css({
            //                     'margin-top': '-18px',
            //                     'transition': '600ms'
            //                 });
            //                 $(".special_cats").css('margin-top', '0');
            //             }
            //         } else {
            //             if (adv_val.val() === '0') {
            //                 adv_val.val('1');
            //                 $(".search_btn").css('margin-top', '-60px');
            //                 $(".special_cats").css({
            //                     'margin-top': '58px',
            //                     'transition': '600ms',
            //
            //                 });
            //
            //             } else {
            //                 adv_val.val('0');
            //                 $(".search_btn").css('margin-top', '0');
            //                 $(".special_cats").css('margin-top', '0');
            //             }
            //         }
            //
            //
            //         $('#pricing').css('margin-bottom', 0);
            //         $("#adv_opts").slideToggle(500);
            //     }
            // });

            {{--let search_btn = $('#search_btn');--}}
            {{--search_btn.on('click', function (e) {--}}
            {{--    e.preventDefault();--}}

            {{--    let country = $('#country');--}}
            {{--    let city = $('#city_id');--}}
            {{--    let state = $('#state_id');--}}
            {{--    let cat_id = $('#cat_id');--}}
            {{--    let sub_cat_id = $('#sub_cat_id');--}}
            {{--    let from_ = $('#from_');--}}
            {{--    let to_ = $('#to_');--}}
            {{--    let sort_by = $('#sort_by');--}}


            {{--    let adv_st = $('input#adv_status').val();--}}

            {{--    console.log(adv_st);--}}


            {{--    if (adv_st === '1') {--}}
            {{--        let atts_div = $('#atts_div .attr_single');--}}
            {{--        let attr_vals = [];--}}
            {{--        let attr_url = "";--}}

            {{--        // alert(atts_div.length);--}}
            {{--        for (let i = 0; i < atts_div.length; i++) {--}}
            {{--            let single_attr = $('#attr_single_' + i);--}}
            {{--            let single_attr_select = single_attr.find('.inp_select');--}}
            {{--            let single_attr_check = single_attr.find('.inp_check');--}}

            {{--            if (single_attr_select.length > 0 && single_attr_select.val() !== "" && single_attr_select.val() !== null) {--}}

            {{--                attr_vals[single_attr_select.attr('name')] = single_attr_select.val();--}}
            {{--                attr_url += "&attrs[" + single_attr_select.attr('data-target') + '-' + single_attr_select.val() + "]=1";--}}


            {{--            } else if (single_attr_check.length > 0) {--}}
            {{--                // alert('test');--}}
            {{--                attr_vals[single_attr_check.attr('name')] = single_attr_check.val();--}}
            {{--                attr_url += "&attrs[" + single_attr_check.attr('data-target') + '-' + single_attr_check.val() + "]=1";--}}
            {{--            }--}}
            {{--        }--}}
            {{--        if (country.val() === null || country.val() === "") {--}}
            {{--            Swal.fire({--}}
            {{--                icon: 'error',--}}
            {{--                text: "اختر المحافظة ",--}}
            {{--                dangerMode: true,--}}
            {{--                confirmButtonColor: '#3085d6',--}}
            {{--                cancelButtonColor: '#d33',--}}
            {{--                confirmButtonText: 'حسنا',--}}
            {{--                showCloseButton: true,--}}
            {{--            });--}}
            {{--        } else {--}}
            {{--            if (cat_id.val() === "") {--}}
            {{--                Swal.fire({--}}
            {{--                    icon: 'error',--}}
            {{--                    text: "اختر الفئة الرئيسية ",--}}
            {{--                    dangerMode: true,--}}
            {{--                    confirmButtonColor: '#3085d6',--}}
            {{--                    cancelButtonColor: '#d33',--}}
            {{--                    confirmButtonText: 'حسنا',--}}
            {{--                    showCloseButton: true,--}}
            {{--                });--}}
            {{--            } else {--}}
            {{--                if (sub_cat_id.val() === "") {--}}
            {{--                    Swal.fire({--}}
            {{--                        icon: 'error',--}}
            {{--                        text: "اختر الفئة الفرعية ",--}}
            {{--                        dangerMode: true,--}}
            {{--                        confirmButtonColor: '#3085d6',--}}
            {{--                        cancelButtonColor: '#d33',--}}
            {{--                        confirmButtonText: 'حسنا',--}}
            {{--                        showCloseButton: true,--}}
            {{--                    });--}}
            {{--                } else {--}}
            {{--                    $('.lds-circle').addClass('active');--}}
            {{--                    $('.overlay').addClass('active');--}}

            {{--                    window.location.href = "{{route('search.results')}}" + "?country=" + country.val() + "&city=" + city.val() + "&state=" + state.val() + "&cat=" + cat_id.val() + "&subcat=" + sub_cat_id.val() + "&from=" + from_.val() + "&to=" + to_.val() + "&sort=" + sort_by.val() + "&adv=1" + attr_url;--}}

            {{--                }--}}
            {{--            }--}}
            {{--        }--}}

            {{--        --}}{{--console.log('{{route('search.results')}}' + '?cat=' + cat_id.val() + '&subcat=' + sub_cat_id.val() + '&from=' + from_.val() + '&to=' + to_.val() + '&sort=' + sort_by.val() + '&adv=1' + attr_url);--}}
            {{--        --}}{{--                    window.location.href = "{{route('search.results')}}" + "?country=" +  country.val() +  "&city=" +  city.val() + "&state=" +  state.val() + "&cat=" + cat_id.val() + "&subcat=" + sub_cat_id.val() + "&from=" + from_.val() + "&to=" + to_.val() + "&sort=" + sort_by.val() + "&adv=1" + attr_url;--}}
            {{--    } else {--}}
            {{--        // alert('test')--}}
            {{--        if (country.val() === null || country.val() === "") {--}}
            {{--            Swal.fire({--}}
            {{--                icon: 'error',--}}
            {{--                text: "اختر المحافظة ",--}}
            {{--                dangerMode: true,--}}
            {{--                confirmButtonColor: '#3085d6',--}}
            {{--                cancelButtonColor: '#d33',--}}
            {{--                confirmButtonText: 'حسنا',--}}
            {{--                showCloseButton: true,--}}
            {{--            });--}}
            {{--        } else {--}}
            {{--            if (cat_id.val() === "") {--}}
            {{--                Swal.fire({--}}
            {{--                    icon: 'error',--}}
            {{--                    text: "اختر الفئة الرئيسية ",--}}
            {{--                    dangerMode: true,--}}
            {{--                    confirmButtonColor: '#3085d6',--}}
            {{--                    cancelButtonColor: '#d33',--}}
            {{--                    confirmButtonText: 'حسنا',--}}
            {{--                    showCloseButton: true,--}}
            {{--                });--}}
            {{--            } else {--}}
            {{--                if (sub_cat_id.val() === "") {--}}
            {{--                    Swal.fire({--}}
            {{--                        icon: 'error',--}}
            {{--                        text: "اختر الفئة الفرعية ",--}}
            {{--                        dangerMode: true,--}}
            {{--                        confirmButtonColor: '#3085d6',--}}
            {{--                        cancelButtonColor: '#d33',--}}
            {{--                        confirmButtonText: 'حسنا',--}}
            {{--                        showCloseButton: true,--}}
            {{--                    });--}}
            {{--                } else {--}}
            {{--                    $('.lds-circle').addClass('active');--}}
            {{--                    $('.overlay').addClass('active');--}}

            {{--                    window.location.href = "{{route('search.results')}}" + "?country=" + country.val() + "&city=" + city.val() + "&state=" + state.val() + "&cat=" + cat_id.val() + "&subcat=" + sub_cat_id.val() + "&from=" + from_.val() + "&to=" + to_.val() + "&sort=" + sort_by.val() + "&adv=0";--}}
            {{--                }--}}
            {{--            }--}}
            {{--        }--}}

            {{--        --}}{{--console.log('{{route('search.results')}}' + '?cat=' + cat_id.val() + '&subcat=' + sub_cat_id.val() + '&from=' + from_.val() + '&to=' + to_.val() + '&sort=' + sort_by.val() + '&adv=0');--}}
            {{--    }--}}

            {{--});--}}


            $('#country').select2();
            $('#cat_id').select2();


                {{--let cat = $('select#cat_id');--}}
                {{--let cats_row = $('#cats_row');--}}
                {{--cat.change(function () {--}}
                {{--    let cat_id = cat.val();--}}
                {{--    // alert(cat_id);--}}

                {{--    if (cat_id !== "") {--}}
                {{--        $("#adv_opts").slideUp(500);--}}
                {{--        $('#atts_div').remove();--}}
                {{--        $('#sub_cat_id_div').remove();--}}

                {{--        $.ajax({--}}
                {{--            url: "/get-child-cat/" + cat_id,--}}
                {{--            data: {--}}
                {{--                _token: "{{csrf_token()}}",--}}
                {{--                id: cat_id,--}}
                {{--            },--}}
                {{--            type: "POST",--}}
                {{--            success: function (response) {--}}
                {{--                if (typeof (response) != 'object') {--}}
                {{--                    response = $.parseJSON(response)--}}
                {{--                }--}}
                {{--                console.log(response.data);--}}
                {{--                let html_option = "";--}}
                {{--                let html_select = "<li data-value='' data-display=\"اختر الفئة الفرعية\" class=\"option \">اختر الفئة الفرعية</li>";--}}

                {{--                if (response.status === 1) {--}}
                {{--                    let data = response.data;--}}
                {{--                    data.forEach(myFunction);--}}

                {{--                    function myFunction(item, index) {--}}
                {{--                        html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['title'][lang] + "</option>";--}}
                {{--                        html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['title'][lang] + "</li>";--}}
                {{--                    }--}}

                {{--                    // console.log(data[0]);--}}
                {{--                    console.log(html_option);--}}

                {{--                    cats_row.append(--}}
                {{--                        "<div class=\"form-group col-md-6  m-auto  \" id='sub_cat_id_div'>\n" +--}}
                {{--                        " <label for=\"sub_cat_id\" class=\"mb-1 bold\">الفئة الفرعية</label>\n" +--}}
                {{--                        "    <select class=\"form-control select2-hidden-accessible\" id=\"sub_cat_id\" name=\"sub_cat_id\" data-select2-id=\"select2-data-sub_cat_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
                {{--                        " <option value=''>اختر الفئة الفرعية</option>" +--}}
                {{--                        html_option +--}}
                {{--                        " </select>" +--}}
                {{--                        " </div>"--}}
                {{--                    );--}}

                {{--                    $('#sub_cat_id').select2();--}}
                {{--                    $('#sub_cat_id_div').find('span.select2').css('width', '100%');--}}

                {{--                }--}}
                {{--                let sub_cat = $('#sub_cat_id');--}}
                {{--                sub_cat.on("select2:select", function () {--}}
                {{--                    let sub_cat_id = $(this).val();--}}
                {{--                    $("#adv_opts").slideUp(500);--}}
                {{--                    $('#atts_div').remove();--}}
                {{--                    $('#sub_cat_id_inp').val(sub_cat_id);--}}

                {{--                    $.ajax({--}}
                {{--                        url: "/get-cat-attrs/" + sub_cat_id,--}}
                {{--                        data: {--}}
                {{--                            _token: "{{csrf_token()}}",--}}
                {{--                            id: sub_cat_id,--}}
                {{--                        },--}}
                {{--                        type: "POST",--}}
                {{--                        success: function (response) {--}}
                {{--                            if (typeof (response) != 'object') {--}}
                {{--                                response = $.parseJSON(response)--}}
                {{--                            }--}}
                {{--                            // console.log(response.data['attributes'][0]['options']);--}}
                {{--                            let attrs = response.data['attributes'];--}}
                {{--                            // alert(attrs.length);--}}
                {{--                            let text_attr = '';--}}
                {{--                            let check_attr = '';--}}
                {{--                            let attr = '';--}}

                {{--                            for (let i = 0; i < attrs.length; i++) {--}}
                {{--                                if (attrs[i]['type'] === 'select') {--}}
                {{--                                    let opts = attrs[i]['options'];--}}
                {{--                                    let select_opts = '';--}}
                {{--                                    let select_opts_nice = '';--}}
                {{--                                    for (let x = 0; x < opts.length; x++) {--}}
                {{--                                        // console.log(opts[i]['val'][lang]);--}}
                {{--                                        select_opts += "<option value='" + opts[x]['id'] + "'>" + opts[x]['val'][lang] + "</option>";--}}
                {{--                                        select_opts_nice += "<li value='" + opts[x]['id'] + "' class=\"option\" data-value='" + opts[x]['id'] + "'  data-target='" + attrs[i]['id'] + "'>" + opts[x]['val'][lang] + "</li>";--}}
                {{--                                    }--}}

                {{--                                    attr +=--}}
                {{--                                        "<div class=\"form-group col-md-3 col-12 mt-3 mb-3 attr_single\" id=\"attr_single_" + i + "\">\n" +--}}
                {{--                                        // "  <label style=\"font-weight: bold\" for=\"attr_" + attrs[i]['id'] + "\" class=\"mb-2\"> " + attrs[i]['title'][lang] + "\n" +--}}
                {{--                                        // "  </label>\n" +--}}
                {{--                                        " <select class=\"inp_select\" data-target='" + attrs[i]['id'] + "' id=\"attr_" + i + "\" name=\"attr_" + attrs[i]['id'] + "\" required=\"\" style=\"display: none;\">\n" +--}}
                {{--                                        "  <option value=\"\">اختر " + attrs[i]['title'][lang] + "</option>\n" +--}}
                {{--                                        select_opts +--}}
                {{--                                        "  </select>\n" +--}}
                {{--                                        "  <div class=\"nice-select\" tabindex=\"0\"><span class=\"current\">اختر " + attrs[i]['title'][lang] + "</span>\n" +--}}
                {{--                                        "  <ul class=\"list attr_select_list\">\n" +--}}
                {{--                                        "  <li data-value=\"\" class=\"option selected focus \" data-target='attr_" + attrs[i]['id'] + "'>اختر " + attrs[i]['title'][lang] + "</li>\n" +--}}
                {{--                                        select_opts_nice +--}}
                {{--                                        "  </ul>\n" +--}}
                {{--                                        "</div>\n" +--}}
                {{--                                        "  </div>" +--}}
                {{--                                        "<input type=\"hidden\" id='input_select_last_" + attrs[i]['id'] + "' name=\"attr_" + attrs[i]['id'] + "\" value=\"\">";--}}

                {{--                                    // console.log(select_opts);--}}
                {{--                                } else {--}}
                {{--                                    attr +=--}}
                {{--                                        "<div class='pretty p-rotate p-svg p-curve col-md-3 col-sm-6 col-12 mt-3 mb-3 attr_single' style='text-align:right; padding-right:20px;' " +--}}
                {{--                                        "   id='attr_single_" + i + "'>" +--}}
                {{--                                        "   <input type='checkbox' id='attr_" + i + "' value='0' data-target='" + attrs[i]['id'] + "' name='attr_" + attrs[i]['id'] + "'" +--}}
                {{--                                        "  class='inp_check'>" +--}}
                {{--                                        "  <div class='state p-success'>" +--}}
                {{--                                        "   <!-- svg path -->" +--}}
                {{--                                        "    <svg class='svg svg-icon' viewBox='0 0 20 20'>" +--}}
                {{--                                        "   <path" +--}}
                {{--                                        "   d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'" +--}}
                {{--                                        "  style='stroke: white;fill:white;'></path>" +--}}
                {{--                                        "  </svg>" +--}}
                {{--                                        "  <label style='font-weight: bold'>" + attrs[i]['title'][lang] + "</label>" +--}}
                {{--                                        " </div>" +--}}
                {{--                                        "  </div>";--}}

                {{--                                }--}}

                {{--                            }--}}


                {{--                            $('#adv_opts').append(--}}
                {{--                                "<div class=\"row pt-3 m-auto\" id=\"atts_div\">" +--}}
                {{--                                attr +--}}
                {{--                                "</div>"--}}
                {{--                            );--}}

                {{--                            // $('.inp_select').niceSelect();--}}
                {{--                            // $('.attr_select').select2();--}}
                {{--                            // $('.attr_single_div span.select2').css('width', '100%');--}}
                {{--                            $('.attr_select_list li.option').on('click', function () {--}}

                {{--                                var target = $(this).data('target');--}}
                {{--                                var value = $(this).attr('value');--}}
                {{--                                $('#input_select_last_' + target).val(value)--}}
                {{--                                // alert(value);--}}


                {{--                                //model.niceSelect('destroy').niceSelect();--}}
                {{--                                // model.niceSelect('update');--}}
                {{--                            });--}}

                {{--                            // $('.select_attr').niceSelect();--}}

                {{--                            $('.inp_check').on('click', function () {--}}
                {{--                                // alert('test0');--}}
                {{--                                let check_val = $(this);--}}
                {{--                                if (check_val.val() === '0') {--}}
                {{--                                    check_val.val(1);--}}
                {{--                                } else {--}}
                {{--                                    check_val.val(0);--}}
                {{--                                }--}}
                {{--                            });--}}

                {{--                        }--}}
                {{--                    });--}}


                {{--                });--}}
                {{--            }--}}

                {{--        });--}}
                {{--    } else {--}}
                {{--        $('#sub_cat_id').val('all').trigger('change');--}}
                {{--        $('#sub_cat_id').prop('disabled', true);--}}
                {{--        // $('#sub_cat_id_div').attr('disabled', true);--}}
                {{--        // $('#sub_cat_id_div').find('.nice-select').addClass('disabled');--}}
                {{--    }--}}
                {{--});--}}


                {{--let country = $('select#country');--}}
                {{--let country_row = $('#country_row');--}}
                {{--country.on("select2:select", function (e) {--}}
                {{--    let country_id = $(this).val();--}}
                {{--    // alert(country_id);--}}
                {{--    if (country_id !== "") {--}}
                {{--        $('#city_id_div').remove();--}}
                {{--        $('#state_id').prop('disabled', true);--}}
                {{--        $('#state_id').val("all").change();--}}
                {{--        // $("div.id_100 select").val("val2").change();--}}

                {{--        $.ajax({--}}
                {{--            url: "/get-child-city/" + country_id,--}}
                {{--            data: {--}}
                {{--                _token: "{{csrf_token()}}",--}}
                {{--                id: country_id,--}}
                {{--            },--}}
                {{--            type: "POST",--}}
                {{--            success: function (response) {--}}
                {{--                if (typeof (response) != 'object') {--}}
                {{--                    response = $.parseJSON(response)--}}
                {{--                }--}}
                {{--                console.log(response.data);--}}
                {{--                let html_option = "";--}}
                {{--                let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";--}}

                {{--                if (response.status === 1) {--}}
                {{--                    let data = response.data;--}}
                {{--                    data.forEach(myFunction);--}}

                {{--                    function myFunction(item, index) {--}}
                {{--                        html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";--}}
                {{--                        html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";--}}
                {{--                    }--}}

                {{--                    // console.log(data[0]);--}}
                {{--                    console.log(html_option);--}}

                {{--                    // country_row.append(--}}
                {{--                    //     "<div class=\"form-group col-md-4 \" id='city_id_div'>\n" +--}}
                {{--                    //     " <label for=\"city_id\" class=\"mb-2 bold\">المدينة</label>\n" +--}}
                {{--                    //     " <select class=\"form-control select2-hidden-accessible\" id=\"city_id\" name=\"city_id\" data-select2-id=\"select2-data-city_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
                {{--                    //     " <option value='all'>الكل</option>" +--}}
                {{--                    //     html_option +--}}
                {{--                    //     " </select>" +--}}
                {{--                    //     " </div>"--}}
                {{--                    // );--}}

                {{--                    $("<div class=\"form-group col-md-4 \" id='city_id_div'>\n" +--}}
                {{--                        " <label for=\"city_id\" class=\"mb-1 bold\">المدينة</label>\n" +--}}
                {{--                        " <select class=\"form-control select2-hidden-accessible\" id=\"city_id\" name=\"city_id\" data-select2-id=\"select2-data-city_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
                {{--                        " <option value='all'>الكل</option>" +--}}
                {{--                        html_option +--}}
                {{--                        " </select>" +--}}
                {{--                        " </div>").insertAfter('#country_div');--}}

                {{--                    $('#city_id').select2();--}}
                {{--                    $('#city_id_div').find('span.select2').css('width', '100%');--}}

                {{--                    let city_id = $('select#city_id');--}}
                {{--                    city_id.on("select2:select", function (e) {--}}
                {{--                        let city_id = $(this).val();--}}
                {{--                        // alert(city_id);--}}
                {{--                        if (city_id !== "all") {--}}
                {{--                            $('#state_id_div').remove();--}}
                {{--                            $.ajax({--}}
                {{--                                url: "/get-child-state/" + city_id,--}}
                {{--                                data: {--}}
                {{--                                    _token: "{{csrf_token()}}",--}}
                {{--                                    id: city_id,--}}
                {{--                                },--}}
                {{--                                type: "POST",--}}
                {{--                                success: function (response) {--}}
                {{--                                    if (typeof (response) != 'object') {--}}
                {{--                                        response = $.parseJSON(response)--}}
                {{--                                    }--}}
                {{--                                    console.log(response.data);--}}
                {{--                                    let html_option = "";--}}
                {{--                                    let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";--}}

                {{--                                    if (response.status === 1) {--}}
                {{--                                        let data = response.data;--}}
                {{--                                        data.forEach(myFunction);--}}

                {{--                                        function myFunction(item, index) {--}}
                {{--                                            html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";--}}
                {{--                                            html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";--}}
                {{--                                        }--}}

                {{--                                        // console.log(data[0]);--}}
                {{--                                        console.log(html_option);--}}

                {{--                                        country_row.append(--}}
                {{--                                            "<div class=\"form-group col-md-4 \" id='state_id_div'>\n" +--}}
                {{--                                            " <label for=\"state_id\" class=\"mb-1 bold\">الحي / المركز</label>\n" +--}}
                {{--                                            " <select class=\"form-control select2-hidden-accessible\" id=\"state_id\" name=\"state_id\" data-select2-id=\"select2-data-state_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
                {{--                                            " <option value='all'>الكل</option>" +--}}
                {{--                                            html_option +--}}
                {{--                                            " </select>" +--}}
                {{--                                            " </div>"--}}
                {{--                                        );--}}
                {{--                                        $('#state_id').select2();--}}
                {{--                                        $('#state_id_div').find('span.select2').css('width', '100%');--}}
                {{--                                    }--}}
                {{--                                }--}}
                {{--                            });--}}
                {{--                        } else {--}}
                {{--                            $('#state_id').prop('disabled', true);--}}
                {{--                            $('#state_id').val('all').trigger('change');--}}

                {{--                        }--}}

                {{--                    });--}}

                {{--                } else {--}}

                {{--                }--}}
                {{--            }--}}
                {{--        });--}}


                {{--    } else {--}}

                {{--        $('#state_id').val('all').trigger('change');--}}
                {{--        $('#city_id').val('all').trigger('change');--}}
                {{--        $('#city_id').prop('disabled', true);--}}
                {{--        $('#state_id').prop('disabled', true);--}}

                {{--    }--}}

                {{--});--}}


            let card = $('.post');
            if ($(window).width() > 720) {

                // card.hover(function () {
                //     let wish_div = $(this).find('.wish_div').css('display', 'block');
                // }, function () {
                //     let wish_div = $(this).find('.wish_div').css('display', 'none');
                // });
            }


        });
    </script>
@stop

