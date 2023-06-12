@extends('front.layouts.master')

@section('link')
    <link rel="stylesheet" href="{{asset('assets/front/css/jquery.exzoom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/flexslider.css')}}">
    <style>
        /*.single_ad_section {*/
        /*    margin-top: 137px*/
        /*}*/

        .flex-direction-nav a:before {
            color: #fff;
        }

        .gallery_item {
            max-height: 67vh;
            background: #ddd;
        }

        .gallery_item img {
            max-height: 67vh;
            background: #ddd;
        }

        .client_ads_section {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .client_ad_image {
            background: #00127c;
            border-radius: 5px;
        }

        /*.client_ad_image_item {*/
        /*    width: auto !important;*/
        /*    height: 426px !important;*/
        /*}*/

        /*.client_ad_cover {*/
        /*    max-height: 140px !important;*/
        /*}*/

        .bordered {
            box-shadow: 1px 1px 5px #c5c1c1;
            border: none !important;
        }

        #related_products.owl-carousel .owl-nav button.owl-prev {
            left: -5%;
        }

        #related_products.owl-carousel .owl-nav button.owl-next {
            right: -2%;
        }

        #related_products.owl-carousel .owl-nav button.owl-prev, #related_products.owl-carousel .owl-nav button.owl-next {
            top: 26%
        }

        h5.card-title {
            font-size: 14px
        }

    </style>
@stop

