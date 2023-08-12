<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ListingFilter extends AbstractFilter
{
    protected $filters = [
        'tag' => TagFilter::class,
        'title' => TitleFilter::class,
        'company' => CompanyFilter::class,
        'search' => SearchFilter::class,
    ];
}