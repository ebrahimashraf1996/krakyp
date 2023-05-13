{{-- image column type --}}
@php
    $publishing_status = $entry->is_published;
@endphp
    <span>{{$publishing_status == 0 ? 'جاري المراجعة' : 'تم قبول الإعلان'}}</span>
{{--<span>{{dd($arr)}}</span>--}}





