@extends('front.layouts.master')

@section('styles')
    <style>
        .tab-content {background: #fff;margin-top: -1px;    background-clip: border-box;border: 1px solid rgba(0, 40, 100, .12);border-radius: 3px;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);}
        .nav-tabs .nav-link.active {color: #000}
        .nav-link.disabled {color: #6c757d !important;}
    </style>
@stop
@section('content')
    <div class="row justify-content-center m-r-0 m-l-0">
        <div class="col-12 col-md-8 col-lg-4 login-cont">
            @php
                $settings = \App\Models\Setting::first();
            @endphp
            <div class="logo text-center my-4">
                <img src="{{asset($settings->logo)}}" alt="logo" style="width: 150px;">
            </div>
            <h3 class="text-center bold mb-4">{{ trans('backpack::base.reset_password') }}</h3>


            <div class="nav-steps-wrapper">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link disabled text-muted"> {{ trans('backpack::base.confirm_email') }}
                        </a>
                    </li>
                    <li class="nav-item active" ><a class="nav-link active" data-bs-target="#tab_1"
                                                    href="javascript:void(0)"
                                                    data-toggle="tab"> {{ trans('backpack::base.choose_new_password') }}</a></li>

                </ul>
            </div>


            <div class="nav-tabs-custom">
                <div class="tab-content">
                  <div class="tab-pane active p-3" id="tab_1">
                    @if (session('status'))
                        <div class="alert alert-success mt-3">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.password.reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-3">
                            <label class="control-label bold my-2" for="email">{{ trans('backpack::base.email_address') }}</label>

                            <div>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $email ?? old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label bold my-2" for="password">{{ trans('backpack::base.new_password') }}</label>

                            <div>
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label bold my-2" for="password_confirmation">{{ trans('backpack::base.confirm_new_password') }}</label>
                            <div>
                                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6 m-auto text-center">
                            <div>
                                <button type="submit" class="btn btn login_btn">
                                    {{ trans('backpack::base.change_password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
        </div>
    </div>


@endsection
