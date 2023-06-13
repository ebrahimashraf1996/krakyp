<div class="overlay"></div>

<header>
    <nav class="header-nav">
        <div class="header_container container">
            <div class="row upper_nav_new text-center pt-3">
                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-2 text-right">
                    <a class="navbar-brand " href="{{route('site.home')}}">
                        <img src="{{asset($settings->logo)}}" alt="logo">
                    </a>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-2 col-2" dir="ltr" style="margin-top: 13px">
                    <form action="{{route('quick.search')}}" method="get">
                        <div class="input-group search-input">
                            <button type="submit" class="input-group-text search_btn_icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" name="key_word" value="{{isset($_GET['key_word']) ? $_GET['key_word'] : old('key_word')}}"
                                   placeholder="مثال : اسم الماركة او نوع العقار" style="text-align: right">
                            @php
                                $cats = App\Models\Category::where('parent_id', '!=', null)->select('id', 'title')->get();
                            @endphp
                            <select class="form-control dropdown-toggle" id="quick_cat" name="quick_cat"
                                    style="width: 30%; text-align: right">
                                <option value="">اختر الفئة</option>
                                @foreach($cats as $item)
                                    <option value="{{$item->id}}" {{isset($_GET['quick_cat']) &&  $_GET['quick_cat'] == $item->id || old('quick_cat') == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-xxl-2 col-xl-2 col-md-2 col-lg-2 col-sm-2 col-2 text-right login_div" style="">
                    @if(backpack_auth()->check())
                        <div class="pt-2 logged_menu_btn">
                            <img src="{{asset('assets/front/images/profile_1.svg')}}" alt="profile-icon">
                            <span class="logged_in">حسابي</span>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="logged_list">
                                <li class="menu_span"> أهلا وسهلا</li>
                                <li class="menu_span"><span
                                        class="bold">{{backpack_auth()->user()->name}}</span></li>
                                <li class="menu_item">
                                    <a href="{{route('personal.edit')}}" class="dropdown-item">
                                        {{--                                        <img src="{{asset('assets/front/images/profile-icon.webp')}}" alt="icon" class="profile_edit">--}}

                                        <i class="fa-solid fa-square-pen"></i>
                                        &nbsp;&nbsp; تعديل الملف
                                        الشخصي
                                    </a>
                                </li>
                                <li class="menu_item"><a href="{{route('user.posts.all')}}" class="dropdown-item"><i
                                            class="fa-solid fa-paste"></i>&nbsp;&nbsp; إعلاناتي</a></li>
                                <li class="menu_item"><a href="{{route('packages.bills')}}" class="dropdown-item"><i
                                            class="fa-solid fa-money-check-dollar"></i>&nbsp;&nbsp; باقاتي
                                    </a></li>
                                <li class="menu_item"><a href="{{route('cart.index')}}" class="dropdown-item"><i
                                            class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp; السلة</a></li>
                                <li class="menu_item"><a href="{{route('wish.list')}}" class="dropdown-item"><i
                                            class="fa-solid fa-heart"></i>&nbsp;&nbsp; قائمة المفضلة</a>
                                </li>
                                <li class="menu_item"><a href="{{route('buy-package')}}" class="dropdown-item"><i
                                            class="fa-solid fa-credit-card"></i>&nbsp;&nbsp; شراء باقات</a></li>
                                {{--                                        <li><a href="#" class="dropdown-item l_16"><i--}}
                                {{--                                                    class="fa-solid fa-circle-question"></i>&nbsp;&nbsp; المساعدة</a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li><a href="#" class="dropdown-item l_16"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;--}}
                                {{--                                                الإعدادات</a></li>--}}
                                <li class="menu_item"><a href="{{url('logout')}}" class="dropdown-item"><i
                                            class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp; تسجيل الخروج</a>
                                </li>
                            </ul>
                        </div>

                    @else
                        <a href="{{url('login')}}">
                            <img src="{{asset('assets/front/images/profile_1.svg')}}" alt="profile-icon">
                            <span>تسجيل الدخول</span>
                        </a>
                    @endif

                </div>
                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-2 post_now" style="margin-top: 13px">
                    <a href="{{route('add.post')}}" class="btn bold add_post_btn">
                        <span class="plus_new">
                            <i class="fa-solid fa-plus" style="font-size: 27px"></i>
                        </span> &nbsp;&nbsp;&nbsp;أعلن الآن
                    </a>
                </div>
            </div>
            <div class="row lower_nav_new  pt-3">
                <div class="col-xxl-12 col-xl-12 col-md-12col-sm-12 col-12">
                    <ul class="lower_nav_new_menu">
                        <li>
                            <a href="{{route('site.home')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'site.home' ? 'hovered' : '' }}">
                                <span>
                                    الرئيسية
                                </span>
                            </a>
                        </li>
                        <li>
                            <span
                                class="cat_menu_btn nav_menu_item {{Route::currentRouteName() === 'cat.show' ? 'hovered' : '' }}">
                                الأقسام
                            </span>
                        </li>
                        <li>
                            <a href="{{route('buy-package')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'buy-package' ? 'hovered' : '' }}">
                                <span>شراء باقات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('add.post')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'add.post' ? 'hovered' : '' }}">
                                <span>أعلن الآن</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('articles.index')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'hovered' : '' }}">
                                <span>المقالات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('contact.us')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'contact.us' ? 'hovered' : '' }}">
                                <span>تواصل معنا</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('about.us')}}"
                               class="nav_menu_item {{Route::currentRouteName() === 'about.us' ? 'hovered' : '' }}">
                                <span>من نحن</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 d-none" id="cat_new_menu">
                    @php
                        $cats = \App\Models\Category::active()->main()->select('id', 'title', 'slug','cat_icon', 'parent_id')->orderBy('lft', 'asc')->get();
                    @endphp
                    <div class="row">
                        @foreach($cats as $item)
                            <div class="col-xxl-4 col-xl-4 col-md-6 col-sm-6 col-4 single_cat_div">
                                <div class="row p-b-10 p-t-10 main_cat_title_row">
                                    <span class="main_cat_title bold">
                                        {{$item->title}}
                                    </span>
                                </div>
                                <div class="row">
                                    @foreach($item->subCategories as $item)
                                        <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-6">
                                            <a class="sub_menu_item" href="{{route('cat.show', $item->slug)}}">
                                                <span class="cat_icon mdi {{$item->cat_icon}}"></span>
                                                <span class="sub_cat_title">{{$item->title}}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light lower-nav pc_nav"
         style="padding: 0!important;display: none">
        <div class="container-fluid">
            <div class="container logo_container">
                <div class="row text-center ">
                    <div class="col-md-2 col-lg-3" id="user_part">
                        <div class="user_list">
                            @if(backpack_auth()->check())
                                <li class="nav-item dropdown lang-link user_menu">
                                    <a class="nav-link main-nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(backpack_auth()->user()->image != null)
                                            <img class="flag" src="{{asset(backpack_auth()->user()->image)}}"
                                                 alt="user-photo">
                                        @else
                                            <img class="flag" src="{{asset('assets/front/images/avatar.png')}}"
                                                 alt="user-photo">
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="lang_list">
                                        <li class="menu_span"> أهلا وسهلا</li>
                                        <li class="menu_span"><span
                                                class="bold">{{backpack_auth()->user()->name}}</span></li>
                                        <li><a href="{{route('personal.edit')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-square-pen"></i>&nbsp;&nbsp; تعديل الملف
                                                الشخصي</a></li>
                                        <li><a href="{{route('user.posts.all')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-paste"></i>&nbsp;&nbsp; إعلاناتي</a></li>
                                        <li><a href="{{route('packages.bills')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-money-check-dollar"></i>&nbsp;&nbsp; باقاتي
                                            </a></li>
                                        <li><a href="{{route('cart.index')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp; السلة</a></li>
                                        <li><a href="{{route('wish.list')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-heart"></i>&nbsp;&nbsp; قائمة المفضلة</a>
                                        </li>
                                        <li><a href="{{route('buy-package')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-credit-card"></i>&nbsp;&nbsp; شراء باقات</a></li>

                                        <li><a href="{{url('logout')}}" class="dropdown-item l_16"><i
                                                    class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp; تسجيل الخروج</a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <div class="bold" style="margin: 20px 0">
                                    <a class="l_14" href="{{url('register')}}">
                                        حساب جديد ؟
                                    </a> /
                                    <a class="l_14" href="{{url('login')}}">
                                        تسجيل الدخول
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-6" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav_list">
                            {{--                                                <li class="nav-item dropdown lang-link languages-list">--}}
                            {{--                                                    <a class="nav-link main-nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
                            {{--                                                       data-bs-toggle="dropdown" aria-expanded="false">--}}
                            {{--                                                        <img class="flag"--}}
                            {{--                                                             src="{{asset('assets/front/images/'.LaravelLocalization::getCurrentLocale().'_flag.png')}}"--}}
                            {{--                                                             alt="">--}}
                            {{--                                                    </a>--}}

                            {{--                                                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="lang_list">--}}
                            {{--                                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
                            {{--                                                            <li>--}}
                            {{--                                                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"--}}
                            {{--                                                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
                            {{--                                                                    <img class="flag_icon"--}}
                            {{--                                                                         src="{{asset('assets/front/images/'.$localeCode.'_flag.png')}}"--}}
                            {{--                                                                         alt=""> {{ $properties['native'] }}--}}

                            {{--                                                                </a>--}}
                            {{--                                                            </li>--}}
                            {{--                                                        @endforeach--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </li>--}}


                            <li class="nav-item main-nav-item home">
                                <a class="nav-link nav-link-mid  {{Route::currentRouteName() === 'site.home' ? 'now' : ''}}"
                                   aria-current="page" href="{{route('site.home')}}">الرئيسية

                                </a>
                            </li>
                            <li class="nav-item main-nav-item dropdown services-btn">
                                <a class="nav-link nav-link-mid dropdown-toggle " href="#" id="navbarDropdown"
                                   role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    الأقسام

                                    </i>
                                </a>
                                @php
                                    $cats = \App\Models\Category::active()->main()->select('id', 'title','image', 'slug','cat_icon', 'parent_id')->get();
                                @endphp
                                <ul class="dropdown-menu services-menu" aria-labelledby="navbarDropdown">
                                    @foreach($cats as $item)

                                        <li class="nav-item main-nav-item dropdown services-btn">
                                                <span class="nav-link nav-link-mid dropdown-toggle"
                                                      style="padding: 8px 12px;">
                                                    {{$item->title}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round"
                                                         class="feather feather-chevron-right">
                                                    <polyline points="15 18 9 12 15 6"></polyline>
                                                    </svg>
                                                </span>

                                            <ul class="sub-menu" id="menu_{{$item->id}}">
                                                @foreach($item->subCategories as $item)
                                                    <li class="menu-item">
                                                        <a class="menu-button"
                                                           href="{{route('cat.show', $item->slug)}}">{{$item->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>


                            <li class="nav-item main-nav-item blog">
                                <a class="nav-link nav-link-mid" href="{{route('buy-package')}}">شراء باقات

                                </a>

                            </li>

                            <li class="nav-item main-nav-item blog">
                                <a class="nav-link nav-link-mid" href="{{route('add.post')}}">أعلن الآن

                                </a>

                            </li>


                            <li class="nav-item main-nav-item blog">
                                <a class="nav-link nav-link-mid" href="{{route('articles.index')}}">المقالات

                                </a>

                            </li>


                            <li class="nav-item main-nav-item blog">
                                <a class="nav-link nav-link-mid" href="{{route('contact.us')}}">
                                    تواصل معنا
                                </a>
                            </li>

                            <li class="nav-item main-nav-item about">
                                <a class="nav-link nav-link-mid"
                                   href="{{route('about.us')}}">من نحن

                                </a>

                            </li>


                        </ul>


                    </div>
                    <div class="col-md-2 col-lg-3" id="logo_part">
                        <a class="navbar-brand pc_logo" href="{{route('site.home')}}">
                            <img src="{{asset($settings->logo)}}" alt="logo" style="">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <nav class="mob_nav fixed-top">
        <div class="row py-3 m-0">
            <div class="col-sm-4 col-4">
                <a class="logo_mobile" href="{{route('site.home')}}">
                    <img src="{{asset($settings->logo)}}" alt="logo" style="width: 79px">
                </a>
            </div>
            <div class="col-sm-4 col-4 p-r-1 p-l-1">
                <a href="{{route('add.post')}}" class="input-group " dir="ltr">
                    <div class="btn_plus_ad position-relative">
                        <span class="plus_text bold">أضف إعلان</span>

                        <div class="plus_icon">
                            <div class="position-relative">
                                <span class="plus_plus">+</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-4 text-left p-t-7">
                <a href="javascript:void(0);" class="m-l-16" data-bs-toggle="modal" data-bs-target="#search_model">
                    <img src="{{asset('assets/front/images/search-normal-mobile.png')}}" alt="search-icon"
                         style="width: 24px">
                </a>
                <a href="javascript:void(0);" class="m-r-5 p-r-6 p-l-6 p-t-5 p-b-7" id="menu_ic">
                    <img src="{{asset('assets/front/images/menu_ic.svg')}}" alt="menu_ic">
                </a>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="search_model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class=" col-sm-12 col-12 new_search_box_mobile"
                         style="height: 300px;background: #fff">
                        <form action="{{route('new.search.get')}}" method="get" id="new_search_form_mob">
                            <div class="row" dir="rtl">
                                <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1"
                                     id="new_main_cat_mob">
                                    <select class="form-control" id="new_main_cat_id_mob" name="new_main_cat_id"
                                            style="width: 100%">
                                        <option value="">اختر الفئة الرئيسية</option>
                                        @foreach($cats as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1"
                                     id="new_sub_cat_id_div_mob" disabled="">
                                    <select class="form-control" id="new_sub_cat_id_mob" name="new_sub_cat_id"
                                            disabled=""
                                            style="width: 100%">
                                        <option value="">اختر الفئة الفرعية</option>
                                    </select>
                                </div>
                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1"
                                     id="new_from_div_mob">
                                    <input type="number" class="form-control" id="new_from__mob" name="new_from_"
                                           value="" placeholder="أقل سعر ج.م" >
                                </div>
                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1"
                                     id="new_to_div_mob">
                                    <input type="number" class="form-control" id="new_to__mob" name="new_to_"
                                           value="" placeholder="أعلي سعر ج.م" >
                                </div>
                                <div class="form-group col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-12 py-1"
                                     id="new_sort_div_mob">
                                    <select class="form-control" id="new_sort_by_mob" name="new_sort_by">
                                        <option value="cr_desc">من الأحدث إلي الأقدم</option>
                                        <option value="cr_asc">من الأقدم إلي الأحدث</option>
                                        <option value="pr_asc">من الأقل سعر إلي الأعلي سعر</option>
                                        <option value="pr_desc">من الأعلي سعر إلي الأقل سعر</option>
                                    </select>
                                </div>
                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1"
                                     id="get_result_btn_div_mob">
                                    <button type="submit" class="btn get_result_btn w-100" id="get_result_btn_mob"><i
                                            class="fa-solid fa-magnifying-glass"></i> &nbsp;اظهر النتائج
                                    </button>
                                </div>
                                <div class="form-group col-xxl-6 col-xl-6 col-md-6 col-6 col-sm-6 py-1"
                                     id="get_adv_result_btn_div_mob">
                                    <a class="btn w-100 new_adv_search" href="javascript:void(0);"
                                       id="new_adv_search_mob"><i
                                            class="fa-solid fa-gears"></i> &nbsp;بحث متقدم</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <nav class="sidebar1">
        <div class="row mt-3" style="border-bottom: 1px solid #ddd">
            <div class="col-sm-6 col-6 text-right" style="padding-right: 21px; padding-top: 10px;">
                <h3 style="color: #2a4ead; font-size: 18px!important;" class="bold">القائمة</h3>
            </div>
            <div class="col-sm-6 col-6 text-left">
                <button class="btn" id="close_all"
                        style="color: #2a4ead; background: #f4f5fe!important;width: 58%;padding: 6px 0!important;">
                    <i class="fa-solid fa-xmark " style="font-size: 15px;padding: 0 6px!important; "></i>
                    <span>إغلاق</span>
                </button>
            </div>
        </div>
        @if(backpack_auth()->check())

            <div class="row mt-3" style="border-bottom: 1px solid #ddd">
                <div class="col-sm-12 col-12 text-right" style="padding-right: 21px; padding-top: 10px;">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        مرحباً, {{backpack_auth()->user()->name}}</h3>
                    <a href="{{route('personal.edit')}}" class="btn mx-2"
                       style="color: #000; background: #fff!important;width: 88px;padding: 4px 0 7px 0!important; border: 1px solid #000; border-radius: 30px">
                        <i class="fa-solid fa-user " style="font-size: 13px;padding: 0 6px!important; "></i>
                        <span>حسابي</span>
                    </a>
                </div>
                <div class="col-sm-12 col-12 text-right" style="padding-right: 21px; padding-top: 10px;">
                    <div class="row mt-2 mb-2">
                        <div class="col-3 col-sm-3 text-center">
                            <a href="{{route('user.posts.all')}}">
                                <div class="user_icons m-auto">
                                    <img src="{{asset('assets/front/images/clipboard-text.svg')}}" alt="clip">
                                </div>
                                <div class="mt-2">
                                    <span class="user_span">إعلاناتي</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-sm-3 text-center">
                            <a href="{{route('packages.bills')}}">
                                <div class="user_icons m-auto">
                                    <img src="{{asset('assets/front/images/award.svg')}}" alt="clip">
                                </div>
                                <div class="mt-2">
                                    <span class="user_span">باقاتي</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-sm-3 text-center">
                            <a href="{{route('cart.index')}}">
                                <div class="user_icons m-auto">
                                    <img src="{{asset('assets/front/images/cart.svg')}}" alt="clip">
                                </div>
                                <div class="mt-2">
                                    <span class="user_span">السلة</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-sm-3 text-center">
                            <a href="{{route('wish.list')}}">
                                <div class="user_icons m-auto">
                                    <img src="{{asset('assets/front/images/heart.svg')}}" alt="clip">
                                </div>
                                <div class="mt-2">
                                    <span class="user_span">المفضلة</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="row mt-3" style="border-bottom: 1px solid #ddd">
                <div class="col-sm-12 col-12 text-right" style="padding-right: 21px; padding-top: 10px;">
                    <a href="{{url('login')}}" class="btn" style="padding: 4px 0 7px 0!important; ">
                        <img src="{{asset('assets/front/images/user.svg')}}" class=" m-l-10" alt="user-login">
                        <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                            تسجيل الدخول / حساب جديد
                        </h3>

                    </a>
                </div>
            </div>

        @endif


        <div class="row mt-3">
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="{{route('site.home')}}" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/home-.svg')}}" class=" m-l-8 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        الصفحة الرئيسية
                    </h3>
                </a>
            </div>
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="javascript:void(0);" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/cats-.svg')}}" class=" m-l-10 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        جميع الأقسام
                    </h3>
                    <i class="fa-solid fa-chevron-left" style="color: #2a4ead;display: inline-block"></i>
                    <i class="fa-solid fa-chevron-down " style="color: #2a4ead; display:none;"></i>
                </a>
                <ul class="sub_menu">
                    @foreach($cats as $cat)
                        <li class="sub_menu_item position-relative">
                            <a href="javascript:void(0)" class="w-100 d-inline-block" style="padding: 5px 0">
                                <img src="{{asset($cat->image)}}" alt="cat-cover" class="m-l-10">
                                <h3 style="color: #2a4ead; font-size: 14px!important;" class="bold d-inline-block">
                                    {{$cat->title}}
                                </h3>
                                <i class="fa-solid fa-chevron-left" style="color: #2a4ead;"></i>
                                <i class="fa-solid fa-chevron-down " style="color: #2a4ead; display:none;"></i>
                            </a>
                            <ul class="sub_sub_menu">
                                @foreach($cat->subCategories as $item)
                                    <li class="sub_sub_item">
                                        <a href="{{route('cat.show', $item->slug)}}" class="">
                                            <img src="{{asset($item->image)}}" alt="cat-cover" class="m-l-10">
                                            <h3 style="color: #fd7e14; font-size: 14px!important;"
                                                class="bold d-inline-block">
                                                {{$item->title}}
                                            </h3>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="{{route('buy-package')}}" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/buy.svg')}}" class=" m-l-8 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        شراء باقات
                    </h3>
                </a>
            </div>
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="{{route('articles.index')}}" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/blog.svg')}}" class=" m-l-8 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        آخر الأخبار
                    </h3>
                </a>
            </div>
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="{{route('contact.us')}}" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/phone.svg')}}" class=" m-l-8 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        تواصل معنا
                    </h3>
                </a>
            </div>
            <div class="col-sm-12 col-12 text-right side_nav_item position-relative"
                 style="padding-right: 21px; padding-top: 10px;">
                <a href="{{route('about.us')}}" class="d-inline-block w-100 side_nav_all_cats"
                   style="padding: 4px 0 7px 0!important; ">
                    <img src="{{asset('assets/front/images/us.svg')}}" class=" m-l-8 " alt="user-login">
                    <h3 style="color: #2a4ead; font-size: 15px!important;" class="bold d-inline-block">
                        من نحن
                    </h3>
                </a>
            </div>
            <div class="col-sm-12 col-12 text-center side_nav_item position-relative" style="padding-top: 10px;">
                <a href="{{route('add.post')}}" class="w-100 btn"
                   style="padding: 4px 0 7px 0!important; color: #fff;background: #fd7e14;">
                    <h3 style=" font-size: 15px!important;" class="bold d-inline-block">
                        + أعلن الآن
                    </h3>
                </a>
            </div>
            @if(backpack_auth()->check())
                <div class="col-sm-12 col-12 text-center side_nav_item position-relative" style="padding-top: 10px;">
                    <a href="{{url('logout')}}" class="d-inline-block w-100 side_nav_all_cats"
                       style="padding: 4px 0 7px 0!important; ">
                        <img src="{{asset('assets/front/images/logout.svg')}}" class=" m-l-8 " alt="user-login">
                        <h3 style="color: #0b2050; font-size: 15px!important;" class="bold d-inline-block">
                            تسجيل الخروج
                        </h3>
                    </a>
                </div>
            @endif


        </div>
    </nav>
{{--    <nav class="sidebar2">--}}
{{--        <div class="side_bar_2_contact_div_dismiss">--}}
{{--            <div class="side_bar_2_contact_cover_btn_dismiss">--}}
{{--                <div class="spans_container_dismiss">--}}
{{--                    <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class=" side_bar_touch" style="margin: 3rem 13px 3rem 0!important;">--}}
{{--            <ul class="list-unstyled menu-elements side_bar_2_menu"--}}
{{--                style="text-align: center; width: 100%;margin-top: 114px">--}}
{{--                <li class="{{Route::currentRouteName() == 'site.home' ? 'active' : ''}}">--}}
{{--                    <a class="scroll-link {{Route::currentRouteName() == 'site.home' ? 'active' : ''}}"--}}
{{--                       href="{{route('site.home')}}" style="padding: 10px 30px;">--}}
{{--                        <i class="fas fa-home"></i> &nbsp;&nbsp;{{__('messages.home')}}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li style="padding: 0">--}}
{{--                    <div class="services_sidebar_2_btn {{Route::currentRouteName() == 'site.service' ? 'active' : ''}}"--}}
{{--                         style="    padding: 10px 0;border-radius: 5px">--}}
{{--                        <a href="javascript:void(0)"--}}
{{--                           class="{{Route::currentRouteName() == 'site.service' ? 'active' : ''}}">--}}
{{--                            <img--}}
{{--                                src="{{Route::currentRouteName() == 'site.service' ? asset('assets/front/images/tri_w.png') : asset('assets/front/images/tri.png')}}"--}}
{{--                                alt="icon" style="width: 12px;position: relative;right: -10px;top: -1px;">--}}
{{--                            <i class="fa-solid fa-boxes-stacked"></i> &nbsp;&nbsp;الأقسام--}}
{{--                        </a>--}}
{{--                    </div>--}}


{{--                    <ul id="otherServices">--}}

{{--                        @foreach($cats as $cat)--}}
{{--                            <li class="{{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}} main_cat">--}}
{{--                                <a href="javascript:void(0)"--}}
{{--                                   class="{{Route::currentRouteName() == 'site.service' ? 'active' : ''}}">--}}
{{--                                    <img--}}
{{--                                        src="{{Route::currentRouteName() == 'site.service' ? asset('assets/front/images/tri_w.png') : asset('assets/front/images/tri.png')}}"--}}
{{--                                        alt="icon" style="width: 12px;position: relative;right: -10px;top: -1px;">--}}
{{--                                    &nbsp;&nbsp;{{$cat->title}}--}}
{{--                                </a>--}}
{{--                                <ul class="sub_cats_menu">--}}
{{--                                    @foreach($cat->subCategories as $item)--}}
{{--                                        --}}{{--                                        <li class="menu-item">--}}
{{--                                        --}}{{--                                            <a class="menu-button"--}}
{{--                                        --}}{{--                                               href="{{route('cat.show', $item->slug)}}">{{$item->title}}</a>--}}
{{--                                        --}}{{--                                        </li>--}}
{{--                                        <li class="{{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}}">--}}
{{--                                            <a class="scroll-link {{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}}"--}}
{{--                                               href="{{route('cat.show', $item->slug)}}">{{$item->title}}</a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}

{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}

{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="{{Route::currentRouteName() == 'buy-package' || Route::currentRouteName() == 'packages.show'  ? 'active' : ''}}">--}}
{{--                    <a class="scroll-link {{Route::currentRouteName() == 'buy-package' || Route::currentRouteName() == 'packages.show'  ? 'active' : ''}}"--}}
{{--                       href="{{route('buy-package')}}">--}}
{{--                        <i class="fa-solid fa-bolt"></i> &nbsp;&nbsp;شراء باقات</a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a class="scroll-link internal" href="{{ route('add.post')}}">--}}
{{--                        <i class="fa-solid fa-address-card"></i>&nbsp;&nbsp; أعلن الآن</a>--}}
{{--                </li>--}}

{{--                <li class="{{Route::currentRouteName() == 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'active' : ''}}">--}}
{{--                    <a class="scroll-link {{Route::currentRouteName() == 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'active' : ''}}"--}}
{{--                       href="{{route('articles.index')}}">--}}
{{--                        <i class="fa-solid fa-blog"></i> &nbsp;&nbsp;آخر الأخبار</a>--}}
{{--                </li>--}}


{{--                <li class="{{Route::currentRouteName() == 'contact.us'  ? 'active' : ''}}">--}}
{{--                    <a class="scroll-link {{Route::currentRouteName() == 'contact.us' ? 'active' : ''}}"--}}
{{--                       href="{{route('contact.us')}}">--}}
{{--                        <i class="fa-solid fa-phone"></i> &nbsp;&nbsp;تواصل معنا</a>--}}
{{--                </li>--}}


{{--                <li class="{{Route::currentRouteName() == 'about.us' ? 'active' : ''}}">--}}
{{--                    <a class="scroll-link {{Route::currentRouteName() == 'about.us' ? 'active' : ''}}"--}}
{{--                       href="{{route('about.us')}}"><i--}}
{{--                            class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;{{__('messages.about-us')}}</a>--}}
{{--                </li>--}}


{{--            </ul>--}}


{{--        </div>--}}
{{--    </nav>--}}
</header>

<!-- Search Modal -->
{{--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"--}}
{{--     dir="ltr">--}}
{{--    <div class="modal-dialog modal-dialog-centered search-modal" style="max-width: 1000px!important;">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header" style="padding: 10px 1rem;border: none">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel"></h5>--}}
{{--                <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                    <img src="{{asset('assets/front/images/cross.png')}}" alt="close" style="width: 37px"></a>--}}
{{--            </div>--}}
{{--            <div class="modal-body" style="padding: 4px 1rem;">--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal"--}}
{{--                       class="search-btn">--}}
{{--                        <img src="{{asset('assets/front/images/search.png')}}" alt="search-icon" style="width: 45px">--}}
{{--                    </a>--}}
{{--                    <input type="text" name="search_keyword" class="form-control search-inp"--}}
{{--                           placeholder="{{__('messages.search_holder')}}" aria-label="Example text with button addon"--}}
{{--                           aria-describedby="button-addon1" style="direction: {{General::getDir()}}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


