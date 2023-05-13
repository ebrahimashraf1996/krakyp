<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Clientad;
use Illuminate\Support\Facades\Route;

trait RejectOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRejectRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/reject/{reason_id}', [
            'as' => $routeName . '.reject',
            'uses' => $controller . '@reject',
            'operation' => 'reject',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRejectDefaults()
    {
        $this->crud->allowAccess('reject');

        $this->crud->operation('reject', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'reject', 'view', 'crud::buttons.reject', 'beginning');
            // $this->crud->addButton('top', 'optionsadd', 'view', 'crud::buttons.optionsadd');
            // $this->crud->addButton('line', 'optionsadd', 'view', 'crud::buttons.optionsadd');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function reject($id, $reason_id)
    {
        $this->crud->hasAccessOrFail('reject');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'reject '.$this->crud->entity_name;
// load the view
        $client_ad = Clientad::find($id);
        $client_ad->is_published = 0;
        $client_ad->is_canceled = 1;
        $client_ad->start_date = null;
        $client_ad->end_date = null;
        $client_ad->reason_id = $reason_id;
        $client_ad->save();
        \Alert::success('تم رفض الإعلان بنجاح')->flash();
        return redirect()->back();

        // load the view
//        return view("crud::operations.reject", $this->data);
    }
}
