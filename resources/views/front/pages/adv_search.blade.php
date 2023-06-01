@extends('front.layouts.master')

@section('styles')
    <style>

    </style>
@stop

@section('content')



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

                    <span class="bold">البحث المتقدم</span>


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

    {{--    Start Featured Cats--}}
    <section class="featured-section pb-5 text-center">
        <div class="container card p-4 pt-2" style="max-width: 1044px;">
            <div class="row mb-3 ">
                <div class="col-md-6 col-sm-6 col-12 text-right">
                    <h3 class="bold">اجراء بحث متقدم...</h3>
                </div>
            </div>

            <form action="{{route('new.adv.search.get')}}" class="pb-3">
                <input type="hidden" name="new_main_cat_id"
                       value="{{!empty($_GET['new_main_cat_id']) ? $_GET['new_main_cat_id'] : ''}}">
                <input type="hidden" name="new_sub_cat_id"
                       value="{{!empty($_GET['new_sub_cat_id']) ? $_GET['new_sub_cat_id'] : ''}}">
                <div class="row ">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xm-12 col-12 text-right p-0 main_item_filter position-relative "
                        id="client_ad_place">
                        <div class="main_head py-3 pe-3" data-target="subs_for_location">
                            <h4 class="bold l_17 d-inline-block">مكان تواجد الإعلان</h4>
                        </div>
                        <div class="sub_menu subs_for_location pl-2 mt-1" style="display: block;">
                            @php
                                $locations = \App\Models\Location::where('parent_id', null)->get();
                            @endphp

                            <div class="row px-3">
                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 px-2">
                                    <select class="form-control" id="new_country_id" name="new_country_id"
                                            style="width: 100%">
                                        <option value="">اختر المكان</option>
                                        @foreach($locations as $item)
                                            <option
                                                value="{{$item->id}}" {{isset($_GET['new_country_id']) &&  $_GET['new_country_id'] == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 px-2"
                                     id="new_city_id_div"
                                     disabled="">
                                    <select class="form-control" id="new_city_id" name="new_city_id"
                                            {{!empty($_GET['new_country_id']) ? '' : 'disabled'}}
                                            style="width: 100%">
                                        @if(!empty($_GET['new_country_id']))
                                            @php
                                                $cities = \App\Models\Location::select('id', 'name', 'parent_id')->where('parent_id', $_GET['new_country_id'])->get();
                                            @endphp
                                            <option value="all">الكل</option>
                                            @foreach($cities as $city)
                                                <option
                                                    value="{{$city->id}}" {{!empty($_GET['new_city_id']) &&  $_GET['new_city_id'] == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="all">الكل</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xm-12 col-12 text-right p-0  main_item_filter position-relative"
                        id="price_filter">
                        <div class="main_head py-3 pe-3" data-target="subs_for_price">
                            <h4 class="bold l_17 d-inline-block">السعر (جنيه)</h4>
                        </div>
                        <div class="sub_menu subs_for_price pl-2 mt-1" style="display: block;">
                            <div class="row px-3">
                                <div
                                    class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_from_ px-2">
                                    <div class="input-group mb-3" dir="ltr">
                                        <span class="input-group-text bound " id="new_from_label">جنيه</span>
                                        <input type="number" class="form-control text-right" name="new_from_"
                                               style="border-left: none"
                                               value="{{isset($_GET['new_from_']) && $_GET['new_from_'] != null ? $_GET['new_from_'] : ''}}"
                                               placeholder="السعر من" aria-label="السعر من"
                                               aria-describedby="new_from_label">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_to_ px-2">
                                    <div class="input-group mb-3" dir="ltr">
                                        <span class="input-group-text bound " id="new_to_label">جنيه</span>
                                        <input type="number" class="form-control text-right" name="new_to_"
                                               style="border-left: none"
                                               value="{{isset($_GET['new_to_']) && $_GET['new_to_'] != null ? $_GET['new_to_'] : ''}}"
                                               placeholder="السعر إلي" aria-label="السعر إلي"
                                               aria-describedby="new_to_label">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                @if(isset($main_attributes) && $main_attributes->count() > 0)
                    @foreach($main_attributes as $main_item)
                        @if($main_item->attribute->appearance == 'select')
                            @if($main_item->type_of == 'with_options')

                                    <div
                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->id}}">
                                            <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                            <span class="toggle_icons">
                                                <i class="fa fa-chevron-left"></i>
                                                <i class="fa fa-chevron-down d-none"></i>
                                             </span>
                                        </div>
                                        <div class="sub_menu subs_for_{{$main_item->id}} pl-2 mb-3">

                                            <ul class="row"
                                                style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">
                                                @foreach($main_item->attribute->options as $option)
                                                    <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">
                                                        {{--                                                                    {{dd($children_attributes)}}--}}
                                                        <div class='pretty p-rotate p-svg p-curve main_toggle_item'
                                                             style='text-align:right; padding-right:20px;'>
                                                            <input type='checkbox'
                                                                   name="attrs[{{$main_item->attribute->id}}][]"
                                                                   class='inp_check'
                                                                   value="{{$option->id}}"
                                                                {{!empty($_GET['attrs'][$main_item->attribute->id]) && in_array($option->id, $_GET['attrs'][$main_item->attribute->id]) ? 'checked' : ''}}
                                                            >
                                                            <div class='state p-warning'>
                                                                <!-- svg path -->
                                                                <svg class='svg svg-icon'
                                                                     viewBox='0 0 20 20'>
                                                                    <path
                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                        style='stroke: white;fill:white;'></path>
                                                                </svg>
                                                                <label
                                                                    style='font-size: 13px; font-weight: bold!important;'>{{$option->val}}</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                            @elseif ($main_item->type_of == 'yes_no')

                                    <div
                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->id}}">
                                            <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                            <span class="toggle_icons">
                                        <i class="fa fa-chevron-left"></i>
                                        <i class="fa fa-chevron-down d-none"></i>
                                    </span>
                                        </div>
                                        <div class="sub_menu subs_for_{{$main_item->id}} pl-2 mb-3">

                                            <ul class="row"
                                                style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">

                                                <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">
                                                    {{--                                                                    {{dd($children_attributes)}}--}}
                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'
                                                         style='text-align:right; padding-right:20px;'>
                                                        <input type='radio' id="{{$main_item->attribute->id}}_1"
                                                               name="attrs_yes_no[{{$main_item->attribute->id}}]"
                                                               class='inp_check'
                                                               value="1"
                                                            {{!empty($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == 1 ? 'checked' : ''}}
                                                        >
                                                        <div class='state p-warning'>
                                                            <!-- svg path -->
                                                            <svg class='svg svg-icon'
                                                                 viewBox='0 0 20 20'>
                                                                <path
                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                    style='stroke: white;fill:white;'></path>
                                                            </svg>
                                                            <label
                                                                style='font-size: 13px; font-weight: bold!important;'
                                                                for="{{$main_item->attribute->id}}_1">نعم</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">
                                                    {{--                                                                    {{dd($children_attributes)}}--}}
                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'
                                                         style='text-align:right; padding-right:20px;'>
                                                        <input type='radio' id="{{$main_item->attribute->id}}_0"
                                                               name="attrs_yes_no[{{$main_item->attribute->id}}]"
                                                               class='inp_check'
                                                               value="0"
                                                            {{!empty($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == 0 ? 'checked' : ''}}

                                                        >
                                                        <div class='state p-warning'>
                                                            <!-- svg path -->
                                                            <svg class='svg svg-icon'
                                                                 viewBox='0 0 20 20'>
                                                                <path
                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                    style='stroke: white;fill:white;'></path>
                                                            </svg>
                                                            <label
                                                                style='font-size: 13px; font-weight: bold!important;'
                                                                for="{{$main_item->attribute->id}}_0">لا</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                            @endif
                        @elseif($main_item->attribute->appearance == 'buttons')
                            @if($main_item->type_of == 'with_options')

                                    <div
                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->id}}">
                                            <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                            <span class="toggle_icons">
                                        <i class="fa fa-chevron-left"></i>
                                        <i class="fa fa-chevron-down d-none"></i>
                                    </span>
                                        </div>
                                        <div class="sub_menu subs_for_{{$main_item->id}} pl-2 mb-3">

                                            <div class="row custom_btn_rows"
                                                 style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">
                                                @foreach($main_item->attribute->options as $option)
                                                    <div
                                                        class="col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-4 ">
                                                        <label
                                                            for="opt_{{$option->id}}"
                                                            class="btn my-2 custom_select_btn
{{!empty($_GET['attrs'][$main_item->attribute->id]) && in_array($option->id, $_GET['attrs'][$main_item->attribute->id]) ? 'selected' : ''}}">{{$option->val}}</label>
                                                        <input type="checkbox"
                                                               name="attrs[{{$main_item->attribute->id}}][]"
                                                               id="opt_{{$option->id}}"
                                                               value="{{$option->id}}"
                                                               class="d-none main_btn_answer"
                                                            {{!empty($_GET['attrs'][$main_item->attribute->id]) && in_array($option->id, $_GET['attrs'][$main_item->attribute->id]) ? 'checked' : ''}}
                                                        >

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            @elseif ($main_item->type_of == 'yes_no')
                                    <div
                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                        <div class="main_head py-3 pe-3"
                                             data-target="subs_for_{{$main_item->attribute->id}}">
                                            <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                            <span class="toggle_icons">
                                        <i class="fa fa-chevron-left"></i>
                                        <i class="fa fa-chevron-down d-none"></i>
                                    </span>
                                        </div>
                                        <div class="sub_menu subs_for_{{$main_item->attribute->id}} pl-2 mb-3">

                                            <div class="row custom_btn_rows"
                                                 style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">

                                                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 ">
                                                    <label
                                                        for="opt_{{$main_item->attribute->id}}_yes"
                                                        class="btn my-2 custom_select_btn_radio
                                                        {{isset($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == '1' ? 'selected' : ''}}

">نعم</label>
                                                    <input type="radio"
                                                           name="attrs_yes_no[{{$main_item->attribute->id}}]"
                                                           id="opt_{{$main_item->attribute->id}}_yes"
                                                           value="1"
                                                           class="d-none main_btn_answer"
                                                        {{isset($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == '1' ? 'checked' : ''}}
                                                    >

                                                </div>
                                                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 ">
                                                    <label
                                                        for="opt_{{$main_item->attribute->id}}_no"
                                                        class="btn my-2 custom_select_btn_radio
                                                        {{isset($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == '0' ? 'selected' : ''}}">لا</label>
                                                    <input type="radio"
                                                           name="attrs_yes_no[{{$main_item->attribute->id}}]"
                                                           id="opt_{{$main_item->attribute->id}}_no"
                                                           value="0"
                                                           class="d-none main_btn_answer"
                                                        {{isset($_GET['attrs_yes_no'][$main_item->attribute->id]) && $_GET['attrs_yes_no'][$main_item->attribute->id] == '0' ? 'checked' : ''}}
                                                    >

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            @endif

                        @elseif ($main_item->type_of == 'category')
                                <div
                                    class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                    <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->id}}">
                                        <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                        <span class="toggle_icons">
                                        <i class="fa fa-chevron-left"></i>
                                        <i class="fa fa-chevron-down d-none"></i>
                                    </span>
                                    </div>
                                    <div class="sub_menu subs_for_{{$main_item->id}} pl-2 mb-3">
                                        @php
                                            $children = \App\Models\AttributeChild::with(['attribute' => function ($q) {$q->with(['options' => function ($q) {$q->orderBy('lft', 'asc');}])->select('id', 'title');},])->where('cat_id','=', $_GET['new_sub_cat_id'])->where('parent_id', $main_item->attribute->id)->orderBy('lft', 'ASC')->get();
                                        @endphp
                                        <ul class="row"
                                            style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">
                                            @foreach($children as $child_attr)
                                                <li class="locations col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">
                                                    {{--                                                                    {{dd($children_attributes)}}--}}
                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'
                                                         style='text-align:right; padding-right:20px;'>
                                                        <input type='checkbox'
                                                               name="attrs_yes_no[{{$child_attr->attribute->id}}]"
                                                               class='inp_check'
                                                               value="1"
                                                            {{isset($_GET['attrs_yes_no'][$child_attr->attribute->id]) && $_GET['attrs_yes_no'][$child_attr->attribute->id] == 1 ? 'checked' : ''}}
                                                        >
                                                        <div class='state p-warning'>
                                                            <!-- svg path -->
                                                            <svg class='svg svg-icon'
                                                                 viewBox='0 0 20 20'>
                                                                <path
                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                    style='stroke: white;fill:white;'></path>
                                                            </svg>
                                                            <label
                                                                style='font-size: 13px; font-weight: bold!important;'>{{$child_attr->attribute->title}}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                        @elseif ($main_item->type_of == 'with_no_answers')
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0  main_item_filter position-relative">
                                    <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->id}}">
                                        <h4 class="bold l_17 d-inline-block">{{$main_item->attribute->title}}</h4>
                                        <span class="toggle_icons">
                                    <i class="fa fa-chevron-left"></i>
                                    <i class="fa fa-chevron-down d-none"></i>
                                </span>
                                    </div>
                                    <div class="sub_menu subs_for_{{$main_item->id}} pl-2 mb-3">
                                        <div class="row my-2">
                                            <div
                                                class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right ">
                                                <div class="input-group mb-3" dir="ltr">
                                                    <span class="input-group-text bound "
                                                          id="new_from_{{$main_item->attribute->unit}}">{{$main_item->attribute->unit}}</span>
                                                    <input type="number" class="form-control text-right"
                                                           name="from_to[{{$main_item->attribute->id}}][from]"
                                                           style="border-left: none"
                                                           value="{{isset($_GET['from_to'][$main_item->attribute->id]['from']) ? $_GET['from_to'][$main_item->attribute->id]['from']  : ''}}"


                                                           placeholder="من"
                                                           aria-label="من"
                                                           aria-describedby="new_{{$main_item->attribute->unit}}">
                                                </div>
                                            </div>
                                            <div
                                                class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_from_">
                                                <div class="input-group mb-3" dir="ltr">
                                                    <span class="input-group-text bound "
                                                          id="new_to_{{$main_item->attribute->unit}}">{{$main_item->attribute->unit}}</span>
                                                    <input type="number" class="form-control text-right"
                                                           name="from_to[{{$main_item->attribute->id}}][to]"
                                                           style="border-left: none"
                                                           value="{{isset($_GET['from_to'][$main_item->attribute->id]['to']) ? $_GET['from_to'][$main_item->attribute->id]['to']  : ''}}"
                                                           placeholder="إلي"
                                                           aria-label="إلي"
                                                           aria-describedby="new_{{$main_item->attribute->unit}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        @endif
                    @endforeach
                    {{--            {{dd($other_attributes)}}--}}
                @endif

            </form>
        </div>
    </section>
    {{--    End Featured Cats--}}

@endsection




@section('script')
    <script>
        $(document).ready(function () {
            let new_country_id = $('#new_country_id');
            let new_city_id = $('#new_city_id');

            new_country_id.select2();
            new_city_id.select2();

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

            let input_group = $('.input-group .form-control');
            input_group.focus(function () {
                $(this).prev('span.bound').css('border-color', '#426ddd');
            });
            input_group.focusout(function () {
                $(this).prev('span.bound').css('border-color', '#ced4da');
            });
            let custom_select_btn = $('.custom_select_btn');

            custom_select_btn.on('click', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    $(this).addClass('selected');
                }
            });

            let custom_select_btn_radio = $('.custom_select_btn_radio');

            custom_select_btn_radio.on('click', function () {
                let custom_btn_rows = $(this).parent().parent();
                let custom_select_btns_radio = custom_btn_rows.find('.custom_select_btn_radio');
                custom_select_btns_radio.removeClass('selected');
                $(this).addClass('selected');
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
        });
    </script>
@stop

