// import Sortable from 'sortablejs/modular/sortable.complete.esm.js';
// var esesewes = document.getElementById('uploaded_images_container');
// new Sortable(esesewes, {
//     handle:'.post-image',
//     animation: 200,
// });
let option = {
    animation: true,
    delay: 3000,
};


$(document).ready(function () {








    let wish_div = $('.wish_div');
    wish_div.hover(function () {
        $(this).removeClass('not_hovered_wish');
    }, function () {
        $(this).addClass('not_hovered_wish');

    });


    let custom_overlay = $('.custom_overlay');
    let custom_list_checks_row = $('.custom_list_checks_row');
    custom_overlay.click(function () {
        custom_overlay.removeClass('active');
        custom_list_checks_row.slideUp("fast");


    });

    let cat_menu_btn = $('.cat_menu_btn');
    let cat_new_menu = $('#cat_new_menu');
    cat_menu_btn.hover(function () {
        cat_new_menu.removeClass('d-none');
    }, function () {
        cat_new_menu.addClass('d-none');
    });
    cat_new_menu.hover(function () {
        cat_menu_btn.css({
            'border-left': '1px solid #f2f4f7',
            'border-right': '1px solid #f2f4f7',
            'color': '#426ddd',
            'font-weight': 'bold'
        });
        cat_new_menu.removeClass('d-none');
    }, function () {
        cat_new_menu.addClass('d-none');
        cat_menu_btn.css({
            'border-left': 'none',
            'border-right': 'none',
            'color': '#000',
            'font-weight': 'normal'
        });
    });



});


let logo_part = $('#logo_part');
let navbarSupportedContent = $('#navbarSupportedContent');
let user_part = $('#user_part');

if ($(window).width() < 1450 && $(window).width() > 1100) {
    // alert('test');


    // logo_part.removeClass('col-lg-3');
    // navbarSupportedContent.removeClass('col-lg-6');
    // user_part.removeClass('col-lg-3');
    //
    //
    // logo_part.addClass('col-lg-2');
    // navbarSupportedContent.addClass('col-lg-8');
    // user_part.addClass('col-lg-2');

}
if ($(window).width() < 1100 && $(window).width() > 990) {

    // logo_part.removeClass('col-lg-3');
    // navbarSupportedContent.removeClass('col-lg-6');
    // user_part.removeClass('col-lg-3');
    //
    // logo_part.addClass('col-lg-1');
    // navbarSupportedContent.addClass('col-lg-10');
    // user_part.addClass('col-lg-1');
}
let cat_div = $('.cat_div');
let filters = $('.filters');
let search_result_div = $('.search_result_div');
if ($(window).width() < 1000) {

    // cat_div.removeClass('col-md-9');
    // search_result_div.removeClass('col-md-9');
    // filters.removeClass('col-md-3');
    //
    // cat_div.addClass('col-md-12');
    // search_result_div.addClass('col-md-12');
    // filters.addClass('col-md-5');

}


