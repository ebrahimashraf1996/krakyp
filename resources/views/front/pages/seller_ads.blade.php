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

        <section class="client_ads_section text-center">
            <div class="container">
                <div class="row mt-5">
                    <div class="row" style="text-align: right">
                        <div class="col-sm-12 col-12 col-sm-12 serial_url text-muted l_14">

                            <a href="{{route('site.home')}}" class="cl-919191  l_14">الصفحة الرئيسية</a> -

                            <a href="#" class="cl-919191 l_14">البائعين </a> -
                            <span class="cl-919191 l_14">{{$user->name}} </span>

                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-12 col-sm-12 col-12">

{{--                            <h3 class="bold">الإعلانات داخل ({{$pack->title}} - {{$pack->cat->title}}) </h3>--}}
                        </div>
                    </div>

                        <div class="row p-4">
                            <div class="col-md-6 col-12 col-sm-12 " style="text-align: right" >
                                <div class="row p-4">
                                    <div class="col-md-12 col-12 col-sm-12 " style="text-align: right" >
                                <span class="bold l_17">اسم البائع : </span>
                                <span class="bold l_17">{{$user->name}}</span>
                                    </div>
                                </div>
                                @if($user->description != null)

                                    <div class="row p-4">
                                        <div class="col-md-12 col-12 col-sm-12 " style="text-align: right" >
                                            <span class="bold l_17">وصف البائع : </span>
                                            <p class="bold l_17 description_text">{{$user->description}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($user->image != null)
                            <div class="col-md-6 col-12 col-sm-12 m-auto text-center">
                                <div class="col-md-6 col-12 col-sm-12 m-auto text-center">

                                <img src="{{asset($user->image)}}" alt="user-image" class="w-100" style="border-radius: 22px;margin: auto">
                                </div>

                            </div>
                            @endif
                        </div>

                    @if($count > 0)
                    <div class="row my-4">
                        <div class="col-md-12 col-sm-12 col-12">
                            <h3 class="bold">إعلانات البائع  </h3>
                        </div>
                    </div>



                    <div class="col-md-12 col-12 col-sm-12 mt-3">
                        <div class="row" id="client_ads_cont">
                            @if(isset($paid_client_ads_published) && $paid_client_ads_published->count() > 0)
                                @foreach($paid_client_ads_published as $key => $item)
                                    <div class="col-md-3 col-6 col-sm-6 post  my-2">
                                        {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                        <div class="card card-block pb-3 bordered">
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

                            @if(isset($free_client_ads_published) && $free_client_ads_published->count() > 0)

                                @foreach($free_client_ads_published as $key => $item)
                                    <div class="col-md-3 col-6 col-sm-6 post my-2">
                                        {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                        <div class="card card-block pb-3 bordered">
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
                        </div>
                        @if($count > 6)
                            <div class="row mt-4">
                                <div class="col-md-3 col-12 col-sm-12 m-auto">
                                    <button class="btn" id="see_more">اظهر المزيد</button>
                                </div>
                            </div>
                        @endif
                    </div>
                        @endif
                </div>
            </div>
        </section>

        @if($count < 1)
        <section class="client_ads_section text-center">
            <div class="container">
                <div class="row mt-5 text-center">

                    <div class="col-md-12 col-12 col-sm-12 mt-3">
                        <div class="row" id="client_ads_cont">
                            <h4>لا توجد إعلانات لهذا البائع </h4>
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
            client_ads_cont.height((8 / count_in_row * height_));


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
