<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('getOnlineAudience', 'Mkt\Dashboard\FBAudienceController@getOnlineAudience');
Route::get('exhibition-cities', 'Mkt\Dashboard\FBAudienceController@getExhibitionCities');
Route::get('getCurlResponse', 'Mkt\Dashboard\FBAudienceController@getCurlResponse');
Route::get('addExhibitionCity', 'Mkt\Dashboard\FBAudienceController@addExhibitionCity');
Route::get('getOfflineUsers', 'Mkt\Dashboard\FBAudienceController@getOfflineUsers');
Route::get('createaudience', 'FacebookAdsController@createFbAudience');
Route::get('removeaudience', 'FacebookAdsController@removeFbAudience');

Route::get('launch-event', 'Mkt\Dashboard\LaunchTemplate@launchTarget');

Route::resource('customsearch', 'CustomSearchController');
