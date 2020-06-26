<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Data\Models\SaveLogs;
use App\UserSearch\UserSearch;
use DB;


class ProcessController extends Controller
{

	 public function index()
    {
        // $response = DB::table('tbl_logs')
        //   ->select('id')
        
        //   ->get();
        $data = SaveLogs::all();
        return view('column_searching')->with('data', $data);

        return  json_encode($logs);
    }

 public function view()
    {
    	$data = DB::table('tbl_logs')
          ->select('id')
        
          ->get();
       // $data = SaveLogs::all();
        $response = array();
        foreach ($data as $key => $value) {
        	 $response = $value->id;
        }
        return view('column_searching', compact('response'));

        return  json_encode($logs);
    }

   public function store(Request $request)
    {
        $validatedData=request()->validate([
            'email' => 'required',
            'environment' => 'required',
            'component' => 'required',
            'message' => 'required',
            'data' => 'required'
        ]);
 
        SaveLogs::create($request->all());


        return  'Event created successfully email- '.$request->email.' order#'.$request->message;
    }

     public function filter(Request $request)
    {
        
        if(isset($request->clear))
        return SaveLogs::all();
    else
        return UserSearch::apply($request);


    }


}
