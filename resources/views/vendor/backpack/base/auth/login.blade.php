@extends('front.layouts.master')

@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;">
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>


                    <span class="bold">تسجيل الدخول</span>


                </div>

                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 py-2 text-left back">
                    <a href="{{ url()->previous() }}"
                       class="bold">العودة</a>
                    <div class="d-inline-block position-relative" style="width: 25px"><i
                            style="position: absolute;top: -15px;right: 3px;"
                            class="fa-solid fa-chevron-left mt-1  px-1 "></i></div>

                </div>
            </div>

        </div>
    </div>
    <div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-12 col-md-8 col-lg-6 login-cont mt-1 pb-5">
            @php
                $settings = \App\Models\Setting::first();
            @endphp
            <div class="logo text-center my-4" style="width: auto!important;">
                <img src="{{asset($settings->logo)}}" alt="logo" style="width: 150px;">
            </div>


            <h3 class="text-center mb-4 bold">{{ trans('backpack::base.login') }}</h3>
            <div class="provider_login text-center">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5 col-6 m-auto">
                        <a href="{{route('google.login')}}" class="btn  google_btn l_18 ">Google <i class="fa-brands fa-google-plus-g fa-xl"></i></a>
                    </div>
                    <div class="col-md-5 col-6 m-auto">
                        <a href="{{route('facebook.login')}}" class="btn  fb_btn l_18 ">Facebook <i class="fa-brands fa-facebook-f fa-l"></i></a>
                    </div>
                    <div class="col-md-1"></div>

                </div>
            </div>
            <div class="text-center or">
                <p class="bold"><span class="l_29">_________________</span><span>&nbsp;&nbsp; أو &nbsp;&nbsp;</span><span class="l_29">_________________</span></p>
            </div>
            <div class="card login-card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label bold my-2" for="{{ $username }}">البريد الإلكتروني</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has($username) ? ' is-invalid' : '' }}" name="{{ $username }}" value="{{ old($username) }}" id="{{ $username }}" placeholder="ادخل البريد الإلكتروني">

                                @if ($errors->has($username))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first($username) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label bold my-2" for="password">{{ trans('backpack::base.password') }}</label>

                            <div>
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="ادخل كلمة المرور">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-check my-3 remember_check">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="remember">

                            <label class=" check-lable form-check-label" style="margin-right: 30px" for="flexCheckDefault">
                                {{ trans('backpack::base.remember_me') }}
                            </label>

                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6 m-auto text-center">
                                    <button type="submit" class="btn login_btn">
                                        {{ trans('backpack::base.login') }}
                                    </button>
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-7" style="text-align: right">
                                @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                                    <div class=""><a class="bold" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a></div>
                                @endif

                            </div>
                            <div class="col-md-6 col-5" style="text-align: left">
                                @if (config('backpack.base.registration_open'))
                                    <div class=""><a class="bold"  href="{{ route('backpack.auth.register') }}">مستخدم جديد ؟</a></div>
                                @endif
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
