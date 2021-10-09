<?php

namespace Database\Seeders;

use App\Models\UserOnboarding;
use Illuminate\Database\Seeder;


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

        $firstline = true;
        //loop within csv data rows
        while (($data = fgetcsv($csvFile, 340, ";")) !== FALSE) {

            if (!$firstline) {
                //create userOnboarding records
                UserOnboarding::create([
                    "user_id" => trim($data['0']),
                    "created_date" => trim($data['1']),
                    "onboarding_percentage" => trim($data['2']),
                    "count_applications" => trim($data['3']),
                    "count_accepted_applications" => trim($data['4'])
                ]);
            }
            $firstline = false;
        }

        //close csv file
        fclose($csvFile);
    }
}
