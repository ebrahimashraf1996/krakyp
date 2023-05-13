


    <div class="btn-group">
        <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-edit"></i> رفض</a>
        <a class="btn btn-sm btn-warning dropdown-toggle text-light pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    padding-left: 5px!important;
    padding-right: 3px!important;">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">السبب</li>
            @php
                $reasons = \App\Models\Reason::get();
            @endphp
            @foreach ($reasons as $key => $item)
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/reject/'. $item->id) }}" id="accept_{{$entry->getKey()}}" class="dropdown-item">
                   {{$item->reason_val}}
                </a>
            @endforeach
        </ul>
    </div>

