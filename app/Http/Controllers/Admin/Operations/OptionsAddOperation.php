<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait OptionsAddOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupOptionsAddRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/optionsadd', [
            'as' => $routeName . '.optionsadd',
            'uses' => $controller . '@optionsadd',
            'operation' => 'optionsadd',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupOptionsAddDefaults()
    {
//        dd($id);
        $this->crud->allowAccess('optionsadd');

        $this->crud->operation('optionsadd', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

//        dd($this->crud->entry->getkey());

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'addoptions', 'view', 'crud::buttons.addoptions', 'beginning');
            // $this->crud->addButton('top', 'optionsadd', 'view', 'crud::buttons.optionsadd');
            // $this->crud->addButton('line', 'optionsadd', 'view', 'crud::buttons.optionsadd');
        });
    }


    public function optionsadd($id)
    {
        $this->crud->hasAccessOrFail('optionsadd');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'optionsadd ' . $this->crud->entity_name;

        $att = Attribute::select('id', 'title', 'type')->find($id);
        if ($att->type == 'with_options') {
            $this->data['att'] = $att;

            $this->crud->addFields([
                [   // Text Title
                    'name' => 'att_id',
                    'type' => 'hidden',
                    'value' => $att->id
                ],
                [   // Table
                    'name' => 'options[]',
                    'label' => 'الخيارات',
                    'type' => 'table',
                    'entity_singular' => 'خيارات', // used on the "Add X" button
                    'columns' => [
                        'title' => 'المحتوي',
                    ],
                    'max' => 100, // maximum rows allowed in the table
                    'min' => 0, // minimum rows allowed in the table
                ],
            ]);
            return view("crud::operations.optionsadd", $this->data);
        } else {
            \Alert::error(trans('backpack::crud.error_add_options'))->flash();
            return redirect()->back();
        }


//dd($this->data['id']);
        // load the view
    }


    public function addOptions(Request $request)
    {

        $request->options = str_replace('[', '', $request->options);
        $request->options = str_replace(']', '', $request->options);
        $request->options = str_replace('{', '', $request->options);
        $request->options = str_replace('}', '', $request->options);
        $request->options = str_replace('"', '', $request->options);
        $request->options = str_replace('title:', '', $request->options);
        $request->options = explode(',', $request->options[0]);

        foreach ($request->options as $k => $val) {
            Option::create([
                'val' => $val,
                'attr_id' => $request->att_id
            ]);
        }
        \Alert::success('تم إضافة الخيارات بنجاح')->flash();
        return redirect($request->http_referrer);
    }

}
