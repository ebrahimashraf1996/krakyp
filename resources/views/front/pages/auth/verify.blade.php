@extends('front.layouts.master')

@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-12 col-md-8 col-lg-6 login-cont">
            @php
                $settings = \App\Models\Setting::first();
            @endphp
            <div class="logo text-center my-4">
                <img src="{{asset($settings->logo)}}" alt="logo" style="width: 150px;">
            </div>


            <h3 class="text-center mb-4 bold">تأكيد رقم الهاتف</h3>

            <div class="card login-card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('verify.post') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label bold my-2" for="phone">رقم الهاتف</label>

                            <div>
                                <input type="text" class="form-control" name="phone" value="{{$phone}}" id="phone" placeholder="رقم الهاتف" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label bold my-2" for="otp">رمز التأكيد</label>
                            <div>
                                <input type="text" class="form-control" name="otp" value="" id="otp" placeholder="رمز تأكيد رقم الهاتف" >
                            </div>
                            @if ($errors->has('otp'))
                                <span class="invalid-feedback" style="display: flex">
                                    <strong>{{ $errors->first('otp') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-6 m-auto text-center">
                                    <button type="submit" class="btn login_btn">
                                        تأكيد
                                    </button>
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-7" style="text-align: right">
                                @if(isset($wait))
                                <span class="required l_14" id="please_wait">
                                    {{$wait}}
                                </span>
                                    @else
                                    <span class="required l_14" id="please_wait">
                                </span>
                                @endif

                            </div>
                            <div class="col-md-6 col-5" style="text-align: left">

                                    <div class="">
                                        <a class="bold"  href="javascript:void(0)" id="resend_otp">
                                            إعادة إرسال رمز التأكيد
                                        </a>
                                    </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let resend_otp = $('#resend_otp');
            resend_otp.on('click', function (e) {
                e.preventDefault();
                $('.lds-circle').addClass('active');
                $('.overlay').addClass('active');
                $.ajax({
                    url: "{{route('otp.resend')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    type:"POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response.msg);
                        let wait = $('#please_wait');
                        if (response.status === 0) {
                            wait.text(response.msg);
                        }
                        if (response.status === 1) {
                            Swal.fire({
                                icon: 'success',
                                text: "تم إرسال الرمز .. برجاء فحص رسائل الهاتف",
                                dangerMode: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,
                            });
                        }

                    }
                });
                window.setTimeout(function () {
                    $('.lds-circle').removeClass('active');
                    $('.overlay').removeClass('active');
                }, 500);

            });
                //
        });
    </script>
@stop

