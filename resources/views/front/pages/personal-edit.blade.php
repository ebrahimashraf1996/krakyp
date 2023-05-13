@extends('front.layouts.master')

@section('styles')
    <style>
        .featured-section {
            padding-top: 117px
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



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">تعديل البيانات الشخصية</h3>
                </div>
            </div>
            <div class="row add-post-form-row">
                <form class="col-md-11 col-sm-12 add-post-form m-auto" method="POST"
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

