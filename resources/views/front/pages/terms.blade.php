@extends('front.layouts.master')

@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('styles')
    {{--    {!! htmlScriptTagJsApi() !!}--}}
    <style>
        .terms {
            /*margin-top: 137px*/
        }
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

                    <span>بنود استخدام الخدمة</span>
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
    <section class="terms pb-5">
        <div class="container" style="max-width: 1044px">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h1 class="bold">بنود الخدمة ...</h1>
                </div>

            </div>
            <div class="row card mt-5">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12 contact-methods">
                    <div class="mb-3">
                        <p class="mb-3">
                            {!! $settings->terms !!}
                        </p>
                    </div>


                </div>

            </div>
        </div>
    </section>

@stop
@section('script')
    <script>




    </script>
@stop
