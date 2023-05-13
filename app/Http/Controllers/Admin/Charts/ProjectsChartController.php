<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

/**
 * Class ProjectsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $items = Project::active()->pluck('title');
        $this->chart->labels($items);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/projects'));

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
        $items = Project::with('visitors')->active()->get();
        foreach ($items as $item) {
            array_push($arr, $item->visitors->count());
        }
        $this->chart->dataset('Project Viewers', 'column',
            $arr
        )
            ->color('rgb(255, 128, 223)');

    }
}
