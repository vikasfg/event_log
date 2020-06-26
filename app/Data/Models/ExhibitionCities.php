<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ExhibitionCities extends Eloquent
{
    protected $collection = 'exhibition_cities_postcode';

    public static function getActiveCities(){

    	$result = ExhibitionCities::get();
        $data = array();

        $result = json_decode($result);

        foreach ($result as $key => $value) {
        	$data[] = (array)$value;
        }

    	return $data;
    }

}
