<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\Api\V1\ChartController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChartControllerTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'UserOnboardingSeeder']);
    }

    //check db user_onboarding table is avialable or not
    public function test_userOnboarding_table_is_avialable_in_database()
    {
        $this->assertDatabaseHas('user_onboarding', ['user_id' => '3121']);
    }

    //check user_weekly_retention_chart_view is available or not
    public function test_userWeeklyRetentionChartview_is_available_in_database()
    {
        $this->assertDatabaseHas('user_weekly_retention_chart_view', ['week_start' => '2016-07-18']);
    }

    //check chart api work as expected
    public function test_check_api_route_weeklyChart()
    {
        $this->withoutExceptionHandling();
        $this->get('/api/v1/chart/weeklyRetention')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])->assertJsonStructure([
                "data",
                "success"
            ]);
    }

    //check chart index web rendering correctly
    public function test_the_chart_index_page_is_rendered_properly()
    {
        $this->withoutExceptionHandling();
        $Response = $this->get(route('chartIndex'));
        $Response->assertSuccessful();
    }
}
