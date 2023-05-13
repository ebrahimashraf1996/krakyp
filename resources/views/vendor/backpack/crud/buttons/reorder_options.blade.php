
@if($entry->type == 'with_options')
<a href="{{ backpack_url('/option/reorder?id='.$entry->getKey()) }}"  class="btn btn-sm btn-warning" style="">ترتيب الخيارات</a>
@endif
