<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\RejectOperation;
use App\Http\Requests\ClientadRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClientadCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientadCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use RejectOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Clientad::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/clientad');
        CRUD::setEntityNameStrings('إعلان', 'جميع الإعلانات');
        $this->crud->addClause('where', 'is_published', '1' );
        $this->crud->addClause('where', 'is_canceled', '0' );

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
                'label' => 'العنوان', // Table column heading
            ],
            [
                'name' => 'price',
                'label' => 'السعر',
                'suffix' => ' جنيه',
            ],

            [
                'name' => 'cat',
                'label' => 'الفئة',
                'type' => 'relationship'
            ],
//            [
//                'name' => 'country',
//                'label' => 'المحافظة',
//                'type' => 'relationship'
//            ],
            [
                'name' => 'status',
                'label' => 'نوع الإعلان',
            ],

            [
                'name' => 'serial_num',
                'label' => 'الرقم التسلسلي',
            ],

//            CRUD::column('title');
//            CRUD::column('slug');
//            CRUD::column('description');
//            CRUD::column('price');
//            CRUD::column('cover');
//            CRUD::column('images');
//            CRUD::column('country_id');
//            CRUD::column('city_id');
//            CRUD::column('state_id');
//            CRUD::column('is_published');
//            CRUD::column('status');
//            CRUD::column('start_date');
//            CRUD::column('end_date');
//            CRUD::column('user_id');
//            CRUD::column('cat_id');
//            CRUD::column('user_package_id');
//            CRUD::column('serial_num');
//            CRUD::column('is_canceled');

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
        CRUD::setValidation(ClientadRequest::class);

        CRUD::field('title');
        CRUD::field('slug');
        CRUD::field('description');
        CRUD::field('price');
        // CRUD::field('cover');
        CRUD::field('images');
        CRUD::field('country_id');
        CRUD::field('city_id');
        CRUD::field('state_id');
        CRUD::field('is_published');
        CRUD::field('status');
        CRUD::field('start_date');
        CRUD::field('end_date');
        CRUD::field('user_id');
        CRUD::field('cat_id');
        CRUD::field('user_package_id');
        CRUD::field('serial_num');
        CRUD::field('is_canceled');

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
