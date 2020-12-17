<?php

namespace Dunice\Sluggable;

use Dunice\Sluggable\Contracts\Slugger;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SluggableServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(Slugger::class, function ($app) {
            return new \Dunice\Sluggable\Slugger();
        });
    }

    public function provides()
    {
        return [
            Slugger::class,
        ];
    }
}
