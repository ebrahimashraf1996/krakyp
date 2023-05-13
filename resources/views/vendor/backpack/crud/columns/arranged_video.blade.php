
@php
$arr = explode(',', $entry->video);
@endphp
@foreach($arr as $item)
    <span>{!! $item !!}</span>

@endforeach






