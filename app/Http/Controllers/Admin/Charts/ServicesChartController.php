<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Service;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

/**
 * Class ServicesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServicesChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $items = Service::active()->pluck('title');
        $this->chart->labels($items);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/services'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $arr = [];
        $items = Service::with('visitors')->whereHas('visitors')->active()->get();
        foreach ($items as $item) {
            array_push($arr, $item->visitors->count());
        }
        $this->chart->doughnut($size = 200);
        $this->chart->dataset('Services Viewers', 'pie',
            $arr
        )
            ->color(['rgba(205, 32, 31, .8)','rgba(232,136,62,.8)','rgba(31,149,189,.8)','rgba(221,107,44,.8)','rgba(119,168,185,.8)','rgba(102, 255, 102, .8)']);
    }
}
