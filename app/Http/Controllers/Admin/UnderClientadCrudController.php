<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\AcceptOperation;
//use App\Http\Controllers\Admin\Operations\RejectOperation;
use App\Http\Controllers\Admin\Operations\RejectOperation;
use App\Http\Requests\ClientadRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClientadCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UnderClientadCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use RejectOperation;
    use AcceptOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Clientad::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/under-review');
        CRUD::setEntityNameStrings('إعلان', 'جميع الإعلانات');
        $this->crud->addClause('where', 'is_published', '0' );
        $this->crud->addClause('where', 'is_canceled', '0');
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
                'label' => 'العنوان', // Table column heading
            ],
            [
                'name' => 'slug', // The db column name
                'label' => 'الإسم بالرابط', // Table column heading
            ],
            [
                'name' => 'description', // The db column name
                'label' => 'الوصف', // Table column heading
                'type' => 'arranged_description_client',

            ],
            [
                'name' => 'price',
                'label' => 'السعر',
                'suffix' => ' جنيه',
            ],
            [
                'name' => 'images',
                'label' => 'الصور',
                'type' => 'multi_images_clientAd',
            ],

            [
                'name' => 'cat',
                'label' => 'الفئة',
                'type' => 'relationship'
            ],
            [
                'name' => 'country',
                'label' => 'المحافظة',
                'type' => 'relationship'
            ],
            [
                'name' => 'city',
                'label' => 'المدينة',
                'type' => 'relationship'
            ],
            [
                'name' => 'state',
                'label' => 'المحافظة',
                'type' => 'relationship'
            ],
            [
                'name' => 'status',
                'label' => 'نوع الإعلان',
            ],
            [
                'name' => 'is_published',
                'label' => 'حالة الإعلان',
                'type' => 'is_published',
            ],
            [
                'name' => 'status',
                'label' => 'نوع الإعلان',
            ],
            [
                'name' => 'start_date',
                'label' => 'تاريخ البدأ',
            ],
            [
                'name' => 'end_date',
                'label' => 'تاريخ الإنتهاء',
            ],
            [
                'name' => 'user',
                'label' => 'صاحب الإعلان',
                'type' => 'custom_user',
            ],
            [
                'name' => 'userPackage',
                'label' => 'نوع الباقة',
                'type' => 'relationship',
            ],
            [
                'name' => 'serial_num',
                'label' => 'الرقم التسلسلي',
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
        CRUD::setValidation(ClientadRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "عنوان الإعلان",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'ادخل عنوان الإعلان ..',
                ],
            ],

//        CRUD::field('images');
//        CRUD::field('country_id');
//        CRUD::field('city_id');
//        CRUD::field('state_id');
//        CRUD::field('is_published');
//        CRUD::field('status');
//        CRUD::field('start_date');
//        CRUD::field('end_date');
//        CRUD::field('user_id');
//        CRUD::field('cat_id');
//        CRUD::field('user_package_id');
//        CRUD::field('serial_num');
//        CRUD::field('is_canceled');

            [   // Textarea Description
                'name' => 'description',
                'label' => 'الوصف ',
                'type' => 'textarea',
                'attributes' => [
                    'placeholder' => 'ادخل الوصف المختصر ... ',
                ],
            ],
            [   // Textarea Description
                'name' => 'price',
                'label' => 'سعر الإعلان ',
                'type' => 'number',
                'attributes' => [
                    'placeholder' => 'ادخل سعر الإعلان ... ',
                ],
            ],
            [   // Browse multiple
                'name'          => 'images',
                'label'         => 'الصور',
                'type'          => 'browse_multiple',
                // 'multiple'   => true, // enable/disable the multiple selection functionality
                // 'sortable'   => false, // enable/disable the reordering with drag&drop
                'mime_types' => ['image'], // visible mime prefixes; ex. ['image'] or ['application/pdf']
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
        $this->setupCreateOperation();
    }
}
