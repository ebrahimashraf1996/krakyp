{{-- image column type --}}
@php
$user = \App\Models\User::find($entry->user_id)
@endphp
    <a href="{{backpack_url('user/'. $user->id . '/show')}}" target="_blank">{{$user->name}}</a> &nbsp;&nbsp;&nbsp;
{{--<span>{{dd($arr)}}</span>--}}





