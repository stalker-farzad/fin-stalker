<?php

namespace App\EloquentFilters\V1\DeskAccount;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class TypeFilter extends Filter
{
    /**
     * Apply the type condition to the query.
     */
    public function apply(Builder $builder, mixed $value) : Builder
    {
        return $builder->where('status', $value);
    }
}
