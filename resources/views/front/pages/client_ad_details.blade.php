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
            padding-top:0!important;
        }

        .client_ad_image {
            background: #00127c;
            border-radius: 5px;
        }

        .client_ad_image_item {
            width: auto !important;
            height: 426px !important;
        }

        .related_products .client_ad_cover img {
            height: 136px;
        }

        .bordered{box-shadow: 1px 1px 5px #c5c1c1;border: none!important;}
    </style>
@stop

@section('content')



    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;" >
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <a href="{{route('mainCat.show', $client_ad->cat->mainCategory->slug)}}" class="bold">{{$client_ad->cat->mainCategory->title}}</a>
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


                    <div class="col-md-9 col-lg-9 col-12 col-sm-12 product-gallery-pc ">
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
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="m-3 bordered row details"  style="    padding-bottom: 15px">
                                    <div class="col-md-12 col-12 col-sm-12 mt-3 p-b-7 bold">
                                        التفاصيل :
                                    </div>
                                    <div class="col-md-6 col-12 col-sm-6 attributes  py-1">
                                        <div class="bold details_div">السعر:</div>

                                        <div class="details_div_answer">{{number_format($client_ad->price, 0)}}ج.م
                                        </div>

                                    </div>
                                    {{--                                    @foreach()--}}
                                    {{--                                    {{dd($client_ad->clientAdAttrsAnswers->count())}}--}}
                                    @if($client_ad->clientAdAttrsAnswers->count() > 0)
                                        @foreach($client_ad->clientAdAttrsAnswers as $item)

                                                @if($item->answer_type == 'select')
                                                <div class="col-md-6 col-12 col-sm-6 attributes py-1">

                                                <div class="bold details_div">{{$item->attr->title}} :</div>
                                                @php
                                                    $answer = \App\Models\Option::find($item->answer_value);
                                                @endphp
                                                    <div class="details_div_answer">{{$answer->val}}</div>
                                                </div>
                                                @else
                                                    @if($client_ad->answer_value == '1')
                                                    <div class="col-md-6 col-12 col-sm-6 attributes py-1">

                                                    <div class="bold details_div">{{$item->attr->title}} :</div>

                                                        <div class="details_div_answer"> متوفر</div>
                                                    </div>
                                                    @endif
                                                @endif

                                        @endforeach
                                    @endif
                                    <div class="col-md-6 col-12 col-sm-6 attributes  py-1">
                                        <div class="bold details_div">المحافظة:</div>

                                        <div class="details_div_answer">{{$client_ad->country->name}} </div>

                                    </div>
                                    <div class="col-md-6 col-12 col-sm-6 attributes  py-1">
                                        <div class="bold details_div">المدينة:</div>

                                        <div class="details_div_answer">{{$client_ad->city->name}} </div>

                                    </div>
                                    <div class="col-md-6 col-12 col-sm-6 attributes  py-1">
                                        <div class="bold details_div">الحي / المركز:</div>

                                        <div class="details_div_answer">{{$client_ad->state->name}} </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="m-3 bordered row details">
                                    <div class="col-md-12 col-12 col-sm-12 mt-3 p-b-7 bold">
                                        الوصف :
                                    </div>
                                    <div class="col-md-12 col-12 col-sm-12 mt-3 p-b-7 bold">
                                        <p class="description_text"
                                           style="width: 100%;">{!! $client_ad->description !!}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

{{--{{dd($item->id)}}--}}
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 col-sm-12 side_part">
                        <div class="bordered mt-3 p-3 contact_section">
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
                                <div id="wish_div not_hovered_wish" class="wish_div product_{{$item->id}}">
                                    <a href="{{url('login')}}">
                                        <img src="{{asset('assets/front/images/heart.png')}}"
                                             alt="wish-icon">
                                    </a>
                                </div>
                            @endif
                            <div class="price">
                                <h4 class="bold l_22">{{number_format($client_ad->price, 0)}} <span class="colored">ج.م</span></h4>
                            </div>
                            <div class=" mt-2">
                                <span class="text-muted l_13"><span class="bold">{{$client_ad->country->name}} - {{$client_ad->city->name}}</span>
{{--                                    - {{$client_ad->state->name}}--}}
                                </span>
                            </div>
                            <div class=" mt-2 text-left">
                                <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                   style="margin-left: 3px"></i>
                                <span class="text-muted l_12">{{Carbon\Carbon::parse($client_ad->created_at)->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="bordered mt-3  pt-4 contact_section">

                            <div class="seller px-3">
                                <div class="d-inline-block user_photo">
                                    <img class="flag" src="{{asset($client_ad->user->image)}}" alt="user_photo"> &nbsp;&nbsp;&nbsp;

                                </div>
                                <div class="d-inline-block">
                                    <h5 class="bold ">{{$client_ad->user->name}}</h5>
                                    <a href="{{route('seller.ads', $client_ad->user->serial_num)}}" class="text-muted">المزيد من الإعلانات</a>

                                </div>
                            </div>
                            <div class=" mt-4">
                                <div class="row">
                                    <div class="col-md-6 col-6 col-sm-6" style="padding-left: 0;border-radius: 0">
                                        <a class="btn whats_btn" target="_blank" href="{{$client_ad->user->whats_app != null ? 'https://wa.me/'. $client_ad->user->whats_app : ''}}">
                                            <span class="bold l_14">واتساب</span>&nbsp;
                                            <img src="{{asset('assets/front/images/whats.png')}}" alt="whats-icon" style="width: 17px"
                                                  class="whats-icon">
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-6 col-sm-6" style="padding-right: 0;">
                                        <a class="btn call_btn" href="tel:{{$client_ad->user->phone}}">
                                            <span class="bold l_14">اتصال</span> &nbsp;
                                            <img src="{{asset('assets/front/images/phone.png')}}" alt="tel-icon" style="width: 17px"
                                                  class="tel-icon">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bordered p-3 mt-3 instructions_section">

                            <div class="instructions_head">
                                <span class="bold">ارشادات التعامل مع البائع </span>
                            </div>
                            <div class="instructions_info mt-2 text-muted l_16">
                                <p>- قابل البايع في مكان عام زي المترو أو المولات </p>
                                <p>- خد حد معاك وانت رايح تقابل اي حد</p>
                                <p>- عاين المنتج كويس قبل ما تشتري وتأكد ان سعره مناسب</p>
                                <p>- متدفعش او تحول فلوس الا لما تعاين المنتج كويس</p>


                            </div>

                        </div>
                        <div>
                            <div style="width: 49%;text-align: right" class="p-r-10 d-inline-block"><a href="{{route('contact.us').'?client_ad_serial='. $client_ad->serial_num}}" class="text-muted l_15">أبلغ عن الإعلان</a></div>
                            <div style="width: 49%; text-align: left"  class="p-l-10 d-inline-block"><a href="{{route('contact.us').'?seller_serial='. $client_ad->user->serial_num}}" class="text-muted l_15">أبلغ عن المعلن</a></div>
                        </div>

                    </div>
                    <div class="col-md-8 col-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-sm-12">
                                <div class="m-3 bordered row related_products">
                                    <div class="col-md-12 col-12 col-sm-12 mt-3 p-b-7 bold">
                                        إعلانات ذات صلة :
                                    </div>
                                    <div class="owl-carousel owl-theme client_ads_section" id="related_products"
                                         dir="ltr">
                                        @foreach($related_paid_client_ads as $item)
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
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
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="post" dir="rtl">
                                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                    <div class="card card-block pb-3">
                                                        @php
                                                            $images =explode(',',$item->images);
                                                             //dd($photo);
                                                        @endphp
                                                        @if(backpack_auth()->check())
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="javascript:void(0)" class="wish-btn"
                                                                   data-bs-target="{{$item->slug}}">
                                                                    <img
                                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="wish_div" data-target="{{$item->id}} ">
                                                                <a href="{{url('login')}}">
                                                                    <img
                                                                        src="{{asset('assets/front/images/heart.png')}}"
                                                                        alt="wish-icon">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                                            <div class="client_ad_cover">
                                                                <img class="m-auto" style="width: auto!important;" src="{{asset('images/dropped/'. $images[0])}}"
                                                                     alt="{{$item->slug}}">
                                                            </div>

                                                            <div class="titles bold">
                                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                                            </div>
                                                        </a>
                                                        <div class="footer_card text-muted">
                                                            <small>{{$item->country->name}}</small> -
                                                            <small>{{$item->city->name}}</small> -
                                                            <small>{{$item->state->name}}</small>
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
                items: 3,
                navs: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false
                    },
                    480: {
                        items: 2,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    992: {
                        items: 3,
                        nav: false
                    },
                    1200: {
                        items: 3,
                        nav: false
                    }
                }

            });

        });


    </script>
@stop
