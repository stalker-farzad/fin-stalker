<?php

namespace App\EloquentFilters\V1\Team;

use Fouladgar\EloquentBuilder\Concerns\FiltersDatesTrait;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SyncedAtFilter extends Filter
{

    use FiltersDatesTrait;

    /**
     * Apply the condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->filterDate($builder, $value,'synced_at');
    }
}
