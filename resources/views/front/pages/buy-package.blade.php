@extends('front.layouts.master')

@section('styles')
    <style>
        /*.featured-section{padding-top: 91px}*/

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

                    <span class="bold">إظهار الباقات المتاحة</span>


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
        <div class="container">
            <div class="row my-4">
                <div class="col-md-12 col-sm-12">
                    <h3 class="bold">إظهار الباقات المتاحة</h3>
                </div>
            </div>
            <div class="row add-post-form-row">
                <form class="col-md-11 col-sm-11 col-11 add-post-form show_packages_from m-auto mb-5" method="POST" action="{{route('packages.show')}}" style="min-height: 231px;">
                    @csrf
                    <div class="row p-4" id="cats_row">
                        <div class="form-group col-md-5 ">
                            <label for="cat_id" class="mb-2">الفئة الرئيسية</label>
                            <select class="form-control" id="cat_id" name="cat_id">
                                <option value="">اختر الفئة الرئيسية</option>
                                @foreach($cats as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="row my-3">
                        <div class="col-md-4 m-auto text-center">
                            <button class="btn continue_btn">إظهار الباقات</button>
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

            // $('#country').select2();
            $('#cat_id').select2();


            const lang = $('#lang').val();


            let cat = $('select#cat_id');
            let cats_row = $('#cats_row');
            cat.change(function () {
                let cat_id = cat.val();
                // alert(cat_id);

                if (cat_id !== "") {
                    $('#sub_cat_id_div').remove();

                    $.ajax({
                        url: "/get-child-cat/" + cat_id,
                        data: {
                            _token: "{{csrf_token()}}",
                            id: cat_id,
                        },
                        type: "POST",
                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            console.log(response.data);
                            let html_option = "";
                            let html_select = "<li data-value='' data-display=\"اختر الفئة الفرعية\" class=\"option \">اختر الفئة الفرعية</li>";

                            if (response.status === 1) {
                                let data = response.data;
                                data.forEach(myFunction);

                                function myFunction(item, index) {
                                    html_option += "<option value='" + data[index]['id'] + "'>" + data[index]['title'][lang] + "</option>";
                                    html_select += " <li data-value='" + data[index]['id'] + "' class=\"option\">" + data[index]['title'][lang] + "</li>";
                                }

                                // console.log(data[0]);
                                console.log(html_option);

                                cats_row.append(
                                    "<div class=\"form-group col-md-5 \" id='sub_cat_id_div'>\n" +
                                    " <label for=\"sub_cat_id\" class=\"mb-2\">الفئة الفرعية</label>\n" +
                                    "    <select class=\"form-control select2-hidden-accessible\" id=\"sub_cat_id\" name=\"sub_cat_id\" data-select2-id=\"select2-data-sub_cat_id\" tabindex=\"-1\" aria-hidden=\"true\" style=\"display: none;\">\n" +
                                    " <option value=''>اختر الفئة الفرعية</option>" +
                                    html_option +
                                    " </select>" +
                                    " </div>"
                                );
                                $('#sub_cat_id').select2();
                                $('#sub_cat_id_div').find('span.select2').css('width', '100%');

                            }
                        }
                    });
                } else {
                    $('#sub_cat_id_div').remove();
                }
            });


            let show_form = $('.add-post-form');
            show_form.submit(function (e) {
                e.preventDefault();
                let cat = $('select#cat_id');
                let sub_cat_id = $('#sub_cat_id');
                // alert(sub_cat_id.val());
                if(cat.val() < 1) {
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
                    if(sub_cat_id.val() < 1) {
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
                        $(this).unbind('submit').submit();
                    }
                }

            });


        });
    </script>
@stop

