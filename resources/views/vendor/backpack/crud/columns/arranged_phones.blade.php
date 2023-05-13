
@php
$phones = explode(',',$entry->phone);
@endphp

@foreach($phones as $item)
    <a href="tel:{{$item}}">{{$item}}</a><br>
@endforeach





