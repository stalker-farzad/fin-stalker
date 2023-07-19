<?php

namespace App\EloquentFilters\V1\Contract;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class ScaledUpAtFilter extends Filter
{

    use FiltersDatesTrait;

    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->filterDate($builder, $value,'scaled_up_at');
    }
}
