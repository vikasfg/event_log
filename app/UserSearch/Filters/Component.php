<?php

namespace App\UserSearch\Filters;

class Component
{
    public static function apply($builder, $value)
    {
        return $builder->where('component', $value);
    }
}

?>