<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('company', 'like', "%$value%");
    }
}