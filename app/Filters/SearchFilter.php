<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder
            ->where('title', 'like', "%$value%")
            ->orWhere('company', 'like', "%$value%")
            ->orWhere('location', 'like', "%$value%")
            ->orWhere('description', 'like', "%$value%");
    }
}