<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Allvisit;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use DateTime;

/**
 * Class AllvisitsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AllvisitsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
//        $users_created_today = User::whereDate('created_at', today())->count();
//        $six_days = User::whereDate('created_at', date('d.m.Y',strtotime("-6 days")))->count();

        $months = [];

        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m));
            array_push($months, $month);
        }

        $this->chart->labels(
            $months
        );

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/allvisits'));

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


        $userPerMonth = array();
        for ($i = 13; $i > 0; $i--) {
            $userPerMonth[$i] = Allvisit::whereMonth('created_at', date('m', strtotime('+' . $i . ' month')))->whereYear('created_at', date('Y'))->count();
        }
        unset($userPerMonth[1]);
        $arr = [];
        foreach ($userPerMonth as $key => $value) {
            array_push($arr, $value);
        }
//         return ;

        $this->chart->dataset('All Visits Through All Year (Not Repeated)', 'spline',
            array_reverse($arr)
        )
            ->color('rgba(205, 32, 31, 1)');
    }
}
