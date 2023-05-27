@extends('front.layouts.master')

@section('styles')
    <style>


    </style>
@stop

@section('content')
    <div class="row mb-3 px-0 mx-0 serial_routes_row" style="background:#f0f1f7;" >
        <div class="container" dir="rtl" style="max-width: 1044px;">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 pl-3 py-2 serial_route">
                    <a href="{{route('site.home')}}" class="bold">الصفحة الرئيسية</a>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <a href="{{route('articles.index')}}" class="bold">المقالات</a>

                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span class="bold">{{$post->category ? $post->category->title : ''}}</span>
                    <div class="d-inline-block position-relative" style="width: 25px">
                        <i style="position: absolute;top: -15px;right: 3px;"
                           class="fa-solid fa-chevron-left mt-1  px-1 ">
                        </i>
                    </div>
                    <span>{{$post->title}}</span>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-3 col-12 py-2 text-left back">
                    <a href="{{ url()->previous() }}"
                       class="bold">العودة</a>
                    <div class="d-inline-block position-relative" style="width: 25px"><i
                            style="position: absolute;top: -15px;right: 3px;"
                            class="fa-solid fa-chevron-left mt-1  px-1 "></i></div>

                </div>
            </div>

        </div>
    </div>
    <section class="text-center">
        <div class="container " style="max-width: 1050px">

            <div class="mt-5" style="text-align: right">
                @if(isset($post))
                    <div class="post" >
                        {!! $post->article !!}
                    </div>

                @endif

            </div>
        </div>
    </section>





    {{--Start Posts Section--}}

    {{--End Posts Section--}}









@endsection




@section('script')
    <script>


    </script>
@stop


































{{--<section class="service lazy-bg-loaded">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="title">--}}
{{--            <h1>خدمات تقنية</h1>--}}
{{--            <p>تسعى تقنية دائماً لتوفير الخدمات المميزة والباقات المرنة لتلائم أغلب الخدمات المستخدمة لتقنية المعلومات وبأسعار تنافسية للغاية ، من مواقع أو متاجر أو تطبيقات أو أنظمة برمجية , الآن ابدأ بتنمية أعمالك وانطلق بتواجدك الحقيقي والفعال عبر الانترنت</p>--}}
{{--        </div>--}}
{{--        <ul class="nav nav-tabs">--}}
{{--            <li class=""><a data-toggle="tab" href="#tab6" aria-expanded="false">استضافة المواقع</a>--}}
{{--            </li>--}}
{{--            <li class=""><a data-toggle="tab" href="#tab5" aria-expanded="false">السيرفرات الخاصة</a>--}}
{{--            </li>--}}
{{--            <li class=""><a data-toggle="tab" href="#tab7" aria-expanded="false">سيرفرات VPS</a>--}}
{{--            </li>--}}
{{--            <li class="active"><a data-toggle="tab" href="#tab1" aria-expanded="true">تصميم المواقع</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab8">التجارة الالكترونية</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab2">تطبيقات الجوال</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab3">التسويق الالكترونى</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab4">الهوية البصرية</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane fade active in" id="tab1" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}" alt="">--}}
{{--                        <h1>خدمات تصميم مواقع احترافية</h1>--}}
{{--                        <p>فن الإتصالات البصرية هو المعنى الحقيقي لتحقيق أفكارك وبلورتها إلى حقيقة رائعة وهو مايقوم به مصممينا في تقنية بناء على طلب العميل ويتعاونون على تنفيذ معطياته بمنتهى الدقة من أجل رسم أفكاركم في صورة موقع يتميز بالروعة والجمال</p> <a class="btn" href="web-design/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab8" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات المتاجر والتجارة الالكترونية</h1>--}}
{{--                        <p>هي الثورة الإقتصادية في الألفية الجديدة والتي تضمن الوصول لأكبر شريحة من المستهدفين لمنتجاتك في مدن ومناطق مختلفة قد تصل إلى أنحاء العالم , والتي تستطيع من خلالها تحقيق الأرباح الكبيرة من خلال مبيعات الإنترنت والتي أصبحت أكبر سوق للأرباح العالمية</p> <a class="btn" href="e-commerce-eg/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab2" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات تصميم وبرمجة تطبيقات الجوال</h1>--}}
{{--                        <p>طبقا للأحصائية الأخيرة لعدد مستخدمي الانترنت عن طريق الهواتف الذكية والتي وصلت لأكثر من 4 مليار شخص حول العالم , فان هذا الرقم يؤكد على الأهمية الكبيرة لوجود تطبيق مخصص للجوال لموقعك أو شركتك أو متجرك أو مشروعك الإلكتروني من خلال منصتي ( الاندرويد و ابل ios )</p> <a class="btn" href="apps/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab3" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات الاعلانات والتسويق الالكتروني</h1>--}}
{{--                        <p>في ظل التطور التكنولوجي الرهيب أصبح من السهل زيادة الدخل والأرباح وفتح أسواق عمل جديدة وتسويق المشاريع والخدمات والمنتجات بأقل التكاليف وذلك من خلال الدعاية و التسويق الالكتروني تقدم تقنية هذه العملية باحترافية عالية لنضمن لك النتائج المفيدة بإذن الله</p> <a class="btn" href="digital-marketing/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab4" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمة تصميم الهوية البصرية الإحترافية</h1>--}}
{{--                        <p>يعد تصميم الهوية البصرية من أهم العناصر التي تعكس رؤية المؤسسات والشركات وسبب رئيسي في شق طريقها في سوق العمل بالشكل الإحترافي , فالهوية البصرية المميزة من أهم عوامل نجاح ترويج الشركات أو المؤسسات ومنتجاتها وخدماتها وتلعب الهوية البصرية دوراً هاماً جداً في التسويق للمنشأة وإظهارها بالشكل الأمثل الذي يعود عليها بالنتائج الإيجابية</p> <a class="btn" href="web-design/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab5" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات السيرفرات الخاصة المدارة</h1>--}}
{{--                        <p>عندما يكون هدفك الأول هو الإرتقاء بموقعك وجعله ضمن مصاف المواقع الكبرى إقليمياً وعالمياً فإن البحث عن سيرفر بمواصفات جيدة هي مهمة أساسية , وفي تقنية نوفر لك الخدمة الأفضل والقيمة المميزة والإدارة المتكاملة على مدار الساعة .</p> <a class="btn" href="servers-managed/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab6" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات استضافة المواقع المميزة</h1>--}}
{{--                        <p>أولى سطور قصص النجاح الالكتروني وخطوتك الأولى لبدأ مشروعك الخاص و التسويق له الكترونيا بأقل تكلفة وبدون أي خبرة سابقة ولا معرفة بمراقبة وإدارة الخوادم , ونحن في تقنية نوفر عدة خطط تتناسب مع جميع فئات المواقع الصغيرة والمبتدأه</p> <a class="btn" href="sharedhosting/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab7" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات سيرفرات VPS المدارة</h1>--}}
{{--                        <p>اذا كنت تبحث عن الاستقلالية لموقعك وسرعة الإرتقاء بخدماته وضمان أفضل سرعة للتصفح وللارشفة وبأفضل سعر , فان اختيارك لسيرفرات VPS من تقنية هو الحل الأمثل مع خدمات الإعداد والإدارة المتكاملة على مدار الساعة</p> <a class="btn" href="vps-managed/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
