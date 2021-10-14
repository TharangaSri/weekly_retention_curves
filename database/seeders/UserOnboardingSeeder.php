<?php

namespace Database\Seeders;

use App\Models\UserOnboarding;
use Illuminate\Database\Seeder;
use Database\Seeders\Helpers\DataFormatHelper;

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
        $csvFile = fopen(base_path("database/data/export.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 340, ";")) !== FALSE) {
            if (!$firstLine) {
                //create userOnboarding records
                UserOnboarding::create([
                    "user_id" => trim($data['0']),
                    "created_date" => DataFormatHelper::formatDateColumn(trim($data['1'])),
                    "onboarding_percentage" => DataFormatHelper::formatNumberColumn(trim($data['2'])),
                    "count_applications" => DataFormatHelper::formatNumberColumn(trim($data['3'])),
                    "count_accepted_applications" => DataFormatHelper::formatNumberColumn(trim($data['4']))
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
