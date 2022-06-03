<?php


namespace Visanduma\LaravelLiteSubscription\Traits;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Visanduma\LaravelLiteSubscription\Models\Plan;
use Visanduma\LaravelLiteSubscription\Models\PlanSubscription;

trait SubscribeAble
{
    public function subscribe(Plan $plan)
    {
        $this->subscriptions()->create([
            'plan_id' => $plan->id,
            'slug' => 'main',
            'start_at' => now(),
            'end_at' => now()->add($plan->valid_interval, $plan->valid_period),
            'trial_ends_at' => $plan->trial_days ? now()->addDays($plan->trial_days) : null
        ]);
    }

    public function subscriptions(): ?MorphMany
    {
        return $this->morphMany(PlanSubscription::class, 'subscriber')
            ->whereNull('unsubscribed_at');
    }

    public function hasSubscribed(Plan $plan)
    {
        return $this->subscription()->where('plan_id', $plan->id)->exists();
    }

    public function subscription($slug = 'main'): ?PlanSubscription
    {
        return $this->subscriptions()
            ->where('slug', $slug)
            ->first();
    }

    public function hasAnySubscription(): bool
    {
        return $this->subscriptions()->exists();
    }

}
