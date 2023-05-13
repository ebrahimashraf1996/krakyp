<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Clientad;
use Illuminate\Support\Facades\Route;

trait AcceptOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAcceptRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/accept', [
            'as' => $routeName . '.accept',
            'uses' => $controller . '@accept',
            'operation' => 'accept',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAcceptDefaults()
    {
        $this->crud->allowAccess('accept');

        $this->crud->operation('accept', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'accept', 'view', 'crud::buttons.accept', 'beginning');
            // $this->crud->addButton('top', 'optionsadd', 'view', 'crud::buttons.optionsadd');
            // $this->crud->addButton('line', 'optionsadd', 'view', 'crud::buttons.optionsadd');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($id)
    {
        $this->crud->hasAccessOrFail('accept');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'accept ' . $this->crud->entity_name;



         $client_ad = Clientad::with(['userPackage' => function($q) {
            $q->with(['clientAds' => function($q) {
                $q->where('is_published', '1')->where('is_canceled', '0')->orWhere('is_published', '0')->where('is_canceled', '0');
            }]);
        }])->find($id);
        $start_date = date("Y-m-d");
        $end_date = date('Y-m-d', strtotime($start_date. ' + ' . $client_ad->duration .' days'));
        $client_ad->is_published = 1;
        $client_ad->is_canceled = 0;
        $client_ad->reason_id = null;
        $client_ad->start_date = $start_date;
        $client_ad->end_date = $end_date;
        $client_ad->save();

        $count = $client_ad->userPackage->clientAds->count();
//        return $client_ad->userPackage;
        if ($count >= $client_ad->userPackage->ads_count) {
            $client_ad->userPackage->full_ads = 1;
            $client_ad->userPackage->save();
        }




        \Alert::success('تم قبول الإعلان بنجاح')->flash();
        return redirect()->back();



        // load the view
    }
}


