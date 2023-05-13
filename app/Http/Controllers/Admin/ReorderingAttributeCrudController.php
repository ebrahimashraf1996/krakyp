<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ReorderingAttributeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReorderingAttributeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/reordering-attribute');
        CRUD::setEntityNameStrings('reordering attribute', 'reordering attributes');


    }

    public function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'attr_id');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
//        $this->crud->addClause('where', 'course_id', '=', 1);
    }

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



    public function reorder(Request $request)
    {
        // your custom code here
//        return $request;
        $this->crud->addClause('where', 'id', '=', $request->id);
        $this->crud->addClause('with', ['attributes' => function ($q) {
            $q->orderBy('pivot_lft', 'DESC');
        }]);
        $this->crud->addClause('first');
//        $this->crud->addClause('attributes');
        $this->data['entries'] = $this->crud->getPivotEntries();
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.reorder') . ' ' . $this->crud->entity_name;

        // call the method in the trait
//        return $this->data['entries'];
        $id = $request->id;
        return view('vendor.backpack.crud.reorder_pivot', $this->data, compact('id'));

    }

    public function saveReorder()
    {
        $this->crud->hasAccessOrFail('reorder');

        $all_entries = \Request::input('tree');
        $id = \Request::input('id');
        DB::beginTransaction();
        foreach ($all_entries as $item) {
            if ($item['item_id'] != null && $item['item_id'] != '') {
                $attr_cat = DB::table('attr_cat')->where('attr_id', '=', $item['item_id'])
                    ->where('cat_id', $id)->update([
                        'parent_id' => empty($item['parent_id']) ? null : $item['parent_id'],
                        'depth' => empty($item['depth']) ? null : $item['depth'],
                        'lft' => empty($item['left']) ? null : $item['left'],
                        'rgt' => empty($item['right']) ? null : $item['right'],
                    ]);
            }
        }
        DB::commit();
        return 'success for items';
    }
}
