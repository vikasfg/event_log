<?php

namespace App\Data\Models;
use Illuminate\Support\Facades\Log; 
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OfflineBuyers extends Eloquent
{

	protected $collection ='offline_buyers';

    public static function updateOfflineBuyers($offineData){

		$i=$u=0;
		Log::info('Offline Buyers Update Insert Cron Started');
    	foreach ($offineData as $value) {

           $customerArray = array_filter((array)$value);
           if(OfflineBuyers::where('order_id','=',$customerArray['order_id'])->count() > 0)
           	{
             // update
           		OfflineBuyers::where('order_id','=',$customerArray['order_id'])->update($customerArray);
           		$u++;
           	}
           	else
           	{
                OfflineBuyers::insert($customerArray);
                $i++;
           	}    		
    	}
    	echo "Offline Buyers Update Insert Cron End insert $i update $u";
		Log::info("Offline Buyers Update Insert Cron End insert $i update $u");
    }
}
