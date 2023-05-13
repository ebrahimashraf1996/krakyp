@extends('front.layouts.master')

@section('styles')



    <style>
        .progress {
            display: none;
        }

        .spinner_img {
            display: none;
            width: 38px;
        }



        .dz-image img {
            width: 100%;
            height: 100%;

        }

        .dropzone.dz-started .dz-message {
            display: block !important;
        }

        .dropzone {
            border: 2px dashed #028AF4 !important;;
        }

        .dropzone .dz-preview.dz-complete .dz-success-mark {
            opacity: 1;
        }

        .dropzone .dz-preview.dz-error .dz-success-mark {
            opacity: 0;
        }

        .dropzone .dz-preview .dz-error-message {
            top: 144px;
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

        #formFile {
            border-radius: .25rem 0 0 .25rem !important;
        }
         .featured-section{margin-top: 137px}
    </style>
    {{--    <script>--}}
    {{--        var form = document.getElementById('dropzone');--}}
    {{--        // alert('test');--}}
    {{--        Dropzone.options.form = {--}}
    {{--            thumbnailWidth:200,--}}
    {{--            maxFileSize:3,--}}
    {{--            acceptedFiles:".jpeg,.jpg,.png,.gif"--}}
    {{--        };--}}
    {{--    </script>--}}
@stop

@section('content')



    {{--    Start Featured Cats--}}
    <section class="featured-section text-center">
        <div class="container">
            <div class="row  my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">إضافة إعلان</h3>
                </div>

            </div>
            <div class="row add-post-form-row">
                <form class="col-md-11 col-sm-12 add-post-form m-auto" id="add-post-form" method="POST"
                      action="{{route('add.post.two')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cat_id" id="cat_id" value="{{$request->cat_id}}">
                    <input type="hidden" name="sub_cat_id" id="sub_cat_id" value="{{$request->sub_cat_id}}">
                    <input type="hidden" name="country" id="country" value="{{$request->country}}">
                    <input type="hidden" name="city_id" id="city_id" value="{{$request->city_id}}">
                    <input type="hidden" name="state_id" id="state_id" value="{{$request->state_id}}">
                    <input type="hidden" name="status" id="status" value="{{$request->status}}">
                    <input type="hidden" name="pack_id" id="pack_id" value="{{$request->pack_id}}">

                    <div class="row p-4">
                        <div class="row bordered">
                            <div class="form-group col-md-6 my-2">
                                <label for="title" class="mb-2 bold">عنوان الإعلان
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="ادخل عنوان الإعلان" value="{{old('title')}}" required>
                                @error("title")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
{{--                            <div class="form-group col-md-6 my-2">--}}
{{--                                <label for="slug" class="mb-2 bold">العنوان بالرابط--}}
{{--                                </label>--}}
{{--                                <input type="text" class="form-control" id="slug" name="slug" readonly=""--}}
{{--                                       value="{{old('slug')}}" required>--}}
{{--                                @error("slug")--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}


{{--                            <div class="form-group col-md-6 my-2" id="cover_cont">--}}
{{--                                <p class="mb-0 bold">صورة الغلاف <span class="bold text-muted">(400x400)</span>&nbsp;&nbsp;&nbsp;--}}
{{--                                    <a href="javascript:void(0);" id="delete_cover" class="d-none"><span class="">تغيير الصورة ؟</span></a>--}}
{{--                                </p>--}}
{{--                                <div class="mb-3 input-group custom-file-button" id="browseFile_div">--}}
{{--                                    <label for="browseFile" class="input-group-text bold">اختر الصورة</label>--}}
{{--                                    <input class="form-control" type="file" id="browseFile">--}}
{{--                                </div>--}}
{{--                                <div class="progress" style="height: 25px;margin-top: 7px;">--}}
{{--                                    <div class="progress-bar progress-bar-striped progress-bar-animated"--}}
{{--                                         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"--}}
{{--                                         style="width: 75%; height: 100%">75%--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @error("cover_image")--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                                <input type="hidden" value="" name="cover_image" id="cover_image">--}}

{{--                            </div>--}}

                            <div class="form-group col-md-6 my-2">
                                <label for="price" class="mb-2 bold">السعر
                                    <span class="text-muted">ج.م </span>
                                </label>
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{old('price')}}" placeholder="السعر ج.م">

                                @error("price")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 my-2">
                                <label for="description" class="mb-2 bold"> الوصف البسيط
                                </label>
                                <textarea type="description" id="description"
                                          class="form-control" style="height: 150px"
                                          placeholder=" ادخل الوصف البسيط للإعلان "
                                          name="description"
                                          required>{{old('description')}}</textarea>
                                @error("description")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 mb-3">
                        <div class="row bordered" id="atts_div">
{{--                            @foreach($cat->attributes as $k => $item)--}}
{{--                                @if($item->type == 'select')--}}
{{--                                    <div class="form-group col-md-3 my-4 attr_single" id="attr_single_{{$k}}">--}}
{{--                                        <label style="font-weight: bold" for="attr_{{$k}}"--}}
{{--                                               class="mb-2"> {{$item->title}}--}}
{{--                                        </label>--}}
{{--                                        <select class="" id="attr_{{$k}}"  data-test="{{$item->type}}" name="attr_{{$item->id}}" required>--}}
{{--                                            <option value="">اختر {{$item->title}}</option>--}}
{{--                                            @foreach($item->options as $option)--}}
{{--                                                <option value="{{$option->id}}">{{$option->val}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                @elseif($item->type == 'txt')--}}
{{--                                    <div class="form-group col-md-3 my-4 attr_single" id="attr_single_{{$k}}">--}}
{{--                                        <label style="font-weight: bold" for="attr_{{$k}}"--}}
{{--                                               class="mb-2"> {{$item->title}}--}}
{{--                                        </label>--}}
{{--                                        <input type="text" id="attr_{{$k}}" class="form-control inp_txt"--}}
{{--                                               name="attr_{{$item->id}}"--}}
{{--                                               placeholder="{{$item->title}}" required>--}}
{{--                                    </div>--}}

{{--                                @elseif($item->type == 'number')--}}
{{--                                    <div class="form-group col-md-3 my-4 attr_single" id="attr_single_{{$k}}">--}}
{{--                                        <label style="font-weight: bold" for="attr_{{$k}}"--}}
{{--                                               class="mb-2"> {{$item->title}}--}}
{{--                                        </label>--}}
{{--                                        <input type="number" id="attr_{{$k}}" class="form-control inp_number"--}}
{{--                                               name="attr_{{$item->id}}"--}}
{{--                                               placeholder="{{$item->title}}" required>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="pretty p-rotate p-svg p-curve col-md-3 mt-4 mb-4 attr_single"--}}
{{--                                         id="attr_single_{{$k}}">--}}
{{--                                        <input type="checkbox" id="attr_{{$k}}" data-test="{{$item->type}}" value="0" name="attr_{{$item->id}}"--}}
{{--                                               class="inp_check">--}}
{{--                                        <div class="state p-success">--}}
{{--                                            <!-- svg path -->--}}
{{--                                            <svg class="svg svg-icon" viewBox="0 0 20 20">--}}
{{--                                                <path--}}
{{--                                                    d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"--}}
{{--                                                    style="stroke: white;fill:white;"></path>--}}
{{--                                            </svg>--}}
{{--                                            <label style="font-weight: bold">{{$item->title}}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                @endif--}}

{{--                            @endforeach--}}
                        </div>
                    </div>

                </form>
                {{--    End Featured Cats--}}
                <div class="col-md-11 col-sm-12 add-post-form m-auto mt-3">
                    <div class="row px-4">
                        <div class="row bordered my-4">
                            <p class="bold mb-0 mt-1">قم تحميل صورة واحدة علي الأقل بحد أقصي 10 صور</p>

                            <div class="col-md-12">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" action="#"
                                          class="dropzone dz-clickable" style="cursor: pointer"
                                          id="imageUpload" method="POST" multiple="">
                                        @csrf
                                        <div id="image-upload-div" class="dz-default dz-message">
                                            <h4 class="text-center"> سحب وإفلات .. أو اضغط لإختيار الملفات </h4>
                                        </div>
                                        <div class="d-none" id="images_div">

                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-3 m-auto text-center">
                                    <button class="btn continue_btn" id="confirm_post">انشر الإعلان</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </section>




    {{--    <input type="hidden" name="" value="" id="sub_cat_id_inp">--}}




@endsection




@section('script')
    <script src="{{asset('assets/front/js/md5.js')}}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script>
        {{--$(document).ready(function () {--}}

        {{--    let browseFile = $('#browseFile');--}}
        {{--    let resumable = new Resumable({--}}
        {{--        target: '{{ route('files.upload.large') }}',--}}
        {{--        query: {_token: '{{ csrf_token() }}'}, // CSRF token--}}
        {{--        fileType: ['jpg','png', 'jpeg', 'webp'],--}}
        {{--        headers: {--}}
        {{--            'Accept': 'application/json'--}}
        {{--        },--}}
        {{--        testChunks: false,--}}
        {{--        throttleProgressCallbacks: 1,--}}
        {{--    });--}}

        {{--    resumable.assignBrowse(browseFile[0]);--}}

        {{--    resumable.on('fileAdded', function (file) { // trigger when file picked--}}
        {{--        // deleteCover();--}}
        {{--        $('#browseFile_div').css('display', 'none');--}}

        {{--        showProgress();--}}
        {{--        resumable.upload() // to actually start uploading.--}}
        {{--    });--}}

        {{--    resumable.on('fileProgress', function (file) { // trigger when file progress update--}}
        {{--        updateProgress(Math.floor(file.progress() * 100));--}}
        {{--    });--}}
        {{--    // let file =--}}


        {{--    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete--}}
        {{--        response = JSON.parse(response);--}}
        {{--        console.log(response);--}}
        {{--        $('#cover_image').val(response.filename);--}}
        {{--        $('#delete_cover').removeClass('d-none');--}}

        {{--        // resumable.removeFile(file);--}}

        {{--        // $('#download').attr('href', response.path);--}}
        {{--        // $('.card-footer').show();--}}
        {{--    });--}}

        {{--    // resumable.on('removeFile', function (file) { // trigger when file upload complete--}}
        {{--    //--}}
        {{--    //--}}
        {{--    //     // $('#cover_image').val(response.filename);--}}
        {{--    //     // $('#delete_cover').removeClass('d-none');--}}
        {{--    //--}}
        {{--    //     // $('#download').attr('href', response.path);--}}
        {{--    //     // $('.card-footer').show();--}}
        {{--    // });--}}
        {{--    $('#delete_cover').on('click', function () {--}}
        {{--        resumable.removeFile();--}}
        {{--        $('#browseFile_div').css('display', 'flex');--}}
        {{--    });--}}
        {{--    function deleteCover() {--}}
        {{--        let cover_image_name = $('#cover_image').val();--}}
        {{--        $.ajax({--}}
        {{--            url: "{{route('delete.cover')}}",--}}
        {{--            type: "POST",--}}
        {{--            data: {--}}
        {{--                _token : "{{csrf_token()}}",--}}
        {{--                cover_image_name : cover_image_name--}}
        {{--            },--}}
        {{--            success: function (response) {--}}
        {{--                if (typeof (response) != 'object') {--}}
        {{--                    response = $.parseJSON(response)--}}
        {{--                }--}}
        {{--                console.log(response);--}}

        {{--                if (response.status === 1) {--}}
        {{--                    let data = response.data;--}}
        {{--                }--}}
        {{--            }--}}
        {{--        });--}}


        {{--    };--}}

        {{--    // resumable.on('removeFile', function () {--}}
        {{--    //     abortFile();--}}
        {{--    // });--}}
        {{--    resumable.on('fileError', function (file, response) { // trigger when there is any error--}}
        {{--        alert('file uploading error.')--}}
        {{--    });--}}



        {{--    function abortFile(resumable) {--}}
        {{--        resumable.abort();--}}
        {{--    }--}}

        {{--    let progress = $('.progress');--}}



        {{--    function showProgress() {--}}
        {{--        progress.find('.progress-bar').css('width', '0%');--}}
        {{--        progress.find('.progress-bar').html('0%');--}}
        {{--        progress.find('.progress-bar').removeClass('bg-success');--}}
        {{--        progress.show();--}}
        {{--    }--}}

        {{--    function updateProgress(value) {--}}
        {{--        progress.find('.progress-bar').css('width', `${value}%`)--}}
        {{--        progress.find('.progress-bar').html(`${value}%`)--}}
        {{--    }--}}

        {{--    function hideProgress() {--}}
        {{--        progress.hide();--}}
        {{--    }--}}

        {{--    var md5 = $.md5('value');--}}
        {{--    // alert(md5);--}}



        {{--});--}}

        window.onload = function () {
            Dropzone.autoDiscover = false;

            let myDropzone = $("#imageUpload").dropzone({
                url: "{{route('dropzone.store')}}",
                method: "post",
                maxFiles: 10,
                paramName: 'file',
                thumbnailWidth: 80,
                maxFilesize: 5,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
                addRemoveLinks: true,

                success: function (file, response) {
                    console.log(response.data);

                    $('#images_div').append(
                        "<input type='hidden' class='image-input' name='images[]' data-target='" + response.data['origin'] + "' value='" + response.data['name'] + "'>"
                    );

                },
                removedfile(file) {
                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    }
                    // alert(file.name);
                    let file_input = $('input[data-target="' + file.name + '"]');
                    $.ajax({
                        url: "/delete/file/",
                        data: {
                            _token: "{{csrf_token()}}",
                            name: file_input.val()
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }

                            if (response.status === 1) {
                                console.log(response);
                                file_input.remove();
                            }
                        }
                    });
                    return this._updateMaxFilesReachedClass();

                },


            });
            // myDropzone.on("complete", function(file) {
            //     myDropzone.removeFile(file);
            // });
        };

        $(document).ready(function () {
            {{--$('#title').change(function (e) {--}}

            {{--    $.get('{{route('checkSlug')}}',--}}
            {{--        {'title': $(this).val()},--}}
            {{--        function (data) {--}}
            {{--            $('#slug').val(data.slug);--}}
            {{--        });--}}
            {{--});--}}

            $('.inp_check').on('click', function () {
                // alert('test0');
                let check_val = $(this);
                if (check_val.val() === '0') {

                    check_val.val(1);
                } else {
                    check_val.val(0);
                }
            });


            $('#formFile').change(function () {

            });


            $('#confirm_post').on('click', function () {
                // alert('test');
                // e.preventDefault();
                let cat = $('#cat_id');
                let sub_cat = $('#sub_cat_id');
                let country = $('#country');
                let city_id = $('#city_id');
                let state_id = $('#state_id');
                let pack_id = $('#pack_id');
                let status = $('#status');
                let title = $('#title');
                let slug = $('#slug');
                // let formFile = $('#formFile');
                let price = $('#price');
                // let cover_image = $('#cover_image');
                let description = $('#description');
                let images = $('input.image-input');

                let text = $('input[name="images[]"]').serialize();
                let images_val = text.replace(/images%5B%5D=/g, "");
                let images_arr = images_val.split("&");


                if (cat.length > 0 && cat.val() === "") {
                    // alert('test');
                    Swal.fire({
                        icon: 'error',
                        text: "اختر الفئة الرئيسية أولا",
                        dangerMode: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'حسنا',
                        showCloseButton: true,
                    });
                } else {

                    if (sub_cat.length > 0 && sub_cat.val() === "") {
                        Swal.fire({
                            icon: 'error',
                            text: "اختر الفئة الفرعية أولا",
                            dangerMode: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'حسنا',
                            showCloseButton: true,

                        });
                    } else {

                        if (country.length > 0 && country.val() === "") {
                            Swal.fire({
                                icon: 'error',
                                text: "اختر المكان أولا",
                                dangerMode: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'حسنا',
                                showCloseButton: true,

                            });
                        } else {

                            if (city_id.length > 0 && city_id.val() === "") {
                                Swal.fire({
                                    icon: 'error',
                                    text: "اختر المدينة أولا",
                                    dangerMode: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'حسنا',
                                    showCloseButton: true,

                                });
                            } else {
                                if (state_id.length > 0 && state_id.val() === "") {
                                    Swal.fire({
                                        icon: 'error',
                                        text: "اختر المركز / الحي أولا",
                                        dangerMode: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'حسنا',
                                        showCloseButton: true,

                                    });
                                } else {
                                    // alert('test');
                                    if (status.length > 0 && status.val() === "") {
                                        // alert('test');
                                        Swal.fire({
                                            icon: 'error',
                                            text: "اختر نوع الإعلان أولا",
                                            dangerMode: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'حسنا',
                                            showCloseButton: true,

                                        });
                                    } else if (status.length > 0 && status.val() === "paid") {

                                        if (pack_id.length > 0 && pack_id.val() === "") {
                                            Swal.fire({
                                                icon: 'error',
                                                text: "اختر الباقة أولا",
                                                dangerMode: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'حسنا',
                                                showCloseButton: true,
                                            });
                                        } else {

                                            // Paid Way
                                            if (title.length > 0 && title.val() === "") {
                                                // alert('test')
                                                Swal.fire({
                                                    icon: 'error',
                                                    text: "ادخل عنوان الإعلان",
                                                    dangerMode: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'حسنا',
                                                    showCloseButton: true,

                                                });
                                            } else {

                                                // if (slug.length > 0 && slug.val() === "") {
                                                //     Swal.fire({
                                                //         icon: 'error',
                                                //         text: "حدث خطأ ما .. برجاء المحاولة مرة آخري",
                                                //         dangerMode: true,
                                                //         confirmButtonColor: '#3085d6',
                                                //         cancelButtonColor: '#d33',
                                                //         confirmButtonText: 'حسنا',
                                                //         showCloseButton: true,
                                                //
                                                //     });
                                                // } else {
                                                    // if (formFile.length > 0 && formFile.val() === "") {
                                                    //     Swal.fire({
                                                    //         icon: 'error',
                                                    //         text: "اختر غلاف للإعلان",
                                                    //         dangerMode: true,
                                                    //         confirmButtonColor: '#3085d6',
                                                    //         cancelButtonColor: '#d33',
                                                    //         confirmButtonText: 'حسنا',
                                                    //         showCloseButton: true,
                                                    //
                                                    //     });
                                                    // } else {
                                                    if (price.length > 0 && price.val() === "") {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            text: "ادخل السعر الخاص بالإعلان",
                                                            dangerMode: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'حسنا',
                                                            showCloseButton: true,

                                                        });
                                                    } else {
                                                        if (description.length > 0 && description.val() === "") {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                text: "ادخل وصف الإعلان بصورة مختصرة",
                                                                dangerMode: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'حسنا',
                                                                showCloseButton: true,

                                                            });
                                                        } else {
                                                            let atts_div = $('#atts_div .attr_single');
                                                            let attr_errors = 0;

                                                            // alert(atts_div.length);
                                                            for (let i = 0; i < atts_div.length; i++) {
                                                                let single_attr = $('#attr_single_' + i);
                                                                let single_attr_select = single_attr.find('select');
                                                                let single_attr_text = single_attr.find('.inp_txt');
                                                                let single_attr_number = single_attr.find('.inp_number');

                                                                if (single_attr_select.length > 0 && single_attr_select.val() === "") {
                                                                    attr_errors = attr_errors + 1;
                                                                } else if (single_attr_text.length > 0 && single_attr_text.val() === "") {
                                                                    attr_errors = attr_errors + 1;
                                                                } else if (single_attr_number.length > 0 && single_attr_number.val() === "") {
                                                                    attr_errors = attr_errors + 1;
                                                                }
                                                            }
                                                            if (attr_errors > 0) {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    text: "برجاء إدخال بيانات الخصائص لهذة الفئة",
                                                                    dangerMode: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'حسنا',
                                                                    showCloseButton: true,
                                                                });
                                                            } else {
                                                                let atts_div = $('#atts_div .attr_single');
                                                                let attr_vals = [];
                                                                let attr_vals_text = "";

                                                                // alert(atts_div.length);
                                                                for (let i = 0; i < atts_div.length; i++) {
                                                                    let single_attr = $('#attr_single_' + i);
                                                                    let single_attr_select = single_attr.find('select');
                                                                    let single_attr_text = single_attr.find('.inp_txt');
                                                                    let single_attr_number = single_attr.find('.inp_number');
                                                                    let single_attr_check = single_attr.find('.inp_check');
                                                                    let val_arr = [];

                                                                    if (single_attr_select.length > 0 && single_attr_select.val() !== "") {
                                                                        // val_arr[single_attr_select.attr('name')] = single_attr_select.val();
                                                                        // attr_vals[i] = val_arr;
                                                                        attr_vals_text += single_attr_select.attr('data-test')+'_'+single_attr_select.attr('name')+"_"+single_attr_select.val()+'sperator';

                                                                    } else if (single_attr_text.length > 0 && single_attr_text.val() !== "") {
                                                                        val_arr[single_attr_text.attr('name')] = single_attr_text.val();
                                                                        attr_vals_text += single_attr_text.attr('name')+"_"+single_attr_text.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    } else if (single_attr_check.length > 0) {
                                                                        // alert('test');
                                                                        val_arr[single_attr_check.attr('name')] = single_attr_check.val();
                                                                        attr_vals_text += single_attr_check.attr('data-test')+'_'+single_attr_check.attr('name')+"_"+single_attr_check.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    } else if (single_attr_number.length > 0) {
                                                                        // alert('test');
                                                                        // attr_vals[single_attr_number.attr('name')] = single_attr_number.val();
                                                                        val_arr[single_attr_number.attr('name')] = single_attr_number.val();
                                                                        attr_vals_text += single_attr_number.attr('name')+"_"+single_attr_number.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    }
                                                                }
                                                                // console.log(attr_vals);

                                                                if (images.length < 1) {
                                                                    Swal.fire({
                                                                        icon: 'error',
                                                                        text: "برجاء إدخال صورة واحدة علي الأقل",
                                                                        dangerMode: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'حسنا',
                                                                        showCloseButton: true,
                                                                    });
                                                                } else {
                                                                    $('.lds-circle').addClass('active');
                                                                    $('.overlay').addClass('active');
                                                                    // let cover_image = $('#cover_image')[0].files;
                                                                    // let test = $('#add-post-form');
                                                                    // let data = new FormData(document.getElementById("add-post-form"));
                                                                    // data.append('file', $('#formFile')[0].files[0]);
                                                                    // console.log(data);
                                                                    $.ajax({
                                                                        url: "{{route('add.post.two')}}",
                                                                        data: {
                                                                            _token: "{{csrf_token()}}",
                                                                            cat_id: cat.val(),
                                                                            sub_cat: sub_cat.val(),
                                                                            country: country.val(),
                                                                            city_id: city_id.val(),
                                                                            state_id: state_id.val(),
                                                                            status: status.val(),
                                                                            pack_id: pack_id.val(),
                                                                            title: title.val(),
                                                                            // slug: slug.val(),
                                                                            // cover_image: cover_image.val(),
                                                                            price: price.val(),
                                                                            description: description.val(),
                                                                            attr_vals: attr_vals_text,
                                                                            images: images_arr,
                                                                        },
                                                                        type: "GET",
                                                                        success: function (response) {
                                                                            console.log(response);

                                                                            if (typeof (response) != 'object') {
                                                                                response = $.parseJSON(response)
                                                                            }
                                                                            console.log(response.data);
                                                                            if (response.status === 1) {
                                                                                let slug = response.data['slug'];

                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    text: "تم انشاء الإعلان بنجاح .. الإعلان الآن تحت المراجعة",
                                                                                    dangerMode: false,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    confirmButtonText: 'حسنا',
                                                                                    showCloseButton: true,
                                                                                });
                                                                                window.setTimeout(function () {
                                                                                    window.location.href = "{{route('site.home')}}";
                                                                                }, 500);


                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        }
                                                    }
                                                // }
                                            }

                                        }


                                    } else {
                                        // alert('test')
                                        // Free way

                                        if (title.length > 0 && title.val() === "") {
                                            // alert('test')
                                            Swal.fire({
                                                icon: 'error',
                                                text: "ادخل عنوان الإعلان",
                                                dangerMode: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'حسنا',
                                                showCloseButton: true,

                                            });
                                        } else {

                                            // if (slug.length > 0 && slug.val() === "") {
                                            //     Swal.fire({
                                            //         icon: 'error',
                                            //         text: "حدث خطأ ما .. برجاء المحاولة مرة آخري",
                                            //         dangerMode: true,
                                            //         confirmButtonColor: '#3085d6',
                                            //         cancelButtonColor: '#d33',
                                            //         confirmButtonText: 'حسنا',
                                            //         showCloseButton: true,
                                            //
                                            //     });
                                            // } else {
                                                // if (formFile.length > 0 && formFile.val() === "") {
                                                //     Swal.fire({
                                                //         icon: 'error',
                                                //         text: "اختر غلاف للإعلان",
                                                //         dangerMode: true,
                                                //         confirmButtonColor: '#3085d6',
                                                //         cancelButtonColor: '#d33',
                                                //         confirmButtonText: 'حسنا',
                                                //         showCloseButton: true,
                                                //
                                                //     });
                                                // } else {
                                                    if (price.length > 0 && price.val() === "") {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            text: "ادخل السعر الخاص بالإعلان",
                                                            dangerMode: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'حسنا',
                                                            showCloseButton: true,

                                                        });
                                                    } else {
                                                        if (description.length > 0 && description.val() === "") {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                text: "ادخل وصف الإعلان بصورة مختصرة",
                                                                dangerMode: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'حسنا',
                                                                showCloseButton: true,

                                                            });
                                                        } else {
                                                            let atts_div = $('#atts_div .attr_single');
                                                            let attr_errors = 0;

                                                            // alert(atts_div.length);
                                                            for (let i = 0; i < atts_div.length; i++) {
                                                                let single_attr = $('#attr_single_' + i);
                                                                let single_attr_select = single_attr.find('select');
                                                                let single_attr_text = single_attr.find('.inp_txt');

                                                                if (single_attr_select.length > 0 && single_attr_select.val() === "") {
                                                                    attr_errors = attr_errors + 1;
                                                                } else if (single_attr_text.length > 0 && single_attr_text.val() === "") {
                                                                    attr_errors = attr_errors + 1;
                                                                }
                                                            }
                                                            if (attr_errors > 0) {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    text: "برجاء إدخال بيانات الخصائص لهذة الفئة",
                                                                    dangerMode: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'حسنا',
                                                                    showCloseButton: true,
                                                                });
                                                            } else {
                                                                let atts_div = $('#atts_div .attr_single');
                                                                let attr_vals = [];
                                                                let attr_vals_text = "";

                                                                // alert(atts_div.length);
                                                                for (let i = 0; i < atts_div.length; i++) {
                                                                    let single_attr = $('#attr_single_' + i);
                                                                    let single_attr_select = single_attr.find('select');
                                                                    let single_attr_text = single_attr.find('.inp_txt');
                                                                    let single_attr_number = single_attr.find('.inp_number');
                                                                    let single_attr_check = single_attr.find('.inp_check');
                                                                    let val_arr = [];

                                                                    if (single_attr_select.length > 0 && single_attr_select.val() !== "") {
                                                                        // val_arr[single_attr_select.attr('name')] = single_attr_select.val();
                                                                        // attr_vals[i] = val_arr;
                                                                        attr_vals_text += single_attr_select.attr('data-test')+'_'+single_attr_select.attr('name')+"_"+single_attr_select.val()+'sperator';

                                                                    } else if (single_attr_text.length > 0 && single_attr_text.val() !== "") {
                                                                        val_arr[single_attr_text.attr('name')] = single_attr_text.val();
                                                                        attr_vals_text += single_attr_text.attr('name')+"_"+single_attr_text.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    } else if (single_attr_check.length > 0) {
                                                                        // alert('test');
                                                                        val_arr[single_attr_check.attr('name')] = single_attr_check.val();
                                                                        attr_vals_text += single_attr_check.attr('data-test')+'_'+single_attr_check.attr('name')+"_"+single_attr_check.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    } else if (single_attr_number.length > 0) {
                                                                        // alert('test');
                                                                        // attr_vals[single_attr_number.attr('name')] = single_attr_number.val();
                                                                        val_arr[single_attr_number.attr('name')] = single_attr_number.val();
                                                                        attr_vals_text += single_attr_number.attr('name')+"_"+single_attr_number.val()+'sperator';

                                                                        attr_vals[i] = val_arr;

                                                                    }
                                                                }

                                                                if (images.length < 1) {
                                                                    Swal.fire({
                                                                        icon: 'error',
                                                                        text: "برجاء إدخال ما لا يقل عن 5 صور",
                                                                        dangerMode: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'حسنا',
                                                                        showCloseButton: true,
                                                                    });
                                                                } else {

                                                                    $('.lds-circle').addClass('active');
                                                                    $('.overlay').addClass('active');
                                                                    // let cover_image = $('#cover_image')[0].files;
                                                                    // let test = $('#add-post-form');
                                                                    // let data = new FormData(document.getElementById("add-post-form"));
                                                                    // data.append('file', $('#formFile')[0].files[0]);
                                                                    // console.log(data);
                                                                    $.ajax({
                                                                        url: "{{route('add.post.two')}}",
                                                                        data: {
                                                                            _token: "{{csrf_token()}}",
                                                                            cat_id: cat.val(),
                                                                            sub_cat: sub_cat.val(),
                                                                            country: country.val(),
                                                                            city_id: city_id.val(),
                                                                            state_id: state_id.val(),
                                                                            status: status.val(),
                                                                            pack_id: "null",
                                                                            title: title.val(),
                                                                            // slug: slug.val(),
                                                                            // cover_image: cover_image.val(),
                                                                            price: price.val(),
                                                                            description: description.val(),
                                                                            attr_vals: attr_vals_text,
                                                                            images: images_arr,
                                                                        },
                                                                        type: "GET",
                                                                        success: function (response) {
                                                                            console.log(response);
                                                                            // console.log(attr_vals_text);

                                                                            if (typeof (response) != 'object') {
                                                                                response = $.parseJSON(response)
                                                                            }
                                                                            // console.log(response.data);
                                                                            if (response.status === 1) {
                                                                                let slug = response.data['slug'];
                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    text: "تم انشاء الإعلان بنجاح .. الإعلان الآن تحت المراجعة",
                                                                                    dangerMode: false,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    confirmButtonText: 'حسنا',
                                                                                    showCloseButton: true,
                                                                                });
                                                                                window.setTimeout(function () {
                                                                                    window.location.href = "{{route('site.home')}}";
                                                                                }, 800);

                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        }
                                                    }
                                                // }
                                            // }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            })


        });
    </script>
@stop


