<?php

namespace BcAutomotive\MasterApiClient\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	
    protected function getPackageProviders($app)
    {
        return [
            'BcAutomotive\MasterApiClient\Providers\MasterApiClientServiceProvider',
	    ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'MasterApiClient' => 'BcAutomotive\MasterApiClient\Facades\MasterApiClient',
        ];
    }

}
