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
            $WeeklyRetentionRecords = UserWeeklyRetentionChartView::all();

            foreach ($WeeklyRetentionRecords as $Week) {
                $ReturnArray = array();

                for ($LevelIndex = 1; $LevelIndex <= 8; $LevelIndex++) {
                    if ($LevelIndex == 1) {
                        //set first level as 100
                        $ReturnArray[] = 100;
                    } else {
                        // eg:  (CurrentWeek_CurrentLevelValue / CurrentWeek_levelOneValue)*100
                        $ReturnArray[] = round(($Week->{"level" . $LevelIndex} / $Week->level1) * 100);
                    }
                }
                $ReturnDataSet[] = array(
                    "name" => $Week->week_start,
                    "data" => $ReturnArray
                );
            }

            //return data
            return response()->json(
                [
                    "success" =>  true,
                    "data" => $ReturnDataSet,
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
