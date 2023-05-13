<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('مستخدم', 'المستخدمين');
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
                'label' => 'الإسم', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'البريد الإلكتروني', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'الهاتف', // Table column heading
            ],

            [
                'name' => 'created_at', // The db column name
                'label' => 'تاريخ التسجيل', // Table column heading
                'type' => 'date',
                // 'format' => 'l j F Y', // use something else than the base.default_date_format config value
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'الصورة', // Table column heading
                'type' => 'image',
                'height' => '60px',
                'width'  => '60px',
            ],
            [
                'name' => 'status', // The db column name
                'label' => 'الحالة', // Table column heading
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
                'label' => 'الإسم', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'البريد الإلكتروني', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'الهاتف', // Table column heading
            ],

            [
                'name' => 'created_at', // The db column name
                'label' => 'تاريخ التسجيل', // Table column heading
                'type' => 'date',
                // 'format' => 'l j F Y', // use something else than the base.default_date_format config value
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'الصورة', // Table column heading
                'type' => 'image',

            ],

            [
                'name' => 'description', // The db column name
                'label' => 'الوصف', // Table column heading
            ],
            [
                'name' => 'role', // The db column name
                'label' => 'الرتبة', // Table column heading
            ],
            [
                'name' => 'phone_verified', // The db column name
                'label' => 'تاريخ تأكيد الهاتف', // Table column heading
                'type' => 'date',
            ],
            [
                'name' => 'status', // The db column name
                'label' => 'الحالة', // Table column heading
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
        CRUD::setValidation(UserCreateRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'name',
                'label' => "الإسم",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'ادخل الإسم ..',
                ],
            ],
            [   // Email
                'name' => 'email',
                'label' => 'البريد الإلكتروني',
                'type' => 'email',
                'attributes' => [
                    'placeholder' => 'مثال : example@example.com',
                ],
            ],
            [   // Password
                'name' => 'password',
                'label' => 'كلمة السر',
                'type' => 'password',
                'attributes' => [
                    'placeholder' => ''
                ],
            ],
            [   // Number
                'name' => 'phone',
                'label' => 'رقم الهاتف',
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'مثال : 01xxxxxxxxx'
                ],
            ],
            [   // Browse
                'name'  => 'image',
                'label' => 'الصورة',
                'type'  => 'browse'
            ],
            [   // select_from_array
                'name'        => 'role',
                'label'       => "Role",
                'type'        => 'select_from_array',
                'options'     => ['admin' => 'admin', 'user' => 'user'],
                'allows_null' => false,
                'default'     => 'user',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],

            [   // Enum Status
                'name' => 'phone_verified',
                'label' => 'تاريخ تأكيد رقم الهاتف',
                'type' => 'date'
            ],
            [   // Enum Status
                'name' => 'status',
                'label' => 'الحالة',
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
        CRUD::setValidation(UserUpdateRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'name',
                'label' => "الإسم",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'ادخل الإسم ..',
                ],
            ],
            [   // Email
                'name' => 'email',
                'label' => 'البريد الإلكتروني',
                'type' => 'email',
                'attributes' => [
                    'placeholder' => 'مثال : example@example.com',
                ],
            ],

            [   // Number
                'name' => 'phone',
                'label' => 'رقم الهاتف',
                'type' => 'text',
            ],
            [   // Browse
                'name'  => 'image',
                'label' => 'الصورة',
                'type'  => 'browse'
            ],
            [   // select_from_array
                'name'        => 'role',
                'label'       => "Role",
                'type'        => 'select_from_array',
                'options'     => ['admin' => 'admin', 'user' => 'user'],
                'allows_null' => false,
                'default'     => 'user',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],

            [   // Enum Status
                'name' => 'phone_verified',
                'label' => 'تاريخ تأكيد رقم الهاتف',
                'type' => 'date'
            ],
            [   // Enum Status
                'name' => 'status',
                'label' => 'الحالة',
                'type' => 'enum'
            ],

        ]);
    }
}
