@extends('front.layouts.master')

@section('content')
    <div class="row justify-content-center m-r-0 m-l-0">
        <div class="col-12 col-md-8 col-lg-4 login-cont">
            @php
                $settings = \App\Models\Setting::first();
            @endphp
            <div class="logo text-center my-4">
                <img src="{{asset($settings->logo)}}" alt="logo" style="width: 150px;">
            </div>

            <h3 class="text-center mb-4 bold">تسجيل حساب جديد</h3>
            <div class="provider_login text-center">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5 col-6 col-sm-6 m-auto">
                        <a href="{{route('google.login')}}" class="btn  google_btn l_18 ">Google <i class="fa-brands fa-google-plus-g fa-xl"></i></a>
                    </div>
                    <div class="col-md-5 col-6 col-sm-6 m-auto">
                        <a href="{{route('facebook.login')}}" class="btn  fb_btn l_18 ">Facebook <i class="fa-brands fa-facebook-f fa-l"></i></a>
                    </div>
                    <div class="col-md-1"></div>

                </div>
            </div>
            <div class="text-center or">
                <p class="bold"><span class="l_29">_________________</span><span>&nbsp;&nbsp; أو &nbsp;&nbsp;</span><span class="l_29">_________________</span></p>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label bold my-2" for="name">الإسم بالكامل</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" placeholder="ادخل الإسم بالكامل">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label bold my-2" for="{{ backpack_authentication_column() }}">البريد الإلكتروني</label>

                            <div>
                                <input type="{{ backpack_authentication_column()=='email'?'email':'text'}}" class="form-control{{ $errors->has(backpack_authentication_column()) ? ' is-invalid' : '' }}" name="{{ backpack_authentication_column() }}" id="{{ backpack_authentication_column() }}" value="{{ old(backpack_authentication_column()) }}" placeholder="ادخل البريد الإلكتروني">

                                @if ($errors->has(backpack_authentication_column()))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(backpack_authentication_column()) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label bold my-2" for="phone">رقم الهاتف</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" value="{{ old('phone') }}" placeholder="ادخل رقم الهاتف">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
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

                        <div class="form-group">
                            <label class="control-label bold my-2" for="password_confirmation">{{ trans('backpack::base.confirm_password') }}</label>

                            <div>
                                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-6 col-12 col-sm-12 m-auto text-center">
                                <button type="submit" class="btn login_btn">
                                    تسجيل حساب جديد
                                </button>
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-sm-6 col-6" style="text-align: right">
                                @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                                    <div class=""><a class="bold" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a></div>
                                @endif

                            </div>
                            <div class="col-md-6 col-sm-6 col-6" style="text-align: left">
                                @if (config('backpack.base.registration_open'))
                                    <div class=""><a class="bold"  href="{{ route('backpack.auth.login') }}">لديك حساب بالفعل ؟</a></div>
                                @endif
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
