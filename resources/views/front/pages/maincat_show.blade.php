@extends('front.layouts.master')

@section('styles')
    <style>
        .nice-select {
            line-height: 28px !important;
        }

        #adv_opts_cont .nice-select {
            width: 100%;
        }

        #cats_row {
            padding: 0
        }

        .client_ads_cat_section {
            padding-top: 70px;
            margin-top: 0
        }

        /*.pretty .state label:after, .pretty .state label:before {right: 0}*/
        /*.pretty.p-svg .state .svg {right: 0}*/


    </style>
@stop

@section('content')
    {{--{{dd($_GET['attrs']['6-1'])}}--}}

    @if(isset($paid_client_ads_in_cat) && $paid_client_ads_in_cat->count() > 0 || isset($free_client_ads_in_cat) && $free_client_ads_in_cat->count() > 0 )
        {{--    Start Ads--}}
        <section class="client_ads_section client_ads_cat_section  text-center">
            <div class="container">
                <div class="row main_row">
                    <div class="col-md-12 col-12 col-sm-12 text-muted l_17 serial_url " style="text-align: right">
                        <a href="{{route('site.home')}}" class="cl-919191 l_14">الصفحة الرئيسية </a> -

                    @if(isset($maincat))
                            <a href="{{route('mainCat.show', $maincat->slug)}}" class="cl-919191 l_14">{{$maincat->title}} </a>
                        @endif
                        @if(isset($_GET['cat_id']) && !empty($_GET['cat_id']) && $_GET['cat_id'] != 'all'))
                                - <a href="{{route('cat.show', \App\Models\Category::select('id', 'title', 'slug')->find($_GET['cat_id'])->slug)}}" class="cl-919191  l_14">{{\App\Models\Category::select('id', 'title', 'slug')->find($_GET['cat_id'])->title}}</a>
                        @endif

                    </div>

                    <div class="col-md-3 filters p-3">
                        <div class="bordered" style="text-align: right; position:relative;">
                            <div class="filters_dismiss">
                                <div class="filters_btn_dismiss">
                                    <div class="filters_container_dismiss">
                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss"
                                             style="width: 25px">
                                    </div>
                                </div>
                            </div>
                            <h4 class="bold l_20 my-3 p-r-20 p-t-20">
                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>
                                الفلاتر
                            </h4>
                            <form action="{{route('mainCat.show', $maincat->slug)}}" method="get" class="">
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="from_" class="mb-2 bold">أقل سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="from_" name="from_"
                                           value="{{!empty($_GET['from_']) ? $_GET['from_'] : $min}}"
                                           placeholder="أقل سعر ج.م">
                                </div>
                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">
                                    <label for="to_" class="mb-2 bold">أعلي سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="to_" name="to_"
                                           value="{{!empty($_GET['to_']) ? $_GET['to_'] : $max}}"
                                           placeholder="أعلي سعر ج.م">
                                </div>
                                @php
                                    $maincats = \App\Models\Category::where('parent_id', null)->get();
                                @endphp
                                <div class="row mt-3" style="border-top: 2px solid #000; margin: auto" id="cats_row">
                                    <div class="form-group col-md-12 col-12 col-sm-12 mt-2" id="maincat_id_div">
                                        <label for="maincat_id" class="mb-1 bold">الفئة الرئيسية</label>
                                        <select class="form-control" id="maincat_id" name="maincat_id">
                                            @foreach($maincats as $item)
                                                <option
                                                    value="{{$item->id}}" {{$item->id == $maincat->id ? 'selected' : ''}}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-12 col-sm-12 mt-2" id="cat_id_div">
                                        <label for="cat_id" class="mb-1 bold">الفئة الفرعية</label>
                                        <select class="form-control" id="cat_id" name="cat_id">
                                            <option value="all" selected>الكل</option>
                                            @foreach($maincat->subCategories as $item)
                                                <option
                                                    value="{{$item->id}}" {{!empty($_GET['cat_id']) && $_GET['cat_id'] == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--<div class="row mt-3" style="border-top: 2px solid #000; margin: auto">-->
                                <!--    <div class="col-md-12 col-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12 col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="all" {{!empty($_GET['status']) &&  $_GET['status'] == 'all' || empty($_GET['status']) ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>الكل</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12  col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="paid" {{!empty($_GET['status']) &&  $_GET['status'] == 'paid' ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>إعلانات مدفوعة</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12 col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="free" {{!empty($_GET['status']) &&  $_GET['status'] == 'free' ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>إعلانات مجانية</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="row mt-3" style="border-top: 2px solid #000; margin: auto; display: none"
                                     id="all_check_div">
                                    <div class="col-md-12 px-4" style="text-align: right;">
                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                             style='margin-top: 15px;'>
                                            <input type='checkbox'
                                                   value='{{(isset($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '0' ? '0' : '1')}}'
                                                   name=''
                                                   class='inp_check all_check' {{(isset($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '0' ? '' : 'checked')}}>
                                            <div class='state p-success'>
                                                <!-- svg path -->
                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                    <path
                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                        style='stroke: white;fill:white;'></path>
                                                </svg>
                                                <label style='font-weight: bold'>جميع الخصائص</label>
                                                <input type="hidden" name="all_attrs_inp"
                                                       value="{{(!empty($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '1' || empty($_GET['all_attrs_inp'])  ? '1' : '0')}}"
                                                       id="all_attrs_inp">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3" id="adv_opts" style=" margin: auto; border-top: 2px solid #000;">
                                    @if(isset($attributes) && $attributes->count() > 0)
                                        @foreach($attributes as $item)
                                            @if($item->type == 'check')
                                                <div class="col-md-12 px-4" style="text-align: right;">
                                                    <div
                                                        class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                        style='margin-top: 15px;'
                                                        id='attr_single_'>

                                                        <input type='checkbox'
                                                               value='{{!empty($_GET['attrs'][$item->id]) && $_GET['attrs'][$item->id] == '1' ? '1' : '0'}}'
                                                               name='attrs[{{$item->id}}]'
                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id]) && $_GET['attrs'][$item->id] == '1' ? 'checked' : ''}}>
                                                        <div class='state p-success'>
                                                            <!-- svg path -->
                                                            <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                                <path
                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                    style='stroke: white;fill:white;'></path>
                                                            </svg>
                                                            <label style='font-weight: bold'>{{$item->title}}</label>
                                                        </div>
                                                    </div>
                                                </div>



                                            @else

                                                <div class="form-group col-md-12 col-12 attr_single mt-3">
                                                    <label style='font-weight: bold'>{{$item->title}}</label>
                                                    <select class="inp_select" name="attrs[{{$item->id}}]" id="">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach($item->options as $option)
                                                            <option
                                                                value="{{$option->id}}" {{!empty($_GET['attrs'][$item->id] && $_GET['attrs'][$item->id] == $option->id) && $_GET['all_attrs_inp'] != '1' ? 'selected' : ''}}>{{$option->val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            @endif

                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button class="btn filter_btn w-100">اعرض النتائج</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 mt-3 filter_btn_sec">
                        <div class="col-6 filter_btn_div" style="text-align: right">
                            <a href="javascript:void(0);" class="filters_btn bold l_20 p-r-10">
                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>
                                الفلاتر
                            </a>
                        </div>
                    </div>

                    <div class="col-md-9 col-12 col-sm-12 mt-3">
                        <div class="row" id="client_ads_cont">
                            @foreach($paid_client_ads_in_cat as $key => $item)
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
                                            <div id="wish_div" class="wish_div product_{{$item->id}}">
                                                <a href="{{url('login')}}">
                                                    <img src="{{asset('assets/front/images/heart.png')}}"
                                                         alt="wish-icon">
                                                </a>
                                            </div>
                                        @endif

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
                            @foreach($free_client_ads_in_cat as $key => $item)
                                <div class="col-md-4 col-6 col-sm-6 post my-2">
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
                                                    <img src="{{asset('assets/front/images/heart.png')}}"
                                                         alt="wish-icon">
                                                </a>
                                            </div>
                                        @endif
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

    @else
        <section class="client_ads_section client_ads_cat_section  text-center">
            <div class="container">
                <div class="row main_row">
                    <div class="col-md-12 col-12 col-sm-12 text-muted l_17 serial_url " style="text-align: right">
                        {{--                        <a href="#" class="cl-919191  l_14">{{$cat->mainCategory->title}}</a> ---}}

                        <a href="#" class="cl-919191 l_14">{{$maincat->title}} </a>
                    </div>
                    <div class="col-md-3 filters p-3">
                        <div class="bordered" style="text-align: right; position:relative;">
                            <div class="filters_dismiss">
                                <div class="filters_btn_dismiss">
                                    <div class="filters_container_dismiss">
                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss"
                                             style="width: 25px">
                                    </div>
                                </div>
                            </div>
                            <h4 class="bold l_20 my-3 p-r-20 p-t-20">
                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>
                                الفلاتر
                            </h4>
                            <form action="{{route('mainCat.show', $maincat->slug)}}" method="get" class="">
                                <input type="hidden" name="cat_id" value="{{$maincat->id}}">
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="from_" class="mb-2 bold">أقل سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="from_" name="from_"
                                           value="{{!empty($_GET['from_']) ? $_GET['from_'] : $min}}"
                                           placeholder="أقل سعر ج.م">
                                </div>
                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">
                                    <label for="to_" class="mb-2 bold">أعلي سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="to_" name="to_"
                                           value="{{!empty($_GET['to_']) ? $_GET['to_'] : $max}}"
                                           placeholder="أعلي سعر ج.م">
                                </div>
                                @php
                                    $maincats = \App\Models\Category::where('parent_id', null)->get();
                                @endphp
                                <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">
                                    <div class="form-group col-md-12 col-12 col-sm-12 mt-2" id="maincat_id_div">
                                        <label for="maincat_id" class="mb-1 bold">الفئة الرئيسية</label>
                                        <select class="form-control" id="maincat_id" name="maincat_id">i
                                            @foreach($maincats as $item)
                                                <option
                                                    value="{{$item->id}}" {{$item->id == $maincat->id ? 'selected' : ''}}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-12 col-sm-12 mt-2" id="cat_id_div">
                                        <label for="cat_id" class="mb-1 bold">الفئة الفرعية</label>
                                        <select class="form-control" id="cat_id" name="cat_id">
                                            <option value="all" selected>الكل</option>
                                            @foreach($maincat->subCategories as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--                                    <input type="hidden" id="">--}}
                                </div>
                                <!--<div class="row mt-3" style="border-top: 2px solid #000; margin: auto">-->
                                <!--    <div class="col-md-12 col-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12 col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="all" {{!empty($_GET['status']) &&  $_GET['status'] == 'all' || empty($_GET['status']) ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>الكل</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12  col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="paid" {{!empty($_GET['status']) &&  $_GET['status'] == 'paid' ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>إعلانات مدفوعة</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-12 px-4" style="text-align: right;">-->
                                <!--        <div class="pretty p-rotate p-svg p-curve col-md-12 col-12"-->
                                <!--             style='margin-top: 15px;'>-->
                                <!--            <input type="radio" name="status"-->
                                <!--                   value="free" {{!empty($_GET['status']) &&  $_GET['status'] == 'free' ? 'checked' : ''}}/>-->
                                <!--            <div class="state p-success">-->
                                <!--                <svg class='svg svg-icon' viewBox='0 0 20 20'>-->
                                <!--                    <path-->
                                <!--                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'-->
                                <!--                        style='stroke: white;fill:white;'></path>-->
                                <!--                </svg>-->
                                <!--                <label style='font-weight: bold'>إعلانات مجانية</label>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">
                                    <div class="col-md-12 px-4" style="text-align: right;">
                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                             style='margin-top: 15px;'>
                                            <input type='checkbox'
                                                   value='{{(isset($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '0' ? '0' : '1')}}'
                                                   name=''
                                                   class='inp_check all_check' {{(isset($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '0' ? '' : 'checked')}}>
                                            <div class='state p-success'>
                                                <!-- svg path -->
                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                    <path
                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                        style='stroke: white;fill:white;'></path>
                                                </svg>
                                                <label style='font-weight: bold'>جميع الخصائص</label>
                                                <input type="hidden" name="all_attrs_inp"
                                                       value="{{(!empty($_GET['all_attrs_inp']) && $_GET['all_attrs_inp'] == '1' || empty($_GET['all_attrs_inp'])  ? '1' : '0')}}"
                                                       id="all_attrs_inp">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3" id="adv_opts" style=" margin: auto; border-top: 2px solid #000;">
                                    @if(isset($attributes) && $attributes->count() > 0)
                                        @foreach($attributes as $item)
                                            @if($item->type == 'check')
                                                <div class="col-md-12 px-4" style="text-align: right;">
                                                    <div
                                                        class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                        style='margin-top: 15px;'
                                                        id='attr_single_'>

                                                        <input type='checkbox'
                                                               value='{{!empty($_GET['attrs'][$item->id]) && $_GET['attrs'][$item->id] == '1' ? '1' : '0'}}'
                                                               name='attrs[{{$item->id}}]'
                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id]) && $_GET['attrs'][$item->id] == '1' ? 'checked' : ''}}>
                                                        <div class='state p-success'>
                                                            <!-- svg path -->
                                                            <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                                <path
                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                    style='stroke: white;fill:white;'></path>
                                                            </svg>
                                                            <label style='font-weight: bold'>{{$item->title}}</label>
                                                        </div>
                                                    </div>
                                                </div>



                                            @else

                                                <div class="form-group col-md-12 col-12 attr_single mt-3">
                                                    <label style='font-weight: bold'>{{$item->title}}</label>
                                                    <select class="inp_select" name="attrs[{{$item->id}}]" id="">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach($item->options as $option)
                                                            <option
                                                                value="{{$option->id}}" {{!empty($_GET['attrs'][$item->id] && $_GET['attrs'][$item->id] == $option->id) && $_GET['all_attrs_inp'] != '1' ? 'selected' : ''}}>{{$option->val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            @endif

                                        @endforeach
                                    @endif
                                </div>


                                <div class="col-md-12 mt-4">
                                    <button class="btn filter_btn w-100">اعرض النتائج</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9 col-12 col-sm-12 mt-3">
                        <div class="row" id="client_ads_cont">
                            <h4>لا توجد إعلانات بعد في هذه الفئة </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif











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
            function get(name) {
                if (name = (new RegExp('[?&]' + encodeURIComponent(name) + '=([^&]*)')).exec(location.search))
                    return decodeURIComponent(name[1]);
            }

                {{--alert({{ $_GET['attrs'][6]}})--}}

            let check = get('cat_id');
            let check_adv = get('all_attrs_inp');

            // alert(check);
            if (typeof check !== 'undefined' && check !== 'all' || typeof check !== 'undefined' && check !== '') {
                $('#all_check_div').slideDown(500);
            } else {
                $('#adv_opts').slideUp(500);
            }

            // alert(check);
            if (typeof check_adv !== 'undefined' && check_adv !== '0') {
                $('#adv_opts').slideUp(500);

            } else {
                $('#adv_opts').slideDown(500);
            }

            $('#all_attrs_inp').val($('.all_check').val());
            // alert(check);
            let maincat_id = $('#maincat_id');
            maincat_id.change(function () {
                $('#cat_id_div').remove();
                let cat_id = maincat_id.val();
                $('#all_check_div').slideUp(500);
                // alert(cat_id);

                if (cat_id !== "") {
                    $("#adv_opts").slideUp(500);
                    $('#atts_div').remove();
                    $('#sub_cat_id_div').remove();

                    $.ajax({
                        url: "/get-child-cat/" + cat_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: cat_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            console.log(response.data);
                            let html_option = "";
                            let html_select = "<li data-value='' data-display=\"الكل\" class=\"option \">الكل</li>";

                            if (response.status === 1) {
                                let data = response.data;
                                data.forEach(myFunction);

                                function myFunction(item, index) {
                                    html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['title'][lang] + "</option>";
                                    html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['title'][lang] + "</li>";
                                }

                                // console.log(data[0]);
                                console.log(html_option);
                                let cats_row = $('#cats_row');
                                cats_row.append(
                                    "<div class=\"form-group col-md-12 col-12 mt-3  m-auto  \" id='cat_id_div'>\n" +
                                    " <label for=\"cat_id\" class=\"mb-1 bold\">الفئة الفرعية</label>\n" +
                                    "    <select class=\"form-control select2-hidden-accessible\" id=\"cat_id\" name=\"cat_id\" data-select2-id=\"select2-data-cat_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                    " <option value=''>اختر الفئة الفرعية</option>" +
                                    html_option +
                                    " </select>" +
                                    " </div>"
                                );

                                $('#cat_id').select2();
                                $('#cat_id_div').find('span.select2').css('width', '100%');

                            }
                            let cat_id = $('#cat_id');
                            cat_id.on('change', function () {
                                let cat_id_val = $(this).val();
                                // alert(cat_id_val);
                                $("#adv_opts").slideUp(500);
                                $('#atts_div').remove();
                                if (cat_id_val !== 'all') {
                                    $.ajax({
                                        url: "/get-cat-attrs/" + cat_id_val,
                                        data: {
                                            _token: "{{csrf_token()}}",
                                            id: cat_id_val,
                                        },
                                        type: "POST",
                                        success: function (response) {
                                            if (typeof (response) != 'object') {
                                                response = $.parseJSON(response)
                                            }
                                            // console.log(response.data['attributes'][0]['options']);
                                            let attrs = response.data['attributes'];
                                            // alert(attrs.length);
                                            let text_attr = '';
                                            let check_attr = '';
                                            let attr = '';
                                            console.log(attrs);

                                            for (let i = 0; i < attrs.length; i++) {
                                                if (attrs[i]['type'] === 'select') {
                                                    let opts = attrs[i]['options'];
                                                    let select_opts = '';
                                                    let select_opts_nice = '';
                                                    for (let x = 0; x < opts.length; x++) {
                                                        // console.log(opts[i]['val'][lang]);
                                                        select_opts += "<option value='" + opts[x]['id'] + "'>" + opts[x]['val'][lang] + "</option>";
                                                        select_opts_nice += "<li value='" + opts[x]['id'] + "' class=\"option\" data-value='" + opts[x]['id'] + "'  data-target='" + attrs[i]['id'] + "'>" + opts[x]['val'][lang] + "</li>";
                                                    }

                                                    attr +=
                                                        "<div class=\"form-group col-md-12 col-12 attr_single mt-3\" id=\"attr_single_" + i + "\">\n" +
                                                        // "  <label style=\"font-weight: bold\" for=\"attr_" + attrs[i]['id'] + "\" class=\"mb-2\"> " + attrs[i]['title'][lang] + "\n" +
                                                        // "  </label>\n" +
                                                        " <select class=\"inp_select\" data-target='" + attrs[i]['id'] + "' id=\"attr_" + i + "\" name=\"attrs[" + attrs[i]['id'] + "]\" required=\"\" style=\"display: none;\">\n" +
                                                        "  <option value=\"all\" selected>اختر " + attrs[i]['title'][lang] + "</option>\n" +
                                                        select_opts +
                                                        "  </select>\n" +
                                                        "  <div class=\"nice-select\" tabindex=\"0\"><span class=\"current\">اختر " + attrs[i]['title'][lang] + "</span>\n" +
                                                        "  <ul class=\"list attr_select_list\">\n" +
                                                        "  <li data-value=\"\" class=\"option selected focus \" data-target='attr_" + attrs[i]['id'] + "'>اختر " + attrs[i]['title'][lang] + "</li>\n" +
                                                        select_opts_nice +
                                                        "  </ul>\n" +
                                                        "</div>\n" +
                                                        "  </div>";
                                                    // console.log(select_opts);
                                                } else {
                                                    attr +=
                                                        "<div class=\"col-md-12 px-3 mt-2\" style=\"text-align: right;\">" +
                                                        "<div class='pretty p-rotate p-svg p-curve col-md-12 mt-3 col-12  mb-4 attr_single' " +
                                                        "   id='attr_single_" + i + "'>" +
                                                        "   <input type='checkbox' id='attr_" + i + "' value='0' data-target='" + attrs[i]['id'] + "' name='attrs[" + attrs[i]['id'] + "]'" +
                                                        "  class='inp_check attr_check_box'>" +
                                                        "  <div class='state p-success'>" +
                                                        "   <!-- svg path -->" +
                                                        "    <svg class='svg svg-icon' viewBox='0 0 20 20'>" +
                                                        "   <path" +
                                                        "   d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'" +
                                                        "  style='stroke: white;fill:white;'></path>" +
                                                        "  </svg>" +
                                                        "  <label style='font-weight: bold'>" + attrs[i]['title'][lang] + "</label>" +
                                                        " </div>" +
                                                        "  </div>" +
                                                        "  </div>";
                                                }

                                            }


                                            $('#adv_opts').append(
                                                "<div class=\"row pt-3 m-auto\" id=\"atts_div\">" +
                                                attr +
                                                "</div>"
                                            );
                                            $('#all_check_div').slideDown(500);
                                            // $('#all_attrs_inp').val($('.all_check').val());


                                            // $('.attr_check_box').change(function () {
                                            //     if (this.checked) {
                                            //         // attr_check.prop('checked', false);
                                            //         $(this).val('1');
                                            //         // $('#all_attrs_inp').val('1');
                                            //     } else {
                                            //         $(this).val('0');
                                            //         // $('#all_attrs_inp').val('0');
                                            //
                                            //     }
                                            // });
                                            $('.attr_check_box').change(function () {
                                                if (this.checked) {
                                                    // attr_check.prop('checked', false);
                                                    $(this).val('1');
                                                    // $('#all_attrs_inp').val('1');
                                                } else {
                                                    $(this).val('0');
                                                    // $('#all_attrs_inp').val('0');

                                                }
                                            });

                                        }
                                    });
                                }

                            });
                        }

                    });
                } else {
                    $('#cat_id').val('all').trigger('change');
                    $('#cat_id').prop('disabled', true);
                    // $('#sub_cat_id_div').attr('disabled', true);
                    // $('#sub_cat_id_div').find('.nice-select').addClass('disabled');
                }
            });

            let cat_id = $('#cat_id');
            cat_id.on('change', function () {
                let cat_id_val = $(this).val();
                // alert(cat_id_val);
                $("#adv_opts").slideUp(500);
                $('#atts_div').remove();
                if (cat_id_val !== 'all') {
                    $.ajax({
                        url: "/get-cat-attrs/" + cat_id_val,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: cat_id_val,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data['attributes'][0]['options']);
                            let attrs = response.data['attributes'];
                            // alert(attrs.length);
                            let text_attr = '';
                            let check_attr = '';
                            let attr = '';
                            console.log(attrs);

                            for (let i = 0; i < attrs.length; i++) {
                                if (attrs[i]['type'] === 'select') {
                                    let opts = attrs[i]['options'];
                                    let select_opts = '';
                                    let select_opts_nice = '';
                                    for (let x = 0; x < opts.length; x++) {
                                        // console.log(opts[i]['val'][lang]);
                                        select_opts += "<option value='" + opts[x]['id'] + "'>" + opts[x]['val'][lang] + "</option>";
                                        select_opts_nice += "<li value='" + opts[x]['id'] + "' class=\"option\" data-value='" + opts[x]['id'] + "'  data-target='" + attrs[i]['id'] + "'>" + opts[x]['val'][lang] + "</li>";
                                    }

                                    attr +=
                                        "<div class=\"form-group col-md-12 col-12 attr_single mt-3\" id=\"attr_single_" + i + "\">\n" +
                                        // "  <label style=\"font-weight: bold\" for=\"attr_" + attrs[i]['id'] + "\" class=\"mb-2\"> " + attrs[i]['title'][lang] + "\n" +
                                        // "  </label>\n" +
                                        " <select class=\"inp_select\" data-target='" + attrs[i]['id'] + "' id=\"attr_" + i + "\" name=\"attrs[" + attrs[i]['id'] + "]\" required=\"\" style=\"display: none;\">\n" +
                                        "  <option value=\"all\" selected>اختر " + attrs[i]['title'][lang] + "</option>\n" +
                                        select_opts +
                                        "  </select>\n" +
                                        "  <div class=\"nice-select\" tabindex=\"0\"><span class=\"current\">اختر " + attrs[i]['title'][lang] + "</span>\n" +
                                        "  <ul class=\"list attr_select_list\">\n" +
                                        "  <li data-value=\"\" class=\"option selected focus \" data-target='attr_" + attrs[i]['id'] + "'>اختر " + attrs[i]['title'][lang] + "</li>\n" +
                                        select_opts_nice +
                                        "  </ul>\n" +
                                        "</div>\n" +
                                        "  </div>";
                                    // console.log(select_opts);
                                } else {
                                    attr +=
                                        "<div class=\"col-md-12 px-3 mt-2\" style=\"text-align: right;\">" +
                                        "<div class='pretty p-rotate p-svg p-curve col-md-12 mt-3 col-12  mb-4 attr_single' " +
                                        "   id='attr_single_" + i + "'>" +
                                        "   <input type='checkbox' id='attr_" + i + "' value='0' data-target='" + attrs[i]['id'] + "' name='attrs[" + attrs[i]['id'] + "]'" +
                                        "  class='inp_check attr_check_box'>" +
                                        "  <div class='state p-success'>" +
                                        "   <!-- svg path -->" +
                                        "    <svg class='svg svg-icon' viewBox='0 0 20 20'>" +
                                        "   <path" +
                                        "   d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'" +
                                        "  style='stroke: white;fill:white;'></path>" +
                                        "  </svg>" +
                                        "  <label style='font-weight: bold'>" + attrs[i]['title'][lang] + "</label>" +
                                        " </div>" +
                                        "  </div>" +
                                        "  </div>";

                                }

                            }


                            $('#adv_opts').append(
                                "<div class=\"row pt-3 m-auto\" id=\"atts_div\">" +
                                attr +
                                "</div>"
                            );
                            $('#all_check_div').slideDown(500);

                            $('.attr_check_box').change(function () {
                                if (this.checked) {
                                    // attr_check.prop('checked', false);
                                    $(this).val('1');
                                    // $('#all_attrs_inp').val('1');
                                } else {
                                    $(this).val('0');
                                    // $('#all_attrs_inp').val('0');

                                }
                            });

                        }
                    });
                }

            });


            $(".all_check").change(function () {
                if (this.checked) {
                    //Do stuff
                    // alert('checked')
                    $('#adv_opts').slideUp(500);


                } else {
                    // alert('un checked')
                    $('#adv_opts').slideDown(500);


                }
            });


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

            let attr_check = $('.attr_check');
            let all_check = $('.all_check');
            attr_check.on('click', function () {
                all_check.prop('checked', false);
                all_check.val('0')
            });
            all_check.change(function () {
                if (this.checked) {
                    attr_check.prop('checked', false);
                    $(this).val('1');
                    $('#all_attrs_inp').val('1');
                } else {
                    $(this).val('0');
                    $('#all_attrs_inp').val('0');

                }
            });
            // $('#all_attrs_inp').val(all_check.val());


            let img_wid = $('.client_ad_cover img');
            let div_wid = $('.client_ad_cover');

            if (parseInt(div_wid.width()) < parseInt(img_wid.width())) {
                // alert('yes');
                img_wid.css('width', div_wid.width());
            }
            const lang = $('#lang').val();

            $('.inp_check').on('click', function () {
                // alert('test0');
                let check_val = $(this);
                if (check_val.val() === '0') {

                    check_val.val(1);
                } else {
                    check_val.val(0);
                }
            });
            // let check_val = $('.inp_check').val();
            // if (check_val === 1) {
            //     $(this).prop('checked', true);
            //
            // }

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
        });
    </script>
@stop

