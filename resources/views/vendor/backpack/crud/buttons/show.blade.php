@if ($crud->hasAccess('show'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}" class="btn btn-sm btn-info"><i class="la la-eye"></i> {{ trans('backpack::crud.preview') }}</a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}" class="btn btn-sm btn-info"><i class="la la-eye"></i> {{ trans('backpack::crud.preview') }}</a>
	  <a class="btn btn-sm btn-warning dropdown-toggle text-light pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    padding-left: 5px!important;
    padding-right: 3px!important;">
	    <span class="caret"></span>
	  </a>
	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?locale={{ $key }}">{{ $locale }}</a>
	  	@endforeach
	  </ul>
	</div>

	@endif
@endif
