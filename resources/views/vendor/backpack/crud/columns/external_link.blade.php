@if($entry->reason == 'إبلاغ عن إعلان')
    @php
        $client_ad = \App\Models\Clientad::where('serial_num', $entry->serial_num)->first();
    @endphp
    @if($client_ad)
        <span><a href="{{route('client_ad.show', $client_ad->slug)}}" target="_blank">الإعلان</a></span>
    @else
        <span>اعلان محذوف</span>
    @endif



@elseif($entry->reason == 'إبلاغ عن بائع')
    @php
        $user = \App\Models\User::where('serial_num', $entry->serial_num)->first();
    @endphp
    @if($user)
        <span><a href="{{backpack_url('user/' . $user->id . '/show')}}" target="_blank">البائع</a></span>

    @else
        <span>تم حذف المعلن</span>
    @endif

@else
    <span>---</span>

@endif
{{--{{dd($client_ad)}}--}}




