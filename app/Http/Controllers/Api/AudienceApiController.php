<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User; 
use DB;
use App\Helpers\helper; 
use Carbon\Carbon;

class AudienceApiController extends Controller
{
	public function getOnlineAudience(){
		
		//$online_users = DB::table('sales_flat_order_address')->get();
		// $online_users = DB::table('sales_flat_order_address')->select('entity_id,customer_id,postcode,lastname,street,city,email,telephone,firstname,created_at,updated_at')
		//     ->join('sales_flat_order', 'countries.country_id', '=', 'leagues.country_id')
		//     ->where('countries.country_name', $country)
		//     ->get();
/***********************************/




		// $postdata1 = "&Authorization=" .$access_token.'&payload={"schema": ["EMAIL_SHA256"],"data":['.$str1.']}';


		// $ch = curl_init();    
	 //    curl_setopt($ch, CURLOPT_URL, 'http://devdashboard.faridadev.com/api/fbaudience');
	 //    curl_setopt($ch, CURLOPT_HEADER, 0);
	 //    curl_setopt($ch, CURLOPT_POST, 1);
	 //    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	 //    $output = curl_exec($ch);
	 //    curl_close($ch);
	 //    return $output;
	
	  $curl = curl_init();

	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://devdashboard.faridadev.com/api/fbaudience",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVkOWE2MDk1MjFhMzQwZDQxMGRiOTdiMDA0NTZhZjI4Yzk1YTQ3NTYzNjAxMzgxZWFiZDIxZTgwZDEyM2EyODJmMzgxNDE2NzQ3ZGY2OWNkIn0.eyJhdWQiOiI0IiwianRpIjoiNWQ5YTYwOTUyMWEzNDBkNDEwZGI5N2IwMDQ1NmFmMjhjOTVhNDc1NjM2MDEzODFlYWJkMjFlODBkMTIzYTI4MmYzODE0MTY3NDdkZjY5Y2QiLCJpYXQiOjE1Nzk2MDY4OTcsIm5iZiI6MTU3OTYwNjg5NywiZXhwIjoxNTgwOTAyODk3LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.iwOwzmCZm7QJWDyvAJWsQwbY0ZO11TgC_6Qv4KtN7wRfty-Qw0_DG-36vakXClu0Mi8NMGS4t1duLerknWqnr0AxABNSxCFJ-zWw2gEqEsgFj62FvKKuEjcmMy7cY7m9Wra_Fc1fTaSd56xXnTxsiqvFzDNjVo4hozy1fo68uhEB1rV8NqMWAzotdzcU7wMNzCPhwdXZNNb_TlC63VYIAFYB5Qv5JFlQIfezxD-q9xBShklcxqIkEQhhbwOyvdG-xKoVCuzhwj_qQzQYa8_wV6aO3CSGFn4iMec2eEXxGhXnVKyz3J9LLHJ0XVTQJTWHeXnDosD-jdDbc5Pq253hjoYnab5J_AkigJ1PVhFL9u6bqPiO-PWNx29WwwZgL4EVU9TFP6ep96Yy1jvo-3zX03yu_FuCVJdX60TpP5A-Lw3DNhVgrLTJp8kO_rM1nqQiXW-VpmiDKFDVGPzTlIayyxEC2eSIEgd0ta9ZAbHqkra43dizDM5Lq-3Tj9wTZhwvi4NWx_A-mGUif1VGbquB8v-VE00OZ-CZd5uL7Km6Zgxj7CTO_A2m42RS5YhIi2petsh945nkmsci3DaCnGflJxJysjLDMz8GeRDtEZ8Z6u-aO6YOz4-rR1PrlOzuvK051vML9mVc5KoiBTfcnSjl9uzGQalQD7HXarrZL2u0Yu0",
	    "Accept: application/json",
	    "Content-Type: multipart/form-data; boundary=--------------------------382916222777457369752816"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;

	}
}

?>