@section('content')

    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;">
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <a href="{{route('mainCat.show', $client_ad->cat->mainCategory->slug)}}"
                       class="bold">{{$client_ad->cat->mainCategory->title}}</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <a href="{{route('cat.show',  $client_ad->cat->slug)}}" class="bold">{{$client_ad->cat->title}}</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>

                    <span class="bold">{{$client_ad->title}}</span>


                </div>

                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 py-2 text-left back">
                    <a href="{{ url()->previous() }}"
                       class="bold">العودة</a>
                    <div class="d-inline-block position-relative" style="width: 25px"><i
                            style="position: absolute;top: -15px;right: 3px;"
                            class="fa-solid fa-chevron-left mt-1  px-1 "></i></div>

                </div>
            </div>

        </div>
    </div>

    <section class="single_ad_section product-details ">
        <div class="container" style="max-width: 1044px">
            @if(isset($client_ad))
                <div class="row">
                    @php
                        $photo = explode(',',$client_ad->images);
                        //dd($photo);
                    @endphp


                    <div class="col-md-8 col-lg-9 col-12 col-sm-12 product-gallery-pc ">
                        <div class="row">

                            <div class="col-sm-12 col-12 client_ad_title col-sm-12">
                                <h4 class="bold pt-3 pb-4 ">{{$client_ad->title}}</h4>
                            </div>

                            <div class="col-md-12 col-12 col-sm-12">
                                <section class="banners-client_ads_images_cont" dir="ltr">
                                    <div class="owl-carousel owl-theme" id="client_ads_images_section" dir="ltr">
                                        @foreach($photo as $key => $item)
                                            <div class="item client_ad_image">
                                                <img src="{{asset('organized/'.$item)}}"
                                                     class="client_ad_image_item m-auto"
                                                     alt="{{$client_ad->slug}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-3 col-lg-3 col-12 col-sm-12 side_part mobile_side_part d-none">
                                <div class="bordered mt-3 p-3 bg-white contact_section ">
                                    @if(backpack_auth()->check())
                                        <div
                                            class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'done' : ''}} not_hovered_wish"
                                            data-target="{{$client_ad->id}} ">
                                            <a href="javascript:void(0)" class="wish-btn"
                                               data-bs-target="{{$client_ad->slug}}">
                                                <img
                                                    src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                    alt="wish-icon">
                                                <span
                                                    class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="wish_div not_hovered_wish" data-target="{{$client_ad->id}} ">
                                            <a href="{{url('login')}}">
                                                <img src="{{asset('assets/front/images/heart.png')}}"
                                                     alt="wish-icon">
                                                <span>أضف لقائمة الرغبات</span>

                                            </a>
                                        </div>
                                    @endif
                                    <div class="price">
                                        <h4 class="bold l_22">{{number_format($client_ad->price, 0)}} <span
                                                class="colored">ج.م</span></h4>
                                    </div>
                                    <div class=" mt-2">
                                <span class="text-muted l_13"><span
                                        class="bold">{{$client_ad->country->name}} - {{$client_ad->city->name}}</span>
{{--                                    - {{$client_ad->state->name}}--}}
                                </span>
                                    </div>
                                    <div class=" mt-2 text-left">
                                        <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                           style="margin-left: 3px"></i>
                                        <span
                                            class="text-muted l_12">{{Carbon\Carbon::parse($client_ad->created_at)->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="mt-2 p-3 bordered row details"
                                     style="background: #fff;padding-bottom: 15px">
                                    <div class="col-md-12 col-12 col-sm-12 px-0 mt-1 p-b-7 bold">
                                        مواصفات الإعلان :
                                    </div>
                                    {{--                                    @foreach()--}}
                                    {{--                                    {{dd($client_ad->clientAdAttrsAnswers->count())}}--}}
                                    @if($client_ad->clientAdAttrsAnswers->count() > 0)
                                        {{--                                        {{dd($client_ad->clientAdAttrsAnswers->where('attr.type_of' , 'main'))}}--}}
                                        @foreach($client_ad->clientAdAttrsAnswers->where('attr.type_of' , 'main') as $item)

                                            @if($item->attr->type == 'with_options')
                                                <div class="col-md-6 col-lg-6 col-12 col-sm-6 px-0 py-1 attr_col"
                                                     style="border-bottom: 1px solid #ddd">
                                                    <div class="row mx-0 px-2 single_details_row">
                                                        <div
                                                            class="col-lg-6 col-md-6 col-6 col-sm-6 px-0 text-right py-1">
                                                            @if($item->attr->attr_icon != null)
                                                                <img src="{{asset($item->attr->attr_icon)}}" alt="icon"
                                                                     class="m-l-8 m-r-8 attr_icon">
                                                            @endif
                                                            {{$item->attr->title}} :
                                                        </div>
                                                        @php
                                                            $answer = \App\Models\Option::find($item->answer_value);
                                                        @endphp
                                                        <div
                                                            class="bold col-lg-6 col-md-6 col-6 col-sm-6 px-0 text-right pb-1" style="padding-top: 7px">
                                                            {{$answer->val}}
                                                            @if($answer->image !== null)
                                                                <img
                                                                    src="{{asset('uploads/options/' . $answer->image)}}"
                                                                    class="m-r-16" style="width: 41px" alt="image">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($item->attr->type == 'yes_no')
                                                @if($item->answer_value == '1')
                                                    <div class="col-md-6 col-lg-6 col-12 col-sm-6 px-0 py-1 attr_col"
                                                         style="border-bottom: 1px solid #ddd">
                                                        <div class="row mx-0 px-2 single_details_row">
                                                            <div
                                                                class="col-lg-8 col-md-8 col-8 col-sm-6 px-0 text-right py-1">
                                                                @if($item->attr->attr_icon != null)
                                                                    <img src="{{asset($item->attr->attr_icon)}}"
                                                                         alt="icon" class="m-l-8 m-r-8 attr_icon">
                                                                @endif
                                                                {{$item->attr->title}} :
                                                            </div>
                                                            <div
                                                                class="bold col-lg-4 col-md-4 col-4 col-sm-6 px-0 text-right pb-1" style="padding-top: 7px">
                                                                متوفر
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif($item->attr->type == 'with_no_answers')
                                                <div class="col-md-6 col-lg-6 col-12 col-sm-6 px-0 py-1 attr_col"
                                                     style="border-bottom: 1px solid #ddd">
                                                    <div class="row mx-0 px-2 single_details_row">
                                                        <div
                                                            class="col-lg-6 col-md-6 col-6 col-sm-6 px-0 text-right py-1">
                                                            @if($item->attr->attr_icon != null)
                                                                <img src="{{asset($item->attr->attr_icon)}}"
                                                                     alt="icon" class="m-l-8 m-r-8 attr_icon">
                                                            @endif
                                                            {{$item->attr->title}} :
                                                        </div>
                                                        <div
                                                            class="bold col-lg-6 col-md-6 col-6 col-sm-6 px-0 text-right pb-1" style="padding-top: 7px">
                                                            {{number_format($item->answer_value, 0)}} &nbsp;<span
                                                                style="font-weight: normal;"
                                                                class=" colored"> {{$item->attr->unit}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="see_other_attrs_div col-lg-12 col-md-12 mt-3 col-sm-12 col-12">
                                            <div class="row mx-0 px-2">
                                                <div class="col-lg-5 col-md-6 col-sm-6 col-12 m-auto text-center">
                                                    <button class="btn btn-primary w-100 other_details_btn"
                                                            data-bs-target="#other_attrs_details"
                                                            data-bs-toggle="modal">المواصفات تفصيلياً
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="other_attrs_details" tabindex="-1"
                                             aria-labelledby="other_attrs_details" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable"
                                                 style="max-width: 1044px!important;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title bold" id="exampleModalLabel"
                                                            style="color: #426ddd">المواصفات تفصيلياً</h5>
                                                        <button type="button" data-bs-dismiss="modal"
                                                                class="bold d-flex justify-content-center"
                                                                style="background: #f4f5fe!important; color: rgb(255, 149, 0); padding: 10px 15px">
                                                            <i class="fa-solid fa-xmark "
                                                               style="font-size: 15px;padding: 0 6px!important; "></i>
                                                            <span style="font-weight: normal">إغلاق</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pt-0">
                                                        <div class="row">
                                                            @foreach($client_ad->clientAdAttrsAnswers->where('attr.type_of' , 'other') as $item)

                                                                @if($item->attr->type == 'with_options')
                                                                    <div
                                                                        class="col-md-6 col-lg-6 col-12 col-sm-6  py-1 attr_col"
                                                                        style="border-bottom: 1px solid #ddd">
                                                                        <div class="row mx-0 ">
                                                                            <div
                                                                                class="col-lg-6 col-md-8 col-12 col-sm-6  text-right py-1">
                                                                                @if($item->attr->attr_icon != null)
                                                                                    <img
                                                                                        src="{{asset($item->attr->attr_icon)}}"
                                                                                        alt="icon"
                                                                                        class="m-l-8 m-r-8">
                                                                                @endif
                                                                                {{$item->attr->title}} :
                                                                            </div>
                                                                            @php
                                                                                $answer = \App\Models\Option::find($item->answer_value);
                                                                            @endphp
                                                                            <div
                                                                                class="bold col-lg-6 col-md-4 col-12 col-sm-6  text-right pb-1" style="padding-top: 7px">
                                                                                {{$answer->val}}
                                                                                @if($answer->image !== null)
                                                                                    <img
                                                                                        src="{{asset('uploads/options/' . $answer->image)}}"
                                                                                        class="m-r-16"
                                                                                        style="width: 41px" alt="image">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($item->attr->type == 'yes_no')
                                                                    @if($item->answer_value == '1')
                                                                        <div
                                                                            class="col-md-6 col-lg-6 col-12 col-sm-6  py-1 attr_col"
                                                                            style="border-bottom: 1px solid #ddd">
                                                                            <div class="row mx-0 ">
                                                                                <div
                                                                                    class="col-lg-8 col-md-8 col-10 col-sm-6  text-right py-1">
                                                                                    @if($item->attr->attr_icon != null)
                                                                                        <img
                                                                                            src="{{asset($item->attr->attr_icon)}}"
                                                                                            alt="icon"
                                                                                            class="m-l-8 m-r-8">
                                                                                    @endif
                                                                                    {{$item->attr->title}} :
                                                                                </div>
                                                                                <div
                                                                                    class="bold col-lg-4 col-md-4 col-2 col-sm-6  text-right pb-1" style="padding-top: 7px">
                                                                                    متوفر
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @elseif($item->attr->type == 'with_no_answers')
                                                                    <div
                                                                        class="col-md-6 col-lg-6 col-12 col-sm-6  py-1 attr_col"
                                                                        style="border-bottom: 1px solid #ddd">
                                                                        <div class="row mx-0 ">
                                                                            <div
                                                                                class="col-lg-6 col-md-8 col-12 col-sm-6  text-right py-1">
                                                                                @if($item->attr->attr_icon != null)
                                                                                    <img
                                                                                        src="{{asset($item->attr->attr_icon)}}"
                                                                                        alt="icon" class="m-l-8 m-r-8">
                                                                                @endif
                                                                                {{$item->attr->title}} :
                                                                            </div>
                                                                            <div
                                                                                class="bold col-lg-6 col-md-4 col-12 col-sm-6  text-right pb-1" style="padding-top: 7px">
                                                                                {{number_format($item->answer_value, 0)}}
                                                                                &nbsp;<span style="font-weight: normal;"
                                                                                            class=" colored"> {{$item->attr->unit}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3 col-12 col-sm-12 side_part mobile_side_part d-none">
                                <div class="bordered mt-3 bg-white pt-4 contact_section ">

                                    <div class="seller px-3">
                                        <div class="d-inline-block user_photo">
                                            <img class="flag" src="{{asset($client_ad->user->image)}}" alt="user_photo"> &nbsp;&nbsp;&nbsp;
                                        </div>
                                        <div class="d-inline-block">
                                            <h5 class="bold ">{{$client_ad->user->name}}</h5>
                                            <a href="{{route('seller.ads', $client_ad->user->serial_num)}}" class="text-muted">
                                                المزيد من الإعلانات
                                            </a>
                                        </div>
                                    </div>
                                    <div class=" mt-4">
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-sm-6" style="padding-left: 0;border-radius: 0">
                                                <a class="btn whats_btn" target="_blank"
                                                   href="{{$client_ad->user->whats_app != null ? 'https://wa.me/'. $client_ad->user->whats_app : ''}}">
                                                    <span class="bold l_14">واتساب</span>&nbsp;
                                                    <img src="{{asset('assets/front/images/whats.png')}}" alt="whats-icon"
                                                         style="width: 17px"
                                                         class="whats-icon">
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-6 col-sm-6" style="padding-right: 0;">
                                                <a class="btn call_btn" href="tel:{{$client_ad->user->phone}}">
                                                    <span class="bold l_14">اتصال</span> &nbsp;
                                                    <img src="{{asset('assets/front/images/phone.png')}}" alt="tel-icon"
                                                         style="width: 17px"
                                                         class="tel-icon">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="mt-2 p-3 bordered row details" style="background: #fff">
                                    <div class="col-md-12 col-12 col-sm-12 mt-1 p-b-7 bold">
                                        الوصف :
                                    </div>
                                    <div class="col-md-12 col-12 col-sm-12 mt-0 p-b-7 bold">
                                        <p class="description_text"
                                           style="width: 100%;">{!! $client_ad->description !!}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--{{dd($item->id)}}--}}
                    </div>
                    <div class="col-md-4 col-lg-3 col-12 col-sm-12 side_part ">
                        <div class="bordered mt-3 p-3 bg-white contact_section mobile_hide">
                            @if(backpack_auth()->check())
                                <div
                                    class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'done' : ''}} not_hovered_wish"
                                    data-target="{{$client_ad->id}} ">
                                    <a href="javascript:void(0)" class="wish-btn"
                                       data-bs-target="{{$client_ad->slug}}">
                                        <img
                                            src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                            alt="wish-icon">
                                        <span
                                            class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                    </a>
                                </div>
                            @else
                                <div class="wish_div not_hovered_wish" data-target="{{$client_ad->id}} ">
                                    <a href="{{url('login')}}">
                                        <img src="{{asset('assets/front/images/heart.png')}}"
                                             alt="wish-icon">
                                        <span>أضف لقائمة الرغبات</span>

                                    </a>
                                </div>
                            @endif
                            <div class="price">
                                <h4 class="bold l_22">{{number_format($client_ad->price, 0)}} <span
                                        class="colored">ج.م</span></h4>
                            </div>
                            <div class=" mt-2">
                                <span class="text-muted l_13"><span
                                        class="bold">{{$client_ad->country->name}} - {{$client_ad->city->name}}</span>
{{--                                    - {{$client_ad->state->name}}--}}
                                </span>
                            </div>
                            <div class=" mt-2 text-left">
                                <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                   style="margin-left: 3px"></i>
                                <span
                                    class="text-muted l_12">{{Carbon\Carbon::parse($client_ad->created_at)->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="bordered mt-3 bg-white pt-4 contact_section mobile_hide">

                            <div class="seller px-3">
                                <div class="d-inline-block user_photo">
                                    <img class="flag" src="{{asset($client_ad->user->image)}}" alt="user_photo"> &nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="d-inline-block">
                                    <h5 class="bold ">{{$client_ad->user->name}}</h5>
                                    <a href="{{route('seller.ads', $client_ad->user->serial_num)}}" class="text-muted">
                                        المزيد من الإعلانات
                                    </a>
                                </div>
                            </div>
                            <div class=" mt-4">
                                <div class="row">
                                    <div class="col-md-6 col-6 col-sm-6" style="padding-left: 0;border-radius: 0">
                                        <a class="btn whats_btn" target="_blank"
                                           href="{{$client_ad->user->whats_app != null ? 'https://wa.me/'. $client_ad->user->whats_app : ''}}">
                                            <span class="bold l_14">واتساب</span>&nbsp;
                                            <img src="{{asset('assets/front/images/whats.png')}}" alt="whats-icon"
                                                 style="width: 17px"
                                                 class="whats-icon">
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-6 col-sm-6" style="padding-right: 0;">
                                        <a class="btn call_btn" href="tel:{{$client_ad->user->phone}}">
                                            <span class="bold l_14">اتصال</span> &nbsp;
                                            <img src="{{asset('assets/front/images/phone.png')}}" alt="tel-icon"
                                                 style="width: 17px"
                                                 class="tel-icon">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bordered p-3 mt-3 bg-white instructions_section">

                            <div class="instructions_head">
                                <span class="bold">ارشادات التعامل مع البائع </span>
                            </div>
                            <div class="instructions_info mt-2 text-muted bold l_13">
                                <p>- قابل البايع في مكان عام زي المترو أو المولات </p>
                                <p>- خد حد معاك وانت رايح تقابل اي حد</p>
                                <p>- عاين المنتج كويس قبل ما تشتري وتأكد ان سعره مناسب</p>
                                <p>- متدفعش او تحول فلوس الا لما تعاين المنتج كويس</p>


                            </div>

                        </div>
                        <div class="mt-1">
                            <div style="width: 49%;text-align: right" class="p-r-10 d-inline-block">
                                <a href="{{route('contact.us').'?client_ad_serial='. $client_ad->serial_num}}"
                                   class="bold text-muted l_14">أبلغ عن الإعلان</a></div>
                            <div style="width: 49%; text-align: left" class="p-l-10 d-inline-block"><a
                                    href="{{route('contact.us').'?seller_serial='. $client_ad->user->serial_num}}"
                                    class="bold text-muted l_14">أبلغ عن المعلن</a></div>
                        </div>

                    </div>

                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="mt-3 p-3 bordered row related_products" style="background: #fff">
                                    <div class="col-md-12 col-12 col-sm-12 mt-3 p-b-7 bold">
                                        إعلانات ذات صلة :
                                    </div>
                                    <div class="owl-carousel owl-theme client_ads_section" id="related_products"
                                         dir="ltr">
                                        @foreach($related_paid_client_ads as $item)
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3"
                                                         style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;height: auto">
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
                                                                class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}} not_hovered_wish"
                                                                data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                    <span
                                                                        class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div not_hovered_wish"
                                                                 data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
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
                                                                <small>عدد المشاهدات
                                                                    : {{$item->viewNum->count()}}</small>
                                                                <small class="date_client_ad">
                                                                    <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                                                       style="margin-left: 3px"></i>
                                                                    <span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                                                </small>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        @endforeach
                                        @foreach($related_free_client_ads as $item)
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div
                                                                class="wish_div {{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}} not_hovered_wish"
                                                                data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                    <span
                                                                        class="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'done' : ''}}">{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? 'تم الإضافة' : 'أضف لقائمة الرغبات'}}</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div not_hovered_wish"
                                                                 data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
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
                                                                <small>عدد المشاهدات
                                                                    : {{$item->viewNum->count()}}</small>
                                                                <small class="date_client_ad">
                                                                    <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                                                       style="margin-left: 3px"></i>
                                                                    <span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>


    </section>

@stop

@section('script')
    <script
        src="{{asset('assets/front/js/jquery.exzoom_en.js')}}"></script>
    <script src="{{asset('assets/front/js/jquery.flexslider.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel",
                start: function (slider) {
                    $('body').removeClass('loading');
                }
            });

            $('#client_ads_images_section').owlCarousel({
                margin: 10,
                loop: true,
                // autoWidth: true,
                items: 1,
                center: true,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                responsive: {
                    600: {
                        items: 1
                    }
                }

            });
            $('#related_products').owlCarousel({
                margin: 10,
                loop: true,
                // autoWidth: true,
                items: 4,
                navs: true,
                navText: ["<i style='font-size: 38px;color:#ee7202' class='fa-solid fa-chevron-left'></i>", "<i style='font-size: 38px;color:#ee7202' class='fa-solid fa-chevron-right'></i>"],
                dots: true,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        dots: false,

                    },
                    480: {
                        items: 1,
                        nav: false,
                        dots: false,

                    },
                    767: {
                        items: 3,
                        nav: false,
                        dots: false,

                    },
                    992: {
                        items: 4,
                        nav: true
                    },
                    1200: {
                        items: 4,
                        nav: true
                    }
                }

            });





        });


    </script>
@stop
