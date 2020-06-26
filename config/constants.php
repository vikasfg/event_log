<?php

return [
	
	'APP_NAME' => 'My APP',
	'APP_URL' => env('APP_URL_API'),
	'APP_KEY' =>'xxxxx-xxxx',
	'APP_SECRET' => 'xxxxxxx-xxxxxx-xxxx',
	'ACCESS_TOKEN' => env('ACCESS_TOKEN'),
	'FB_AUDIENCE_CREATE' => env('FB_AUDIENCE_CREATE'),
	'FB_AUDIENCE_UPDATE' => 'https://graph.facebook.com/v5.0/23844147832630013/users',
	'AUTHORIZATION_KEY' => array(
	    "Authorization: Bearer " . env('API_KEY'),
	    "Accept: application/json",
	    "Content-Type: multipart/form-data; boundary=--------------------------382916222777457369752816"
	  )
];

?> 