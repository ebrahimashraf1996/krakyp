@extends('front.layouts.master')

@section('styles')
    <style>
        /*.featured-section{    padding-top: 21px}*/
        /*.category_row {display: none}*/


        .upload_images_btn {
            background-color: #ef6619;
            color: white;
            padding: 0.5rem;
            border-radius: 0.3rem;
            cursor: pointer;
            margin-top: 1rem;
        }


    </style>
    {{--    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />--}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">


    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>





@stop

@section('content')
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    {{--    Start Featured Cats--}}
    <section class="featured-section  text-center">
        <form action="{{route('add.post.one')}}" method="post" id="add-post-form" enctype="multipart/form-data">
            @csrf
            <div class="container step_con step_1" id="step_one_con" style="">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 col-12 card m-auto text-center"
                         style="height: 200px; border-top: 0;max-width: 530px;">
                        <div class="row py-4">
                            <div class="col-xxl-6 col-xl-6 col-md-8 col-sm-12 col-sm-10 m-auto">
                                <div class="steps_title_div">
                                <span class="steps_title hovered">
                                    انشر اعلانك في دقائق بخطوات بسيطة وسهلة
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-9 col-xl-9 col-md-9 col-sm-10 col-10 m-auto">
                                <div class="row ">
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        اختر الفئة
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item text-muted">
                                        بيانات الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  text-muted">
                                        صور الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  text-muted">
                                        بيانات التواصل
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row new_add-post-form-row m-auto">
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 add-post-form m-auto py-3" id="">
                        <div class="row px-4">
                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 py-2" id="new_main_cat">
                                <select class="form-control" id="new_main_cat_id" name="new_main_cat_id">
                                    <option value="">اختر الفئة الرئيسية</option>
                                    @foreach($cats as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 py-2"
                                 id="new_sub_cat_id_div"
                                 disabled="">
                                <select class="form-control" id="new_sub_cat_id" name="new_sub_cat_id" disabled=""
                                        style="width: 100%">
                                    <option value="">اختر الفئة الفرعية</option>
                                </select>
                            </div>
                        </div>
                        <div class="row px-4" id="new_country_row">
                            <div class="form-group col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-12 py-2">
                                <select class="form-control" id="new_country_id" name="new_country_id">
                                    <option value="">اختر المكان</option>
                                    @foreach($locations as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-12 py-2"
                                 id="new_city_id_div"
                                 disabled="">
                                <select class="form-control" id="new_city_id" name="new_city_id" disabled=""
                                        style="width: 100%">
                                    <option value="">اختر المدينة</option>
                                </select>
                            </div>
                            <div class="form-group col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-12 py-2"
                                 id="new_state_id_div"
                                 disabled="">
                                <select class="form-control" id="new_state_id" name="new_state_id" disabled=""
                                        style="width: 100%">
                                    <option value="">اختر الحي/المركز</option>
                                </select>
                            </div>
                        </div>
                        <div class="row px-4" id="new_status_row">
                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 py-2" id="new_status_div"
                                 disabled="">
                                <select class="" id="new_status" name="new_status" disabled="" style="width: 100%">
                                    <option value="">اختر النوع</option>
                                    <option value="free">مجاني</option>
                                    <option value="paid">مدفوع</option>
                                </select>
                            </div>
                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 py-2" id="new_packs_div"
                                 disabled="" style="display: none">
                                <select class="" id="new_pack_id" name="new_pack_id" disabled="" style="width: 100%">
                                    <option value="">اختر الباقة</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn continue_btn" id="finish_step_one">متابعة &nbsp;&nbsp;<i
                                        class="fa fa-arrow-left"></i></span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container step_con step_2" id="step_two_con" style="display: none">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 col-12 card m-auto text-center"
                         style="height: 200px; border-top: 0;max-width: 530px;">
                        <div class="row py-4">
                            <div class="col-xxl-6 col-xl-6 col-md-8 col-sm-12 col-sm-10 m-auto">
                                <div class="steps_title_div">
                                <span class="steps_title hovered">
                                    انشر اعلانك في دقائق بخطوات بسيطة وسهلة
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-9 col-xl-9 col-md-9 col-sm-10 col-10 m-auto">
                                <div class="row ">
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        اختر الفئة
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        بيانات الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  text-muted">
                                        صور الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  text-muted">
                                        بيانات التواصل
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row new_add-post-form-row m-auto">
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 add-post-form m-auto  py-3">
                        <div class="row px-4">

                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 ">
                                <input type="text" class="form-control title_inp" id="title" name="title"
                                       placeholder="ادخل عنوان الإعلان" value="{{old('title')}}" required>
                                @error("title")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 ">
                                <input type="number" class="form-control price_inp" id="price" name="price"
                                       placeholder="السعر ج.م" value="{{old('price')}}" required>
                                @error("price")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 ">
                                <textarea type="description" id="description"
                                          class="form-control" style="height: 150px"
                                          placeholder="ادخل الوصف البسيط للإعلان" name="description"
                                          required>{{old('description')}}</textarea>
                                @error("description")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row px-4" id="all_attrs">
                            @if(isset($categories_with_attrs) && $categories_with_attrs->count() > 0)
                                @foreach($categories_with_attrs as $category_with_attr)
                                    @php
                                        $ordered_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->where('cat_id','=', $category_with_attr->id)->where('parent_id', '=',  null)->where('main_other', '=', 'main')->orderBy('lft', 'ASC')->get();

                                    @endphp
                                    @if(isset($ordered_attributes) && $ordered_attributes->count() > 0)

                                        {{--                                        {{dd($ordered_attributes)}}--}}
                                        <div
                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 category_row"
                                            id="cat_{{$category_with_attr->id}}" style="display: none">

                                            <div class="row">

                                                @foreach($ordered_attributes as $attribute)
                                                    @php
                                                        $final_attr = \App\Models\Attribute::with('options')->find($attribute->attr_id);
                                                    @endphp

                                                    @if($final_attr->type_of == 'main')
                                                        @if($final_attr->appearance == 'buttons' )
                                                            @if($final_attr->type == 'with_options')

                                                                <div
                                                                    class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2">
                                                                    <div class="row cat_main_attribute_btns"
                                                                         data-attr-id="{{$final_attr->id}}">
                                                                        <div
                                                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2">
                                                                            <span class="step-item hovered">
                                                                            {{$final_attr->title}}
                                                                            </span>
                                                                        </div>
                                                                        @foreach($final_attr->options as $key => $option)
                                                                            <div
                                                                                class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-4 ">
                                                                                <label
                                                                                    for="category_{{$category_with_attr->id}}_attribute_{{$option->id}}"
                                                                                    class="btn my-2 custom_select_btn {{$key == 0 ? 'selected' : ''}}">{{$option->val}}</label>
                                                                                <input type="radio"
                                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                       id="category_{{$category_with_attr->id}}_attribute_{{$option->id}}"
                                                                                       value="{{$option->id}}"
                                                                                       class="d-none main_btn_answer" {{$key == 0 ? 'checked' : ''}}>

                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @elseif($final_attr->type == 'yes_no')

                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 my-2 cat_main_attribute_btns"
                                                                    data-attr-id="{{$final_attr->id}}"
                                                                    data-name="{{$final_attr->title}}">
                                                                    <div class="row">
                                                                        <div
                                                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12">
                                                                    <span class="step-item hovered">
                                                                    {{$final_attr->title}}
                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6">
                                                                            <label
                                                                                for="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_yes"
                                                                                class="btn my-2 custom_select_btn ">نعم</label>
                                                                            <input type="radio"
                                                                                   name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                   id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_yes"
                                                                                   value="1"
                                                                                   class="d-none main_btn_answer">
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6">
                                                                            <label
                                                                                for="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_no"
                                                                                class="btn my-2 custom_select_btn selected">لا</label>
                                                                            <input type="radio"
                                                                                   name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                   id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_no"
                                                                                   value="0"
                                                                                   class="d-none main_btn_answer"
                                                                                   checked>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @elseif($final_attr->appearance == 'select')
                                                            @if($final_attr->type == 'with_options')
                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                    <label class="step-item hovered mb-2">
                                                                        {{$final_attr->title}}
                                                                    </label>
                                                                    <select style="width:100%"
                                                                            data-attr-id="{{$final_attr->id}}"
                                                                            class="category_attribute_select"
                                                                            name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                            id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}">
                                                                        <option value="">----</option>

                                                                        @foreach($final_attr->options as $key => $option)
                                                                            <option
                                                                                value="{{$option->id}}">{{$option->val}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @elseif($final_attr->type == 'yes_no')
                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                    <label class="step-item hovered mb-2">
                                                                        {{$final_attr->title}}
                                                                    </label>
                                                                    <select style="width:100%"
                                                                            data-attr-id="{{$final_attr->id}}"
                                                                            class="category_attribute_select"
                                                                            name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                            id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}">
                                                                        <option value="1">نعم</option>
                                                                        <option value="0" selected>لا</option>
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        @elseif ($final_attr->type == 'category')
                                                            @php
                                                                //dd($final_attr->id .'-' . $category_with_attr->id);
                                                                    $children_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->where('cat_id','=', $category_with_attr->id)->where('parent_id', $final_attr->id)->orderBy('lft', 'ASC')->get();

                                                            @endphp
                                                            <div
                                                                class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 custom_list_checks_div">
                                                                <label class="step-item hovered mb-2">
                                                                    {{$final_attr->title}}
                                                                </label>
                                                                <p class="custom_list_checks">
                                                                    <span
                                                                        class="p-r-10 attr_main_category_span">{{$final_attr->title}}</span>
                                                                    <b role="presentation"></b>
                                                                </p>
                                                                <div class="row m-0 pos-relative">
                                                                    <div
                                                                        class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_list_checks_row mx-0 px-0">

                                                                        <div
                                                                            class='pretty p-rotate p-svg p-curve col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2'
                                                                            style='text-align:right; padding-right:20px;'>
                                                                            <input type='checkbox'
                                                                                   class='inp_check check_all_btn'>
                                                                            <div class='state p-warning'>
                                                                                <!-- svg path -->
                                                                                <svg class='svg svg-icon'
                                                                                     viewBox='0 0 20 20'>
                                                                                    <path
                                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                                        style='stroke: white;fill:white;'></path>
                                                                                </svg>
                                                                                <label style='font-size: 13px'>تحديد
                                                                                    الكل</label>
                                                                            </div>
                                                                        </div>
                                                                        {{--                                                                    {{dd($children_attributes)}}--}}
                                                                        @foreach($children_attributes as $child)

                                                                            @php
                                                                                $attr = \App\Models\Attribute::select('id', 'title')->find($child->attr_id)
                                                                            @endphp



                                                                            <div
                                                                                class='pretty p-rotate p-svg p-curve col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 sub_attr_div'
                                                                                style='text-align:right; padding-right:20px;'>
                                                                                <input type='checkbox'
                                                                                       data-attr-id="{{$attr->id}}"
                                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                       class='inp_check sub_attr'
                                                                                       value="1">
                                                                                <div class='state p-warning'>
                                                                                    <!-- svg path -->
                                                                                    <svg class='svg svg-icon'
                                                                                         viewBox='0 0 20 20'>
                                                                                        <path
                                                                                            d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                                            style='stroke: white;fill:white;'></path>
                                                                                    </svg>
                                                                                    <label
                                                                                        style='font-size: 13px'>{{$attr->title}}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @elseif($final_attr->appearance == 'from_to')

                                                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                <label class="step-item hovered mb-2">
                                                                    {{$final_attr->title}}
                                                                </label>
                                                                <input type="number" data-attr-id="{{$final_attr->id}}"
                                                                       placeholder="{{$final_attr->title}}"
                                                                       class="form-control main_from_to_attribute"
                                                                       id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}"
                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]">

                                                            </div>
                                                        @endif

                                                    @endif

                                                @endforeach
                                            </div>
                                            <div
                                                class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 show_other_attrs_div">
                                                <p class="show_other_attrs_btn w-100 bg-warning text-center bold position-relative"
                                                   style="cursor:pointer;" data-id="{{$category_with_attr->id}}">رؤية
                                                    باقي الخصائص (اختياري)
                                                    <span class="show_plus bold pos-absolute"
                                                          style="font-size: 40px; left: 8px;top: -2px; ">+</span>
                                                    <span class="show_minus bold pos-absolute"
                                                          style="font-size: 45px; left: 9px;top:-3px; display: none">-</span>
                                                </p>

                                            </div>
                                        </div>

                                    @endif

                                    @php
                                        $other_ordered_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->where('cat_id','=', $category_with_attr->id)->where('parent_id', null)->where('main_other', 'other')->orderBy('lft', 'ASC')->get();

                                    @endphp
                                    @if(isset($other_ordered_attributes) && $other_ordered_attributes->count() > 0)

                                        {{--                                        {{dd($ordered_attributes)}}--}}
                                        <div
                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 category_other_attrs_row"
                                            id="cat_other_{{$category_with_attr->id}}" style="display: none">

                                            <div class="row">

                                                @foreach($other_ordered_attributes as $attribute)
                                                    @php
                                                        $final_attr = \App\Models\Attribute::with('options')->find($attribute->attr_id);
                                                    @endphp

                                                    @if($final_attr->type_of == 'other')
                                                        @if($final_attr->appearance == 'buttons' )
                                                            @if($final_attr->type == 'with_options')

                                                                <div
                                                                    class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2">
                                                                    <div class="row cat_other_attribute_btns"
                                                                         data-attr-id="{{$final_attr->id}}">
                                                                        <div
                                                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2">
                                                                    <span class="step-item hovered">
                                                                    {{$final_attr->title}}
                                                                    </span>
                                                                        </div>
                                                                        @foreach($final_attr->options as $key => $option)
                                                                            <div
                                                                                class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-4 ">
                                                                                <label
                                                                                    for="category_{{$category_with_attr->id}}_attribute_{{$option->id}}"
                                                                                    class="btn my-2 custom_select_btn {{$key == 0 ? 'selected' : ''}}">{{$option->val}}</label>
                                                                                <input type="radio"
                                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                       id="category_{{$category_with_attr->id}}_attribute_{{$option->id}}"
                                                                                       value="{{$option->id}}"
                                                                                       class="d-none other_btn_answer" {{$key == 0 ? 'checked' : ''}}>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @elseif($final_attr->type == 'yes_no')

                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6 my-2 cat_other_attribute_btns"
                                                                    data-attr-id="{{$final_attr->id}}"
                                                                    data-name="{{$final_attr->title}}">
                                                                    <div class="row">
                                                                        <div
                                                                            class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12">
                                                                    <span class="step-item hovered">
                                                                    {{$final_attr->title}}
                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6">
                                                                            <label
                                                                                for="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_yes"
                                                                                class="btn my-2 custom_select_btn ">نعم</label>
                                                                            <input type="radio"
                                                                                   name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                   id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_yes"
                                                                                   value="1"
                                                                                   class="d-none other_btn_answer">
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6">
                                                                            <label
                                                                                for="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_no"
                                                                                class="btn my-2 custom_select_btn selected">لا</label>
                                                                            <input type="radio"
                                                                                   name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                   id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}_no"
                                                                                   value="0"
                                                                                   class="d-none other_btn_answer"
                                                                                   checked>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @elseif($final_attr->appearance == 'select')
                                                            @if($final_attr->type == 'with_options')
                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                    <label class="step-item hovered mb-2"
                                                                           for="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}">
                                                                        {{$final_attr->title}}
                                                                    </label>
                                                                    <select style="width:100%"
                                                                            data-attr-id="{{$final_attr->id}}"
                                                                            class="other_category_attribute_select"
                                                                            name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                            id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}">
                                                                        <option value="">----</option>

                                                                        @foreach($final_attr->options as $key => $option)
                                                                            <option
                                                                                value="{{$option->id}}">{{$option->val}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @elseif($final_attr->type == 'yes_no')
                                                                <div
                                                                    class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                    <label class="step-item hovered mb-2">
                                                                        {{$final_attr->title}}
                                                                    </label>
                                                                    <select style="width:100%"
                                                                            data-attr-id="{{$final_attr->id}}"
                                                                            class="other_category_attribute_select"
                                                                            name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                            id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}">
                                                                        <option value="1">نعم</option>
                                                                        <option value="0" selected>لا</option>
                                                                    </select>
                                                                </div>

                                                            @endif
                                                        @elseif ($final_attr->type == 'category')

                                                            @php
                                                                //dd($final_attr->id .'-' . $category_with_attr->id);
                                                                    $children_attributes = \Illuminate\Support\Facades\DB::table('attr_cat')->where('cat_id','=', $category_with_attr->id)->where('parent_id', $final_attr->id)->orderBy('lft', 'ASC')->get();

                                                            @endphp
                                                            <div
                                                                class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 custom_list_checks_div">
                                                                <label class="step-item hovered mb-2">
                                                                    {{$final_attr->title}}
                                                                </label>
                                                                <p class="custom_list_checks">
                                                                    <span
                                                                        class="p-r-10 attr_main_category_span">{{$final_attr->title}}</span>
                                                                    <b role="presentation"></b>
                                                                </p>
                                                                <div class="row m-0 pos-relative">
                                                                    <div
                                                                        class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 custom_list_checks_row mx-0 px-0">

                                                                        <div
                                                                            class='pretty p-rotate p-svg p-curve col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2'
                                                                            style='text-align:right; padding-right:20px;'>
                                                                            <input type='checkbox'
                                                                                   class='inp_check check_all_btn'>
                                                                            <div class='state p-warning'>
                                                                                <!-- svg path -->
                                                                                <svg class='svg svg-icon'
                                                                                     viewBox='0 0 20 20'>
                                                                                    <path
                                                                                        d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                                        style='stroke: white;fill:white;'></path>
                                                                                </svg>
                                                                                <label style='font-size: 13px'>تحديد
                                                                                    الكل</label>
                                                                            </div>
                                                                        </div>
                                                                        {{--                                                                    {{dd($children_attributes)}}--}}
                                                                        @foreach($children_attributes as $child)

                                                                            @php
                                                                                $attr = \App\Models\Attribute::select('id', 'title')->find($child->attr_id)
                                                                            @endphp

                                                                            <div
                                                                                class='pretty p-rotate p-svg p-curve col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 sub_attr_div'
                                                                                style='text-align:right; padding-right:20px;'>
                                                                                <input type='checkbox'
                                                                                       data-attr-id="{{$attr->id}}"
                                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]"
                                                                                       class='inp_check sub_attr'
                                                                                       value="1">
                                                                                <div class='state p-warning'>
                                                                                    <!-- svg path -->
                                                                                    <svg class='svg svg-icon'
                                                                                         viewBox='0 0 20 20'>
                                                                                        <path
                                                                                            d='M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z'
                                                                                            style='stroke: white;fill:white;'></path>
                                                                                    </svg>
                                                                                    <label
                                                                                        style='font-size: 13px'>{{$attr->title}}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @elseif($final_attr->appearance == 'from_to')

                                                            <div
                                                                class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2">
                                                                <label class="step-item hovered mb-2">
                                                                    {{$final_attr->title}}
                                                                </label>
                                                                <input type="number" data-attr-id="{{$final_attr->id}}"
                                                                       placeholder="{{$final_attr->title}}"
                                                                       class="form-control other_from_to_attribute"
                                                                       id="category_{{$category_with_attr->id}}_attribute_{{$final_attr->id}}"
                                                                       name="attributes[{{$category_with_attr->id . '_' . $final_attr->id}}]">

                                                            </div>
                                                        @endif
                                                    @endif

                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                @endforeach

                            @endif

                        </div>


                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn back_btn return_back" data-pre-con="1"><i
                                        class="fa fa-arrow-right"></i> &nbsp;&nbsp;عودة للوراء</span>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn continue_btn" id="finish_step_two">متابعة &nbsp;&nbsp;<i
                                        class="fa fa-arrow-left"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container step_con step_3" id="step_three_con" style="display:none">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 col-12 card m-auto text-center"
                         style="height: 200px; border-top: 0;max-width: 530px;">
                        <div class="row py-4">
                            <div class="col-xxl-6 col-xl-6 col-md-8 col-sm-12 col-sm-10 m-auto">
                                <div class="steps_title_div">
                                <span class="steps_title hovered">
                                    انشر اعلانك في دقائق بخطوات بسيطة وسهلة
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-9 col-xl-9 col-md-9 col-sm-10 col-10 m-auto">
                                <div class="row ">
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        اختر الفئة
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        بيانات الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        صور الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/un_marked.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  text-muted">
                                        بيانات التواصل
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row new_add-post-form-row m-auto">
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 add-post-form m-auto  py-3">
                        <div class="row px-4">

                            <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 my-2 ">
                                <div class="row px-4">
                                    <div class="row images_drop bordered my-4">
                                        <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-3">
                                            <span class="bold" style="color: #426ddd">قم تحميل صورة واحدة علي الأقل بحد أقصي 10 صور</span>
                                        </div>

                                        <div class="col-xxl-12 col-xl-12 col-xm-12 col-sm-12 col-12">
                                            <div class="row uploaded_images_container" id="uploaded_images_container"
                                                 dir="ltr">

                                                <div
                                                    class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-8 m-auto empty-image">
                                                    <img src="{{asset('assets/front/images/photos2.svg')}}"
                                                         alt="photos2" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-xl-12 col-xm-12 col-sm-12 col-12 mt-1 mb-3">
                                            <div class="row">
                                                <div
                                                    class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 m-auto image_uploader_div">
                                                    <input type="file" multiple name="images[]" id="actual-btn" hidden/>
                                                    <label for="actual-btn" class="upload_images_btn text-center"><img
                                                            src="{{asset('assets/front/images/camera.svg')}}"
                                                            alt="camera"> اضافة صور

                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn back_btn return_back" data-pre-con="2"><i
                                        class="fa fa-arrow-right"></i> &nbsp;&nbsp;عودة للوراء</span>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn continue_btn" id="finish_step_three">متابعة &nbsp;&nbsp;<i
                                        class="fa fa-arrow-left"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container step_con step_4" id="step_four_con" style="display: none">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 col-12 card m-auto text-center"
                         style="height: 200px; border-top: 0;max-width: 530px;">
                        <div class="row py-4">
                            <div class="col-xxl-6 col-xl-6 col-md-8 col-sm-12 col-sm-10 m-auto">
                                <div class="steps_title_div">
                                <span class="steps_title hovered">
                                    انشر اعلانك في دقائق بخطوات بسيطة وسهلة
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-9 col-xl-9 col-md-9 col-sm-10 col-10 m-auto">
                                <div class="row ">
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        اختر الفئة
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        بيانات الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item hovered">
                                        صور الإعلان
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-xxl-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                        <img src="{{asset('assets/front/images/arrow-solid-gray.svg')}}"
                                             alt="arrow-solid-gray">
                                    </div>
                                    <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-sm-2 m-auto  px-0">
                                        <div>
                                            <img src="{{asset('assets/front/images/marked-radio.png')}}" class="px-2"
                                                 alt="marked-radio">
                                        </div>
                                        <div class="mt-2">
                                        <span class="step-item  hovered">
                                        بيانات التواصل
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row new_add-post-form-row m-auto">
                    <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 add-post-form m-auto  py-3">
                        <div class="row px-4">

                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 position-relative">
                                <label for="phone" class="label-item mb-2">رقم الهاتف &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                        href="javascript:void(0);" style="cursor:pointer;"
                                        id="edit_phone_btn">تغيير؟</a></label>
                                <input type="text" class="form-control phone_inp" id="phone" name="phone"
                                       placeholder="ادخل رقم الهاتف" value="{{backpack_auth()->user()->phone}}" required
                                       readonly>
                                <div class="position-absolute confirm_cancel_phone">
                                    <span id="cancel_phone" class=" btn btn-danger btn-sm mx-2"
                                          data-phone="{{backpack_auth()->user()->phone}}">إلغاء</span>
                                    <span id="confirm_phone" class=" btn btn-success btn-sm mx-2"
                                          data-phone="{{backpack_auth()->user()->phone}}">تأكيد</span>
                                </div>
                            </div>
                            <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-12 my-2 position-relative">
                                <label for="whatsapp" class="label-item mb-2">رقم الواتساب &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                        href="javascript:void(0);" style="cursor:pointer;"
                                        id="edit_whatsapp_btn">تغيير؟</a></label>
                                <input type="text" class="form-control whatsapp_inp" id="whatsapp" name="whatsapp"
                                       placeholder="ادخل رقم الواتساب" value="{{backpack_auth()->user()->whats_app}}"
                                       required readonly>
                                <div class="position-absolute confirm_cancel_whatsapp">
                                    <span id="cancel_whatsapp" class=" btn btn-danger btn-sm mx-2"
                                          data-phone="{{backpack_auth()->user()->whats_app}}">إلغاء</span>
                                    <span id="confirm_whatsapp" class=" btn btn-success btn-sm mx-2"
                                          data-phone="{{backpack_auth()->user()->whats_app}}">تأكيد</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="confirm_phone_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" dir="ltr">
                                        <h5 class="modal-title" id="exampleModalLabel">تأكيد رقم الهاتف</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="otp_phone" class="label-item mb-2">رمز التأكيد</label>
                                        <input type="text" class="form-control otp_phone_inp" id="otp_phone" name="otp_phone"
                                               placeholder="ادخل رمز التأكيد" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إالغاء</button>
                                        <button type="button" id="confirm_otp_phone" class="btn btn-success">تأكيد الرمز</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <span class="btn back_btn return_back" data-pre-con="3"><i
                                        class="fa fa-arrow-right"></i> &nbsp;&nbsp;عودة للوراء</span>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-12 py-2 m-auto text-center">
                                <button type="submit" class="btn" id="post_form_submit">نشر الإعلان &nbsp;&nbsp;
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>
    {{--    End Featured Cats--}}

    <!-- Modal -->



    {{--    <section>--}}
    {{--        <div class="file-loading">--}}
    {{--            <input id="files_1" name="files" type="file" class="file" data-min-file-count="2" multiple>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <div class="modal fade" id="confirm_whatsapp_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" dir="ltr">
                    <h5 class="modal-title" id="exampleModalLabel">تأكيد رقم الواتساب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="otp_whatsapp" class="label-item mb-2">رمز التأكيد</label>
                    <input type="text" class="form-control otp_whatsapp_inp" id="otp_whatsapp" name="otp_whatsapp"
                           placeholder="ادخل رمز التأكيد" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إالغاء</button>
                    <button type="button" id="confirm_otp_whatsapp" class="btn btn-success">تأكيد الرمز</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="" value="" id="phone_confirmed">
    <input type="hidden" name="" value="" id="whats_confirmed">
    <input type="hidden" name="form_data_input" value="" id="form_data_input">


@endsection




@section('script')


    <script>

        $(document).ready(function () {
            var el = document.getElementById('uploaded_images_container');
            var sortable = Sortable.create(el);

            let image_uploader_div = $('.image_uploader_div');
            let change_btn = $('#actual-btn');
            let uploaded_images_container = $('.uploaded_images_container');


            // Upload Images
            $(document).on("change", "#actual-btn", function () {
                let totalfiles = document.getElementById('actual-btn').files.length;


                if (totalfiles > 0) {
                    // alert('test');

                    let form_data = new FormData();

                    for (var index = 0; index < totalfiles; index++) {
                        form_data.append("files[]", document.getElementById('actual-btn').files[index]);
                    }

                    let CSRF_TOKEN = "{{csrf_token()}}";

                    form_data.append('_token', CSRF_TOKEN);

                    let images_count = uploaded_images_container.find('.post-image').length;

                    $.ajax({
                        url: "{{ route('uploadTry') }}",
                        type: 'post',
                        data: form_data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // alert(images_count);
                            for (var index = 0; index < response.data.length; index++) {
                                var src = response.data[index];

                                $('.empty-image').remove();
                                if ((images_count + response.data.length) > 10) {
                                    Swal.fire({
                                        icon: 'error',
                                        text: "الحد الأقصي للصور هو 10 صور",
                                        dangerMode: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'حسنا',
                                        showCloseButton: true,
                                    });
                                } else {

                                    var dt = new Date();
                                    var time = dt.getFullYear() + "_" + dt.getMonth() + "_" + dt.getDay() + "_" + dt.getHours() + "_" + dt.getMinutes() + "_" + dt.getSeconds();

                                    uploaded_images_container.append(
                                        "<div id='image_" + time + index + "' class='col-xxl-3 col-xl-3 col-md-3 col-sm-3 col-6 mb-5 post-image' style='border-radius: 5px;position:relative;' data-source='" + src + "'>" +
                                        "<div class='img_div' style='height:90px;overflow:hidden;border-radius: 5px;position:relative;text-align: center;cursor: grab;'>" +
                                        " <img src='{{asset('/organized')}}" + '/' + src + "'" +
                                        " alt='photos2'  style='height:100%;border-radius: 5px;'>" +
                                        "</div>" +
                                        "<div class='text-center'>" +
                                        "<span data-id='" + time + index + "' class='delete_image btn btn-danger d-inline-block m-auto' style='width:40%;margin-top:6px!important;    margin-right: 2px!important;" +
                                        "    margin-left: 2px!important;'><i class='fa fa-trash'></i></span>" +
                                        "<span data-id='" + time + index + "' class='cover_btn btn btn-success d-inline-block m-auto' style='width:50%;margin-top:6px!important;margin-right: 2px!important;" +
                                        "margin-left: 2px!important;'>غلاف ؟</span>" +
                                        " </div>" +
                                        " </div>"
                                    );

                                    image_uploader_div.find('#actual-btn').remove();
                                    image_uploader_div.append("<input type=\"file\" multiple name=\"images[]\" id=\"actual-btn\" hidden/>");


                                }
                            }
                            console.log(response.data)

                        },
                        error: function (response) {
                            console.log("error : " + JSON.stringify(response));
                        }

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي اختيار صورة واحدة علي الاقل",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                }
            });

            // Delete Image
            $(document).on("click", ".delete_image", function () {
                let id = $(this).attr('data-id');
                let image_src = $(this).parent().parent().attr('data-source');
                // alert(image_src)


                $.ajax({
                    url: "{{route('deleteOrganize')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        image_path: image_src,
                    },
                    type: "POST",
                    success: function (response) {
                        // alert(images_count);
                        if (response.status === 1) {
                            let deleted_image = $('#image_' + id);
                            deleted_image.remove();
                            Swal.fire({
                                icon: 'success',
                                text: "تم حذف الصورة بنجاح",
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: "حدث خطأ ما .. برجاء المحاولة مرة اخري",
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        }


                    },
                    error: function (response) {
                        console.log("error : " + JSON.stringify(response));
                    }

                });

            });

            // Set Cover
            $(document).on("click", ".cover_btn", function () {
                let id = $(this).attr('data-id');
                // alert(id)
                let covered_image = $('#image_' + id);
                $('.img_div').removeClass('covered');
                $('.cover_btn').text('غلاف ؟');

                covered_image.find('.img_div').addClass('covered');
                $(this).text('تم');
            });


        });
    </script>



    <script>
        $(document).ready(function () {

            let new_main_cat_id = $('#new_main_cat_id');
            let new_sub_cat_id = $('#new_sub_cat_id');
            let new_country_id = $('#new_country_id');
            let new_city_id = $('#new_city_id');
            let new_state_id = $('#new_state_id');
            let new_status = $('#new_status');
            let new_pack_id = $('#new_pack_id');
            let new_packs_div = $('#new_packs_div');
            let finish_step_one = $('#finish_step_one');
            let finish_step_two = $('#finish_step_two');
            let finish_step_three = $('#finish_step_three');
            let post_form = $('#add-post-form');
            let step_one_con = $('#step_one_con');
            let show_other_attrs_btn = $('.show_other_attrs_btn');
            let return_back = $('.return_back');

            let edit_phone_btn = $('#edit_phone_btn');
            let confirm_cancel_phone = $('.confirm_cancel_phone');
            let cancel_phone = $('#cancel_phone');
            let confirm_phone = $('#confirm_phone');
            let phone = $('#phone');
            let confirm_otp_phone = $('#confirm_otp_phone');
            let otp_phone = $('#otp_phone');
            let otp_whatsapp = $('#otp_whatsapp');
            let phone_confirmed = $('#phone_confirmed');
            let whats_confirmed = $('#whats_confirmed');

            let edit_whatsapp_btn = $('#edit_whatsapp_btn');
            let cancel_whatsapp = $('#cancel_whatsapp');
            let confirm_whatsapp = $('#confirm_whatsapp');
            let whatsapp = $('#whatsapp');
            let confirm_cancel_whatsapp = $('.confirm_cancel_whatsapp');
            let confirm_otp_whatsapp = $('#confirm_otp_whatsapp');

            // Updated Parts

            let custom_select_2 = $('.custom_select_2');
            let category_row = $('.category_row');
            let custom_select_btn = $('.custom_select_btn');
            let category_attribute_select = $('.category_attribute_select');
            let other_category_attribute_select = $('.other_category_attribute_select');


            let post_form_submit = $('#post_form_submit');
            let data = [];
            // End


            new_main_cat_id.select2();
            new_sub_cat_id.select2();
            new_country_id.select2();
            new_city_id.select2();
            new_state_id.select2();
            new_status.select2();
            new_pack_id.select2();
            category_attribute_select.each(function () {
                let id = $(this).attr('id');
                // alert(id);

                $('#' + id).select2();
            });
            other_category_attribute_select.each(function () {
                let id = $(this).attr('id');
                // alert(id);

                $('#' + id).select2();
            });

            $('#country').select2();
            $('#cat_id').select2();


            const lang = $('#lang').val();

            /* Start New Updates */

            // Step One

            // Change Main Category
            new_main_cat_id.change(function () {
                let main_cat_id = $(this).val();
                if (main_cat_id !== "") {
                    $.ajax({
                        url: "/get-child-cat/" + main_cat_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: main_cat_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data);
                            new_sub_cat_id.removeAttr('disabled');
                            new_sub_cat_id.find('option').remove();
                            if (response.status === 1) {
                                let data = response.data;
                                // console.log(data);
                                let html_option = '';
                                let new_data = [];
                                new_data.push({
                                    id: '',
                                    text: '<span>اختر الفئة الفرعية</span>',
                                    html: '<span>اختر الفئة الفرعية</span>',
                                    title: 'اختر الفئة الفرعية',
                                });

                                $.each(data, function (i, item) {
                                    new_data.push({
                                        id: item.id,
                                        text: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        html: "<div class='div_sub_cat_icon_custom' style='display: inline-block'><span class='sub_cat_icon_custom mdi " + item.cat_icon + "'" + "</span></div><div class='div_sub_cat_title_custom' style='display: inline-block'> <span class='sub_cat_title_custom'>" + item.title[lang] + "</span> </div>",
                                        title: item.title[lang]
                                    });
                                });
                                new_status.val(''); // Select the option with a value of '1'
                                new_status.trigger('change'); // Notify any JS components that the value changed
                                new_status.attr('disabled', true);


                                // console.log(new_data);
                                new_sub_cat_id.select2({
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
                            }
                        }
                    });
                } else {
                    new_sub_cat_id.find('option').remove();
                    let empty_data = [];
                    empty_data.push({
                        id: "",
                        text: '<span>اختر الفئة الفرعية</span>',
                        html: '<span>اختر الفئة الفرعية</span>',
                        title: 'اختر الفئة الفرعية'
                    });

                    new_sub_cat_id.select2({
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


                    new_status.val(''); // Select the option with a value of '1'
                    new_status.trigger('change'); // Notify any JS components that the value changed
                    new_status.attr('disabled', true);


                    new_pack_id.find('option').remove();
                    let newOption = [{
                        id: "",
                        text: '<span>اختر الباقة</span>',
                        html: '<span>اختر الباقة</span>',
                        title: 'اختر الباقة'
                    }];
                    new_pack_id.select2({
                        data: newOption,
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
                    new_pack_id.val('');
                    new_pack_id.trigger('change');
                    new_pack_id.attr('disabled', true);

                }
            });

            // Change Sub Category
            new_sub_cat_id.change(function () {
                let new_sub_cat_id_val = $(this).val();
                if (new_sub_cat_id_val !== "") {

                    let all_attrs_div = $('.category_row');
                    let all_other_attrs_div = $('.category_other_attrs_row');

                    all_attrs_div.css('display', 'none');
                    all_other_attrs_div.css('display', 'none');

                    let main_attrs_div = $('#cat_' + new_sub_cat_id_val);

                    main_attrs_div.css('display', 'block');


                    // alert('test')
                    $.ajax({
                        url: "/checkPackages/" + new_sub_cat_id_val,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: new_sub_cat_id_val,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            // console.log(response.data);
                            // new_state_id.find('option').remove();
                            if (response.status === 1) {
                                // let data = response.data;
                                // console.log(response.status);

                                let new_statuses = [{
                                    id: "",
                                    text: '<span>اختر النوع</span>',
                                    html: '<span>اختر النوع</span>',
                                    title: 'اختر النوع'
                                },
                                    {
                                        id: "free",
                                        text: '<span>اعلان مجاني</span>',
                                        html: '<span>اعلان مجاني</span>',
                                        title: 'اعلان مجاني'
                                    }, {
                                        id: "paid",
                                        text: '<span>اعلان مدفوع</span>',
                                        html: '<span>اعلان مدفوع</span>',
                                        title: 'اعلان مدفوع'
                                    }];

                                new_status.select2({
                                    data: new_statuses,
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
                                new_status.val(''); // Select the option with a value of '1'
                                new_status.trigger('change'); // Notify any JS components that the value changed
                                new_status.removeAttr('disabled');
                                new_pack_id.css('display', 'none');


                            } else {
                                let new_statuses = [{
                                    id: "",
                                    text: '<span>اختر النوع</span>',
                                    html: '<span>اختر النوع</span>',
                                    title: 'اختر النوع'
                                },
                                    {
                                        id: "free",
                                        text: '<span>اعلان مجاني</span>',
                                        html: '<span>اعلان مجاني</span>',
                                        title: 'اعلان مجاني'
                                    }];

                                new_status.select2({
                                    data: new_statuses,
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
                                new_status.val(''); // Select the option with a value of '1'
                                new_status.trigger('change'); // Notify any JS components that the value changed
                                new_status.removeAttr('disabled');
                            }


                        }
                    });
                } else {
                    new_status.val(''); // Select the option with a value of '1'
                    new_status.trigger('change'); // Notify any JS components that the value changed
                    new_status.attr('disabled', true);
                    new_packs_div.css('display', 'none');
                }
            });

            // Change Free Or Paid
            new_status.on('change', function () {
                // alert('ettedsa')
                let new_pack_id = $('#new_pack_id');
                new_pack_id.val(''); // Select the option with a value of '1'
                new_pack_id.trigger('change'); // Notify any JS components that the value changed
                new_pack_id.attr('disabled', true);
                new_packs_div.css('display', 'none');


                let new_status_val = $(this).val();
                let user_id = "{{backpack_auth()->id()}}";

                if (new_status_val === 'paid') {
                    let new_sub_cat_id = $('#new_sub_cat_id').val();
                    if (new_sub_cat_id !== "") {
                        $.ajax({
                            url: "/get-user-packages/",
                            data: {
                                _token: "{{csrf_token()}}",
                                id: user_id,
                                subcat_id: new_sub_cat_id,
                            },
                            type: "POST",
                            success: function (response) {
                                if (typeof (response) != 'object') {
                                    response = $.parseJSON(response)
                                }
                                // console.log(response.data);
                                let data = response.data;
                                if (data.length > 0) {
                                    let new_data = [];
                                    new_data.push({
                                        id: '',
                                        text: '<span>اختر الباقة</span>',
                                        html: '<span>اختر الباقة</span>',
                                        title: 'اختر الباقة',
                                    });

                                    $.each(data, function (i, item) {
                                        new_data.push({
                                            id: item.id,
                                            text: "<span>" + item.title + "  (عدد الإعلانات المتبقية : " + (item.ads_count - item.client_ads) + ")</span>",
                                            html: "<span>" + item.title + "  (عدد الإعلانات المتبقية : " + (item.ads_count - item.client_ads) + ")</span>",
                                            title: "<span>" + item.title + "  (عدد الإعلانات المتبقية : " + (item.ads_count - item.client_ads) + ")</span>"
                                        });
                                    });

                                    // console.log(new_data);
                                    new_pack_id.select2({
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

                                    new_pack_id.val(''); // Select the option with a value of '1'
                                    new_pack_id.trigger('change'); // Notify any JS components that the value changed
                                    new_pack_id.removeAttr('disabled');
                                    new_packs_div.css('display', 'block');

                                } else {

                                    new_pack_id.val(''); // Select the option with a value of '1'
                                    new_pack_id.trigger('change'); // Notify any JS components that the value changed
                                    new_pack_id.attr('disabled', true);
                                    new_packs_div.css('display', 'none');

                                    Swal.fire({
                                        icon: 'error',
                                        text: "ليس لديك أي باقات في هذه الفئة .. يمكنك شراء باقات من هنا",
                                        dangerMode: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'شراء باقات',
                                        showCloseButton: true,

                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "{{route('buy-package')}}";
                                        }
                                    });
                                }

                            }
                        });
                    } else {
                        new_pack_id.val(''); // Select the option with a value of '1'
                        new_pack_id.trigger('change'); // Notify any JS components that the value changed
                        new_pack_id.attr('disabled', true);
                        new_packs_div.css('display', 'none');
                    }
                } else if (new_status_val === 'free') {
                    new_pack_id.val(''); // Select the option with a value of '1'
                    new_pack_id.trigger('change'); // Notify any JS components that the value changed
                    new_pack_id.attr('disabled', true);
                    new_packs_div.css('display', 'none');
                }

            });

            // Change Country
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

                            let new_states = [];
                            new_states.push({
                                id: "",
                                text: '<span>اختر الحي/المركز</span>',
                                html: '<span>اختر الحي/المركز</span>',
                                title: 'اختر الحي/المركز'
                            });
                            new_state_id.attr('disabled', true);
                            new_state_id.find('option').remove();

                            new_state_id.select2({
                                data: new_states,
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
                                    text: '<span>اختر المدينة</span>',
                                    html: '<span>اختر المدينة</span>',
                                    title: 'اختر المدينة',
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

            // Change City
            new_city_id.change(function () {
                let new_city_id = $(this).val();
                if (new_city_id !== "") {
                    $.ajax({
                        url: "/get-child-city/" + new_city_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: new_city_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            if (response.status === 1) {
                                let data = response.data;
                                // console.log(data);

                                let html_option = '';
                                let new_states = [];
                                new_states.push({
                                    id: "",
                                    text: '<span>اختر الحي/المركز</span>',
                                    html: '<span>اختر الحي/المركز</span>',
                                    title: 'اختر الحي/المركز'
                                });

                                $.each(data, function (i, item) {
                                    new_states.push({
                                        id: item.id,
                                        text: "<span>" + item.name + "</span>",
                                        html: "<span>" + item.name + "</span>",
                                        title: item.name
                                    });
                                });

                                new_state_id.removeAttr('disabled');

                                new_state_id.select2({
                                    data: new_states,
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
                        }
                    });
                } else {
                    new_state_id.find('option').remove();
                    let empty_data = [];
                    empty_data.push({
                        id: "",
                        text: '<span>اختر الحي/المركز</span>',
                        html: '<span>اختر الحي/المركز</span>',
                        title: 'اختر الحي/المركز'
                    });

                    new_state_id.select2({
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

            // Click on Finish Step One
            finish_step_one.on('click', function () {
                let new_main_cat_id = $('#new_main_cat_id');
                let new_sub_cat_id = $('#new_sub_cat_id');
                let new_country_id = $('#new_country_id');
                let new_city_id = $('#new_city_id');
                let new_state_id = $('#new_state_id');
                let new_status = $('#new_status');
                let new_pack_id = $('#new_pack_id');
                if (
                    new_main_cat_id.val() === '' ||
                    new_sub_cat_id.val() === ''
                    || new_country_id.val() === '' ||
                    new_city_id.val() === '' ||
                    new_state_id.val() === '' ||
                    new_status.val() === '' ||
                    new_status.val() === 'paid' && new_pack_id.val() === ''
                ) {
                    Swal.fire({
                        icon: 'error',
                        text: "برجاء ملء البيانات الخاصة بالإعلان",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {

                    data['main_cat_id'] = new_main_cat_id.val();
                    data['sub_cat_id'] = new_sub_cat_id.val();
                    data['country_id'] = new_country_id.val();
                    data['city_id'] = new_city_id.val();
                    data['state_id'] = new_state_id.val();
                    data['status'] = new_status.val();
                    data['pack_id'] = new_pack_id.val();


                    $('#step_one_con').slideUp();
                    $('#step_two_con').slideDown();
                }
            });


            // collect Data of Main Attributes Then Other Attributes
            // Click on Finish Step Two
            finish_step_two.on('click', function () {
                // console.log(data);
                let title = $('#title');
                let price = $('#price');
                let description = $('#description');
                let cat_main_container = $('#cat_' + data['sub_cat_id']);
                let cat_other_container = $('#cat_other_' + data['sub_cat_id']);


                let post_details = [];
                if (title.val() === '' || price.val() === '' || description.val() === '') {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي اتمام الحقول الإلزامية",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {
                    post_details['title'] = title.val();
                    post_details['price'] = price.val();
                    post_details['description'] = description.val();
                }


                // get Main Buttons Data
                let main_btns_attrs_answers = [];
                let cat_main_attribute_btns_selection = cat_main_container.find('.cat_main_attribute_btns');
                // alert(cat_main_attribute_btns_selection.length);
                // cat_main_attribute_btns_selection.css('border', '5px solid red');
                cat_main_attribute_btns_selection.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    let name = $(this).attr('data-name');
                    // alert(name + ": " + attr_id);
                    let checked_btn = $(this).find('input.main_btn_answer:checked');
                    // alert(checked_btn.length);
                    let attr_val = checked_btn.val();
                    // alert(attr_val);
                    let main_button_attr_answer = [attr_id, attr_val];
                    main_btns_attrs_answers.push(main_button_attr_answer);
                });


                // Check if Main Attrs Select is Null
                let category_main_attribute_select = cat_main_container.find('select.category_attribute_select');
                let select_errors = 0;
                let main_selects_attrs_answers = [];
                // get Errors of Not Selected Items
                category_main_attribute_select.each(function () {
                    let selected_val = $(this).val();
                    if (selected_val === '') {
                        select_errors = select_errors + 1;
                    }
                });
                // Check if There is errors
                if (select_errors > 0) {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي مراجعة الاختيارات الصحيحة",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {
                    //if Not push items with its values
                    category_main_attribute_select.each(function () {
                        let attr_id = $(this).attr('data-attr-id');
                        let selected_val = $(this).val();
                        let main_select_attr_answer = [attr_id, selected_val];
                        main_selects_attrs_answers.push(main_select_attr_answer);
                    });

                }


                // Check if Main Attrs From_To is Null
                let category_main_attribute_from_to = cat_main_container.find('.main_from_to_attribute');
                let from_to_errors = 0;
                let main_from_to_attrs_answers = [];
                category_main_attribute_from_to.each(function () {
                    let from_to_val = $(this).val();
                    if (from_to_val === '') {
                        from_to_errors = from_to_errors + 1;
                    }
                });
                // Check if There is errors
                if (from_to_errors > 0) {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي اتمام الحقول الإلزامية",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {
                    //if Not push items with its values
                    category_main_attribute_from_to.each(function () {
                        let attr_id = $(this).attr('data-attr-id');
                        let from_to_val = $(this).val();
                        let main_from_to_attr_answer = [attr_id, from_to_val];
                        main_from_to_attrs_answers.push(main_from_to_attr_answer);
                    });
                }


                // Get Category Sub Attributes Answer
                // let custom_list_checks_div
                // sub_attr
                let main_sub_check_boxs = [];
                let cat_main_sub_attribute = cat_main_container.find('.sub_attr:checked');
                // alert(cat_main_sub_attribute.length);
                // cat_main_sub_attribute.css('border', '5px solid red');
                cat_main_sub_attribute.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    let attr_val = $(this).val();
                    // alert(attr_val);
                    let main_sub_check_box = [attr_id, attr_val];
                    main_sub_check_boxs.push(main_sub_check_box);
                });


                console.log(post_details);
                console.log(main_selects_attrs_answers);
                console.log(main_btns_attrs_answers);
                console.log(main_from_to_attrs_answers);
                console.log(main_sub_check_boxs);


                //Start Other Attributes


                // get Other Buttons Data (Done)
                let other_btns_attrs_answers = [];
                let cat_other_attribute_btns_selection = cat_other_container.find('.cat_other_attribute_btns');
                // alert(cat_other_attribute_btns_selection.length);
                // cat_other_attribute_btns_selection.css('border', '5px solid red');
                cat_other_attribute_btns_selection.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    // let name = $(this).attr('data-name');
                    // alert( attr_id);
                    let checked_btn = $(this).find('input.other_btn_answer:checked');
                    // alert(checked_btn.length);
                    let attr_val = checked_btn.val();
                    // alert(attr_val);
                    let other_button_attr_answer = [attr_id, attr_val];
                    other_btns_attrs_answers.push(other_button_attr_answer);
                });


                // Get Other Attrs Select Data (Done)
                let category_other_attribute_select = cat_other_container.find('select.other_category_attribute_select');
                let other_selects_attrs_answers = [];
                // push items with its values
                category_other_attribute_select.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    let selected_val = $(this).val();
                    if (selected_val !== '') {
                        let other_select_attr_answer = [attr_id, selected_val];
                        other_selects_attrs_answers.push(other_select_attr_answer);
                    }
                });


                // get Other Attrs From_To Data
                let category_other_attribute_from_to = cat_other_container.find('.other_from_to_attribute');
                let other_from_to_attrs_answers = [];
                // push items with its values
                category_other_attribute_from_to.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    let from_to_val = $(this).val();
                    if (from_to_val !== '') {
                        let other_from_to_attr_answer = [attr_id, from_to_val];
                        other_from_to_attrs_answers.push(other_from_to_attr_answer);
                    }
                });


                // Get Category Sub Attributes Answer (Done)
                // let custom_list_checks_div
                // sub_attr
                let other_sub_check_boxs = [];
                let cat_other_sub_attribute = cat_other_container.find('.sub_attr:checked');
                // alert(cat_other_sub_attribute.length);
                // cat_other_sub_attribute.css('border', '5px solid red');
                cat_other_sub_attribute.each(function () {
                    let attr_id = $(this).attr('data-attr-id');
                    let attr_val = $(this).val();
                    // alert(attr_val);
                    let other_sub_check_box = [attr_id, attr_val];
                    other_sub_check_boxs.push(other_sub_check_box);
                });


                console.log(other_btns_attrs_answers);
                console.log(other_selects_attrs_answers);
                console.log(other_from_to_attrs_answers);
                console.log(other_sub_check_boxs);


                if (title.val() !== '' &&
                    price.val() !== '' &&
                    description.val() !== '' &&
                    select_errors === 0 &&
                    from_to_errors === 0
                ) {
                    data['title'] = title.val();
                    data['price'] = price.val();
                    data['description'] = description.val();

                    data['main_attributes'] = [];
                    data['main_attributes'].push(main_selects_attrs_answers);
                    data['main_attributes'].push(main_btns_attrs_answers);
                    data['main_attributes'].push(main_from_to_attrs_answers);
                    data['main_attributes'].push(main_sub_check_boxs);

                    data['other_attributes'] = [];
                    data['other_attributes'].push(other_btns_attrs_answers);
                    data['other_attributes'].push(other_selects_attrs_answers);
                    data['other_attributes'].push(other_from_to_attrs_answers);
                    data['other_attributes'].push(other_sub_check_boxs);


                    $('#step_two_con').slideUp();
                    $('#step_three_con').slideDown();

                } else {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي اتمام الحقول الإلزامية",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                }

            });


            // Collect Images Data
            // Click on Finish Step Three
            finish_step_three.on('click', function () {
                let images_data = [];
                let images = $('.post-image');
                images.each(function () {
                    let img_src = $(this).attr('data-source');
                    images_data.push(img_src);
                });
                let cover_image = $('.covered');
                // console.log(images_data);
                if (images_data.length > 0 && images_data.length < 11 && cover_image.length > 0) {
                    data['images'] = images_data;
                    data['cover'] = cover_image.parent().attr('data-source');

                    $('#step_three_con').slideUp();
                    $('#step_four_con').slideDown();
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: "يرجي اختيار صورة الغلاف",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                }
            });

            // Latest Updates
            custom_select_btn.on('click', function () {
                let custom_btn_rows = $(this).parent().parent();
                let custom_btns = custom_btn_rows.find('.custom_select_btn');
                custom_btns.removeClass('selected');
                $(this).addClass('selected');
            });


            // Custom Pretty Check Box
            $(".custom_list_checks").click(function () {
                let custom_list_checks_row = $(this).parent().find('.custom_list_checks_row');
                let custom_overlay = $('.custom_overlay');
                custom_list_checks_row.slideToggle("fast");
                if (custom_overlay.hasClass('active')) {
                    custom_overlay.removeClass('active');
                } else {
                    custom_overlay.addClass('active');
                }

            });


            // Check All
            let check_all_btn = $('.check_all_btn');
            check_all_btn.change(function () {
                if (this.checked) {
                    let children_attrs = $(this).parent().parent().find('.sub_attr');
                    children_attrs.prop('checked', true);
                } else {

                    let children_attrs = $(this).parent().parent().find('.sub_attr');
                    children_attrs.prop('checked', false);
                }
            });

            let sub_attr = $('.sub_attr');
            sub_attr.click(function () {
                // if (this.checked) {
                // let unchecked_sub_attrs = $(this).parent().parent().find('.sub_attr_div .sub_attr:checkbox:not(:checked)');
                let check_all_btn = $(this).parent().parent().find('div .check_all_btn');
                // alert(unchecked_sub_attrs);
                // if (unchecked_sub_attrs.length > 0) {
                check_all_btn.prop('checked', false);
                // } else {
                //     check_all_btn.prop('checked', true);

                // }
                // }


            });


            // See Other Attributes
            show_other_attrs_btn.on('click', function () {
                let cat_id = $(this).attr('data-id');
                let cat_other_ = $('#cat_other_' + cat_id);
                let show_plus = $(this).find('.show_plus');
                let show_minus = $(this).find('.show_minus');
                if (cat_other_.css('display') === 'none') {
                    show_plus.css('display', 'none');
                    show_minus.css('display', 'block');
                    cat_other_.slideDown();
                } else {
                    show_plus.css('display', 'block');
                    show_minus.css('display', 'none');
                    cat_other_.slideUp();
                }
                // alert(cat_id);

            });


            return_back.on('click', function () {
                let pre_con = $(this).attr('data-pre-con');
                let step_con = $('.step_con');
                let pre_step = $('.step_' + pre_con);

                step_con.slideUp();
                pre_step.slideDown();
            });


            // 11/5/2023

            // Set Cover from post images
            let post_image = $('.post-image');
            let uploaded_images_container = $('.uploaded_images_container');
            uploaded_images_container.find('.delete_image').on('click', function () {
                alert('test');
                let id = $(this).attr('data-id');
                alert(id);
            });
            // When Set Cover set input named Post_cover value with this image name

            // Delete Image by sweet alert (Done)


            // Info Contact Details Step 4
            edit_phone_btn.on('click', function () {
                $(this).css('display', 'none');
                phone.attr('readonly', false);
                confirm_cancel_phone.css('display', 'block');
            });

            // 3- Cancel With Same Phone

            // 4- Cancel With Other Phone
            cancel_phone.on('click', function () {
                let original_phone = "{{backpack_auth()->user()->phone}}";
                phone.val(original_phone);
                confirm_cancel_phone.css('display', 'none');
                edit_phone_btn.css('display', 'inline-block');
                phone.attr('readonly', true);

            });


            confirm_phone.on('click', function () {
                let original_phone = "{{backpack_auth()->user()->phone}}";
                let new_phone = phone.val();
                // alert(new_phone);
                if (original_phone === new_phone) {
                    // 1- Confirm With Same Phone -> Swal Fire رقم الهاتف لم يتغير

                    Swal.fire({
                        icon: 'success',
                        text: "رقم الهاتف لم يتغير",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {

                    // 2- Confirm With Other Phone -> Send OTP


                    // Send Otp and Return it in Session['otp]
                    $('#confirm_phone_modal').modal('show');

                }
            });


            confirm_otp_phone.on('click', function () {

                // When Confirm check if Enter Code  === Session['otp']

                //if true
                $('#confirm_phone_modal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    text: "تم تأكيد رقم الهاتف بنجاح .. يمكنك المتابعة الان",
                    dangerMode: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حسنا',
                    showCloseButton: true,
                });
                phone.attr('readonly', true);
                confirm_cancel_phone.css('display', 'none');
                edit_phone_btn.css('display', 'inline-block');
                phone_confirmed.val(1);
                otp_phone.val('');

                // if False
                // Swal.fire({
                //     icon: 'error',
                //     text: "رمز التأكيد غير صحيح .. برجاء ادخال الرمز الصحيح",
                //     dangerMode: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'حسنا',
                //     showCloseButton: true,
                // });

            });


            edit_whatsapp_btn.on('click', function () {
                $(this).css('display', 'none');
                whatsapp.attr('readonly', false);
                confirm_cancel_whatsapp.css('display', 'block');

            });
            // 3- Cancel With Same whatsapp
            // 4- Cancel With Other whatsapp
            cancel_whatsapp.on('click', function () {
                let original_whatsapp = "{{backpack_auth()->user()->whats_app}}";
                whatsapp.val(original_whatsapp);
                confirm_cancel_whatsapp.css('display', 'none');
                edit_whatsapp_btn.css('display', 'inline-block');
                whatsapp.attr('readonly', true);
            });


            confirm_whatsapp.on('click', function () {
                let original_whatsapp = "{{backpack_auth()->user()->whats_app}}";
                let new_whatsapp = whatsapp.val();
                // alert(new_whatsapp);
                if (original_whatsapp === new_whatsapp) {
                    // 1- Confirm With Same whatsapp -> Swal Fire رقم الواتساب لم يتغير

                    Swal.fire({
                        icon: 'success',
                        text: "رقم الواتساب لم يتغير",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {

                    // 2- Confirm With Other whatsapp -> Send OTP


                    // Send Otp and Return it in Session['otp]
                    $('#confirm_whatsapp_modal').modal('show');

                }
            });


            confirm_otp_whatsapp.on('click', function () {

                // When Confirm check if Enter Code  === Session['otp']

                //if true
                $('#confirm_whatsapp_modal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    text: "تم تأكيد رقم الواتساب بنجاح .. يمكنك المتابعة الان",
                    dangerMode: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حسنا',
                    showCloseButton: true,
                });
                whatsapp.attr('readonly', true);
                confirm_cancel_whatsapp.css('display', 'none');
                edit_whatsapp_btn.css('display', 'inline-block');
                whats_confirmed.val(1);
                otp_whatsapp.val('');


                // if False
                // Swal.fire({
                //     icon: 'error',
                //     text: "رمز التأكيد غير صحيح .. برجاء ادخال الرمز الصحيح",
                //     dangerMode: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'حسنا',
                //     showCloseButton: true,
                // });

            });


            // وهو بينهي لو مأكدش رقم التليفون او الوتساب هنقولو انت مأكدتش رقم الهاتف .. تحب تستخدم الرقم الأساسي ؟
            let overlay = $('.overlay');
            let lds_roller = $('.lds-roller');
            // Submit Form
            post_form.on('submit', function (e) {
                e.preventDefault();

                if (phone.val() !== '{{backpack_auth()->user()->phone}}' && phone_confirmed.val() !== '1' ||
                    whatsapp.val() !== '{{backpack_auth()->user()->whats_app}}' && whats_confirmed.val() !== '1') {

                    Swal.fire({
                        icon: 'error',
                        text: "لم يتم تأكيد رقم الهاتف أو الواتساب .. يمكنك استخدام أرقام الهاتف و الواتساب الخاصة بك",
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonText: 'استخدام',
                        cancelButtonText: 'رجوع',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            data['phone'] = 'original';
                            data['whats_app'] = 'original';
                            // console.log(data['phone']);
                            // console.log(data['whats_app']);

                            overlay.addClass('active');
                            lds_roller.addClass('active');

                            let result = saveThePost(data);

                            Swal.fire({
                                icon: 'success',
                                text: result,
                                dangerMode: false,
                                confirmButtonColor: '#00ff00',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                            {{--window.setTimeout(function () {--}}
                            {{--    window.location.href = "{{route('site.home')}}";--}}
                            {{--}, 800);--}}
                        }
                    })

                } else if (phone.val() === '{{backpack_auth()->user()->phone}}' &&
                    whatsapp.val() === '{{backpack_auth()->user()->whats_app}}') {
                    data['phone'] = 'original';
                    data['whats_app'] = 'original';

                    overlay.addClass('active');
                    lds_roller.addClass('active');


                    let result = saveThePost(data);

                    Swal.fire({
                        icon: 'success',
                        text: result,
                        dangerMode: false,
                        confirmButtonColor: '#00ff00',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                    {{--window.setTimeout(function () {--}}
                    {{--    window.location.href = "{{route('site.home')}}";--}}
                    {{--}, 800);--}}
                    // console.log(data['phone']);
                    // console.log(data['whats_app']);
                } else {
                    data['phone'] = phone.val();
                    data['whats_app'] = whatsapp.val();

                    overlay.addClass('active');
                    lds_roller.addClass('active');

                    let result = saveThePost(data);

                    Swal.fire({
                        icon: 'success',
                        text: result,
                        dangerMode: false,
                        confirmButtonColor: '#00ff00',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                    {{--window.setTimeout(function () {--}}
                    {{--    window.location.href = "{{route('site.home')}}";--}}
                    {{--}, 800);--}}

                }
                // let form_data_input = $('#form_data_input');
                //
                // form_data_input.val(data);


                // Send Request Function





            });


            // Most Important Function in Website
            function saveThePost(data) {
                $.ajax({
                    url: "{{route('new.post.add')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        main_cat_id: data['main_cat_id'],
                        sub_cat_id: data['sub_cat_id'],
                        country_id: data['country_id'],
                        city_id: data['city_id'],
                        state_id: data['state_id'],
                        status: data['status'],
                        pack_id: data['pack_id'],
                        title: data['title'],
                        price: data['price'],
                        description: data['description'],
                        main_attributes: data['main_attributes'],
                        other_attributes: data['other_attributes'],
                        images: data['images'],
                        cover: data['cover'],
                        phone: data['phone'],
                        whats_app: data['whats_app'],
                    },
                    type: "POST",
                    success: function (response) {
                        console.log(response);

                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response.data);
                        if (response.status === 1) {
                            let slug = response.data['slug'];
                            let msg = response.msg;
                            console.log(data);

                            return msg;


                        }
                    }
                });

            }


            /* ENd New Updates */


            let cat = $('select#cat_id');
            let cats_row = $('#cats_row');
            cat.change(function () {
                let cat_id = cat.val();
                // alert(cat_id);

                if (cat_id !== "") {

                    $('#sub_cat_id_div').remove();
                    $('#pack_id_div').remove();
                    $('.nice-select span').text('اختر النوع');
                    $('.nice-select ul li[data-value=""]').addClass('selected');
                    $('.nice-select ul li[data-value="paid"]').removeClass('selected');
                    $('.nice-select ul li[data-value="free"]').removeClass('selected');
                    $('#status').val('');

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
                            let html_select = "<li data-value='' data-display=\"اختر الفئة الفرعية\" class=\"option \">اختر الفئة الفرعية</li>";

                            if (response.status === 1) {
                                let data = response.data;
                                data.forEach(myFunction);

                                function myFunction(item, index) {
                                    html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['title'][lang] + "</option>";
                                    html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['title'][lang] + "</li>";
                                }

                                // console.log(data[0]);
                                console.log(html_option);

                                cats_row.append(
                                    "<div class=\"form-group col-md-5 \" id='sub_cat_id_div'>\n" +
                                    " <label for=\"sub_cat_id\" class=\"mb-2\">الفئة الفرعية</label>\n" +
                                    "    <select class=\"form-control select2-hidden-accessible\" id=\"sub_cat_id\" name=\"sub_cat_id\" data-select2-id=\"select2-data-sub_cat_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                    " <option value=''>اختر الفئة الفرعية</option>" +
                                    html_option +
                                    " </select>" +
                                    " </div>"
                                );
                                $('#sub_cat_id').select2();
                                $('#sub_cat_id_div').find('span.select2').css('width', '100%');

                            }
                            let sub_cat = $('#sub_cat_id');
                            sub_cat.on("select2:select", function () {
                                $('#pack_id_div').remove();
                                $('.nice-select span').text('اختر النوع');
                                $('.nice-select ul li[data-value=""]').addClass('selected');
                                $('.nice-select ul li[data-value="paid"]').removeClass('selected');
                                $('.nice-select ul li[data-value="free"]').removeClass('selected');
                                $('#status').val('');


                                let sub_cat_id = $(this).val();
                                $('#sub_cat_id_inp').val(sub_cat_id);
                                $('select#status').find('option[value="paid"]').removeAttr('disabled');
                                $('li[data-value="paid"]').removeClass('disabled');

                            });
                        }

                    });
                } else {
                    $('#sub_cat_id_div').remove();
                }
            });

            let country = $('select#country');
            let country_row = $('#country_row');
            country.on("select2:select", function (e) {
                let country_id = $(this).val();
                // alert(country_id);
                if (country_id !== "") {
                    $('#city_id_div').remove();
                    $('#state_id_div').remove();

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
                            let html_select = "<li data-value='' data-display=\"اختر المدينة\" class=\"option \">اختر المدينة</li>";

                            if (response.status === 1) {
                                let data = response.data;
                                data.forEach(myFunction);

                                function myFunction(item, index) {
                                    html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";
                                    html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";
                                }

                                // console.log(data[0]);
                                console.log(html_option);

                                country_row.append(
                                    "<div class=\"form-group col-md-3 \" id='city_id_div'>\n" +
                                    " <label for=\"city_id\" class=\"mb-2\">المدينة</label>\n" +
                                    " <select class=\"form-control select2-hidden-accessible\" id=\"city_id\" name=\"city_id\" data-select2-id=\"select2-data-city_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                    " <option value=''>اختر المدينة</option>" +
                                    html_option +
                                    " </select>" +
                                    " </div>"
                                );
                                $('#city_id').select2();
                                $('#city_id_div').find('span.select2').css('width', '100%');

                                let city_id = $('select#city_id');
                                city_id.on("select2:select", function (e) {
                                    let city_id = $(this).val();
                                    // alert(city_id);
                                    if (city_id !== "") {
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
                                                let html_select = "<li data-value='' data-display=\"اختر الحي / المركز\" class=\"option \">اختر الحي / المركز</li>";

                                                if (response.status === 1) {
                                                    let data = response.data;
                                                    data.forEach(myFunction);

                                                    function myFunction(item, index) {
                                                        html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['name'] + "</option>";
                                                        html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['name'] + "</li>";
                                                    }

                                                    // console.log(data[0]);
                                                    console.log(html_option);

                                                    country_row.append(
                                                        "<div class=\"form-group col-md-3 \" id='state_id_div'>\n" +
                                                        " <label for=\"state_id\" class=\"mb-2\">الحي / المركز</label>\n" +
                                                        " <select class=\"form-control select2-hidden-accessible\" id=\"state_id\" name=\"state_id\" data-select2-id=\"select2-data-state_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                                        " <option value=''>اختر الحي / المركز</option>" +
                                                        html_option +
                                                        " </select>" +
                                                        " </div>"
                                                    );
                                                    $('#state_id').select2();
                                                    $('#state_id_div').find('span.select2').css('width', '100%');

                                                }
                                            }
                                        });
                                    } else {
                                        $('#state_id_div').remove();
                                    }

                                });

                            } else {

                            }
                        }
                    });


                } else {
                    $('#city_id_div').remove();
                    $('#state_id_div').remove();
                }

            });


            /*
            * */
            let status = $('select#status');
            let status_row = $('#status_row');
            status.on('change', function () {
                // alert('test');
                let status_val = $(this).val();
                // alert(status_val)
                let user_id = "{{backpack_auth()->id()}}";
                if (status_val === 'paid') {
                    let sub_cat_id_inp = $('#sub_cat_id_inp').val();
                    if (sub_cat_id_inp !== "") {
                        $.ajax({
                            url: "/get-user-packages/" + user_id + "/" + sub_cat_id_inp,
                            data: {
                                _token: "{{csrf_token()}}",
                                id: user_id,
                            },
                            type: "POST",
                            success: function (response) {
                                if (typeof (response) != 'object') {
                                    response = $.parseJSON(response)
                                }
                                console.log(response.data);
                                let html_option = "";
                                let html_select = "<li data-value='' data-display=\"اختر الباقة\" class=\"option \">اختر الباقة</li>";

                                if (response.status === 1) {
                                    let data = response.data;

                                    if (data.length > 0) {


                                        data.forEach(myFunction);

                                        function myFunction(item, index) {
                                            if (data[index]['ads_count'] - data[index]['client_ads'].length > 0) {
                                                // alert('test')
                                                html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['title'] + " (عدد الإعلانات المتبقية : " + (data[index]['ads_count'] - data[index]['client_ads'].length) + ")</option>";
                                                html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['title'] + "</li>";
                                            }

                                        }

                                        // console.log(data[0]);
                                        console.log(html_option);

                                        status_row.append(
                                            "<div class=\"form-group col-md-5 \" id='pack_id_div'>\n" +
                                            " <label for=\"pack_id\" class=\"mb-2\">اختر الباقة</label>\n" +
                                            "    <select class=\"form-control select2-hidden-accessible\" id=\"pack_id\" name=\"pack_id\" data-select2-id=\"select2-data-pack_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                            " <option value=''>اختر الباقة</option>" +
                                            html_option +
                                            " </select>" +
                                            " </div>"
                                        );
                                        $('#pack_id').select2();
                                        $('#pack_id_div').find('span.select2').css('width', '100%');
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            text: "ليس لديك أي باقات في هذه الفئة .. يمكنك شراء باقات من هنا",
                                            dangerMode: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'شراء باقات',
                                            showCloseButton: true,

                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "{{route('buy-package')}}";
                                            }
                                        });


                                        //
                                        $('.nice-select span').text('مجاني');
                                        $('.nice-select ul li[data-value="free"]').addClass('selected');
                                        $('.nice-select ul li[data-value="paid"]').removeClass('selected');
                                    }
                                }
                            }
                        });
                    } else {
                        // alert('test');
                        swal({
                            title: "اختر الفئة الفرعية أولا",
                            dangerMode: true,
                            button: "حسنا",
                        });
                        $('.nice-select span').text('مجاني');
                        $('.nice-select ul li[data-value="free"]').addClass('selected');
                        $('.nice-select ul li[data-value="paid"]').removeClass('selected');
                    }


                } else {
                    $('#pack_id_div').remove();
                }
            });
            /*
            * */


            // $('#add-post-form').submit(function (e) {
            //     e.preventDefault();
            //     let cat = $('#cat_id');
            //     let sub_cat = $('#sub_cat_id');
            //     let country = $('#country');
            //     let city_id = $('#city_id');
            //     let state_id = $('#state_id');
            //     let status = $('#status');
            //     let pack_id = $('#pack_id');
            //
            //     if (cat.length > 0 && cat.val() === "") {
            //         // $('#cats_row .form-group .select2 .selection').find('span.select2-selection').css('border-color', 'red');
            //         Swal.fire({
            //             icon: 'error',
            //             text: "اختر الفئة الرئيسية أولا",
            //             dangerMode: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'حسنا',
            //             showCloseButton: true,
            //
            //         });
            //     } else {
            //         if (sub_cat.length > 0 && sub_cat.val() === "") {
            //             Swal.fire({
            //                 icon: 'error',
            //                 text: "اختر الفئة الفرعية أولا",
            //                 dangerMode: true,
            //                 confirmButtonColor: '#3085d6',
            //                 cancelButtonColor: '#d33',
            //                 confirmButtonText: 'حسنا',
            //                 showCloseButton: true,
            //
            //             });
            //         } else {
            //             if (country.length > 0 && country.val() === "") {
            //                 Swal.fire({
            //                     icon: 'error',
            //                     text: "اختر المكان أولا",
            //                     dangerMode: true,
            //                     confirmButtonColor: '#3085d6',
            //                     cancelButtonColor: '#d33',
            //                     confirmButtonText: 'حسنا',
            //                     showCloseButton: true,
            //
            //                 });
            //             } else {
            //                 if (city_id.length > 0 && city_id.val() === "") {
            //                     Swal.fire({
            //                         icon: 'error',
            //                         text: "اختر المدينة أولا",
            //                         dangerMode: true,
            //                         confirmButtonColor: '#3085d6',
            //                         cancelButtonColor: '#d33',
            //                         confirmButtonText: 'حسنا',
            //                         showCloseButton: true,
            //
            //                     });
            //                 } else {
            //                     if (state_id.length > 0 && state_id.val() === "") {
            //                         Swal.fire({
            //                             icon: 'error',
            //                             text: "اختر المركز / الحي أولا",
            //                             dangerMode: true,
            //                             confirmButtonColor: '#3085d6',
            //                             cancelButtonColor: '#d33',
            //                             confirmButtonText: 'حسنا',
            //                             showCloseButton: true,
            //
            //                         });
            //                     } else {
            //                         if (status.length > 0 && status.val() === "") {
            //                             Swal.fire({
            //                                 icon: 'error',
            //                                 text: "اختر نوع الإعلان أولا",
            //                                 dangerMode: true,
            //                                 confirmButtonColor: '#3085d6',
            //                                 cancelButtonColor: '#d33',
            //                                 confirmButtonText: 'حسنا',
            //                                 showCloseButton: true,
            //
            //                             });
            //                         } else if (status.length > 0 && status.val() === "paid") {
            //                             if (pack_id.length > 0 && pack_id.val() === "") { //
            //                                 Swal.fire({
            //                                     icon: 'error',
            //                                     text: "اختر الباقة أولا",
            //                                     dangerMode: true,
            //                                     confirmButtonColor: '#3085d6',
            //                                     cancelButtonColor: '#d33',
            //                                     confirmButtonText: 'حسنا',
            //                                     showCloseButton: true,
            //                                 });
            //                             } else {
            //                                 $(this).unbind('submit').submit();
            //                             }
            //                         } else {
            //                             $(this).unbind('submit').submit();
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //     }
            //
            // })


        });
    </script>
@stop



































