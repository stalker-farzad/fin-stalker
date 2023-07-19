<?php

namespace App\EloquentFilters\V1\Team;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class AumCurrencyFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('aum_currency', 'LIKE', '%'.$value.'%');
    }
}
