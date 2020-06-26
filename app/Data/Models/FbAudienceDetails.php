<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FbAudienceDetails extends Eloquent
{
    protected $collection = 'fb_audience_details';
    
       public static function getAudienceIdByCity($city= ""){

    	$result = FbAudienceDetails::where('city' ,'=', $city )->get();
        $data = '';

        $result = json_decode($result);

        foreach ($result as $key => $value) {
        	$data = $value->audience_id;
        }
         
    	return $data;
    }
}
