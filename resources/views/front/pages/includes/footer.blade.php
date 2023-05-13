<footer class="pc_footer"
        style="clear: both; padding: 0!important; background:#062964;">
    <section>
        @php
            $settings = \App\Models\Setting::first();
        @endphp
        <div class="row pt-4">
            <div class="col-md-9 col-10 col-sm-10  m-auto">
                <div class="col-md-1 col-sm-6 col-6 m-auto py-4 text-center">
                    <img src="{{asset($settings->logo)}}" alt="logo"  class="m-auto footer_logo">
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-7 col-10 col-sm-10 t-bordered-white m-auto">
                <ul class="footer_list">
                    <li class="footer_list_item">
                        <a href="{{route('site.home')}}">الصفحة الرئيسية</a>
                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('add.post')}}">انشر إعلانك</a>
                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('about.us')}}">من نحن</a>
                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('contact.us')}}">تواصل معنا</a>
                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('articles.index')}}">المدونة</a>
                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('privacy.policy')}}">سياسة الخصوصية</a>

                    </li>
                    <li class="footer_list_item">
                        <a href="{{route('terms')}}">   بنود الخدمة</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-10 col-sm-10 m-auto">
                <ul class="footer_contacts_list">
                    @if($settings->twitter != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->twitter}}">
                            <img src="{{asset('assets/front/images/twitter.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->linkedin != null)

                        <li class="footer_contacts_list_item">
                        <a href="{{$settings->linkedin}}">
                            <img src="{{asset('assets/front/images/in.png')}}" alt="">
                        </a>
                    </li>
                        @endif

                        @if($settings->whatsapp != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->whatsapp}}">
                            <img src="{{asset('assets/front/images/whats.png')}}" alt="">
                        </a>
                    </li>
                        @endif
                        @if($settings->instagram != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->instagram}}">
                            <img src="{{asset('assets/front/images/insta.png')}}" alt="">
                        </a>
                    </li>
                        @endif
                        @if($settings->email != null)
                    <li class="footer_contacts_list_item">
                        <a href="mailto:{{$settings->email}}">
                            <img src="{{asset('assets/front/images/g-plus.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->snap_chat != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->snap_chat}}">
                            <img src="{{asset('assets/front/images/snap.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->twitter != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->linkedin}}">
                            <img src="{{asset('assets/front/images/fb.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->facebook != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->facebook}}">
                            <img src="{{asset('assets/front/images/behance.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->youtube != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->youtube}}">
                            <img src="{{asset('assets/front/images/youtube.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->phone != null)
                    <li class="footer_contacts_list_item">
                        <a href="tel:{{$settings->phone}}">
                            <img src="{{asset('assets/front/images/phone.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($settings->skype != null)
                    <li class="footer_contacts_list_item">
                        <a href="{{$settings->skype}}">
                            <img src="{{asset('assets/front/images/skype.png')}}" alt="">
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-4"></div>

        </div>
        <div class="last_part text-center">
            <p>{{__('messages.rights')}}</p>
        </div>
    </section>
</footer>

{{--<footer class="mt-5" style="clear: both">--}}
{{--    <section>--}}
{{--        @php--}}
{{--            $settings = \App\Models\Setting::first();--}}
{{--        @endphp--}}
{{--        <div class="row pt-4">--}}
{{--            <div class="col-md-4 col-12 col-sm-12 web_description p-3" style="text-align: center">--}}
{{--                <div><img src="{{asset($settings->image)}}" width="90" alt=""></div>--}}
{{--                <div class="mt-1">--}}
{{--                    <p>--}}
{{--                        {{$settings->short_des}}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-6 col-sm-6 p-3" style="text-align: center">--}}
{{--                <div>--}}
{{--                    <h5>--}}
{{--                        {{__('messages.footer.important')}}--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="line_2" style="margin: auto;">--}}
{{--                </div>--}}
{{--                <div class="mt-2">--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('site.home')}}">{{__('messages.home')}}</a></li>--}}
{{--                        --}}{{--                        <li><a href="{{route('site.privacy')}}">سياسة الخصوصية</a></li>--}}
{{--                        --}}{{--                        <li><a href="{{route('site.evacuation')}}">اخلاء المسئولية</a></li>--}}
{{--                        --}}{{--                        <li><a href="{{route('site.about')}}">{{__('messages.about-us')}}</a></li>--}}
{{--                        --}}{{--                        <li><a href="{{route('site.contact')}}">{{__('messages.contact-us')}}</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-6 col-sm-6 p-3" style="text-align: center">--}}
{{--                <div>--}}
{{--                    <h5>{{__('messages.footer.touch')}}--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="line_2" style="margin: auto;">--}}
{{--                </div>--}}
{{--                <div class="mt-2">--}}
{{--                    <ul>--}}

{{--                        <li><a href="{{$settings->facebook}}"><i class="fa-brands fa-facebook"></i><span> {{__('messages.fb')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="{{$settings->instagram}}"><i class="fa-brands fa-instagram"></i><span> {{__('messages.insta')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="mailto:{{$settings->email}}"><i class="fa-regular fa-envelope"></i><span> {{__('messages.mail')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="tel:{{$settings->phone}}"><i class="fa-solid fa-phone"></i><span> {{__('messages.phone')}} {{$settings->phone}}</span></a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-12 col-sm-12 p-3">--}}


{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="last_part text-center">--}}
{{--            <p>{{__('messages.rights')}}</p>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</footer>--}}
