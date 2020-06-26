<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class SaveLogs extends Eloquent
{
    protected $collection = 'tbl_logs';
        protected $fillable = [
        'email', 'environment','component','message','data'
    ]; 
}
