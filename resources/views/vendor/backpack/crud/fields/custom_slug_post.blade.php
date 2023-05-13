<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')



{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script>
            $(window).ready(function () {

                $('#post_title').change(function (e) {
                    $.get('{{route('checkSlugPost')}}',
                        {'title': $(this).val()},
                        function (data) {
                            $('#slug').val(data.slug);
                        });
                });
            });

        </script>
    @endpush
@endif
