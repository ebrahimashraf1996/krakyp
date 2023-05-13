@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/optionsadd') }}" id="addOption_{{$entry->getKey()}}" class="btn btn-sm btn-success">+ اضافة خيارات</a>
@endif
