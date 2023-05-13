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
    </style>
@stop

@section('content')
    {{--{{dd($_GET['attrs']['6-1'])}}--}}


    {{--    Start Ads--}}
    @if($count > 0)
    <section class="client_ads_section text-center">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3 mt-1 p-3">
                    <div class="bordered" style="text-align: center">
                        <div class="user-side-bar">
                            <ul class="list-group">
                                <li class="list-group-item {{Route::currentRouteName() == 'user.posts' ? 'active' : ''}}"><a href="{{route('user.posts')}}">الكل</a></li>
                                <li class="list-group-item {{Route::currentRouteName() == 'user.posts.published' ? 'active' : ''}}"><a href="{{route('user.posts.published')}}">الإعلانات المنشورة</a></li>
                                <li class="list-group-item {{Route::currentRouteName() == 'user.posts.under' ? 'active' : ''}}"><a href="{{route('user.posts.under')}}">الإعلانات تحت المراجعة</a></li>
                                <li class="list-group-item {{Route::currentRouteName() == 'user.posts.expired' ? 'active' : ''}}"><a href="{{route('user.posts.expired')}}">الإعلانات المنتهية</a></li>
                                <li class="list-group-item {{Route::currentRouteName() == 'user.posts.canceled' ? 'active' : ''}}"><a href="{{route('user.posts.canceled')}}">الإعلانات المرفوضة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-12 col-sm-12 mt-3">
                    <div class="row" id="client_ads_cont">
                        @if(isset($paid_client_ads_published) && $paid_client_ads_published->count() > 0)
                            @foreach($paid_client_ads_published as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post  my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="mark_div">
                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        <div class="success_div">
                                            <img src="{{asset('assets/front/images/success.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>

                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>

                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif {{-- Done --}}

                        @if(isset($paid_client_ads_under_reviewed) && $paid_client_ads_under_reviewed->count() > 0)
                            @foreach($paid_client_ads_under_reviewed as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post  my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="mark_div">
                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>

                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>

                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if(isset($paid_client_ads_expired) && $paid_client_ads_expired->count() > 0)
                            @foreach($paid_client_ads_expired as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post  my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="mark_div">
                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>

                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>

                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif




                        @if(isset($paid_client_ads_canceled) && $paid_client_ads_canceled->count() > 0)
                            @foreach($paid_client_ads_canceled as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post  my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3" style="height: 336px;">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="mark_div">
                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        <div class="rejected_div">
                                            <img src="{{asset('assets/front/images/rejected.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>

                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                        <div class="reason_div w-100">
                                            <span class="btn btn-danger w-100">{{isset($item->reason) ? $item->reason->reason_val : ''}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif {{-- Done --}}







                        @if(isset($free_client_ads_published) && $free_client_ads_published->count() > 0)

                            @foreach($free_client_ads_published as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="success_div">
                                            <img src="{{asset('assets/front/images/success.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>
                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                        @if(isset($free_client_ads_under_reviewed) && $free_client_ads_under_reviewed->count() > 0)

                            @foreach($free_client_ads_under_reviewed as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block pb-3">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp

                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>
                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if(isset($free_client_ads_canceled) && $free_client_ads_canceled->count() > 0)

                            @foreach($free_client_ads_canceled as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post my-2">
                                    {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                    <div class="card card-block my_post_card pb-3"  style="height: 336px;">
                                        @php
                                            $images =explode(',',$item->images);
                                             //dd($photo);
                                        @endphp
                                        <div class="rejected_div">
                                            <img src="{{asset('assets/front/images/rejected.png')}}" alt="special offer"
                                                 width="100%">
                                        </div>
                                        <a href="{{route('client_ad.show', $item->slug)}}">
                                            <div class="client_ad_cover">
                                                <img src="{{asset('images/dropped/'. $images[0])}}"
                                                     alt="{{$item->slug}}">
                                            </div>
                                            <div class="titles bold">
                                                <h5 class="card-title  bold">{{$item->title}}</h5>
                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>
                                            </div>
                                        </a>
                                        <div class="footer_card text-muted">
                                            <small>{{$item->country->name}}</small> -
                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>
                                        </div>
                                        <div class="reason_div w-100">
                                            <span class="btn btn-danger w-100">{{isset($item->reason) ? $item->reason->reason_val : ''}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    @if($count > 6)
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
                    <div class="col-md-3 mt-1 p-3">
                        <div class="bordered" style="text-align: center">
                            <div class="user-side-bar">
                                <ul class="list-group">
                                    <li class="list-group-item {{Route::currentRouteName() == 'user.posts' ? 'active' : ''}}"><a href="{{route('user.posts')}}">الكل</a></li>
                                    <li class="list-group-item {{Route::currentRouteName() == 'user.posts.published' ? 'active' : ''}}"><a href="{{route('user.posts.published')}}">الإعلانات المنشورة</a></li>
                                    <li class="list-group-item {{Route::currentRouteName() == 'user.posts.under' ? 'active' : ''}}"><a href="{{route('user.posts.under')}}">الإعلانات تحت المراجعة</a></li>
                                    <li class="list-group-item {{Route::currentRouteName() == 'user.posts.expired' ? 'active' : ''}}"><a href="{{route('user.posts.expired')}}">الإعلانات المنتهية</a></li>
                                    <li class="list-group-item {{Route::currentRouteName() == 'user.posts.canceled' ? 'active' : ''}}"><a href="{{route('user.posts.canceled')}}">الإعلانات المرفوضة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-12 col-sm-12 mt-3">
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

            let client_ads_cont = $('#client_ads_cont');
            let width_c = client_ads_cont.width();
            let post = $('.post');
            let count = post.length;
            // alert(count);
            let height_ = post.height() + 16;
            let width_ = post.width();
            let count_in_row = Math.floor(width_c / width_);
            // alert(count_in_row);
            client_ads_cont.height((6 / count_in_row * height_));


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

