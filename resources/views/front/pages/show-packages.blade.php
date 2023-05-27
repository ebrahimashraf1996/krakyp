@extends('front.layouts.master')

@section('styles')
    <style>
        /*.featured-section{margin-top: 137px}*/
        .packages_div {
            min-height: 300px
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
                    <a href="{{route('buy-package')}}" class="bold">إظهار الباقات المتاحة</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>

                    <span class="bold">اختيار الباقة</span>


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
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">اختيار باقة</h3>
                </div>
            </div>
            @if(isset($packs) && $packs->count() > 0)

                <div class="row ">
                    <div class="col-md-12 col-11 col-sm-12 packages_div m-auto" style="max-width: 1000px">
                        @foreach($packs as $item)
                            <div class="col-md-4 col-sm-12 col-12 package">
                                <div class="card mb-3" style="width: 100%;">
                                    <div class="row g-0">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="discount_div"
                                                     style="background-image: url('{{asset('assets/front/images/discount.png')}}') ">
                                                    <span class="bold discount_span">{{$item->discount}}%</span>
                                                </div>
                                                <h5 class="card-title bold">{{$item->title}}</h5>
                                                <p class="card-text" style="line-height: 30px;font-size: 18px">
                                                    {{$item->description}}
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">مدة الإعلان داخل الباقة :</span>
                                                    <span class="duration_span">
                                                {{$item->duration}} يوم
                                            </span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">عدد الإعلانات :</span>
                                                    <span>
                                                {{$item->ads_count}}&nbsp; إعلانات
                                            </span>
                                                </p>
                                                <p class="card-text">
                                                    <span class="bold">سعر الباقة : {{$item->price}}  جنيه</span>
                                                </p>

                                            </div>
                                            <div id="add_to_cart">
                                                <button class="btn add_to_cart_btn" data-bs-target="{{$item->id}}">أضف
                                                    إلي السلة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if(backpack_auth()->check())
                    @php
                        $count = \App\Models\Cart::where('user_id', backpack_auth()->user()->id)->where('order_id', null)->count();
                    @endphp
                    <div class="row pb-5 complete_order {{$count == 0 ? 'd-none' : ''}}">
                        <div class="col-md-12 col-11 col-sm-11 m-auto" style="max-width: 1000px; text-align: left">
                            <div class="row" dir="ltr">
                                <div class="col-md-3 col-11 col-sm-11">

                                    <a href="{{route('cart.index')}}" class="btn view_cart mt-3">
                                        إتمام الطلب
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            @else
                <div class="row">
                    <div
                        class="col-md-12 col-11 col-sm-12 text-center packages_div m-auto d-flex justify-content-center"
                        style="max-width: 1000px">

                        <h4 class="m-auto">لا توجد باقات في هذه الفئة بعد </h4>
                    </div>
                </div>
            @endif
        </div>
    </section>
    {{--    End Featured Cats--}}

@endsection




@section('script')
    <script>
        $(document).ready(function () {
            let cart_btn = $('.add_to_cart_btn');
            let complete_order = $('.complete_order');
            cart_btn.on('click', function (e) {
                e.preventDefault();
                let item_id = $(this).attr('data-bs-target');
                // alert(item_id);
                $.ajax({
                    url: "/add-to-cart/" + item_id,
                    data: {
                        _token: "{{csrf_token()}}",
                        id: item_id,
                        @if(backpack_auth()->check())
                        user_id: "{{backpack_auth()->user()->id}}"
                        @endif
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }


                        if (response.status === 1) {
                            let msg = response.msg;
                            let data = response.data;
                            // alert(data);
                            complete_order.removeClass('d-none');
                            if (response.msg) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'success',
                                    text: response.msg,
                                    dangerMode: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'حسنا',
                                    showCloseButton: true,
                                });

                            }
                        } else if (response.status === 0) {
                            let msg = response.msg;
                            // alert(data);
                            console.log(response);

                            if (response.msg) {
                                Swal.fire({
                                    icon: 'error',
                                    text: response.msg,
                                    dangerMode: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'حسنا',
                                    showCloseButton: true,
                                });
                            }
                        } else if (response.status === 2) {
                            console.log(response);
                            Swal.fire({
                                icon: 'error',
                                text: response.msg,
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        }
                    }

                });

            });
        });
    </script>
@stop

