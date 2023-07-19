<?php

namespace App\EloquentFilters\V1\Desk;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class AumAmountFilter extends Filter
{
    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereBetween('aum_amount', [$value['from'], $value['to']]);
    }
}
