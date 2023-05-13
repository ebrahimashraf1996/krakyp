<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lg la-book"></i>الإعلانات</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('clientad') }}'><i class='nav-icon la la-check '></i>  المقبولة</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('under-review') }}'><i class='nav-icon la la-underline '></i>  تحت المراجعة</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('rejected') }}'><i class='nav-icon la la-underline '></i>  المرفوضة</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon la la-cubes'></i> الفئات</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute') }}'><i class='nav-icon la la-share-alt-square'></i> الخصائص</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('option') }}'><i class='nav-icon la la-hand-pointer-o'></i> الخيارات</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('message') }}'><i class='nav-icon la la-inbox'></i> الرسائل </a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-users'></i> المستخدمين</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('catpackage') }}'><i class='nav-icon la la-cubes'></i> الباقات</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lg la-book"></i>الأخبار</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link " href="{{ backpack_url('blogcategory') }}"><i class="nav-icon la la-lg la-cubes"></i> الفئات</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('post') }}"><i class="nav-icon la la-lg la-book"></i> المقالات</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-tag'></i> الكلمات المفتاحية</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('banner') }}'><i class='nav-icon la la-calendar-check-o'></i> صور البانر</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> الإعدادات</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('reason') }}'><i class='nav-icon la la-eye-slash'></i> أسباب الرفض</a></li>
























