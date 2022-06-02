<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = "lite_plans";
    protected $guarded = [];

    public function attachFeature(Feature $feature, array $values)
    {
        $pf = new PlanFeature();
        $pf->feature()->associate($feature);
        $pf->plan()->associate($this);
        $pf->fill($values);
        $pf->save();

        return $pf;
    }

    public function hasFeature($slug): bool
    {
        return $this->features()->whereHas('feature', function ($q) use ($slug) {
            $q->whereSlug($slug);
        })->exists();
    }

    public function features()
    {
        return $this->hasMany(PlanFeature::class)->with('feature');
    }

    public function getFeature($slug)
    {
        return $this->features()->whereHas('feature', function ($q) use ($slug) {
            $q->whereSlug($slug);
        })->first();
    }

}
