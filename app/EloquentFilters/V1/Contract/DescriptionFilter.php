<?php

namespace App\EloquentFilters\V1\Contract;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class DescriptionFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('description', 'LIKE', '%'.$value.'%');
    }
}
