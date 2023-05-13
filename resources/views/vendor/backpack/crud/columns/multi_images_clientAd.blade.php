{{-- image column type --}}
@php
$arr = explode(',',$entry->images);
@endphp
@foreach($arr as $item)
    <a href="{{asset('images/dropped/' . $item)}}" target="_blank"><img src="{{asset('images/dropped/'.$item )}}" alt="test" width="100" style="border-radius: 5px"> &nbsp;&nbsp;&nbsp;</a> &nbsp;&nbsp;&nbsp;
@endforeach
{{--<span>{{dd($arr)}}</span>--}}





