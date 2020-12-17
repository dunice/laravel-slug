<?php

namespace Dunice\Sluggable\Facades;

use Illuminate\Support\Facades\Facade;

class Slugger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dunice\Sluggable\Contracts\Slugger::class;
    }
}
