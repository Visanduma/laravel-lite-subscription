<?php

namespace Visanduma\LaravelLiteSubscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Visanduma\LaravelLiteSubscription\Models\Plan;


class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition()
    {
        return [
            'name' => "Plan one",
            'slug' => 'plane-one',
            'description' => "long text",
            'price' => 90,
            'currency' => 'USD'
        ];
    }
}

