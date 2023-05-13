<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\AddPackagesToCategoriesOperation;
use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use function Nette\Utils\attributes;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TestCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use AddPackagesToCategoriesOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('فئة', 'الفئات');
        $this->crud->orderBy('lft', 'ASC');

    }

    public function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'title');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
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
                'label' => 'عنوان الفئة', // Table column heading
            ],
            [
                'name' => 'image',
                'label' => 'الغلاف',
                'type' => 'image',
                'width' => '60px',
                'height' => '60px'

            ],
            [   // Enum Status
                'name' => 'free_or_paid',
                'label' => 'مجانية أم مدفوعة',
            ],
            [
                'name' => 'mainCategory',
                'label' => 'الفئة الأم',
                'type' => 'relationship'
            ],

            [
                'name' => 'is_featured',
                'label' => 'الإدراج بالصفحة الرئيسية',
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
                'label' => 'عنوان الفئة', // Table column heading
            ],
            [
                'name' => 'slug',
                'label' => 'الإسم بالرابط',
            ],
            [
                'name' => 'description',
                'label' => 'الوصف البسيط - SEO',
            ],
            [
                'name' => 'image',
                'label' => 'الغلاف',
                'type' => 'image',
                'width' => '60px'
            ],
            [   // Enum Status
                'name' => 'free_or_paid',
                'label' => 'مجانية أم مدفوعة',
            ],

            [
                'name' => 'user',
                'label' => 'بواسطة',
                'type' => 'relationship'
            ],
            [
                'name' => 'mainCategory',
                'label' => 'الفئة الأم',
                'type' => 'relationship'
            ],
            [
                'name' => 'attributes',
                'label' => 'الخصائص',
                'type' => 'relationship'
            ],
            [
                'name' => 'catpackages',
                'label' => 'الباقات',
                'type' => 'relationship'
            ],
            [
                'name' => 'subCategories',
                'label' => 'الفئات المندرجة',
                'type' => 'relationship'
            ],


            [
                'name' => 'is_featured',
                'label' => 'الإدراج بالصفحة الرئيسية',
            ],
//            [
//                'name' => 'is_featured',
//                'label' => 'الخيارات',
//                'type' => 'relationship'
//            ],
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
        CRUD::setValidation(CategoryRequest::class);

        $this->crud->addFields([

            [   // Upload Image
                'name' => 'title',
                'label' => 'عنوان الفئة',
                'type' => 'text',
                'attributes' => [
                    'id' => 'cat_title'
                ]
            ],
//            [   // Upload Image
//                'name' => 'slug_keyword',
//                'label' => 'الإسم بالرابط',
//                'type' => 'text',
//            ],
            [   // Text Title
                'name' => 'slug',
                'label' => "العنوان بالرابط",
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'id' => 'slug'
                ],
            ],
            [   // Text Title
                'name' => 'custom',
                'type' => 'custom_slug_cat',
            ],
            [   // Upload Image
                'name' => 'description',
                'label' => 'الوصف البسيط - SEO',
                'type' => 'textarea',
            ],

//            [   // icon_picker
//                'label'   => "الغلاف",
//                'name'    => 'image',
//                'type'    => 'icon_picker',
//                'iconset' => 'fontawesome' // options: fontawesome, lineawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
//            ],
            [   // Enum Status
                'name' => 'image',
                'label' => 'الغلاف',
                'type' => 'browse'
            ],
            [   // Enum Status
                'name' => 'free_or_paid',
                'label' => 'مجانية أم مدفوعة',
                'type' => 'enum'
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "الكلمات المفتاحية",
                'type' => 'select2_multiple',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user

                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                // 'select_all' => true, // show Select All and Clear buttons?


                // optional
                'model' => "App\Models\Tag", // foreign key model
                'options' => (function ($query) {
                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "الخصائص",
                'type' => 'select2_multiple',
                'name' => 'attributes', // the method that defines the relationship in your Model
                'entity' => 'attributes', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user

                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                // 'select_all' => true, // show Select All and Clear buttons?


                // optional
                'model' => "App\Models\Attribute", // foreign key model
                'options' => (function ($query) {
                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],

            [   // Enum Status
                'name' => 'user_id',
                'type' => 'hidden',
                'value' => backpack_auth()->user()->id
            ],
            [   // Enum Status
                'name' => 'parent_id',
                'type' => 'hidden',
                'value' => null
            ],
            [   // Enum Status
                'name' => 'is_featured',
                'type' => 'select_from_array',
                'options' => ['Not Featured' => 'غير مدرج', 'Featured' => 'مدرج'],
                'allows_null' => false,
                'default' => '0',
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
