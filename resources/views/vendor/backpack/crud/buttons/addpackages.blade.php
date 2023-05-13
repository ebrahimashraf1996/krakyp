@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/addpackagestocategories') }}" class="btn btn-sm btn-success">+ إضافة باقات</a>
@endif
