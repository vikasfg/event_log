<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class FacebookAudienceModel extends Eloquent
{
    public static function fbaudience($customoutput = array(), $cityName){

    	if(!empty($customoutput)){

    		$res = array(
            'audience_id' => $customoutput['audience_id'],
            'base_type' => $customoutput['base_type'],
            'city' => $customoutput['city'],
            'user_count' => $customoutput['user_count'],
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
           );

        if($customoutput['response']=='success')
    	{
            $addfbaudience = DB::table('fb_audience_details')->insert((array)$res);
            $updateIsCreated = DB::table('exhibition_cities_postcode')->where('city_name','=',$cityName)->update(['is_created'=>1]);

        }
          
    		$reslog = array(
            'audience_id' => $customoutput['audience_id'],
            'base_type' => $customoutput['base_type'],
            'city' => $customoutput['city'],
            'user_count' => $customoutput['user_count'],
            'response'   => (array)$customoutput['response'],
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
           );
          
      $addfbaudience_log = DB::table('fb_audience_details_log')->insert((array)$reslog);
  
    	}
    	  


    }
}
