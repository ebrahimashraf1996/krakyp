{{-- image column type --}}
@php
$arr = explode(',',$entry->image);
@endphp
@foreach($arr as $item)
    <a href="{{asset($item)}}" target="_blank"><img src="{{asset($item)}}" alt="test" width="100" style="border-radius: 5px"></a> &nbsp;&nbsp;&nbsp;
@endforeach
{{--<span>{{dd($arr)}}</span>--}}





