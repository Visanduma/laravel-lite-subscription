<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $table = 'lite_plan_features';
    protected $guarded = [];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}
