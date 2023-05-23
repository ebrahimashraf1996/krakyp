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
        .sub_menu {
            display: none
        }
        .header-nav {position: fixed; top:0;background: #fff; width: 100%}

    </style>
@stop
@section('script')

    <script>

        // JavaScript code
        function search_animal() {
            let input = document.getElementById('searchbar').value;
            input = input.toLowerCase();
            let x = document.getElementsByClassName('locations');

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    x[i].style.display = "list-item";
                }
            }
        }

        $(document).ready(function () {



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

            let filter_header = $(".filter_header");
            let filter_section = $('.filter_section');
            let header_nav = $('.header-nav');
            let client_ads_cols = $('.client_ads_cols');
            filter_header.width(filter_section.width() + 19);
            filter_section.css('top', header_nav.height());
            client_ads_cols.css('margin-top', (header_nav.height() - 30));


        });
    </script>
@stop
@section('content')
    {{--{{dd($_GET['attrs']['6-1'])}}--}}


    <section class="search_container container">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xm-12 col-12 py-0 text-center filter_section"
                 style="background: #fff">
                <form action="{{route('new.search.get')}}" class="pb-3">
                    <input type="hidden" name="new_main_cat_id" value="{{!empty($_GET['new_main_cat_id']) ? $_GET['new_main_cat_id'] : ''}}">
                    <input type="hidden" name="new_sub_cat_id" value="{{!empty($_GET['new_sub_cat_id']) ? $_GET['new_sub_cat_id'] : ''}}">
                    <input type="hidden" name="new_sort_by" value="{{!empty($_GET['new_sort_by']) ? $_GET['new_sort_by'] : ''}}">
                    <div class="row filter_header">
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xm-12 col-12 text-right">
                            <span style="color: #565b6e;font-weight: bold;">بحث مفصل</span>
                        </div>
                        <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xm-12 col-12 text-left">
                            <button type="submit" style="color: #426ddd;font-weight: bold;" id="reset_adv" data-url="">
                                <i class="fa fa-redo pl-2"></i>
                                تحديث
                            </button>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div
                            class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative "
                            id="client_ad_place">
                            <div class="main_head py-3 pe-3" data-target="subs_for_location">
                                <h4 class="bold l_17 d-inline-block">مكان تواجد الإعلان</h4>
                                <span class="client_ad_place_main toggle_icons">
                        <i class="fa fa-chevron-left d-none"></i>
                        <i class="fa fa-chevron-down "></i>
                    </span>
                            </div>
                            <div class="sub_menu subs_for_location pl-2 mt-0" style="display: block;">
                                @php
                                    $locations = \App\Models\Location::where('parent_id', null)->get();
                                @endphp

                                <div class="row">
                                    <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-2">
                                        <select class="form-control" id="new_country_id" name="new_country_id" style="width: 100%">
                                            <option value="">اختر المكان</option>
                                            @foreach($locations as $item)
                                                <option value="{{$item->id}}" {{isset($_GET['new_country_id']) &&  $_GET['new_country_id'] == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-2"
                                         id="new_city_id_div"
                                         disabled="">
                                        <select class="form-control" id="new_city_id" name="new_city_id" {{!empty($_GET['new_country_id']) ? '' : 'disabled'}}
                                                style="width: 100%">
                                            @if(!empty($_GET['new_country_id']))
                                                @php
                                                    $cities = \App\Models\Location::select('id', 'name', 'parent_id')->where('parent_id', $_GET['new_country_id'])->get();
                                                @endphp
                                                    <option value="all">الكل</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}" {{!empty($_GET['new_city_id']) &&  $_GET['new_city_id'] == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                                @endforeach
                                            @else
                                                <option value="all">الكل</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

{{--                                <input id="searchbar" onkeyup="search_animal()" type="text"--}}
{{--                                       name="search" placeholder="بحث بإسم المحافظة او المنطقة"--}}
{{--                                       class="form-control mb-2">--}}


{{--                                <ul id="list" class="row"--}}
{{--                                    style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}
{{--                                    @foreach($countries as $country)--}}
{{--                                        <li class="locations col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">--}}
{{--                                            --}}{{--                                                                    {{dd($children_attributes)}}--}}
{{--                                            <div class='pretty p-rotate p-svg p-curve main_toggle_item'--}}
{{--                                                 style='text-align:right; padding-right:20px;'>--}}
{{--                                                <input type='checkbox'--}}
{{--                                                       name="country_ids[]"--}}
{{--                                                       class='inp_check'--}}
{{--                                                       value="{{$country->id}}">--}}
{{--                                                <div class='state p-warning'>--}}
{{--                                                    <!-- svg path -->--}}
{{--                                                    <svg class='svg svg-icon'--}}
{{--                                                         viewBox='0 0 20 20'>--}}
{{--                                                        <path--}}
{{--                                                            d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                            style='stroke: white;fill:white;'></path>--}}
{{--                                                    </svg>--}}
{{--                                                    <label--}}
{{--                                                        style='font-size: 13px; font-weight: bold!important;'>{{$country->name}}</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <span class="toggle_icon">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                            <ul class="cities sub_from_main"--}}
{{--                                                style="padding-left: 0!important;padding-right: 20px;margin-top: 2px;display: none">--}}

{{--                                                @foreach($country->cities as $city)--}}
{{--                                                    <li class="locations col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_sub_check_filter mx-0 pr-4">--}}
{{--                                                        <div class='pretty p-rotate p-svg p-curve sub_toggle_item'--}}
{{--                                                             style='text-align:right; padding-right:15px;'>--}}
{{--                                                            <input type='checkbox'--}}
{{--                                                                   name="city_ids[]"--}}
{{--                                                                   class='inp_check'--}}
{{--                                                                   value="{{$city->id}}">--}}
{{--                                                            <div class='state p-warning'>--}}
{{--                                                                <!-- svg path -->--}}
{{--                                                                <svg class='svg svg-icon'--}}
{{--                                                                     viewBox='0 0 20 20'>--}}
{{--                                                                    <path--}}
{{--                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                                        style='stroke: white;fill:white;'></path>--}}
{{--                                                                </svg>--}}
{{--                                                                <label--}}
{{--                                                                    style='font-size: 13px; font-weight: bold!important;'>{{$city->name}}</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div
                            class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0  main_item_filter position-relative"
                            id="price_filter">
                            <div class="main_head py-3 pe-3" data-target="subs_for_price">
                                <h4 class="bold l_17 d-inline-block">السعر (جنيه)</h4>
                                <span class="price_filter toggle_icons">
                                    <i class="fa fa-chevron-left d-none"></i>
                                    <i class="fa fa-chevron-down "></i>
                                </span>
                            </div>
                            <div class="sub_menu subs_for_price pl-2 mt-3" style="display: block;">
                                <div class="row">
                                    <div
                                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_from_">
                                        <div class="input-group mb-3" dir="ltr">
                                            <span class="input-group-text bound " id="new_from_label">جنيه</span>
                                            <input type="number" class="form-control text-right" name="new_from_"
                                                   style="border-left: none"
                                                   value="{{isset($_GET['new_from_']) && $_GET['new_from_'] != null ? $_GET['new_from_'] : ''}}"
                                                   placeholder="السعر من" aria-label="السعر من"
                                                   aria-describedby="new_from_label">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_to_">
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

                    {{--Start Attributes--}}
                    @if(isset($main_attributes) && $main_attributes->count() > 0)
                        @foreach($main_attributes as $main_item)
                        @if($main_item->attribute->appearance == 'select')
                            @if($main_item->type_of == 'with_options')
                                <div class="row">

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
                                </div>
                            @elseif ($main_item->type_of == 'yes_no')
                                <div class="row">

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
                                </div>
                            @endif
                        @elseif($main_item->attribute->appearance == 'buttons')
                            @if($main_item->type_of == 'with_options')
                                <div class="row">

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
                                </div>
                            @elseif ($main_item->type_of == 'yes_no')
                                <div class="row">
                                    <div
                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">
                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$main_item->attribute->id}}">
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
                                </div>
                            @endif

                        @elseif ($main_item->type_of == 'category')
                            <div class="row">
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
                            </div>

                        @elseif ($main_item->type_of == 'with_no_answers')
                            <div class="row">
                                <div
                                    class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0  main_item_filter position-relative">
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
                                                           style="border-left: none" value="{{isset($_GET['from_to'][$main_item->attribute->id]['to']) ? $_GET['from_to'][$main_item->attribute->id]['to']  : ''}}" placeholder="إلي"
                                                           aria-label="إلي"
                                                           aria-describedby="new_{{$main_item->attribute->unit}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{--            {{dd($other_attributes)}}--}}
                    @endif

{{--                    @foreach($other_attributes as $other_item)--}}
{{--                        @if($other_item->attribute->appearance == 'select')--}}
{{--                            @if($other_item->type_of == 'with_options')--}}
{{--                                <div class="row">--}}

{{--                                    <div--}}
{{--                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">--}}
{{--                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                            <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                            <span class="toggle_icons">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}

{{--                                            <ul class="row"--}}
{{--                                                style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}
{{--                                                @foreach($other_item->attribute->options as $option)--}}
{{--                                                    <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">--}}
{{--                                                        --}}{{--                                                                    {{dd($children_attributes)}}--}}
{{--                                                        <div class='pretty p-rotate p-svg p-curve main_toggle_item'--}}
{{--                                                             style='text-align:right; padding-right:20px;'>--}}
{{--                                                            <input type='checkbox'--}}
{{--                                                                   name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                                   class='inp_check'--}}
{{--                                                                   value="{{$option->id}}">--}}
{{--                                                            <div class='state p-warning'>--}}
{{--                                                                <!-- svg path -->--}}
{{--                                                                <svg class='svg svg-icon'--}}
{{--                                                                     viewBox='0 0 20 20'>--}}
{{--                                                                    <path--}}
{{--                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                                        style='stroke: white;fill:white;'></path>--}}
{{--                                                                </svg>--}}
{{--                                                                <label--}}
{{--                                                                    style='font-size: 13px; font-weight: bold!important;'>{{$option->val}}</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @elseif ($other_item->type_of == 'yes_no')--}}
{{--                                <div class="row">--}}

{{--                                    <div--}}
{{--                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">--}}
{{--                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                            <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                            <span class="toggle_icons">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}

{{--                                            <ul class="row"--}}
{{--                                                style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}

{{--                                                <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">--}}
{{--                                                    --}}{{--                                                                    {{dd($children_attributes)}}--}}
{{--                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'--}}
{{--                                                         style='text-align:right; padding-right:20px;'>--}}
{{--                                                        <input type='checkbox' id="{{$other_item->attribute->id}}_1"--}}
{{--                                                               name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                               class='inp_check'--}}
{{--                                                               value="1">--}}
{{--                                                        <div class='state p-warning'>--}}
{{--                                                            <!-- svg path -->--}}
{{--                                                            <svg class='svg svg-icon'--}}
{{--                                                                 viewBox='0 0 20 20'>--}}
{{--                                                                <path--}}
{{--                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                                    style='stroke: white;fill:white;'></path>--}}
{{--                                                            </svg>--}}
{{--                                                            <label--}}
{{--                                                                style='font-size: 13px; font-weight: bold!important;'--}}
{{--                                                                for="{{$other_item->attribute->id}}_1">نعم</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li class=" col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">--}}
{{--                                                    --}}{{--                                                                    {{dd($children_attributes)}}--}}
{{--                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'--}}
{{--                                                         style='text-align:right; padding-right:20px;'>--}}
{{--                                                        <input type='checkbox' id="{{$other_item->attribute->id}}_0"--}}
{{--                                                               name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                               class='inp_check'--}}
{{--                                                               value="0">--}}
{{--                                                        <div class='state p-warning'>--}}
{{--                                                            <!-- svg path -->--}}
{{--                                                            <svg class='svg svg-icon'--}}
{{--                                                                 viewBox='0 0 20 20'>--}}
{{--                                                                <path--}}
{{--                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                                    style='stroke: white;fill:white;'></path>--}}
{{--                                                            </svg>--}}
{{--                                                            <label--}}
{{--                                                                style='font-size: 13px; font-weight: bold!important;'--}}
{{--                                                                for="{{$other_item->attribute->id}}_0">لا</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @elseif($other_item->attribute->appearance == 'buttons')--}}
{{--                            @if($other_item->type_of == 'with_options')--}}
{{--                                <div class="row">--}}

{{--                                    <div--}}
{{--                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">--}}
{{--                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                            <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                            <span class="toggle_icons">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}

{{--                                            <div class="row custom_btn_rows"--}}
{{--                                                 style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}
{{--                                                @foreach($other_item->attribute->options as $option)--}}
{{--                                                    <div--}}
{{--                                                        class="col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-4 ">--}}
{{--                                                        <label--}}
{{--                                                            for="opt_{{$option->id}}"--}}
{{--                                                            class="btn my-2 custom_select_btn">{{$option->val}}</label>--}}
{{--                                                        <input type="checkbox"--}}
{{--                                                               name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                               id="opt_{{$option->id}}"--}}
{{--                                                               value="{{$option->id}}"--}}
{{--                                                               class="d-none main_btn_answer">--}}

{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @elseif ($other_item->type_of == 'yes_no')--}}
{{--                                <div class="row">--}}
{{--                                    <div--}}
{{--                                        class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">--}}
{{--                                        <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                            <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                            <span class="toggle_icons">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}

{{--                                            <div class="row custom_btn_rows"--}}
{{--                                                 style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}

{{--                                                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 ">--}}
{{--                                                    <label--}}
{{--                                                        for="opt_{{$other_item->id}}_yes"--}}
{{--                                                        class="btn my-2 custom_select_btn">نعم</label>--}}
{{--                                                    <input type="checkbox"--}}
{{--                                                           name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                           id="opt_{{$other_item->id}}_yes"--}}
{{--                                                           value="1"--}}
{{--                                                           class="d-none main_btn_answer">--}}

{{--                                                </div>--}}
{{--                                                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 ">--}}
{{--                                                    <label--}}
{{--                                                        for="opt_{{$other_item->id}}_no"--}}
{{--                                                        class="btn my-2 custom_select_btn">لا</label>--}}
{{--                                                    <input type="checkbox"--}}
{{--                                                           name="attrs[{{$other_item->attribute->id}}][]"--}}
{{--                                                           id="opt_{{$other_item->id}}_no"--}}
{{--                                                           value="0"--}}
{{--                                                           class="d-none main_btn_answer">--}}

{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @elseif ($other_item->type_of == 'category')--}}
{{--                            <div class="row">--}}
{{--                                <div--}}
{{--                                    class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0 main_item_filter position-relative">--}}
{{--                                    <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                        <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                        <span class="toggle_icons">--}}
{{--                                        <i class="fa fa-chevron-left"></i>--}}
{{--                                        <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                    </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}
{{--                                        @php--}}
{{--                                            $children = \App\Models\AttributeChild::with(['attribute' => function ($q) {$q->with(['options' => function ($q) {$q->orderBy('lft', 'asc');}])->select('id', 'title');},])->where('cat_id','=', $_GET['new_sub_cat_id'])->where('parent_id', $other_item->attribute->id)->orderBy('lft', 'ASC')->get();--}}
{{--                                        @endphp--}}
{{--                                        <ul class="row"--}}
{{--                                            style="padding-left: 0!important;max-height: 200px; overflow-y: scroll">--}}
{{--                                            @foreach($children as $child_attr)--}}
{{--                                                <li class="locations col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_check_filter mx-0 pl-2 position-relative">--}}
{{--                                                    --}}{{--                                                                    {{dd($children_attributes)}}--}}
{{--                                                    <div class='pretty p-rotate p-svg p-curve main_toggle_item'--}}
{{--                                                         style='text-align:right; padding-right:20px;'>--}}
{{--                                                        <input type='checkbox'--}}
{{--                                                               name="category_attrs[]"--}}
{{--                                                               class='inp_check'--}}
{{--                                                               value="{{$child_attr->attribute->id}}">--}}
{{--                                                        <div class='state p-warning'>--}}
{{--                                                            <!-- svg path -->--}}
{{--                                                            <svg class='svg svg-icon'--}}
{{--                                                                 viewBox='0 0 20 20'>--}}
{{--                                                                <path--}}
{{--                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
{{--                                                                    style='stroke: white;fill:white;'></path>--}}
{{--                                                            </svg>--}}
{{--                                                            <label--}}
{{--                                                                style='font-size: 13px; font-weight: bold!important;'>{{$child_attr->attribute->title}}</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        @elseif ($other_item->type_of == 'with_no_answers')--}}
{{--                            <div class="row">--}}
{{--                                <div--}}
{{--                                    class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 text-right p-0  main_item_filter position-relative">--}}
{{--                                    <div class="main_head py-3 pe-3" data-target="subs_for_{{$other_item->id}}">--}}
{{--                                        <h4 class="bold l_17 d-inline-block">{{$other_item->attribute->title}}</h4>--}}
{{--                                        <span class="toggle_icons">--}}
{{--                                    <i class="fa fa-chevron-left"></i>--}}
{{--                                    <i class="fa fa-chevron-down d-none"></i>--}}
{{--                                </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="sub_menu subs_for_{{$other_item->id}} pl-2 mb-3">--}}
{{--                                        <div class="row my-2">--}}
{{--                                            <div--}}
{{--                                                class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right ">--}}
{{--                                                <div class="input-group mb-3" dir="ltr">--}}
{{--                                                    <span class="input-group-text bound "--}}
{{--                                                          id="new_from_{{$other_item->attribute->unit}}">{{$other_item->attribute->unit}}</span>--}}
{{--                                                    <input type="number" class="form-control text-right"--}}
{{--                                                           name="from_to[{{$other_item->attribute->id}}][from]"--}}
{{--                                                           style="border-left: none" value="" placeholder="من"--}}
{{--                                                           aria-label="من"--}}
{{--                                                           aria-describedby="new_{{$other_item->attribute->unit}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-right new_from_">--}}
{{--                                                <div class="input-group mb-3" dir="ltr">--}}
{{--                                                    <span class="input-group-text bound "--}}
{{--                                                          id="new_to_{{$other_item->attribute->unit}}">{{$other_item->attribute->unit}}</span>--}}
{{--                                                    <input type="number" class="form-control text-right"--}}
{{--                                                           name="from_to[{{$other_item->attribute->id}}][to]"--}}
{{--                                                           style="border-left: none" value="" placeholder="إلي"--}}
{{--                                                           aria-label="إلي"--}}
{{--                                                           aria-describedby="new_{{$other_item->attribute->unit}}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}


{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                </form>
            </div>
            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xm-12 col-12 client_ads_cols ">
                @if(isset($paid_client_ads_in_cat) && $paid_client_ads_in_cat->count() > 0 || isset($free_client_ads_in_cat) && $free_client_ads_in_cat->count() > 0 )
                    {{--    Start Ads--}}
                    <section class="client_ads_section mt-1 text-center">
                        <div class="container">
                            <div class="row client_ads_div">
                                <div class="col-lg-12 col-md-12 m-auto">
                                    <div class="row" id="client_ads_cont">
                                        @foreach($paid_client_ads_in_cat as $key => $item)
                                            <div class="col-lg-4 col-md-4 col-6 col-sm-6 post  my-2">
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
                                        @foreach($free_client_ads_in_cat as $key => $item)
                                            <div class="col-lg-4 col-md-4 col-6 col-sm-6 post my-2">
                                                {{--                            {{route('client_ad.show', $item->slug)}}--}}
                                                <div class="card card-block pb-3">
                                                    @if(backpack_auth()->check())
                                                        <div class="wish_div not_hovered_wish" data-target="{{$item->id}} ">
                                                            <a href="javascript:void(0)" class="wish-btn"
                                                               data-bs-target="{{$item->slug}}">
                                                                <img
                                                                    src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"
                                                                    alt="wish-icon">
                                                                <span>أضف لقائمة الرغبات</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="wish_div not_hovered_wish" data-target="{{$item->id}} ">
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
                @endif
            </div>
        </div>
    </section>





    {{--    @if(isset($paid_client_ads_in_cat) && $paid_client_ads_in_cat->count() > 0 || isset($free_client_ads_in_cat) && $free_client_ads_in_cat->count() > 0 )--}}
    {{--        --}}{{--    Start Ads--}}
    {{--        <section class="client_ads_section client_ads_cat_section  text-center">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row main_row">--}}
    {{--                    <div class="col-md-12 col-12 col-sm-12 text-muted l_17 serial_url "  style="text-align: right">--}}
    {{--                        <a href="#" class="cl-919191  l_14">{{$cat->mainCategory->title}}</a> ---}}

    {{--                        <a href="#" class="cl-919191 l_14">{{$cat->title}} </a>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-3 filters p-3">--}}
    {{--                        <div class="bordered" style="text-align: right; position:relative;">--}}
    {{--                            <div class="filters_dismiss">--}}
    {{--                                <div class="filters_btn_dismiss">--}}
    {{--                                    <div class="filters_container_dismiss">--}}
    {{--                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <h4 class="bold l_20 my-3 p-r-20  p-t-20">--}}
    {{--                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>--}}
    {{--                                البحث--}}
    {{--                            </h4>--}}

    {{--                            <form action="{{route('search.results')}}" method="get" class="">--}}
    {{--                                <input type="hidden" name="subcat" value="{{$cat->id}}">--}}
    {{--                                <input type="hidden" name="cat" value="{{!empty($_GET['cat']) ? $_GET['cat'] : ''}}">--}}
    {{--                                <input type="hidden" name="sort" value="{{!empty($_GET['sort']) ? $_GET['sort'] : 'cr_desc'}}">--}}
    {{--                                <input type="hidden" name="adv" value="{{!empty($_GET['adv']) ? $_GET['adv'] : '0'}}" id="adv">--}}
    {{--                                @php--}}
    {{--                                    $countries = \App\Models\Location::where('parent_id', null)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3 " id="country_row">--}}
    {{--                                    <label for="country" class="mb-2 bold">المحافظة--}}
    {{--                                    </label>--}}
    {{--                                    <select class="form-control" id="country" name="country">--}}
    {{--                                        @if(!empty($_GET['country']) && $_GET['country'] == 'all')--}}
    {{--                                            <option value="all" selected>الكل</option>--}}
    {{--                                        @elseif(!empty($_GET['country']) && $_GET['country'] != 'all')--}}
    {{--                                            @foreach($countries as $country)--}}
    {{--                                                <option value="{{$country->id}}" {{$country->id == $_GET['country'] ? 'selected' : ''}}>{{$country->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                @php--}}
    {{--                                   // $cities = \App\Models\Location::where('parent_id', $country_id)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3" id="city_id_div">--}}
    {{--                                    <label for="city" class="mb-2 bold">المدينة--}}
    {{--                                    </label>--}}
    {{--                                    <select class="form-control" id="city" name="city" {{!empty($_GET['city']) && $_GET['city'] == 'all' ? '' : ''}}>--}}
    {{--                                        @if(!empty($_GET['city']) && $_GET['city'] == 'all')--}}
    {{--                                        <option value="all" selected>الكل</option>--}}
    {{--                                            @foreach($cities as $city)--}}
    {{--                                                <option value="{{$city->id}}" >{{$city->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @elseif(!empty($_GET['city']) && $_GET['city'] != 'all')--}}
    {{--                                            <option value="all" >الكل</option>--}}
    {{--                                            @foreach($cities as $city)--}}
    {{--                                                <option value="{{$city->id}}" {{$city->id == $_GET['city'] ? 'selected' : ''}}>{{$city->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                @php--}}
    {{--                                   // $states = \App\Models\Location::where('parent_id', $city_id)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3" id="state_id_div">--}}
    {{--                                    <label for="state" class="mb-2 bold">الحي / المركز--}}
    {{--                                    </label>--}}

    {{--                                    @if(!empty($_GET['city']) && $_GET['city'] != 'all')--}}
    {{--                                        <select class="form-control" id="state" name="state">--}}
    {{--                                            @if(!empty($_GET['state']) && $_GET['state'] == 'all')--}}
    {{--                                                <option value="all" selected>الكل</option>--}}
    {{--                                                @foreach($states as $state)--}}
    {{--                                                    <option value="{{$state->id}}" >{{$state->name}}</option>--}}
    {{--                                                @endforeach--}}
    {{--                                            @elseif(!empty($_GET['state']) && $_GET['state'] != 'all')--}}
    {{--                                                <option value="all" >الكل</option>--}}
    {{--                                                @foreach($states as $state)--}}
    {{--                                                    <option value="{{$state->id}}" {{$state->id == $_GET['state'] ? 'selected' : ''}}>{{$state->name}}</option>--}}
    {{--                                                @endforeach--}}
    {{--                                            @else--}}
    {{--                                                <option value="all" selected>الكل</option>--}}
    {{--                                                @foreach($states as $state)--}}
    {{--                                                    <option value="{{$state->id}}" >{{$state->name}}</option>--}}
    {{--                                                @endforeach--}}
    {{--                                            @endif--}}
    {{--                                        </select>--}}
    {{--                                    @else--}}
    {{--                                        <select class="form-control" id="state" name="state" disabled>--}}
    {{--                                                <option value="all" selected>الكل</option>--}}
    {{--                                        </select>--}}

    {{--                                    @endif--}}

    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3">--}}
    {{--                                    <label for="from_" class="mb-2 bold">أقل سعر--}}
    {{--                                        <span class="text-muted">ج.م </span>--}}
    {{--                                    </label>--}}
    {{--                                    <input type="number" class="form-control" id="from_" name="from_"--}}
    {{--                                           value="{{!empty($_GET['from']) ? $_GET['from'] : $min}}" placeholder="أقل سعر ج.م">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">--}}
    {{--                                    <label for="to_" class="mb-2 bold">أعلي سعر--}}
    {{--                                        <span class="text-muted">ج.م </span>--}}
    {{--                                    </label>--}}
    {{--                                    <input type="number" class="form-control" id="to_" name="to_"--}}
    {{--                                           value="{{!empty($_GET['to']) ? $_GET['to'] : $max}}" placeholder="أعلي سعر ج.م">--}}
    {{--                                </div>--}}

    {{--                                @if(isset($attributes) && $attributes->count() > 0)--}}
    {{--                                    @foreach($attributes as $item)--}}
    {{--                                        @if($item->type == 'check')--}}
    {{--                                            <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">--}}
    {{--                                                <div class="col-md-12 px-4" style="text-align: right;">--}}
    {{--                                                    <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'--}}
    {{--                                                         style='margin-top: 15px;'--}}
    {{--                                                         id='attr_single_'>--}}
    {{--                                                        <input type='checkbox' value='{{!empty($_GET['attrs'][$item->id . '-1']) ? '1' : '0'}}' name='attrs[{{$item->id}}-1]'--}}
    {{--                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id . '-1']) ? 'checked' : ''}}>--}}
    {{--                                                        <div class='state p-success'>--}}
    {{--                                                            <!-- svg path -->--}}
    {{--                                                            <svg class='svg svg-icon' viewBox='0 0 20 20'>--}}
    {{--                                                                <path--}}
    {{--                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
    {{--                                                                    style='stroke: white;fill:white;'></path>--}}
    {{--                                                            </svg>--}}
    {{--                                                            <label style='font-weight: bold'>{{$item->title}}</label>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="row mt-3 opt_container" style="border-top: 2px solid #000; margin: auto">--}}
    {{--                                                <div class="col-md-12 col-12" style="text-align: right">--}}
    {{--                                                    <h4 class="bold l_20 mt-3 p-r-4"> {{$item->title}} </h4>--}}
    {{--                                                </div>--}}
    {{--                                                @foreach($item->options as $option)--}}
    {{--                                                    <div class="col-md-12 px-4 " style="text-align: right;">--}}
    {{--                                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'--}}
    {{--                                                             style='margin-top: 15px;'--}}
    {{--                                                             id='attr_single_'>--}}
    {{--                                                            {{$request->attr_select_.$item->id[$option->id] && $request->attr_select_.$item->id[$option->id] ==  '1' ? '1' : '0'}}--}}
    {{--                                                            <input type='checkbox' value='{{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 1 : 0}}' name='attrs[{{$item->id}}-{{$option->id}}]'--}}
    {{--                                                                   class='inp_check attr_check' {{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 'checked' : ''}}>--}}
    {{--                                                            {{dd($_GET['attrs[' . $item->id . '-' . $option->id].']')}}--}}
    {{--                                                            <div class='state p-success'>--}}
    {{--                                                                <!-- svg path -->--}}
    {{--                                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>--}}
    {{--                                                                    <path--}}
    {{--                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
    {{--                                                                        style='stroke: white;fill:white;'></path>--}}
    {{--                                                                </svg>--}}
    {{--                                                                <label--}}
    {{--                                                                    style='font-weight: bold'>{{$option->val}}</label>--}}
    {{--                                                            </div>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                @endforeach--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                    @endforeach--}}
    {{--                                @endif--}}
    {{--                                <div class="col-md-12 mt-4">--}}
    {{--                                    <button class="btn filter_btn w-100">اعرض النتائج</button>--}}
    {{--                                </div>--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-12 mt-3 filter_btn_sec">--}}
    {{--                        <div class="col-6 filter_btn_div" style="text-align: right">--}}
    {{--                            <a href="javascript:void(0);" class="filters_btn bold l_20 p-r-10">--}}
    {{--                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>--}}
    {{--                                البحث--}}

    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-9 search_result_div col-12 col-sm-12 mt-3">--}}
    {{--                        <div class="row" id="client_ads_cont">--}}
    {{--                            @foreach($paid_client_ads_in_cat as $key => $item)--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post  my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        <div class="mark_div">--}}
    {{--                                            <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"--}}
    {{--                                                 width="100%">--}}
    {{--                                        </div>--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div id="wish_div" class="wish_div product_{{$item->id}}">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}

    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            @endforeach--}}
    {{--                            @foreach($free_client_ads_in_cat as $key => $item)--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-4 col-6 col-sm-6 post my-2">--}}
    {{--                                    --}}{{--                            {{route('client_ad.show', $item->slug)}}--}}
    {{--                                    <div class="card card-block pb-3">--}}
    {{--                                        @php--}}
    {{--                                            $images =explode(',',$item->images);--}}
    {{--                                             //dd($photo);--}}
    {{--                                        @endphp--}}
    {{--                                        @if(backpack_auth()->check())--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="javascript:void(0)" class="wish-btn"--}}
    {{--                                                   data-bs-target="{{$item->slug}}">--}}
    {{--                                                    <img--}}
    {{--                                                        src="{{\App\Models\Wish::where('user_id', backpack_auth()->user()->id)->where('client_ad_id',$item->id)->first() ? asset('assets/front/images/hearted.png') : asset('assets/front/images/heart.png')}}"--}}
    {{--                                                        alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="wish_div" data-target="{{$item->id}} ">--}}
    {{--                                                <a href="{{url('login')}}">--}}
    {{--                                                    <img src="{{asset('assets/front/images/heart.png')}}"--}}
    {{--                                                         alt="wish-icon">--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <a href="{{route('client_ad.show', $item->slug)}}">--}}
    {{--                                            <div class="client_ad_cover">--}}
    {{--                                                <img src="{{asset('images/dropped/'. $images[0])}}"--}}
    {{--                                                     alt="{{$item->slug}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="titles bold">--}}
    {{--                                                <h5 class="card-title  bold">{{$item->title}}</h5>--}}
    {{--                                                <span class="card-title  bold price">{{$item->price}} ج.م</span>--}}
    {{--                                            </div>--}}
    {{--                                        </a>--}}
    {{--                                        <div class="footer_card text-muted">--}}
    {{--                                            <small>{{$item->country->name}}</small> ---}}
    {{--                                            <small>{{$item->city->name}}</small> - <small>{{$item->state->name}}</small>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            @endforeach--}}
    {{--                        </div>--}}
    {{--                        <div class="row mt-4">--}}
    {{--                            <div class="col-md-3 col-12 col-sm-12 m-auto">--}}
    {{--                                <button class="btn" id="see_more">اظهر المزيد</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--        --}}{{--    End Ads--}}

    {{--    @else--}}
    {{--        <section class="client_ads_section text-center">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row mt-5 text-center">--}}
    {{--                    <div class="col-md-3 filters p-3">--}}
    {{--                        <div class="bordered" style="text-align: right; position:relative;">--}}
    {{--                            <div class="filters_dismiss">--}}
    {{--                                <div class="filters_btn_dismiss">--}}
    {{--                                    <div class="filters_container_dismiss">--}}
    {{--                                        <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <h4 class="bold l_20 my-3 p-r-20  p-t-20">--}}
    {{--                                <i class="fa-solid fa-filter" style="font-size: 17px;"></i>--}}
    {{--                                البحث--}}
    {{--                            </h4>--}}

    {{--                            <form action="{{route('search.results')}}" method="get" class="">--}}
    {{--                                <input type="hidden" name="subcat" value="{{$cat->id}}">--}}
    {{--                                <input type="hidden" name="cat" value="{{!empty($_GET['cat']) ? $_GET['cat'] : ''}}">--}}
    {{--                                <input type="hidden" name="sort" value="{{!empty($_GET['sort']) ? $_GET['sort'] : 'cr_desc'}}">--}}
    {{--                                <input type="hidden" name="adv" value="{{!empty($_GET['adv']) ? $_GET['adv'] : '0'}}">--}}
    {{--                                @php--}}
    {{--                                    $countries = \App\Models\Location::where('parent_id', null)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3">--}}
    {{--                                    <label for="country" class="mb-2 bold">المحافظة--}}
    {{--                                    </label>--}}
    {{--                                    <select class="form-control" id="country" name="country">--}}
    {{--                                        @if(!empty($_GET['country']) && $_GET['country'] == 'all')--}}
    {{--                                            <option value="all">الكل</option>--}}
    {{--                                        @elseif(!empty($_GET['country']) && $_GET['country'] != 'all')--}}
    {{--                                            @foreach($countries as $country)--}}
    {{--                                                <option value="{{$country->id}}" {{$country->id == $_GET['country'] ? 'selected' : ''}}>{{$country->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                @php--}}
    {{--                                    $cities = \App\Models\Location::where('parent_id', $country_id)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3">--}}
    {{--                                    <label for="city" class="mb-2 bold">المدينة--}}
    {{--                                    </label>--}}
    {{--                                    <select class="form-control" id="city" name="city" {{!empty($_GET['city']) && $_GET['city'] == 'all' ? 'disabled' : ''}}>--}}
    {{--                                        @if(!empty($_GET['city']) && $_GET['city'] == 'all')--}}
    {{--                                            {{dd('test')}}--}}
    {{--                                            <option value="all" selected>الكل</option>--}}
    {{--                                        @elseif(!empty($_GET['city']) && $_GET['city'] != 'all')--}}
    {{--                                            @foreach($cities as $city)--}}
    {{--                                                <option value="{{$city->id}}" {{$city->id == $_GET['city'] ? 'selected' : ''}}>{{$city->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                @php--}}
    {{--                                    $states = \App\Models\Location::where('parent_id', $city_id)->get();--}}
    {{--                                @endphp--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3">--}}
    {{--                                    <label for="state" class="mb-2 bold">الحي / المركز--}}
    {{--                                    </label>--}}
    {{--                                    <select class="form-control" id="state" name="state" {{!empty($_GET['state']) && $_GET['state'] == 'all' ? 'disabled' : ''}}>--}}
    {{--                                        @if(!empty($_GET['state']) && $_GET['state'] == 'all')--}}
    {{--                                            <option value="all" selected>الكل</option>--}}
    {{--                                        @elseif(!empty($_GET['state']) && $_GET['state'] != 'all')--}}
    {{--                                            @foreach($states as $state)--}}
    {{--                                                <option value="{{$state->id}}" {{$state->id == $_GET['state'] ? 'selected' : ''}}>{{$state->name}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-12 col-12 px-2 mt-3">--}}
    {{--                                    <label for="from_" class="mb-2 bold">أقل سعر--}}
    {{--                                        <span class="text-muted">ج.م </span>--}}
    {{--                                    </label>--}}
    {{--                                    <input type="number" class="form-control" id="from_" name="from_"--}}
    {{--                                           value="{{!empty($_GET['from']) ? $_GET['from'] : $min}}" placeholder="أقل سعر ج.م">--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group col-md-12 col-12 mt-3 px-2" id="to_div">--}}
    {{--                                    <label for="to_" class="mb-2 bold">أعلي سعر--}}
    {{--                                        <span class="text-muted">ج.م </span>--}}
    {{--                                    </label>--}}
    {{--                                    <input type="number" class="form-control" id="to_" name="to_"--}}
    {{--                                           value="{{!empty($_GET['to']) ? $_GET['to'] : $max}}" placeholder="أعلي سعر ج.م">--}}
    {{--                                </div>--}}

    {{--                                @if(isset($attributes) && $attributes->count() > 0)--}}
    {{--                                    @foreach($attributes as $item)--}}
    {{--                                        @if($item->type == 'check')--}}
    {{--                                            <div class="row mt-3" style="border-top: 2px solid #000; margin: auto">--}}
    {{--                                                <div class="col-md-12 px-4" style="text-align: right;">--}}
    {{--                                                    <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'--}}
    {{--                                                         style='margin-top: 15px;'--}}
    {{--                                                         id='attr_single_'>--}}
    {{--                                                        <input type='checkbox' value='{{!empty($_GET['attrs'][$item->id . '-1']) ? '1' : '0'}}' name='attrs[{{$item->id}}-1]'--}}
    {{--                                                               class='inp_check attr_check' {{!empty($_GET['attrs'][$item->id . '-1']) ? 'checked' : ''}}>--}}
    {{--                                                        <div class='state p-success'>--}}
    {{--                                                            <!-- svg path -->--}}
    {{--                                                            <svg class='svg svg-icon' viewBox='0 0 20 20'>--}}
    {{--                                                                <path--}}
    {{--                                                                    d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
    {{--                                                                    style='stroke: white;fill:white;'></path>--}}
    {{--                                                            </svg>--}}
    {{--                                                            <label style='font-weight: bold'>{{$item->title}}</label>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        @else--}}
    {{--                                            <div class="row mt-3 opt_container" style="border-top: 2px solid #000; margin: auto">--}}
    {{--                                                <div class="col-md-12 col-12" style="text-align: right">--}}
    {{--                                                    <h4 class="bold l_20 mt-3 p-r-4"> {{$item->title}} </h4>--}}
    {{--                                                </div>--}}
    {{--                                                @foreach($item->options as $option)--}}
    {{--                                                    <div class="col-md-12 px-4" style="text-align: right;">--}}
    {{--                                                        <div class='pretty p-rotate p-svg p-curve col-md-12 col-12 attr_single'--}}
    {{--                                                             style='margin-top: 15px;'--}}
    {{--                                                             id='attr_single_'>--}}
    {{--                                                            --}}{{--                                                            {{$request->attr_select_.$item->id[$option->id] && $request->attr_select_.$item->id[$option->id] ==  '1' ? '1' : '0'}}--}}
    {{--                                                            <input type='checkbox' value='{{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 1 : 0}}' name='attrs[{{$item->id}}-{{$option->id}}]'--}}
    {{--                                                                   class='inp_check attr_check' {{!empty($_GET['attrs'][ $item->id . '-' . $option->id ]) ? 'checked' : ''}}>--}}
    {{--                                                            --}}{{--                                                            {{dd($_GET['attrs[' . $item->id . '-' . $option->id].']')}}--}}
    {{--                                                            <div class='state p-success'>--}}
    {{--                                                                <!-- svg path -->--}}
    {{--                                                                <svg class='svg svg-icon' viewBox='0 0 20 20'>--}}
    {{--                                                                    <path--}}
    {{--                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'--}}
    {{--                                                                        style='stroke: white;fill:white;'></path>--}}
    {{--                                                                </svg>--}}
    {{--                                                                <label--}}
    {{--                                                                    style='font-weight: bold'>{{$option->val}}</label>--}}
    {{--                                                            </div>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                @endforeach--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}

    {{--                                    @endforeach--}}
    {{--                                @endif--}}
    {{--                                <div class="col-md-12 mt-4">--}}
    {{--                                    <button class="btn filter_btn w-100">اعرض النتائج</button>--}}
    {{--                                </div>--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-md-9 col-12 col-sm-12 mt-3">--}}
    {{--                        <div class="row" id="client_ads_cont">--}}
    {{--                            <h4>لا توجد إعلانات بعد في هذه الفئة </h4>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--    @endif--}}











@endsection




@section('script')
    <script>

        /* Start As New */
        // $(document).ready(function () {
        //
        // });





        {{--$(document).ready(function () {--}}


        {{--    let country = $('select#country');--}}
        {{--    let country_row = $('#country_row');--}}
        {{--    country.on("select2:select", function (e) {--}}
        {{--        let country_id = $(this).val();--}}
        {{--        // alert(country_id);--}}
        {{--        if (country_id !== "") {--}}
        {{--            $('#city_id_div').remove();--}}
        {{--            $('#state').prop('disabled', true);--}}
        {{--            $('#state').val("all").change();--}}
        {{--            // $("div.id_100 select").val("val2").change();--}}

        {{--            $.ajax({--}}
        {{--                url: "/get-child-city/" + country_id,--}}
        {{--                data: {--}}
        {{--                    _token: "{{csrf_token()}}",--}}
        {{--                    id: country_id,--}}
        {{--                },--}}
        {{--                type: "POST",--}}
        {{--                success: function (response) {--}}
        {{--                    if (typeof (response) != 'object') {--}}
        {{--                        response = $.parseJSON(response)--}}
        {{--                    }--}}
        {{--                    console.log(response.data);--}}
        {{--                    let html_option = "";--}}
        {{--                    let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";--}}

        {{--                    if (response.status === 1) {--}}
        {{--                        let data = response.data;--}}
        {{--                        data.forEach(myFunction);--}}

        {{--                        function myFunction(item, index) {--}}
        {{--                            html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";--}}
        {{--                            html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";--}}
        {{--                        }--}}

        {{--                        // console.log(data[0]);--}}
        {{--                        console.log(html_option);--}}

        {{--                        // country_row.append(--}}
        {{--                        //     "<div class=\"form-group col-md-4 \" id='city_id_div'>\n" +--}}
        {{--                        //     " <label for=\"city_id\" class=\"mb-2 bold\">المدينة</label>\n" +--}}
        {{--                        //     " <select class=\"form-control select2-hidden-accessible\" id=\"city_id\" name=\"city_id\" data-select2-id=\"select2-data-city_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
        {{--                        //     " <option value='all'>الكل</option>" +--}}
        {{--                        //     html_option +--}}
        {{--                        //     " </select>" +--}}
        {{--                        //     " </div>"--}}
        {{--                        // );--}}

        {{--                        $("<div class=\"form-group col-md-12 col-12 px-2 mt-3 \" id='city_id_div'>\n" +--}}
        {{--                            " <label for=\"city\" class=\"mb-1 bold\">المدينة</label>\n" +--}}
        {{--                            " <select class=\"form-control select2-hidden-accessible\" id=\"city\" name=\"city\" data-select2-id=\"select2-data-city\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
        {{--                            " <option value='all'>الكل</option>" +--}}
        {{--                            html_option +--}}
        {{--                            " </select>" +--}}
        {{--                            " </div>").insertAfter('#country_row');--}}

        {{--                        $('#city').select2();--}}
        {{--                        $('#city_id_div').find('span.select2').css('width', '100%');--}}

        {{--                        let city_id = $('select#city');--}}
        {{--                        city_id.on("select2:select", function (e) {--}}
        {{--                            let city_id = $(this).val();--}}
        {{--                            // alert(city_id);--}}
        {{--                            if (city_id !== "all") {--}}
        {{--                                $('#state_id_div').remove();--}}
        {{--                                $.ajax({--}}
        {{--                                    url: "/get-child-state/" + city_id,--}}
        {{--                                    data: {--}}
        {{--                                        _token: "{{csrf_token()}}",--}}
        {{--                                        id: city_id,--}}
        {{--                                    },--}}
        {{--                                    type: "POST",--}}
        {{--                                    success: function (response) {--}}
        {{--                                        if (typeof (response) != 'object') {--}}
        {{--                                            response = $.parseJSON(response)--}}
        {{--                                        }--}}
        {{--                                        console.log(response.data);--}}
        {{--                                        let html_option = "";--}}
        {{--                                        let html_select = "<li data-value='all' data-display=\"الكل\" class=\"option \">الكل</li>";--}}

        {{--                                        if (response.status === 1) {--}}
        {{--                                            let data = response.data;--}}
        {{--                                            data.forEach(myFunction);--}}

        {{--                                            function myFunction(item, index) {--}}
        {{--                                                html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";--}}
        {{--                                                html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";--}}
        {{--                                            }--}}

        {{--                                            // console.log(data[0]);--}}
        {{--                                            console.log(html_option);--}}

        {{--                                            $(--}}
        {{--                                                "<div class=\"form-group  col-md-12 col-12 px-2 mt-3 \" id='state_id_div'>\n" +--}}
        {{--                                                " <label for=\"state\" class=\"mb-1 bold\">الحي / المركز</label>\n" +--}}
        {{--                                                " <select class=\"form-control select2-hidden-accessible\" id=\"state\" name=\"state\" data-select2-id=\"select2-data-state\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +--}}
        {{--                                                " <option value='all'>الكل</option>" +--}}
        {{--                                                html_option +--}}
        {{--                                                " </select>" +--}}
        {{--                                                " </div>"--}}
        {{--                                            ).insertAfter('#city_id_div');--}}
        {{--                                            $('#state').select2();--}}
        {{--                                            $('#state_id_div').find('span.select2').css('width', '100%');--}}
        {{--                                        }--}}
        {{--                                    }--}}
        {{--                                });--}}
        {{--                            } else {--}}
        {{--                                $('#state').prop('disabled', true);--}}
        {{--                                $('#state').val('all').trigger('change');--}}

        {{--                            }--}}

        {{--                        });--}}

        {{--                    } else {--}}

        {{--                    }--}}
        {{--                }--}}
        {{--            });--}}


        {{--        } else {--}}

        {{--            $('#state_id').val('all').trigger('change');--}}
        {{--            $('#city_id').val('all').trigger('change');--}}
        {{--            $('#city_id').prop('disabled', true);--}}
        {{--            $('#state_id').prop('disabled', true);--}}

        {{--        }--}}

        {{--    });--}}


        {{--    let opt_container = $('.opt_container');--}}
        {{--    opt_container.find('input').on('change', function () {--}}
        {{--        $(this).parent().parent().parent().find('input').prop('checked', false);--}}
        {{--        $(this).parent().parent().parent().find('input').val('0');--}}
        {{--        // opt_container.find('input').prop('checked', false);--}}
        {{--        $(this).prop('checked', true);--}}
        {{--        $(this).val('1');--}}
        {{--        // $(this).prop('checked', true);--}}
        {{--        $('#adv').val('1');--}}
        {{--    });--}}


        {{--    $('#country').select2();--}}
        {{--    $('#city').select2();--}}
        {{--    $('#state').select2();--}}


        {{--    let client_ads_cont = $('#client_ads_cont');--}}
        {{--    let width_c = client_ads_cont.width();--}}
        {{--    let post = $('.post');--}}
        {{--    let count = post.length;--}}
        {{--    // alert(count);--}}
        {{--    let height_ = post.height() + 16;--}}
        {{--    let width_ = post.width();--}}
        {{--    let count_in_row = Math.floor(width_c / width_);--}}
        {{--    // alert(count_in_row);--}}
        {{--    client_ads_cont.height((6 / count_in_row * height_));--}}


        {{--    let see_more = $('#see_more');--}}
        {{--    see_more.on('click', function () {--}}
        {{--        let visible_posts_count = client_ads_cont.height() / height_;--}}
        {{--        let hidden_posts_count = Math.floor(Math.ceil(count / count_in_row) - visible_posts_count);--}}
        {{--        // alert(12/count_in_row);--}}
        {{--        // alert(Math.ceil(count/count_in_row));--}}
        {{--        // alert(hidden_posts_count);--}}
        {{--        if (hidden_posts_count > 3) {--}}
        {{--            // alert('test');--}}
        {{--            client_ads_cont.height(client_ads_cont.height() + (height_ * 3));--}}
        {{--        } else if (hidden_posts_count === 3) {--}}
        {{--            // alert('not');--}}
        {{--            client_ads_cont.height(client_ads_cont.height() + (height_ * 3));--}}
        {{--            see_more.remove();--}}
        {{--        } else if (hidden_posts_count === 2) {--}}
        {{--            client_ads_cont.height(client_ads_cont.height() + (height_ * 2));--}}
        {{--            see_more.remove();--}}
        {{--        } else {--}}
        {{--            client_ads_cont.height(client_ads_cont.height() + (height_ * 1));--}}
        {{--            see_more.remove();--}}
        {{--        }--}}
        {{--    });--}}

        {{--    let attr_check = $('.attr_check');--}}
        {{--    let all_check = $('.all_check');--}}
        {{--    attr_check.on('click', function () {--}}
        {{--        all_check.prop('checked', false);--}}
        {{--        all_check.val('0')--}}
        {{--    });--}}
        {{--    all_check.change(function () {--}}
        {{--        if (this.checked) {--}}
        {{--            attr_check.prop('checked', false);--}}
        {{--            $(this).val(1);--}}
        {{--        } else {--}}
        {{--            $(this).val(0);--}}
        {{--        }--}}
        {{--    });--}}


        {{--    let img_wid = $('.client_ad_cover img');--}}
        {{--    let div_wid = $('.client_ad_cover');--}}

        {{--    if (parseInt(div_wid.width()) < parseInt(img_wid.width())) {--}}
        {{--        // alert('yes');--}}
        {{--        img_wid.css('width', div_wid.width());--}}
        {{--    }--}}
        {{--    const lang = $('#lang').val();--}}

        {{--    $('.inp_check').on('click', function () {--}}
        {{--        // alert('test0');--}}
        {{--        let check_val = $(this);--}}
        {{--        if (check_val.val() === '0') {--}}

        {{--            check_val.val(1);--}}
        {{--        } else {--}}
        {{--            check_val.val(0);--}}
        {{--        }--}}
        {{--    });--}}
        {{--    // let check_val = $('.inp_check').val();--}}
        {{--    // if (check_val === 1) {--}}
        {{--    //     $(this).prop('checked', true);--}}
        {{--    //--}}
        {{--    // }--}}

        {{--    let card = $('.post');--}}
        {{--    card.hover(function () {--}}
        {{--        let wish_div = $(this).find('.wish_div').css('display', 'block');--}}
        {{--    }, function () {--}}
        {{--        let wish_div = $(this).find('.wish_div').css('display', 'none');--}}
        {{--    });--}}

        {{--    let wish_div = $('.wish_div');--}}
        {{--    wish_div.on('click', function () {--}}
        {{--        let id = $(this).attr('data-target');--}}
        {{--        let img = $(this).find('.wish-btn img');--}}
        {{--        // alert(id);--}}
        {{--        $.ajax({--}}
        {{--            url: "{{route('add.to.wish')}}",--}}
        {{--            data: {--}}
        {{--                _token: "{{csrf_token()}}",--}}
        {{--                id: id,--}}
        {{--            },--}}
        {{--            type: 'POST',--}}
        {{--            success: function (response) {--}}
        {{--                if (typeof (response) != 'object') {--}}
        {{--                    response = $.parseJSON()--}}
        {{--                }--}}
        {{--                console.log(response);--}}
        {{--                let status = response.status;--}}
        {{--                if (status === 1) {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: 'success',--}}
        {{--                        text: response.msg,--}}
        {{--                        dangerMode: false,--}}
        {{--                        confirmButtonColor: '#3085d6',--}}
        {{--                        cancelButtonColor: '#d33',--}}
        {{--                        confirmButtonText: 'حسنا',--}}
        {{--                        showCloseButton: true,--}}
        {{--                    });--}}
        {{--                    img.attr('src', '{{asset('assets/front/images/hearted.png')}}');--}}
        {{--                } else {--}}
        {{--                    Swal.fire({--}}
        {{--                        icon: 'error',--}}
        {{--                        text: response.msg,--}}
        {{--                        dangerMode: false,--}}
        {{--                        confirmButtonColor: '#3085d6',--}}
        {{--                        cancelButtonColor: '#d33',--}}
        {{--                        confirmButtonText: 'حسنا',--}}
        {{--                        showCloseButton: true,--}}
        {{--                    });--}}
        {{--                }--}}
        {{--            }--}}
        {{--        })--}}
        {{--    });--}}
        {{--});--}}




    </script>
@stop

