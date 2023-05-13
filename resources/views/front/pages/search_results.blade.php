@extends('front.layouts.master')

@section('styles')
    <style>
        .nice-select {
            line-height: 28px !important;
        }

        #adv_opts_cont .nice-select {
            width: 100%;
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
                    <div class="col-md-12 col-12 col-sm-12 text-muted l_17 serial_url "  style="text-align: right">
                        <a href="#" class="cl-919191  l_14">{{$cat->mainCategory->title}}</a> -

                        <a href="#" class="cl-919191 l_14">{{$cat->title}} </a>
                    </div>

                    <div class="col-md-3 filters p-3">
                        <div class="bordered" style="text-align: right; position:relative;">
                            <div class="filters_dismiss">
                                <div class="filters_btn_dismiss">
                                    <div class="filters_container_dismiss">
                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">
                                    </div>
                                </div>
                            </div>
                            <h4 class="bold l_20 my-3 p-r-20  p-t-20">
                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>
                                البحث
                            </h4>

                            <form action="{{route('search.results')}}" method="get" class="">
                                <input type="hidden" name="subcat" value="{{$cat->id}}">
                                <input type="hidden" name="cat" value="{{!empty($_GET['cat']) ? $_GET['cat'] : ''}}">
                                <input type="hidden" name="sort" value="{{!empty($_GET['sort']) ? $_GET['sort'] : 'cr_desc'}}">
                                <input type="hidden" name="adv" value="{{!empty($_GET['adv']) ? $_GET['adv'] : '0'}}" id="adv">
                                @php
                                    $countries = \App\Models\Location::where('parent_id', null)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3 " id="country_row">
                                    <label for="country" class="mb-2 bold">المحافظة
                                    </label>
                                    <select class="form-control" id="country" name="country">
                                        @if(!empty($_GET['country']) && $_GET['country'] == 'all')
                                            <option value="all" selected>الكل</option>
                                        @elseif(!empty($_GET['country']) && $_GET['country'] != 'all')
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{$country->id == $_GET['country'] ? 'selected' : ''}}>{{$country->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @php
                                    $cities = \App\Models\Location::where('parent_id', $country_id)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3" id="city_id_div">
                                    <label for="city" class="mb-2 bold">المدينة
                                    </label>
                                    <select class="form-control" id="city" name="city" {{!empty($_GET['city']) && $_GET['city'] == 'all' ? '' : ''}}>
                                        @if(!empty($_GET['city']) && $_GET['city'] == 'all')
                                        <option value="all" selected>الكل</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" >{{$city->name}}</option>
                                            @endforeach
                                        @elseif(!empty($_GET['city']) && $_GET['city'] != 'all')
                                            <option value="all" >الكل</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{$city->id == $_GET['city'] ? 'selected' : ''}}>{{$city->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @php
                                    $states = \App\Models\Location::where('parent_id', $city_id)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3" id="state_id_div">
                                    <label for="state" class="mb-2 bold">الحي / المركز
                                    </label>

                                    @if(!empty($_GET['city']) && $_GET['city'] != 'all')
                                        <select class="form-control" id="state" name="state">
                                            @if(!empty($_GET['state']) && $_GET['state'] == 'all')
                                                <option value="all" selected>الكل</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" >{{$state->name}}</option>
                                                @endforeach
                                            @elseif(!empty($_GET['state']) && $_GET['state'] != 'all')
                                                <option value="all" >الكل</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{$state->id == $_GET['state'] ? 'selected' : ''}}>{{$state->name}}</option>
                                                @endforeach
                                            @else
                                                <option value="all" selected>الكل</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" >{{$state->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <select class="form-control" id="state" name="state" disabled>
                                                <option value="all" selected>الكل</option>
                                        </select>

                                    @endif

                                </div>
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="from_" class="mb-2 bold">أقل سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="from_" name="from_"
                                           value="{{!empty($_GET['from']) ? $_GET['from'] : $min}}" placeholder="أقل سعر ج.م">
                                </div>
                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">
                                    <label for="to_" class="mb-2 bold">أعلي سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="to_" name="to_"
                                           value="{{!empty($_GET['to']) ? $_GET['to'] : $max}}" placeholder="أعلي سعر ج.م">
                                </div>

                                @if(isset($attributes) && $attributes->count() > 0)
                                    @foreach($attributes as $item)
                                        @if($item->type == 'check')
                                            <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">
                                                <div class="col-md-12 px-4" style="text-align: right;">
                                                    <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                         style='margin-top: 15px;'
                                                         id='attr_single_'>
                                                        <input type='checkbox' value='{{!empty($_GET['attrs'][$item->id . '-1']) ? '1' : '0'}}' name='attrs[{{$item->id}}-1]'
                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id . '-1']) ? 'checked' : ''}}>
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
                                            </div>
                                        @else
                                            <div class="row mt-3 opt_container" style="border-top: 2px solid #000; margin: auto">
                                                <div class="col-md-12 col-12" style="text-align: right">
                                                    <h4 class="bold l_20 mt-3 p-r-4"> {{$item->title}} </h4>
                                                </div>
                                                @foreach($item->options as $option)
                                                    <div class="col-md-12 px-4 " style="text-align: right;">
                                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                             style='margin-top: 15px;'
                                                             id='attr_single_'>
{{--                                                            {{$request->attr_select_.$item->id[$option->id] && $request->attr_select_.$item->id[$option->id] ==  '1' ? '1' : '0'}}--}}
                                                            <input type='checkbox' value='{{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 1 : 0}}' name='attrs[{{$item->id}}-{{$option->id}}]'
                                                                   class='inp_check attr_check' {{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 'checked' : ''}}>
{{--                                                            {{dd($_GET['attrs[' . $item->id . '-' . $option->id].']')}}--}}
                                                            <div class='state p-success'>
                                                                <!-- svg path -->
                                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                                    <path
                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                        style='stroke: white;fill:white;'></path>
                                                                </svg>
                                                                <label
                                                                    style='font-weight: bold'>{{$option->val}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    @endforeach
                                @endif
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
                                البحث

                            </a>
                        </div>
                    </div>

                    <div class="col-md-9 search_result_div col-12 col-sm-12 mt-3">
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
        <section class="client_ads_section text-center">
            <div class="container">
                <div class="row mt-5 text-center">
                    <div class="col-md-3 filters p-3">
                        <div class="bordered" style="text-align: right; position:relative;">
                            <div class="filters_dismiss">
                                <div class="filters_btn_dismiss">
                                    <div class="filters_container_dismiss">
                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">
                                    </div>
                                </div>
                            </div>
                            <h4 class="bold l_20 my-3 p-r-20  p-t-20">
                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>
                                البحث
                            </h4>

                            <form action="{{route('search.results')}}" method="get" class="">
                                <input type="hidden" name="subcat" value="{{$cat->id}}">
                                <input type="hidden" name="cat" value="{{!empty($_GET['cat']) ? $_GET['cat'] : ''}}">
                                <input type="hidden" name="sort" value="{{!empty($_GET['sort']) ? $_GET['sort'] : 'cr_desc'}}">
                                <input type="hidden" name="adv" value="{{!empty($_GET['adv']) ? $_GET['adv'] : '0'}}">
                                @php
                                    $countries = \App\Models\Location::where('parent_id', null)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="country" class="mb-2 bold">المحافظة
                                    </label>
                                    <select class="form-control" id="country" name="country">
                                        @if(!empty($_GET['country']) && $_GET['country'] == 'all')
                                            <option value="all">الكل</option>
                                        @elseif(!empty($_GET['country']) && $_GET['country'] != 'all')
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{$country->id == $_GET['country'] ? 'selected' : ''}}>{{$country->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @php
                                    $cities = \App\Models\Location::where('parent_id', $country_id)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="city" class="mb-2 bold">المدينة
                                    </label>
                                    <select class="form-control" id="city" name="city" {{!empty($_GET['city']) && $_GET['city'] == 'all' ? 'disabled' : ''}}>
                                        @if(!empty($_GET['city']) && $_GET['city'] == 'all')
                                            {{dd('test')}}
                                            <option value="all" selected>الكل</option>
                                        @elseif(!empty($_GET['city']) && $_GET['city'] != 'all')
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{$city->id == $_GET['city'] ? 'selected' : ''}}>{{$city->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @php
                                    $states = \App\Models\Location::where('parent_id', $city_id)->get();
                                @endphp
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="state" class="mb-2 bold">الحي / المركز
                                    </label>
                                    <select class="form-control" id="state" name="state" {{!empty($_GET['state']) && $_GET['state'] == 'all' ? 'disabled' : ''}}>
                                        @if(!empty($_GET['state']) && $_GET['state'] == 'all')
                                            <option value="all" selected>الكل</option>
                                        @elseif(!empty($_GET['state']) && $_GET['state'] != 'all')
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" {{$state->id == $_GET['state'] ? 'selected' : ''}}>{{$state->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-12 px-2 mt-3">
                                    <label for="from_" class="mb-2 bold">أقل سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="from_" name="from_"
                                           value="{{!empty($_GET['from']) ? $_GET['from'] : $min}}" placeholder="أقل سعر ج.م">
                                </div>
                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">
                                    <label for="to_" class="mb-2 bold">أعلي سعر
                                        <span class="text-muted">ج.م </span>
                                    </label>
                                    <input type="number" class="form-control" id="to_" name="to_"
                                           value="{{!empty($_GET['to']) ? $_GET['to'] : $max}}" placeholder="أعلي سعر ج.م">
                                </div>

                                @if(isset($attributes) && $attributes->count() > 0)
                                    @foreach($attributes as $item)
                                        @if($item->type == 'check')
                                            <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">
                                                <div class="col-md-12 px-4" style="text-align: right;">
                                                    <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                         style='margin-top: 15px;'
                                                         id='attr_single_'>
                                                        <input type='checkbox' value='{{!empty($_GET['attrs'][$item->id . '-1']) ? '1' : '0'}}' name='attrs[{{$item->id}}-1]'
                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id . '-1']) ? 'checked' : ''}}>
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
                                            </div>
                                        @else
                                            <div class="row mt-3 opt_container" style="border-top: 2px solid #000; margin: auto">
                                                <div class="col-md-12 col-12" style="text-align: right">
                                                    <h4 class="bold l_20 mt-3 p-r-4"> {{$item->title}} </h4>
                                                </div>
                                                @foreach($item->options as $option)
                                                    <div class="col-md-12 px-4" style="text-align: right;">
                                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'
                                                             style='margin-top: 15px;'
                                                             id='attr_single_'>
                                                            {{--                                                            {{$request->attr_select_.$item->id[$option->id] && $request->attr_select_.$item->id[$option->id] ==  '1' ? '1' : '0'}}--}}
                                                            <input type='checkbox' value='{{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 1 : 0}}' name='attrs[{{$item->id}}-{{$option->id}}]'
                                                                   class='inp_check attr_check' {{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 'checked' : ''}}>
                                                            {{--                                                            {{dd($_GET['attrs[' . $item->id . '-' . $option->id].']')}}--}}
                                                            <div class='state p-success'>
                                                                <!-- svg path -->
                                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>
                                                                    <path
                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                        style='stroke: white;fill:white;'></path>
                                                                </svg>
                                                                <label
                                                                    style='font-weight: bold'>{{$option->val}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    @endforeach
                                @endif
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




            let country = $('select#country');
            let country_row = $('#country_row');
            country.on("select2:select", function (e) {
                let country_id = $(this).val();
                // alert(country_id);
                if (country_id !== "") {
                    $('#city_id_div').remove();
                    $('#state').prop('disabled', true);
                    $('#state').val("all").change();
                    // $("div.id_100 select").val("val2").change();

                    $.ajax({
                        url: "/get-child-city/" + country_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: country_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            console.log(response.data);
                            let html_option = "";
                            let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";

                            if (response.status === 1) {
                                let data = response.data;
                                data.forEach(myFunction);

                                function myFunction(item, index) {
                                    html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";
                                    html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";
                                }

                                // console.log(data[0]);
                                console.log(html_option);

                                // country_row.append(
                                //     "<div class=\"form-group col-md-4 \" id='city_id_div'>\n" +
                                //     " <label for=\"city_id\" class=\"mb-2 bold\">المدينة</label>\n" +
                                //     " <select class=\"form-control select2-hidden-accessible\" id=\"city_id\" name=\"city_id\" data-select2-id=\"select2-data-city_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                //     " <option value='all'>الكل</option>" +
                                //     html_option +
                                //     " </select>" +
                                //     " </div>"
                                // );

                                $("<div class=\"form-group col-md-12 col-12 px-2 mt-3 \" id='city_id_div'>\n" +
                                    " <label for=\"city\" class=\"mb-1 bold\">المدينة</label>\n" +
                                    " <select class=\"form-control select2-hidden-accessible\" id=\"city\" name=\"city\" data-select2-id=\"select2-data-city\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                    " <option value='all'>الكل</option>" +
                                    html_option +
                                    " </select>" +
                                    " </div>").insertAfter('#country_row');

                                $('#city').select2();
                                $('#city_id_div').find('span.select2').css('width', '100%');

                                let city_id = $('select#city');
                                city_id.on("select2:select", function (e) {
                                    let city_id = $(this).val();
                                    // alert(city_id);
                                    if (city_id !== "all") {
                                        $('#state_id_div').remove();
                                        $.ajax({
                                            url: "/get-child-state/" + city_id,
                                            data: {
                                                _token: "{{csrf_token()}}",
                                                id: city_id,
                                            },
                                            type: "POST",
                                            success: function (response) {
                                                if (typeof (response) != 'object') {
                                                    response = $.parseJSON(response)
                                                }
                                                console.log(response.data);
                                                let html_option = "";
                                                let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";

                                                if (response.status === 1) {
                                                    let data = response.data;
                                                    data.forEach(myFunction);

                                                    function myFunction(item, index) {
                                                        html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";
                                                        html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";
                                                    }

                                                    // console.log(data[0]);
                                                    console.log(html_option);

                                                    $(
                                                        "<div class=\"form-group  col-md-12 col-12 px-2 mt-3 \" id='state_id_div'>\n" +
                                                        " <label for=\"state\" class=\"mb-1 bold\">الحي / المركز</label>\n" +
                                                        " <select class=\"form-control select2-hidden-accessible\" id=\"state\" name=\"state\" data-select2-id=\"select2-data-state\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                                        " <option value='all'>الكل</option>" +
                                                        html_option +
                                                        " </select>" +
                                                        " </div>"
                                                    ).insertAfter('#city_id_div');
                                                    $('#state').select2();
                                                    $('#state_id_div').find('span.select2').css('width', '100%');
                                                }
                                            }
                                        });
                                    } else {
                                        $('#state').prop('disabled', true);
                                        $('#state').val('all').trigger('change');

                                    }

                                });

                            } else {

                            }
                        }
                    });


                } else {

                    $('#state_id').val('all').trigger('change');
                    $('#city_id').val('all').trigger('change');
                    $('#city_id').prop('disabled', true);
                    $('#state_id').prop('disabled', true);

                }

            });



            let opt_container = $('.opt_container');
            opt_container.find('input').on('change', function () {
                $(this).parent().parent().parent().find('input').prop('checked', false);
                $(this).parent().parent().parent().find('input').val('0');
                // opt_container.find('input').prop('checked', false);
                $(this).prop('checked', true);
                $(this).val('1');
                // $(this).prop('checked', true);
                $('#adv').val('1');
            });


            $('#country').select2();
            $('#city').select2();
            $('#state').select2();


            let client_ads_cont = $('#client_ads_cont');
            let width_c = client_ads_cont.width();
            let post = $('.post');
            let count = post.length;
            // alert(count);
            let height_ = post.height() + 16;
            let width_ = post.width();
            let count_in_row = Math.floor(width_c / width_);
            // alert(count_in_row);
            client_ads_cont.height((6/count_in_row * height_));


            let see_more = $('#see_more');
            see_more.on('click', function () {
                let visible_posts_count = client_ads_cont.height() / height_;
                let hidden_posts_count = Math.floor(Math.ceil(count/count_in_row) - visible_posts_count);
                // alert(12/count_in_row);
                // alert(Math.ceil(count/count_in_row));
                // alert(hidden_posts_count);
                if (hidden_posts_count > 3) {
                    // alert('test');
                    client_ads_cont.height(client_ads_cont.height() + (height_* 3));
                } else if (hidden_posts_count === 3){
                    // alert('not');
                    client_ads_cont.height(client_ads_cont.height() + (height_* 3));
                    see_more.remove();
                } else if (hidden_posts_count === 2) {
                    client_ads_cont.height(client_ads_cont.height() + (height_* 2));
                    see_more.remove();
                } else {
                    client_ads_cont.height(client_ads_cont.height() + (height_* 1));
                    see_more.remove();
                }
            });

            let attr_check = $('.attr_check');
            let all_check = $('.all_check');
            attr_check.on('click', function () {
                all_check.prop('checked', false);
                all_check.val('0')
            });
            all_check.change(function() {
                if(this.checked) {
                    attr_check.prop('checked', false);
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });


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
                                dangerMode: false,
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

