<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@yield('meta')
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! JsonLd::generate() !!}


<!-- Favicon -->

    @php
        $settings = \App\Models\Setting::first();
    @endphp
    <link rel="icon" type="image/png" href="{{asset('assets/front/images/karakeeb-icon.png')}}">    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Almarai"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.css')}}">
    <!-- Font Awesome -->


    <link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('assets/front/css/themify-icons.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/nice-select.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">--}}
<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/css/normalize.min.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&amp;display=swapps://github.com/produle/MockFlowFont/blob/master/MockFlowFont1/dist/MockFlowFont1.woff">

    <link href="{{asset('assets/front/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/front/css/sweetalert2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/front/css/pretty-checkbox.min.css')}}" rel="stylesheet"/>


    {{--    <link rel="stylesheet" href="{{asset('assets/front/css/icofont.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/front/css/jquery.mCustomScrollbar.min.css')}}">--}}
    @yield('link')
    <link rel="stylesheet" href="{{asset('assets/front/css/util.css')}}">


    <!-- My Styles -->
    <link rel="stylesheet" href="{{asset('assets/front/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('assets/front/css/locale_' . LaravelLocalization::getCurrentLocale() . '.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/front/css/locale_ar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/media-queries.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('assets/front/css/media-queries_ar.css')}}">--}}
    @yield('styles')

</head>
@php
    $settings = \App\Models\Setting::first();
@endphp
<body dir="rtl">
<div class="overlay"></div>
<div class="custom_overlay"></div>
@include('front.pages.includes.header')

<!-- Content -->
{{--<main  style="background-image: url('{{asset($settings->general_bg)}}'); background-size: cover">--}}
<main style="background: #f9f9f9">


    {{--@include('front.pages.includes.alerts.ajax-notify')--}}
    {{--@include('front.pages.includes.alerts.success')--}}
    {{--@include('front.pages.includes.alerts.errors')--}}
    {{--@include('front.pages.includes.alerts.error-auth')--}}


    <div class="lds-circle">
        <div></div>
    </div>
    @yield('content')

    <input type="hidden" name="lang" value="{{LaravelLocalization::getCurrentLocale()}}" id="lang">
</main>
<!-- End content -->

@include('front.pages.includes.footer')


<script>


</script>

{{-- JQuery --}}
<script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>

<!-- Nice Select JS -->
<script src="{{asset('assets/front/js/jquery.nice-select.js')}}"></script>


<script src="{{asset('assets/front/js/wow.min.js')}}"></script>

<script src="{{asset('assets/front/js/jquery.waypoints.min.js')}}"></script>

<script src="{{asset('assets/front/js/select2.min.js')}}"></script>
<script src="{{asset('assets/front/js/sweetalert2.all.min.js')}}"></script>


<script src="{{asset('assets/front/js/dropzone-min.js')}}"></script>

{{--Owl Carousel--}}
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>


<!-- For Fixed Counter Background JS -->
<script src="{{asset('assets/front/js/jarallax.min.js')}}"></script>

<!-- For Counter Appearing JS -->
<script src="{{asset('assets/front/js/jquery.appear.min.js')}}"></script>

<!-- For Counter Odometer -->
<script src="{{asset('assets/front/js/odometer.min.js')}}"></script>
{{--<script src="{{asset('assets/front/js/svg.js')}}"></script>--}}

<script src="{{asset('assets/front/js/sortable.js')}}"></script>

{{-- Js Script --}}
<script src="{{asset('assets/front/js/main.js')}}"></script>
<script>
</script>

@yield('script')



@if(Session::has('error-auth'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                text: "{{Session::get('error-auth')}}",
                dangerMode: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حسنا',
                showCloseButton: true,
            });
        });

    </script>
@endif
@if(Session::has('error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                text: "{{Session::get('error')}}",
                dangerMode: true,
                confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'حسنا',
                showCloseButton: true,
            });
        });

    </script>
@endif
@if($errors->has('subscription_email'))
    <script>
        ToastyError();
    </script>
@endif
@if(Session::has('success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                text: "{{Session::get('success')}}",
                dangerMode: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'حسنا',
                showCloseButton: true,
            });
        });
    </script>
