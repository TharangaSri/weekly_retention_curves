<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChartView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW user_weekly_retention_chart_view AS
            SELECT
                DATE_ADD(created_date, INTERVAL(2-DAYOFWEEK(created_date)) DAY) AS week_start,
                CONCAT(YEAR(created_date), '/', WEEK(created_date)) AS week_name,
                SUM(CASE WHEN onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS  level1,
                SUM(CASE WHEN onboarding_percentage > 0 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level2,
                SUM(CASE WHEN onboarding_percentage > 20 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level3,
                SUM(CASE WHEN onboarding_percentage > 40 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level4,
                SUM(CASE WHEN onboarding_percentage > 50 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level5,
                SUM(CASE WHEN onboarding_percentage > 70 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level6,
                SUM(CASE WHEN onboarding_percentage > 90 AND onboarding_percentage <= 100 THEN 1 ELSE 0 END) AS level7,
                SUM(CASE WHEN onboarding_percentage = 100 THEN 1 ELSE 0 END) AS level8
                FROM
                user_onboarding
                GROUP BY week_name
                ORDER BY YEAR(created_date) ASC, WEEK(created_date) ASC;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `user_weekly_retention_chart_view`;");
    }
}
