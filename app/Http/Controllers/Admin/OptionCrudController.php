<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OptionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Class OptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OptionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Option::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/option');
        CRUD::setEntityNameStrings('خيار', 'الخيارات');
        $this->crud->addClause('orderBy', 'lft', 'desc');

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
                'name' => 'val',
                'label' => 'الخيار',
            ],

            [
                'name' => 'attribute',
                'label' => 'الخاصية',
                'type' => 'relationship',
            ],
        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }


    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-show-entries
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            [
                'name' => 'val',
                'label' => 'الخيار',
            ],

            [
                'name' => 'attribute',
                'label' => 'الخاصية',
                'type' => 'relationship',
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
        CRUD::setValidation(OptionRequest::class);
        $this->crud->addFields([
            [   // Enum Status
                'name' => 'val',
                'label' => 'محتوي الخيار',
                'type' => 'text'
            ],
            [  // Select
                'label' => "اختر الخاصية",
                'type' => 'select',
                'name' => 'attr_id', // the db column for the foreign key
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
                // optional
                // 'entity' should point to the method that defines the relationship in your Model
                // defining entity will make Backpack guess 'model' and 'attribute'
                'entity' => 'attribute',

                // optional - manually specify the related model and attribute
                'model' => "App\Models\Attribute", // related model
                'attribute' => 'title', // foreign key attribute that is shown to user

                // optional - force the related options to be a custom query, instead of all();
                'options' => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                }), //  you can use this to filter the results show in the select
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


    public function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'val');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
//        $this->crud->addClause('where', 'course_id', '=', 1);
    }








    protected function setupReorderRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/reorder', [
            'as'        => $routeName.'.reorder',
            'uses'      => $controller.'@reorder',
            'operation' => 'reorder',
        ]);

        Route::post($segment.'/reorder', [
            'as'        => $routeName.'.save.reorder',
            'uses'      => $controller.'@saveReorder',
            'operation' => 'reorder',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupReorderDefaults()
    {
        $this->crud->set('reorder.enabled', true);
        $this->crud->allowAccess('reorder');

        $this->crud->operation('reorder', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('top', 'reorder', 'view', 'crud::buttons.reorder');
        });
    }
//    public function reorder()
//    {
//        $this->crud->hasAccessOrFail('reorder');
//
//        if (! $this->crud->isReorderEnabled()) {
//            abort(403, 'Reorder is disabled.');
//        }
//
//        // get all results for that entity
//        $this->data['entries'] = $this->crud->getEntries();
//        $this->data['crud'] = $this->crud;
//        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.reorder').' '.$this->crud->entity_name;
//
//        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
//        return view($this->crud->getReorderView(), $this->data);
//    }
    public function reorder(Request $request)
    {
        // your custom code here
//        return $request;

        $this->data['entries'] = $this->crud->getEntries()->where('attr_id', $request->id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.reorder').' '.$this->crud->entity_name;

        // call the method in the trait
        return view($this->crud->getReorderView(), $this->data);

    }

    /**
     * Save the new order, using the Nested Set pattern.
     *
     * Database columns needed: id, parent_id, lft, rgt, depth, name/title
     *
     * @return
     */
    public function saveReorder()
    {
        $this->crud->hasAccessOrFail('reorder');

        $all_entries = \Request::input('tree');

        if (count($all_entries)) {
            $count = $this->crud->updateTreeOrder($all_entries);
        } else {
            return false;
        }

        return 'success for '.$count.' items';
    }

}
