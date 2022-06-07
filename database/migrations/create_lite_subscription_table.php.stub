<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lite_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->double('price')->default(0);
            $table->string('currency')->default('USD');
            $table->integer('trial_days')->nullable();
            $table->integer('valid_period')->default(1);
            $table->string('valid_interval')->default('year');
            $table->timestamps();
        });

        Schema::create('lite_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('lite_plan_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('feature_id');
            $table->integer('limit')->nullable();
            $table->integer('valid_period')->default(1);
            $table->string('valid_interval')->default('month');
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('lite_plans')->onDelete('restrict');
            $table->foreign('feature_id')->references('id')->on('lite_features')->onDelete('restrict');
        });


        Schema::create('lite_plan_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->morphs('subscriber');
            $table->unsignedBigInteger('plan_id');
            $table->string('slug');
            $table->dateTime('trial_ends_at')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('unsubscribed_at')->nullable();
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('lite_plans')->onDelete('restrict');

        });

        Schema::create('lite_plan_subscription_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_subscription_id');
            $table->unsignedBigInteger('plan_feature_id');
            $table->string('slug');
            $table->integer('usage')->default(0);
            $table->dateTime('valid_till')->nullable();
            $table->timestamps();

            $table->foreign('plan_subscription_id')->references('id')->on('lite_plan_subscriptions')->onDelete('cascade');
            $table->foreign('plan_feature_id')->references('id')->on('lite_plan_features')->onDelete('cascade');

        });
    }
};
