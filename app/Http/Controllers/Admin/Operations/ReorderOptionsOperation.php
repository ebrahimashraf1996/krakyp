<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait ReorderOptionsOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupReorderOptionsRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/reorderoptions/{id}', [
            'as'        => $routeName.'.reorderoptions',
            'uses'      => $controller.'@reorderoptions',
            'operation' => 'reorderoptions',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupReorderOptionsDefaults()
    {
        $this->crud->allowAccess('reorderoptions');

        $this->crud->operation('reorderoptions', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'Reorder Options', 'view', 'crud::buttons.reorder_options', 'beginning');
            // $this->crud->addButton('line', 'reorderoptions', 'view', 'crud::buttons.reorderoptions');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reorderoptions($id)
    {
        $this->crud->hasAccessOrFail('reorderoptions');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'reorderoptions '.$this->crud->entity_name;

        return redirect(backpack_url('option/reorder?id=' . $id));

        // load the view
    }
}
