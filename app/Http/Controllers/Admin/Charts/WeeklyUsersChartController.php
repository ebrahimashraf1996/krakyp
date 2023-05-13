<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;


/**
 * Class WeeklyUsersChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklyUsersChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels([
            '6 Days ago','5 Days ago','4 Days ago','3 Days ago','2 Days ago','Yesterday','Today',
        ]);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/weekly-users'));

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


         $users_created_today = User::whereDate('created_at', today())->count();
         $six_days = User::whereDate('created_at', date('d.m.Y',strtotime("-6 days")))->count();
         $five_days = User::whereDate('created_at', date('d.m.Y',strtotime("-5 days")))->count();
         $four_days = User::whereDate('created_at', date('d.m.Y',strtotime("-4 days")))->count();
         $three_days = User::whereDate('created_at', date('d.m.Y',strtotime("-3 days")))->count();
         $two_days = User::whereDate('created_at', date('d.m.Y',strtotime("-2 days")))->count();
         $yesterday = User::whereDate('created_at', date('d.m.Y',strtotime("-1 days")))->count();
         $arr = [$six_days,$five_days,$four_days,$three_days,$two_days,$yesterday,$users_created_today];
         $this->chart->dataset('Users Created', 'column', [
             $six_days,$five_days,$four_days,$three_days,$two_days,$yesterday, $users_created_today,
                 ])
             ->color('rgba(96,198,221,255)');
     }
}
