@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section{margin-top: 137px}
        .packages_div {min-height: 300px}
    </style>
@stop

@section('content')
    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">شراء باقة</h3>
                </div>
            </div>
            @if(isset($packs) && $packs->count() > 0)

            <div class="row ">
                <div class="col-md-12 col-11 col-sm-12 row packages_div m-auto">
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
                                        <button class="btn add_to_cart_btn" data-bs-target="{{$item->id}}">أضف إلي السلة</button>
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
                    <div class="row complete_order {{$count == 0 ? 'd-none' : ''}}">
                        <div class="col-md-3 col-11 col-sm-11 m-auto">
                            <a href="{{route('cart.index')}}" class="btn view_cart mt-3">
                                إتمام الطلب
                            </a>
                        </div>
                    </div>
            @endif
            @else
                <div class="row packages_div text-center">
                    <h4 class="m-auto">لا توجد باقات في هذه الفئة بعد </h4>
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

