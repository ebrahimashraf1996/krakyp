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
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-2 col-2" dir="ltr" style="margin-top: 13px">
                    <form action="{{route('quick.search')}}" method="get">
                        @csrf
                        <div class="input-group search-input">
                            <button type="submit" class="input-group-text search_btn_icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" name="key_word"
                                   placeholder="مثال : اسم الماركة او نوع العقار" style="text-align: right">
                            @php
                                $cats = App\Models\Category::select('id', 'title')->get();
                            @endphp
                            <select class="form-control dropdown-toggle" id="quick_cat" name="quick_cat"
                                    style="width: 25%; text-align: right">
                                <option value="">اختر الفئة</option>
                                @foreach($cats as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-2 text-right" style="margin-top: 13px">
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
                                <li class="menu_item"><a href="{{route('user.posts')}}" class="dropdown-item"><i
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
                <div class="col-xxl-2 col-xl-2 col-md-2 col-sm-2 col-2" style="margin-top: 13px">
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
                            <a href="{{route('site.home')}}" class="nav_menu_item {{Route::currentRouteName() === 'site.home' ? 'hovered' : '' }}">
                                <span>
                                    الرئيسية
                                </span>
                            </a>
                        </li>
                        <li>
                            <span class="cat_menu_btn nav_menu_item {{Route::currentRouteName() === 'cat.show' ? 'hovered' : '' }}">
                                الأقسام
                            </span>
                        </li>
                        <li>
                            <a href="{{route('buy-package')}}" class="nav_menu_item {{Route::currentRouteName() === 'buy-package' ? 'hovered' : '' }}">
                                <span>شراء باقات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('add.post')}}" class="nav_menu_item {{Route::currentRouteName() === 'add.post' ? 'hovered' : '' }}">
                                <span>أعلن الآن</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('articles.index')}}" class="nav_menu_item {{Route::currentRouteName() === 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'hovered' : '' }}">
                                <span>المقالات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('contact.us')}}" class="nav_menu_item {{Route::currentRouteName() === 'contact.us' ? 'hovered' : '' }}">
                                <span>تواصل معنا</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('about.us')}}" class="nav_menu_item {{Route::currentRouteName() === 'about.us' ? 'hovered' : '' }}">
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
                            <div class="col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-4 single_cat_div">
                                <div class="row p-b-10 p-t-10">
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
                                        <li><a href="{{route('user.posts')}}" class="dropdown-item l_16"><i
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
                                    $cats = \App\Models\Category::active()->main()->select('id', 'title', 'slug', 'parent_id')->get();
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
    <nav class="mob_nav" style="background-image: url('{{asset('assets/front/images/nav-bg.png')}}')">
        <div class="row p-0 m-0">
            <div class="col-sm-6 col-7" style=" height: 60px">
                @if(backpack_auth()->check())
                    <div style="margin: 10px 7px;">
                        <a class="side_bar_contact_div" href="javascript:void(0);">
                            <img class="flag" src="{{asset(backpack_auth()->user()->image)}}" alt="user-photo">
                        </a>
                    </div>
                @else
                    <div class="bold" style="margin: 14px 0">
                        <a class="l_14" href="{{url('register')}}">
                            حساب جديد ؟
                        </a> /
                        <a class="l_14" href="{{url('login')}}">
                            تسجيل الدخول
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-sm-6 col-5 " style=" height: 60px; text-align: left; padding-left: 22px; margin-top:6px;">

                <a class="logo_mobile" href="{{route('site.home')}}">
                    <img src="{{asset($settings->logo)}}" alt="logo" style="width: 47px">
                </a>
                <a href="javascript:void(0);">
                    <img src="{{asset('assets/front/images/side-bar-btn.png')}}" alt="side-bar-btn"
                         class="side-bar-btn" style="width: 47px;">
                </a>
            </div>
        </div>
    </nav>
    <nav class="sidebar1">
        <div class="side_bar_contact_div_dismiss">
            <div class="side_bar_contact_cover_btn_dismiss">
                <div class="spans_container_dismiss">
                    <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">
                </div>
            </div>
        </div>
        <!-- close sidebar menu -->


        <div class="logo">
            <a href="{{route('site.home')}}">
                <img src="{{asset($settings->logo)}}" style="margin-bottom: 10px;width: 100px;" alt="">
            </a>
        </div>
        @if(backpack_auth()->check())

            <div class="side_bar_touch">
                <ul id="lang_list">
                    <li class="menu_span"> أهلا وسهلا</li>
                    <li class="menu_span"><span class="bold">{{backpack_auth()->user()->name}}</span></li>
                    @if(backpack_auth()->check())
                        <li><a href="{{route('personal.edit')}}" class="dropdown-item l_18"><i
                                    class="fa-solid fa-square-pen"></i>&nbsp;&nbsp; تعديل الملف
                                الشخصي</a></li>
                    @endif
                    <li><a href="{{route('user.posts')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-paste"></i>&nbsp;&nbsp; إعلاناتي</a></li>
                    <li><a href="{{route('packages.bills')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-money-check-dollar"></i>&nbsp;&nbsp; باقاتي
                        </a></li>
                    <li><a href="{{route('cart.index')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp; السلة</a></li>
                    <li><a href="{{route('wish.list')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-heart"></i>&nbsp;&nbsp; قائمة المفضلة</a>
                    </li>
                    <li><a href="{{route('buy-package')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-credit-card"></i>&nbsp;&nbsp; شراء باقات</a></li>
                    {{--                    <li><a href="#" class="dropdown-item l_18"><i--}}
                    {{--                                class="fa-solid fa-circle-question"></i>&nbsp;&nbsp; المساعدة</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a href="#" class="dropdown-item l_18"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;--}}
                    {{--                            الإعدادات</a></li>--}}
                    <li><a href="{{url('logout')}}" class="dropdown-item l_18"><i
                                class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp; تسجيل الخروج</a>
                    </li>
                </ul>
            </div>

        @endif
    </nav>
    <nav class="sidebar2">
        <div class="side_bar_2_contact_div_dismiss">
            <div class="side_bar_2_contact_cover_btn_dismiss">
                <div class="spans_container_dismiss">
                    <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">
                </div>
            </div>
        </div>
        <div class=" side_bar_touch" style="margin: 3rem 13px 3rem 0!important;">
            <ul class="list-unstyled menu-elements side_bar_2_menu"
                style="text-align: center; width: 100%;margin-top: 114px">
                <li class="{{Route::currentRouteName() == 'site.home' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.home' ? 'active' : ''}}"
                       href="{{route('site.home')}}" style="padding: 10px 30px;">
                        <i class="fas fa-home"></i> &nbsp;&nbsp;{{__('messages.home')}}
                    </a>
                </li>
                <li style="padding: 0">
                    <div class="services_sidebar_2_btn {{Route::currentRouteName() == 'site.service' ? 'active' : ''}}"
                         style="    padding: 10px 0;border-radius: 5px">
                        <a href="javascript:void(0)"
                           class="{{Route::currentRouteName() == 'site.service' ? 'active' : ''}}">
                            <img
                                src="{{Route::currentRouteName() == 'site.service' ? asset('assets/front/images/tri_w.png') : asset('assets/front/images/tri.png')}}"
                                alt="icon" style="width: 12px;position: relative;right: -10px;top: -1px;">
                            <i class="fa-solid fa-boxes-stacked"></i> &nbsp;&nbsp;الأقسام
                        </a>
                    </div>


                    <ul id="otherServices">

                        @foreach($cats as $cat)
                            <li class="{{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}} main_cat">
                                <a href="javascript:void(0)"
                                   class="{{Route::currentRouteName() == 'site.service' ? 'active' : ''}}">
                                    <img
                                        src="{{Route::currentRouteName() == 'site.service' ? asset('assets/front/images/tri_w.png') : asset('assets/front/images/tri.png')}}"
                                        alt="icon" style="width: 12px;position: relative;right: -10px;top: -1px;">
                                    &nbsp;&nbsp;{{$cat->title}}
                                </a>
                                <ul class="sub_cats_menu">
                                    @foreach($cat->subCategories as $item)
                                        {{--                                        <li class="menu-item">--}}
                                        {{--                                            <a class="menu-button"--}}
                                        {{--                                               href="{{route('cat.show', $item->slug)}}">{{$item->title}}</a>--}}
                                        {{--                                        </li>--}}
                                        <li class="{{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}}">
                                            <a class="scroll-link {{Route::currentRouteName() == 'site.service' && Route::current()->parameters()["slug"] === $item->slug   ? 'active' : ''}}"
                                               href="{{route('cat.show', $item->slug)}}">{{$item->title}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach

                    </ul>
                </li>

                <li class="{{Route::currentRouteName() == 'buy-package' || Route::currentRouteName() == 'packages.show'  ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'buy-package' || Route::currentRouteName() == 'packages.show'  ? 'active' : ''}}"
                       href="{{route('buy-package')}}">
                        <i class="fa-solid fa-bolt"></i> &nbsp;&nbsp;شراء باقات</a>
                </li>

                <li>
                    <a class="scroll-link internal" href="{{ route('add.post')}}">
                        <i class="fa-solid fa-address-card"></i>&nbsp;&nbsp; أعلن الآن</a>
                </li>

                <li class="{{Route::currentRouteName() == 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'articles.index' || Route::currentRouteName() === 'articles.show' ? 'active' : ''}}"
                       href="{{route('articles.index')}}">
                        <i class="fa-solid fa-blog"></i> &nbsp;&nbsp;آخر الأخبار</a>
                </li>


                <li class="{{Route::currentRouteName() == 'contact.us'  ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'contact.us' ? 'active' : ''}}"
                       href="{{route('contact.us')}}">
                        <i class="fa-solid fa-phone"></i> &nbsp;&nbsp;تواصل معنا</a>
                </li>


                <li class="{{Route::currentRouteName() == 'about.us' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'about.us' ? 'active' : ''}}"
                       href="{{route('about.us')}}"><i
                            class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;{{__('messages.about-us')}}</a>
                </li>


            </ul>


        </div>
    </nav>
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


