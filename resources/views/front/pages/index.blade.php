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
                <div class="item banner_item" style="width: 100%">
                    <img src="{{asset($item->image)}}" alt="{{asset($item->image_alt)}}" width="100%">
                </div>
            @endforeach
        </div>

{{--        Model--}}




        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-3 col-3 new_search_box"
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
                                   value="" placeholder="أقل سعر ج.م" >
                        </div>
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="new_to_div">
                            <input type="number" class="form-control" id="new_to_" name="new_to_"
                                   value="" placeholder="أعلي سعر ج.م" >
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
                        <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1" id="get_adv_result_btn_div">
                            <a class="btn w-100 new_adv_search" href="javascript:void(0);" id="new_adv_search"><i
                                    class="fa-solid fa-gears"></i> &nbsp;بحث متقدم</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>





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
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
                        <div class="row" id="client_ads_cont">
                            @foreach($paid_client_ads as $key => $item)
                                <div class="col-lg-3 col-md-4 col-6 col-sm-6 post  my-2">
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
                                                <small><span class="mobile_hide">عدد</span> المشاهدات : {{$item->viewNum->count()}}</small>
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
                                <div class="col-lg-3 col-md-4 col-6 col-sm-6 post my-2">
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
                                                <small><span class="mobile_hide">عدد</span> المشاهدات : {{$item->viewNum->count()}}</small>
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
                                <a href="{{route('getAllAds')}}" class="btn" id="see_more">رؤية الكل</a>
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
        <section class="blog_section container py-5" style="">
            <div class="headline_div mb-3">
                <h3 class="bold mb-4 ts-0">آخر الأخبار</h3>
            </div>
            <div class="news_paper row">
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



            let new_adv_search = $('#new_adv_search');
            new_adv_search.on('click', function () {
                let new_main_cat_id = $('#new_main_cat_id');
                let new_sub_cat_id = $('#new_sub_cat_id');
                let new_from_ = $('#new_from_');
                let new_to_ = $('#new_to_');
                let new_sort_by = $('#new_sort_by');

                if (new_main_cat_id.length && new_main_cat_id.val() === '' ||
                    new_sub_cat_id.length && new_sub_cat_id.val() === '' ||
                    // new_from_.length && new_from_.val() === '' ||
                    // new_to_.length && new_to_.val() === '' ||
                    new_sort_by.length && new_sort_by.val() === ''
                ) {
                    // e.preventDefault();
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
                    window.location.href = "{{url('get-adv-search-results/')}}"+
                        "?new_main_cat_id=" + new_main_cat_id.val() +
                        '&new_sub_cat_id=' + new_sub_cat_id.val() +
                        '&new_sort_by=' + new_sort_by.val() +
                        '&new_from_=' + new_from_.val() +
                        '&new_to_=' + new_to_.val();
                }

            });


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
                    // new_from_.length && new_from_.val() === '' ||
                    // new_to_.length && new_to_.val() === '' ||
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
                    // new_from__mob.length && new_from__mob.val() === '' ||
                    // new_to__mob.length && new_to__mob.val() === '' ||
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





            $('#country').select2();
            $('#cat_id').select2();




            let card = $('.post');
            if ($(window).width() > 720) {

            }


        });
    </script>
@stop