@endif
<script>
    $(document).ready(function () {
        if ($(window).width() < 767) {

            let mob_nav = $('.mob_nav');
            let new_main = $('main');

            new_main.css('margin-top', mob_nav.height());

        }
        $('select').niceSelect();

        let wish_div = $('.wish_div');
        wish_div.on('click', function () {
            let wished = $(this);
            let id = $(this).attr('data-target');
            let img = $(this).find('.wish-btn img');
            let span = $(this).find('.wish-btn span');
            // alert(id);
            $.ajax({
                url: "{{route('add.to.wish')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: id,
                },
                type: 'POST',
                success: function (response) {
                    if (typeof (response) != 'object') {
                        response = $.parseJSON()
                    }
                    console.log(response);
                    let status = response.status;
                    if (status === 1) {
                        Swal.fire({
                            icon: 'success',
                            text: response.msg,
                            dangerMode: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'حسنا',
                            showCloseButton: true,
                        });
                        img.attr('src', '{{asset('assets/front/images/hearted.png')}}');
                        span.text('تم الإضافة');
                        span.addClass('done');
                        wished.addClass('done');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.msg,
                            dangerMode: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'حسنا',
                            showCloseButton: true,
                        });
                    }
                }
            })
        });


        // Make All images in carousel Same Width
        let client_ad_image = $('.owl-item .item.client_ad_image');
        let current_width = client_ad_image.width();
        client_ad_image.css('height', (current_width / 1.5));


        // Make All Ad Cover in Cards Same Width
        let client_ad_cover = $('.client_ad_cover');
        let client_ad_cover_width = client_ad_cover.width();
        client_ad_cover.css('height', (client_ad_cover_width / 1.5));


        // Make All Ad Cards Same Height
        let client_ad_post = $('div.client_ads_section .card');
        let maxHeight = Math.max.apply(null, client_ad_post.map(function () {
            return $(this).height();
        }).get());
        client_ad_post.height(maxHeight);

        // Make All Ad Cards Same Height
        let client_ads_div_card = $('div.client_ads_div .card');
        let cardMaxHeight = Math.max.apply(null, client_ads_div_card.map(function () {
            return $(this).height();
        }).get());
        client_ads_div_card.height(cardMaxHeight);
    });
</script>

