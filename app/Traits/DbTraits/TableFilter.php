<?php

namespace App\Traits\DbTraits;

trait TableFilter
{
    protected function state_id($query, $relationName, $searchvalue)
    {
        return $query->whereHas($relationName, function ($query) use ($searchvalue) {
            $query->where('state_name', 'like', '%'.$searchvalue.'%');
        })->with(['specialty', 'degree', 'credentials', 'state']);
    }

    protected function specialty_id($query, $relationName, $searchvalue)
    {
        return $query->whereHas($relationName, function ($query) use ($searchvalue) {
            $query->where('specialty_name', 'like', '%'.$searchvalue.'%');
        })->with(['specialty', 'degree', 'credentials', 'state']);
    }
}
