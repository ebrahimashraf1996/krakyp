<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SettingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SettingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Setting::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/setting');
        CRUD::setEntityNameStrings('الإعدادات', 'الإعدادات');
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
                'label' => 'العنوان - SEO', // Table column heading
                'type' => 'text',
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'النوع - SEO',
                'type' => 'text'
            ],
            [
                'name' => 'logo', // The db column name
                'label' => 'الشعار', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'general_bg', // The db column name
                'label' => 'خلفية الموقع', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'search_bg', // The db column name
                'label' => 'خلفية صندوق البحث', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],

            [
                'name' => 'email', // The db column name
                'label' => 'البريد الالكتروني', // Table column heading
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
                'label' => 'العنوان - SEO', // Table column heading
                'type' => 'text',
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'النوع - SEO',
                'type' => 'text'
            ],
            [
                'name' => 'description',
                'label' => 'الوصف الطويل',
                'type' => 'arranged_description'
            ],

            [
                'name' => 'short_des',
                'label' => 'الوصف القصير'
            ],

            [
                'name' => 'logo', // The db column name
                'label' => 'الشعار', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'general_bg', // The db column name
                'label' => 'خلفية الموقع', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'search_bg', // The db column name
                'label' => 'خلفية صندوق البحث', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
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
                'name' => 'address', // The db column name
                'label' => 'العنوان', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'رقم الهاتف', // Table column heading
                // 'limit' => 10, // if you want to truncate the phone number to a different number of characters
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'البريد الإلكتروني', // Table column heading
            ],
            [
                'name' => 'facebook', // The db column name
                'label' => 'الفيسبوك', // Table column heading
            ],
            [
                'name' => 'twitter', // The db column name
                'label' => 'تويتر', // Table column heading
            ],
            [
                'name' => 'linkedin', // The db column name
                'label' => 'لينكد إن', // Table column heading
            ],
            [
                'name' => 'behance', // The db column name
                'label' => 'بيهانس', // Table column heading
            ],
            [
                'name' => 'instagram', // The db column name
                'label' => 'انستجرام', // Table column heading
            ],
            [
                'name' => 'whatsapp', // The db column name
                'label' => 'واتساب', // Table column heading
            ],
            [
                'name' => 'snap_chat', // The db column name
                'label' => 'سناب شات', // Table column heading
            ],
            [
                'name' => 'youtube', // The db column name
                'label' => 'يوتيوب', // Table column heading
            ],
            [
                'name' => 'skype', // The db column name
                'label' => 'سكايب', // Table column heading
            ],

            [
                'name' => 'map',
                'label' => 'خريطة جوجل',
                'type' => 'arranged_map'
            ],
            [
                'name' => 'rights',
                'label' => 'سياسة الخصوصية',
                'type' => 'arranged_rights'
            ],
            [
                'name' => 'terms',
                'label' => 'بنود الخدمة',
                'type' => 'arranged_terms'
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
//    protected function setupCreateOperation()
//    {
//        CRUD::setValidation(SettingRequest::class);
//
//        $this->crud->addFields([
//            [   // Summernote
//                'name' => 'title',
//                'label' => 'العنوان - SEO',
//                'type' => 'text'
//            ],
//            [   // Summernote
//                'name' => 'type',
//                'label' => 'النوع - SEO',
//                'type' => 'text'
//            ],
//            [   // Summernote
//                'name' => 'short_des',
//                'label' => 'الوصف القصير',
//                'type' => 'textarea'
//            ],
//            [   // Summernote
//                'name' => 'description',
//                'label' => 'الوصف الطويل',
//                'type' => 'summernote',
//                'options' => [
//                    'toolbar' => [
//                        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
//                        ['Font Style', ['fontname', 'fontsize','fontsizeunit',  'forecolor', 'backcolor', 'bold', 'italic', 'underline','strikethrough','superscript','subscript','clear',]],
//                        ['Paragraph style', ['style','ol','ul','paragraph','height']],
//                        ['Misc', ['fullscreen','codeview','undo','redo','help']]
//                    ]
//                ],
//            ],
//            [   // Upload Image
//                'name' => 'logo',
//                'label' => 'الشعار',
//                'type' => 'browse',
//            ],
//
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
//            [
//                'name' => 'address',
//                'label' => 'العنوان',
//                'type' => 'text'
//            ],
//
//            [
//                'name' => 'map',
//                'label' => 'خريطة جوجل',
//                'type' => 'textarea'
//            ],
//            [
//                'name' => 'phone',
//                'label' => 'رقم الهاتف',
//                'type' => 'text'
//            ],
//
//            [
//                'name' => 'whatsapp',
//                'label' => 'واتساب',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'email',
//                'label' => 'البريد الإلكتروني',
//                'type' => 'email'
//            ],
//            [
//                'name' => 'facebook',
//                'label' => 'الفيسبوك',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'twitter',
//                'label' => 'تويتر',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'linkedin',
//                'label' => 'لينكد إن',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'behance',
//                'label' => 'بيهانس',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'instagram',
//                'label' => 'انستجرام',
//                'type' => 'url'
//            ],
//
//
//            [   // Summernote
//                'name' => 'rights',
//                'label' => 'سياسة الخصوصية',
//                'type' => 'summernote'
//            ],
//            [   // Summernote
//                'name' => 'terms',
//                'label' => 'بنود الخدمة',
//                'type' => 'summernote'
//            ],
//
//        ]);
//    }


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(SettingRequest::class);

        $this->crud->addFields([
            [   // Summernote
                'name' => 'title',
                'label' => 'العنوان - SEO',
                'type' => 'text'
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'النوع - SEO',
                'type' => 'text'
            ],
            [   // Summernote
                'name' => 'short_des',
                'label' => 'الوصف القصير',
                'type' => 'textarea'
            ],
            [   // Summernote
                'name' => 'description',
                'label' => 'الوصف الطويل',
                'type' => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                        ['Font Style', ['fontname', 'fontsize','fontsizeunit',  'forecolor', 'backcolor', 'bold', 'italic', 'underline','strikethrough','superscript','subscript','clear',]],
                        ['Paragraph style', ['style','ol','ul','paragraph','height']],
                        ['Misc', ['fullscreen','codeview','undo','redo','help']]
                    ]
                ],
            ],
            [   // Upload Image
                'name' => 'logo',
                'label' => 'الشعار',
                'type' => 'browse',
            ],
            [
                'name' => 'general_bg', // The db column name
                'label' => 'خلفية الموقع', // Table column heading
                'type' => 'browse',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'search_bg', // The db column name
                'label' => 'خلفية صندوق البحث', // Table column heading
                'type' => 'browse',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
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
            [
                'name' => 'address',
                'label' => 'العنوان',
                'type' => 'text'
            ],

            [
                'name' => 'map',
                'label' => 'خريطة جوجل',
                'type' => 'textarea'
            ],
            [
                'name' => 'phone',
                'label' => 'رقم الهاتف',
                'type' => 'text'
            ],

            [
                'name' => 'whatsapp',
                'label' => 'واتساب',
                'type' => 'url'
            ],
            [
                'name' => 'email',
                'label' => 'البريد الإلكتروني',
                'type' => 'email'
            ],
            [
                'name' => 'facebook',
                'label' => 'الفيسبوك',
                'type' => 'url'
            ],
            [
                'name' => 'twitter',
                'label' => 'تويتر',
                'type' => 'url'
            ],
            [
                'name' => 'linkedin',
                'label' => 'لينكد إن',
                'type' => 'url'
            ],
            [
                'name' => 'behance',
                'label' => 'بيهانس',
                'type' => 'url'
            ],
            [
                'name' => 'instagram',
                'label' => 'انستجرام',
                'type' => 'url'
            ],
            [
                'name' => 'snap_chat',
                'label' => 'سناب شات',
                'type' => 'url'
            ],
            [
                'name' => 'youtube',
                'label' => 'يوتيوب',
                'type' => 'url'
            ],
            [
                'name' => 'skype',
                'label' => 'سكايب',
                'type' => 'url'
            ],


            [   // Summernote
                'name' => 'rights',
                'label' => 'سياسة الخصوصية',
                'type' => 'summernote'
            ],
            [   // Summernote
                'name' => 'terms',
                'label' => 'بنود الخدمة',
                'type' => 'summernote'
            ],

        ]);
    }
}
