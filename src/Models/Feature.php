<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    use HasFactory;

    protected $table = 'lite_features';
    protected $guarded = [];


    public function planFeatures()
    {
        return $this->hasMany(PlanFeature::class);
    }

}
