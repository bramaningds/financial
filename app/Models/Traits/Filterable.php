<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    public static function getFilters(array $attributes)
    {
        return array_filter_key($attributes, (new static)->filterable);
    }

    public static function filterable(array $attributes = [])
    {
        return (new static)->filterable;
    }

    public function scopeFilter(Builder $query, $parameters = [])
    {
        if (!$this->filterable) {
            return;
        }

        if (is_string($this->filterable)) {
            $this->filterable = [$this->filterable];
        }

        foreach ($this->filterable as $field => $default) {
            if (is_numeric($field)) {
                continue;
            }

            if (array_key_exists($field, $parameters)) {
                continue;
            }

            $parameters[$field] = $default;
        }

        foreach ($parameters as $field => $value) {
            if (!in_array($field, $this->filterable)) {
                continue;
            }

            if (!$value) {
                continue;
            }

            if (method_exists($this, $method = "filter" . studly($field))) {
                $this->$method($query, $value);
            } else if (method_exists($this, $method = "scope" . studly($field))) {
                $this->$method($query, $value);
            } else {
                $query->where($field, $value);
            }
        }
    }
}