{{--$(document).ready(function () {--}}
{{--    $('.spans_container_dismiss img').hover(function () {--}}
{{--        $('.spans_container_dismiss img').attr('src', '{{asset('assets/front/images/dismiss_2.png')}}');--}}
{{--    }, function () {--}}
{{--        $('.spans_container_dismiss img').attr('src', '{{asset('assets/front/images/dismiss.png')}}');--}}
{{--    });--}}

{{--    window.setTimeout(function () {--}}
{{--        $('#whats_plugin').slideDown();--}}
{{--        // $('#close_plugins').slideDown();--}}
{{--    }, 4000);--}}

{{--    --}}{{--$('.opened').on('click', function () {--}}

{{--    --}}{{--    if ($(this).hasClass('opened')) {--}}
{{--    --}}{{--        $(this).find('img.opened_img').toggleClass('rotate');--}}
{{--    --}}{{--        $('#whats_plugin').slideToggle();--}}

{{--    --}}{{--        window.setTimeout(function () {--}}
{{--    --}}{{--            $('.opened').find('img.opened_img').remove();--}}
{{--    --}}{{--            let img = "<img src='" + "{{asset("assets/front/images/close_plugins.png")}}" + "' alt='whats_icon' style='width: 68px;' class='opened_img'>";--}}
{{--    --}}{{--            $('.opened').find('a').append(img);--}}

{{--    --}}{{--            $('.opened').addClass('d-none');--}}
{{--    --}}{{--            $('#closed_plugins').removeClass('d-none');--}}
{{--    --}}{{--        }, 200);--}}
{{--    --}}{{--    }--}}

{{--    --}}{{--});--}}
{{--    --}}{{--$('.closed').on('click', function () {--}}

{{--    --}}{{--    if ($(this).hasClass('closed')) {--}}
{{--    --}}{{--        $(this).find('img.closed_img').toggleClass('rotate');--}}
{{--    --}}{{--        $('#whats_plugin').slideToggle();--}}

{{--    --}}{{--        window.setTimeout(function () {--}}
{{--    --}}{{--            $('.closed').find('img.closed_img').remove();--}}

{{--    --}}{{--            let img = "<img src='" + "{{asset("assets/front/images/closed_plugins.png")}}" + "' alt='whats_icon' style='width: 68px;' class='closed_img'>";--}}
{{--    --}}{{--            $('.closed').find('a').append(img);--}}

{{--    --}}{{--            $('.closed').addClass('d-none');--}}
{{--    --}}{{--            $('#close_plugins').removeClass('d-none');--}}
{{--    --}}{{--        }, 200);--}}
{{--    --}}{{--    }--}}
{{--    --}}{{--});--}}
{{--    /* Start Owl Carousel For Events */--}}

{{--    if ($(window).width() > 960) {--}}
{{--        $('.review_carousel').owlCarousel({--}}
{{--            loop:true,--}}
{{--            margin:10,--}}
{{--            items: 1,--}}
{{--            stagePadding: 600,--}}
{{--            autoWidth: true,--}}
{{--            smartSpeed: 600,--}}
{{--            autoplaySpeed: 1000,--}}
{{--            center: true,--}}
{{--            nav: true,--}}
{{--            autoplayHoverPause:true,--}}
{{--            dots: true,--}}
{{--            navText: ["<img src='{{asset('assets/front/images/prev.png')}}' alt='pre' width='50%'>", "<img src='{{asset('assets/front/images/nextt.png')}}' alt='next' width='50%'>"],--}}
{{--            responsiveClass: true,--}}
{{--            autoplay: true,--}}

{{--            responsive:{--}}
{{--                0: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                480: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                767: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                992: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                1200: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    } else {--}}
{{--        $('.review_carousel').owlCarousel({--}}
{{--            loop:true,--}}
{{--            margin:10,--}}
{{--            items: 1,--}}
{{--            smartSpeed: 150,--}}
{{--            center: true,--}}
{{--            nav: true,--}}
{{--            autoplayHoverPause:true,--}}
{{--            dots: true,--}}
{{--            navText: ["<img src='{{asset('assets/front/images/prev.png')}}' alt='pre' width='50%'>", "<img src='{{asset('assets/front/images/nextt.png')}}' alt='next' width='50%'>"],--}}
{{--            responsiveClass: true,--}}
{{--            autoplay: true,--}}

{{--            responsive:{--}}
{{--                0: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                480: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                767: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                992: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                },--}}
{{--                1200: {--}}
{{--                    items: 1,--}}
{{--                    nav: true--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}


{{--    var $owl = $("#carousel_events");--}}
{{--    $owl.owlCarousel({--}}
{{--        animateOut: 'fadeOut',--}}
{{--        animateIn: 'fadeIn',--}}
{{--        items: 1,--}}
{{--        // onInitialize: add_remove(),--}}
{{--        autoplayHoverPause:true,--}}

{{--        smartSpeed: 150,--}}
{{--        center: true,--}}
{{--        nav: true,--}}
{{--        dots: true,--}}
{{--        navText: ["<img src='{{asset('assets/front/images/pre.png')}}' alt='pre' width='50%'>", "<img src='{{asset('assets/front/images/next.png')}}' alt='next' width='50%'>"],--}}
{{--        loop: true,--}}
{{--        mouseDrag: false,--}}
{{--        responsiveClass: true,--}}
{{--        autoplay: true,--}}
{{--        responsive: {--}}
{{--            0: {--}}
{{--                items: 1,--}}
{{--                nav: true--}}
{{--            },--}}
{{--            480: {--}}
{{--                items: 1,--}}
{{--                nav: true--}}
{{--            },--}}
{{--            767: {--}}
{{--                items: 1,--}}
{{--                nav: true--}}
{{--            },--}}
{{--            992: {--}}
{{--                items: 1,--}}
{{--                nav: true--}}
{{--            },--}}
{{--            1200: {--}}
{{--                items: 1,--}}
{{--                nav: true--}}
{{--            }--}}
{{--        }--}}
{{--    });--}}
{{--    $owl.on('changed.owl.carousel', function (event) {--}}
{{--        var item = event.item.index - 2;     // Position of the current item--}}


{{--        $owl.find('h1').removeClass('animated pulse');--}}
{{--        $owl.find('.gif_line').removeClass('animated swing');--}}
{{--        $owl.find('p').removeClass('animated bounceInRight');--}}
{{--        $owl.find('a').removeClass('animated bounceInUp');--}}
{{--        $('.owl-item').not('.cloned').eq(item).find('h1').addClass('animated pulse');--}}
{{--        $('.owl-item').not('.cloned').eq(item).find('.gif_line').addClass('animated swing');--}}
{{--        $('.owl-item').not('.cloned').eq(item).find('p').addClass('animated bounceInRight');--}}
{{--        $('.owl-item').not('.cloned').eq(item).find('a').addClass('animated bounceInUp');--}}
{{--    });--}}
{{--    function addPulse() {--}}
{{--        $(".owl-item.active.center").find('h1').addClass('animated pulse');--}}
{{--        $(".owl-item.active.center").find('.gif_line').addClass('animated swing');--}}
{{--        $(".owl-item.active.center").find('p').addClass('animated bounceInRight');--}}
{{--        $(".owl-item.active.center").find('a').addClass('animated bounceInUp');--}}
{{--    }--}}
{{--    addPulse();--}}

{{--        /* End Owl Carousel For Events */--}}
{{--    // });--}}

{{--    // $('iframe[name="blank_f1bf003f36e089c"]').click();--}}

{{--    /* Start Plugins */--}}

{{--    /* End Plugins */--}}




{{--@if(Session::has('error-auth'))--}}
{{--    <script>--}}
{{--        ToastyAuthError();--}}
{{--    </script>--}}
{{--@endif--}}
{{--@if(Session::has('error'))--}}
{{--    <script>--}}

{{--        ToastyError();--}}

{{--    </script>--}}
{{--@endif--}}
{{--@if($errors->has('subscription_email'))--}}
{{--    <script>--}}

{{--        ToastyError();--}}

{{--    </script>--}}
{{--@endif--}}
{{--@if(Session::has('success'))--}}
{{--    <script>--}}
{{--        ToastySuccess();--}}
{{--    </script>--}}
{{--@endif--}}
{{--@if(!empty($success))--}}
{{--    <script>--}}
{{--        ToastySuccess();--}}
{{--    </script>--}}
{{--@endif--}}

</body>
</html>
