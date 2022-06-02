<?php

namespace Visanduma\LaravelLiteSubscription\Commands;

use Illuminate\Console\Command;

class LaravelLiteSubscriptionCommand extends Command
{
    public $signature = 'laravel-lite-subscription';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
