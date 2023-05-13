<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Category;
use App\Models\Catpackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait AddPackagesToCategoriesOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAddPackagesToCategoriesRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/addpackagestocategories', [
            'as' => $routeName . '.addpackagestocategories',
            'uses' => $controller . '@addpackagestocategories',
            'operation' => 'addpackagestocategories',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAddPackagesToCategoriesDefaults()
    {
        $this->crud->allowAccess('addpackagestocategories');

        $this->crud->operation('addpackagestocategories', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'addpackages', 'view', 'crud::buttons.addpackages', 'beginning');
            // $this->crud->addButton('top', 'addpackagestocategories', 'view', 'crud::buttons.addpackagestocategories');
            // $this->crud->addButton('line', 'addpackagestocategories', 'view', 'crud::buttons.addpackagestocategories');
        });
    }


    public function addpackagestocategories($id)
    {
        $this->crud->hasAccessOrFail('addpackagestocategories');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'addpackagestocategories ' . $this->crud->entity_name;

        $cat = Category::select('id', 'free_or_paid', 'title')->find($id);
        if ($cat->free_or_paid == 'paid') {
            $this->data['cat'] = $cat;

            $this->crud->addFields([
                [   // Text Title
                    'name' => 'cat_id',
                    'type' => 'hidden',
                    'value' => $cat->id
                ],
                [   // Table
                    'name' => 'packages[]',
                    'label' => 'الباقات',
                    'type' => 'table',
                    'entity_singular' => 'باقات', // used on the "Add X" button
                    'columns' => [
                        'title' => 'عنوان الباقة',
                        'description' => 'وصف قصير',
                        'duration' => 'مدة الباقة',
                        'ads_count' => 'عدد الإعلانات',
                        'price' => 'السعر',
                        'discount' => 'الخصم إن وجد',
                    ],
                    'max' => 100, // maximum rows allowed in the table
                    'min' => 0, // minimum rows allowed in the table
                ],
            ]);
            return view("crud::operations.addPackages", $this->data);
        } else {
            \Alert::error(trans('backpack::crud.error_add_package'))->flash();
            return redirect()->back();
        }
    }

    public function addPackes(Request $request)
    {
//        return $request;

        $arr=  json_decode($request->packages[0], true);

        foreach ($arr as $k => $val) {
//            return $arr['title'];
            Catpackage::create([
                'title' => $val['title'],
                'description' => $val['description'],
                'duration' => $val['duration'],
                'ads_count' => $val['ads_count'],
                'price' => $val['price'],
                'discount' => $val['discount'],
                'cat_id' => $request->cat_id,
            ]);
        }
        \Alert::success('تم إضافة الباقات بنجاح')->flash();
        return redirect($request->http_referrer);
    }

}
