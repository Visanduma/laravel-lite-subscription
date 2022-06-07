<?php


namespace Visanduma\LaravelLiteSubscription\Models;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{

    use HasFactory;

    protected $table = 'lite_features';
    protected $guarded = [];



    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->slug = Str::slug($item->slug);
        });

        static::updating(function ($item) {
            $item->slug = Str::slug($item->slug);
        });
    }


    public function planFeatures()
    {
        return $this->hasMany(PlanFeature::class);
    }
}
