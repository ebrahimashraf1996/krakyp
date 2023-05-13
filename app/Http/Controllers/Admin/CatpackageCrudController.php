<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CatpackageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CatpackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CatpackageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Catpackage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/catpackage');
        CRUD::setEntityNameStrings('باقة', 'الباقات');
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
                'label' => 'عنوان الباقة', // Table column heading
            ],
            [
                'name' => 'description',
                'label' => 'الوصف المختصر',
            ],

            [
                'name' => 'category',
                'label' => 'الفئة',
                'type' => 'relationship'
            ],
            [
                'name' => 'duration',
                'label' => 'مدة الباقة',
                'suffix' => ' يوم',
            ],
            [
                'name' => 'ads_count',
                'label' => 'عدد الإعلانات',
            ],
            [
                'name' => 'price',
                'label' => 'السعر',
                'suffix' => ' جنيه',

            ],
            [
                'name' => 'discount',
                'label' => 'الخصم إن وجد',
                'suffix' => ' %',
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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            [
                'name' => 'title', // The db column name
                'label' => 'عنوان الباقة', // Table column heading
            ],
            [
                'name' => 'slug', // The db column name
                'label' => 'الإسم بالرابط', // Table column heading
            ],
            [
                'name' => 'description',
                'label' => 'الوصف المختصر',
            ],

            [
                'name' => 'category',
                'label' => 'الباقات',
                'type' => 'relationship'
            ],
            [
                'name' => 'duration',
                'label' => 'مدة الباقة',
            ],
            [
                'name' => 'ads_count',
                'label' => 'عدد الإعلانات',
            ],
            [
                'name' => 'price',
                'label' => 'السعر',
            ],
            [
                'name' => 'discount',
                'label' => 'الخصم إن وجد',
            ],
            [
                'name' => 'status',
                'label' => 'الحالة',
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CatpackageRequest::class);
        $this->crud->addFields([

            [   // Upload Image
                'name' => 'title',
                'label' => 'عنوان الباقة',
                'type' => 'text',
            ],
            [   // Upload Image
                'name' => 'slug_keyword',
                'label' => 'الإسم بالرابط',
                'type' => 'text',
            ],
            [   // Upload Image
                'name' => 'description',
                'label' => 'الوصف البسيط',
                'type' => 'textarea',
            ],

            [   // Enum Status
                'name' => 'duration',
                'label' => 'مدة الباقة',
                'type' => 'number',
                'prefix' => 'يوم'
            ],
            [   // Enum Status
                'name' => 'ads_count',
                'label' => 'عدد الإعلانات',
                'type' => 'number',
                'prefix' => 'إعلان'
            ],
            [   // Enum Status
                'name' => 'price',
                'label' => 'سعر الباقة',
                'type' => 'number',
                'prefix' => 'جنية'
            ],
            [   // Enum Status
                'name' => 'discount',
                'label' => 'الخصم إن وجد',
                'type' => 'number',
                'prefix' => '%'
            ],


            [  // Select
                'label' => "اختر الفئة",
                'type' => 'select',
                'name' => 'cat_id', // the db column for the foreign key
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
                // optional
                // 'entity' should point to the method that defines the relationship in your Model
                // defining entity will make Backpack guess 'model' and 'attribute'
                'entity' => 'category',

                // optional - manually specify the related model and attribute
                'model' => "App\Models\Category", // related model
                'attribute' => 'title', // foreign key attribute that is shown to user

                // optional - force the related options to be a custom query, instead of all();
                'options' => (function ($query) {
                    return $query->where('free_or_paid', 'paid')->orderBy('title', 'ASC')->get();
                }), //  you can use this to filter the results show in the select
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
