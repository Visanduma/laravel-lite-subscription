<?php


namespace Visanduma\LaravelLiteSubscription\Tests;


use Illuminate\Database\Eloquent\Model;
use Visanduma\LaravelLiteSubscription\Traits\SubscribeAble;

class Subscriber extends Model
{
    use SubscribeAble;

    protected $guarded = [];

    public function getIdAttribute()
    {
        return 1;
    }
}
