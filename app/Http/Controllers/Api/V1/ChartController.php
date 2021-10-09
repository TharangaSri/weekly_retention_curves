<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\UserWeeklyRetentionChartView;
use Illuminate\Routing\Controller as BaseController;

class ChartController extends BaseController
{

    /**
     * Api action for /chart/weeklyRetention router
     */
    public function onboardChartAction()
    {
        //call database and get data from view
        $weekly_retention = UserWeeklyRetentionChartView::all();

        //loop with db results
        foreach ($weekly_retention as $week) {
            //create return array
            $dataArray = array();
            //loop with 8 levels
            for ($i = 1; $i <= 8; $i++) {

                if ($i == 1) {
                    //set start level as 100
                    $dataArray[] = 100;
                } else {
                    /**
                     *  '$week->level1' means all the records in db, less than or equal to 100, within the current week
                     *  create current level percentage as week total 
                     *  eg:  (CurrentWeek_CurrentLevelValue / CurrentWeek_levelOneValue)*100
                     */
                    $dataArray[] = round(($week->{"level" . $i} / $week->level1) * 100);
                }
            }
            //create final return array
            $returnDataSet[] = array(
                "name" => $week->week_start,
                "data" => $dataArray
            );
        }
        //return data 
        return response()->json([
            "success" =>  false,
            "data" => $returnDataSet,
        ], 200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
