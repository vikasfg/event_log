<?php

namespace App\UserSearch\Filters;

class Email
{
    public static function apply($builder, $value)
    {
        return $builder->where('email', $value);
    }
}

?>