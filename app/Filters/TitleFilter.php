<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TitleFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('title', 'like', "%$value%");
    }
}