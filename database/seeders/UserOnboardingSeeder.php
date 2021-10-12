<?php

namespace Database\Seeders;

use App\Models\UserOnboarding;
use Illuminate\Database\Seeder;
use Database\Seeders\Helper\DataFormatHelper;

class UserOnboardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserOnboarding::truncate();

        //open and read csv file
        $CsvFile = fopen(base_path("database/data/export.csv"), "r");

        $FirstLine = true;
        while (($Data = fgetcsv($CsvFile, 340, ";")) !== FALSE) {
            if (!$FirstLine) {
                //create userOnboarding records
                UserOnboarding::create(["user_id" => trim($Data['0']),
                    "created_date" => DataFormatHelper::formatDateColumn(trim($Data['1'])),
                    "onboarding_percentage" => DataFormatHelper::formatNumberColumn(trim($Data['2'])),
                    "count_applications" => DataFormatHelper::formatNumberColumn(trim($Data['3'])),
                    "count_accepted_applications" => DataFormatHelper::formatNumberColumn(trim($Data['4']))
                ]);
            }
            $FirstLine = false;
        }

        fclose($CsvFile);
    }
}
