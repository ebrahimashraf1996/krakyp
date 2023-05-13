<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MessageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Message::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/message');
        CRUD::setEntityNameStrings('رسالة', 'الرسائل');
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
                'name' => 'name', // The db column name
                'label' => 'اسم الراسل', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'البريد الإلكتروني', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'رقم الهاتف', // Table column heading
            ],
            [
                'name' => 'reason', // The db column name
                'label' => 'السبب', // Table column heading
            ],
            [
                'type' => 'external_link',
                'name' => 'serial_num', // The db column name
                'label' => 'المبلغ عنه', // Table column heading
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
                'name' => 'name', // The db column name
                'label' => 'اسم الراسل', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'البريد الإلكتروني', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'رقم الهاتف', // Table column heading
            ],
            [
                'name' => 'reason', // The db column name
                'label' => 'السبب', // Table column heading
            ],
            [
                'type' => 'external_link',
                'name' => 'serial_num', // The db column name
                'label' => 'المبلغ عنه', // Table column heading
            ],
            [
                'name' => 'message', // The db column name
                'label' => 'محتوي الرسالة', // Table column heading
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
        CRUD::setValidation(MessageRequest::class);

        CRUD::field('name');
        CRUD::field('message');
        CRUD::field('email');
        CRUD::field('phone');
        CRUD::field('reason');
        CRUD::field('read_at');
        CRUD::field('order_no');

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
