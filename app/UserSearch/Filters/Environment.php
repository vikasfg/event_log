<?php

namespace App\UserSearch\Filters;

class Environment
{
    public static function apply($builder, $value)
    {
        return $builder->where('environment', $value);
    }
}

?>