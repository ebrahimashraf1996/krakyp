@extends('front.layouts.master')

@section('styles')
    <style>
        .nice-select {
            line-height: 28px !important;
        }

        #adv_opts_cont .nice-select {
            width: 100%;
        }

        /*.client_ad_cover img {*/
        /*    height: 160px;*/
        /*}*/

        .user-side-bar a {color: #062964}
        .user-side-bar li.active  a{color: #fff}
        .user-side-bar li.list-group-item a{padding: .75rem 2rem}
        .list-group-item.active {background-color: #062964;border-color: #062964; font-weight: bold}
        .success_div {
            width: 60px;
            position: absolute;
            top: 8px;
            left: 0;
        }
        .rejected_div {
            width: 35px;
            position: absolute;
            top: 8px;
            left: 10px;
        }
        .client_ad_cover {max-height: 156px}

    </style>
@stop

@section('content')
    {{--{{dd($_GET['attrs']['6-1'])}}--}}

    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;" >
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-9 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span class="bold">حسابي</span>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <a href="{{route('packages.bills')}}" class="bold">باقاتي</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>

                    <span class="bold">{{$pack->title}} ({{$pack->cat->title}})</span>
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

    {{--    Start Ads--}}
    @if($count > 0)
    <section class=" client_ads_section my_ads_section text-center">
        <div class="container" style="max-width: 1044px">
            <div class="row mt-3">
                <div class="col-md-12 col-sm-12 col-12 text-right mt-1">
                    <h3 class="bold l_27">الإعلانات داخل ({{$pack->title}} - {{$pack->cat->title}}) </h3>
                </div>
            </div>

            <div class="row p-2 mt-3 pb-5">
                <div class="col-md-12 col-12 col-sm-12 packages_div " style="min-height: 300px">
                    <div class="row p-2 my-2" id="client_ads_cont">
                        @if(isset($paid_client_ads_published) && $paid_client_ads_published->count() > 0)

                        @foreach($paid_client_ads_published as $key => $item)
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
                        @endif


                        @if(isset($paid_client_ads_under_reviewed) && $paid_client_ads_under_reviewed->count() > 0)

                                @foreach($paid_client_ads_under_reviewed as $key => $item)
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
                            @endif


                        @if(isset($paid_client_ads_expired) && $paid_client_ads_expired->count() > 0)

                                @foreach($paid_client_ads_expired as $key => $item)
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
                            @endif

                    </div>
                    @if($count > 8)
                        <div class="row mt-4">
                            <div class="col-md-3 col-12 col-sm-12 m-auto">
                                <button class="btn" id="see_more">اظهر المزيد</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @else
        <section class="client_ads_section text-center">
            <div class="container">
                <div class="row mt-5 text-center">

                    <div class="col-md-12 col-12 col-sm-12 mt-3">
                        <div class="row" id="client_ads_cont">
                            <h4>لا توجد إعلانات في هذا القسم </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif
    {{--    End Ads--}}













@endsection




@section('script')
    <script>


        $(document).ready(function () {

            let client_ad_post = $('section.my_ads_section .card');

            let maxHeight = Math.max.apply(null, client_ad_post.map(function () {
                return $(this).height();
            }).get());

            // alert(maxHeight);
            client_ad_post.height(maxHeight);




            let client_ads_cont = $('#client_ads_cont');
            let width_c = client_ads_cont.width();
            let post = $('.post');
            let count = post.length;
            // alert(count);
            let height_ = post.height() + 16;
            let width_ = post.width();
            let count_in_row = Math.floor(width_c / width_);
            // alert(count_in_row);
            // client_ads_cont.height((8 / count_in_row * height_));


            let see_more = $('#see_more');
            see_more.on('click', function () {
                let visible_posts_count = client_ads_cont.height() / height_;
                let hidden_posts_count = Math.floor(Math.ceil(count / count_in_row) - visible_posts_count);
                // alert(12/count_in_row);
                // alert(Math.ceil(count/count_in_row));
                // alert(hidden_posts_count);
                if (hidden_posts_count > 3) {
                    // alert('test');
                    client_ads_cont.height(client_ads_cont.height() + (height_ * 3));
                } else if (hidden_posts_count === 3) {
                    // alert('not');
                    client_ads_cont.height(client_ads_cont.height() + (height_ * 3));
                    see_more.remove();
                } else if (hidden_posts_count === 2) {
                    client_ads_cont.height(client_ads_cont.height() + (height_ * 2));
                    see_more.remove();
                } else {
                    client_ads_cont.height(client_ads_cont.height() + (height_ * 1));
                    see_more.remove();
                }
            });


        });
    </script>
@stop






