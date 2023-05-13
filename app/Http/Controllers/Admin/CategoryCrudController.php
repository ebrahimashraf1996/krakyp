<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\AddPackagesToCategoriesOperation;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Attribute;
use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use function Nette\Utils\attributes;
use App\Http\Controllers\Admin\Operations\ReorderAttributesOperation;


/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
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
    use ReorderAttributesOperation;


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
            [
                'name'     => 'cat_icon',
                'label'    => 'الأيقونة',
                'type'     => 'custom_icon',
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
//            [
//                'name' => 'cat_icon',
//                'label' => '',
//                'type' => 'image',
//            ],
            [
                'name'     => 'cat_icon',
                'label'    => 'الأيقونة',
                'type'     => 'custom_icon',
            ],

            [   // Enum Status
                'name' => 'free_or_paid',
                'label' => 'مجانية أم مدفوعة',
            ],
            [   // Enum Status
                'name' => 'tags',
                'label' => 'الكلمات المفتاحية',
                'type' => 'relationship'
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
                'name' => 'slug_keyword',
                'label' => "Slug",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Enter Slug',
                ],
            ],
//            [   // Text Title
//                'name' => 'custom',
//                'type' => 'custom_slug_cat',
//            ],
            [   // Upload Image
                'name' => 'description',
                'label' => 'الوصف البسيط - SEO',
                'type' => 'textarea',
            ],

            [   // icon_picker
                'label'   => "الأيقونة",
                'name'    => 'cat_icon',
                'type'    => 'text',
                'hint' => "<a href='". route('show.icons') ."' target='_blank'>ابحث عن الأيقونة</a>"

            ],
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
            [
                'type' => 'custom_tags',
                'name' => 'custom_tags',
                'label' => 'test',
            ],

//            [    // Select2Multiple = n-n relationship (with pivot table)
//                'label' => "الكلمات المفتاحية",
//                'type' => 'select2_multiple',
//                'name' => 'tags', // the method that defines the relationship in your Model
//                'entity' => 'tags', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//                // 'select_all' => true, // show Select All and Clear buttons?
//
//
//                // optional
//                'model' => "App\Models\Tag", // foreign key model
//                'options' => (function ($query) {
//                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
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
        CRUD::setValidation(CategoryUpdateRequest::class);

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
//                'attributes' => [
//                    'readonly'    => 'readonly',
//                    'id' => 'slug'
//                ],
            ],
//            [   // Text Title
//                'name' => 'custom',
//                'type' => 'custom_slug_cat',
//            ],
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
            [   // icon_picker
                'label'   => "الأيقونة",
                'name'    => 'cat_icon',
                'type'    => 'text',
                'hint' => "<a href='". route('show.icons') ."' target='_blank'>ابحث عن الأيقونة</a>"

            ],
            [   // Enum Status
                'name' => 'free_or_paid',
                'label' => 'مجانية أم مدفوعة',
                'type' => 'enum'
            ],
            [
                'type' => 'custom_tags_exists',
                'name' => 'custom_tags_exists',
                'label' => 'test',
            ],

