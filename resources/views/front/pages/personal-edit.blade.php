@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            /*padding-top: 117px*/
        }

        textarea.description_text {
            /*white-space: pre-wrap;*/
            white-space: pre-wrap;
            font-weight: normal;
        }

        .custom-file-button input[type="file"] {
            margin-right: -2px !important;
        }

        .custom-file-button input[type="file"]::-webkit-file-upload-button {
            display: none;
        }

        .custom-file-button input[type="file"]::file-selector-button {
            display: none;
        }

        .custom-file-button:hover label {
            background-color: #dde0e3;
            cursor: pointer;
            border-radius: 0 .25rem .25rem 0 !important;
        }

        .custom-file-button label {
            border-radius: 0 .25rem .25rem 0 !important;
        }

        .required {
            color: red
        }

    </style>
@stop

@section('content')
    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;" >
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-9 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span class="bold">حسابي</span>


                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span class="bold">تعديل البيانات الشخصية</span>


                </div>

                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-3 py-2 text-left back">
                    <a href="{{ url()->previous() }}"
                       class="bold">العودة</a>
                    <div class="d-inline-block position-relative" style="width: 25px"><i
                            style="position: absolute;top: -15px;right: 3px;"
                            class="fa-solid fa-chevron-left mt-1  px-1 "></i></div>

                </div>
            </div>

        </div>
    </div>



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container" style="max-width: 1044px;">
            <div class="row py-4">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                    <h3 class="bold">تعديل البيانات الشخصية...</h3>
                </div>
            </div>
            <div class="row add-post-form-row">
                <form class="col-lg-12 col-md-12 col-sm-12 col-12 add-post-form m-auto" method="POST"
                      action="{{route('personal.update')}}" enctype="multipart/form-data">
                    @csrf
                    @if($user->image != null)
                        <div class="row p-4">
                            <div class="col-md-3 col-12 col-sm-12 m-auto text-center">
                                <img src="{{$user->image}}" alt="user-image" class="w-100" style="border-radius: 22px;">
                                <a href="javascript:void(0);" class="bold blue l_17" id="edit_photo">تعديل الصورة</a>
                                <input type="hidden" name="edit_photo_check" id="edit_photo_check" value="0">
                                <div class="form-group my-2" id="edit_photo_div" style="display: none">

                                    <div class="mb-3 input-group custom-file-button" id="browseFile_div">
                                        <label for="browseFile" class="input-group-text bold">اختر الصورة</label>
                                        <input class="form-control" type="file" id="browseFile" name="image">
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="required">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endif
                    <div class="row p-4">
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="name" class="bold mb-1">الإسم بالكامل <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                   placeholder="{{__('messages.form.name')}}" id="name">
                            @if ($errors->has('name'))
                                <span class="required">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="email" class="bold mb-1">البريد الإلكتروني <span
                                    class="required">*</span></label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}"
                                   placeholder="البريد الإلكتروني" id="email">
                            @if ($errors->has('email'))
                                <span class="required">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="phone" class="bold mb-1">رقم الهاتف <span class="required">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{$user->phone}}"
                                   placeholder="رقم الهاتف" id="phone">
                            @if ($errors->has('phone'))
                                <span class="required">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="whats_app" class="bold mb-1">رقم الواتساب <span class="required">*</span></label>
                            <input type="text" name="whats_app" class="form-control" value="{{$user->whats_app}}"
                                   placeholder="رقم الواتساب" id="whats_app">
                            @if ($errors->has('whats_app'))
                                <span class="required">
                                <strong>{{ $errors->first('whats_app') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="serial_num" class="bold mb-1">الرقم التسلسلي</label>
                            <input type="text" name="" class="form-control" value="{{$user->serial_num}}"
                                   placeholder="الرقم التسلسلي" id="serial_num" readonly>
                            @if ($errors->has('serial_num'))
                                <span class="required">
                                <strong>{{ $errors->first('serial_num') }}</strong>
                            </span>
                            @endif
                        </div>

                        @if($user->image == null)
                            <div class="col-md-6 col-12 col-sm-12 ">
                                <input type="hidden" name="edit_photo_check" id="edit_photo_check" value="1">

                                <div class="form-group my-2" id="edit_photo_div">
                                    <p class="bold mb-1">الصورة الشخصية</p>
                                    <div class="mb-3 input-group custom-file-button" id="browseFile_div">
                                        <label for="browseFile" class="input-group-text bold">اختر الصورة</label>
                                        <input class="form-control" type="file" id="browseFile" name="image">
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="required">
                                <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="row p-4 " style="padding-top:0!important;">
                        <div class="col-md-6 col-12 col-sm-12 my-2">
                            <label for="description" class="bold mb-1">الوصف المختصر</label>
                            <textarea rows="6" type="text" name="description" class="form-control description_text"
                                      placeholder="الوصف المختصر" id="description">{{$user->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="required">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-3 m-auto text-center">
                            <button class="btn btn_submit">حفظ التغييرات</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    {{--    End Featured Cats--}}










@endsection




@section('script')
    <script>
        $(document).ready(function () {
            let edit_photo = $('#edit_photo');
            let edit_photo_div = $('#edit_photo_div');
            let edit_photo_check = $('#edit_photo_check');

            edit_photo.on('click', function () {
                if (edit_photo_check.val() === '0') {
                    edit_photo_check.val('1');
                } else {
                    edit_photo_check.val('0');
                }
                edit_photo_div.slideToggle(500);
            });
        });
    </script>
@stop

