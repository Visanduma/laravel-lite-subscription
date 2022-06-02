<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Database\Eloquent\Model;

class PlanSubscription extends Model
{
    protected $table = "lite_plan_subscriptions";
    protected $guarded = [];
    protected $dates = ['end_at', 'start_at'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive(): bool
    {
        return !$this->end_at->isPast();
    }

    public function isCanceled(): bool
    {
        return !is_null($this->canceled_at);
    }

    public function useFeature($slug, $amount = 1)
    {
        $feature = $this->plan->hasFeature($slug);

        if ($feature) {
            $feature = $this->plan->getFeature($slug);
            $uses = $this->usage()->firstOrCreate([
                'plan_feature_id' => $feature->id
            ], [
                'usage' => 0,
                'slug' => $slug,
                'valid_till' => now()->add($feature->valid_interval, $feature->valid_period)
            ]);

            // TODO check usable balance before update
            $uses->increment('usage', $amount);
        }

        return $uses->usage ?? null;
    }

    public function usage()
    {
        return $this->hasMany(PlanSubscriptionUsage::class);
    }

    public function canUseFeature($slug): bool
    {
        return $this->featureBalance($slug) > 0;
    }

    public function featureBalance($slug): int
    {
        if ($this->plan->hasFeature($slug)) {
            return $this->plan->getFeature($slug)->limit - $this->featureUsage($slug);
        }

        return 0;
    }

    public function featureUsage($slug): int
    {
        return $this->usage()->whereSlug($slug)->first()->usage ?? 0;
    }

    public function unsubscribe()
    {
        $this->unsubscribed_at = now();
        $this->save();
    }

    public function cancel()
    {
        $this->canceled_at = now();
        $this->save();
    }


}