//            [    // Select2Multiple = n-n relationship (with pivot table)
//                'label' => "الكلمات المفتاحية",
//                'type' => 'select2_multiple',
//                'name' => 'tags', // the method that defines the relationship in your Model
//                'entity' => 'tags', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//                // 'select_all' => true, // show Select All and Clear buttons?
//
//
//                // optional
//                'model' => "App\Models\Tag", // foreign key model
//                'options' => (function ($query) {
//                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
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
    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
         $request = $this->crud->validateRequest();

        $new_tags = [];
        foreach ($request->tags as $tag) {
            $check = Tag::find($tag);
            if (!$check) {
                $id = Tag::create([
                    'title' => $tag
                ])->id;
                array_push($new_tags, $id);

            } else {
                array_push($new_tags, $tag);
            }
        }
        // insert item in the db
        $item = $this->crud->create([
            'title' => $this->crud->getStrippedSaveRequest()['title'],
            'slug_keyword' => $this->crud->getStrippedSaveRequest()['slug_keyword'],
            'description' => $this->crud->getStrippedSaveRequest()['description'],
            'cat_icon' => $this->crud->getStrippedSaveRequest()['cat_icon'],
            'image' => $this->crud->getStrippedSaveRequest()['image'],
            'free_or_paid' => $this->crud->getStrippedSaveRequest()['free_or_paid'],
            'user_id' => $this->crud->getStrippedSaveRequest()['user_id'],
            'parent_id' => $this->crud->getStrippedSaveRequest()['parent_id'],
            'is_featured' => $this->crud->getStrippedSaveRequest()['is_featured'],
            'status' => $this->crud->getStrippedSaveRequest()['status'],
        ]);
        foreach ($this->crud->getStrippedSaveRequest()['attributes'] as $attr_id) {
            $attr = Attribute::find($attr_id);
            DB::table('attr_cat')->insert([
                'cat_id' => $item->id,
                'attr_id' => $attr->id,
                'type_of' => $attr->type,
                'main_other' => $attr->type_of,
            ]);
        }

        $item->tags()->sync($new_tags);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }


    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $new_tags = [];
        foreach ($request->tags as $tag) {
            $check = Tag::find($tag);
            if (!$check) {
                $id = Tag::create([
                    'title' => $tag
                ])->id;
                array_push($new_tags, $id);

            } else {
                array_push($new_tags, $tag);
            }
        }

        $cat_id = $request->get($this->crud->model->getKeyName());
        $category = Category::find($cat_id);
        $category->update([
            'title' => $this->crud->getStrippedSaveRequest()['title'],
            'slug' => $this->crud->getStrippedSaveRequest()['slug'],
            'description' => $this->crud->getStrippedSaveRequest()['description'],
            'cat_icon' => $this->crud->getStrippedSaveRequest()['cat_icon'],
            'image' => $this->crud->getStrippedSaveRequest()['image'],
            'free_or_paid' => $this->crud->getStrippedSaveRequest()['free_or_paid'],
            'user_id' => $this->crud->getStrippedSaveRequest()['user_id'],
            'parent_id' => $this->crud->getStrippedSaveRequest()['parent_id'],
            'is_featured' => $this->crud->getStrippedSaveRequest()['is_featured'],
            'status' => $this->crud->getStrippedSaveRequest()['status'],
        ]);


        $new_attrs = [];
        foreach ($this->crud->getStrippedSaveRequest()['attributes'] as $attr_id) {
            $attr = Attribute::find($attr_id);

            $already = DB::table('attr_cat')->where('cat_id', $category->id)->where('attr_id', $attr->id)->first();
            if ($already) {
                $new_attr = [
                    'cat_id' => $already->cat_id,
                    'attr_id' => $already->attr_id,
                    'parent_id' => $already->parent_id,
                    'lft' => $already->lft,
                    'rgt' => $already->rgt,
                    'depth' => $already->depth,
                    'type_of' => $attr->type,
                    'main_other' => $attr->type_of,
                ];
//                return $already;
//                return $new_attr;

                array_push($new_attrs, $new_attr);
            } else {
//                return $attr;
                $new_attr = [
                    'cat_id' => $category->id,
                    'attr_id' => $attr->id,
                    'parent_id' => null,
                    'lft' => 0,
                    'rgt' => 0,
                    'depth' => 0,
                    'type_of' => $attr->type,
                    'main_other' => $attr->type_of,
                ];
                array_push($new_attrs, $new_attr);

            }
        }
//        return $new_attrs;

        $related_attrs = DB::table('attr_cat')->where('cat_id', $cat_id);
        $related_attrs->delete();

//        return 'test';
        foreach ($new_attrs as $new_insert) {
            DB::table('attr_cat')->insert([
                'cat_id' => $new_insert['cat_id'],
                'attr_id' => $new_insert['attr_id'],
                'parent_id' => $new_insert['parent_id'],
                'lft' => $new_insert['lft'],
                'rgt' => $new_insert['rgt'],
                'depth' => $new_insert['depth'],
                'type_of' => $new_insert['type_of'],
                'main_other' => $new_insert['main_other'],
            ]);

        }
        // update the row in the db
        $category->tags()->sync($new_tags);

        $this->data['entry'] = $this->crud->entry = $category;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($category->getKey());
    }

}
