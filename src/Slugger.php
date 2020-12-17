<?php

namespace Dunice\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Slugger
{
    public function execute(Model $model): void
    {
        if ($model->readyForSlugging()) {
            $model->sluggify();
        }
    }
}
