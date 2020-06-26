<?php

namespace App\Data\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LaunchTemplateModel extends Eloquent
{
    protected $collection = 'launch_template';

    public static function getLaunchUsers(){

    	$result = LaunchTemplateModel::get();
        $data = array();

        $result = json_decode($result);

        foreach ($result as $key => $value) {
        	$data[] = (array)$value;
        }
    	return $data;
    }
}
