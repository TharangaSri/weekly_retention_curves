<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserChartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_weeklyRetentionChart()
    {
        $this->get('/api/v1/chart/weeklyRetention')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_viewChartIndex()
    {
        $this->withoutExceptionHandling();
        $Response = $this->get(route('chartIndex'));
        $Response->assertSuccessful();
    }
}
