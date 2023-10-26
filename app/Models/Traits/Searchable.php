<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{

    public function scopeSearch(Builder $query, $keyword)
    {
        if (!$keyword) {
            return;
        }

        if (!$this->searchable) {
            return;
        }

        if (is_string($this->searchable)) {
            $this->searchable = [$this->searchable];
        }

        foreach ($this->searchable as $field) {
            $query->orWhere($field, 'LIKE', '%' . $keyword . '%');
        }
    }
}
