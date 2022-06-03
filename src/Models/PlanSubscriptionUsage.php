<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Database\Eloquent\Model;

class PlanSubscriptionUsage extends Model
{
    protected $table = "lite_plan_subscription_usage";

    protected $guarded = [];
    protected $dates = ['valid_till'];

    public function planFeature()
    {
        return $this->belongsTo(PlanFeature::class);
    }

    public function getExpiredAttribute()
    {
        return $this->valid_till->isPast();
    }

    public function resetUsage()
    {
        $this->usage = 0;
        $this->save();
    }

    public function renewValidity()
    {
        $feature = $this->planFeature->feature;
        $validity = now()->add($feature->valid_interval, $feature->valid_period);
        $this->valid_till = $validity;
        $this->save();
    }


}
