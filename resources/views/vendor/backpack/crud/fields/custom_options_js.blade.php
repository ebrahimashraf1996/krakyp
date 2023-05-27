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
                // alert('test')
                let type_of = $('#type_of');
                let current_val = type_of.val();
                let options = $('input[name^="options"]');
                let appearance = $('#appearance');
                let option_select = $('#appearance option[value="select"]');
                let option_buttons = $('#appearance option[value="buttons"]');
                let option_checkbox = $('#appearance option[value="check_box"]');
                let option_from_to = $('#appearance option[value="from_to"]');
                let unit = $('#unit');

                if (current_val === 'with_options') {
                    options.parent().removeClass('d-none');
                    unit.parent().addClass('d-none');
                    // appearance.val('buttons').change();

                    option_select.css('display', 'block');
                    option_buttons.css('display', 'block');

                    option_checkbox.css('display', 'none');
                    option_from_to.css('display', 'none');
                } else if(current_val === 'yes_no') {
                    // appearance.val('select').change();
                    unit.parent().addClass('d-none');
                    options.parent().addClass('d-none');

                    option_checkbox.css('display', 'block');
                    option_buttons.css('display', 'block');
                    option_select.css('display', 'block');

                    option_from_to.css('display', 'none');
                } else if(current_val === 'with_no_answers') {
                    options.parent().addClass('d-none');
                    unit.parent().removeClass('d-none');

                    // appearance.val('buttons').change();

                    option_checkbox.css('display', 'block');
                    option_from_to.css('display', 'block');

                    option_select.css('display', 'none');
                    option_buttons.css('display', 'none');
                } else {
                    options.parent().addClass('d-none');
                    appearance.val('').change();
                    appearance.parent().addClass('d-none');


                    option_checkbox.css('display', 'none');
                    option_from_to.css('display', 'none');

                    option_select.css('display', 'none');
                    option_buttons.css('display', 'none');
                }



                type_of.on('change', function (e) {
                    let type_of_val = $(this).val();
                    if(type_of_val === 'with_options') {
                        options.parent().removeClass('d-none');
                        unit.parent().addClass('d-none');

                        appearance.val('select').change();

                        option_select.css('display', 'block');
                        option_buttons.css('display', 'block');

                        option_checkbox.css('display', 'none');
                        option_from_to.css('display', 'none');

                    } else if (type_of_val === 'yes_no') {
                        appearance.parent().removeClass('d-none');
                        appearance.val('select').change();
                        options.parent().addClass('d-none');
                        unit.parent().addClass('d-none');

                        option_checkbox.css('display', 'block');
                        option_buttons.css('display', 'block');
                        option_select.css('display', 'block');

                        option_from_to.css('display', 'none');
                    }  else if(type_of_val === 'with_no_answers') {
                        options.parent().addClass('d-none');
                        unit.parent().removeClass('d-none');

                        appearance.val('from_to').change();
                        appearance.parent().addClass('d-none');


                        option_checkbox.css('display', 'none');
                        option_from_to.css('display', 'none');

                        option_select.css('display', 'none');
                        option_buttons.css('display', 'none');
                    } else {
                        options.parent().addClass('d-none');
                        unit.parent().addClass('d-none');

                        appearance.val('').change();
                        appearance.parent().addClass('d-none');


                        option_checkbox.css('display', 'none');
                        option_from_to.css('display', 'none');

                        option_select.css('display', 'none');
                        option_buttons.css('display', 'none');
                    }

                    //
                    //
                    // if(type_of_val === 'with_no_answers') {
                    //     appearance.val('from_to').change();
                    //     appearance.parent().addClass('d-none');
                    // } else {
                    //     appearance.parent().removeClass('d-none');
                    // }
                });
            });

        </script>
    @endpush
@endif
