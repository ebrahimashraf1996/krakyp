@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            margin-top: 137px
        }

        .empty_cart {
            min-height: 300px;
        }

        .empty_cart h4 {
            margin: auto
        }
    </style>
@stop

@section('content')



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12 ">
                    <h3 class="bold">سلة المشتريات</h3>
                </div>
            </div>
            <div class="cart-table">
                @if(isset($cart_items) && $cart_items->count() > 0)

                    <table class="table table-hover mb-0 ">
                        <tbody class="table-light">
                        @foreach($cart_items as $k => $item)

                            <tr id="tr_{{$item->id}}">
                                <th style="text-align: right">
                                    {{$item->userPack->category->title}} &nbsp;&nbsp; - &nbsp;&nbsp;
                                    {{$item->userPack->title}}
                                </th>
                                <th style="text-align: left">
                                    <span>{{$item->userPack->price}} جنيه</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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
                            <th style="text-align: right">
                                الإجمالي
                            </th>
                            <th style="text-align: left">
                                <span class="total_cart">{{General::totalCartPrice()}}</span><span>جنيه</span>
                            </th>
                            <th></th>

                        </tr>
                        </tbody>
                    </table>

                @endif

                <div class="row empty_cart  {{$cart_items->count() > 0 ? 'd-none' : ''}}">
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
                <div class="row mt-4 pay_method ">
                    <div class="col-md-10 m-auto ">
                        <div class="row">
                            <div class="col-md-4 payment_method">
                                <a href="{{route('checkout', encrypt('vcash'))}}">
                                    <img src="{{asset('assets/front/images/v-cash.png')}}" alt="payment-image"
                                         style="width: 100%">
                                </a>
                            </div>
                            <div class="col-md-4 payment_method">
                                <a href="{{route('checkout', encrypt('paypal'))}}">
                                    <img src="{{asset('assets/front/images/paypal.png')}}" alt="payment-image"
                                         style="width: 100%">
                                </a>
                            </div>
                            <div class="col-md-4 payment_method">
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

