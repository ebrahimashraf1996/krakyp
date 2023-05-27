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
        .client_ad_cover {max-height: 156px}
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

                    <span>قائمة المفضلة</span>
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
    <section class="featured-section client_ads_section wished_con text-center">
        <div class="container" style="max-width: 1044px">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12 text-right">
                    <h3 class="bold">قائمة المفضلة ...</h3>
                </div>
            </div>
            <div class="row wished_products" id="wishes_cont">

            @if(isset($paid_wished_items) && $paid_wished_items->count() > 0)

                    @foreach($paid_wished_items as $k => $item)
                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 post  my-2" id="div_{{$item->id}}">
                            {{--                            {{route('client_ad.show', $item->slug)}}--}}
                            <div class="card card-block pb-3"
                                 style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
                                <div class="mark_div">
                                    <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                         width="100%">
                                </div>
                                    <div
                                        class="short_delete_btn  delete_wish"
                                        data-bs-target="{{$item->id}} " dir="ltr">
                                        <a href="javascript:void(0)" class="delete-btn">
                                            <img src="{{asset('assets/front/images/delete.png')}}" alt="delete-icon">
                                        </a>
                                    </div>


                                <a href="{{route('client_ad.show', $item->clientAd->slug)}}">
                                    <div class="client_ad_cover">
                                        <img src="{{asset('organized/'. $item->clientAd->cover)}}"
                                             alt="{{$item->clientAd->slug}}">
                                    </div>
                                    <div class="location_card text-muted pt-2">
                                        <i class="fa fa-location-dot l_13" style="margin-left: 3px"></i>
                                        <small>{{$item->clientAd->country->name}},</small>
                                        <small>{{$item->clientAd->city->name}}</small>
                                        {{--                                            - <small>{{$item->clientAd->state->name}}</small>--}}
                                    </div>

                                    <div class="titles bold">
                                        <h5 class="card-title mb-3 bold">{{$item->clientAd->title}}</h5>
                                        <span style="font-weight: normal">السعر: </span>
                                        <span class="card-title  bold price colored">{{number_format($item->clientAd->price, 0)}}</span>
                                        <span> ج.م</span>
                                    </div>
                                </a>

                                <div class="footer_card">
                                    <div class="text-muted position-relative">
                                        <small>عدد المشاهدات : {{$item->clientAd->viewNum->count()}}</small>
                                        <small class="date_client_ad">
                                            <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                               style="margin-left: 3px"></i>
                                            <span>{{Carbon\Carbon::parse($item->clientAd->created_at)->diffForHumans()}}</span>
                                        </small>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach
            @endif
            @if(isset($free_wished_items) && $free_wished_items->count() > 0)

                    @foreach($free_wished_items as $k => $item)
                        <div class="col-lg-3 col-md-3 col-6 col-sm-6 post  my-2" id="div_{{$item->id}}">
                            {{--                            {{route('client_ad.show', $item->slug)}}--}}
                            <div class="card card-block pb-3"
                                 style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">

                                <div
                                    class="short_delete_btn  delete_wish"
                                    data-bs-target="{{$item->id}} " dir="ltr">
                                    <a href="javascript:void(0)" class="delete-btn">
                                        <img src="{{asset('assets/front/images/delete.png')}}" alt="delete-icon">
                                    </a>
                                </div>


                                <a href="{{route('client_ad.show', $item->clientAd->slug)}}">
                                    <div class="client_ad_cover">
                                        <img src="{{asset('organized/'. $item->clientAd->cover)}}"
                                             alt="{{$item->clientAd->slug}}">
                                    </div>
                                    <div class="location_card text-muted pt-2">
                                        <i class="fa fa-location-dot l_13" style="margin-left: 3px"></i>
                                        <small>{{$item->clientAd->country->name}},</small>
                                        <small>{{$item->clientAd->city->name}}</small>
                                        {{--                                            - <small>{{$item->clientAd->state->name}}</small>--}}
                                    </div>

                                    <div class="titles bold">
                                        <h5 class="card-title mb-3 bold">{{$item->clientAd->title}}</h5>
                                        <span style="font-weight: normal">السعر: </span>
                                        <span class="card-title  bold price colored">{{number_format($item->clientAd->price, 0)}}</span>
                                        <span> ج.م</span>
                                    </div>
                                </a>

                                <div class="footer_card">
                                    <div class="text-muted position-relative">
                                        <small>عدد المشاهدات : {{$item->clientAd->viewNum->count()}}</small>
                                        <small class="date_client_ad">
                                            <i class="fa-sharp fa-solid fa-clock-rotate-left l_11"
                                               style="margin-left: 3px"></i>
                                            <span>{{Carbon\Carbon::parse($item->clientAd->created_at)->diffForHumans()}}</span>
                                        </small>
                                    </div>
                                </div>

                            </div>
                        </div>



                    @endforeach
            @endif
                </div>

                <div class="row empty_cart {{$wishes_count > 0 ? 'd-none' : ''}}">
                <h4 class="">القائمة فارغة ..</h4>
            </div>

        </div>
    </section>
    {{--    End Featured Cats--}}


    {{--{{dd(General::getTotalCartPrice())}}--}}
@endsection
@section('script')

    <script>


        $(document).ready(function () {

            let client_ad_post = $('section.client_ads_section .card');

            let maxHeight = Math.max.apply(null, client_ad_post.map(function () {
                return $(this).height();
            }).get());

            // alert(maxHeight);
            client_ad_post.height(maxHeight);


            let delete_cart_item = $('.delete_wish');
            delete_cart_item.on('click', function (e) {
                e.preventDefault();
                let id = $(this).attr('data-bs-target');
                let item_id = $(this).attr('data-bs-target');
                // alert(item_id);
                Swal.fire({
                    title: 'هل أنت متأكد ؟',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'إلغاء',
                    confirmButtonText: 'حذف الآن!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete-wish/',
                            data: {
                                id: item_id
                            },
                            type: 'get',
                            success: function (response) {
                                if (typeof (response) != 'object') {
                                    response = $.parseJSON(response)
                                }
                                console.log(response);
                                if (response.status === 1) {
                                    Swal.fire({
                                        text: response.msg,
                                        icon: 'success',
                                        confirmButtonText: 'رجوع',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    if (parseInt(response.count) < 1) {
                                        $('.empty_cart').removeClass('d-none');
                                        $('#wishes_cont').remove();
                                    }
                                    $('#div_' + item_id).remove();
                                } else {
                                    Swal.fire(
                                        'جرب مرة اخري!',
                                    )
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

