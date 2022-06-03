<?php

namespace Visanduma\LaravelLiteSubscription\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Visanduma\LaravelLiteSubscription\Models\Feature;
use Visanduma\LaravelLiteSubscription\Models\Plan;

class FeatureTest extends TestCase
{

    use RefreshDatabase;

    public function test_createFeature()
    {
        Feature::factory()->create();

        $this->assertDatabaseCount('lite_features', 1);
    }

    public function test_create_plan_feature()
    {
        $plan = Plan::factory()->create();
        $feature = Feature::factory()->create();

        $plan->attachFeature($feature, [
            'limit' => 100,
            'valid_period' => 30,
            'valid_interval' => 'day'
        ]);

        $this->assertDatabaseCount('lite_plan_features', 1);

    }

    public function test_make_subscription()
    {
        $plan = $this->createPlanWithFeature();
        $user = new Subscriber();
        $user->subscribe($plan);

        $this->assertDatabaseCount('lite_plan_subscriptions', 1);

    }

    public function test_check_subscription_attributes()
    {
        $plan = $this->createPlanWithFeature();
        $user = new Subscriber();
        $user->subscribe($plan);

        $this->assertTrue($user->subscription()->isActive());
        $this->assertFalse($user->subscription()->isCanceled());

        $user->subscription()->cancel();
        $this->assertTrue($user->subscription()->isCanceled());


        $subs = $user->subscription();
        $subs->useFeature('test-feature', 15);
        $subs->useFeature('test-feature', 5);
        $subs->useFeature('test-feature', -3);

        $this->assertEquals(17, $subs->featureUsage('test-feature'));
        $this->assertTrue($subs->canUseFeature('test-feature'));

        $subs->useFeature('test-feature', 95);
        $this->assertFalse($subs->canUseFeature('test-feature'));

        $this->assertTrue($user->hasSubscribed($plan));
        $this->assertTrue($user->hasAnySubscription());

        $this->assertTrue($subs->onTrial());
        $this->travel(35)->days();
        $this->assertFalse($subs->onTrial());
        $this->assertFalse($subs->isFree());


    }


    public function test_unsubscribe_user()
    {
        $plan = $this->createPlanWithFeature();
        $user = new Subscriber();
        $user->subscribe($plan);

        $this->assertCount(1, $user->subscriptions);

        $user->subscription()->unsubscribe();

        $this->assertNull($user->subscription('main'));
        $this->assertFalse($user->hasAnySubscription());

    }


    public function test_check_feature_validity()
    {
        $plan = $this->createPlanWithFeature();
        $user = new Subscriber();
        $user->subscribe($plan);
        $subs = $user->subscription();

        $subs->useFeature('test-feature', 15);
        $this->assertEquals(15, $subs->featureUsage('test-feature'));

        $this->travel(35)->days();

        $subs->useFeature('test-feature', 15);
        $this->assertEquals(15, $subs->featureUsage('test-feature'));


    }


}
