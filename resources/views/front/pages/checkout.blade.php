@extends('front.layouts.master')

@section('styles')
    <style>
        .required {color: red}
        .featured-section {
            padding-top: 137px
        }
    </style>
@stop

@section('content')



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12 col-lg-12 ">
                    <h3 class="bold">ادخل بيانات طلب الدفع</h3>
                </div>
                <div class="pill-form mt-3">
                    <form action="{{route('complete-order')}}" method="post">
                        @php
                            $details = App\Models\UserInfoPill::with('user')
                            ->where('user_id', backpack_auth()->user()->id)
                            ->first();
                        @endphp
                        @csrf
                        <input type="hidden" name="payment" value="{{$payment}}">
                        <div class=" row ">
                            <h5 class="card-header mb-3">تفاصيل الطلب</h5>
                            <div class="pill-form-inputs row">
                                <div class="col-md-6 col-sm-12 m-auto mt-3">
                                    <label for="first_name">الإسم الأول : <span class="required">*</span>
                                        @if ($errors->has('first_name'))
                                            <span class="required">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                        @endif
                                    </label>
                                    <input type="text" name="first_name" class="form-control"
                                           placeholder="ادخل الإسم الأول" id="name" value="{{$details->first_name }}"
                                           required>
                                </div>
                                <div class="col-md-6 col-sm-12 m-auto mt-3">
                                    <label for="last_name">الإسم الأخير : <span class="required">*</span>
                                        @if ($errors->has('last_name'))
                                            <span class="required">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </label>
                                    <input type="text" name="last_name" class="form-control"
                                           placeholder="ادخل الإسم الأخير" id="name" value="{{$details->last_name }}"
                                           required>
                                </div>
                                <div class="col-md-6 col-sm-12 m-auto mt-3">
                                    <label for="phone">رقم الهاتف <span class="required">*</span>
                                        @if ($errors->has('phone'))
                                            <span class="required">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                        @endif
                                    </label>
                                    <input type="tel" name="phone" class="form-control"
                                           placeholder="ادخل رقم الهاتف" id="phone"
                                           value="{{$details->ship_phone}}" required>
                                </div>
                                <div class=" col-md-6 col-sm-12 m-auto mt-3">
                                    <label for="email">البريد الإلكتروني
                                        <span>(اختياري)</span>
                                        @if ($errors->has('email'))
                                            <span class="required">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="email" name="email" class="form-control"
                                           placeholder="ادخل البريد الإلكتروني" id="email"
                                           value="{{$details->email}}" aria-describedby="emailHelp">
                                </div>
                                <div class=" col-md-4 col-sm-12 m-auto mt-3">
                                    <label for="country">الدولة <span class="required">*</span>
                                        @if ($errors->has('country'))
                                            <span class="required">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="country" class="form-control"
                                           placeholder="ادخل الدولة" country="country" required>
                                </div>
                                <div class=" col-md-4 col-sm-12 m-auto mt-3">
                                    <label for="city">المحافظة <span class="required">*</span>
                                        @if ($errors->has('city'))
                                            <span class="required">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="city" class="form-control"
                                           placeholder="ادخل المحافظة" country="city" required>
                                </div>

                                <div class=" col-md-4 col-sm-12 m-auto mt-3">
                                    <label for="state">الحي / المركز
                                        <span>(اختياري)</span>
                                        @if ($errors->has('state'))
                                            <span class="required">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="state" class="form-control"
                                           placeholder="ادخل الحي / المركز" id="state">
                                </div>
                                <div class=" col-md-12 col-sm-12 m-auto mt-3">
                                    <label for="address">العنوان الأول <span class="required">*</span>

                                        @if ($errors->has('address'))
                                            <span class="required">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="address" class="form-control"
                                           placeholder="اكتب العنوان " id="address">
                                </div>

                                <div class=" col-md-8 col-sm-12 m-auto mt-3">
                                    <label for="address_2">العنوان الثاني (اختياري)

                                        @if ($errors->has('address_2'))
                                            <span class="required">
                                                <strong>{{ $errors->first('address_2') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="address_2" class="form-control"
                                           placeholder="اكتب العنوان الثاني" id="address_2">
                                </div>

                                <div class=" col-md-4 col-sm-12 m-auto mt-3">
                                    <label for="postal_code">الرمز البريدي (اختياري)

                                        @if ($errors->has('postal_code'))
                                            <span class="required">
                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                    <input type="text" name="postal_code" class="form-control"
                                           placeholder="اكتب الرمز البريدي " id="postal_code">
                                </div>

                                <div class="col-md-12 col-sm-12 m-auto my-3">
                                    <label for="order-notes">ملاحظات
                                        <span>(اختياري)</span></label>
                                    <textarea placeholder="اذا كانت هناك أي ملاحظات قم بادخالها هنا" class="form-control"
                                              id="order-notes" name="notes"
                                              rows="3"></textarea>
                                </div>
                                <div class="col-md-4 col-sm-12 m-auto my-3">
                                    <div id="order_btn" >
                                        <button class="btn order_btn" >اكمل الطلب</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </section>
    {{--    End Featured Cats--}}










@endsection




@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

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
                // alert(item_id);

                swal({
                    title: 'هل أنت متأكد ؟',
                    content: id,
                    buttons: ["إلغاء", "حذف"],
                    dangerMode: true,
                })
                    .then(id => {
                        if (!id) throw null;
                        // `
                        return fetch('delete-cart/' + item_id);
                    })
                    .then(results => {
                        return results.json();
                    })
                    .then(json => {
                        let status = json.status;
                        let msg = json.msg;

                        if (status === 0) {
                            console.log(msg);
                        } else if (status === 1) {
                            console.log(json.data);
                            swal({
                                title: msg,
                                icon: "success",
                                button: "حسنا",
                            });

                            $('#tr_' + json.data['id']).remove();

                            let count = json.data['count'];
                            if (count < 1) {
                                $('.empty_cart').removeClass('d-none');
                            }

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

