<?php

namespace Shopia\Nowpayments\Facades;

use Illuminate\Support\Facades\Facade;

class Nowpayments extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nowpayments';
    }
}
