# Welcome to Retention Curves!

Installation guide - 
[Installation guide document](https://github.com/TharangaSri/weekly_retention_curves/blob/master/Installation%20Note.pdf)

UI guide - 
[enter link description here](https://github.com/TharangaSri/weekly_retention_curves/blob/master/UI%20guide.pdf)


    git clone https://github.com/TharangaSri/weekly_retention_curves.git
    composer update
    copy .env.example .env
Update database info in .env file

    php artisan migrate
    php artisan db:seed --class=UserOnboardingSeeder
Now system is running under default - http://127.0.0.1:8000

Please generate app key 



Final Result - 

Navigate to [http://127.0.0.1:8000/chart/UserWeeklyRetentionChart](http://127.0.0.1:8000/chart/UserWeeklyRetentionChart)

![enter image description here](https://raw.githubusercontent.com/TharangaSri/weekly_retention_curves/master/result.PNG)

