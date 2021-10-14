<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\UserWeeklyRetentionChartView;
use Illuminate\Routing\Controller as BaseController;

class ChartController extends BaseController
{
    /**
     * Api action for /chart/weeklyRetention router
     */
    public function weeklyRetentionChartAction()
    {
        try {
            $weeklyRetentionRecords = UserWeeklyRetentionChartView::all();

            foreach ($weeklyRetentionRecords as $week) {
                $returnArray = array();

                for ($levelIndex = 1; $levelIndex <= 8; $levelIndex++) {
                    if ($levelIndex == 1) {
                        //set first level as 100
                        $returnArray[] = 100;
                    } else {
                        // eg:  (CurrentWeek_CurrentLevelValue / CurrentWeek_levelOneValue)*100
                        $returnArray[] = round(($week->{"level" . $levelIndex} / $week->level1) * 100);
                    }
                }
                $returnDataSet[] = array(
                    "name" => $week->week_start,
                    "data" => $returnArray
                );
            }

            //return data
            return response()->json(
                [
                    "success" =>  true,
                    "data" => $returnDataSet,
                ],
                200
            )->setEncodingOptions(JSON_NUMERIC_CHECK);
        } catch (Exception $ex) {
            //return exception message
            return response()->json([
                'success' =>  false,
                'message' => ' Error: ' . $ex->getMessage(),
            ], 500);
        }
    }
}
