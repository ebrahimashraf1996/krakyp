<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MobilebannerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MobilebannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MobilebannerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Mobilebanner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/mobilebanner');
        CRUD::setEntityNameStrings('صورة', 'صور بانر الموبايل');
        $this->crud->orderBy('lft', 'ASC');

    }


    public function setupReorderOperation() {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'image');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 100);
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
                'name' => 'image', // The db column name
                'label' => 'الصورة', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'image_alt', // name of relationship method in the model
                'label' => 'الإسم - ALT', // Table column heading
            ],
            [
                'name' => 'status',
                'label' => 'الحالة',
                // optionally override the Yes/No texts
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
                'name' => 'image', // The db column name
                'label' => 'الصورة', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'image_alt', // name of relationship method in the model
                'label' => 'الإسم - ALT', // Table column heading
            ],
            [
                'name' => 'url',
                'label' => 'الرابط',
                // optionally override the Yes/No texts
            ],
            [
                'name' => 'status',
                'label' => 'الحالة',
                // optionally override the Yes/No texts
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
        CRUD::setValidation(MobilebannerRequest::class);


        $this->crud->addFields([
            [   // Upload Image
                'name' => 'image',
                'label' => 'الصورة',
                'type' => 'browse',
            ],
            [   // Upload Image
                'name' => 'image_alt',
                'label' => 'الإسم - ALT',
                'type' => 'text',
            ],



            [   // Textarea Description
                'name' => 'url',
                'label' => 'الرابط المرسل إليه (اختياري)',
                'type' => 'text',
            ],

            [   // Enum Status
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum'
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