$(document).ready(function () {
    $('#quick_cat').select2();
    let menu_item = $('.menu_item a');
    menu_item.hover(function () {
        $(this).find('i').css('color', '#ff7f00');
    }, function () {
        $(this).find('i').css('color', '#407fff');
    });
    $('.side_bar_contact_div_dismiss, .overlay, .side_bar_2_contact_div_dismiss, .internal, .filters_dismiss').on('click', function () {
        $('.sidebar1').removeClass('active');
        $('.sidebar2').removeClass('side_bar_2_active');
        $('.filters').removeClass('filters_active');
        $('.overlay').removeClass('active');
        $('.side_bar_contact_div_dismiss').css({
            'display': 'none'
        });
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'none'
        });
    });


    $('#close_all').on('click', function () {
        $('.sidebar1').removeClass('active');
        $('.overlay').removeClass('active');

    });


    $('#menu_ic').on('click', function (e) {
        e.preventDefault();
        $('.sidebar1').addClass('active');
        $('.overlay').addClass('active');
        $('.side_bar_contact_div_dismiss').css({
            'display': 'block'
        });
    });

    $('.side_bar_list_img').on('click', function (e) {
        e.preventDefault();
        $('.sidebar2').addClass('side_bar_2_active');
        $('.overlay').addClass('active');
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'block'
        });
    });
    $('.side-bar-btn').on('click', function (e) {
        e.preventDefault();
        $('.sidebar2').addClass('side_bar_2_active');
        $('.overlay').addClass('active');
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'block'
        });
    });

    $('.filter_btn_div , .filters_btn').on('click', function (e) {
        e.preventDefault();
        $('.filters').addClass('filters_active');
        $('.overlay').addClass('active');
        $('.filters_dismiss').css({
            'display': 'block'
        });
    });


    $('#banners_section').owlCarousel({
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        items: 1,
        // onInitialize: add_remove(),
        autoplayHoverPause: true,
        margin: 20,
        smartSpeed: 250,
        nav: true,
        dots: true,
        loop: true,
        mouseDrag: true,
        responsiveClass: true,
        navText: ["<i style='font-size: 49px;color:#fff' class='fa-solid fa-chevron-left'></i>", "<i style='font-size: 49px;color:#fff' class='fa-solid fa-chevron-right'></i>"],
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 1,
                nav: true
            },
            767: {
                items: 1,
                nav: true
            },
            992: {
                items: 1,
                nav: true
            },
            1200: {
                items: 1,
                nav: true
            }
        }
    });

    $('#banners_section_mobile').owlCarousel({
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        items: 1,
        // onInitialize: add_remove(),
        autoplayHoverPause: true,
        margin: 20,
        smartSpeed: 250,
        nav: true,
        dots: true,
        loop: true,
        mouseDrag: true,
        responsiveClass: true,
        navText: ["<i style='font-size: 49px;color:#fff' class='fa-solid fa-chevron-left'></i>", "<i style='font-size: 49px;color:#fff' class='fa-solid fa-chevron-right'></i>"],
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                dots:false
            },
            480: {
                items: 1,
                nav: true
            },
            767: {
                items: 1,
                nav: true
            },
            992: {
                items: 1,
                nav: true
            },
            1200: {
                items: 1,
                nav: true
            }
        }
    });

    $('#featured_categories_carousel').owlCarousel({
        items: 1,
        // onInitialize: add_remove(),
        autoplayHoverPause: false,
        margin: 20,
        smartSpeed: 250,
        nav: true,
        dots: true,
        loop: true,
        mouseDrag: true,
        responsiveClass: true,
        navText: ["<i style='font-size: 49px;color:#ee7202' class='fa-solid fa-chevron-left'></i>", "<i style='font-size: 49px;color:#ee7202' class='fa-solid fa-chevron-right'></i>"],
        autoplay: false,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots:false
            },
            480: {
                items: 2,
                nav: false
            },
            767: {
                items: 3,
                nav: true
            },
            992: {
                items: 4,
                nav: true
            },
            1200: {
                items: 5,
                nav: true
            }
        }
    });


    /* End Banner */


    // alert('test');
    let featured_cat = $('.cat_div');
    featured_cat.hover(function () {
        $(this).find('i').css('color', '#fff');
        $(this).find('.i_bg').css('background', '#ee7202');
    }, function () {
        $(this).find('i').css('color', '#000');
        $(this).find('.i_bg').css('background', '#ddecf7');


    });

    if ($(".odometer").length) {
        $(".odometer").appear(function (e) {
            var odo = $(".odometer");
            odo.each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        });
    }


    let cats_section = $('.cats_section');
    let login_form = $('.login-form');
    // if ($(window).width() < 1000) {
    //     cats_section.removeClass('row');
    //     login_form.removeClass('row');
    //     $('#otherServices').slideUp();
    //     $('.sub_cats_menu').slideUp();
    //
    //     $('.services_sidebar_2_btn').on('click', function () {
    //         let anch = $(this).find('a');
    //         if (anch.hasClass('bold')) {
    //             anch.removeClass('bold');
    //         } else {
    //             anch.addClass('bold');
    //         }
    //         $('#otherServices').slideToggle();
    //     });
    //
    //     let main_cat = $('.main_cat');
    //     main_cat.on('click', function () {
    //         // alert('test')
    //         let anch = $(this).find('a');
    //         if (anch.hasClass('bold')) {
    //             anch.removeClass('bold');
    //         } else {
    //             anch.addClass('bold');
    //         }
    //         let sub_menu = $(this).find('.sub_cats_menu');
    //         sub_menu.slideToggle();
    //     });
    //
    // } else {
    //     cats_section.addClass('row');
    // }

    let side_nav_all_cats = $('.side_nav_all_cats ');
    side_nav_all_cats.on('click', function () {
        let target_ul = $(this).parent().find('.sub_menu');
        target_ul.slideToggle();
        let left_chevron = $(this).find('.fa-solid.fa-chevron-left');
        let down_chevron = $(this).find('.fa-solid.fa-chevron-down');

        if (left_chevron.css('display') === 'none') {
            left_chevron.css('display', 'inline-block');
            down_chevron.css('display', 'none');
        }else {
            down_chevron.css('display', 'inline-block');
            left_chevron.css('display','none');
        }

    });

    let sub_menu_item = $(".sub_menu_item a");
    sub_menu_item.on('click', function () {
        let sub_target = $(this).parent().find('.sub_sub_menu');
        sub_target.slideToggle();
        let left_chevron = $(this).find('.fa-solid.fa-chevron-left');
        let down_chevron = $(this).find('.fa-solid.fa-chevron-down');

        if (left_chevron.css('display') === 'none') {
            left_chevron.css('display', 'inline-block');
            down_chevron.css('display', 'none');
        }else {
            down_chevron.css('display', 'inline-block');
            left_chevron.css('display','none');
        }
    });
});
