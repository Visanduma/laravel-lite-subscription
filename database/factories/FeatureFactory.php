<?php

namespace Visanduma\LaravelLiteSubscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Visanduma\LaravelLiteSubscription\Models\Feature;


class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition()
    {
        return [
            'name' => "Feature",
            'slug' => 'feature-name',
            'description' => "long text",
        ];
    }
}

