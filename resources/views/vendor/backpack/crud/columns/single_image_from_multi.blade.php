{{-- image column type --}}
@php
$arr = explode(',',$entry->image);
@endphp
    <a href="{{asset($arr[0])}}" target="_blank"><img src="{{asset($arr[0])}}" alt="test" width="100" style="border-radius: 5px"></a> &nbsp;&nbsp;&nbsp;
{{--<span>{{dd($arr)}}</span>--}}





