<?php

namespace App\Classes\Helpers;
use GuzzleHttp;

class Utility {


	/* returns the shortened url */
	public static function get_bitly_edited_url($url, $login, $appkey, $format = 'txt') {
		http://api.bit.ly/v3/user/link_edit?edit=note&note=News+from+a+great+record+label+%23music&access_token=ACCESS_TOKEN&link=http%3A%2F%2Fbit.ly%2FJGVkUk;
		$connectURL = 'https://api.bit.ly/v3/user/link_edit?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&title=bhagat&format='.$format;
		return self::curl_get_result($connectURL);
	}

	/* returns expanded url */
	public static function get_bitly_long_url($url, $login, $appkey, $format = 'txt') {
		$connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.urlencode($url).'&format='.$format;
		return self::curl_get_result($connectURL);
	}

	/* returns a result form url */
	public static function curl_get_result($url) {
		$ch      = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public static function getCurlResponse( $url = '' ){
     $url = config("constants.APP_URL")."/".$url;
     $authorization_key = config('constants.AUTHORIZATION_KEY');
   	 $curl = curl_init();
	 curl_setopt_array($curl, array(
	 CURLOPT_URL => $url,
	 CURLOPT_RETURNTRANSFER => true,
	 CURLOPT_ENCODING => "",
	 CURLOPT_MAXREDIRS => 10,
	 CURLOPT_TIMEOUT => 0,
	 CURLOPT_FOLLOWLOCATION => true,
	 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	 CURLOPT_CUSTOMREQUEST => "GET",
	 CURLOPT_HTTPHEADER => $authorization_key,
	));
	$response = curl_exec($curl);
	curl_close($curl);

	return $response;
   }
	
	public static function decryptIt( $data ) {

		    $encryption_key = base64_decode(env('cryptsalt'));

		    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 
		    2),2,null);

		    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, 
		    $iv);
	}
}

?>
