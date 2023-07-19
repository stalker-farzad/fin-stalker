<?php

namespace App\EloquentFilters\V1\Desk;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CoverFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('attachments', function($query) use ($value) {
            $query->where('cover', 'LIKE', "%$value%");
        });
    }
}
