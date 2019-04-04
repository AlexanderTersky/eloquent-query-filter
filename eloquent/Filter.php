<?php

namespace Wtolk\Eloquent;

trait Filter
{
    /**
     * Redefine the Illuminate\Database\Eloquent\Builder
     *
     * @param $query
     * @return Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
