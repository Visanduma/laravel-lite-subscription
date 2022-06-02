<?php

namespace Visanduma\LaravelLiteSubscription\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Visanduma\LaravelLiteSubscription\LaravelLiteSubscriptionServiceProvider;
use Visanduma\LaravelLiteSubscription\Models\Feature;
use Visanduma\LaravelLiteSubscription\Models\Plan;

class TestCase extends Orchestra
{

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'Visanduma\\LaravelLiteSubscription\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLiteSubscriptionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__ . '/../database/migrations/create_lite_subscription_table.php';
        $migration->up();

    }

    public function createPlanWithFeature()
    {
        $plan = Plan::factory()->create([
            'valid_period' => 1,
            'valid_interval' => 'year'
        ]);
        $feature = Feature::factory()->create([
            'slug' => 'test-feature'
        ]);

        $plan->attachFeature($feature, [
            'limit' => 100,
            'valid_period' => 3,
            'valid_interval' => 'month'
        ]);

        return $plan;
    }
}
