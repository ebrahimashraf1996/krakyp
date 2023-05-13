<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Allvisit;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

/**
 * Class AllvisitsmayChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AllvisitsmayChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(\General::dates_month(5, date('Y')));


        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/allvisitsmay'));

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

        $days_count = count(\General::dates_month(5, date('Y')));

        $userPerMonth = array();
        for ($i = 0; $i <= $days_count; $i++) {
            array_push($userPerMonth, Allvisit::whereDay('created_at', $i)->whereMonth('created_at', '5')->whereYear('created_at', date('Y'))->count());
        }
//         return ;

        $this->chart->dataset('All Visits Through May (Not Repeated)', 'column',
            $userPerMonth
        )
            ->color('rgba(205, 32, 31, 1)');
    }
}
