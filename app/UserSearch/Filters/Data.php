<?php

namespace App\UserSearch\Filters;

class Data
{
    public static function apply($builder, $value)
    {
        return $builder->where('data', $value);
    }
}

?>