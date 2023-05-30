@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            /*margin-top: 137px*/
        }

        .empty_cart {
            min-height: 300px;
        }

        .empty_cart h4 {
            margin: auto
        }
        .items_list th {vertical-align:baseline;}
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

                    <span class="bold">سلة الشراء</span>


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
    <section class="featured-section text-center">
        <div class="container">
            <div class="row head_title py-4">
                <div class="col-md-12 col-sm-12 ">
                    <h3 class="bold">سلة الشراء</h3>
                </div>
            </div>
            <div class="cart-table">
                @if(isset($cart_items) && $cart_items->count() > 0)

                    <table class="table table-hover mb-0 ">
                        <tbody class="table-light">
                        <tr>
                            <th>
                                <span class="bold">
                                    الفئة
                                </span>
                            </th>
                            <th>
                                <span class="bold">
                                    اسم الباقة
                                </span>
                            </th>
                            <th>
                                <span class="bold">
                                    السعر
                                </span>
                            </th>
                            <th>
                                <span class="bold">
                                    اجراءات
                                </span>
                            </th>
                        </tr>
                        @foreach($cart_items as $k => $item)

                            <tr id="tr_{{$item->id}}" class="items_list">
                                <th style="text-align: center">
                                    <span>
                                    {{$item->userPack->category->title}}
                                    </span>
                                </th>
                                <th style="text-align: center">
                                    <span>
                                    {{$item->userPack->title}}
                                    </span>
                                </th>
                                <th style="text-align: center">
                                    <span>{{$item->userPack->price}} جنيه</span>

                                </th>
                                <th>
                                    <a href="javascript:void(0);" class="btn btn-danger delete_cart_item"
                                       data-bs-item="{{$item->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </th>
                            </tr>

                        @endforeach
                        <tr class="items_list">
                            <th style="text-align: center" colspan="2">
                                الإجمالي
                            </th>
                            <th style="text-align: center">
                                <span class="total_cart">{{General::totalCartPrice()}} جنيه</span>
                            </th>
                            <th></th>

                        </tr>
                        </tbody>
                    </table>

                @endif

                <div class="row empty_cart card {{$cart_items->count() > 0 ? 'd-none' : ''}}">
                    <h4 class="">السلة فارغة ..</h4>
                </div>
                <div class="row buy_some {{$cart_items->count() > 0 ? 'd-none' : ''}}">
                    <div class="col-md-4 col-12 col-sm-12 m-auto my-2">
                        <a href="{{route('buy-package')}}" class="btn add_some_packages w-100">أضف بعض الباقات </a>
                    </div>
                </div>

            </div>
            @if(isset($cart_items) && $cart_items->count() > 0)

                <div class="row mt-4 pay_title ">
                    <div class="col-md-12">
                        <h3 class="bold">اختر وسيلة الدفع</h3>
                    </div>
                </div>
                <div class="row mt-4 pay_method pb-4">
                    <div class="col-md-8 col-lg-8 col-12 m-auto card payments ">
                        <div class="row mx-0">
                            <div class="col-md-3 col-lg-3 col-4 payment_method">
                                <a href="{{route('checkout', encrypt('vcash'))}}">
                                    <img src="{{asset('assets/front/images/v-cash.png')}}" alt="payment-image"
                                         style="width: 100%">
                                </a>
                            </div>
                            <div class="col-md-3 col-lg-3 col-4 payment_method">
                                <a href="{{route('checkout', encrypt('paypal'))}}">
                                    <img src="{{asset('assets/front/images/paypal.png')}}" alt="payment-image"
                                         style="width: 100%">
                                </a>
                            </div>
                            <div class="col-md-3 col-lg-3 col-4 payment_method">
                                <a href="{{route('checkout', encrypt('visa'))}}">
                                    <img src="{{asset('assets/front/images/v-m.png')}}" alt="payment-image"
                                         style="width: 100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </section>
    {{--    End Featured Cats--}}


    {{--{{dd(General::getTotalCartPrice())}}--}}







@endsection




@section('script')

    <script>


        // swal("هل أنت متأكد ؟", "", "info");
        // swal({
        //     title: "هل أنت متأكد ؟",
        //     text: "",
        //     icon: "info",
        //     buttons: ["إلغاء" , "حذف"],
        //     dangerMode: true,
        // })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             swal("Poof! Your imaginary file has been deleted!", {
        //                 icon: "success",
        //             });
        //         }
        //     });


        $(document).ready(function () {

            let delete_cart_item = $('.delete_cart_item');
            delete_cart_item.on('click', function (e) {
                e.preventDefault();
                let id = $(this).attr('data-bs-item');
                let item_id = $(this).attr('data-bs-item');

                Swal.fire({
                    title: 'هل أنت متأكد ؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'إلغاء',
                    confirmButtonText: 'حذف الآن!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete-cart/' + item_id,
                            data: {
                                id: item_id
                            },
                            type: 'get',
                            success: function (response) {
                                if (typeof (response) != 'object') {
                                    response = $.parseJSON(response)
                                }
                                console.log(response.data);
                                if (response.status === 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'تم الحذف بنجاح!',
                                        confirmButtonText: 'حسنا',
                                        confirmButtonColor: '#3085d6',
                                        }
                                    );
                                    $('#tr_' + response.data['id']).remove();
                                    let count = response.data['count'];
                                    let new_cost = response.data['new_cost'];
                                    $('.total_cart').text(new_cost);
                                    if (parseInt(count) < 1) {
                                        $('.empty_cart').removeClass('d-none');
                                        $('.items_list').remove();
                                        $('.pay_title').remove();
                                        $('.pay_method').remove();
                                        $('.buy_some').removeClass('d-none');
                                    }
                                } else {
                                    Swal.fire({
                                            icon: 'error',
                                            title: 'حدث خطأ ما .. برجاء المحاولة فيما بعد !',
                                            confirmButtonText: 'حسنا',
                                            confirmButtonColor: '#d60900',
                                        }
                                    );
                                }
                            }
                        });

                    }
                });
            });
            // let deleted_val = $('#deleted_input').val();


// swal("هل أنت متأكد ؟", "", "info");
//             swal({
//                 title: "هل أنت متأكد ؟",
//                 text: "",
//                 icon: "info",
//                 buttons: ["إلغاء" , "حذف"],
//                 dangerMode: true,
//             })
//                 .then((willDelete) => {
//                     if (willDelete) {
//                         swal("Poof! Your imaginary file has been deleted!", {
//                             icon: "success",
//                         });
//                     }
//                 });


        });
    </script>
@stop

