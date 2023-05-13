@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      'الباقات' => false,
      trans('backpack::crud.add') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">الباقات</span>
            <small>{!! $crud->getSubheading() ?? trans('backpack::crud.add').' باقات للفئة (' . $cat->title . '  )' !!}.</small>

            @if ($crud->hasAccess('addpackagestocategories'))
                <small><a href="{{ url($crud->route) }}" class="d-print-none font-sm"><i class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="{{ $crud->getCreateContentClass() }}">
            <!-- Default box -->

            @include('crud::inc.grouped_errors')

            <form method="post"
                  action="{{route('addPackages', $cat->id)}}"
                  @if ($crud->hasUploadFields('create'))
                  enctype="multipart/form-data"
                @endif
            >
            {!! csrf_field() !!}
            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                @if(view()->exists('vendor.backpack.crud.form_content'))
                    @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
                @else
                    @include('crud::form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
                @endif

                <input type="hidden" name="cat_id" value="{{$cat->id}}">
                <div id="saveActions" class="form-group">

                    <button type="submit" class="btn btn-success">
                        <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                        <span>Save</span>
                    </button>

                </div>

                @include('crud::inc.form_save_buttons')
            </form>
        </div>
    </div>

@endsection

