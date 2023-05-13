@extends('front.layouts.master')

@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('styles')
    {{--    {!! htmlScriptTagJsApi() !!}--}}
    <style>
        .terms {
            margin-top: 137px
        }
    </style>
@stop
@section('content')
    <section class="terms mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h1 class="bold">بنود الخدمة ...</h1>
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12 contact-methods">
                    <div class="mb-3">
                        <p class="mb-3">
                            {!! $settings->terms !!}
                        </p>
                    </div>


                </div>

            </div>
        </div>
    </section>

@stop
@section('script')
    <script>




    </script>
@stop
