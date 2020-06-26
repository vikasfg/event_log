<?php

namespace App\UserSearch\Filters;

class Message
{
    public static function apply($builder, $value)
    {
        return $builder->where('message','like', '%' . $value .'%');
    }
}

?>