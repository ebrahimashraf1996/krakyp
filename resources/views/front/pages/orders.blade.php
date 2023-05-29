@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            /*margin-top: 137px*/
        }

        textarea.description_text {
            /*white-space: pre-wrap;*/
            white-space: pre-wrap;
            font-weight: normal;
        }

        .custom-file-button input[type="file"] {
            margin-right: -2px !important;
        }

        .custom-file-button input[type="file"]::-webkit-file-upload-button {
            display: none;
        }

        .custom-file-button input[type="file"]::file-selector-button {
            display: none;
        }

        .custom-file-button:hover label {
            background-color: #dde0e3;
            cursor: pointer;
            border-radius: 0 .25rem .25rem 0 !important;
        }

        .custom-file-button label {
            border-radius: 0 .25rem .25rem 0 !important;
        }

        .required {
            color: red
        }
        .package .card-body .card-text {
            line-height: 29px;
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
                    <span class="bold">حسابي</span>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>

                    <span class="bold">باقاتي</span>
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
    <section class="featured-section pb-5 text-right">
        <div class="container" style="max-width: 1044px">
            <div class="row pt-0 pb-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">باقاتي ...</h3>
                </div>
            </div>
            @if(isset($packs) && $packs->count() > 0)

                <div class="row ">
                    <div class="col-md-12 col-11 col-sm-12 row packages_div m-auto" style="min-height: 300px">
                        @foreach($packs as $pack)
                            <div class="col-md-4 col-sm-12 col-12 package">
                                <div class="card mb-3" style="width: 100%;">
                                    <div class="row g-0">
                                        <div class="col-md-12 bordered"  style="background-image: url('{{asset('assets/front/images/packs.png')}}')">
                                            <div class="card-body">
                                                <h5 class="card-title bold">{{$pack->title}} - ({{$pack->cat->title}})</h5>

                                                <p class="card-text">
                                                    <span class="bold">مدة الإعلان داخل الباقة :</span>
                                                    <span class="duration_span">
                                                {{$pack->duration}} يوم
                                            </span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">عدد الإعلانات داخل الباقة :</span>
                                                    <span>
                                                {{$pack->ads_count}}&nbsp; إعلانات
                                            </span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">عدد الإعلانات المستهلكة :</span>
                                                    <span>
                                                {{$pack->clientAds->count()}}&nbsp; إعلانات
                                            </span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">سعر الباقة : {{$pack->price}}  جنيه</span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold ">حالة الباقة : <span class="btn {{$pack->full_ads == 1 ? 'btn-danger' : 'btn-success'}}">{{$pack->full_ads == 1 ? 'منتهية' : 'مستمرة'}}</span></span>
                                                </p>

                                            </div>
                                            <div id="add_to_cart">
                                                <a href="{{route('pack.myAds', $pack->id)}}" class="btn add_to_cart_btn">
                                                    الإعلانات داخل الباقة
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row packages_div text-center" style="min-height: 300px">
                    <h4 class="m-auto">لا توجد باقات بعد </h4>
                </div>
            @endif

        </div>
    </section>
    {{--    End Featured Cats--}}










@endsection




@section('script')
    <script>
        $(document).ready(function () {

        });
    </script>
@stop

