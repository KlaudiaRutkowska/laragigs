<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TagFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('tags', function(Builder $query) use($value) {
            $query->where('name', 'like', "%$value%");
        });
    }
}