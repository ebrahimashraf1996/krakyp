<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Allvisit;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class AllvisitsnovChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AllvisitsnovChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new \ConsoleTVs\Charts\Classes\Highcharts\Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(\General::dates_month(11, date('Y')));

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/allvisitsnov'));

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

        $days_count = count(\General::dates_month(11, date('Y')));

        $userPerMonth = array();
        for ($i = 0; $i <= $days_count; $i++) {
            array_push($userPerMonth, Allvisit::whereDay('created_at', $i)->whereMonth('created_at', '11')->whereYear('created_at', date('Y'))->count());
        }
//         return ;

        $this->chart->dataset('All Visits Through November (Not Repeated)', 'column',
            $userPerMonth
        )
            ->color('rgba(205, 32, 31, 1)');
    }
}
