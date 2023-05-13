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
    <section class="featured-section client_ads_section wished_con text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">قائمة المفضلة</h3>
                </div>
            </div>
            <div class="row wished_products" id="wishes_cont">

            @if(isset($paid_wished_items) && $paid_wished_items->count() > 0)

                    @foreach($paid_wished_items as $k => $item)
                        <div class="col-md-3 col-6 col-sm-6 post  my-2" id="div_{{$item->id}}">
                            {{--                            {{route('client_ad.show', $item->slug)}}--}}
                            <div class="card card-block pb-3 wish_card">
                                @php
                                    $images =explode(',',$item->clientAd->images);
                                     //dd($images);
                                @endphp
                                <div class="mark_div">
                                    <img src="{{asset('assets/front/images/mark.png')}}" alt="special offer"
                                         width="100%">
                                </div>


                                <a href="{{route('client_ad.show', $item->clientAd->slug)}}">
                                    <div class="wished_client_ad_cover">
                                    <img src="{{asset('images/dropped/'. $images[0])}}"
                                         alt="{{$item->clientAd->slug}}">
                                    </div>
                                    <div class="titles bold">
                                        <h5 class="card-title  bold">{{$item->clientAd->title}}</h5>
                                        <span class="card-title  bold price">{{$item->clientAd->price}} ج.م</span>
                                    </div>
                                </a>
                                <div class="footer_card text-muted">
                                    <small>{{$item->clientAd->country->name}}</small> -
                                    <small>{{$item->clientAd->city->name}}</small> -
                                    <small>{{$item->clientAd->state->name}}</small>
                                </div>
                                <div class="delete_card mt-2">
                                    <button class="btn btn-danger delete_wish" data-bs-target="{{$item->id}}">حذف </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
            @endif
            @if(isset($free_wished_items) && $free_wished_items->count() > 0)

                    @foreach($free_wished_items as $k => $item)
                        <div class="col-md-3 col-6 col-sm-6 post  my-2" id="div_{{$item->id}}">
                            {{--                            {{route('client_ad.show', $item->slug)}}--}}
                            <div class="card card-block pb-3 wish_card">
                                @php
                                    $images =explode(',',$item->clientAd->images);
                                     //dd($images);
                                @endphp
                                <a href="{{route('client_ad.show', $item->clientAd->slug)}}">
                                    <div class="client_ad_cover">
                                    <img src="{{asset('images/dropped/'. $images[0])}}"
                                         alt="{{$item->clientAd->slug}}">
                                    </div>
                                    <div class="titles bold">
                                        <h5 class="card-title  bold">{{$item->clientAd->title}}</h5>
                                        <span class="card-title  bold price">{{$item->clientAd->price}} ج.م</span>
                                    </div>
                                </a>
                                <div class="footer_card text-muted">
                                    <small>{{$item->clientAd->country->name}}</small> -
                                    <small>{{$item->clientAd->city->name}}</small> -
                                    <small>{{$item->clientAd->state->name}}</small>
                                </div>
                                <div class="delete_card mt-2">
                                    <button class="btn btn-danger delete_wish" data-bs-target="{{$item->id}}">حذف </button>
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

