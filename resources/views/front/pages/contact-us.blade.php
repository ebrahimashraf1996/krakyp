@extends('front.layouts.master')

@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('styles')
    {{--    {!! htmlScriptTagJsApi() !!}--}}
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

                    <span class="bold">تواصل معنا</span>


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
    <section class="contact-us mt-4 pb-5">
        <div class="container" style="max-width: 1050px;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h1>{{__('messages.happy')}}</h1>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-md-6 col-sm-6 col-xs-6 col-12 contact-methods">
                    <div class="mb-3">
                        <p class="mb-3">
                            إذا كنت تواجه أي مشكلة أو ترغب في الإبلاغ عن إعلان أو معلن لا تتردد أبدأ بالتواصل معنا في
                            أي وقت. كل ماعليك هو ملئ النموذج التالي ببيانات صحيحة وسنقوم بمراجعة طلبك في أسرع وقت.
                        </p>
                    </div>
                    <div class="mt-2">
                        <ul>
                            @php
                                $settings = \App\Models\Setting::first();
                            @endphp
                            @if($settings->twitter != null)
                                <li>
                                    <a href="{{$settings->twitter}}" target="_blank">
                                        <i class="fa-brands fa-twitter"></i>
                                        <span> تويتر</span>
                                    </a>
                                </li>
                            @endif
{{--                            @if($settings->linkedin != null)--}}

{{--                                <li>--}}
{{--                                    <a href="{{$settings->linkedin}}" target="_blank">--}}
{{--                                        <i class="fa-brands fa-linkedin"></i>--}}
{{--                                        <span> لينكد إن</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

                            @if($settings->whatsapp != null)

                                <li><a href="{{$settings->whatsapp}}" target="_blank"><i class="fa-brands fa-whatsapp"></i> <span> واتساب</span></a>
                                </li>
                            @endif
                            @if($settings->instagram != null)
                                <li>
                                    <a href="{{$settings->instagram}}" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                        <span> انستجرام</span>
                                    </a>
                                </li>
                            @endif
                            @if($settings->email != null)
                                <li><a href="mailto:{{$settings->email}}"><i class="fa-regular fa-envelope"></i>
                                        <span> الجيميل الرسمي</span></a>
                                </li>
                            @endif
                            @if($settings->snap_chat != null)
                                <li>
                                    <a href="{{$settings->snap_chat}}" target="_blank">
                                        <i class="fa-brands fa-snapchat"></i>
                                        <span> سناب شات</span>
                                    </a>
                                </li>
                            @endif

                            @if($settings->facebook != null)
                                <li><a href="{{$settings->facebook}}" target="_blank"><i
                                            class="fa-brands fa-facebook-square"></i>
                                        <span>فيسبوك</span></a>
                                </li>
                            @endif
{{--                            @if($settings->youtube != null)--}}
{{--                                <li>--}}
{{--                                    <a href="{{$settings->youtube}}" target="_blank">--}}
{{--                                        <i class="fa-brands fa-youtube"></i>--}}
{{--                                        <span> يوتيوب</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                            @if($settings->phone != null)
                                <li><a href="tel:{{$settings->phone}}"><i class="fa-solid fa-phone"></i>
                                        <span> اتصل الآن</span></a>
                                </li>
                            @endif
{{--                            @if($settings->skype != null)--}}
{{--                                <li>--}}
{{--                                    <a href="{{$settings->skype}}" target="_blank">--}}
{{--                                        <i class="fa-brands fa-skype"></i>--}}
{{--                                        <span> يوتيوب</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

                        </ul>
                    </div>

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-12">
                    <form action="{{route('send.contact.us')}}" method="post" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control"
                                   placeholder="{{__('messages.form.name')}}" id="name">
                            @if ($errors->has('name'))
                                <span class="required">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                   placeholder="{{__('messages.form.email')}}" id="email" aria-describedby="emailHelp">
                            @if ($errors->has('email'))
                                <span class="required">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control"
                                   placeholder="{{__('messages.form.phone')}}" id="phone">
                            @if ($errors->has('phone'))
                                <span class="required">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="reason">{{__('messages.form.reason.choose')}}</label>
                            <select name="reason" class="wide" id="reason">
                                <option value="">{{__('messages.form.reason.choose')}}</option>
                                <option value="explain">{{__('messages.form.reason.explain')}}</option>
                                <option value="report_post" {{isset($client_ad_serial) && $client_ad_serial != null ? 'selected' : ''}}>إبلاغ عن إعلان</option>
                                <option value="report_seller" {{isset($client_serial) && $client_serial != null ? 'selected' : ''}}>إبلاغ عن بائع</option>
                            </select>
                            @if ($errors->has('reason'))
                                <span class="required">
                                <strong>{{ $errors->first('reason') }}</strong>
                            </span>
                            @endif
                        </div>
{{--                        <input type="hidden" value="" name="reason" id="reason">--}}
                        <div class="mb-3">
                            <input type="text" name="serial_num" class="form-control {{isset($client_ad_serial) && $client_ad_serial != null || isset($client_serial) && $client_serial != null ? '' : 'd-none'}} "
                                   placeholder="الرقم التسلسلي" id="serial_num" value="{{isset($client_ad_serial) && $client_ad_serial != null ? $client_ad_serial : ''}} {{isset($client_serial) && $client_serial != null ? $client_serial : ''}}">
                            @if ($errors->has('serial_num'))
                                <span class="required">
                                <strong>{{ $errors->first('serial_num') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea placeholder="اشرح مشكلتك أو استفسارك" class="form-control" id="message"
                                      rows="3" name="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="required">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="submit" value="{{__('messages.send')}}" class="btn btn_submit w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@section('script')
    <script>

        $(document).ready(function () {
            let selected_reason = $('#reason');
            let serial_num = $('#serial_num');
            selected_reason.on('change', function () {
                let selected_val = $(this).val();
                if(selected_val === 'report_seller' || selected_val === 'report_post') {
                    serial_num.removeClass('d-none');
                } else {
                    serial_num.addClass('d-none');
                    serial_num.val('');
                }
            });
            // let inp = $('#reason');
            //
            // let option1 = $(".contact-us div.nice-select ul.list li[data-value|='exchange']");
            // let val1 = option1.data('value');
            // option1.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val1);
            //     $('#noOrder').attr('type', 'text');
            // });
            //
            // let option2 = $(".contact-us div.nice-select ul.list li[data-value|='return']");
            // let val2 = option2.data('value');
            // option2.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val2);
            //     $('#noOrder').attr('type', 'text');
            // });
            //
            // let option3 = $(".contact-us div.nice-select ul.list li[data-value|='hurry']");
            // let val3 = option3.data('value');
            // option3.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val3);
            //     $('#noOrder').attr('type', 'text');
            // });
            //
            // let option4 = $(".contact-us div.nice-select ul.list li[data-value|='explain']");
            // let val4 = option4.data('value');
            // option4.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val4);
            //     $('#noOrder').attr('type', 'hidden');
            // });
            //
            // let option5 = $(".contact-us div.nice-select ul.list li[data-value|='other']");
            // let val5 = option5.data('value');
            // option5.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val5);
            //     $('#noOrder').attr('type', 'hidden');
            // });
            // let option0 = $(".contact-us div.nice-select ul.list li[data-value|='']");
            // let val0 = option0.data('value');
            // option0.on('click', function (e) {
            //     e.preventDefault();
            //     inp.val(val0);
            //     $('#noOrder').attr('type', 'hidden');
            // });




        });


    </script>
@stop
