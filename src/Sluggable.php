<?php

namespace Dunice\Sluggable;

use Dunice\Sluggable\Observers\SluggableObserver;
use Illuminate\Support\Str;

trait Sluggable
{
    protected $slugEvent;

    public static function bootSluggable()
    {
        static::observe(new SluggableObserver());
    }

    public function setSluggableEvent(string $event)
    {
        $this->slugEvent = $event;

        return $this;
    }

    public function readyForSlugging(): bool
    {
        return in_array($this->slugEvent, $this->getAllowedEvents());
    }

    public function sluggify(): void
    {
        foreach ($this->getSlugMapping() as $field => $slugField) {
            $slug = Str::slug($this->$field);

            if ($this->mustBeUniqueSlug()) {
                $count = $this->query()
                    ->where($slugField, 'like', sprintf('%s%%', $slug))
                    ->where('id', '<>', $this->id)
                    ->count();

                if ($count > 0) {
                    $slug .= sprintf('-%s', $count);
                }
            }

            $this->$slugField = $slug;
        }
    }

    protected function getAllowedEvents(): array
    {
        return property_exists($this, 'allowedSlugEvents') && is_array($this->allowedSlugEvents)
            ? $this->allowedSlugEvents
            : ['creating', 'updating'];
    }

    protected function getSlugMapping(): array
    {
        return property_exists($this, 'slugMapping') && is_array($this->slugMapping)
            ? $this->slugMapping
            : ['name' => 'slug'];
    }

    protected function mustBeUniqueSlug()
    {
        return property_exists($this, 'uniqueSlug') && is_bool($this->uniqueSlug)
            ? $this->uniqueSlug
            : true;
    }
}
