<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tag');
        CRUD::setEntityNameStrings('كلمة', 'الكلمات المفتاحية');
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
                'name' => 'title', // The db column name
                'label' => 'الكلمة المفتاحية', // Table column heading
            ],
            // [
            //     'name' => 'slug', // The db column name
            //     'label' => 'الاسم بالرابط', // Table column heading
            // ],
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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            [
                'name' => 'title', // The db column name
                'label' => 'الكلمة المفتاحية', // Table column heading
            ],
            // [
            //     'name' => 'slug', // The db column name
            //     'label' => 'الاسم بالرابط', // Table column heading
            // ],
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
        CRUD::setValidation(TagRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "الكلمة المفتاحية",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'مثال : سيارات, عقارات , 2023',
                ],
            ],
            // [   // Text Title
            //     'name' => 'slug_keyword',
            //     'label' => "الإسم بالرابط",
            //     'type' => 'text',
            //     'attributes' => [
            //         'placeholder' => 'يرجي كتابة الإسم بالرابط باللغة الإنجليزية',
            //     ],
            // ],
            [   // Enum Status
                'name'  => 'status',
                'label' => 'الحالة',
                'type'  => 'enum'
            ],
        ]);





        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
