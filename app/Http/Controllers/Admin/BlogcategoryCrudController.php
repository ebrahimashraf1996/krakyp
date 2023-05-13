<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogcategoryRequest;
use App\Http\Requests\BlogcategoryUpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogcategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogcategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Blogcategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blogcategory');
        CRUD::setEntityNameStrings('قسم', 'الأقسام');
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
                'label' => 'عنوان القسم', // Table column heading
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'الصورة', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'status',
                'label' => 'الحالة'
            ]
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
                'label' => 'عنوان القسم', // Table column heading
            ],
            [
                'name' => 'slug', // The db column name
                'label' => 'العنوان بالرابط', // Table column heading
            ],
            [
                'name' => 'description', // The db column name
                'label' => 'الوصف المختصر', // Table column heading
            ],
            [
                // any type of relationship
                'name' => 'tags', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'الكلمات المفتاحية', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'صورة القسم', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'status',
                'label' => 'الحالة'
            ]
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
        CRUD::setValidation(BlogcategoryRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "عنوان القسم",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'ادخل عنوان القسم ..',
                    'id' => 'cat_title',
                ],
            ],
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
                'type' => 'custom_slug_blog',
            ],
            [   // Textarea Description
                'name' => 'description',
                'label' => 'الوصف المختصر',
                'type' => 'textarea',
                'attributes' => [
                    'placeholder' => 'ادخل الوصف المختصر ... ',
                ],
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Tags",
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

            [   // Upload Image
                'name' => 'image',
                'label' => 'صورة القسم',
                'type' => 'browse',
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
        CRUD::setValidation(BlogcategoryUpdateRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "عنوان القسم",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'ادخل عنوان القسم ..',
                    'id' => 'cat_title',
                ],
            ],
            [   // Textarea Description
                'name' => 'description',
                'label' => 'الوصف المختصر',
                'type' => 'textarea',
                'attributes' => [
                    'placeholder' => 'ادخل الوصف المختصر ... ',
                ],
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Tags",
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
            [   // Upload Image
                'name' => 'image',
                'label' => 'صورة القسم',
                'type' => 'browse',
            ],

            [   // Enum Status
                'name' => 'status',
                'label' => 'الحالة',
                'type' => 'enum'
            ],
        ]);
    }
}
