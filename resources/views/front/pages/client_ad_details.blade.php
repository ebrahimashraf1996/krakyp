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

        /*.carousel-item img {*/
        /*    width: 100%*/
        /*}*/
        /*.client_ad_image_item {height: 100%}*/
        /*.banners-client_ads_images_cont {max-height: 68vh;}*/
        .client_ad_image {
            background: #ddd
        }

        .client_ad_image_item {
            width: auto !important;
            height: 426px !important;
        }

        .wish_div img {
            width: 26px !important;
            padding-top: 4px !important;
            padding-right: 5px;
        }
        .related_products .client_ad_cover img {
            height: 136px;
        }
        
        .bordered{box-shadow: 1px 1px 5px #c5c1c1;border: none!important;}
    </style>
@stop

@section('content')
    <section class="single_ad_section product-details ">
        <div class="container">
            @if(isset($client_ad))
                <div class="row">
                    @php
                        $photo = explode(',',$client_ad->images);
                        //dd($photo);
                    @endphp


                    <div class="col-md-8 col-12 col-sm-12 product-gallery-pc ">
                        <div class="row">
                            <div class="col-sm-12 col-12 col-sm-12 serial_url text-muted l_14">

                                <a href="#" class="cl-919191  l_14">{{$client_ad->cat->mainCategory->title}}</a> -

                                <a href="#" class="cl-919191 l_14">{{$client_ad->cat->title}} </a> -
                                <span class="l_14">{{$client_ad->title}}</span>
                            </div>

                            <div class="col-sm-12 col-12 client_ad_title col-sm-12">
                                <h4 class="bold pt-3 pb-4 ">{{$client_ad->title}}</h4>
                            </div>

                            <div class="col-md-12 col-12 col-sm-12">
                                {{--                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">--}}
                                {{--                                    <div class="carousel-inner">--}}
                                {{--                                        @foreach($photo as $key => $item)--}}
                                {{--                                            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">--}}
                                {{--                                                <img src="{{asset('images/dropped/'.$item)}}" class="d-block w-100" alt="{{$client_ad->slug}}">--}}
                                {{--                                            </div>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </div>--}}
                                {{--                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">--}}
                                {{--                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                                {{--                                        <span class="visually-hidden">Previous</span>--}}
                                {{--                                    </button>--}}
                                {{--                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">--}}
                                {{--                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                                {{--                                        <span class="visually-hidden">Next</span>--}}
                                {{--                                    </button>--}}
                                {{--                                </div>--}}

                                <section class="banners-client_ads_images_cont container" dir="ltr">
                                    <div class="owl-carousel owl-theme" id="client_ads_images_section" dir="ltr">
                                        @foreach($photo as $key => $item)
                                            <div class="item client_ad_image">
                                                <img src="{{asset('images/dropped/'.$item)}}"
                                                     class="client_ad_image_item m-auto"
                                                     alt="{{$client_ad->slug}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </section>


                                {{--                                <section class="slider">--}}
                                {{--                                    <div id="slider" class="flexslider">--}}
                                {{--                                        <ul class="slides">--}}
                                {{--                                            @foreach($photo as $key => $item)--}}
                                {{--                                                <li class="gallery_item">--}}
                                {{--                                                    <img src="{{asset('images/dropped/'.$item)}}" alt="{{$client_ad->slug}}" height="100%">--}}
                                {{--                                                </li>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                {{--                                </section>--}}
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
                    <div class="col-md-4 col-12 col-sm-12 side_part">
                        <div class="bordered m-3 p-4 contact_section">
                            <div class="internal_wish" data-target="{{$client_ad->id}}">
                                @if(backpack_auth()->check())

                                <a href="javascript:void(0)" class="wish-btn"
                                   data-bs-target="{{$item->slug}}">
                                    <img src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$client_ad->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                        alt="wish-icon">
                                        
                                </a>
                                @else 
                                        <a href="{{url('login')}}" class="wish-btn">
                                            <img src="{{asset('assets/front/images/heart.png')}}"
                                                 alt="wish-icon">
                                        </a>
                                @endif
                            </div>
                            <div class="price">
                                <h4 class="bold">{{number_format($client_ad->price, 0)}} ج.م</h4>
                            </div>
                            <div class=" mt-2">
                                <span class="text-muted l_14">{{$client_ad->country->name}} - {{$client_ad->city->name}} - {{$client_ad->state->name}}</span>
                            </div>
                            <div class=" mt-2">
                                <span
                                    class="text-muted l_14">{{Carbon\Carbon::parse($client_ad->created_at)->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="bordered m-3  pt-4 mt-3 contact_section">

                            <div class="seller px-4">
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
                                            <span class="bold">إرسال واتساب</span> &nbsp;&nbsp;
                                            <img src="{{asset('assets/front/images/whats.png')}}" alt="whats-icon"
                                                  class="whats-icon">
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-6 col-sm-6" style="padding-right: 0;">
                                        <a class="btn call_btn" href="tel:{{$client_ad->user->phone}}">
                                            <span class="bold">اتصل الآن</span> &nbsp;&nbsp;
                                            <img src="{{asset('assets/front/images/phone.png')}}" alt="tel-icon"
                                                  class="tel-icon">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bordered p-3  instructions_section">

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

            let card = $('.post');
            card.hover(function () {
                let wish_div = $(this).find('.wish_div').css('display', 'block');
            }, function () {
                let wish_div = $(this).find('.wish_div').css('display', 'none');
            });

            let wish_div = $('.wish_div');
            wish_div.on('click', function () {
                let id = $(this).attr('data-target');
                let img = $(this).find('.wish-btn img');
                // alert(id);
                $.ajax({
                    url: "{{route('add.to.wish')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                    },
                    type: 'POST',
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON()
                        }
                        console.log(response);
                        let status = response.status;
                        if (status === 1) {
                            Swal.fire({
                                icon: 'success',
                                text: response.msg,
                                dangerMode: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                            img.attr('src', '{{asset('assets/front/images/hearted.png')}}');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.msg,
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        }
                    }
                })
            });
            let internal_wish = $('.internal_wish');
            internal_wish.on('click', function () {
                let id = $(this).attr('data-target');
                let img = $(this).find('.wish-btn img');
                // alert(id);
                $.ajax({
                    url: "{{route('add.to.wish')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                    },
                    type: 'POST',
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON()
                        }
                        console.log(response);
                        let status = response.status;
                        if (status === 1) {
                            Swal.fire({
                                icon: 'success',
                                text: response.msg,
                                dangerMode: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                            img.attr('src', '{{asset('assets/front/images/hearted.png')}}');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.msg,
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        }
                    }
                })
            });


            //
            // let text_area = $('.description_text').val();
            // alert(text_area);
            //
            // text_area = text_area.replace("\n", "<br>");
            // alert(text_area);


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

            })

        });


    </script>
@stop
