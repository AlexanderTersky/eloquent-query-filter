<?php

namespace WTolk;

trait SimpleFilter
{
    /**
     * Redefine the Illuminate\Database\Eloquent\Builder
     *
     * @param $query
     * @return CustomEloquentBuilder
     */
    public function newEloquentBuilder($query)
    {
        echo '123';
        require_once 'CustomEloquentBuilder.php';
        return new CustomEloquentBuilder($query);
    }
}