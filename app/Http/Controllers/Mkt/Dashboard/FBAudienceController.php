<?php

namespace App\Http\Controllers\Mkt\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Data\Models\ExhibitionCities;
use App\Classes\Helpers\Utility;

class FBAudienceController extends Controller
{
   public function getOnlineAudience(){
	   	$url = config("constants.APP_URL")."/api/fbaudience";
	   	$response = $this->getCurlResponse($url);
   }


   public function getExhibitionCities(){
	   	$url = config("constants.APP_URL")."/api/get-exhibition-cities";
	   	$response = $this->getCurlResponse($url);
	   	return $response;
   }

    public function addExhibitionCity(){
	   	//$cities_api = $this->getExhibitionCities();
	 	$url = "/api/get-exhibition-cities";
	   	$response = Utility::getCurlResponse($url);
	   	$cities = json_decode($response);

	   	$cities_get = ExhibitionCities::get();
	    // foreach( $cities as $city ){
	  		// $city_arr = (array)$city;
	   	// 	$cities_arr = DB::table('exhibition_cities_postcode')->insert($city_arr);
   		// } 
   }
   public function getOfflineUsers(){
   		$url = "api/get-offline-users";
   		$response = Utility::getCurlResponse($url);
   		return $response;
   }
   public function addOfflineUsers(){
   		$url = "api/get-offline-users";
   		$response = Utility::getCurlResponse($url);
   		return $response;
   }
   
   


}
