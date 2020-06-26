<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CustomSearchController extends Controller
{
    //

     function index(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->filter_gender))
      {
       $datas = DB::table('tbl_customer')
         ->select('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country')
         ->where('Gender', $request->filter_gender)
         ->where('Country', $request->filter_country)
         ->get();
      }
      else
      {
       $datas = DB::table('tbl_customer')
         ->select('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country')
         ->get();
      }
       $data = array();
    foreach ($datas as $key => $value) {
    	 $data[$key] = $value;
    }
      return   /*array(array("CustomerName"=>"Brenden Wagner",
      "Gender"=>"Software Engineer",
      "Address"=>"San? Francisco",
      "City"=>"1314",
      "PostalCode"=>"2011/06/07",
      "Country"=>"$206,850"));*/json_encode($data);//datatables()->of($data)->make(true);
     }
     $res = DB::table('tbl_customer')
          ->select('Country')
          ->groupBy('Country')
          ->orderBy('Country', 'ASC')
          ->get();
    $data = array();
    foreach ($res as $key => $value) {
    	 $country_name[$key] = $value;
    }

     return view('Dashboard.custom_search', compact('country_name'));
    }
}

