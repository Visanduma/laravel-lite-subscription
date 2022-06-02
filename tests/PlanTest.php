<?php

namespace Visanduma\LaravelLiteSubscription\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Visanduma\LaravelLiteSubscription\Models\Plan;

class PlanTest extends TestCase
{

    use RefreshDatabase;

    public function test_createPlan()
    {
        $plan = Plan::factory()->create();

        $this->assertDatabaseCount('lite_plans', 1);
    }

}
