<?php

namespace BcAutomotive\MasterApiClient\Facades;

use Illuminate\Support\Facades\Facade;

class MasterApiClient extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'master-api-client';
	}
	
}