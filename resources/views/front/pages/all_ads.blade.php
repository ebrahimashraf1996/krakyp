@extends('front.layouts.master')

@section('styles')
    <style>
        .nice-select {
            line-height: 28px !important;
        }
        main {    background-size: 100% !important;
            background-repeat: repeat!important;}
        #adv_opts_cont .nice-select {
            width: 100%;
        }


        /*.pretty .state label:after, .pretty .state label:before {right: 0}*/
        /*.pretty.p-svg .state .svg {right: 0}*/
        .sub_menu {
            display: none
        }

        .header-nav {
            position: fixed;
            top: 0;
            background: #fff;
            width: 100%
        }
        .filter_section {overflow-x: hidden}
        .serial_routes_row {position: sticky;transition: 500ms all;z-index: 1001;}
    </style>
@stop

@section('content')
    {{--{{dd($_GET['attrs']['6-1'])}}--}}
    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;">
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-9 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span class="bold">جميع الإعلانات</span>
                </div>

                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-3 py-2 text-left back">
                    <a href="{{ url()->previous() }}"
                       class="bold">العودة</a>
                    <div class="d-inline-block position-relative" style="width: 25px"><i
                            style="position: absolute;top: -15px;right: 3px;"
                            class="fa-solid fa-chevron-left mt-1  px-1 "></i></div>

                </div>
            </div>

        </div>
    </div>


    <section class="search_container container">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 client_ads_cols ">
                @if(isset($paid_client_ads) && $paid_client_ads->count() > 0 || isset($free_client_ads) && $free_client_ads->count() > 0 )
                    {{--    Start Ads--}}
                    <section class="client_ads_section mt-1 text-center">
                        <div class="container">
                            <div class="row client_ads_div">
                                <div class="col-lg-12 col-md-12 m-auto">
                                    <div class="row" id="client_ads_cont">
                                        @foreach($paid_client_ads as $key => $item)
                                            <div class="col-lg-3 col-md-3 col-6 col-sm-6 post  my-2">
                                                {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                <div class="card card-block pb-3"
                                                     style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
                                                    @php
                                                        $images =explode(',',$item->images);
                                                         //dd($photo);
                                                    @endphp
                                                    <div class="mark_div">
                                                        <img src="{{asset('assets/front/images/mark.png')}}"
                                                             alt="special offer"
                                                             width="100%">
                                                    </div>
                                                    @if(backpack_auth()->check())
                                                        <div
                                                            class="wish_div not_hovered_wish {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}"
                                                            data-target="{{$item->id}} " dir="ltr">
                                                            <a href="javascript:void(0)" class="wish-btn"
                                                               data-bs-target="{{$item->slug}}">
                                                                <img
                                                                    src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                    alt="wish-icon">
                                                                <span
                                                                    class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}">
                                                        {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>

                                                            </a>
                                                        </div>
                                                    @else
                                                        <div id="wish_div not_hovered_wish"
                                                             class="wish_div product_{{$item->id}}">
                                                            <a href="{{url('login')}}">
                                                                <img src="{{asset('assets/front/images/heart.png')}}"
                                                                     alt="wish-icon">
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <a href="{{route('client_ad.show', $item->slug)}}">
                                                        <div class="client_ad_cover">
                                                            <img src="{{asset('organized/'. $item->cover)}}"
                                                                 alt="{{$item->slug}}">
                                                        </div>
                                                        <div class="location_card text-muted pt-2">
                                                            <i class="fa fa-location-dot l_13"
                                                               style="margin-left: 3px"></i>
                                                            <small>{{$item->country->name}},</small>
                                                            <small>{{$item->city->name}}</small>
                                                            {{--                                            - <small>{{$item->state->name}}</small>--}}
                                                        </div>

                                                        <div class="titles bold">
                                                            <h5 class="card-title mb-3 bold">{{$item->title}}</h5>
                                                            <span style="font-weight: normal">السعر: </span>
                                                            <span
                                                                class="card-title  bold price colored">{{number_format($item->price, 0)}}</span>
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
                                            <div class="col-lg-3 col-md-3 col-6 col-sm-6 post my-2">
                                                {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                <div class="card card-block pb-3">
                                                    @if(backpack_auth()->check())
                                                        <div class="wish_div not_hovered_wish"
                                                             data-target="{{$item->id}} ">
                                                            <a href="javascript:void(0)" class="wish-btn"
                                                               data-bs-target="{{$item->slug}}">
                                                                <img
                                                                    src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                    alt="wish-icon">
                                                                <span>أضف لقائمة الرغبات</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="wish_div not_hovered_wish"
                                                             data-target="{{$item->id}} ">
                                                            <a href="{{url('login')}}">
                                                                <img src="{{asset('assets/front/images/heart.png')}}"
                                                                     alt="wish-icon">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <a href="{{route('client_ad.show', $item->slug)}}">
                                                        <div class="client_ad_cover">
                                                            <img src="{{asset('organized/'. $item->cover)}}"
                                                                 alt="{{$item->slug}}">
                                                        </div>
                                                        <div class="location_card text-muted pt-2">
                                                            <i class="fa fa-location-dot l_13"
                                                               style="margin-left: 3px"></i>
                                                            <small>{{$item->country->name}},</small>
                                                            <small>{{$item->city->name}}</small>
                                                            {{--                                            - <small>{{$item->state->name}}</small>--}}
                                                        </div>
                                                        <div class="titles bold">
                                                            <h5 class="card-title mb-3 bold">{{$item->title}}</h5>
                                                            <span style="font-weight: normal">السعر: </span>
                                                            <span
                                                                class="card-title  bold price colored">{{number_format($item->price, 0)}}</span>
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
                                    {{--                                    <div class="row mt-4">--}}
                                    {{--                                        <div class="col-md-3 col-12 col-sm-12 m-auto">--}}
                                    {{--                                            <button class="btn" id="see_more">اظهر المزيد</button>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </section>
                    {{--    End Ads--}}

                @else
                    <section class="client_ads_section mt-1 text-center">
                        <div class="container">
                            <div class="row client_ads_div">
                                <div class="col-lg-12 col-md-12 m-auto">
                                    <div class="row" id="client_ads_cont">
                                        <h4>لا توجد إعلانات بعد في هذه الفئة </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>

        </div>
    </section>



@endsection




@section('script')
    <script>

        //        $(window).scroll(function () {
        //            if ($(document).scrollTop() > 40) {
        //                $('nav.lower-nav').css({
        //                    'transition': '300ms',
        //                    'height': '82px',
        //                    'background': 'rgb(242 247 255)',
        //                });
        //            } else {
        //                $('nav.lower-nav').css({
        //                    'transition': '300ms',
        //                    'height': '100px',
        //                    'background' : ' #ffffffa6'
        //                });
        //            }
        //        });

        $(document).ready(function () {

            let filter_section = $('.filter_section');
            let filter_header = $(".filter_header");
            let header_nav = $('.header-nav');
            let client_ads_cols = $('.client_ads_cols');
            let serial_routes_row = $('.serial_routes_row');
            let new_filter_header = $(".new_filter_header");
            let mob_nav = $(".mob_nav");
            let filter_mobile_btn_div = $(".filter_mobile_btn_div");
            let close_mobile_filter = $('.close_mobile_filter');

            if ($(window).width() > 767) {
                filter_header.width(filter_section.width() + 19);
                filter_section.css({'top' : header_nav.height() + serial_routes_row.height(),
                    'height' : ($(window).height() - (header_nav.height() + serial_routes_row.height()))
                });
                client_ads_cols.css('margin-top', (header_nav.height() - 30));
                serial_routes_row.css('top', header_nav.height());

                let serial_top = parseInt(serial_routes_row.css('top'));
                let filter_top = parseInt(filter_section.css('top'));


                $(window).scroll(function () {
                    if ($(window).scrollTop() > 50) {
                        // alert(serial_top);
                        header_nav.css('top', '-78px');
                        filter_section.css({
                            'top' : (filter_top - 78) + 'px',
                            'height' : ($(window).height() - (header_nav.height() + serial_routes_row.height()  - 78)) + 'px'
                        });
                        // new_filter_header.
                        serial_routes_row.css('top', (serial_top - 78) + 'px')
                    } else {
                        header_nav.css('top', '0');
                        filter_section.css({
                            'top' : filter_top,
                            'height' : ($(window).height() - (header_nav.height() + serial_routes_row.height()) ) + 'px'
                        });
                        serial_routes_row.css('top', serial_top)

                    }
                });
            } else {
                filter_section.css({'top' : mob_nav.height() + serial_routes_row.height(),
                    'height' : ($(window).height() - (mob_nav.height() + serial_routes_row.height()))
                });
                filter_mobile_btn_div.css('margin-top', (serial_routes_row.height() - 30));
                serial_routes_row.css('top', mob_nav.height());

                // let serial_top = parseInt(serial_routes_row.css('top'));
                // let filter_top = parseInt(filter_section.css('top'));

            }



            let mobile_filter_btn = $('.mobile_filter_btn');
            mobile_filter_btn.on('click', function () {
                filter_section.addClass('active');
            });
            close_mobile_filter.on('click', function () {
                filter_section.removeClass('active');
            });



            let client_ad_post = $('section.client_ads_section .card');

            let maxHeight = Math.max.apply(null, client_ad_post.map(function () {
                return $(this).height();
            }).get());

            // alert(maxHeight);
            client_ad_post.height(maxHeight);


            let new_country_id = $('#new_country_id');
            let new_city_id = $('#new_city_id');

            new_country_id.select2();
            new_city_id.select2();
            let new_sub_cat_id = $('#new_sub_cat_id');
            new_sub_cat_id.select2();

            new_country_id.change(function () {
                let new_country_id = $(this).val();
                if (new_country_id !== "") {
                    $.ajax({
                        url: "/get-child-city/" + new_country_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: new_country_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data);
                            new_city_id.removeAttr('disabled');
                            new_city_id.find('option').remove();
                            if (response.status === 1) {
                                let data = response.data;
                                // console.log(data);
                                let html_option = '';
                                let new_data = [];
                                new_data.push({
                                    id: '',
                                    text: '<span>الكل</span>',
                                    html: '<span>الكل</span>',
                                    title: 'الكل',
                                });

                                $.each(data, function (i, item) {
                                    new_data.push({
                                        id: item.id,
                                        text: "<span>" + item.name + "</span>",
                                        html: "<span>" + item.name + "</span>",
                                        title: item.name
                                    });
                                });

                                // console.log(new_data);
                                new_city_id.select2({
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

                                let new_state_id = $('#new_state_id');
                            }
                        }
                    });
                } else {
                    new_city_id.find('option').remove();
                    let empty_data = [];
                    empty_data.push({
                        id: "",
                        text: '<span>اختر المدينة</span>',
                        html: '<span>اختر المدينة</span>',
                        title: 'اختر المدينة'
                    });

                    new_city_id.select2({
                        data: empty_data,
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
            });


            let main_head = $('.main_head');
            main_head.on('click', function () {
                let target = $(this).attr('data-target');
                target = $('.' + target);
                let icon_on = $(this).find('.fa.fa-chevron-left');
                let icon_off = $(this).find('.fa.fa-chevron-down');

                if (icon_on.hasClass('d-none')) {
                    icon_on.removeClass('d-none');
                    icon_off.addClass('d-none');
                } else {
                    icon_off.removeClass('d-none');
                    icon_on.addClass('d-none');
                }
                target.slideToggle();
            });


            let input_group = $('.input-group .form-control');
            input_group.focus(function () {
                $(this).prev('span.bound').css('border-color', '#426ddd');
            });
            input_group.focusout(function () {
                $(this).prev('span.bound').css('border-color', '#ced4da');
            });
            let toggle_icon = $('.toggle_icon');
            toggle_icon.on('click', function () {
                // alert('test')
                $(this).next(".sub_from_main").slideToggle();
            });

            let sub_toggle_item = $('.sub_toggle_item input');
            sub_toggle_item.change(function () {
                $(this).parent().parent().parent().parent().find('.main_toggle_item input').prop("checked", false);
            });

            let main_toggle_item = $('.main_toggle_item input');
            main_toggle_item.change(function () {
                if (this.checked) {
                    let subs = $(this).parent().parent().find('.sub_from_main input');
                    subs.prop('checked', false);
                } else {
                    let subs = $(this).parent().parent().find('.sub_from_main input');
                    subs.prop('checked', false);
                }
            });

        });
    </script>
@stop

