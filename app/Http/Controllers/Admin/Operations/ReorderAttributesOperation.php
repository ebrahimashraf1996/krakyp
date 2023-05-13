<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait ReorderAttributesOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupReorderAttributesRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/reorderattributes/{id}', [
            'as'        => $routeName.'.reorderattributes',
            'uses'      => $controller.'@reorderattributes',
            'operation' => 'reorderattributes',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupReorderAttributesDefaults()
    {
        $this->crud->allowAccess('reorderattributes');

        $this->crud->operation('reorderattributes', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'Reorder Attributes', 'view', 'crud::buttons.reorder_attributes', 'beginning');

            // $this->crud->addButton('top', 'reorderattributes', 'view', 'crud::buttons.reorderattributes');
            // $this->crud->addButton('line', 'reorderattributes', 'view', 'crud::buttons.reorderattributes');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reorderattributes($id)
    {
//        return $id;
        $this->crud->hasAccessOrFail('reorderattributes');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'reorderattributes '.$this->crud->entity_name;

        // load the view
        return redirect(backpack_url('reordering-attribute/reorder?id=' . $id));
    }
}
