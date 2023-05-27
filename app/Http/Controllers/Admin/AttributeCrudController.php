<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\OptionsAddOperation;
use App\Http\Controllers\Admin\Operations\ReorderOptionsOperation;
use App\Http\Requests\AttributeRequest;
use App\Models\Option;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;

/**
 * Class AttributeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttributeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use OptionsAddOperation;
    use ReorderOptionsOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Attribute::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/attribute');
        CRUD::setEntityNameStrings('خاصية', 'الخصائص');
        $this->crud->orderBy('lft', 'ASC');

    }

    public function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'title');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
//        $this->crud->addClause('where', 'course_id', '=', 1);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn([
            'name' => 'row_number',
            'type' => 'row_number',
            'label' => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        $this->crud->addColumns([
            [
                'name' => 'id', // The db column name
                'label' => 'id', // Table column heading
            ],[
                'name' => 'title', // The db column name
                'label' => 'اسم الخاصية', // Table column heading
            ],
            [
                'name' => 'type',
                'label' => 'النوع',
            ],

            [
                'name' => 'type_of',
                'label' => 'الدرجة',
            ],
            [
                'name' => 'appearance',
                'label' => 'شكل الخاصية ',
            ],

            [   // Text Title
                'name' => 'attr_icon',
                'label' => "صورة الخاصية",
                'type' => 'image',
            ],
//            [
//                'name' => 'status',
//                'label' => 'الحالة',
//            ],
        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns([
            [
                'name' => 'title', // The db column name
                'label' => 'اسم الخاصية', // Table column heading
            ],
//            [
//                'name' => 'sub_title', // The db column name
//                'label' => 'عنوان آخر', // Table column heading
//            ],

            [   // Text Title
                'name' => 'attr_icon',
                'label' => "صورة الخاصية",
                'type' => 'image',
            ],
            [
                'name' => 'type',
                'label' => 'النوع',
            ],

            [
                'name' => 'type_of',
                'label' => 'الدرجة',
            ],

            [
                'name' => 'appearance',
                'label' => 'شكل الخاصية في الفلتر',
            ],
            [
                'name' => 'options',
                'label' => 'الخيارات',
                'type' => 'relationship'
            ],
            [
                'name' => 'status',
                'label' => 'الحالة',
            ],

        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }


    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AttributeRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "اسم الخاصية",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'مثال : مساحة العقار - نوع السيارة ...',
                ],
            ],
            [   // Text Title
                'name' => 'attr_icon',
                'label' => "صورة الخاصية",
                'type' => 'browse',
            ],
//            [   // Text Title
//                'name' => 'sub_title',
//                'label' => "عنوان آخر",
//                'type' => 'text',
//                'attributes' => [
//                    'placeholder' => 'مثال : أشهر الماركات ...',
//                ],
//            ],
            [   // Enum Status
                'name' => 'type',
                'label' => 'النوع',
                'type' => 'enum',
                'attributes' => [
                    'id' => 'type_of'
                ]
            ],

            [   // Enum Status
                'name' => 'type_of',
                'label' => 'الدرجة',
                'type' => 'enum',

            ],
            [   // Enum Status
                'name' => 'appearance',
                'label' => 'شكل الخاصية في الفلتر',
                'type' => 'enum',
                'attributes' => [
                    'id' => 'appearance'
                ]
            ],

            [   // Enum Status
                'name' => 'custom_options_js',
                'label' => 'النوع',
                'type' => 'custom_options_js'
            ],

            [   // Enum Status
                'name' => 'unit',
                'label' => 'وحدة القياس',
                'type' => 'text',
                'attributes' => [
                    'id' => 'unit'
                ]
            ],


            [   // Table
                'name' => 'options[]',
                'label' => 'الخيارات',
                'type' => 'custom_table',
                'entity_singular' => 'خيارات', // used on the "Add X" button
                'columns' => [
                    'title' => 'المحتوي',
                    'image' => 'الصورة',
                ],
                'attributes' => [
                    'id' => 'options_update'
                ],

                'max' => 100, // maximum rows allowed in the table
                'min' => 0, // minimum rows allowed in the table
            ],
            [   // Enum Status
                'name' => 'status',
                'label' => 'الحالة',
                'type' => 'enum'
            ],
//            [   // Enum Status
//                'name' => 'featured',
//                'label' => 'الظهور في الصفحة الرئيسية',
//                'type' => 'enum'
//            ],


        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required

        $request = $this->crud->validateRequest();
//        $options =  json_decode($request->options[0]);
        $titles = array_filter($request->titles);
        $images = $request->images;

        // insert item in the db
        $item = $this->crud->create($this->crud->getStrippedSaveRequest());

        foreach ($titles as $key => $val) {
            $file_name = uploadImage('options', $images[$key]);
            Option::create([
                'val' => $val,
                'attr_id' => $item->id,
                'image' => $file_name
            ]);
        }

        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();
        return $this->crud->performSaveAction($item->getKey());
    }


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(AttributeRequest::class);

        $this->crud->addFields([



            [   // Text Title
                'name' => 'title',
                'label' => "اسم الخاصية",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'مثال : مساحة العقار - نوع السيارة ...',
                ],
            ],

            [   // Text Title
                'name' => 'attr_icon',
                'label' => "صورة الخاصية",
                'type' => 'browse',
            ],

            [   // Enum Status
                'name' => 'type',
                'label' => 'النوع',
                'type' => 'enum',
                'attributes' => [
                    'id' => 'type_of'
                ]
            ],

            [   // Enum Status
                'name' => 'type_of',
                'label' => 'الدرجة',
                'type' => 'enum',

            ],
            [   // Enum Status
                'name' => 'appearance',
                'label' => 'شكل الخاصية في الفلتر',
                'type' => 'enum',
                'attributes' => [
                    'id' => 'appearance'
                ]
            ],

            [   // Enum Status
                'name' => 'custom_options_js',
                'label' => 'النوع',
                'type' => 'custom_options_js'
            ],



            [
                'type' => 'relationship',
                'name' => 'options',
                'label' => 'الخيارات'
            ],


            [   // Enum Status
                'name' => 'status',
                'label' => 'الحالة',
                'type' => 'enum'
            ],




        ]);
    }
    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $this->crud->getStrippedSaveRequest());
//        return $item->id;
        DB::table('attr_cat')->where('attr_id', $item->id)->update([
            'type_of' => $request->type,
            'main_other' => $request->type_of,
        ]);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
}
