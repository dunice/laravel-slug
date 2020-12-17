<?php

namespace Dunice\Sluggable\Observers;

use Dunice\Sluggable\Facades\Slugger;

class SluggableObserver
{
    public function saving($model): void
    {
        Slugger::execute($model->setSluggableEvent('saving'));
    }

    public function updating($model): void
    {
        Slugger::execute($model->setSluggableEvent('updating'));
    }

    public function creating($model): void
    {
        Slugger::execute($model->setSluggableEvent('creating'));
    }
}
