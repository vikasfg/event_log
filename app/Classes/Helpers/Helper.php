<?php

namespace App\Classes\Helpers;
use GuzzleHttp;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Helper{

	/**
     * function to do a Add or update request with cURL.
     *
     * @var array
     */

	public static function getCurlResponseFb($data = '', $url ){
		//$url = config("constants.FB_AUDIENCE_CREATE");
		$ch = curl_init();    
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $output = curl_exec($ch);
	  	curl_close($ch);
	    return $output;
	      
	}

	/**
    * function to do a DELETE request with cURL.
    *
    * @var url
    * @var data
    */

	public static function removeAudienceCurl( $data = '', $url = '' ){


		$ch = curl_init();    
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    return $output;


	}

	public static function guzzleApi($data){

		$url = config("constants.FB_AUDIENCE_CREATE");
		$client = new GuzzleHttp\Client(); //GuzzleHttp\Client
		$response = $client->post($url, [
		    'form_params' => [
		        'data' => $data
		    ]
		]);

		$response = json_decode((string) $response->getBody(), true);
        return $response;
	}
}

?>