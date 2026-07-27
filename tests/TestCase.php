<?php

namespace Zerp\Twilio\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Zerp\Twilio\Providers\TwilioServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [TwilioServiceProvider::class];
    }
}
