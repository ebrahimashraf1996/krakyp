@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            margin-top: 137px
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



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">باقاتي </h3>
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

