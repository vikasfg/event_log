<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use DB;

class OnlineBuyers extends Eloquent
{
    protected $collection = 'online_buyers';

      public static function getTargetAudience($citiesarr, $citypostcode = "", $citylike= ""){

        $citiId = $citiesarr['city_id'];
        $citiName = $citiesarr['city_name'];
        $postcodefull = array();
        if(isset($citiesarr['city_postcode'])){
            $postcode = $citiesarr['city_postcode'];
            if(strpos($postcode, ',') == true){

                $postcodeArr = explode(',', $postcode);
               
                $postcode = $postcodeArr[0];
                //$postcodefull =   array_slice($postcodeArr, 1);
               // dd($postcodefullArr);
                }                 	

         }
        if($citylike!=""){
         
        }else{
          //
 
        //$onlineUser = DB::table("online_buyers")->select("mobile", "email")->groupBy('mobile','email')->get();
 
        $onlineUser = DB::table("online_buyers")->select("mobile", "email")->whereIn('postcode', $postcodefull)->orWhere('postcode', 'like', "$postcode%")->groupBy('mobile','email')->get();

        $offlineUser = DB::table("offline_buyers")->select("mobile", "email")->where('city_id', '=', $citiId)->groupBy('mobile','email')->get();
   
        $subscriber = DB::table("newsletter_subscriber")->select("mobile","email","subscriber_cities")->groupBy('mobile','email')->get();
       
        
        $resultsubscriber = json_decode($subscriber);
        $nsdata = array();
        foreach ($resultsubscriber as $key => $value) {
        	$val =  (array)$value;
        	$cities = explode(',',$val['subscriber_cities']);
			if (in_array($citiId, $cities)) {
			  $nsdata[] = array($val['mobile'], $val['email']);	
			  }		        	
        }

        // print_r($citiName);
        // print_r('online - ' .count($onlineUser));
        // print_r('offline - '.count($offlineUser));
        // print_r('subscriber - '.count($nsdata));

    	
          $nsUser = DB::table("newsletter_subscriber")->select("mobile", "subscriber_email as email")->where('subscriber_cities', '=',2)->groupBy('mobile','email')->get();

        //$nsUser = DB::table("newsletter_subscriber")->whereRaw(["FIND_IN_SET(subscriber_cities,57)"])->get();
         $onllineOffline = $onlineUser->merge($offlineUser);           
        }

        $data = array();

        $onllineOfflineArr = json_decode($onllineOffline);

        foreach ($onllineOfflineArr as $key => $value) {

        	$val =  (array)$value;
        	$data[] = array($val['mobile'], $val['email']);	
        }

        $results = array_merge($data,$nsdata);
        $uniqueResult = array_map("unserialize", array_unique(array_map("serialize", $results)));
        //print_r(count($uniqueResult));exit;
        return $uniqueResult;
    }

    public static function updateOnlineBuyers($olineData){

		$i=$u=0;
		Log::info('Online Buyers Update Insert Cron Started');
    	foreach ($olineData as $value) {

           $customerArray = array_filter((array)$value);
           if(OnlineBuyers::where('entity_id','=',$customerArray['entity_id'])->count() > 0)
           	{
             // update
           		OnlineBuyers::where('entity_id','=',$customerArray['entity_id'])->update($customerArray);
           		$u++;
           	}
           	else
           	{
                OnlineBuyers::insert($customerArray);
                $i++;
           	}    		
    	}
    	echo "Online Buyers Update Insert Cron End insert $i update $u";
		Log::info("Online Buyers Update Insert Cron End insert $i update $u");
    }

    public static function addPromotionalSms($custumerDetails){
        	
    	dd($custumerDetails);
        
    }

}


// SELECT telephone AS mobile, email FROM sales_flat_order_address WHERE postcode like ('11%') GROUP BY mobile, email
// UNION
// SELECT mobile, subscriber_email AS email FROM newsletter_subscriber WHERE FIND_IN_SET(subscriber_cities, 4) GROUP BY mobile, email
// UNION
// SELECT mobile, null FROM offline_customer_entity WHERE city_id = 4 OR city IN ('Hyderabad') GROUP BY mobile



